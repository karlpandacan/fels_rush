<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Framgia E-Learning System - @yield('title')</title>

        <!-- Fonts -->
        <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.4.0/css/font-awesome.min.css" rel='stylesheet' type='text/css'>
        <link href="https://fonts.googleapis.com/css?family=Lato:100,300,400,700" rel='stylesheet' type='text/css'>

        <!-- Styles -->
        {{-- <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet"> --}}
        {{-- <link href="{{ elixir('css/app.css') }}" rel="stylesheet"> --}}
        <link href="{{ url('css/theme.min.css') }}" rel="stylesheet">
        <style>
            body {
                font-family: 'Lato';
            }

            .fa-btn {
                margin-right: 6px;
            }
            a:hover {
                text-decoration: none;
            }
        </style>
    </head>
    <body id="app-layout">
        <nav class="navbar navbar-default navbar-fixed-top">
            <div class="container-fluid">
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
                                <li class="{{ Request::is('users*') ? 'active' : '' }}"><a href="{{ url('/users') }}">Users</a></li>
                            @if(!auth()->user()->isAdmin())
                                <li class="{{ Request::is('sets*') ? 'active' : '' }}"><a href="{{ url('/sets') }}">Sets</a></li>
                            @endif
                            @if(auth()->user()->isAdmin())
                                 <li class="{{ Request::is('categories*') ? 'active' : '' }}"><a href="{{ url('/categories') }}">Categories</a></li>
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
                                <form action="{{ url('/users/search') }}" method="GET" class="navbar-form" role="search">
                                    <div class="input-group">
                                    <input type="text" class="form-control" placeholder="Search" name="q" id="q">
                                    <div class="input-group-btn">
                                        <button class="btn btn-default" type="submit"><i class="glyphicon glyphicon-search"></i></button>
                                    </div>
                                        </div>
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
        <div class="container" style="margin-top:50px;">
            <div class="row">
                @yield('content')
            </div>
        </div>
        <!-- JavaScripts -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
        {{-- <script src="{{ elixir('js/app.js') }}"></script> --}}
    </body>
</html>
