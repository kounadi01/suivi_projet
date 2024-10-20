<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">

    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'SUIVI PROJET') }}</title>
    <link href="{{asset('images/flag-round.png')}}" rel="icon">

    <!-- Fonts -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">
    <link rel="stylesheet" href="{{asset('plugins/fontawesome-free/css/all.min.css')}}">
    <!-- Styles -->
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>MEMC | Dashboard</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{asset('plugins/fontawesome-free/css/all.min.css')}}">


    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Tempusdominus Bootstrap 4 -->
    <link rel="stylesheet" href="{{asset('plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css')}}">
    <!-- iCheck -->
    <link rel="stylesheet" href="{{asset('plugins/icheck-bootstrap/icheck-bootstrap.min.css')}}">
    <!-- JQVMap -->
    <link rel="stylesheet" href="{{asset('plugins/jqvmap/jqvmap.min.css')}}">
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

    <link rel="stylesheet" href="{{asset('plugins/bootstrap-datepicker/css/bootstrap-datepicker.min.css')}}">

    <link rel="stylesheet" href="{{asset('plugins/select2/css/select2.min.css')}}">
    <link rel="stylesheet" href="{{asset('plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css')}}">
    <link rel="stylesheet" href="{{asset('plugins/icheck-bootstrap/icheck-bootstrap.min.css')}}">
    @yield('css')
    <style>
        .form-group.required .control-label:after {
            content: "*";
            color: red;
        }
    </style>
</head>

