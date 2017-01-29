<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="">
    <meta name="author" content="">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ trans('page.page_title') }}</title>


    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" />


    <link href="/css/app.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-2.2.4.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>

    <![endif]-->

    <script>
        var init = [];
    </script>

</head>

<body>
    <nav class="navbar navbar-inverse navbar-fixed-top">
        <div class="container">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="{{ url('/') }}">
                    {{ trans('page.title') }}
                </a>
            </div>
            <div id="navbar" class="navbar-collapse collapse">
                <ul class="nav navbar-nav">
                    <li class="{{ Route::current()->uri=='/' ? 'active': '' }}"><a href="#">{{ trans('page.home') }}</a></li>
                    <li><a href="#about">{{ trans('page.articles') }}</a></li>
                    <li><a href="#about">{{ trans('page.products') }}</a></li>
                    @if (Auth::check())

                    @if (Auth::user()->is_admin)
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">{{ trans('page.manage') }} <span class="caret"></span></a>
                            <ul class="dropdown-menu">
                                <li><a href="{{ url('content') }}">{{ trans('page.content_manage') }}</a></li>
                                <li><a href="#about">{{ trans('page.products_manage') }}</a></li>
                                <li><a href="#about">{{ trans('page.users_manage') }}</a></li>
                                <li><a href="#about">{{ trans('page.orders_manage') }}</a></li>
                                <li role="separator" class="divider"></li>
                                <li class="dropdown-header">{{ trans('page.category_manage') }}</li>
                                <li><a href="{{ url('category/article') }}">   - {{ trans('page.articles') }}</a></li>
                                <li><a href="{{ url('category/product') }}">   - {{ trans('page.products') }}</a></li>
                            </ul>
                        </li>

                    @else
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><span class="glyphicon glyphicon-shopping-cart"></span> <span class="caret"></span></a>
                            <ul class="dropdown-menu">
                                <li><a href="#about">{{ trans('page.my_cart') }}</a></li>
                                <li><a href="#about">{{ trans('page.my_orders') }}</a></li>
                            </ul>
                        </li>
                    @endif
                    @endif
                </ul>
                <ul class="nav navbar-nav navbar-right">
                    <!-- Authentication Links -->
                    @if (Auth::guest())
                        <li><a href="{{ url('/login') }}">{{ trans('auth.login') }}</a></li>
                        <li><a href="{{ url('/register') }}">{{ trans('auth.register') }}</a></li>
                    @else
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                {{ Auth::user()->name }} <span class="caret"></span>
                            </a>

                            <ul class="dropdown-menu" role="menu">
                                <li><a href="#about">{{ trans('auth.change_password') }}</a></li>
                                <li>
                                    <a href="{{ url('/logout') }}"
                                       onclick="event.preventDefault();
                                                         document.getElementById('logout-form').submit();">
                                        {{ trans('auth.logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ url('/logout') }}" method="POST" style="display: none;">
                                        {{ csrf_field() }}
                                    </form>
                                </li>
                            </ul>
                        </li>
                    @endif
                </ul>
            </div><!--/.nav-collapse -->
        </div>
    </nav>


    <div class="container theme-showcase" role="main">
        @yield('content')
    </div>

    {{--<script src="/js/app.js"></script>--}}
    <script>
        $(document).ready(function(){
            for(var funIndex in init) {
                init[funIndex]();
            }
        });
    </script>
</body>
</html>
