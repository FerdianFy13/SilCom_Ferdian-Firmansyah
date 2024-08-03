@extends('layouts.error')

@section('error_main')
    <img class="img-error" src="{{ asset('dist/img/error/error-500.png') }}" alt="Not Found">
    <div class="text-center">
        <h1 class="error-title">500 Internal Server Error</h1>
        <p class="fs-5 text-gray-600">A server error occurred. Please try again later.</p>
        <a href="{{ Auth::check() ? (Auth::user()->hasRole('Admin') ? url('/dashboard') : url('/')) : url('/') }}"
            class="btn btn-lg btn-outline-primary mt-3">
            {{ Auth::check()
                ? (Auth::user()->hasRole('Admin')
                    ? 'Back to Dashboard'
                    : 'Back to Home')
                : 'Back to Home Page' }}
        </a>
    </div>
@endsection
