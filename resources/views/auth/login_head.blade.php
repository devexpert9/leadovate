<!DOCTYPE html>
<html lang="en">
<head>
    <!-- ========== Meta Tags ========== -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Examin - Education and LMS Template">

    <!-- ========== Page Title ========== -->
    <title>Leadovate | Login</title>

    <!-- ========== Favicon Icon ========== -->
    <link rel="shortcut icon" href="assets/img/favicon.png" type="image/x-icon">

    <!-- ========== Start Stylesheet ========== -->
    <link href="{{url('/')}}/resources/assets/css/bootstrap.min.css" rel="stylesheet" />
    <link href="{{url('/')}}/resources/assets/css/font-awesome.min.css" rel="stylesheet" />
    <link href="{{url('/')}}/resources/assets/css/flaticon-set.css" rel="stylesheet" />
    <link href="{{url('/')}}/resources/assets/css/magnific-popup.css" rel="stylesheet" />
    <link href="{{url('/')}}/resources/assets/css/owl.carousel.min.css" rel="stylesheet" />
    <link href="{{url('/')}}/resources/assets/css/owl.theme.default.min.css" rel="stylesheet" />
    <link href="{{url('/')}}/resources/assets/css/animate.css" rel="stylesheet" />
    <link href="{{url('/')}}/resources/assets/css/bootsnav.css" rel="stylesheet" />
    
    <link href="{{url('/')}}/resources/assets/css/style.css" rel="stylesheet">
    <link href="{{url('/')}}/resources/assets/css/custom.css" rel="stylesheet">
    <link href="{{url('/')}}/resources/assets/css/responsive.css" rel="stylesheet" />
 
    <link href="https://fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Poppins:400,500,600,700,800" rel="stylesheet">

</head>
<style>
.invalid-feedback
{
	color:red;
}label.error {
    color:red !important;
 }
 .alert-danger,.alert-success {  position: fixed;
        max-width: 50%;
        width: 100%;
        top: 45%;
        left: 16%;
        margin: auto;
        z-index: 111111;
        box-shadow: 1px 1px 8px rgba(0, 0, 0, 0.15);
        text-align: center;
        right: 0;
      }
</style>
<body>
@if(Session::has('error'))  
     <div class="alert alert-danger">
       {{ Session::get('error')}} 
     </div>
    @endif
    
    @if(Session::has('success'))   
     <div class="alert alert-success">
       {{ Session::get('success')}} 
     </div>
    @endif
    <!-- Preloader Start -->
    <div class="se-pre-con"></div>
    <!-- Preloader Ends -->    
 <div class="alert alert-danger dg1" style="display:none;"></div>
    <div class="alert alert-success as1" style="display:none;"></div>
    <!-- Header -->
    <header id="home">
        <!-- Start Navigation -->
        <nav class="navbar navbar-default attr-border navbar-sticky bootsnav">
	<input type="hidden" id="base_url" value="{{url('/')}}">
            <!-- Start Top Search -->
            <div class="container">
                <div class="row">
                    <div class="top-search">
                        <div class="input-group">
                            <form action="#">
                                <input type="text" name="text" class="form-control" placeholder="Search">
                                <button type="submit">
                                    <i class="fas fa-search"></i>
                                </button>  
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <!-- End Top Search -->

            <div class="container">


                <!-- Start Header Navigation -->
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navbar-menu">
                        <i class="fa fa-bars"></i>
                    </button>
                    <a class="navbar-brand" href="{{url('/')}}">
                        <img src="{{url('/')}}/resources/assets/img/logo-new.png" class="logo" alt="Logo">
                    </a>
                </div>
                <!-- End Header Navigation -->
                <div class="collapse navbar-collapse" id="navbar-menu">
                    <ul class="nav navbar-nav navbar-left" data-in="#" data-out="#">
                     
                    </ul>
					<ul class="nav navbar-nav navbar-right self-drop-dwn">
						<li>
						   <a href="{{url('/')}}/login" class="login-btn"> Login </a>
						</li>
						<li>
						   <a href="{{url('/')}}/register" class="sign-ups"> Sign Up </a>
						</li>
				   </ul>
                </div><!-- /.navbar-collapse -->
            </div>

            
        </nav>
        <!-- End Navigation -->

    </header>
    <!-- End Header -->

   

  