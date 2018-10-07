<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="UTF-8">
    <title>{{config('app.name')}} @yield('title')</title>
    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link rel="shortcut icon" href="{{asset('favicon.ico')}}"/>
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <!-- Ionicons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">

    <!-- Theme style -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/admin-lte/2.4.2/css/AdminLTE.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/admin-lte/2.4.2/css/skins/_all-skins.min.css">

    <!-- iCheck -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/iCheck/1.0.2/skins/square/_all.css">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.min.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.37/css/bootstrap-datetimepicker.min.css"
          rel="stylesheet">
    <link rel="stylesheet"
          href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-colorpicker/2.5.2/css/bootstrap-colorpicker.min.css"/>

@yield('before_css')

<!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    @yield('css')
</head>

<body class="skin-green-white layout-top-nav" style="height: auto; min-height: 100%;">
@if (!Auth::guest())
    <div class="wrapper">
        <!-- Main Header -->
        <header class="main-header page-header-top">
            <nav class="navbar navbar-static-top">
                <div class="container">
                    <div class="navbar-header">
                        <a href="{{route('home')}}" class="navbar-brand">
                            <img src="/images/logo-default.png" alt="" class="logo-default">
                        </a>
                        <button type="button" style="color: gray" class="navbar-toggle" data-toggle="collapse"
                                data-target="#navbar-collapse" aria-expanded="true">
                            <i class="fa fa-bars"></i>
                        </button>
                    </div>
                    <!-- Navbar Right Menu -->
                    <div class="navbar-custom-menu">
                        <ul class="nav navbar-nav">
                            <!-- User Account Menu -->
                            <li class="dropdown user user-menu">
                                <!-- Menu Toggle Button -->
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                    <!-- The user image in the navbar-->
                                    <img src="{!! get_avatar(Auth::user()) !!}"
                                         class="user-image" alt="User Image"/>
                                    <!-- hidden-xs hides the username on small devices so only the image appears. -->
                                    <span class="hidden-xs">{!! Auth::user()->name !!}</span>
                                </a>
                                <ul class="dropdown-menu">
                                    <!-- The user image in the menu -->
                                    <li class="user-header">
                                        <img src="{!! get_avatar(Auth::user()) !!}"
                                             class="img-circle" alt="User Image"/>
                                        <p>
                                            {!! Auth::user()->name !!}
                                            <small>Member since {!! Auth::user()->created_at->format('M. Y') !!}</small>
                                        </p>
                                    </li>
                                    <!-- Menu Footer-->
                                    <li class="user-footer">
                                        <div class="pull-left">
                                            <a href="{!! route('profile.index') !!}" class="btn btn-default btn-flat">Profile</a>
                                        </div>
                                        <div class="pull-right">
                                            <a href="{!! url('/logout') !!}" class="btn btn-default btn-flat"
                                               onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                                Sign out
                                            </a>
                                            <form id="logout-form" action="{{ url('/logout') }}" method="POST"
                                                  style="display: none;">
                                                {{ csrf_field() }}
                                            </form>
                                        </div>
                                    </li>
                                </ul>
                            </li>
                            @can('campaigns.create')
                                <li class="btn-green">
                                    <a href="{!! route('campaigns.create') !!}">Reminder Now</a>
                                </li>
                            @endcan
                        </ul>
                    </div>
                    <!-- /.navbar-custom-menu -->
                </div>
                <!-- /.container-fluid -->
            </nav>
        </header>
        <header class="main-header page-header-menu">
            <nav class="navbar navbar-static-top">
                <div class="container">

                    <!-- Collect the nav links, forms, and other content for toggling -->
                    <div class="collapse navbar-collapse pull-left" id="navbar-collapse" aria-expanded="true">
                        <ul class="nav navbar-nav">
                            @include('layouts.menu')
                        </ul>
                    </div>
                    <!-- /.navbar-collapse -->
                </div>
                <!-- /.container-fluid -->
            </nav>
        </header>

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper" id="app">
            @yield('content')
        </div>

        @include('layouts.footer')

    </div>
@else
    <nav class="navbar navbar-default navbar-static-top">
        <div class="container">
            <div class="navbar-header">

                <!-- Collapsed Hamburger -->
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse"
                        data-target="#app-navbar-collapse">
                    <span class="sr-only">Toggle Navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>

                <!-- Branding Image -->
                <a class="navbar-brand" href="{!! url('/') !!}">
                    {{ config('app.name') }}
                </a>
            </div>

            <div class="collapse navbar-collapse" id="app-navbar-collapse">
                <!-- Left Side Of Navbar -->
                <ul class="nav navbar-nav">
                    <li><a href="{!! url('/home') !!}">Home</a></li>
                </ul>

                <!-- Right Side Of Navbar -->
                <ul class="nav navbar-nav navbar-right">
                    <!-- Authentication Links -->
                    <li><a href="{!! url('/login') !!}">Login</a></li>
                </ul>
            </div>
        </div>
    </nav>

    <div id="page-content-wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    @include('flash::message')
                    @yield('content')
                </div>
            </div>
        </div>
    </div>
@endif


<!-- Scripts -->
<script src="https://js.stripe.com/v3/"></script>
<script src="{{ asset('js/app.js') }}"></script>


<!-- AdminLTE App -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/admin-lte/2.4.2/js/adminlte.min.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/iCheck/1.0.2/icheck.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.9.0/moment.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.37/js/bootstrap-datetimepicker.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-colorpicker/2.5.2/js/bootstrap-colorpicker.min.js"></script>

@yield('scripts')
</body>
</html>
