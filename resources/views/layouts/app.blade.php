<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <title>Authentification</title>
    <!-- Bootstrap -->
    <link href="{{ asset('gentelella/assets/vendors/bootstrap/dist/css/bootstrap.min.css') }}" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="{{ asset('gentelella/assets/vendors/font-awesome/css/font-awesome.min.css') }}" rel="stylesheet">
    <!-- NProgress -->
    <link href="{{ asset('gentelella/assets/vendors/nprogress/nprogress.css') }}" rel="stylesheet">
    <!-- Animate.css -->
    <link href="{{ asset('gentelella/assets/vendors/animate.css/animate.min.css') }}" rel="stylesheet">

    <!-- Custom TheStyle -->
    <link href="{{ asset('gentelella/assets/build/css/custom.min.css') }}" rel="stylesheet">

    <link rel="stylesheet" type="text/css" href=" {{ asset('gentelella/assets/css/style.css') }}">
    {{--
    <link rel="stylesheet" type="text/css" href="{{ asset('gentelella/assets/build/css/style.css') }}"> --}}

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link rel="icon" type="image" href="{{ asset('gentelella/assets/images/favicon.png') }}">
</head>

<body class="nav-md">
    <div class="container body">
        <div class="main_container">
            <div class="col-md-3 left_col">
                <div class="left_col scroll-view">
                    <div class="navbar nav_title" style="border: 0;">
                        <a href="index.php?action=dashboard" class="site_title"><i class="glyphicon glyphicon-leaf"></i>
                            <span>IDocsMali
                            </span></a>
                    </div>

                    <div class="clearfix"></div>

                    <!-- je charge le menu profile  -->
                    {{-- @yield('layouts.profileMenu') --}}
                    <!-- /menu profile  -->

                    <br />

                    <!-- je charge le sidebar menu -->
                    @include('layouts.sidebar')
                    <!-- /sidebar menu -->

                    <!-- je charge le menu footer buttons -->
                    {{-- @include('menuFooter') --}}
                    <!-- /menu footer buttons -->
                </div>
            </div>

            <!-- je charge la bar de navigation du haut-->

            <!-- /top navigation -->

            @yield('content')
            <!-- /page content -->

            <!-- footer content -->
            {{-- @include('layouts.footer') --}}
            <!-- /footer content -->
        </div>
    </div>


    <!-- Je charge les fichier du template -->
    <!-- jQuery -->
    <script src="{{ asset('gentelella/assets/vendors/jquery/dist/jquery.min.js')}}"></script>
    <!-- Bootstrap -->
    <script src="{{ asset('gentelella/assets/vendors/bootstrap/dist/js/bootstrap.bundle.min.js')}}"></script>
    <!-- FastClick -->
    <script src="{{ asset('gentelella/assets/vendors/fastclick/lib/fastclick.js')}}"></script>
    <!-- NProgress -->
    <script src="{{ asset('gentelella/assets/vendors/nprogress/nprogress.js')}}"></script>
    <!-- Chart.js -->
    <script src="{{ asset('gentelella/assets/vendors/Chart.js/dist/Chart.min.js')}}"></script>
    <!-- gauge.js -->
    <script src="{{ asset('gentelella/assets/vendors/gauge.js/dist/gauge.min.js')}}"></script>
    <!-- bootstrap-progressbar -->
    <script src="{{ asset('gentelella/assets/vendors/bootstrap-progressbar/bootstrap-progressbar.min.js')}}"></script>
    <!-- iCheck -->
    <script src="{{ asset('gentelella/assets/vendors/iCheck/icheck.min.js')}}"></script>
    <!-- Skycons -->
    <script src="{{ asset('gentelella/assets/vendors/skycons/skycons.js')}}"></script>
    <!-- Flot -->
    <script src="{{ asset('gentelella/assets/vendors/Flot/jquery.flot.js')}}"></script>
    <script src="{{ asset('gentelella/assets/vendors/Flot/jquery.flot.pie.js')}}"></script>
    <script src="{{ asset('gentelella/assets/vendors/Flot/jquery.flot.time.js')}}"></script>
    <script src="{{ asset('gentelella/assets/vendors/Flot/jquery.flot.stack.js')}}"></script>
    <script src="{{ asset('gentelella/assets/vendors/Flot/jquery.flot.resize.js')}}"></script>
    <!-- Flot plugins -->
    <script src="{{ asset('gentelella/assets/vendors/flot.orderbars/js/jquery.flot.orderBars.js')}}"></script>
    <script src="{{ asset('gentelella/assets/vendors/flot-spline/js/jquery.flot.spline.min.js')}}"></script>
    <script src="{{ asset('gentelella/assets/vendors/flot.curvedlines/curvedLines.js')}}"></script>
    <!-- DateJS -->
    <script src="{{ asset('gentelella/assets/vendors/DateJS/build/date.js')}}"></script>
    <!-- JQVMap -->
    <script src="{{ asset('gentelella/assets/vendors/jqvmap/dist/jquery.vmap.js')}}"></script>
    <script src="{{ asset('gentelella/assets/vendors/jqvmap/dist/maps/jquery.vmap.world.js')}}"></script>
    <script src="{{ asset('gentelella/assets/vendors/jqvmap/examples/js/jquery.vmap.sampledata.js')}}"></script>
    <!-- bootstrap-daterangepicker -->
    <script src="{{ asset('gentelella/assets/vendors/moment/min/moment.min.js')}}"></script>
    <script src="{{ asset('gentelella/assets/vendors/bootstrap-daterangepicker/daterangepicker.js')}}"></script>

    <!-- Custom Theme Scripts -->
    <script src="{{ asset('gentelella/assets/build/js/custom.min.js')}}"></script>

    <!-- morris.js -->
    <script src="{{ asset('gentelella/assets/vendors/raphael/raphael.min.js')}}"></script>
    <script src="{{ asset('gentelella/assets/vendors/morris.js/morris.min.js')}}"></script>

    <!-- Datatables -->
    <script src="{{ asset('gentelella/assets/vendors/datatables.net/js/jquery.dataTables.min.js')}}"></script>
    <script src="{{ asset('gentelella/assets/vendors/datatables.net-bs/js/dataTables.bootstrap.min.js')}}"></script>
    <script src="{{ asset('gentelella/assets/vendors/datatables.net-buttons/js/dataTables.buttons.min.js')}}"></script>
    <script src="{{ asset('gentelella/assets/vendors/datatables.net-buttons-bs/js/buttons.bootstrap.min.js')}}">
    </script>
    <script src="{{ asset('gentelella/assets/vendors/datatables.net-buttons/js/buttons.flash.min.js')}}"></script>
    <script src="{{ asset('gentelella/assets/vendors/datatables.net-buttons/js/buttons.html5.min.js')}}"></script>
    <script src="{{ asset('gentelella/assets/vendors/datatables.net-buttons/js/buttons.print.min.js')}}"></script>
    <script src="{{ asset('gentelella/assets/vendors/datatables.net-fixedheader/js/dataTables.fixedHeader.min.js')}}">
    </script>
    <script src="{{ asset('gentelella/assets/vendors/datatables.net-keytable/js/dataTables.keyTable.min.js')}}">
    </script>
    <script src="{{ asset('gentelella/assets/vendors/datatables.net-responsive/js/dataTables.responsive.min.js')}}">
    </script>
    <script src="{{ asset('gentelella/assets/vendors/datatables.net-responsive-bs/js/responsive.bootstrap.js')}}">
    </script>
    <script src="{{ asset('gentelella/assets/vendors/datatables.net-scroller/js/dataTables.scroller.min.js')}}">
    </script>
    <script src="{{ asset('gentelella/assets/vendors/jszip/dist/jszip.min.js')}}"></script>
    <script src="{{ asset('gentelella/assets/vendors/pdfmake/build/pdfmake.min.js')}}"></script>
    <script src="{{ asset('gentelella/assets/vendors/pdfmake/build/vfs_fonts.js')}}"></script>
</body>

</html>