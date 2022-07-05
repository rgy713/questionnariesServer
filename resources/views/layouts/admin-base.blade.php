<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <link rel="shortcut icon" href="/favicon.png" type="image/png">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Font-icon css-->
    <link rel="stylesheet" type="text/css"
          href="{{ asset('font-awesome-4.7.0/css/font-awesome.min.css') }}">
    <!-- Main CSS-->
    <link rel="stylesheet" type="text/css" href="{{ asset('css/main.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/common.css') }}">
    @yield('css')
</head>
<body class="app sidebar-mini rtl">
<!-- Navbar-->
<header class="app-header"><a class="app-header__logo" href="{{ route('admin.home')}}">{{__("PenguinConsultant")}}</a>
    <!-- Sidebar toggle button--><a class="app-sidebar__toggle" href="#" data-toggle="sidebar"
                                    aria-label="Hide Sidebar"></a>
    <!-- Navbar Right Menu-->
    <ul class="app-nav">
        <li class="app-search">
            <input class="app-search__input" type="search" placeholder="Search">
            <button class="app-search__button"><i class="fa fa-search"></i></button>
        </li>
        <!--Notification Menu-->
        <li class="dropdown"><a class="app-nav__item" href="#" data-toggle="dropdown" aria-label="Show notifications"><i
                        class="fa fa-bell-o fa-lg"></i></a>
            @yield('notification')
        </li>
        <!-- User Menu-->
        <li class="dropdown"><a class="app-nav__item" href="#" data-toggle="dropdown" aria-label="Open Profile Menu"><i
                        class="fa fa-user fa-lg"></i></a>
            <ul class="dropdown-menu settings-menu dropdown-menu-right">
                <li><a class="dropdown-item" href="{{ route('admin.profile') }}"><i class="fa fa-user fa-lg"></i> Profile</a></li>
                <li><a class="dropdown-item" href="{{ route('admin.logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();"><i class="fa fa-sign-out fa-lg"></i> Logout</a></li>
                <form id="logout-form" action="{{ route('admin.logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>
            </ul>
        </li>
    </ul>
</header>
<!-- Sidebar menu-->
<div class="app-sidebar__overlay" data-toggle="sidebar"></div>
<aside class="app-sidebar">
    <div class="app-sidebar__user"><img class="app-sidebar__user-avatar" src="{{asset('images/default-avatar.png')}}" alt="Admin Image">
        <div>
            <p class="app-sidebar__user-name">{{Auth::user()->name}}</p>
            <p class="app-sidebar__user-designation">
                @if(Auth::user()->administrator == 1)
                    Super
                @endif Administrator</p>
        </div>
    </div>
    <ul class="app-menu">
        <li><a class="app-menu__item {{$active=='home' ? ' active' : ''}}" href="{{ route('admin.home') }}"><i class="app-menu__icon fa fa-dashboard"></i><span class="app-menu__label">{{__('Dashboard')}}</span></a></li>
        <li><a class="app-menu__item {{$active=='assessment' ? ' active' : ''}}" href="{{ route('admin.assessment') }}"><i class="app-menu__icon fa fa-pie-chart"></i><span class="app-menu__label">{{__('Assessment List')}}</span></a></li>
        <li><a class="app-menu__item {{$active=='questionnaries' ? ' active' : ''}}" href="{{ route('admin.questionnaries') }}"><i class="app-menu__icon fa fa-pie-chart"></i><span class="app-menu__label">{{__('Questionnaries List')}}</span></a></li>
        <li><a class="app-menu__item {{$active=='questionType' ? ' active' : ''}}" href="{{ route('admin.questionType') }}"><i class="app-menu__icon fa fa-pie-chart"></i><span class="app-menu__label">{{__('Question Type List')}}</span></a></li>
        <li><a class="app-menu__item {{$active=='question' ? ' active' : ''}}" href="{{ route('admin.question') }}"><i class="app-menu__icon fa fa-pie-chart"></i><span class="app-menu__label">{{__('Question List')}}</span></a></li>
        @if (Auth::user()->administrator == 1)
            <li><a class="app-menu__item {{$active=='admin' ? ' active' : ''}}" href="{{ route('admin.admin') }}"><i class="app-menu__icon fa fa-pie-chart"></i><span class="app-menu__label">{{__('Administrator List')}}</span></a></li>
        @endif
    </ul>
</aside>
<main class="app-content">
    @yield('content')
</main>
<div id="modal-loading" style="background-image: url('{{ asset('images/loading.gif') }}');"></div>

<!-- Essential javascripts for application to work-->
<script src="{{ asset('js/jquery-3.2.1.min.js') }}"></script>
<script src="{{ asset('js/popper.min.js') }}"></script>
<script src="{{ asset('js/bootstrap.min.js') }}"></script>
<script src="{{ asset('js/main.js') }}"></script>
<!-- The javascript plugin to display page loading on top-->
<script src="{{ asset('js/plugins/pace.min.js') }}"></script>
<script src="{{ asset('js/plugins/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('js/plugins/dataTables.bootstrap.min.js') }}"></script>
<script src="{{ asset('js/plugins/sweetalert.min.js') }}"></script>
<script src="{{ asset('plugins/validator/jquery.validate.min.js') }}"></script>

<script src="{{ asset('js/common.js') }}"></script>
<!-- Page specific javascripts-->
@yield('js')

</body>
</html>