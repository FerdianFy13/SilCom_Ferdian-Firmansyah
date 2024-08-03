<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\OrderPayment;
use Illuminate\Http\Request;

class DataPaymentHistoryController extends Controller
{
    public function index()
    {
        $dataPaid = OrderPayment::with(['user', 'course.category'])->where('status', 'Paid')->latest('created_at')->get();
        $dataUnpaid = OrderPayment::with(['user', 'course.category'])->where('status', 'Unpaid')->latest('created_at')->get();

        return view('pages.data-payment.index', [
            'title' => 'Data Payment',
            'menu' => 'Data Payment',
            'dataPaid' => $dataPaid,
            'dataUnpaid' => $dataUnpaid
        ]);
    }
}
