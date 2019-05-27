<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Leadovate</title>
	<link rel="shortcut icon" type="image/x-icon" href="favicon.ico">
	<!-- google font -->
	<!--<link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700" rel="stylesheet" type="text/css" />-->
	<link href="https://fonts.googleapis.com/css?family=Roboto:100,100i,300,300i,400,400i,500,500i,700,700i,900,900i" rel="stylesheet">
	<link href="{{url('/')}}/resources/admin_assets/css/bootstrap.min.css" rel="stylesheet" type="text/css">
	<link href="{{url('/')}}/resources/admin_assets/css/font-awesome.min.css" rel="stylesheet" type="text/css">
	<link href="{{url('/')}}/resources/admin_assets/css/ionicons.css" rel="stylesheet" type="text/css">
	<link href="{{url('/')}}/resources/admin_assets/css/simple-line-icons.css" rel="stylesheet" type="text/css">
	<link href="{{url('/')}}/resources/admin_assets/css/jquery.mCustomScrollbar.css" rel="stylesheet">
	<link href="{{url('/')}}/resources/admin_assets/css/weather-icons.min.css" rel="stylesheet">
	<link href="{{url('/')}}/resources/admin_assets/css/owl.carousel.min.css" rel="stylesheet">
	<link href="{{url('/')}}/resources/admin_assets/css/jquery.easy-pie-chart.css" rel="stylesheet">
	<link href="{{url('/')}}/resources/admin_assets/css/richtext.min.css" rel="stylesheet">
	<link href="{{url('/')}}/resources/admin_assets/css/fSelect.css" rel="stylesheet">
	<link href="{{url('/')}}/resources/assets/css/dataTables.bootstrap4.min.css" rel="stylesheet">
	<link href="{{url('/')}}/resources/admin_assets/css/style.css" rel="stylesheet">
	<link href="{{url('/')}}/resources/admin_assets/css/header.css" rel="stylesheet">
	<link href="{{url('/')}}/resources/admin_assets/css/menu.css" rel="stylesheet">
	<link href="{{url('/')}}/resources/admin_assets/css/index.css" rel="stylesheet">
	<link href="{{url('/')}}/resources/admin_assets/css/responsive.css" rel="stylesheet">
	<link href="{{url('/')}}/resources/admin_assets/js/chosen.css" rel="stylesheet">
    <link href="{{url('/')}}/resources/admin_assets/js/select2.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.11/summernote.css" rel="stylesheet">
    <link href="https://cdn.rawgit.com/davidstutz/bootstrap-multiselect/master/dist/css/bootstrap-multiselect.css"
    rel="stylesheet" type="text/css" />
	</head>
