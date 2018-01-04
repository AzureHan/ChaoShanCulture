<!doctype html>
<html lang="zh-cmn-Hans">
<head>
	<meta charset="utf-8" />
	<link rel="icon" type="image/png" href="paperkit/assets/paper_img/favicon.ico">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
	
	<title> @yield('title') 潮汕文化研究 </title>

	<meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />
    <meta name="viewport" content="width=device-width" />
    
    <link href="{{asset('paperkit/bootstrap3/css/bootstrap.css')}}" rel="stylesheet" />

    <!-- Plugins CSS  -->
    <link href="{{asset('paperkit/assets/css/ct-pap')}}er.css" rel="stylesheet"/>
    <link href="{{asset('paperkit/assets/css/demo.css')}}" rel="stylesheet" />
    @yield('plugins_css')

    <!-- Level CSS -->
    <link href="{{asset('css/home.css')}}" rel="stylesheet" />
    @yield('level_css')

    <!-- Fonts and icons -->
    <!-- <link href="http://maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet"> -->
    <!-- <link href='http://fonts.googleapis.com/css?family=Montserrat' rel='stylesheet' type='text/css'> -->
    <!-- <link href='http://fonts.googleapis.com/css?family=Open+Sans:400,300' rel='stylesheet' type='text/css'> -->
      
</head>
<nav class="navbar navbar-ct-transparent" role="navigation-demo" id="demo-navbar">
  <div class="container">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navigation-example-2">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a href="{{ route('index') }}">
           <div class="logo-container">
                <div class="logo">
                    <img src="{{asset('paperkit/assets/paper_img/new_logo.png')}}" alt="Creative Tim Logo">
                </div>
                <div class="brand">
                    潮汕<br>文化研究
                </div>
            </div>
      </a>
    </div>

<!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="navigation-example-2">
      <ul class="nav navbar-nav navbar-right">
          <li>
            <a href="{{ route('categories.index') }}" class="btn btn-danger btn-simple"> 目录 </a>
          </li>
          <li>
            <a href="{{ route('videos.index') }}" class="btn btn-danger btn-simple"> 视频 </a>
          </li>
       </ul>
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-->
</nav>         


<div class="wrapper">
  
  @yield('content')

  <footer class="footer-demo section-dark">
      <div class="container">
          <nav class="pull-left">
              <ul>

                  <li>
                      <a href="http://www.creative-tim.com">
                          Creative Tim
                      </a>
                  </li>
                  <li>
                      <a href="http://blog.creative-tim.com">
                         Blog
                      </a>
                  </li>
                  <li>
                      <a href="http://www.creative-tim.com/product/rubik">
                          Licenses 
                      </a>
                  </li>
              </ul>
          </nav>
          <div class="copyright pull-right">
              &copy; 2015, made with <i class="fa fa-heart heart"></i> by Creative Tim
          </div>
      </div>
  </footer>

</div>

</body>

  <!--  Core JS -->
  <script src="{{asset('paperkit/assets/js/jquery-1.10.2.js')}}" type="text/javascript"></script>
  <script src="{{asset('paperkit/assets/js/jquery-ui-1.10.4.custom.min.js')}}" type="text/javascript"></script>
  <script src="{{asset('paperkit/bootstrap3/js/bootstrap.js')}}" type="text/javascript"></script>
  
  <!--  Plugins JS -->
  <script src="{{asset('paperkit/assets/js/ct-paper-checkbox.js')}}"></script>
  <script src="{{asset('paperkit/assets/js/ct-paper-radio.js')}}"></script>
  <script src="{{asset('paperkit/assets/js/bootstrap-select.js')}}"></script>
  <script src="{{asset('paperkit/assets/js/bootstrap-datepicker.js')}}"></script>
  @yield('plugins_js')
  
  <!--  Level JS -->
  <script src="{{asset('paperkit/assets/js/ct-paper.js')}}"></script>
  @yield('level_js')

</html>