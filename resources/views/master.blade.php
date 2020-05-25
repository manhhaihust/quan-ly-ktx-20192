<!DOCTYPE html>
<html class="no-js" lang="">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="x-ua-compatible" content="ie=edge">
        <title>@yield('title')</title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <link rel="shortcut icon" href="{{asset('img/image.png')}}">   
        <link rel="stylesheet" href="{{asset('css/master.css')}}">
        <link rel="stylesheet" href="{{asset('css/neon-core.css')}}">
        <link rel="stylesheet" href="{{asset('css/bootstrap.css')}}">
        <link rel="stylesheet" href="{{asset('css/neon-theme.css')}}">
        <link rel="stylesheet" href="{{asset('css/neon-forms.css')}}">
        <link rel="stylesheet" href="{{asset('css/custom.css')}}">
        <link rel="stylesheet" href="{{asset('css/black.css')}}">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <script src="js/jquery-1.11.3.min.js"></script>

    </head>
    <body class="page-body skin-black">
        <div class="page-container">
            <div class="sidebar-menu" style="min-height: 720px">
              <header class="logo-env">
                <div class="logo"><img src="img/logo.png" style="max-height: 60px"></div>
                <div class="sidebar-collapse" style="">
                    <a href="#" class="sidebar-collapse-icon with-animation">
                        <i class="entypo-menu"></i>
                    </a>
                </div>
                <div class="sidebar-mobile-menu visible-xs">
                    <a href="#" class="with-animation">
                        <i class="entypo-menu fa fa-bars"></i>
                    </a>
                </div>
              </header>
              <div style="border-top:1px solid rgba(69, 74, 84, 0.7);"></div>
                @if(Auth::check())
                    @if(Auth::user()->ltk=="sinhvien")
                        @include('sinhvien_main_menu')
                    @elseif(Auth::user()->ltk=="quanly")
                        @include('quanly_main_menu')
                    @elseif(Auth::user()->ltk=="admin")
                        @include('admin_main_menu')
                    @else
                        @return view('auth.login');
                    @endif
                @endif
            </div>
            <div class="main-content">
                <div class="row">
                    <div class="col-md-12 col-sm-12 clearfix" style="text-align:center;">
                        <h2 style="font-weight:200; margin:0px;">Ký túc xá Đại học Bách khoa Hà Nội</h2>
                    </div>
                <div class="col-md-12 col-sm-12 clearfix ">
                <ul class="list-inline links-list pull-right">
                    <li class="dropdown language-selector">
                        <i class="entypo-globe"></i> Xin chào
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" data-close-others="true">
                            <i class="entypo-user"></i>
                            @if(Auth::check())
                                {{Auth::user()->name}}
                            @else {{"Bạn chưa đăng nhập"}}
                            @endif
                        </a>
                    </li>
                    <li>
                        <a href="{{route('logout')}}">[ Đăng xuất ] <i class="entypo-logout right fa fa-sign-out"></i></a>
                    </li>
                </ul>
                </div>
                </div>
                @yield('content')
            </div>
        </div>
    </body>
</html>