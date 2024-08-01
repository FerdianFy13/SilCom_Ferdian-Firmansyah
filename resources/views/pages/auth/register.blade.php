@extends('layouts.auth')

@section('auth_content')
    <div class="row">
        <div class="col-xl-4 col-lg-5 col-md-7 d-flex flex-column mx-lg-0 mx-auto">
            <div class="card card-plain">
                <div class="card-header pb-0 text-start">
                    <h3 class="font-weight-bolder text-center">Registrasi Akun</h3>
                </div>
                <div class="card-body">
                    <form role="form" action="{{ route('register') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <input type="text" class="form-control form-control-lg" placeholder="Username"
                                aria-label="Username" required autofocus value="{{ old('username') }}" name="username"
                                id="username" oninput="validateUsername(this)">
                            @if ($errors->has('username'))
                                <div id="usernameHelp" class="form-text text-danger" style="text-align: justify;">
                                    {{ $errors->first('username') }}</div>
                            @endif
                        </div>
                        <div class="mb-3">
                            <input type="email" class="form-control form-control-lg" placeholder="Email"
                                aria-label="Email" required value="{{ old('email') }}" name="email" id="email" oninput="validateEmail(this)">
                            @if ($errors->has('email'))
                                <div id="emailHelp" class="form-text text-danger" style="text-align: justify;">
                                    {{ $errors->first('email') }}</div>
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
                                <div id="passwordHelp" class="form-text text-danger" style="text-align: justify;">
                                    {{ $errors->first('password') }}
                                </div>
                            @endif
                        </div>
                        <div class="position-relative">
                            <input type="password" class="form-control form-control-lg" placeholder="Konfirmasi Password"
                                aria-label="Konfirmasi Password" required value="{{ old('password_confirmation') }}"
                                name="password_confirmation" id="password_confirmation" oninput="validateInput(this)">
                            <i class="fa fa-eye-slash toggle-password"
                                style="position: absolute; top: 50%; right: 10px; transform: translateY(-50%); cursor: pointer;"></i>
                        </div>
                        <div class="mb-3">
                            @if ($errors->has('password_confirmation'))
                                <div id="passwordConfirmationHelp" class="form-text text-danger"
                                    style="text-align: justify;">
                                    {{ $errors->first('password_confirmation') }}
                                </div>
                            @endif
                        </div>
                        <div class="form-check form-switch">
                            <input class="form-check-input" type="checkbox" id="rememberMe" checked
                                onclick="preventUncheck(this)">
                            <label class="form-check-label" for="rememberMe">Saya menyetujui Syarat dan Ketentuan
                            </label>
                        </div>
                        <div class="text-center">
                            <button type="submit"
                                class="btn btn-lg text-white fs-6 font-weight-bold btn-lg w-100 mt-4 mb-0 bg-gradient-orange1">
                                Registrasi
                            </button>

                        </div>
                    </form>
                </div>
                <div class="card-footer text-center pt-0 px-lg-2 px-1">
                    <p class="mb-4 text-sm mx-auto">
                        Sudah memiliki akun?
                        <a href="{{ url('/') }}" class="font-weight-bold" style="color: #E56622">Login</a>
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
