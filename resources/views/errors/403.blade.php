@extends('layouts.error')

@section('error_main')
    <img class="img-error" src="{{ asset('dist/img/error/error-403.png') }}" alt="Not Found">
    <div class="text-center">
        <h1 class="error-title">403 Forbidden</h1>
        <p class="fs-5 text-gray-600">You are not authorized to view this page.</p>
        <a href="{{ Auth::check() ? (Auth::user()->hasRole('Admin') ? url('/dashboard') : url('/')) : url('/login') }}"
            class="btn btn-lg btn-outline-primary mt-3">
            {{ Auth::check()
                ? (Auth::user()->hasRole('Admin')
                    ? 'Back to Dashboard'
                    : 'Back to Home')
                : 'Back to Login Page' }}
        </a>
    </div>
@endsection
