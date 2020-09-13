<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Transpartner Logistics :: @yield('title')</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
      <script src="/js/wow.min.js"></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">


    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">  
    <link rel="stylesheet" href="/css/custom.css">   
</head>
<body>
    <div id="app">
        <div class="top-bar">
            <div class="container">
                <div class="row" style=" padding-top:0;">
                    <div class="col-sm-8">
                        <div class="top-number"><p>
                        <i class="fa fa-whatsapp"></i>  +263 772 930 514
                        &nbsp;
                        <i class="fa fa-phone-square"></i>  +263 732 930 514
                        &nbsp;
                        <i class="fa fa-phone-square"></i>  +263 718 930 514
                        &nbsp;
                        <i class="fa fa-tty"></i>  +263 4 691 153
                        </p>
                        </div>
                    </div>
                    <div class="col-sm-4">
                       <div class="social">
                            <ul class="social-share">
                                <li><a href="https://www.facebook.com/transpartnerlogisticsZim"><i class="fa fa-facebook"></i></a></li>
                                <li><a href="https://twitter.com/TranspartnerLog"><i class="fa fa-twitter"></i></a></li>
                                <li><a href="https://www.linkedin.com/company/transpartner-logistics-company?trk=biz-companies-cym"><i class="fa fa-linkedin"></i></a></li>
                            </ul>
                       </div>
                    </div>
                </div>
            </div><!--/.container-->
        </div><!--/.top-bar-->


        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                   <img src="/images/transpartner logo.png" alt="Transpartner Logistics Logo">
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">
                        <li class="nav-item" {{(Request::is('about-us') ? 'class=active' : '')}}><a href="{{ url('/about-us') }}" class="nav-link">About Us</a></li> 
                        <li class="nav-item" {{(Request::is('contact-us') ? 'class=active' : '')}}><a href="{{url('/contact-us') }}" class="nav-link">Contact Us</a></li>
                        <li class="nav-item" {{(Request::is('contact-us') ? 'class=active' : '')}}><a href="{{url('/contact-us') }}" class="nav-link">Services</a></li>
                        <li class="nav-item" {{(Request::is('faq') ? 'class=active' : '')}}><a href="{{url('#/faq') }}" class="nav-link">FAQ ?</a></li>
                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                        @guest
                            <li class="nav-item">
                                <a class="nav-link" href="#{{ route('login') }}">{{ __('Login') }}</a>
                            </li>
                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="#{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->organisation }} <span class="caret"></span>
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

                   
            @yield('content')
            @yield('footer')
            @include('inc.footer')
    </div>
</body>
</html>
