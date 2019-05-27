@include('layouts/header')
<style>
.actvt-frm
{
word-break: break-all; 
}
.getdata .actvt-frm p
{
word-break: break-all;
}
.example_list .cont-heigt-ns {
height: 680px;
}
.wrap-sticky nav.navbar.bootsnav.sticked {
position: absolute;
}
.read_more
{background: #f48164 !important;
border: #f48164 !important;
color:#fff !important;
}
.read_more:hover
{background: #f48164 !important;
border: #f48164 !important;
color:#fff !important;

}
.read_less
{
background: #f48164;
border: #f48164; 
}
.subs-box
{
display:none;  
}
.prof-sec
{
display:none;
}
.error
{
color:red;
}
.cont-third{}
h4.dblt-drs {
font-size: 17px;
height: 53px;
}
.dblt-drs .mCSB_outside + .mCS-minimal-dark.mCSB_scrollTools_vertical {
right: 0px !important;
top: -18px !important;
}
</style>
 
<div id="myNav" class="overlay over-side">
  <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
  <div class="overlay-content mCustomScrollbar light" data-mcs-theme="minimal-dark">
		<div class="over-ly-cns">
		    <input type="hidden" name="" value="10" id="length">
			<h3>{{$course->title}}</h3>
			<div class="row">
				<div class="col-sm-12">
				   <?php 
                                if(!empty($user_course)){
                                $percentage = \App\Userlesson::getviewedlessons(Session()->get('userid'),$course->id);
                                $totalWidth =  \App\Lesson::getlessoneithcoursecon($course->id,$user->package_id);
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
					<div class="progress">
						 <div class="progress-bar progress-bar-danger progress-bar-striped " role="progressbar"
						  aria-valuenow="{{$percent_friendly}}" aria-valuemin="0" aria-valuemax="100" style="width:{{$percent_friendly}} !important">
						  </div>

					</div>
					  <p class="main-under-cls text-center">{{$percent_friendly}} <small> Complete</small></p>
				</div>
			</div>
        </div>
      
		<div class="cont-menu-lis ">
		    <h5> {{$syllabus->title}} </h5>
		    <input type="hidden" id="course_id" value="{{$syllabus->course_id}}">
			<ul class="dtls-lst">
			<?php $u=1;?>	<?php $flag=0;?>
			@forelse($s_lessons as $sl)
			<?php $i=$u++;?>
			<?php $gets=\App\Userlesson::where('lesson_id',$sl->id)->where('user_id',Session()->get('userid'))->first();?>
			<li data-id="{{$i}}"  @if($sl->id == $lesson->id )  class='active' @endif >
                    @if($sl->type=='Video')
                    <a  data-id="{{$sl->id}}"  href="@if($flag==0) {{url('/')}}/video-details/{{$sl->id}} @else javascript:void(0); @endif" data-no="{{$i}}" class=" <?php if($flag==1){ echo 'disabled';}?>  icns-ws view_lesson getlesson{{$sl->id}}">
                    <i class="fab fa-youtube"></i>
                    @else
                    <a data-id="{{$sl->id}}"  href="@if($flag==0) {{url('/')}}/interactive-exercise/{{$sl->id}} @else javascript:void(0); @endif" data-no="{{$i}}"  data-dhref="{{url('/')}}/interactive-exercise/{{$sl->id}}" class="<?php if($flag==1){ echo 'disabled';}?> show{{$i}}  icns-ws view_lesson getlesson{{$sl->id}}"> 
                    <i class="fas fa-file-alt"></i> 
                    @endif
                    {{$sl->name}} 
                    </a>
				</li>	<?php if(empty($gets) && $flag==0){
													                	    $flag=1;
													                	}?>
				@empty
				No Lessons found..!
				@endforelse
				
			</ul>
		</div>
  </div>
</div>
    <section class="application-sec courses-sec interactive-page">
		<div class="container-fluid">
            <div class="row">
                <div class="col-sm-12">
                    <h3>{{$syllabus->title}}
						<a href="{{url('/')}}/course-details/{{$syllabus->course_id}}" class="btn btn-warning btn-back"> <i class="fa fa-chevron-left d-none d-sm-block"></i><span class="d-sm-none">Back to Course</span> </a>
					</h3> 
                </div>

                <div class="col-sm-12">
					<div class="card">
						<div class="card-body">
							<ul class="list-expend">
								<li class="cont-third cstm-height editor-list example_list" style="position: relative;">
								    	<h4 class="dblt-drs mCustomScrollbar">  
								    	
								    	 <?php
                            $string = strip_tags($lesson->name);
                            if (strlen($string) > 30) {
                            
                            $stringCut = substr($string, 0, 30);
                            $endPoint = strrpos($stringCut, ' ');
                            
                         
                            $string = $endPoint? substr($stringCut, 0, $endPoint) : substr($stringCut, 0);
                            $string .= '';
                            }
                            echo $string
                          ?>

							<a class="full-vie full-hide" href="javascript:void(0)"><i class="fas fa-arrows-alt"></i></a>
							<a class="full-vie full-show" href="javascript:void(0)" style="display:none">
							<img src="{{url('/')}}/resources/assets/img/mini.png" class="back-exr mCS_img_loaded">
							</a>
							</h4>
									<div class="cont-heigt-ns mCustomScrollbar">
										<div class="cont-lst-s">
										        <?=$lesson->description;?>	
										</div>
									</div>
								</li>
								<li class="cont-third">
								     <h4 class="dblt-drs mCustomScrollbar"> 
                                        Write
                                        <a class="full-vie full-hide" href="javascript:void(0)"><i class="fas fa-arrows-alt"></i></a>
                                        <a class="full-vie full-show" href="javascript:void(0)" style="display:none">
                                        <img src="{{url('/')}}/resources/assets/img/mini.png" class="back-exr mCS_img_loaded">
                                        </a>
                                        </h4>
                                        <div class="cont-heigt-ns mCustomScrollbar">
                                        <div class="cont-lst-s">
                                       
                                        <div class="actvt-frm">
                                        <div class="panel-group panel-actvt" id="accordion" role="tablist" aria-multiselectable="true">
                                        
                                        <input type="hidden" value="{{$lesson->id}}" id="lesson_id">
                                        
                                        <input type="hidden" 
                                        value="{{$syllabus->id}}" id="syl">
                                        
                                        
                                        <input type="hidden" value="{{$syllabus->course_id}}" id="course_id">
                                        
                                       
                                        @if(count($user_activities)!='0')
                                        <input type="hidden" id="count" value="<?=count($user_activities);?>" >
                                        <?php $z=1;?>
                                        @foreach($user_activities as $u)
                                        <form class="addactivityuser" method="POST" data-action="{{ url('/') }}/add-activity-user" 
                                        data-next="{{ url('/') }}/interactive-exercise/{{$lesson->id}}">
                                        @csrf
                                        <div class="panel panel-default pnls">
                                        <div class="panel-heading" role="tab" id="heading{{$u->id}}">
                                        <h4 class="panel-title">
                                        <a role="button" class="get_activity_text" data-toggle="collapse" data-parent="#accordion" 
                                        href="#collapse{{$u->id}}" aria-expanded="false" aria-controls="collapse{{$u->id}}">
                                        Activity  {{$z++}}
                                        </a>
                                        </h4>
                                        </div>
										<div id="collapse{{$u->id}}" class="panel-collapse collapse" role="tabpanel" 
										aria-labelledby="heading{{$u->id}}">
										<div class="panel-body">
                                      
                                        <div class="row">
                                        <input type="hidden" name="name[]"  value="">
                                        <input type="hidden" name="lesson_id[]"  value="{{$u->lesson_id}}">
                                        <input type="hidden" name="syllabus_id[]"  value="{{$u->syllabus_id}}">
                                        <input type="hidden" name="id[]"  value="{{$u->id}}">
                                          <input type="hidden" name="random[]"  value="{{$u->random}}">
                                        <input type="hidden" name="course_id[]"  value="{{$u->course_id}}">
                                        <div class="col-md-12">
                                        <div class="form-group">
                                        <select class="form-control activity_type typeact" name="user_selection[]" required>
                                        <option value=""> Select Activity Type </option>
                                        @foreach($act as $acts)
                                      
                                        <option  @if(!empty($u->user_selection)) 
                                        @if($u->user_selection==$acts->name) 
                                        selected 
                                        @endif 
                                        @endif  value="{{$acts->name}}"><?php $get=\App\Activity::where('id',$acts->name)->first();
                                        echo $get->name;?></option>
                                        @endforeach
                                        </select>
                                        </div>
                                        </div>
                                        <div class="col-md-12">
                                        <div class="form-group">
                                        <input type="text" name="activity_title[]" placeholder="Activity Title" class="form-control"
                                        value="{{$u->activity_title}}" required >
                                        </div>
                                        </div>
										<div class="col-md-12">
										<div class="form-group">
										<textarea class="form-control  content22 summernote" id="exampleInputEmail1" rows="7"
										name="user_input[]" placeholder="Description" required>@if(!empty($u->user_input)){{$u->user_input}}@endif</textarea>
                                        </div>
                                        </div>
                                         <div class="col-md-12">
                                        <div class="form-group">
                                        <input type="text" name="activity_time[]" placeholder="Timing of participation" 
                                        class="form-control" value="{{$u->activity_time}}" required >
                                        </div>
                                        </div>
                                          <div class="col-md-12">
                                        <div class="form-group">
                                        <input type="text" name="participation_grade[]" placeholder="Participation grade levels" 
                                        class="form-control" value="{{$u->participation_grade}}" required >
                                        </div>
                                        </div>
                                         <div class="col-md-12">
                                        <div class="form-group">
                                        <input type="text" name="hour_week[]" placeholder="Hours spent per week" 
                                        class="form-control" value="{{$u->hour_week}}" required >
                                        </div>
                                        </div>
                                         <div class="col-md-12">
                                        <div class="form-group">
                                        <input type="text" name="week_year[]" placeholder="Weeks spent per year" 
                                        class="form-control" value="{{$u->week_year}}" required >
                                        </div>
                                        </div>
                                        </div>
                                        
                                        </div>
                                        </div>
                                        <a href="javascript:void(0)"  data-id="{{$u->id}}" class="delete_cross idss" id="remScnt"><i class="fa fa-times"></i></a>
                                        </div>
										@endforeach
										@for($i=count($user_activities)+1;$i<=10;$i++)
										<div class="panel panel-default pnls">
                                        <div class="panel-heading" role="tab" id="heading{{$i}}">
                                        <h4 class="panel-title">
                                        <a role="button" data-toggle="collapse" class="get_activity_text" data-parent="#accordion" 
                                        href="#collapse{{$i}}" aria-expanded="false" aria-controls="collapse{{$i}}">
                                        Activity  {{$i}}
                                        </a>
                                        </h4>
                                        </div>
										<div id="collapse{{$i}}" class="panel-collapse collapse" role="tabpanel" 
										aria-labelledby="heading{{$i}}">
										<div class="panel-body">
                                        <div class="row">
                                        <?php $random=mt_rand(100000, 999999);?>
                                        <input type="hidden" name="name[]"  value="">
                                        <input type="hidden" name="lesson_id[]"  value="{{$lesson->id}}">
                                        <input type="hidden" name="syllabus_id[]"  value="{{$syllabus->id}}">
                                        <input type="hidden" name="course_id[]"  value="{{$course_details[0]['id']}}">
                                        <div class="col-md-12">
                                        <div class="form-group">
                                        <select class="form-control activity_type typeact" name="user_selection[]" required>
                                        <option value=""> Select Activity Type </option>
                                        @foreach($act as $acts)
                                        <option value="{{$acts->name}}"><?php $get=\App\Activity::where('id',$acts->name)->first();
                                        echo $get->name;?></option>
                                        @endforeach
                                        </select>
                                        </div>
                                        </div>
                                        <div class="col-md-12 title_random">
                                        <div class="form-group">
                                        <input type="hidden" class="idss" name="id[]" value="0" >
                                        <input type="hidden"  name="random[]"  class="random_id" value="0" >
                                        <input type="text" name="activity_title[]" placeholder="Activity Title" class="form-control act_title" 
                                        value="" required >
                                        </div>
                                        </div>
										<div class="col-md-12">
										<div class="form-group">
										<textarea class="form-control content22 summernote" id="exampleInputEmail1" rows="7"
										name="user_input[]" placeholder="Description" required></textarea>
                                        </div>
                                        </div>
                                        <div class="col-md-12">
                                        <div class="form-group">
                                        <input type="text" name="activity_time[]" placeholder="Timing of participation" 
                                        class="form-control" value="" required >
                                        </div>
                                        </div>
                                        <div class="col-md-12">
                                        <div class="form-group">
                                        <input type="text" name="participation_grade[]" placeholder="Participation grade levels" 
                                        class="form-control" value="" required >
                                        </div>
                                        </div>
                                         <div class="col-md-12">
                                        <div class="form-group">
                                        <input type="text" name="hour_week[]" placeholder="Hours spent per week" 
                                        class="form-control" value="" required >
                                        </div>
                                        </div>
                                         <div class="col-md-12">
                                        <div class="form-group">
                                        <input type="text" name="week_year[]" placeholder="Weeks spent per year" 
                                        class="form-control" value="" required >
                                        </div>
                                        </div>
                                        </div>
                                        </div>
                                        </div>
                                        <a href="javascript:void(0)"  data-id="" class="delete_cross idss" id="remScnt"><i class="fa fa-times"></i></a>
                                        </div>
										@endfor
										@else
										@for($i=1;$i<=10;$i++)
										 <input type="hidden" id="count" value="10" >
										 <form class="addactivityuser" method="POST" data-action="{{ url('/') }}/add-activity-user" data-next="{{ url('/') }}/interactive-exercise/{{$lesson->id}}">
                                        @csrf
										<div class="panel panel-default pnls">
                                        <div class="panel-heading" role="tab" id="heading{{$i}}">
                                        <h4 class="panel-title">
                                        <a role="button" data-toggle="collapse" data-parent="#accordion" 
                                        href="#collapse{{$i}}"  class="get_activity_text"aria-expanded="false" aria-controls="collapse{{$i}}">
                                        Activity  {{$i}}
                                        </a>
                                        </h4>
                                        </div>
										<div id="collapse{{$i}}" class="panel-collapse collapse" role="tabpanel" 
										aria-labelledby="heading{{$i}}">
										<div class="panel-body">
                                        <div class="row">
                                         <?php $random=mt_rand(100000, 999999);?>
                                         <input type="hidden" id="files" type="file">
                                        <input type="hidden" name="name[]"  value="">
                                        <input type="hidden" name="lesson_id[]"  value="{{$lesson->id}}">
                                        <input type="hidden" name="syllabus_id[]"  value="{{$syllabus->id}}">
                                        <input type="hidden" name="course_id[]"  value="{{$syllabus->course_id}}">
                                        <div class="col-md-12">
                                        <div class="form-group">
                                        <select class="form-control activity_type typeact" name="user_selection[]" required>
                                        <option value=""> Select Activity Type </option>
                                        @foreach($act as $acts)
                                        <option value="{{$acts->name}}"><?php $get=\App\Activity::where('id',$acts->name)->first();
                                        if(!empty($get))
                                        {
                                        echo $get->name;
                                        }else
                                        {
                                            echo 'Not Exist';
                                        }?></option>
                                        @endforeach
                                        </select>
                                        </div>
                                        </div>
                                          <div class="col-md-12 title_random">
                                        <div class="form-group">
                                        <input type="hidden" class="idss" name="id[]" value="0" >
                                        <input type="hidden"  name="random[]"  class="random_id" value="0" >
                                        <input type="text"  class="form-control act_title" name="activity_title[]" 
                                        placeholder="Activity Title"required>
                                        </div>
                                        </div>
										<div class="col-md-12">
										<div class="form-group">
										<textarea class="form-control content22 summernote" id="exampleInputEmail1" rows="7"
										name="user_input[]" placeholder="Description" required></textarea>
                                        </div>
                                        </div>
                                        <div class="col-md-12">
                                        <div class="form-group">
                                        <input type="text" name="activity_time[]" placeholder="Timing of participation" 
                                        class="form-control" value="" required >
                                        </div>
                                        </div>
                                        <div class="col-md-12">
                                        <div class="form-group">
                                        <input type="text" name="participation_grade[]" placeholder="Participation grade levels" 
                                        class="form-control" value="" required >
                                        </div>
                                        </div>
                                         <div class="col-md-12">
                                        <div class="form-group">
                                        <input type="text" name="hour_week[]" placeholder="Hours spent per week" 
                                        class="form-control" value="" required >
                                        </div>
                                        </div>
                                         <div class="col-md-12">
                                        <div class="form-group">
                                        <input type="text" name="week_year[]" placeholder="Weeks spent per year" 
                                        class="form-control" value="" required >
                                        </div>
                                        </div>
                                        </div>
                                        
                                        </div>
                                        </div>
                                        <a href="javascript:void(0)"  class="delete_cross idss" data-id="" id="remScnt"><i class="fa fa-times"></i></a>
                                        </div>
										@endfor
										@endif
										<div id="afteradd"></div>
										</div>	@if(Session()->exists('user'))
										<a href="javascript:void(0)" id="addScnt"><i class="fa fa-plus"></i> Add Another Activity</a>
										@endif
										</form>
										</div>
										</div>
										</div>
										<div class="btn-all-s">
										 <button class=" save_user_act"
										  type="button">
									    </button>
										<button class="btn btn-success btn-rd  save_message"
										  data-placement="right" title="Save" data-toggle="tooltip"  type="button">
									    <i class="fa fa-save" aria-hidden="true"></i></button>    
										<a href="#" data-toggle="tooltip" data-placement="left" title="Reset Activity List" class="btn-rd right-rfts reset_all" >
										<i class="fa fa-retweet" aria-hidden="true"></i>
										</a>
										</div>	
								</li>
								<li class="cont-third cstm-height editor-list example_list" >
								    <input type="hidden" value="" id="egcount">
								    <input type="hidden" value="" id="totaleg">
								    <h4 class="dblt-drs mCustomScrollbar"> 
												Examples 
												<a class="full-vie full-hide" href="javascript:void(0)"><i class="fas fa-arrows-alt"></i></a>
												<a class="full-vie full-show" href="javascript:void(0)" style="display:none">
													<img src="{{url('/')}}/resources/assets/img/mini.png" class="back-exr mCS_img_loaded">
												</a>
											</h4>
                                            <div class="cont-heigt-ns mCustomScrollbar">
                                            <div class="cont-lst-s">
                                            <div class="getdata">
                                            </div>
                                            </div>
									</div>
								</li>
							</ul>
						</div>
                    </div>
                </div>
              </div>
            </div>
        </div>
    </section>
	
	<div class="foot-fxsd">
		<div class="container-fluid">
			<div class="row">
				<div class="col-xs-2">
					<a href="#" class="collps-br toggls-icn" onclick="openNav()">
						<i class="fa fa-bars" aria-hidden="true"></i>
					</a>
				</div>
				<div class="col-xs-8 text-center">
					<ul class="nxt-back">
						<li>
							<a href="javascript:void(0);" class="back-s" data-id="{{$lesson->id}}"> Back </a>
						</li>
						<li>
							<span class="no-bss"> <span class="active_lesson">1</span>/<span class="total_lesson">{{count($s_lessons)}}</span></span>
						</li>
						<li>
						    
							<a href="javascript:void(0);" data-cid="{{$lesson->course_id}}" class="next-s" data-next="" data-id="{{$lesson->id}}"> Next </a>
						</li>
					</ul>
				</div>
				<div class="col-xs-2">
				
				</div>
			</div>
		</div>
	</div>
	
	<div class="modal del-modal fade" id="delete_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-body text-center">
				<i class="icon-close"></i>
				<h1>Are you sure?</h1>	
				<p class="lbl">Do you really want to reset this activity list ? This action cannot be undone.</p>
				<ul class="action-btns">					
					<li>
						<button type="button" class="btn  btn-light mr-2" data-dismiss="modal">Cancel</button>
					</li>
					<li>
					    <button type="button" class="btn  btn-danger confirm_delete_list">Delete</button>
					</li>
				</ul>
			</div>
			
		</div>
	</div>
</div>
	
	
	

@include('layouts/footer')
<link href="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.11/summernote.css" rel="stylesheet">
<script src="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.11/summernote.js"></script>
<script>
$(document).ready(function() {
var act=$('li.active').data('id')
$('.active_lesson').text(act);
if(act=='1')
{
$('.back-s').hide();
}
if($('.active_lesson').text()==$('.total_lesson').text())
{
$('.next-s').hide();   
}

var totalFiles = document.getElementsByClassName('delete_cross').length;
$('#length').val(totalFiles);

});
</script>
<script>
$('.panel-title a:first').attr('aria-expanded',true);
$('.panel-collapse:first').addClass('in');

var _changeInterval = null;

function delay(callback, ms) {
var timer = 0;
return function() {
var context = this, args = arguments;
clearTimeout(timer);
timer = setTimeout(function () {
callback.apply(context, args);
}, ms || 0);
};
}


$(document).on('keyup', '.act_title', delay(function (e){
var minNumber = 1; // le minimum
var maxNumber = 1000000; // le maximum
var randomnumber = Math.floor(Math.random() * (maxNumber + 1) + minNumber); // la fonction magique
$(this).closest('.title_random').find('.random_id').val(randomnumber); 
$(this).closest('.title_random').find('.idss').addClass('getid'+randomnumber); 
$(this).closest('.title_random').find('.delete_cross').addClass('getid'+randomnumber); 
$(this).parent().parent().parent().parent().parent().parent().find('.delete_cross').addClass('getid'+randomnumber); 

}, 1000));
$(document).on('keyup', '.form-control', delay(function (e){
$('.save_user_act').trigger('click');
}, 2000));



$(document).on('click', '.save_message', function () {
$(".as1").html("Saved user activity..!");
$(".as1").show();  
setTimeout(function(){ $('.alert-success').hide(); }, 2000);

});
$(document).on('click', '.save_user_act', function () {
if($('.addactivityuser').valid())
{
submitform111('addactivityuser','save_user_act');
}
});
function submitform111(form,btn)
{
var data = new FormData('.'+form);
var other_data = $('.'+form).serializeArray();
$.each(other_data,function(key,input){
data.append(input.name,input.value);
});
var action = $('.'+form).attr('data-action');
$.ajax({
headers: {
'X-CSRF-Token': $('input[name="_token"]').val()
},
type: 'post',
url: action,
data: data,
contentType: false,
cache: false,
processData:false,
dataType:'json',
success: function (data) {
if(data.data !='')
{
data.data.forEach(function(data){
$('.getid'+data.random).val(data.act_id);
$('.getid'+data.random).attr("data-id",data.act_id);
$('.getid'+data.random).data("act_id",data.act_id);
})
}
var next = $('.'+form).attr('data-next');
if(next !=''){
}
},
}); 
}
$(document).on('click', '.confirm_delete_list', function () {
var table="user_activities";
var base=$('#base_url').val();
var action =base+'/deleteactivitylist';
var token=$('input[name="_token"]').val();
var data ={_token:token,table:table};
$.ajax({
headers: {
'X-CSRF-Token': $('input[name="_token"]').val()
},
type: 'post',
url: action,
data: data,
success: function (data1) {
$('#delete_modal').modal('hide');
$(".as1").html("List deleted successfully...!");
$(".as1").show();  
setTimeout(function(){ $('.alert-success').hide(); }, 3000);
location.reload();
},
}); 


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
// alert();
$('.get_act').html(data1);
},
});

});
$(document).on('change', '.typeact', function () {
var id=$(this).val();
var table="example";
var base=$('#base_url').val();
var course=$('#course_id').val();
var action =base+'/getexamples_more';
var token=$('input[name="_token"]').val();
var data ={course:course,id:id,_token:token,table:table};
$.ajax({
headers: {
'X-CSRF-Token': $('input[name="_token"]').val()
},
type: 'post',
url: action,
data: data,
success: function (data1) {
$('#totaleg').val(data1);
},
}); 

});
$(document).on('change', '.activity_type', function () {
var id=$(this).val();
var table="example";
var base=$('#base_url').val();
var course=$('#course_id').val();
var action =base+'/getexamples';
var token=$('input[name="_token"]').val();
var data ={course:course,id:id,_token:token,table:table};
$.ajax({
headers: {
'X-CSRF-Token': $('input[name="_token"]').val()
},
type: 'post',
url: action,
data: data,
success: function (data1) {
$('#egcount').val('1');
$('.getdata').html(data1);
$( ".actvt-frm:gt(1)" ).css( "display", "none" );
$( ".actvt-frm:gt(1)" ).css( "display", "none" );
},
}); 

});
</script>
<script>
$(function() {
var scntDiv = $('#afteradd');
var i = parseInt($('#count').val()) + 1;
$('#addScnt').on('click', function(){
var count=$('#length').val();
var lessoncount=parseInt($('#length').val())+1;
$('#length').val(lessoncount);
var less_id=$('#lesson_id').val();
var syla_id=$('#syl').val();
var course_id=$('#course_id').val();
var htm=$('.activity_type').html();
var minNumber = 1; // le minimum
var maxNumber = 1000000; // le maximum
var randomnumber = Math.floor(Math.random() * (maxNumber + 1) + minNumber); // la fonction magique
var base=$('#base_url').val();
var action =base+'/getwithlesson';
var data ={less_id:less_id};
$.ajax({
headers: {
'X-CSRF-Token': $('input[name="_token"]').val()
},
type: 'post',
url: action,
data: data,
success: function (data1) {

//	$('.get_act').html(data1);


},
}); 
$('<div class="panel panel-default pnls"><div class="panel-heading" role="tab" id="headingThree'+i+'"><h4 class="panel-title"><a class="collapsed get_activity_text" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseThree'+i+'" aria-expanded="false" aria-controls="collapseThree'+i+'">Activity '+lessoncount+'</a></h4></div><div id="collapseThree'+i+'" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingThree'+i+'"><div class="panel-body"><div class="row"><div class="col-md-12"><div class="form-group"><input type="hidden" name="lesson_id[]" value="'+less_id+'"><input type="hidden" name="syllabus_id[]" value="'+syla_id+'"><input type="hidden" name="course_id[]" value="'+course_id+'"><select class="form-control get_act" name="user_selection[]"><option> Select Type </option>'+htm+'</select></div></div><div class="col-md-12"><div class="form-group"><input type="hidden" class="idss" name="id[]" value="0" ><input type="hidden" name="random[]"class="random_id" value="0"><input type="text" name="activity_title[]" class="form-control" placeholder="Activity Title"></div></div><div class="col-md-12"><div class="form-group"><textarea class="form-control content22  content1" id="exampleInputEmail1" name="user_input[]" rows="7" placeholder="Description"></textarea></div></div><div class="col-md-12"><div class="form-group"><input type="text" name="activity_time[]" class="form-control" placeholder="Timing of participation"></div></div><div class="col-md-12"><div class="form-group"><input type="text" name="participation_grade[]" placeholder="Participation grade levels" class="form-control" value="" required ></div></div><div class="col-md-12"><div class="form-group"><input type="text" name="hour_week[]" placeholder="Hours spent per week" class="form-control" value="" required ></div></div><div class="col-md-12"><div class="form-group"><input type="text" name="week_year[]" placeholder="Weeks spent per year" class="form-control" value="" required ></div></div></div></div></div><a href="javascript:void(0)" class="delete_cross idss" id="remScnt"><i class="fa fa-times"></i></a></div>').appendTo(scntDiv);
i++;
return false;
});

$('body').on('click', '.back-s', function(){
var act=$('li.active').data('id')
var actplus=act -1;
if(actplus == '0')
{

}else
{
var href=$('.show'+actplus).attr('href');
var next=$(this).attr('data-next');
var attr=$( ".getlesson"+next ).attr('href');
window.location.href= href;   
}


});

$('body').on('click', '.read_less', function(){
var id=$(this).data("category");
$('.hide'+id).show();
$('.hideless'+id).hide();
$('.get_results').html("");  


});
$('body').on('click', '.read_more', function(){

var id=$(this).data("category");
var table="example";
var base=$('#base_url').val();
var course=$(this).data("course");

var action =base+'/getexamples_more';
var token=$('input[name="_token"]').val();
var data ={course:course,id:id,_token:token,table:table};
$.ajax({
headers: {
'X-CSRF-Token': $('input[name="_token"]').val()
},
type: 'post',
url: action,
data: data,
success: function (data1) {
var eg=$('#egcount').val();
var new1=parseInt(eg)+1;
$('#egcount').val(new1);
if($('#totaleg').val() == new1)
{
$('.hide'+id).hide();
}else
{
$('.hide'+id).show();
}
$( ".actvt-frm:nth-child("+new1+")" ).css( "display", "block" );

},
}); 
});
$('body').on('click', '.next-s', function(){
var act=$('li.active').data('id')
var actplus=act +1;
var href=$('.show'+actplus).attr('href');
//var id=$(this).attr('data-id');
var next=$(this).attr('data-next');
var attr=$( ".getlesson"+next ).attr('href');
if(href="javascript:void(0);")
{
var href1=$('.show'+actplus).attr('data-dhref');

var base=$('#base_url').val();
var lid=$('.show'+actplus).attr('data-id');
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
// alert();
window.location.href= href1;
},

//$( ".getlesson"+next ).trigger('click');

});
}else
{
alert(href);
window.location.href= href;
}

});
$('body').on('click', '.reset_all', function(){
// alert(); 
$('#delete_modal').modal('show');

});
$('body').on('click', '.delete_cross', function(){
var id=$(this).attr("data-id");
var base=$('#base_url').val();
var action =base+'/delete_useractivity';
var data ={id:id};
$.ajax({
headers: {
'X-CSRF-Token': $('input[name="_token"]').val()
},
type: 'post',
url: action,
data: data,
success: function (data1) {
},
});

$(this).parents('.pnls').remove();
var totalFiles = document.getElementsByClassName('delete_cross').length;

$('#length').val(totalFiles);
var count=1;
$('.get_activity_text').each(function() { 

$(this).text('Activity '+count);
count=count+1;
});
$('.save_user_act').trigger('click');
});
});
$(function () {
$('[data-toggle="tooltip"]').tooltip()
})
</script>