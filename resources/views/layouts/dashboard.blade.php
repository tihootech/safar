<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">
        <meta name="description" content="">
        <meta name="author" content="Mannat Themes">
        <meta name="keyword" content="">

        <title> @yield('title', __('BRAND')) </title>


        <!-- Theme icon -->
        <link rel="shortcut icon" href="{{asset('assets/images/favicon.ico')}}">

        <link href="{{asset('assets/plugins/morris-chart/morris.css')}}" rel="stylesheet">
        <!-- Theme Css -->
        <link href="{{asset('assets/css/bootstrap.min.css')}}" rel="stylesheet">
        <link href="{{asset('assets/css/slidebars.min.css')}}" rel="stylesheet">
        <link href="{{asset('assets/css/icons.css')}}" rel="stylesheet">
        <link href="{{asset('assets/css/menu.css')}}" rel="stylesheet" type="text/css">
        <link href="{{asset('assets/css/style.css')}}" rel="stylesheet">
    </head>

    <body class="sticky-header">
        <section>

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
        <script src="{{asset('assets/plugins/counter/jquery.counterup.min.js')}}"></script>
        <script src="{{asset('assets/plugins/waypoints/jquery.waypoints.min.js')}}"></script>
        <script src="{{asset('assets/plugins/sparkline-chart/jquery.sparkline.min.js')}}"></script>
        <script src="{{asset('assets/pages/jquery.sparkline.init.js')}}"></script>

        <script src="{{asset('assets/plugins/chart-js/Chart.bundle.js')}}"></script>
        <script src="{{asset('assets/plugins/morris-chart/raphael-min.js')}}"></script>
        <script src="{{asset('assets/plugins/morris-chart/morris.js')}}"></script>
        <script src="{{asset('assets/pages/dashboard-init.js')}}"></script>


        <!--app js-->
        <script src="{{asset('assets/js/jquery.app.js')}}"></script>
        <script>
            jQuery(document).ready(function($) {
                $('.counter').counterUp({
                delay: 100,
                time: 1200
                });
            });
        </script>
    </body>
</html>
