<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title') - bRecipes</title>

    <!-- Styles -->
    <link href="{{ asset('css/bootstrap/bootstrap.css') }}" rel="stylesheet">
    <link href="{{ asset('css/side.css') }}" rel="stylesheet">
    <link href="{{ asset('jquery_ui/jquery-ui.css') }}" rel="stylesheet">
    <link href="{{ asset('css/AdminLTE.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/skins/skin-blue.min.css') }}" rel="stylesheet">
    <script src="https://use.fontawesome.com/486ca9e286.js"></script>
    <script src="{{ asset('ckeditor/ckeditor.js') }}"></script>
    </head>
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">
<!-- Main Header -->
<header class="main-header">

    <!-- Logo -->
    <a href="{{ url('/home') }}" class="logo">
        <!-- mini logo for sidebar mini 50x50 pixels -->
        <span class="logo-mini"><i class="fa fa-cutlery" aria-hidden="true"></i><b> bR</b></span>
        <!-- logo for regular state and mobile devices -->
        <span class="logo-lg"><i class="fa fa-cutlery" aria-hidden="true"></i>  b<b>Recipes</b></span>
    </a>

    <!-- Header Navbar -->
    <nav class="navbar navbar-static-top" role="navigation">
        <!-- Sidebar toggle button-->
        <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
            <span class="sr-only">Toggle navigation</span>
        </a>
        <!-- Navbar Right Menu -->
        <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">
                <!-- Control Sidebar Toggle Button -->
                <li>
                  <!-- Authentication Links -->
                   @if (Auth::guest())
                    <a href="{{ route('login') }}">Вход</a>
                </li>
                <li>
                    <a href="{{ route('register') }}">Регистрация</a>
                   @else
                    <a href="{{ route('logout') }}"
                        onclick="event.preventDefault();
                        document.getElementById('logout-form').submit();">
                          <i class="fa fa-sign-out" aria-hidden="true"></i> Выход
                    </a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">{{ csrf_field() }}</form>
                   @endif
                </li>
            </ul>
        </div>
    </nav>
</header>
    @if(Auth::check())
        <aside class="main-sidebar">
            <!-- sidebar: style can be found in sidebar.less -->
            <section class="sidebar">
                <!-- Sidebar Menu -->
                <ul class="sidebar-menu">
                    <li class="header text-center">МЕНЮ</li>
                    <!-- Optionally, you can add icons to the links -->
                    <li class="{{ Request::segment(2) == 'recipe' ? 'active' : '' }}"><a href="{{url("home/recipe")}}"><i class="fa fa-book"></i> <span>Мои рецепты</span></a></li>
                    <li class="{{ Request::segment(2) == 'menu' ? 'active' : '' }}"><a href="{{url("home/menu")}}"><i class="fa fa-sliders"></i> <span>Мои меню</span></a></li>
                    <li class="{{ Request::segment(2) == 'ingredient' ? 'active' : '' }}"><a href="{{url("home/ingredient")}}"><i class="fa fa-puzzle-piece"></i> <span>Ингредиенты</span></a></li>
                </ul>
                <!-- /.sidebar-menu -->
            </section>
            <!-- /.sidebar -->
        </aside>
    @endif

<!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Main content -->
        <section class="content">
            @include('alerts.alert')
            @yield('content')
        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
</div>
    <!-- Scripts -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="{{ asset('js/bootstrap/bootstrap.js') }}"></script>
    <script src="{{ asset('js/deleteform.js') }}"></script>
    <script src="{{ asset('js/ingredients.js') }}"></script>
    <script src="{{ asset('/jquery_ui/jquery-ui.js') }}"></script>
    <script src="{{ asset('js/app.min.js') }}"></script>
    <script>
        $(document).on("focus",['.auto-ing', '#search'].join(", "),function(e) {
            var way = $('#way').val();
            if(way=='recipe'){
                $(this).autocomplete({source: "{!!URL::route( 'recipe.autocomplete')!!}"});
            }
            else if(way=='ingredient'){
                $(this).autocomplete({source: "{!!URL::route( 'ingredient.autocomplete')!!}"});
            }
            else{
                $(this).autocomplete({source: "{!!URL::route( 'ingredient.autocomplete')!!}"});
            }
        });

    </script>
</body>
</html>
