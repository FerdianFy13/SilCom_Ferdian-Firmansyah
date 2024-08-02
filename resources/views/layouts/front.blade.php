<!DOCTYPE html>
<html lang="en">

<head>
    {{-- meta --}}
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="Silcom, Ferdian Firmansyah, Driver" name="keywords">
    <meta content="Sicom - Ferdian Firmansyah Website" name="description">
    {{-- end meta --}}

    {{-- title --}}
    <title>Silcom || {{ $title }}</title>
    {{-- end title --}}

    {{-- icon --}}
    <link href="{{ asset('dist/img/kaiadmin/favicon.ico') }}" rel="icon">
    {{-- end icon --}}

    {{-- fonts --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Work+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">
    {{-- end fonts --}}

    {{-- css --}}
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">
    <link href="{{ asset('front/lib/animate/animate.min.cs') }}s" rel="stylesheet">
    <link href="{{ asset('front/lib/owlcarousel/assets/owl.carousel.min.css') }}" rel="stylesheet">
    <link href="{{ asset('front/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('front/css/style.css') }}" rel="stylesheet">
    {{-- end css --}}
</head>

<body>
    {{-- spinner loading --}}
    @include('components.frontend.spinner')
    {{-- end spinner loading --}}


    {{-- topbar --}}
    @include('components.frontend.top_navbar')
    {{-- end topbar --}}

    {{-- navbar --}}
    @include('components.frontend.navbar')
    {{-- end navbar --}}


    @if (request()->is('/'))
        {{-- carousel --}}
        @include('components.frontend.carousel')
        {{-- end carousel --}}


        {{-- fact --}}
        @include('components.frontend.fact')
        {{-- end fact --}}
    @else
        {{-- breadcrumb --}}
        @include('components.frontend.breadcrumb')
        {{-- end breadcrumb --}}
    @endif

    {{-- content --}}
    @yield('fe_content')
    {{-- end content --}}

    @if (request()->is('/'))
        {{-- team --}}
        @include('components.frontend.team')
        {{-- end team --}}

        {{-- testimonial --}}
        @include('components.frontend.testimonial')
        {{-- end testimonial --}}
    @endif

    {{-- footer --}}
    @include('components.frontend.footer')
    {{-- end footer --}}

    {{-- top navigation --}}
    @include('components.frontend.top_navigation')
    {{-- end top navigation --}}

    {{-- javascript --}}
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('front/lib/wow/wow.min.js') }}"></script>
    <script src="{{ asset('front/lib/easing/easing.min.js') }}"></script>
    <script src="{{ asset('front/lib/waypoints/waypoints.min.js') }}"></script>
    <script src="{{ asset('front/lib/owlcarousel/owl.carousel.min.js') }}"></script>
    <script src="{{ asset('front/js/main.js') }}"></script>
    {{-- end javascript --}}
</body>

</html>