<body class="hold-transition sidebar-mini layout-fixed">
    <div class="wrapper">

        {{--<!-- Preloader -->--}}
        <div class="preloader flex-column justify-content-center align-items-center">
        <img class="animation__shake" src="{{asset('images/armoiries-bon.png')}}" alt="Logo" height="60" width="60">
        </div>

        <!-- Navbar -->
        <nav class="main-header navbar navbar-expand navbar-primary navbar-light text-white">
            <!-- Left navbar links -->
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
                </li>
                <li class="nav-item d-none d-sm-inline-block">
                    <a href="{{route('dashboard')}}" class="nav-link">Accueil</a>
                </li>
                <li class="nav-item d-none d-sm-inline-block">
                    <a href="#" class="nav-link">Aide</a>
                </li>
            </ul>

            <!-- Right navbar links -->
            <ul class="navbar-nav ml-auto">
                <!-- Navbar Search -->


                <li class="nav-item">
                    <a class="nav-link" data-widget="fullscreen" href="#" role="button">
                        <i class="fas fa-expand-arrows-alt"></i>
                    </a>
                </li>


                @guest
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('login') }}">{{ __('se connecter') }}</a>
                </li>
                @else
                <li class="nav-item dropdown">
                    <a id="navbarDropdown" class="nav-link dropdown-toggle font-weight-bold" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre style="font-family: 'Kotta One'">
                        <strong class="text-md font-italic">{{\App\Models\User::authUserProfil()->nom}}</strong>
                        |&nbsp;{{ Auth::user()->structure->sigle_struct }} |&nbsp;<span class="caret">{{ Auth::user()->name }}</span>
                        <i class="fa fa-user fa-fw" aria-hidden="true"></i>&nbsp; </a>

                    <div class="dropdown-menu dropdown-menu-right bg-cyan rounded" aria-labelledby="navbarDropdown">
                        <div class="text-info font-weight-bold">
                            <a class="dropdown-item text-dark font-weight-bold rounded" href="{{route('changePassword')}}"><i class="fa fa-pen fa-fw " aria-hidden="true"></i>&nbsp; Changer le mot de passe</a>
                            <a class="dropdown-item text-dark font-weight-bold rounded" href="{{route('user.edit',[Auth::user()->id,'option'=>'profil'])}}"><i class="fa fa-user-edit fa-fw " aria-hidden="true"></i>&nbsp; Changer profil</a>
                            {{--<a class="dropdown-item text-dark rounded" href="#"><i class="fa fa-home fa-fw" aria-hidden="true"></i>&nbsp; Mon Compte</a>--}}
                            <div class="dropdown-divider"></div>
                        </div>
                        <a class="dropdown-item text-dark font-weight-bold btn btn-outline-dark rounded " href="{{ route('logout') }}" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">&nbsp;<i class="fa fa-lock fa-fw " aria-hidden="true"></i>{{__('Deconnexion') }}
                        </a>

                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>

                    </div>
                </li>
                @endguest
            </ul>


        </nav>
        <!-- /.navbar -->

        <!-- Main Sidebar Container -->
        
        @include('layouts.menu')

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper" style="height: auto;">
            <!-- Content Header (Page header) -->
            <div class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1 class="m-0">@yield('titre')</h1>
                        </div><!-- /.col -->
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Accueil</a></li>
                                @yield('breadcrumb')
                            </ol>
                        </div><!-- /.col -->
                    </div><!-- /.row -->
                </div><!-- /.container-fluid -->
            </div>

            <!-- Main content -->

            <section class="content">
                <div class="container-fluid">
                    <main>
                        @yield('main')

                    </main>
                </div><!-- /.container-fluid -->
            </section>
            <!-- /.content-header -->

        </div>
        <!-- /.content-wrapper -->
        <footer class="main-footer text-center  mt-5" style="background-color:#002a40">
            <strong>Copyright &copy; 2021 <a href="#">MEMC BURKINA</a>.</strong>
            Tous droits Réservés..
            <div class="float-right d-none d-sm-inline-block">
                <b>Version</b> 1.0
            </div>
        </footer>

        <!-- Control Sidebar -->
        <aside class="control-sidebar control-sidebar-dark">
            <!-- Control sidebar content goes here -->
        </aside>
        <!-- /.control-sidebar -->
    </div>
    <!-- ./wrapper -->

    <!-- jQuery -->
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
    <!-- Sparkline -->
    <script src="{{asset('plugins/sparklines/sparkline.js')}}"></script>
    <!-- JQVMap -->
    <script src="{{asset('plugins/jqvmap/jquery.vmap.min.js')}}"></script>
    <script src="{{asset('plugins/jqvmap/maps/jquery.vmap.usa.js')}}"></script>
    <!-- jQuery Knob Chart -->
    <script src="{{asset('plugins/jquery-knob/jquery.knob.min.js')}}"></script>
    <!-- daterangepicker -->
    <script src="{{asset('plugins/moment/moment.min.js')}}"></script>
    <script src="{{asset('plugins/daterangepicker/daterangepicker.js')}}"></script>
    <!-- Tempusdominus Bootstrap 4 -->
    <script src="{{asset('plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js')}}"></script>
    <!-- Summernote -->
    <script src="{{asset('plugins/summernote/summernote-bs4.min.js')}}"></script>
    <!-- overlayScrollbars -->
    <script src="{{asset('plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js')}}"></script>


    <!-- AdminLTE App -->
    <script src="{{asset('dist/js/adminlte.js')}}"></script>
    <!-- AdminLTE for demo purposes -->
    <script src="{{asset('dist/js/demo.js')}}"></script>





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

    <script type="text/javascript" charset="utf8" src="{{asset('plugins/bestdatatables/js/jquery.validate.min.js')}}"></script>
    <script type="text/javascript" charset="utf8" src="{{asset('plugins/bestdatatables/js/localization/messages_fr.min.js')}}"></script>

    <script type="text/javascript" charset="utf8" src="{{asset('plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js')}}"></script>
    <script type="text/javascript" charset="utf8" src="{{asset('plugins/select2/js/select2.full.min.js')}}"></script>


    <script src="{{ asset('js/datatable_configuration.js')}}"></script>
    <script src="{{ asset('js/sweetalert2.all.min.js')}}"></script>
    <script src="{{ asset('js/function.js')}}"></script>
    <script src="{{ asset('js/loader.js')}}"></script>
    @yield('scripts')

</body>

</html>