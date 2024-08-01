<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class LoginController extends Controller
{
    public function index()
    {
        return view('pages.auth.login', [
            "title" => "Login",
        ]);
    }

    public function login(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'credential' => 'required',
                'password' => 'required|min:8',
            ], [
                'credential.required' => 'Email or NIK is required.',
                'password.required' => 'Password is required.',
                'password.min' => 'Password must be at least :min characters.',
            ]);

            if ($validator->fails()) {
                return redirect()->route('login')
                    ->withErrors($validator)
                    ->withInput(['credential' => $request->input('credential')]);
            }

            $credentials = $request->only(['credential', 'password']);

            if (filter_var($credentials['credential'], FILTER_VALIDATE_EMAIL)) {
                $field = 'email';
            } else {
                $field = 'nik';
            }

            $user = User::where($field, $credentials['credential'])->first();

            if ($user && $user->can('Active') && Auth::attempt([$field => $credentials['credential'], 'password' => $credentials['password']])) {
                $request->session()->regenerate();

                if ($user->hasRole('Admin')) {
                    return redirect(RouteServiceProvider::HOME);
                } else {
                    return redirect('/');
                }
            } elseif ($user && !$user->can('Active')) {
                session(['credential' => $credentials['credential']]);

                return redirect()->route('login')->with('error', 'Sorry, you do not have permission to log in. Your account is inactive. Please contact the Admin.');
            } else {
                session(['credential' => $credentials['credential']]);

                return redirect()->route('login')->with('error', 'The Email or Nik and Password you entered are incorrect.');
            }
        } catch (\Exception $e) {
            return redirect()->route('login')->with('error', 'An error occurred while attempting to log in.');
        }
    }

    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
