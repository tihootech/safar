<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title> @yield('title', __('BRAND')) </title>


        <!-- Theme icon -->
        <link rel="shortcut icon" href="{{asset('assets/images/favicon.ico')}}">

        <!-- Theme Css -->
        <link href="{{asset('assets/css/bootstrap.min.css')}}" rel="stylesheet">
        <link href="{{asset('assets/css/slidebars.min.css')}}" rel="stylesheet">
        <link href="{{asset('assets/css/icons.css')}}" rel="stylesheet">
        <link href="{{asset('assets/css/menu.css')}}" rel="stylesheet" type="text/css">
        <link href="{{asset('assets/css/style.css')}}" rel="stylesheet">
        <link href="{{asset('assets/plugins/sweet-alert/sweetalert2.min.css')}}" rel="stylesheet" type="text/css">

        <link href="{{asset('assets/css/custom.css')}}?v=1.1" rel="stylesheet">

    </head>

    <body class="sticky-header">

        <section id="vue-app">

            @include('fragments.dashboard-sidebar')

            <div class="body-content">

                @include('fragments.dashboard-header')

                @yield('content')

                <footer class="footer">
                    {{now()->format('Y')}} &copy; @lang('BRAND').
                </footer>

                @include('fragments.sidebar-slider')

            </div>

        </section>

        <!-- jQuery -->
        <script src="{{asset('assets/js/jquery-3.2.1.min.js')}}"></script>
        <script src="{{asset('assets/js/popper.min.js')}}"></script>
        <script src="{{asset('assets/js/bootstrap.min.js')}}"></script>
        <script src="{{asset('assets/js/jquery-migrate.js')}}"></script>
        <script src="{{asset('assets/js/modernizr.min.js')}}"></script>
        <script src="{{asset('assets/js/jquery.slimscroll.min.js')}}"></script>
        <script src="{{asset('assets/js/slidebars.min.js')}}"></script>

        <!--plugins js-->
        <script src="{{asset('assets/plugins/sweet-alert/sweetalert2.min.js')}}"></script>

        <script src="{{asset('assets/js/custom.js')}}?v=1.1"></script>
        <script src="{{asset('js/app.js')}}?v=1.1"></script>
        <script src="{{asset('assets/js/jquery.app.js')}}?v=1.1"></script>

    </body>
</html>
