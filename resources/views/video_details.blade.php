@include('layouts/header')

<style>
.prof-sec
{
display:none;
}
</style>
<div id="myNav" class="overlay over-side">
<a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
<div class="overlay-content mCustomScrollbar light" data-mcs-theme="minimal-dark">
<div class="over-ly-cns">
<h3>{{$course[0]['title']}}</h3>
<div class="row">
<div class="col-sm-12">
<?php 
if(!empty($user_course)){
$percentage = \App\Userlesson::getviewedlessons(Session()->get('userid'),$course[0]['id']);
$totalWidth =  \App\Lesson::getlessoneithcoursecon($course[0]['id'],$user->package_id);



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
<div class="cont-menu-lis">
<h5> {{$syllabus->title}} </h5>
<ul class="dtls-lst">
@forelse($s_lessons as $sl)
<li @if($sl->id == $lesson->id )  class='active' @endif
>
@if($sl->type=='Video')
<a href="{{url('/')}}/video-details/{{$sl->id}}" class="icns-ws">
<i class="fab fa-youtube"></i>
@else
<a href="{{url('/')}}/interactive-exercise/{{$sl->id}}" class="icns-ws"> 
<i class="fas fa-file-alt"></i> 
@endif
{{$sl->name}} 
</a>
</li>
@empty
No Lessons found..!
@endforelse
</ul>
</div>
</div>
</div>
<section class="application-sec courses-sec mt-20">
<span class="toggls-icn" onclick="openNav()">&#9776; </span>
<div class="container">
<div class="row">
<div class="col-sm-12">
<h3>{{$lesson->name}}
<a href="{{url('/')}}/course-details/{{$lesson->course_id}}" class="btn btn-warning btn-back"> <i class="fa fa-chevron-left d-none d-sm-block"></i><span class="d-sm-none">Back to Course</span> </a>
</h3> 
</div>
<div class="col-sm-12">
<div class="card">
<div class="card-body">
<div class="video-dtl">
<video width="100%" controls="controls" preload="auto" loop="loop">
<source src="{{url('/')}}/public/uploads/{{$lesson->description}}" type="video/mp4">
</video>
</div>
</div>
</div>
</div>
</div>
</div>
</div>
</section>
@include('layouts/footer')
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

$('.getdata').html(data1);


},
}); 

});
</script>
<script>
$(function() {
var scntDiv = $('#afteradd');
var i = parseInt($('#count').val()) + 1;
//$('#addScnt').live('click', function() {
$('#addScnt').on('click', function(){
var count=$('#length').val();
var lessoncount=parseInt($('#length').val())+1;
$('#length').val(lessoncount);
var less_id=$('#lesson_id').val();
var syla_id=$('#syl').val();
var course_id=$('#course_id').val();
var htm=$('.activity_type').html();
//alert(htm);
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
},
}); 
$('<div class="panel panel-default pnls"><div class="panel-heading" role="tab" id="headingThree'+i+'"><h4 class="panel-title"><a class="collapsed get_activity_text" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseThree'+i+'" aria-expanded="false" aria-controls="collapseThree'+i+'">Activity '+lessoncount+'</a></h4></div><div id="collapseThree'+i+'" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingThree'+i+'"><div class="panel-body"><div class="row"><div class="col-md-12"><div class="form-group"><input type="hidden" name="lesson_id[]" value="'+less_id+'"><input type="hidden" name="syllabus_id[]" value="'+syla_id+'"><input type="hidden" name="course_id[]" value="'+course_id+'"><select class="form-control get_act" name="user_selection[]"><option> Select Type </option>'+htm+'</select></div></div><div class="col-md-12"><div class="form-group"><input type="hidden" class="idss" name="id[]" value="0" ><input type="hidden" name="random[]"class="random_id" value="0"><input type="text" name="activity_title[]" class="form-control" placeholder="Activity Title"></div></div><div class="col-md-12"><div class="form-group"><textarea class="form-control content22  content1" id="exampleInputEmail1" name="user_input[]" rows="7" placeholder="Title"></textarea></div></div><div class="col-md-12"><div class="form-group"><input type="text" name="activity_time[]" class="form-control" placeholder="Time"></div></div></div></div></div><a href="javascript:void(0)" class="delete_cross" id="remScnt"><i class="fa fa-times"></i></a></div>').appendTo(scntDiv);
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
$('.hide'+id).hide();
$('.get_results').html(data1);
},
}); 
});
$('body').on('click', '.next-s', function(){
var act=$('li.active').data('id')
var actplus=act +1;
var href=$('.show'+actplus).attr('href');
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

});
}else
{
alert(href);
window.location.href= href;
}

});
$('body').on('click', '.reset_all', function(){
$('#delete_modal').modal('show');
});
$('body').on('click', '.delete_cross', function(){
$(this).parents('.pnls').remove();
var totalFiles = document.getElementsByClassName('delete_cross').length;
$('#length').val(totalFiles);
var count=1;
$('.get_activity_text').each(function() { 

$(this).text('Activity '+count);
count=count+1;
});
});
});
$(function () {
$('[data-toggle="tooltip"]').tooltip()
})
</script>