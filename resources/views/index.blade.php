<!doctype html>
<html lang="zh-cmn-Hans">
<head>
	<meta charset="utf-8" />
	<link rel="icon" type="image/png" href="paperkit/assets/paper_img/favicon.ico">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
	
	<title> 潮汕文化研究 </title>

	<meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />
    <meta name="viewport" content="width=device-width" />
    
    <link href="{{asset('paperkit/bootstrap3/css/bootstrap.css')}}" rel="stylesheet" />
    <link href="{{asset('paperkit/assets/css/ct-pap')}}er.css" rel="stylesheet"/>
    <link href="{{asset('paperkit/assets/css/demo.css')}}" rel="stylesheet" /> 
        
    <!--     Fonts and icons     -->
    <link href="http://maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">
    <link href='http://fonts.googleapis.com/css?family=Montserrat' rel='stylesheet' type='text/css'>
    <link href='http://fonts.googleapis.com/css?family=Open+Sans:400,300' rel='stylesheet' type='text/css'>
      
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
      <a href="http://www.creative-tim.com">
           <div class="logo-container">
                <div class="logo">
                    <img src="{{asset('paperkit/assets/paper_img/new_logo.png')}}" alt="Creative Tim Logo">
                </div>
                <div class="brand">
                    Creative Tim
                </div>
            </div>
      </a>
    </div>

<!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="navigation-example-2">
      <ul class="nav navbar-nav navbar-right">
          <li>
            <a href="#" class="btn btn-danger btn-simple"> 目录 </a>
          </li>
       </ul>
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-->
</nav>         


<div class="wrapper">
    
    <div class="main">
        <div class="section">
          <div class="container tim-container">
            
            <div id="categories">
              @foreach($categories as $category)
              @if(!$loop->first)
              <hr>
              @endif
              <div class="category-posts">     
                <div class="tim-title">
                    <h3> {{ $category->title }} </h3>
                </div>
                <div class="row">
                    @foreach($category->posts->take(5) as $post)
                    <div class="col-md-12">
                      <a href="#" class="btn btn-simple"> {{ $post->title }} </a>
                    </div>
                    @endforeach
                </div>
              </div>
              @endforeach
            </div>
            <!-- end categories div -->

          </div>
        </div>
    </div>
    
</div>

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
<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title" id="myModalLabel">Modal title</h4>
      </div>
      <div class="modal-body">
        <p>Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the blind texts. Separated they live in Bookmarksgrove right at the coast of the Semantics, a large language ocean. A small river named Duden flows by their place and supplies it with the necessary regelialia. It is a paradisematic country, in which roasted parts of sentences fly into your mouth. Even the all-powerful Pointing has no control about the blind texts it is an almost unorthographic life One day however a small line of blind text by the name of Lorem Ipsum decided to leave for the far World of Grammar. </p>
      </div>
      <div class="modal-footer">
        <div class="left-side">
            <button type="button" class="btn btn-default btn-simple" data-dismiss="modal">Never mind</button>
        </div>
        <div class="divider"></div>
        <div class="right-side">
            <button type="button" class="btn btn-danger btn-simple">Delete</button>
        </div>
      </div>
    </div>
  </div>
</div>

<!--    end modal -->


</body>

  <script src="{{asset('paperkit/assets/js/jquery-1.10.2.js')}}" type="text/javascript"></script>
	<script src="{{asset('paperkit/assets/js/jquery-ui-1.10.4.custom.min.js')}}" type="text/javascript"></script>

	<script src="{{asset('paperkit/bootstrap3/js/bootstrap.js')}}" type="text/javascript"></script>
	
	<!--  Plugins -->
	<script src="{{asset('paperkit/assets/js/ct-paper-checkbox.js')}}"></script>
	<script src="{{asset('paperkit/assets/js/ct-paper-radio.js')}}"></script>
	<script src="{{asset('paperkit/assets/js/bootstrap-select.js')}}"></script>
	<script src="{{asset('paperkit/assets/js/bootstrap-datepicker.js')}}"></script>
	
	<script src="{{asset('paperkit/assets/js/ct-paper.js')}}"></script>    
</html>