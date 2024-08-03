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

        $history = OrderPayment::with(['course.category', 'user'])
            ->where('user_id', Auth::id())
            ->where('status', 'Paid')
            ->get();

        $totalPrice = $history->sum(function ($orderPayment) {
            return $orderPayment->course->price;
        });

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
                    'order_id' => SELF::generateUniqueTransactionNumber(),
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
                        'id' => $item->course_id,
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
            'snapToken' => $snapToken,
            'history' => $history,
            'idData' => $data->first(),
            'totalPrice' => $totalPrice
        ]);
    }

    public static function generateUniqueTransactionNumber()
    {
        $randomString = substr(str_shuffle(str_repeat('0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ', 5)), 0, 10);

        $isUnique = self::checkUniqueTransactionNumber($randomString);

        while (!$isUnique) {
            $randomString = substr(str_shuffle(str_repeat('0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ', 5)), 0, 10);
            $isUnique = self::checkUniqueTransactionNumber($randomString);
        }

        return $randomString;
    }

    public static function checkUniqueTransactionNumber($transactionNumber)
    {
        $existingTransaction = OrderPayment::where('transaction_code', $transactionNumber)->first();
        return !$existingTransaction;
    }

    public function destroy($id)
    {
        $data = OrderPayment::findOrFail($id);

        if ($data) {
            $data->delete();

            return response()->json([
                'status' => 'success',
                'message' => 'The order payment has been successfully deleted.',
            ], 200);
        } else {
            return response()->json([
                'status' => 'error',
                'message' => 'Failed to delete the order payment.',
            ], 500);
        }
    }

    public function update(Request $request, $id)
    {
        $data = OrderPayment::findOrFail($id);

        $paymentMethod = $request->input('payment_method');
        $accountNumber = $request->input('account_number');

        try {
            $data->update([
                'status' => 'Paid',
                'transaction_code' => SELF::generateUniqueTransactionNumber(),
                'payment_method' => $paymentMethod,
                'account_number' => $accountNumber,
            ]);

            $course = Course::findOrFail($data->course_id);

            $course->update([
                'quota' => $course->quota - 1,
            ]);

            return response()->json([
                'status' => 'success',
                'message' => 'Order payment successfully updated.',
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Failed to update the order payment.',
            ], 500);
        }
    }
}
