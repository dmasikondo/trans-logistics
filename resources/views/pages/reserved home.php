<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Transpartner Logistics</title>

    <!-- Fonts -->
    <link rel="stylesheet" href="/css/font-awesome.min.css">
    <link href="http://fonts.googleapis.com/css?family=Corben:bold" rel="stylesheet" type="text/css">
     <link href="http://fonts.googleapis.com/css?family=Nobile" rel="stylesheet" type="text/css">  
     <link rel="stylesheet" href="/font-awesome-4.6.3/css/font-awesome.min.css">  
<!--    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css" integrity="sha384-XdYbMnZ/QjLh6iI4ogqCTaIjrFk87ip+ekIjefZch0Y+PvJ8CDYtEs1ipDmPorQ+" crossorigin="anonymous">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Lato:100,300,400,700">-->

    <!-- Styles -->
   <link rel="stylesheet" href="/css/bootstrap.min.css"> 
   <link rel="stylesheet" href="/css/bootstrap.icon-large.min.css">
	<link rel="stylesheet" href="/css/dropzone.css">
    <link rel="stylesheet" href="/js/select2-4.0.2/dist/css/select2.min.css">
    <link rel="stylesheet" href="/css/sweetalert.css">
    <link rel="stylesheet" href="/js/jquery-ui-1.11.2/jquery-ui.min.css">
    <link rel="stylesheet" href="/js/jquery-ui-1.11.2/jquery-ui.theme.min.css">
  <!--  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">-->
    {{-- <link href="{{ elixir('css/app.css') }}" rel="stylesheet"> --}}

    <style>
.social{
  text-align: right;
}

.social-share{
 display: inline-block;
 list-style: none;
 padding: 0;
 margin: 0;
}

ul.social-share li {
  display: inline-block;
}

ul.social-share li a {
  display: inline-block;
  color: #fff;
  background: #404040;
  width: 25px;
  height: 25px;
  line-height: 25px;
  text-align: center;
  border-radius: 2px;
}

ul.social-share li a:hover {
  background: #c52d2f;
  color: #fff;
}

.search i {
  color: #fff;
}

input.search-form{
  background: transparent;
  border: 0 none;
  width: 60px;
  padding: 0 10px;
  color: #FFF;
  -webkit-transition: all 400ms;
  -moz-transition: all 400ms;
  -ms-transition: all 400ms;
  -o-transition: all 400ms;
  transition: all 400ms;
}

input.search-form::-webkit-input-placeholder{
  color: transparent;
}

input.search-form:hover::-webkit-input-placeholder {
  color: #fff;
}

input.search-form:hover {
  width: 180px;
}
.animation.animated-item-1 {
  -webkit-animation: fadeInUp 3000ms linear 3000ms both;
  -moz-animation: fadeInUp 3000ms linear 3000ms both;
  -o-animation: fadeInUp 3000ms linear 3000ms both;
  -ms-animation: fadeInUp 3000ms linear 3000ms both;
  animation: fadeInUp 3000ms linear 3000ms both;
}
	
		body{background:#8DC975 url(img/green_grass.jpg) repeat 0 0;}
		h1, h2, h3, h4, h5, h6 {
			font-family: 'Corben', Georgia, Times, serif;
			/* text-shadow: 1px 1px 1px #ccc;*/
		}
		p, div {
			font-family: 'Nobile', Helvetica, Arial, sans-serif;
		}
		.container{ opacity:0.92;}
		.jumbotron{ background: #DEEFDF;}
		.jumbotron p{ font-size:1.145em;}
    </style>
    <!-- JavaScripts -->
    <script src="/js/jquery-1.11.3.js"></script>
    <script src="/js/bootstrap.min.js"></script>
    {{-- <script src="{{ elixir('js/app.js') }}"></script> --}}
	  <script src="/js/sweetalert.min.js"></script>
      <script src="/js/dropzone.js"></script>
      <script src="/js/select2-4.0.2/dist/js/select2.full.min.js"></script>
      <script src="/js/sweetalert.min.js"></script>
      <script src="/js/jquery-ui-1.11.2/jquery-ui.min.js"></script>
      <script>
              Dropzone.options.addProfiledocForm = {
                  paraName: 'file',
                  maxFilesize: 1.5,
                  acceptedFiles: '.jpg, .png, .bmp, .gif, .docx, .pdf, .rtf'
              };
      </script> 
      <style>
	  .dropzone{border: dashed 1px #13370A;}
	  </style>    
</head>
<body id="app-layout">
   <header id="header">
        <div class="top-bar">
            <div class="container">
                <div class="row">
                    <div class="col-sm-4 col-xs-5">
                        <div class="top-number"><p>
                        <i class="fa fa-phone-square"></i>+263 772 930 514</p>
                         <p><i class="fa fa-tty"></i>+263 4 293 3951
                          </p></div>
                    </div>
                    <div class="col-sm-4 col-xs-3">
                    	<button class="btn btn-primary animation animated-item-1"><h4>Your Preferred Logistics Partner</h4></button>
                    </div>
                    <div class="col-sm-4 col-xs-4">
                       <div class="social">
                            <ul class="social-share">
                                <li><a href="#"><i class="fa fa-facebook"></i></a></li>
                                <li><a href="#"><i class="fa fa-twitter"></i></a></li>
                                <li><a href="#"><i class="fa fa-linkedin"></i></a></li> 
                            </ul>
                            <div class="search">
                                <form role="form">
                                    <input type="text" class="search-form" autocomplete="off" placeholder="Search">
                                    <i class="fa fa-search"></i>
                                </form>
                           </div>
                       </div>
                    </div>
                </div>
            </div><!--/.container-->
        </div><!--/.top-bar-->
     </header>
    <nav class="navbar navbar-default navbar-static-top">
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
                <a class="navbar-brand" href="{{ url('/') }}">
                <img src="/img/tpl logo.png" alt="logo" style="top:30px;" width="40" height="40"></a>
                    <!--Transpartner<br>Logistics-->
                </a>
            </div>

            <div class="collapse navbar-collapse" id="app-navbar-collapse">
                <!-- Left Side Of Navbar -->
                <ul class="nav navbar-nav">
                    <li><a href="{{ url('/home') }}">Home</a></li>
                    <li><a href="{{ url('/consultancy') }}">Consultancy</a></li>
                    <li><a href="{{ url('/test') }}">Test</a></li>
                </ul>

                <!-- Right Side Of Navbar -->
                <ul class="nav navbar-nav navbar-right">
                    <!-- Authentication Links -->
                    @if (Auth::guest())
                        <li><a href="{{ url('/login') }}">Login</a></li>
                        <li><a href="{{ url('/register') }}">Register</a></li>
                    @else
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                {{ Auth::user()->username }} <span class="caret"></span>
                            </a>

                            <ul class="dropdown-menu" role="menu">
                                <li><a href="{{ url('/logout') }}"><i class="fa fa-btn fa-sign-out"></i>Logout</a></li>
                            </ul>
                        </li>
                    @endif
                </ul>
            </div>
        </div>
    </nav>

 @include('partials.flash')

    @yield('content')
</div>
   
</body>
</html>
