<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>@yield('title', 'Admin Dashboard')</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    @yield('theme')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

</head>

<body id="page-top">

    @guest
    @yield('content')
    @else
    <div class="container-fluid box">
        <div class="row">
            <!-- Sidebar Bar -->
            @include('layouts.sidebar')

            <!-- Content Area -->
            <div class="col-12 col-lg-9 col-xl-9 content vh-100">

                {{-- Header --}}
                @include('layouts.header')

                {{-- Content --}}
                @yield('content')

            </div>
        </div>
    </div>
    @endguest


    <script src="{{ asset('js/app.js') }}"></script>
    @yield('foot')

    @auth
    @include('layouts.toast')
    @endauth

    @include('layouts.alert')
</body>

</html>