<?php

namespace App\Http\Controllers\Front;

use App\Models\Course;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\OrderPayment;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class CourseController extends Controller
{
    public function index()
    {
        $data = Course::with('category')->latest('created_at')->paginate(6);

        return view('pages.course.index', [
            'title' => 'Course',
            'menu' => 'Course',
            'data' => $data
        ]);
    }

    public function show($id)
    {
        $data = Course::with('category')->findOrFail(decrypt($id));

        return view('pages.course.show', [
            'title' => 'Details Course',
            'menu' => 'Course',
            'data' => $data
        ]);
    }

    public function store(Request $request)
    {
        try {
            $validation = $request->validate([
                'course_id' => 'required|exists:courses,id',
                'status' => 'nullable',
                'payment_method' => 'nullable',
                'account_number' => 'nullable',
            ], $this->messageValidation(), $this->attributeValidation());

            $hasUnpaidOrder = OrderPayment::where('user_id', Auth::id())
                ->where('status', 'Unpaid')
                ->exists();

            if ($hasUnpaidOrder) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'You cannot proceed with checkout because you have an existing unpaid order.'
                ], 400);
            }

            $validation['user_id'] = Auth::id();
            $validation['transaction_code'] = self::generateUniqueTransactionNumber();

            $data = OrderPayment::create($validation);

            if ($data) {
                return response()->json([
                    'status' => 'success',
                    'message' => 'The order payment has been successfully registered.',
                    'data' => $data
                ], 201);
            } else {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Failed to register the order payment.'
                ], 500);
            }
        } catch (ValidationException $e) {
            return response()->json(['errors' => $e->errors()], 422);
        }
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

    private function messageValidation()
    {
        $message = [
            'required' => ':attribute is required.',
            'string' => ':attribute must be a string.',
            'regex' => 'The format of :attribute is invalid.',
            'unique' => ':attribute has already been taken.',
            'digits_between' => ':attribute must be between :min and :max digits.',
            'min' => ':attribute must be at least :min characters.',
            'max' => ':attribute may not be greater than :max characters.',
            'validation_truck' => ':attribute entered is invalid or not found.',
            'less_than_current_year' => ':attribute must be less than the current year.',
            'exists' => 'The selected :attribute is invalid.',
        ];

        return $message;
    }

    private function attributeValidation()
    {
        $customAttributes = [
            'course_id' => 'Course',
            'user_id' => 'Users',
            'status' => 'Status',
            'transaction_code' => 'Transaction Code',
            'payment_method' => 'Payment Method',
            'account_number' => 'Account Number',
        ];

        return $customAttributes;
    }
}
