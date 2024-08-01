<!DOCTYPE html>
<html lang="en">

<head>
    {{-- metadata --}}
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="TrashMo Apps">
    {{-- end metadata --}}

    {{-- icon --}}
    {{-- <link rel="apple-touch-icon" sizes="76x76" href="auth/img/apple-icon.png"> --}}
    <link rel="icon" type="image/png" href="{{ asset('dist/img/logo_icon.png') }}">
    {{-- end icon --}}

    {{-- title --}}
    <title>
        {{ isset($title) ? $title . ' | SilCom' : 'SilCom' }}
    </title>
    {{-- end title --}}

    {{-- fonts --}}
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet" />
    <link href="auth/css/nucleo-icons.css" rel="stylesheet" />
    <link href="auth/css/nucleo-svg.css" rel="stylesheet" />
    <script defer src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
    <link href="auth/css/nucleo-svg.css" rel="stylesheet" />

    {{-- css --}}
    <link id="pagestyle" href="{{ asset('auth/css/argon-dashboard.css?v=2.0.4') }}" rel="stylesheet" media="print"
        onload="this.media='all'" />
    @stack('styles')
    {{-- end css --}}
</head>

<body class="">
    <div class="container position-sticky z-index-sticky top-0">
        <div class="row">
            <div class="col-12">
            </div>
        </div>
    </div>
    <main class="main-content  mt-0">
        <section>
            <div class="page-header min-vh-100">
                <div class="container">
                    {{-- auth content --}}
                    @yield('auth_content')
                    {{-- end auth content --}}
                </div>
            </div>
        </section>
    </main>

    {{-- javascript --}}
    <script defer src="{{ asset('auth/js/core/popper.min.js') }}"></script>
    <script defer src="{{ asset('auth/js/core/bootstrap.min.js') }}"></script>
    <script defer src="{{ asset('auth/js/plugins/perfect-scrollbar.min.js') }}"></script>
    <script defer src="{{ asset('auth/js/plugins/smooth-scrollbar.min.js') }}"></script>
    <script defer src="https://buttons.github.io/buttons.js"></script>
    <script defer src="{{ asset('auth/js/argon-dashboard.min.js?v=2.0.4') }}"></script>
    @stack('scripts')
    {{-- end javascript --}}
</body>

</html>
