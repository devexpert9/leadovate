@include('layouts/header')
   <style>
   .title
   {
       word-break: break-all;
   }
   .text_progress
   {
     color: #666666 !important;
    line-height: 26px !important;
    margin: 0 0 15px !important;
    text-transform: none !important;
    font-weight: 400 !important;
    text-align: center !important;
   }
   .prof-sec
   {
	   display:none;
   }
   .session_admin
   {
       display:none;
   }
   </style>
    <!-- Start Course Details  -->
    <div class="course-details-area default-padding">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="course-details-info">
                        <!-- Star Top Info -->
                        <div class="top-info">
                            <!-- Title-->
                            <div class="title">
                                <div class="row">
                                <div class="col-sm-12">
									<h2 class="m-b-60">{{$course_details->title}}</h2>
								</div>
                                <?php 
                                if(!empty($user_course)){
                                $percentage = \App\Userlesson::getviewedlessons(Session()->get('userid'),$course_details->id);
                                $totalWidth =  \App\Lesson::getlessoneithcoursecon($course_details->id,$user->package_id);
                                    if($totalWidth !='0')
                                    {
                                    $percent = $percentage/$totalWidth;
                                    $percent_friendly = number_format( $percent * 100 ).'%'; 
                                    }else
                                    {
                                    $percent_friendly = '0%';     
                                    }
                                }else
                                {
                                  $percent_friendly = '0%';    
                                }
                                ?>
								<div class="col-sm-8">
									<div class="progress">
									  <div class="progress-bar progress-bar-danger progress-bar-striped " role="progressbar"
									  aria-valuenow="{{$percent_friendly}}" aria-valuemin="0" aria-valuemax="100" style="width:{{$percent_friendly}} !important">
									  </div>

									</div>
				  
				 
				  				<p class="main-under-cls text-center text_progress">{{$percent_friendly}}</p>
									<span class="main-txt-icn tropy-r8"><img src="{{url('/')}}/resources/assets/img/trophy.png"></span>
								</div>
								<div class="col-sm-1"></div><div class="col-sm-3">
								    @if(!empty($user_course))
								<a class="btn btn-dark effect btn-sm pull-right resume-btn @if(Session()->exists('admin')) hide @endif" href="#">
									<i class="fas fa-file-alt"></i> Resume
								</a>
								@else
									<a class="btn btn-dark effect btn-sm pull-right resume-btn @if(Session()->exists('admin')) hide @endif" href="#">
									<i class="fas fa-file-alt"></i> Start
								</a>
								@endif
                            </div></div></div>
                            <div class="thumb">
                                <div class="row">
        							<div class="col-sm-12">
                                        <div class="main-in">
        									<div class="col-sm-8 left-side-img">
        									    @if(empty($course_details->image))
        										<img src="{{url('/')}}/resources/assets/img/3.svg"></div>
        										@else
        										<img src="{{url('/')}}/public/uploads/{{$course_details->image}}"></div>
        										@endif
        										
        									<div class="col-sm-4 right-side-img">
        										<img src="{{url('/')}}/resources/assets/img/pattren1.png">
        									</div><!--div class="back-overlap"><img src="assets/img/pattren.png"></div--></div></div>
        								
                                   
                                </div>    
                                    <!-- End Thumbnail -->

                            <!-- Course Meta -->
                            <div class="course-meta">
                                <div class="item author">
                                    <div class="thumb">
                                       <?=$course_details->description;?>
								   </div>
                                </div>
								
                                
                            </div>
                            <!-- End Course Meta -->
                        </div>
                        <!-- End Top Info -->

						<div class="tab-area-self">
							<div class="row mb-30 flx-m">
								<div class="col-sm-6 left-hh">
								    <ul class="mainss">
								        <li class="active"><a class="btn btn-dark effect btn-sm first-main-right self-frst" data-toggle="tab" href="#tab1" aria-expanded="true" >
										OVERVIEW
									</a></li>
									<li><a class="btn btn-dark effect btn-sm first-main-right  " data-toggle="tab" href="#tab2" aria-expanded="false" >
										SYLLABUS
									</a></li>
								    </ul>
								
								</div>
								<div class="col-sm-6 pull-right main-tct right-hh">
									<!--a class="btn btn-dark effect btn-sm @if(Session()->exists('admin')) hide @endif" href="#">
										 UPGRADE TO PRO
									</a-->
									<a data-target="#redo" data-id="{{$course_details->id}}"  data-toggle="modal"  class="redo_completed btn btn-dark effect btn-sm self-right-btn @if(Session()->exists('admin')) hide @endif" href="#">
										RESET PROGRESS
									</a>
								</div>
							</div>
							<!-- Star Tab Info -->
							<div class="tab-info">
								<!-- Start Tab Content -->
								<div class="tab-content tab-content-info">
									<!-- Single Tab -->
									<div id="tab1" class="tab-pane fade active in">
										<div class="info title">
											<h4>Why take this course?</h4>
										   <?=$course_details->course_overview;?>
										</div>
									</div>
									<!-- End Single Tab -->
									<!-- Single Tab -->
									<div id="tab2" class="tab-pane fade">
										<div class="info title">
											<h4>Course Syllabus</h4>
											<?php $flag=0;
											?><?php   $gets_last=\App\Userlesson::where('user_id',Session()->get('userid'))->orderby('id','desc')->first();
											$i='0';?>
											@forelse($syllabus_details as $sd)
											<!-- Start Course List -->
											<div class="course-list-items acd-items acd-arrow">
												<div class="panel-group symb" id="accordion">
													<div class="panel panel-default">
														<div class="panel-heading">
															<h4 class="panel-title">
																<a data-toggle="collapse" data-parent="#accordion" href="#ac{{$sd['id']}}">
																	<?=$sd['title'];?>
																</a>
															</h4>
															<div class="pie-wrapper progress-95 style-2">
																<span class="label"><i class="fa fa-check" aria-hidden="true"></i></span>
																<div class="pie">
																	<div class="left-side half-circle"></div>
																	<div class="right-side half-circle"></div>
																</div>
																<div class="shadow"></div>
															</div>
														</div>
														<div id="ac{{$sd['id']}}" class="panel-collapse collapse">
															<div class="panel-body">
																<ul class="timeline">
																	      
																    @forelse($sd['lesson'] as $l)
																     	<?php 
                                                                        if( $i=='2' ){
                                                                        $flag='1';
                                                                        }elseif($gets_last->lesson_id == $l['id'] && $i=='0'){
                                                                        $i='1';
                                                                        $flag='0';
                                                                        }elseif( $i=='1')
                                                                        {
                                                                        $i='2';   
                                                                        $flag='0';
                                                                        }
																	     ?>
																	<li class="<?php if($i=='2' && $flag=='1'){ echo 'disabled';}?>"><i class="fas fa-check"></i>
																		<div class="item name">
																		<span><?=$l['type'];?></span>
																		</div>
																		<div class="item title">
																		<h5> <?=$l['name'];?> </h5>
																		</div>
																		<div class="item info">
																	<?php $gets=\App\Userlesson::where('lesson_id',$l['id'])->where('user_id',Session()->get('userid'))->orderby('id','desc')->first();
													                    ?>
																		<span>Duration: {{$l['duration']}} min</span>
																	
																	
																		@if($l['type']=='Video')
																		<a href="@if($i=='2' && $flag=='1') {{url('/')}}/video-details/<?=$l['id'];?> @else javascript:void(0); @endif" class="view_lesson <?php if($i=='2' && $flag=='1'){ echo 'disabled';}?>" data-cid="{{$l['course_id']}}" data-id="{{$l['id']}}" >View</a>
																		@elseif($l['type']=='Exercise')
																		<a href="@if($i=='2' && $flag=='1') {{url('/')}}/interactive-exercise/<?=$l['id'];?> @else javascript:void(0); @endif"  class="view_lesson <?php if($i=='2' && $flag=='1'){ echo 'disabled';}?>"data-cid="{{$l['course_id']}}" 
																		data-id="{{$l['id']}}">View</a>
																		@else
																		@endif
																		</div>
																	</li>
																
																	@empty
																	<li><i class="fas fa-check"></i>
																	    Lessons not found... !
																	</li>
																	
																	@endforelse
																	
																</ul>
															</div>
														</div>
													</div>
												</div>
											</div>
											<!-- End Course List -->
											<!-- Start Course List -->
											@empty
											Syllabus Empty...!
											@endforelse
										</div>
									</div>
									<!-- End Single Tab -->
								</div>
								<!-- End Tab Content -->
							</div>
							<!-- End Tab Info -->
						</div>
                    </div>
                </div>
             
            </div>
        </div>
    </div>
