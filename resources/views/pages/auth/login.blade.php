@extends('layouts.auth')

@section('auth_content')
    <div class="row">
        <div class="col-xl-5 col-lg-5 col-md-7 d-flex flex-column mx-lg-0 mx-auto">
            <div class="card card-plain">
                <div class="card-header pb-0 text-start">
                    <h3 class="font-weight-bolder text-center">Please Login</h3>
                </div>
                <div class="card-body">
                    @if (session('error'))
                        <div class="alert text-light alert-danger alert-dismissible fade show mb-3" role="alert">
                            <span class="alert-text font-weight-bolder">{{ session('error') }}</span>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    @endif

                    @if (session('register_success'))
                        <div class="alert text-light alert-success alert-dismissible fade show mb-3" role="alert">
                            <span class="alert-text font-weight-bolder">{{ session('register_success') }}</span>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    @endif

                    <form role="form" action="{{ route('login') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <input type="text" class="form-control form-control-lg" placeholder="Email or NIK"
                                aria-label="Email" required autofocus
                                value="{{ old('credential') ?: session('credential') }}" name="credential" id="credential"
                                oninput="validateInput(this)">
                            @if ($errors->has('credential'))
                                <div id="emailHelp" class="form-text text-danger" style="text-align: justify;">
                                    {{ $errors->first('credential') }}</div>
                            @endif
                        </div>
                        <div class="position-relative">
                            <input type="password" class="form-control form-control-lg" placeholder="Password"
                                aria-label="Password" required value="{{ old('password') }}" name="password" id="password"
                                oninput="validateInput(this)">
                            <i class="fa fa-eye-slash toggle-password"
                                style="position: absolute; top: 50%; right: 10px; transform: translateY(-50%); cursor: pointer;"></i>
                        </div>
                        <div class="mb-3">
                            @if ($errors->has('password'))
                                <div id="emailHelp" class="form-text text-danger" style="text-align: justify;">
                                    {{ $errors->first('password') }}
                                </div>
                            @endif
                        </div>
                        <div class="form-check form-switch">
                            <input class="form-check-input" type="checkbox" id="rememberMe" checked
                                onclick="preventUncheck(this)">
                            <label class="form-check-label" for="rememberMe">Remember Me</label>
                            {{-- <a href="/" class="form-check-label ms-auto font-weight-bold" for="rememberMe"
                                style="color: #E56622">Lupa Password</a> --}}
                        </div>
                        <div class="text-center">
                            <button type="submit"
                                class="btn btn-lg text-white fs-6 font-weight-bold btn-lg w-100 mt-4 mb-0 bg-gradient-orange1">
                                Login
                            </button>

                        </div>
                    </form>
                </div>
                <div class="card-footer text-center pt-0 px-lg-2 px-1">
                    <p class="mb-4 text-sm mx-auto">
                        Don't have an account?
                        <a href="{{ url('/register') }}" class="font-weight-bold" style="color: #E56622">Register</a>
                    </p>
                </div>
            </div>
        </div>
        {{-- slide show --}}
        @include('components.auth.slideshow')
        {{-- endslide show --}}
    </div>
@endsection

@include('pages.auth.dist.style')
@include('pages.auth.dist.validation')
