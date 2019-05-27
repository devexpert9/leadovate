<!DOCTYPE html>
<html lang="en">
<head>
    <!-- ========== Meta Tags ========== -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Examin - Education and LMS Template">

    <!-- ========== Page Title ========== -->
    <title>Leadovate</title>

    <!-- ========== Favicon Icon ========== -->
    <link rel="shortcut icon" href="{{url('/')}}/resources/assets/img/favicon.png" type="image/x-icon">

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
 	<link href="{{url('/')}}/resources/assets/css/lity.css" rel="stylesheet"/>
    <link href="https://fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Poppins:400,500,600,700,800" rel="stylesheet">
	<link rel="stylesheet" href="{{url('/')}}/resources/assets/css/jquery.mCustomScrollbar.css">
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
    @if(Session()->exists('user'))
    <div class="alert alert-danger dg1" style="display:none;"></div>
    <div class="alert alert-success as1" style="display:none;"></div>
	<input type="hidden" id="base_url" value="{{url('/')}}">
    <!-- Preloader Start -->
    <div class="se-pre-con"></div> <?php
													     function time_Ago($time) { 
                                                            
                                                            	// Calculate difference between current 
                                                            	// time and given timestamp in seconds 
                                                            	$diff	 = time() - $time; 
                                                            	
                                                            	// Time difference in seconds 
                                                            	$sec	 = $diff; 
                                                            	
                                                            	// Convert time difference in minutes 
                                                            	$min	 = round($diff / 60 ); 
                                                            	
                                                            	// Convert time difference in hours 
                                                            	$hrs	 = round($diff / 3600); 
                                                            	
                                                            	// Convert time difference in days 
                                                            	$days	 = round($diff / 86400 ); 
                                                            	
                                                            	// Convert time difference in weeks 
                                                            	$weeks	 = round($diff / 604800); 
                                                            	
                                                            	// Convert time difference in months 
                                                            	$mnths	 = round($diff / 2600640 ); 
                                                            	
                                                            	// Convert time difference in years 
                                                            	$yrs	 = round($diff / 31207680 ); 
                                                            	
                                                            	// Check for seconds 
                                                            	if($sec <= 60) { 
                                                            		echo "$sec seconds ago"; 
                                                            	} 
                                                            	
                                                            	// Check for minutes 
                                                            	else if($min <= 60) { 
                                                            		if($min==1) { 
                                                            			echo "one min ago"; 
                                                            		} 
                                                            		else { 
                                                            			echo "$min mins ago"; 
                                                            		} 
                                                            	} 
                                                            	
                                                            	// Check for hours 
                                                            	else if($hrs <= 24) { 
                                                            		if($hrs == 1) { 
                                                            			echo "an hour ago"; 
                                                            		} 
                                                            		else { 
                                                            			echo "$hrs hours ago"; 
                                                            		} 
                                                            	} 
                                                            	
                                                            	// Check for days 
                                                            	else if($days <= 7) { 
                                                            		if($days == 1) { 
                                                            			echo "Yesterday"; 
                                                            		} 
                                                            		else { 
                                                            			echo "$days days ago"; 
                                                            		} 
                                                            	} 
                                                            	
                                                            	// Check for weeks 
                                                            	else if($weeks <= 4.3) { 
                                                            		if($weeks == 1) { 
                                                            			echo "a week ago"; 
                                                            		} 
                                                            		else { 
                                                            			echo "$weeks weeks ago"; 
                                                            		} 
                                                            	} 
                                                            	
                                                            	// Check for months 
                                                            	else if($mnths <= 12) { 
                                                            		if($mnths == 1) { 
                                                            			echo "a month ago"; 
                                                            		} 
                                                            		else { 
                                                            			echo "$mnths months ago"; 
                                                            		} 
                                                            	} 
                                                            	
                                                            	// Check for years 
                                                            	else { 
                                                            		if($yrs == 1) { 
                                                            			echo "one year ago"; 
                                                            		} 
                                                            		else { 
                                                            			echo "$yrs years ago"; 
                                                            		} 
                                                            	} 
                                                            } 
                                                            ?>
    <!-- Preloader Ends -->    

    <!-- Header --><?php $user=App\User::where('id',Session()->get('userid'))->first();?>
    <header id="home">
        	<input type="hidden" id="base_url" value="{{url('/')}}">
        <!-- Start Navigation -->
        <nav class="navbar navbar-default attr-border navbar-sticky bootsnav">
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
                    <a class="navbar-brand" href="{{url('/all-cources')}}">
                        <img src="{{url('/')}}/resources/assets/img/logo-new.png" class="logo" alt="Logo">
                    </a>
                </div>
              
                <div class="collapse navbar-collapse" id="navbar-menu">
                    <ul class="nav navbar-nav navbar-left" data-in="#" data-out="#">
                        @if(Session()->exists('user'))
                        <li>
                            <a href="{{url('/')}}/all-cources" >All Courses</a>
                        </li>
                        @endif
                        <li class="dropdown">
						@if(Session()->exists('user'))
						<?php
						$url = 'http://' . $_SERVER['SERVER_NAME'] . $_SERVER['REQUEST_URI'];
                        if (strpos($url,'home') !== false) {?>
                         <a href="javascript:void(0);" class="dropdown-toggle active" data-toggle="dropdown" >My Home</a>
							<ul class="dropdown-menu">
                                <li><a href="#applications">My Application</a></li>
                                <li><a href="#courses">My Courses</a></li>
                            </ul>
                            <?php }else{ ?>
                             <a href="javascript:void(0);" class="dropdown-toggle active" data-toggle="dropdown" >My Home</a>
							<ul class="dropdown-menu">
                                <li><a href="{{url('/')}}/home#applications">My Application</a></li>
                                <li><a href="{{url('/')}}/home#courses">My Courses</a></li>
                            </ul>
                            <?php } ?>
                          @endif						 
                        </li>
                    </ul>
					<ul class="nav navbar-nav navbar-right self-drop-dwn">
					  <?php if(Session()->get('userid') == ''){?>
                            <li class="dropdown">
                            <a href="{{ route('login') }}">Login</a>
                            </li>
                            <li class="dropdown">
                            <a href="{{ route('register') }}">Register</a>
                            </li>
                            <?php }else{ ?>
                            <?php 
                            $data=array('status'=>'0','to_id'=>Session()->get('userid'));
                            $noti=\App\Notification::getdata($data);
                            $noti1=\App\Notification::getdata2($data);
                            ?>
                            <li class="dropdown notification_bell">
                            <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-bell" aria-hidden="true"></i><span>{{ count($noti1)}}</span></a>
                            <ul class="dropdown-menu">						
                            <li class="">
                            @forelse($noti as $n)
                            <a href="{{$n->url}}" class="hide{{$n->id}}"><?php echo $n->title;?></a>
                            @empty
                            <p>No Notifications</p>
                            @endforelse
                            </li>
                            <li><a class="" href="{{url('/')}}/notifications">See all notifications</a></li>
                            </ul>
                            </li>
						<li class="dropdown profile_user">
						   <a href="#" class="dropdown-toggle" data-toggle="dropdown">
						      
						        
						       	@if(!empty($user->image))
						       	<?php if(file_exists('public/uploads/'.$user->image)){ ?>
							   <span class=""><img  src="{{url('/')}}/public/uploads/{{$user->image}}"  class="avatar-area user_profile_image" /></span> 
							   <?php }else{ ?>
							    <span class=""><img  src="{{url('/')}}/public/profile/{{$user->image}}"  class="avatar-area user_profile_image" /></span> 
							  <?php }?>
							  	@else
							 <span class=""><img  src="{{url('resources/assets/img/user.jpg')}}"  class="avatar-area user_profile_image" /></span> 
								@endif 
						       
						       
							   <!--span class=""><img  src="@if(!empty($user->image)){{url('public/profile/'.$user->image)}}" @else {{url('resources/assets/img/user.jpg')}} @endif" class="avatar-area user_profile_image" /></span---> 
							   <strong><span class="user_profile_name">{{ $user->first_name }} {{ $user->last_name }}</span></strong>
							   <span class=""></span>
						   </a>
						   <ul class="dropdown-menu">							   
                               <li>
                                   <a href="{{url('/')}}/profile">Profile</a>
                               </li>
						   <li>
						   <form id="logout-form" action="{{ route('getSignOut') }}" method="POST" style="display: none;">
                            @csrf
                            </form>
							<a href="{{ route('getSignOut') }}"  onclick="event.preventDefault();
                            document.getElementById('logout-form').submit();">Logout</a>
							</li>
						   </ul>
					   </li>
			<?php } ?>
				   </ul>
				   
                </div><!-- /.navbar-collapse -->
            </div>

            
        </nav>
        <!-- End Navigation -->

    </header>
    <!-- End Header -->

    <section class="prof-sec profile_header">
        <div class="container">
            <div class="row">
                <div class="col-xs-5 col-sm-3 col-md-2">
                    <div class="prof-img">
                         
						       	@if(!empty($user->image))
						       	<?php if(file_exists('public/uploads/'.$user->image)){ ?>
						       	
						       	<img src="{{url('/')}}/public/uploads/{{$user->image}}" class="user_profile_image" alt="User Image">
							  
							   <?php }else{ ?>
							   <img src="{{url('/')}}/public/profile/{{$user->image}}" class="user_profile_image" alt="User Image">
							  
							   		  <?php }?>
							  	@else
							  	 <img src="{{url('resources/assets/img/user.jpg')}}" class="user_profile_image" alt="User Image">
							 	@endif 

                    </div>
                </div>

                <div class="col-xs-7 col-sm-9 col-md-10">
                    <div class="profile-detail">
                        <h3 class="user_profile_name">{{ $user->first_name }} {{ $user->last_name }}</h3>
                         <?php if(!empty($user)){
                            if(!empty($user->package_id)){
                             $package=App\Subscription::getwithid($user->package_id);
                             $current_package=App\Transaction::get_active_payment_details($user->id);
                            }}
                             ?>
                        <p><?php if(!empty($package)){?>
                        {{$package->plan_name}}
                        <?php }else{ ?>
                       Free Trail
                        <?php } ?></p>
                    </div>
                </div>
            </div>

                <div class="title">
                <?php $get = DB::table('courses')
                ->join('usercourses','courses.id', '=', 'usercourses.course_id')
                ->where('usercourses.status','1')
                ->where('usercourses.user_id',Session()->get('userid'))
                ->select('courses.*','usercourses.viewed_lesson','usercourses.total_lessons')
                ->orderby('courses.id','desc')
                ->get();
                $getall = DB::table('courses')
                ->join('usercourses','courses.id', '=', 'usercourses.course_id')
               // ->where('usercourses.status','1')
                ->where('usercourses.user_id',Session()->get('userid'))
                ->select('courses.*','usercourses.viewed_lesson','usercourses.total_lessons')
                ->orderby('courses.id','desc')
                ->get();
                 ?>
                <h3>No. of Courses Completed :
                @if(count($getall) == '0')
                0
                @else
                <span class="completed">{{count($get)}}</span>/<span class="allusercourse">{{count($getall)}}</span>
                @endif
                </h3>
                <?php 
                $percentage =count($get);
                $totalWidth =count($getall);
                if($totalWidth !='0')
                {
                $percent = $percentage/$totalWidth;
                $percent_friendly = number_format( $percent * 100 ).'%'; 
                }else
                {
                $percent_friendly = '0%';     
                }
                ?>
                <div class="row">
                    <div class="col-sm-6 col-md-6 col-lg-7 progress-left-bar">
                        <div class="progress">
                             <div class="progress-bar progress-bar-danger progress-bar-striped" role="progressbar"
                              aria-valuenow="{{$percent_friendly}}" aria-valuemin="0" aria-valuemax="100" style="width:{{$percent_friendly}} !important">
                              </div>
                                </div>
                                <p class="main-under-cls text-center new_per">{{$percent_friendly}}</p>
                                <span class="main-txt-icn tropy-r8">
                                <img src="{{url('/')}}/resources/assets/img/trophy.png">
                                </span>
                                </div>
                     
                </div>
            </div>
        </div>
    </section>
@endif
   