@include('layouts/footer')
<div id="redo" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
      <button type="button" class="close" data-dismiss="modal">&times;</button>
      <h4 class="modal-title">Reset Progress</h4>
      </div>
      <div class="modal-body">
      <p>Are you sure you want to reset ? This will start you from the beginning of the course and will DELETE your existing progress.</p>
      </div>
      <input type="hidden" id="redo_id">
      <div class="modal-footer">
      <button type="button" class="btn btn-success confirm_redo">Reset Progress</button>
      <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
      </div>
      </div>
  </div>
</div>
<script>
$(document).on('click', '.confirm_redo', function () {
     var id=$('#redo_id').val();
     var base=$('#base_url').val();
	 var action =base+'/resetcourse';
	 var data ={id:id};
         $.ajax({
          headers: {
              'X-CSRF-Token': $('input[name="_token"]').val()
          },
                type: 'post',
                url: action,
                data: data,
                success: function (data1) {
                   	var obj = JSON.parse(data1);
                    if(obj.code == '101')
                    {
                        $('#redo').modal('hide');
                        $(".as1").html(obj.message);
                        $('.hide'+id).remove();
                        $(".as1").show();  
                        setTimeout(function(){ $('.alert-success').hide(); 
                        var next = base+'/home';
                            window.location.href= next;
                        }, 2000);
                        
                    }
                },
            });
       
    
});
$(document).on('click', '.redo_completed', function () {
    var id=$(this).attr('data-id');
    $('#redo_id').val(id);
    
});
$(document).on('click', '.view_lesson', function () {
var base=$('#base_url').val();
var lid=$(this).attr('data-id');
var cid=$(this).attr('data-cid');
var action =base+'/viewlesson';
var data ={lid:lid,cid:cid};
$.ajax({
headers: {
'X-CSRF-Token': $('input[name="_token"]').val()
},
type: 'post',
url: action,
data: data,
success: function (data1) {
$('.get_act').html(data1);
},
});
    
});
</script>
<script>
 	$('.panel-title a:first').attr('aria-expanded',true);
   	$('.panel-collapse:first').addClass('in');
</script>