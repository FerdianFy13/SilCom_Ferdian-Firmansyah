<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{
    public function index()
    {
        return view('pages.auth.register', [
            "title" => "Register",
        ]);
    }

    public function store(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'name' => [
                    'required',
                    'string',
                    'min:3',
                    'regex:/^[a-zA-Z][a-zA-Z0-9\s]*$/',
                    'unique:users',
                ],
                'email' => 'required|email|unique:users|max:255',
                'nik' => 'required|digits:16|unique:users',
                'phone' => 'required|digits:12|unique:users',
                'address' => 'required|max:255',
                'password' => [
                    'required',
                    'string',
                    'min:8',
                    'regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]+$/',
                ],
                'password_confirmation' => [
                    'required',
                    'string',
                    'min:8',
                    'regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]+$/',
                    'same:password',
                ]
            ], $this->messageValidation(), $this->attributeValidation());

            if ($validator->fails()) {
                return redirect()->route('register')
                    ->withErrors($validator)
                    ->withInput();
            } else {
                $user = new User([
                    'name' => $request->input('name'),
                    'email' => $request->input('email'),
                    'nik' => $request->input('nik'),
                    'phone' => $request->input('phone'),
                    'address' => $request->input('address'),
                    'password' => bcrypt($request->input('password')),
                ]);

                $user->save();
                $user->assignRole('Customer');
                $user->givePermissionTo('Active');

                Log::info('User registered successfully, redirecting to login.');

                return redirect()->route('login')->with('register_success', 'Your account has been successfully registered.');
            }
        } catch (\Exception $e) {
            return redirect()->route('register')->with('error', 'An error occurred while attempting to register your account.');
        }
    }

    private function messageValidation()
    {
        $customMessages = [
            'required' => ':attribute is required.',
            'string' => ':attribute must be a string.',
            'name.regex' => ':attribute must contain only letters.',
            'email' => ':attribute must be a valid email address.',
            'unique' => ':attribute has already been taken.',
            'same' => ':attribute must match the Password.',
            'min' => ':attribute must be at least :min characters.',
            'password.regex' => ':attribute requires uppercase letters, lowercase letters, numbers, and special characters.',
            'password_confirmation.regex' => ':attribute requires uppercase letters, lowercase letters, numbers, and special characters.',
        ];

        return $customMessages;
    }

    private function attributeValidation()
    {
        $customAttributes = [
            'name' => 'Name',
            'email' => 'Email',
            'password' => 'Password',
            'password_confirmation' => 'Confirm Password',
            'nik' => 'NIK',
            'phone' => 'Phone Number',
            'address' => 'Address',
        ];

        return $customAttributes;
    }
}
