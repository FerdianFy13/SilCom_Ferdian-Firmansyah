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
        $data = OrderPayment::with(['course.category', 'user'])->where('user_id', Auth::id())->get();

        return view('pages.order-payment.index', [
            'title' => 'Order Payment',
            'menu' => 'Order Payment',
            'data' => $data,
        ]);
    }
}