<style>
.multiselect-container
{
    height:300px;
    overflow-y: scroll;       
}
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
<body>@if(Session::has('error'))  
     <div class="alert alert-danger">
       {{ Session::get('error')}} 
     </div>
    @endif
    
    @if(Session::has('success'))   
     <div class="alert alert-success">
       {{ Session::get('success')}} 
     </div>
    @endif
		<!-- Loader -->
	<div class="alert alert-danger dg1" style="display:none;"></div>
    <div class="alert alert-success as1" style="display:none;"></div>
	
	<div id="loader_wrpper">
	   
	<div class="loader"></div>
	</div>
	<input type="hidden" id="base_url" value="{{url('/')}}/admin">
		<!-- header -->
	<div class="wrapper">
		<!-- header -->
		<div class="header-bg">
			<header class="main-header">
				<div class="container_header phone_view border_top_bott">
					<div class="row">
						<div class="col-md-12">
							<div class="logo d-flex align-items-center dark_blue_bg">
								<a href="{{url('/')}}/admin/dashboard">
									<strong class="logo_icon"> <img src="{{url('/')}}/resources/admin_assets/images/small_logo.png" alt=""> </strong>
									<span class="logo-default"> <img src="{{url('/')}}/resources/admin_assets/images/logo.png" alt=""> </span>
								</a>
								<div class="icon_menu">
									<a href="#!" class="menu-toggler sidebar-toggler"></a>
								</div>
							</div>
							<div class="right_detail">
								<div class="row d-flex align-items-center justify-content-end">
									<div class="col-xl-7 col-12 d-flex justify-content-end">
										<div class="right_bar_top d-flex align-items-center">
											<div class="search">
												<div class="d-lg-none">
													<a id="toggle_res_search" data-toggle="collapse" data-target="#search_form" class="res-only-view collapsed" href="javascript:void(0);" aria-expanded="false"> <i class=" icon-magnifier"></i> </a>
													<form id="search_form" role="search" class="search-form collapse" action="#">
														<div class="input-group">
															<input type="text" class="form-control search_admin" placeholder="Search...">
															<button type="button" class="btn" data-target="#search_form" data-toggle="collapse" aria-label="Close">
																<i class="ion-android-search"></i>
															</button>
														</div>
													</form>
													
												</div>
												<?php 
                                                $data=array('status'=>'0','to_id'=>Session()->get('adminid'),'to'=>"Admin");
                                                $noti=\App\Notification::getdata($data);
                                                $noti1=\App\Notification::getdata2($data);
                                                ?>
												<div class="d-lg-block d-xs-none">
													<form role="search" class="search-form form_show" action="#">
														<div class="input-group">
															<input type="text" class="form-control search_admin" placeholder="Search...">
															<button type="button" class="btn" data-target="#" data-toggle="" 
															aria-label="Close">
																<i class="ion-android-search"></i>
															</button>
														</div>
													</form>
													 <div class="scroll_auto height_fixed scroll-mx-not">
													    <span class="show_results"></span>
													 </div>
												</div>
											</div>
											
											<!-- notification_Start -->
											<div class="dropdown dropdown-notification">
												<a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown" 
												data-hover="dropdown" data-close-others="true" aria-expanded="false"> <i class="fa fa-bell-o"></i> <span class="badge_coun"> {{count($noti1)}} </span> </a>
												<ul class="dropdown-menu scroll_auto height_fixed">
													<li class="bigger">
														<h3><span class="bold">Notifications</span></h3>
														<span class="notification-label">{{count($noti)}}</span>
													</li>
													<li>
													    <?php
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
													    
														<ul class="dropdown-menu-list">
														    @forelse($noti as $n)
															<li class="view_notification" data-id="{{$n->id}}" data-status="{{$n->status}}">
																<a href="{{$n->url}}"> <span class="time"><?php  $curr_time = $n->created_at;  
																$time_ago = strtotime($curr_time); 
																echo time_Ago($time_ago); ?></span> <span class="details"> 
																<span class="notification-icon deepPink-bgcolor"> <i class="fa fa-user o"></i> 
																</span> <?=$n->title?> </span> </a>
															</li>
															@empty
															Notifications not found.!
															@endforelse
															   <li><a class="" href="{{url('/admin')}}/notifications"><span class="details seall">See all notifications</span></a></li>
															<!----li>
																<a href="javascript:;"> <span class="time">3 mins</span> <span class="details"> <span class="notification-icon purple-bgcolor"> <i class="fa fa-user o"></i> </span> New User has been assigned.  </span> </a>
															</li>
															<li>
																<a href="javascript:;"> <span class="time">7 mins</span> <span class="details"> <span class="notification-icon blue-bgcolor"> <i class="icon-book-open"></i> </span> A new course has been added. </span> </a>
															</li>
															<li>
																<a href="javascript:;"> <span class="time">12 mins</span> <span class="details"> <span class="notification-icon pink"> <i class="fa fa-user o"></i> </span> New User has been assigned. </span> </a>
															</li>
															<li>
																<a href="javascript:;"> <span class="time">15 mins</span> <span class="details"> <span class="notification-icon yellow"> <i class="fa fa-file-text-o"></i> </span> New application has been added. </span> </a>
															</li>
															<li>
																<a href="javascript:;"> <span class="time">10 hrs</span> <span class="details"> <span class="notification-icon blue-bgcolor"> <i class="icon-book-open"></i> </span> A new course has been added. </span> </a>
															</li---->
														</ul>
													</li>
												</ul>
											</div>
											<!-- notification_End -->
										
											<!-- Dropdown_User -->
											<div class="dropdown dropdown-user">
												<a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="true" aria-expanded="true">
												 <?php $sess=Session()->get('admin');
											$ad=\App\Admin::where('id',$sess['id'])->first();
											//print_r($ad);?>   
												    
												    
												    
												     
													<img class="img-circle pro_pic" src="{{url('/')}}/public/uploads/{{\App\Admin::getdatawithid($sess['id'])}}" alt="">
													
												
											
										
													
												</a>
												<ul class="dropdown-menu dropdown-menu-default">
													<li>
													   
														<div class="user-panel">
															<div class="user_image">
															    
																<img src="{{url('/')}}/public/uploads/{{\App\Admin::getdatawithid($sess['id'])}}" class="header_image box_all_shedo img-circle mCS_img_loaded" alt="User Image">
														       
														        
															</div>
															
															<div class="info">
																<p id="first"><?=$ad->first_name;?> <?=$ad->last_name;?></p>
																<span id="email_edit"><?=$ad->email;?></span>
															</div>
														</div>
													</li>
													<li>
														<a href="{{url('admin/profile')}}"> <i class="icon-user"></i> Profile </a>
													</li>
												
													<li>
														<a href="{{url('admin/getSignOut')}}"> <i class="icon-logout"></i> Log Out </a>
													</li>
												</ul>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</header>
		</div>
		<!-- header_End -->