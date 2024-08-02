<?php

namespace App\Http\Controllers\Front;

use App\Models\Course;
use App\Models\OrderPayment;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class OrderPaymentController extends Controller
{
    public function index()
    {
        $data = OrderPayment::with(['course.category', 'user'])
            ->where('user_id', Auth::id())
            ->where('status', 'Unpaid')
            ->get();

        \Midtrans\Config::$serverKey = config('midtrans.server_key');
        \Midtrans\Config::$isProduction = false;
        \Midtrans\Config::$isSanitized = true;
        \Midtrans\Config::$is3ds = true;

        if ($data->isEmpty()) {
            $params = array(
                'transaction_details' => array(
                    'order_id' => 'default_order_id',
                    'gross_amount' => 10000,
                ),
                'customer_details' => array(
                    'first_name' => 'budi',
                    'last_name' => 'pratama',
                    'email' => 'budi.pra@example.com',
                    'phone' => '08111222333',
                ),
                'item_details' => array(
                    array(
                        'id' => 'default_course_id',
                        'name' => 'Default Course Title',
                        'price' => 10000,
                        'quantity' => 1,
                    ),
                ),
            );
        } else {
            $params = array(
                'transaction_details' => array(
                    'order_id' => $data->first()->transaction_code,
                    'gross_amount' => $data->sum(function ($item) {
                        return $item->course->price;
                    }),
                ),
                'customer_details' => array(
                    'first_name' => Auth::user()->name,
                    'email' => Auth::user()->email,
                    'phone' => Auth::user()->phone,
                ),
                'item_details' => $data->map(function ($item) {
                    return [
                        'id' => $item->transaction_code,
                        'name' => $item->course->title,
                        'price' => $item->course->price,
                        'quantity' => 1,
                    ];
                })->toArray(),
            );
        }

        $snapToken = \Midtrans\Snap::getSnapToken($params);

        return view('pages.order-payment.index', [
            'title' => 'Order Payment',
            'menu' => 'Order Payment',
            'data' => $data,
            'snapToken' => $snapToken
        ]);
    }
}
