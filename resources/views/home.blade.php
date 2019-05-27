@include('layouts/header')
    <section class="application-sec" id="applications">
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                    <div class="alert alert-danger alert-dismissible" role="alert" style="display:none">
                      <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                      <strong>Trial Notification.</strong>  Your trial has expired. Please upgrade to the standard subscription so that you can keep learning. Upgrade to standard subscription? Yes.
                    </div>
                </div>
                <div class="col-sm-12">
                    <h3>My Applications</h3>
                </div>
                 @forelse($application as $a)
                  <div class="col-sm-6 col-md-4 remove_app{{$a->syllabus_id}}">
                    <div class="card card_delete">
                        <a href="javascript:void(0)"  data-id="{{$a->syllabus_id}}" class="delete_cross" id="remScnt"><i class="fa fa-times"></i></a>
                        <div class="card-img">
                           <a href="{{url('/')}}/application-details/{{$a->syllabus_id}}">
                            @if(empty($a->image))
							<img class="card-img-top" src="{{url('/')}}/resources/assets/img/card-icon.png" alt="Card image cap">
							@else
							<img class="card-img-top" src="{{url('/')}}/public/uploads/{{$a->image}}" alt="Card image cap">
							@endif
							</a>
                        </div>

                          <div class="card-body courses-body">
                            <h5 class="card-title">{{$a->name}}</h5>
                                <a class="btn btn-resume btn-dwld" target="blank" href="{{ url('dynamic_pdf/pdf') }}/{{$a->syllabus_id}}"><i class="fa fa-download"></i>Download</a>
                            
                        </div>
                    </div>
                  </div>
                  @empty
                <div class="row">
                <div class="col-sm-12 text-center">No applications added
                </div>
                </div>
                @endforelse
                </div>
          
          <?php if(count($application) != '0'){ ?>
            <div class="row">
                <div class="col-sm-12 text-center">
                     <a class="btn btn-resume btn-see" href="{{url('/')}}/all-applications">See All</a>
                </div>
            </div>  
           <?php } ?>
        </div>

    </section>
	
	<section class="application-sec courses-sec  mt-0 pb-0" id="courses">
        <div class="container">
            <div class="row">
               
                
                <div class="col-sm-12">
                    <h3>Active Courses</h3>
                </div>
               @if($user->package_id =='')
               
                <div class="col-sm-12">
                    <div class="subs-box">
                        <div class="text-center">
                            <?php if(!empty($user)){
                            if(!empty($user->package_id)){
                             $package=App\Subscription::getwithid($user->package_id);
                             $current_package=App\Transaction::get_active_payment_details($user->id);?>
                            <span class="main-txt-icn refresh-icon">
                             <i class="fas fa-cloud-upload-alt"></i>
                            </span>
                            <?php if(date('Y-m-d') >=$current_package->end_date){ ?>
                            <h4 class="">Plan expired</h4>
                            <p>Your trial is expired. Click below to upgrade subscription <br> so that you can keep learning on this platform.</p>
                            <?php }else{ ?>
                           
                             <?php } ?>
                            <?php }else{ ?>
                            <p> Click below to upgrade to subscription packages <br> so that you can keep learning on this platform.</p>
                            <?php }} ?>
							
                              <div class="row">
                                  <div class="col-sm-12">
                                        <a href="{{url('/')}}/pricing" class="btn btn-resume btn-upgrade">Upgrade</a>
                                  </div>
                            </div>
                        </div>
                    </div>
                </div>
               @else
               <?php $count = 0; ?>
                @forelse($course as $c)
                <?php $tt=App\Usercourse::where('user_id',Session()->get('userid'))->where('course_id',$c->id)->where('status','1')->first();
                $enroled_ids = explode(",",$c->enroled_ids);
                $uid = Session()->get('userid');
                $ttt=App\Usercourse::where('user_id',Session()->get('userid'))->where('course_id',$c->id)->first();
                if(!empty($ttt) || in_array($uid,$enroled_ids)) {
                    $count++;
                if(!empty($tt))
                {
                $hide='hide';
                }else
                {
                   $hide='';  
                }?>
                <div class="col-sm-6 col-md-4 <?=$hide;?> ">
                <?php        
                $tt=App\Usercourse::where('user_id',Session()->get('userid'))->where('course_id',$c->id)->first();
                if(!empty($tt))
                {
                $percentage =\App\Userlesson::getviewedlessons(Session()->get('userid'),$c->id);
                $totalWidth =\App\Lesson::getlessoneithcoursecon($c->id,$user->package_id);
                if($totalWidth != '0'){
                $new_width = ($percentage / $totalWidth) * 100;
                echo '<style>
                .application-sec .newstyle'.$c->id.':before
                {
                   width:'.$new_width.'% !important; 
                }
                </style>';
                }
                echo '<div class="card card-00 newstyle'.$c->id.'"  > ';
                }else
                {
                 $new_width='0';
                echo '<div class="card card-00  newstyle'.$c->id.'" > ';
                 echo '<style>
                .application-sec .newstyle'.$c->id.':before
                {
                   width:'.$new_width.'% !important; 
                }
                </style>';  
                }
                ?>
                  
                    <div class="card-img">
                        <a class="startcourse" data-id="{{$c->id}}" href="{{url('course-details')}}/{{$c->id}}">
                            @if(empty($c->image))
							<img class="card-img-top" src="{{url('/')}}/resources/assets/img/card-icon.png" alt="Card image cap">
							@else
							<img class="card-img-top" src="{{url('/')}}/public/uploads/{{$c->image}}" alt="Card image cap">
							@endif
						</a>
                    </div>
                      <div class="card-body courses-body">
						<a class="startcourse" data-id="{{$c->id}}"href="{{url('course-details')}}/{{$c->id}}">
						<h5 class="card-title">
						{{$c->title}}
						</h5>
						</a>
                        <p class="card-text">
                          <?php
                            $string = strip_tags($c->description);
                            if (strlen($string) > 120) {
                            $stringCut = substr($string, 0, 120);$endPoint = strrpos($stringCut, ' ');$string = $endPoint? substr($stringCut, 0, $endPoint) : substr($stringCut, 0);$string .= '...';
                            }echo $string;
                          ?>
                        </p>
                        <?php
                        $t=0;
                        foreach($user_course as $u)
                        {
                        if($u->course_id == $c->id)
                        {
                        $t=$t+1;
                        }
                        }
                        if($t=='1'){ ?>
                        <a class="btn btn-resume" data-id="{{$c->id}}"  href="{{url('course-details')}}/{{$c->id}}">Resume</a>
                        <?php }else{ ?>
                        <a class="btn btn-resume startcourse" data-id="{{$c->id}}"  href="{{url('course-details')}}/{{$c->id}}">Start</a>
                        <?php }
                        ?>
                      </div>
                    </div>
                    
                  
                </div>
              <?php } ?>
                @empty
                No Couses found
                @endforelse
                @endif
                </div>
                @if($user->package_id !='')
                <div class="row">
                <div class="col-sm-12 text-center">
                <a class="btn btn-resume btn-see" href="{{url('/')}}/all-courses/1">See All</a>
                </div>
                </div> 
                @endif    
        </div>
    </section>

    <section class="application-sec courses-sec">
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                <h3>Completed Courses</h3>
                </div>
                @forelse($completed as $c)
                <div class="col-sm-6 col-md-4 hide{{$c->id}}">
                <?php        
                 $percentage =\App\Userlesson::getviewedlessons(Session()->get('userid'),$c->id);
                $totalWidth =\App\Lesson::getlessoneithcoursecon($c->id,$user->package_id);
                if($totalWidth != '0'){
                $new_width = ($percentage / $totalWidth) * 100;
                echo '<style>
                .application-sec .newstyle1'.$c->id.':before
                {
                   width:'.$new_width.'% !important; 
                }
                </style>';
                }
                 echo '<div class="card card-00 newstyle1'.$c->id.'"  > ';
                ?>
                <div class="card">
                <div class="card-img">
                <a href="{{url('course-details')}}/{{$c->id}}">
                            @if(empty($c->image))
							<img class="card-img-top" src="{{url('/')}}/resources/assets/img/card-icon.png" alt="Card image cap">
							@else
							<img class="card-img-top" src="{{url('/')}}/public/uploads/{{$c->image}}" alt="Card image cap">
							@endif
				</a>
                </div>
                <div class="card-body courses-body">
				<a href="{{url('course-details')}}">	
							<h5 class="card-title">	{{$c->title}}</h5>
				</a>
                <p class="card-text"> <?php
                            $string = strip_tags($c->description);
                            if (strlen($string) > 120) {
                            $stringCut = substr($string, 0, 120);$endPoint = strrpos($stringCut, ' ');$string = $endPoint? substr($stringCut, 0, $endPoint) : substr($stringCut, 0);$string .= '...';
                            }echo $string;
                          ?>
                </p>
                <a class="btn btn-resume redo_completed" href="javascript:void(0);" 
                data-id="{{$c->id}}" data-toggle="modal" data-target="#redo">Redo</a>
                </div>
                </div>
                   </div>
                  </div>
                @empty
                    <div class="col-sm-12">
                        <p class="label_completed">No data found..!</p>
                    </div>
                @endforelse

                 </div>
                 @if(count($completed)>='1')
                <div class="row">
                <div class="col-sm-12 text-center">
                <a class="btn btn-resume btn-see completed_seeall" href="{{url('/')}}/all-completed">See All</a>
                </div>
                </div> 
                @endif    
            </div>
        </div>
    </section>
	
    
