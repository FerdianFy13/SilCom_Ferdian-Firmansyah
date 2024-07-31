<!DOCTYPE html>
<html lang="en">

<head>
    {{-- meta --}}
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta content="width=device-width, initial-scale=1.0, shrink-to-fit=no" name="viewport" />
    {{-- end meta --}}

    {{-- title --}}
    <title>SilCom || {{ isset($title) ? $title : '' }}</title>
    {{-- end title --}}

    {{-- icon --}}
    <link rel="icon" href="{{ asset('dist/img/kaiadmin/favicon.ico') }}" type="image/x-icon" />
    {{-- end icon --}}

    {{-- fonts --}}
    <script src="{{ asset('dist/js/plugin/webfont/webfont.min.js') }}"></script>
    <script>
        WebFont.load({
            google: {
                families: ["Public Sans:300,400,500,600,700"]
            },
            custom: {
                families: [
                    "Font Awesome 5 Solid",
                    "Font Awesome 5 Regular",
                    "Font Awesome 5 Brands",
                    "simple-line-icons",
                ],
                urls: ["{{ asset('dist/css/fonts.min.css') }}"],
            },
            active: function() {
                sessionStorage.fonts = true;
            },
        });
    </script>
    {{-- end fonts --}}

    {{-- css --}}
    <link rel="stylesheet" href="{{ asset('dist/css/bootstrap.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('dist/css/plugins.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('dist/css/kaiadmin.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('dist/css/demo.css') }}" />
    {{-- end css --}}
</head>

<body>
    <div class="wrapper">
        {{-- sidebar --}}
        @include('components.backend.sidebar')
        {{-- end sidebar --}}

        <div class="main-panel">
            {{-- navbar --}}
            @include('components.backend.navbar')
            {{-- end navbar --}}

            <div class="container">
                <div class="page-inner">
                    {{-- breadcrumb --}}
                    @include('components.backend.breadcrumb')
                    {{-- end breadcrumb --}}

                    {{-- content --}}
                    @yield('be_content')
                    {{-- end content --}}

                </div>
            </div>

            {{-- footer --}}
            @include('components.backend.footer')
            {{-- end footer --}}
        </div>

    </div>

    {{-- javascript --}}
    <script src="{{ asset('dist/js/core/jquery-3.7.1.min.js') }}"></script>
    <script src="{{ asset('dist/js/core/popper.min.js') }}"></script>
    <script src="{{ asset('dist/js/core/bootstrap.min.js') }}"></script>
    <script src="{{ asset('dist/js/plugin/jquery-scrollbar/jquery.scrollbar.min.js') }}"></script>
    <script src="{{ asset('dist/js/plugin/chart.js/chart.min.js') }}"></script>
    <script src="{{ asset('dist/js/plugin/jquery.sparkline/jquery.sparkline.min.js') }}"></script>
    <script src="{{ asset('dist/js/plugin/chart-circle/circles.min.js') }}"></script>
    <script src="{{ asset('dist/js/plugin/datatables/datatables.min.js') }}"></script>
    <script src="{{ asset('dist/js/plugin/jsvectormap/jsvectormap.min.js') }}"></script>
    <script src="{{ asset('dist/js/plugin/jsvectormap/world.js') }}"></script>
    <script src="{{ asset('dist/js/plugin/sweetalert/sweetalert.min.js') }}"></script>
    <script src="{{ asset('dist/js/kaiadmin.min.js') }}"></script>
    {{-- end javascript --}}
</body>

</html>
