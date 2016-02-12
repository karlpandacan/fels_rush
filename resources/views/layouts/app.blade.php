<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Framgia E-Learning System - @yield('title')</title>

        <link rel="icon" href="icon.png" sizes="any" type="image/svg+xml">
        <!-- Fonts -->
        <link href="{{ url('css/font-awesome.min.css') }}" rel='stylesheet' type='text/css'>
        <link href="{{ url('css/font.css') }}" rel='stylesheet' type='text/css'>

        <!-- Styles -->
        <link href="{{ url('css/app.css') }}" rel="stylesheet">
        <style>
            body {
                font-family: 'Lato';
            }

            .fa-btn {
                margin-right: 6px;
            }
            .btn-custom {
                display: inline-block;
                vertical-align: middle;
            }
            a:hover {
                text-decoration: none;
                color: #ffffff;
            }
            td a:hover {
                text-decoration: none;
                color: #e8d069;
            }
            td a:link {
                text-decoration: none;
                color: #ffffff;
            }
            td a:visited  {
                text-decoration: none;
                color: #ffffff;
            }
        </style>
    </head>
    <body id="app-layout">
        <nav class="navbar navbar-default navbar-fixed-top">
            <div class="container">
                 <div class="navbar-header">
                    <!-- Collapsed Hamburger -->
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse">
                        <span class="sr-only">Toggle Navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>

                    <!-- Branding Image -->
                    <a class="navbar-brand" href="{{ url('/home') }}">
                        Framgia E-Learning System
                    </a>
                </div>

                <div class="collapse navbar-collapse" id="app-navbar-collapse">
                    <!-- Left Side Of Navbar -->
                    <ul class="nav navbar-nav">
                        <li class="{{ Request::is('home') ? 'active' : '' }}"><a href="{{ url('/home') }}">Home</a></li>
                        @if (!auth()->guest())
                                <li class="{{ Request::is('users*') ? 'active' : '' }}">
                                    <a href="{{ url('/users') }}">Users</a>
                                </li>
                            @if(!auth()->user()->isAdmin())
                                <li class="{{ Request::is('studies*') ? 'active' : '' }}"><a href="{{ url('/studies') }}">Studying</a></li>
                                <li class="dropdown-toggle {{ Request::is('sets*') ? 'active' : '' }}">
                                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Sets <span class="caret"></span></a>
                                    <ul class="dropdown-menu">
                                        <li><a href="{{ url('/sets/create') }}">Create New Set</a></li>
                                        <li><a href="{{ url('/sets') }}">My Sets</a></li>
                                        <li><a href="{{ url('/sets/recommended') }}">Recommended Sets</a></li>
                                        <li><a href="{{ url('/sets/search?') }}">Search Sets</a></li>
                                    </ul>
                                </li>
                            @else
                                <li class="dropdown-toggle {{ Request::is('sets*') ? 'active' : '' }}">
                                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Sets <span class="caret"></span></a>
                                    <ul class="dropdown-menu">
                                        <li><a href="{{ url('/sets/create') }}">Create New Set</a></li>
                                        <li><a href="{{ url('/sets') }}">Manage Sets</a></li>
                                        <li><a href="{{ url('/sets/recommended') }}">Recommended Sets</a></li>
                                        <li><a href="{{ url('/sets/search?') }}">Search Sets</a></li>
                                    </ul>
                                </li>
                            @endif
                        @endif
                    </ul>
                    <!-- Right Side Of Navbar -->
                    <ul class="nav navbar-nav navbar-right">
                        <!-- Authentication Links -->
                        @if (auth()->guest())
                            <li><a href="{{ url('/login') }}">Login</a></li>
                            <li><a href="{{ url('/register') }}">Register</a></li>
                        @else
                            <li>
                                <form class="navbar-form" role="search">
                                    <div class="input-group">
                                        <input type="text" class="form-control" aria-label="..." placeholder="Search" id="q">
                                        <div class="input-group-btn">
                                            <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                Users <span class="caret"></span>
                                            </button>
                                            <ul class="dropdown-menu dropdown-menu-right">
                                                <li>
                                                    <a href="{{ url('/users/search') }}" onclick="location.href=this.href+'?q='+$('#q').val();return false;">
                                                        Users
                                                    </a>
                                                </li>
                                                <li>
                                                    <a href="{{ url('/sets/search') }}" onclick="location.href=this.href+'?q='+$('#q').val();return false;">
                                                        Sets
                                                    </a>
                                                </li>
                                                <li>
                                                    <a href="{{ url('/studies') }}" onclick="location.href=this.href+'?q='+$('#q').val();return false;">
                                                        Studying
                                                    </a>
                                                </li>
                                            </ul>
                                        </div><!-- /btn-group -->
                                    </div><!-- /input-group -->
                                </form>
                            </li>
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                    {{ auth()->user()->name }} <span class="caret"></span>
                                </a>

                                <ul class="dropdown-menu" role="menu">
                                    <li><a href="{{ url('/users/'.auth()->user()->id) }}"><i class="fa fa-btn fa-user"></i>Profile</a></li>
                                    <li><a href="{{ url('/logout') }}"><i class="fa fa-btn fa-sign-out"></i>Logout</a></li>
                                </ul>
                            </li>
                        @endif
                    </ul>
                </div>
            </div>
        </nav>
        <div class="container" style="margin-top:60px;">
            <div class="row">
                @yield('content')
            </div>
        </div>
        <!-- JavaScripts -->
        <script src="{{ url('js/jquery-2.2.0.min.js') }}"></script>
        <script src="{{ url('js/bootstrap.min.js') }}"></script>
        {{-- <script src="{{ elixir('js/app.js') }}"></script> --}}
    </body>
</html>