@include('layouts/footer')
<div id="redo" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
      <button type="button" class="close" data-dismiss="modal">&times;</button>
      <h4 class="modal-title">Redo Course</h4>
      </div>
      <div class="modal-body">
      <p>Are you sure you want to reset ? This will start you from the beginning of the course and will DELETE your existing progress.</p>
      </div>
      <input type="hidden" id="redo_id">
      <div class="modal-footer">
      <button type="button" class="btn btn-success confirm_redo">Reset Progress</button>
      <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
      </div>
  </div>
</div>
<div id="app_del" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
      <button type="button" class="close" data-dismiss="modal">&times;</button>
      <h4 class="modal-title">Delete Application</h4>
      </div>
      <div class="modal-body">
      <p>Are you sure want to delete this application ? This action can't be undone.</p>
      </div>
      <input type="hidden" id="redo_app_id">
      <div class="modal-footer">
      <button type="button" class="btn btn-success confirm_app_del">Yes</button>
      <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
      </div>
  </div>
</div>
<script>

$(document).on('click', '.delete_cross', function () {
    $('#app_del').modal('show');
    var id=$(this).attr('data-id');
    $('#redo_app_id').val(id);
});
$(document).on('click', '.confirm_app_del', function () {
     var id=$('#redo_app_id').val();
     var base=$('#base_url').val();
	 var action =base+'/delapp';
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
                        $('#app_del').modal('hide');
                        $(".as1").html(obj.message);
                        $('.remove_app'+id).remove();
                        $(".as1").show();  
                       
                        setTimeout(function(){ $('.alert-success').hide(); }, 2000);
                        
                    }
                },
            });
    
});
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
                          var new2=parseInt($('.completed').html())-1;
                        $('.completed').html(new2);
                        var new1=parseInt($('.allusercourse').html())-1;
                        $('.allusercourse').html(new1);
                        var new3=((new2/new1) * 100).toFixed(0);
                      
                        if(new3 == 'NaN')
                        {
                            $('.new_per').html('0%');
                            $('.label_completed').html('No data found');
                        }else
                        {
                            $('.label_completed').html('');
                             $('.new_per').html(new3+'%');
                        }
                        setTimeout(function(){ $('.alert-success').hide(); }, 2000);
                        
                    }
                },
            });
       
    
});
$(document).on('click', '.redo_completed', function () {
    var id=$(this).attr('data-id');
    $('#redo_id').val(id);
    
});
$(document).on('click', '.startcourse', function () {
     var base=$('#base_url').val();
     var cid=$(this).attr('data-id');
	 var action =base+'/startcourse';
	 var data ={cid:cid};
         $.ajax({
          headers: {
              'X-CSRF-Token': $('input[name="_token"]').val()
          },
                type: 'post',
                url: action,
                data: data,
                success: function (data1) {
                //    alert();
				$('.get_act').html(data1);
                },
            });
    
});
</script>
  