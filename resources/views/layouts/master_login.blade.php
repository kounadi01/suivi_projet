<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name','laravel') }}</title>
    <link href="{{asset('images/flag-round.png')}}" rel="icon">

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <link href='https://fonts.googleapis.com/css?family=Pacifico' rel='stylesheet'>
    <link href='https://fonts.googleapis.com/css?family=Adamina' rel='stylesheet'>

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('styles.css') }}" rel="stylesheet">
    <link href="{{asset('fontawesome/css/all.css')}}" rel="stylesheet"> <!--load all styles -->
    <link href="{{asset('css/bootstrap.min.css' )}}" rel="stylesheet">



    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{asset('plugins/fontawesome-free/css/all.min.css')}}">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Tempusdominus Bootstrap 4 -->
    <link rel="stylesheet" href="{{asset('plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css')}}">
    <!-- iCheck -->
    <link rel="stylesheet" href="{{asset('plugins/icheck-bootstrap/icheck-bootstrap.min.css')}}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{asset('dist/css/adminlte.min.css')}}">
    <!-- overlayScrollbars -->
    <link rel="stylesheet" href="{{asset('plugins/overlayScrollbars/css/OverlayScrollbars.min.css')}}">
    <!-- Daterange picker -->
    <link rel="stylesheet" href="{{asset('plugins/daterangepicker/daterangepicker.css')}}">
    <!-- summernote -->
    <link rel="stylesheet" href="{{asset('plugins/summernote/summernote-bs4.min.css')}}">

    <link rel="stylesheet" href="{{asset('styles.css')}}" type="text/css">
    <link rel="stylesheet" href="{{asset('plugins/bestdatatables/css/jquery.dataTables.css')}}" type="text/css">
    <link rel="stylesheet" href="{{asset('plugins/bestdatatables/css/buttons.dataTables.css')}}" type="text/css">
    <link rel="stylesheet" href="{{asset('plugins/bestdatatables/css/dataTables.jqueryui.css')}}" type="text/css">
    <link rel="stylesheet" href="{{asset('plugins/bestdatatables/css/jquery-ui.css')}}" type="text/css">
</head>

<body style="display: block;" class="">
    <div class="py-3 bg-light" style="min-height: 90vh;">
        <main>
            @yield('contenu')
        </main>
    </div>
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="{{asset('js/jquery-3.4.1.slim.min.js')}}"></script>
    <script src="{{asset('js/popper.min.js')}}"></script>
    <script src="{{asset('js/bootstrap.min.js')}}"></script>
    <link href="{{asset('fontawesome/js/all.js')}}" rel="stylesheet"> <!--load all styles -->
    <script src="{{asset('plugins/jquery/jquery.min.js')}}"></script>
    <!-- jQuery UI 1.11.4 -->
    <script src="{{asset('plugins/jquery-ui/jquery-ui.min.js')}}"></script>
    <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
    <script>
        $.widget.bridge('uibutton', $.ui.button)
    </script>
    <!-- Bootstrap 4 -->
    <script src="{{asset('plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
    <!-- ChartJS -->
    <script src="{{asset('plugins/chart.js/Chart.min.js')}}"></script>
    <!-- AdminLTE App -->
    <script src="{{asset('dist/js/adminlte.js')}}"></script>
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="{{asset('js/jquery-3.4.1.slim.min.js')}}"></script>
    <script src="{{asset('js/popper.min.js')}}"></script>
    <script src="{{asset('js/bootstrap.min.js')}}"></script>

    <script type="text/javascript" charset="utf8" src="{{asset('plugins/bestdatatables/js/jquery.dataTables.min.js')}}"></script>
    <script type="text/javascript" charset="utf8" src="{{asset('plugins/bestdatatables/js/dataTables.buttons.min.js')}}"></script>
    <script type="text/javascript" charset="utf8" src="{{asset('plugins/bestdatatables/js/jszip.min.js')}}"></script>
    <script type="text/javascript" charset="utf8" src="{{asset('plugins/bestdatatables/js/pdfmake.min.js')}}"></script>
    <script type="text/javascript" charset="utf8" src="{{asset('plugins/bestdatatables/js/buttons.colVis.min.js')}}"></script>
    <script type="text/javascript" charset="utf8" src="{{asset('plugins/bestdatatables/js/vfs_fonts.js')}}"></script>
    <script type="text/javascript" charset="utf8" src="{{asset('plugins/bestdatatables/js/buttons.html5.min.js')}}"></script>
    <script type="text/javascript" charset="utf8" src="{{asset('plugins/bestdatatables/js/dataTables.select.min.js')}}"></script>
    <script type="text/javascript" charset="utf8" src="{{asset('plugins/bestdatatables/js/dataTables.editor.min.js')}}"></script>
    <script type="text/javascript" charset="utf8" src="{{asset('plugins/bestdatatables/js/dataTables.jqueryui.min.js')}}"></script>

    <script src="{{ asset('js/datatable_configuration.js')}}"></script>
    <script src="{{ asset('js/sweetalert2.all.min.js')}}"></script>
    <script src="{{ asset('js/function.js')}}"></script>
    <script src="{{ asset('js/loader.js')}}"></script>

    @yield('scripts')
</body>

</html>