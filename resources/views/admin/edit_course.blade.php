@include('layouts/admin_header')
<style>
.note-children-container
{
display:none;
}div.p_scents_act {
float: left;
width: 100%;  
}
div.p_scents ,div.width-100{
float: left;
width: 100%;
}
.ap_exp
{float: left;
width: 100%;

}
.new
{
margin-bottom:15px;
}div.syllabus_scents1 {
float: left;
width: 100%;
}
</style>
<!-- Content_right -->
<div class="container_full">
@include('layouts/admin_sidebar')
<div class="content_wrapper">
<div class="container-fluid">
<section class="chart_section">
<div class="row">
<div class="col-xl-12 col-lg-12 mb-4">
<div class="card card-shadow mb-4">
<div class="card-header">   
<div class="card-title">
Edit Course
</div>
</div>
<div class="card-body tabs-ctds">
<div class="row">
<div class="col-xl-12">
<ul class="nav nav-tabs" role="tablist">
<li class="nav-item">
<a class="nav-link active" data-toggle="tab" href="#tab_1">Basic Description</a>
</li>
<li class="nav-item">
<a class="nav-link" data-toggle="tab" href="#tab_3">Course Overview</a>
</li>
<li class="nav-item">
<a class="nav-link" data-toggle="tab" href="#tab_4">Heading</a>
</li>
<li class="nav-item">
<a class="nav-link" data-toggle="tab" href="#tab_5">Lesson</a>
</li>
<li class="nav-item">
<a class="nav-link" data-toggle="tab" href="#tab_6">Activity</a>
</li>
<li class="nav-item">
<a class="nav-link" data-toggle="tab" href="#tab_7">Example</a>
</li>
</ul>
<div class="tab-content">
<div class="tab-pane active" id="tab_1" role="tabpanel">
<form class="editcourse" method="POST" data-next="" data-action="{{ url('/') }}/admin/edit-course/{{$course_details['id']}}" >
@csrf
<div class="row">
<div class="form-group col-sm-12 col-12">
<input type="hidden" value="<?=$course_details['id'];?>" name="id" >
<input type="hidden" id="" name="image_course" value="{{$course_details['image']}}" >
<label for="exampleInputPassword10">Course Title</label>
<input type="text" class="form-control form-control-square" name="title" id="" value="<?=$course_details['title'];?>">
</div>
</div>
<div class="row">
<div class="form-group col-sm-10 col-10">
<label for="exampleInputPassword10">Course Image</label>
<input type="file" name="file" class="form-control form-control-square fileupload" id="files" placeholder="">
</div>
<div class="form-group col-sm-2 col-2">
@if(empty($course_details['image']))
<img class="img-shw upsave" src="{{url('/')}}/resources/admin_assets/images/discipline.png">
@else
<img class="img-shw upsave" src="{{url('/')}}/public/uploads/{{$course_details['image']}}">
@endif
<img id="blah" src="#" alt="your image" class="media-object" style="display:none;" />
</div>
</div>
<div class="row">	
<div class="form-group col-sm-12 col-12">
<label for="exampleInputPassword10">Description</label>
<textarea class="content1 description"   id ="editor"  name="description"><?=$course_details['description'];?></textarea>
<div class="description_label"></div>
</div>
</div>
<div class="row">	
<div class="form-group col-sm-12 col-12">
<button class="btn btn-info btn-lg edit_course_btn pull-right mr-1" type="submit">
Submit
</button>
<button class="btn btn-secondary btn-lg pull-right mr-1" type="">
Cancel
</button>
</div>
</div>
</form>
</div>
<div class="tab-pane" id="tab_3" role="tabpanel">
<form class="addcourse_overview" method="POST" data-next='' data-action="{{ url('/') }}/admin/edit-course/{{$course_details['id']}}" >
@csrf
<div class="row">	
<div class="form-group col-sm-12 col-12">
<label for="exampleInputPassword10">Course Overview</label>
<textarea class="content1 overview" id="content1" name="course_overview"><?=$course_details['course_overview'];?></textarea>
<div class="overview_label"></div>
</div>
</div>
<div class="row">	
<div class="form-group col-sm-12 col-12">
<button class="btn btn-info btn-lg add_course_overview pull-right mr-1" type="button">
Submit
</button>
<button class="btn btn-secondary btn-lg pull-right mr-1" type="">
Cancel
</button>
</div>
</div>	
</form>
</div>
<div class="tab-pane" id="tab_4" role="tabpanel">
<form class="edit_heading" method="POST" enctype="multipart/form-data"  data-next="" action="{{ url('/') }}/admin/edit-course/{{$course_details['id']}}" >
@csrf
<input type="hidden" id="" name="add_syllabus" value="edit_heading">
<input type="hidden" id="course_id2" name="course_id" value="<?=$course_details['id'];?>">
<div class="row">	
<div class="form-group col-sm-12 col-12">
<h4 class="dvl-brdr"> Heading 
<a href="javascript:void(0)" data-course="<?=$course_details['id'];?>" class="pull-right btn btn-success btn-adda" 
id="add-syllabus"> Add Heading </a>
<input type="hidden" value="0" id="getvalue">
</h4>
</div>
<?php 
$inc=0;
foreach($heading as $ky=>$s){
if($ky==$inc)
{
$it=$inc++;
?>
<div class="col-md-12 remove<?=$s['random_no'];?>">
<div class="row">
<div class="form-group col-sm-12 col-12">
<input type="hidden"   value="<?=$s['id'];?>" id="" name="title[0][syllabus_id][]">
<label class="d-block">Heading Title</label>
<input type="text" class="form-control form-control-square"  value="<?=$s['title'];?>" id="" name="title[0][title][]"
placeholder="" required>
<input type="hidden" value="<?=$s['random_no'];?>" name="title[0][random_no][]">
</div>
<a href="javascript:void(0)" class="remScnt rmvs-s heading" 
data-table="syllabus" data-course="<?=$s['course_id'];?>" data-random="<?=$s['random_no'];?>">
<i class="fa fa-times"></i></a>
</div>
<!--lessons-->
</div>
<?php } } ?>
<div class="syllabus_scents1"></div>
</div>
<div class="row">	
<div class="form-group col-sm-12 col-12">
<button class="btn btn-info btn-lg edit_course_syl pull-right mr-1 " type="submit">
Submit
</button>
<button class="btn btn-secondary btn-lg pull-right mr-1" type="">
Cancel
</button>
</div>
</div>
</form>
</div>
<div class="tab-pane" id="tab_5" role="tabpanel">
<form class="edit_lesson" method="POST"  data-next="" 
data-action="{{ url('/') }}/admin/edit-course/{{$course_details['id']}}" >
@csrf
<input type="hidden" id="" name="add_syllabus" value="edit_lesson">
<input type="hidden" id="course_id2" name="course_id"  value="<?=$course_details['id'];?>">
@foreach($heading as $h)
<div class="col-md-12 subj-head_box-edit remove<?php echo $h['random_no'];?>">
<div class="row">
<div class="form-group col-sm-12 col-12 p-0">
<h4 class="dvl-brdr edit<?php echo $h['random_no'];?>"><?php echo $h['title'];?>
<a href="javascript:void(0)" class="float-right pull-right btn btn-info addScnt btn-adda" 
id="addScnt"  data-count="<?php echo $h['id'];?>"  data-val="<?php echo $h['id'];?>" 
data-id="<?php echo $h['random_no'];?>"> Add Lesson </a>
</h4>
<input type="hidden" value="0" id="getvalue">
<input type="hidden" name="title[<?php echo $h['id'];?>][syllabus_id][]"
class="sylb_id edit<?php echo $h['random_no'];?>" data-count="<?php echo $h['id'];?>" 
value="<?php echo $h['id'];?>">
</div>
</div>
@forelse($h['lesson'] as $l)
<div class="row removelesson{{$l['random_no']}}">
<div class="bg-ns-a">
<div class="form-group col-sm-12 col-12">
<label class="d-block" for="exampleInputPassword10">Lesson Name
</label>
<input type="text" class="form-control form-control-square" id="" 
value="{{$l['name']}}" maxlength="30" 	name="title[<?php echo $h['id'];?>][name][]" placeholder="" required>
<input type="hidden"  name="title[<?php echo $h['id'];?>][random_no][]" value="<?php echo $l['random_no'];?>">
</div>
<div class="form-group col-sm-12 col-12">
<label for="exampleInputPassword10">Content Type</label>
{{$l['type']}}
<select id="colorselector<?php echo $l['random_no'];?>"  
onchange="chnagefun(<?php echo $l['random_no'];?>)" 
class="colorselector<?php echo $l['random_no'];?> form-control form-control-square"
name="title[<?php echo $h['id'];?>][type][]" 
required>
<option value="">Select One</option>
<option @if($l['type']=='Video') selected @endif value="Video<?php echo $l['random_no'];?>">Video</option>
<option  @if($l['type']=='Exercise') selected @endif value="Exercise<?php echo $l['random_no'];?>"
>Exercise</option>
</select>
</div>
<div class="form-group col-sm-12 col-12">
<label for="exampleInputPassword10">Lesson Number</label>
<input type="text" value="{{$l['lesson_no']}}" class="form-control  quantity form-control-square" 
name="title[<?php echo $h['id'];?>][lesson_no][]" 
required>
</div>

<div class="form-group col-sm-12 col-12">
<label for="exampleInputPassword10">Duration</label>
<input type="text" value="{{$l['duration']}}" class="form-control form-control-square" 
name="title[<?php echo $h['id'];?>][duration][]" 
required>
</div>
@if($l['type']=='Video')
<div class="form-group col-sm-12 col-12 colors<?php echo $l['random_no'];?> Video<?php echo $l['random_no'];?>" id="Video<?php echo $l['random_no'];?>">
<label for="exampleInputPassword10">Add Video</label>
<div class="">
<video width="320" height="240" controls>
<source src="{{url('/')}}/public/uploads/{{$l['description']}}" type="video/mp4">
</video>
</div>
<input type="hidden"  name="title[<?php echo $h['id'];?>][file][]" 
class="file_video<?php echo $l['random_no'];?>" value="{{$l['description']}}">
<input type="file"   data-random="<?php echo $l['random_no'];?>"  
class="form-control form-control-square files file_video" data-random="<?php echo $l['random_no'];?>" id="file_video<?php echo $l['random_no'];?>" placeholder="">
</div>
<div class="form-group col-sm-12 col-12 colors<?php echo $l['random_no'];?> Exercise<?php echo $l['random_no'];?>" id="Exercise<?php echo $l['random_no'];?>" style="display:none">
<label for="exampleInputPassword10">Learn Column</label>
<textarea class="summernote" id="content21" name="title[<?php echo $h['id'];?>][description][]" ></textarea></div>
@else
<div class="form-group col-sm-12 col-12 colors<?php echo $l['random_no'];?> Exercise<?php echo $l['random_no'];?>" id="Exercise<?php echo $l['random_no'];?>">
<label for="exampleInputPassword10">Learn Column</label>
<textarea class="summernote" id="content21" name="title[<?php echo $h['id'];?>][description][]" >{{$l['description']}}</textarea>
</div>

<div class="form-group col-sm-12 col-12 colors<?php echo $l['random_no'];?> Video<?php echo $l['random_no'];?>" id="Video<?php echo $l['random_no'];?>" style="display:none">
<label for="exampleInputPassword10">Add Video</label>
<div class="">
</div>
<input type="hidden"  name="title[<?php echo $h['id'];?>][file][]" 
class="file_video<?php echo $l['random_no'];?>" >
<input type="file"   data-random="<?php echo $l['random_no'];?>"  
class="form-control form-control-square files file_video" data-random="<?php echo $l['random_no'];?>" id="file_video<?php echo $l['random_no'];?>" placeholder="">
</div>





@endif
<a href="javascript:void(0)" class="remScnt rmvs-s heading" 
data-table="lesson" data-course="<?=$l['course_id'];?>" data-random="<?=$l['random_no'];?>">
<i class="fa fa-times"></i></a>
</div>
</div>

@empty
<span class="hideempty<?php echo $h['random_no'];?>"> No Lessons found...!</span>
@endforelse
<div class="p_scents  p_scents<?php echo $h['random_no'];?> " ></div>
</div><div class="clearfix"></div>
@endforeach

<span class="p_scents"></span>
<span class="learn_html"></span><div class="clearfix"></div>
<div class="row">	
<div class="form-group col-sm-12 col-12">
<button class="btn btn-info btn-lg edit_lesson_syl pull-right mr-1 " type="button">
Submit
</button>
<button class="btn btn-secondary btn-lg pull-right mr-1" type="">
Cancel
</button>
</div>
</div>
</form>
</div>



<!--activity tab-->
<div class="tab-pane activity_form" id="tab_6" role="tabpanel">
<form class="edit_activity" method="POST"  data-next="" data-action="{{ url('/') }}/admin/edit-course/{{$course_details['id']}}">
@csrf
<input type="hidden" id="" name="add_syllabus" value="edit_activity">
<input type="hidden" id="course_id5" name="course_id" value="<?=$course_details['id'];?>">
<div class="row">
<div class="col-md-12">
<div class="row">
<div class="form-group col-sm-12 col-12">
<h4 for="exampleInputPassword10" class="dvl-brdr edit">Activity Type
</div>
</div>
<div class="row">
<div class="col-md-12">
<select id="langOpt" name="activity_type[]"  class=" form-control" multiple >
@foreach($activity_admin as $s)
<option
@if(!empty($activitys))
@foreach($activitys as $a)
@if($a->name == $s->id)
selected
@endif
@endforeach
@endif
value="{{$s->id}}">{{$s->name}}</option>
@endforeach
</select>
</div> </div>
</div>
</div>  
<div class="row">	
<div class="form-group col-sm-12 col-12">
<button class="btn btn-info btn-lg edit_activity_syl pull-right mr-1 " type="button">
Submit
</button>
<button class="btn btn-secondary btn-lg pull-right mr-1" type="">
Cancel
</button>
</div>
</div>
</form>
</div>
<!--EXAMPLE-->
<div class="tab-pane" id="tab_7" role="tabpanel">
<form class="edit_example" method="POST"  data-next=""  data-action="{{ url('/') }}/admin/edit-course/{{$course_details['id']}}" >
@csrf
<input type="hidden" id="" name="add_syllabus" value="edit_example">
<input type="hidden" id="course_id7" name="course_id" value="{{$course_details['id']}}" >
<div class="row">
<div class="form-group col-sm-12 col-12 mb-0">
<h4 class="dvl-brdr"> Example 	

<select class="get_cats hide" style="display:none" >
@foreach($activitys as $a)
<?php $act_name=App\Activity::where('id',$a->name)->first();
?>
<option  
value="{{$a->name}}"> {{$act_name->name}}</option>
@endforeach
</select>

@if(count($activitys)!='0')
<a href="javascript:void(0);" class="float-right pull-right btn btn-info  btn-adda btn 
btn-success pull-right add_new" data-head="" data-less=""
data-act="" data-id="{{count($example)}}" 
data-count="" data-id2="101010">
<i class="fa fa-plus"></i>Add</a>
@endif
<input type="hidden" id="example123" value="{{count($example)}}">
</h4>
</div>

<div class="col-md-12">




<?php $i='0';?>

@forelse($example as $e)
<?php $im=$i++;?>
<?php $random=mt_rand(100000, 999999);?>
<div class="color_div">
@if(count($activitys)!='0')
<div class="row">	
<div class="form-group col-sm-12 col-12">
<label class="label_act">Activity Type</label>
<select name="title[{{$im}}][category_id][]" class="form-control headings_lesson_activity">
@foreach($activitys as $a)
<?php $act_name=App\Activity::where('id',$a->name)->first();
?>
<option  
@if($e->category_id==$a->name) 
selected 
@endif value="{{$a->name}}"> {{$act_name->name}}</option>
@endforeach
</select>
</div>
</div>
@endif
<div class="row">
<div class="form-group col-sm-12 col-12" >
<label class="d-block"> Example
<a href="javascript:void(0);" class="float-right pull-right btn btn-info  btn-adda btn 
btn-success pull-right add_exp" data-head="" data-less=""
data-act="" data-id="{{$im}}" 
data-count="" data-id2="{{$random}}">
<input type="hidden" id="example" value="0">
<i class="fa fa-plus"></i>Add Example</a></label>
<div class="form-group col-sm-12 col-12"style="
padding-left: 0px;
padding-right: 0px;
">
<?php $exam=App\Example::where('course_id',$course_details['id'])->where('category_id',$e->category_id)->get();?>
@if(!empty($exam))
@foreach($exam as $ex)

<textarea   required class="content22"
id="content22" 
name="title[{{$im}}][example_description][]">{{$ex->description}}</textarea>
<input type="hidden" name="title[{{$im}}][random][]" value="{{$ex->random}}" >
@endforeach
@endif
</div>
</div><span class="ap_exp ap_exp{{$random}}"></span>  
</div>
</div>
@empty
<p class="not_found">No Example found</p>
@endforelse
<span class="add_new_ep add_new_ep101010"></span>
<div class="clearfix"></div>
<div class="row">	
<span class="ap_exp ap_exp2302921"></span> 
</div>

<div class="row">	
<div class="form-group col-sm-12 col-12">
<button class="btn btn-info btn-lg edit_example_syl pull-right mr-1 " type="button">
Submit
</button>
<button class="btn btn-secondary btn-lg pull-right mr-1" type="">
Cancel
</button>
</div>
</div>
</div>
</div> 
</form>
</div>
<!--EXAMPLE-->				
</div>
</div>
</div>
</div>
</div>
</section>
</div>
</div>
</div>
<!-- Content_right_End -->
<div class="modal fade" id="add-type" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
<div class="modal-dialog" role="document">
<div class="modal-content">
<div class="modal-header">
<h5 class="modal-title" id="exampleModalLabel">Activity Type</h5>
<button type="button" class="close" data-dismiss="modal" aria-label="Close">
<span aria-hidden="true">&times;</span>
</button>
</div>
<div class="modal-body">
<div class="row">
<div class="col-lg-12">
<div class="input-group mb-4">
<input type="text" class="form-control" placeholder="Add New" aria-label="Add New">
<span class="input-group-btn">
<button class="btn btn-info brdr-3s" type="button">
Add
</button> </span>
</div>
</div>
<div class="col-lg-12">
<ul class="list-edys">
<li>
Community Service 
<span class="float-right">
<a href="javascript:void(0)" class="btn round btn-success btn-edts" data-toggle="modal" data-target="#edit-ts-type">
<i class="icon-note "></i>
</a>
<a href="javascript:void(0)" class="btn round btn-danger btn-edts">
<i class="fa fa-trash"></i>
</a>
</span>
</li>
<li>
Academics 
<span class="float-right">
<a href="javascript:void(0)" class="btn round btn-success btn-edts" data-toggle="modal" data-target="#edit-ts-type">
<i class="icon-note "></i>
</a>
<a href="javascript:void(0)" class="btn round btn-danger btn-edts">
<i class="fa fa-trash"></i>
</a>

</span>
</li>
<li>
Work/Job
<span class="float-right">
<a href="javascript:void(0)" class="btn round btn-success btn-edts" data-toggle="modal" data-target="#edit-ts-type">
<i class="icon-note "></i>
</a>
<a href="javascript:void(0)" class="btn round btn-danger btn-edts">
<i class="fa fa-trash"></i>
</a>
</span>
</li>
</ul>
</div>
</div>
</div>
</div>
</div>
</div>
<div class="modal fade" id="edit-ts-type" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
<div class="modal-dialog modal-sm m-t-100" role="document">
<div class="modal-content">
<div class="modal-header">
<h5 class="modal-title" id="exampleModalLabel">Edit Activity Type</h5>
<button type="button" class="close" data-dismiss="modal" aria-label="Close">
<span aria-hidden="true">&times;</span>
</button>
</div>
<div class="modal-body">
<div class="row">
<div class="col-lg-12">
<div class="input-group">
<input type="text" class="form-control" placeholder="Add New" value="Academics">
</div>
</div>
</div>
</div>
<div class="modal-footer">
<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
<button type="button" class="btn btn-success">Save changes</button>
</div>
</div>
</div>
</div>
@include('layouts/admin_footer')
<script>
$(document).ready(function() {
$(function () {
$('#langOpt').multiselect({
includeSelectAllOption: true
});
$('#btnSelected').click(function () {
var selected = $("#langOpt option:selected");
var message = "";
selected.each(function () {
message += $(this).text() + " " + $(this).val() + "\n";
});
alert(message);
});
});  
$('.content22').summernote({
height: 150   //set editable area's height  
});
$('.summernote').summernote({
height: 150  //set editable area's height

});
$('.content').summernote({
height: 150   //set editable area's height

});
$('.content1').summernote({
height: 150   //set editable area's height
});
});
</script>
<script>
var m = 1;var i = 1;
var file = 2;
$('body').on('click','.add_new', function(){
$('.not_found').hide();
var cats=$('.get_cats').html();
var id=$(this).attr('data-id');
var id1=$(this).attr('data-id2');
var minNumber = 1; 
var maxNumber = 1000000;
var randomnumber = Math.floor(Math.random() * (maxNumber + 1) + minNumber); // la fonction magique
var i=$('#example').val();
var newid=$('#example123').val();
var plus=parseInt($('#example123').val())+1;
$('#example123').val(plus);
var scntDiv = $('.add_new_ep'+id1);
var htm=$('.headings_lesson_activity').html();
$('<div class="color_div rmvs"><div class="row"><div class="form-group col-sm-12 col-12"><label>Activity Type</label><select name="title['+newid+'][category_id][]" class="form-control headings_lesson_activity   hideit">'+cats+'</select></div></div><div class=" rmvs"><div class="row"><div class="form-group col-sm-12 col-12 colors" ><label class="d-block"> Example<a href="javascript:void(0);" class="float-right pull-right btn btn-info  btn-adda btn btn-success pull-right add_exp" data-head="" data-less="" data-act="" data-id="'+newid+'" data-count="" data-id2="'+randomnumber+'"><i class="fa fa-plus"></i>Add Example</a></label><p><textarea class="content36 hideit"   name="title['+newid+'][example_description][]"></textarea><input type="hidden" name="title['+newid+'][random][]"  class="hideit" value="'+randomnumber+'"></p></div><span class="ap_exp ap_exp'+randomnumber+'"></span></div><a href="javascript:void(0)" class="remScnt44 rmvs-s"><i class="fa fa-times"></i></a></div></div>').insertBefore(scntDiv);
m++;i++;
$('.content36').summernote({
height: 150  //set editable area's height

});	
}); 


$('body').on('click', '.remScnt44', function(){
if( i > 0 ) {
$(this).parents('.color_div').remove();
i--;
}	else if( m > 0 ) {
$(this).parents('.color_div').remove();
m--;
}
return false;
});
$(function() {
$('#colorselector').change(function(){
$('.colors').hide();
$('#' + $(this).val()).show();
});
});
</script>
<script>
$(function() {
var j=1;
$('body').on('click','.add_act', function(){
var id=$(this).attr('data-id');
var id11=$(this).attr('data-id2');
var get=$('#getvalue').val();
var minNumber = 1; 
var maxNumber = 1000000; 
var randomnumber = Math.floor(Math.random() * (maxNumber + 1) + minNumber); // la fonction magique
var scntDiv = $('.p_scents_act'+id11);
$('<div class="col-md-12 rmvs"><div class="row"><div class="form-group col-sm-12 col-12 colors"><input type="text" name="title[0][activity_name][]" class="form-control"><input type="hidden" name="title[0][random_no][]" value="'+randomnumber+'"></div><div class="example_append'+randomnumber+'"></div><a href="javascript:void(0)" class="remScnt rmvs-s heading" data-table="activity" data-random="'+randomnumber+'"><i class="fa fa-times"></i></a></div></div>').appendTo(scntDiv);
j++;
$( '.content99' ).last().each( function() {
CKEDITOR.replace( this );
} );
});
var m = 1;
var file = 2;  
$('body').on('click','.add_exp', function(){
$('.not_found').hide();
var id=$(this).attr('data-id');
var count=$(this).attr('data-count');
var id1=$(this).attr('data-id2');
var minNumber = 1;
var maxNumber = 1000000; 
var randomnumber = Math.floor(Math.random() * (maxNumber + 1) + minNumber); // la fonction magique
var heading=$(this).attr('data-head');
var lesson=$(this).attr('data-less');
var act=$(this).attr('data-act');
var i=$('#getvalue').val();
var scntDiv = $('.ap_exp'+id1);
$('<div class="col-md-12 rmvs"><div class="row"><div class="form-group col-sm-12 col-12 colors"><label for="exampleInputPassword10">Example</label><p  style="margin-top:18px"><textarea class="content36 hideit"   name="title['+id+'][example_description][]"></textarea><input type="hidden" class="hideit" name="title['+id+'][random][]" value="'+randomnumber+'"></p></div><a href="javascript:void(0)" class="remScnt77 rmvs-s"><i class="fa fa-times"></i></a></div></div>').appendTo(scntDiv);
m++;
file++;
$('.content36').summernote({
height: 150  
});	
});

var count=parseInt($('#lessons').val())+1;
$('body').on('click','.addScnt', function(){
var id=$(this).attr('data-id');
$('.hideempty'+id).remove();
var scntDiv = $('.p_scents'+id);
var minNumber = 1;
var maxNumber = 1000000; 
var newid=parseInt($('#getvalue').val())+1;
var randomnumber = Math.floor(Math.random() * (maxNumber + 1) + minNumber); // la fonction magique
var sylbid = $(this).attr('data-val');
var count = $(this).attr('data-count');
$('<div class="row rmvs"><div class="bg-ns-a lesson-append_box"><div class="form-group col-sm-12 col-12"><label for="exampleInputPassword10" class="d-block">Lesson Name</label><input type="hidden" name="title['+count+'][syllabus_id][]" class="sylb_id" data-count="'+count+'" value="'+sylbid+'"><input type="text" name="title['+count+'][name][]" maxlength="30"  required class="form-control form-control-square" id="" placeholder=""><input type="hidden" value="'+randomnumber+'" name="title['+count+'][random_no][]"></div><div class="form-group col-sm-12 col-12"><label for="exampleInputPassword10">Content Type</label><select id="colorselector'+randomnumber+'" onchange="chnagefun('+randomnumber+');" name="title['+count+'][type][]" class="colorselector'+randomnumber+' form-control form-control-square" required><option value="">Select One</option><option value="Video'+randomnumber+'">Video</option><option value="Exercise'+randomnumber+'">Exercise</option></select></div><div class="form-group col-sm-12 col-12"><label for="exampleInputPassword10" class="">Lesson Number</label><input type="text" name="title['+count+'][lesson_no][]" required class="form-control form-control-square quantity" id="" placeholder=""></div><div class="form-group col-sm-12 col-12"><label for="exampleInputPassword10" class="">Duration</label><input type="text" name="title['+count+'][duration][]" required class="form-control form-control-square quantity" id="" placeholder=""></div><div class="form-group col-sm-12 col-12 colors'+randomnumber+' Video'+randomnumber+'" style="display:none;"><label for="exampleInputPassword10">Add Video</label><input type="hidden" class="file_video'+randomnumber+'" name="title['+count+'][file][]"><input type="file"  class="form-control form-control-square files file_video"  data-random="'+randomnumber+'" id="file_video'+randomnumber+'" placeholder=""></div><div class="form-group col-sm-12 col-12 colors'+randomnumber+' Exercise'+randomnumber+'" id="Exercise'+randomnumber+'" style="display:none;"><label for="exampleInputPassword10">Learn Column</label><textarea class="content7" name="title['+count+'][description][]"></textarea></div><a href="javascript:void(0)" class="remScnt1 rmvs-s heading" data-random="'+randomnumber+'" data-table="lesson"><i class="fa fa-times"></i></a></div></div>').appendTo(scntDiv);
m++;
file++;
$('.content8').summernote({
height: 150  
});	
$('.content7').summernote({
height: 150  
});	
$('.content9').summernote({
height: 150  
});	

return false;
});

$('body').on('click', '.remScnt1', function(){
if( m > 0 ) { 
$(this).parents('.rmvs').remove();
m--;

}
});


var i=1;
$('body').on('click', '#remScnt', function(){
if( i > 0 ) {
$(this).parents('.rmvs').remove();
i--;
}
return false;
});
});
$('body').on('change', '.get_show_hide', function(){
var idss=$(this).attr('data-id');
$(".colors"+idss).hide();
var slec = $(this).val();
// alert(slec);
$('.'+slec).show();
});
function chnagefun(idss)
{
$(".colors"+idss).hide();
var slec = $('.colorselector'+idss).children("option:selected").val();
//alert(slec);
$('.'+slec).show();
}
</script>
<script>
$('body').on('click','.heading', function(){
var random=$(this).attr('data-random');
var course=$(this).attr('data-course');
var table=$(this).attr('data-table');
var base=$('#base_url').val();
var action =base+'/deleteeditheading';
var data ={random:random,course:course,table:table};
$.ajax({
headers: {
'X-CSRF-Token': $('input[name="_token"]').val()
},
type: 'post',
url: action,
data: data,
success: function (data1) {
var obj = JSON.parse(data1);
if(table == 'syllabus')
{
if(obj.code == '101')
{
$('.headings_lesson').html(obj.data);
$('.remove'+random).remove();
$(".as1").html("Heading deleted successfully");
$(".as1").show();
setTimeout(function(){ $('.alert-success').hide(); }, 3000);
}
else
{
$(".dg1").html(obj.status);
$(".dg1").show();
setTimeout(function(){ $('.alert-danger').hide(); }, 3000);
}
}
else if(table == 'lesson')
{
if(obj.code == '101')
{
$('.removelesson'+random).remove();
$(".as1").html("Lesson deleted successfully");
$(".as1").show();
setTimeout(function(){ $('.alert-success').hide(); }, 3000);
}
}
else if(table == 'activity')
{
$('.headings_lesson_activity').html(obj.data);   
$('.removeact'+id).remove();
}
},
});

});
$(function() {
var scntDiv = $('.syllabus_scents1');
var i = 1;
$('#add-syllabus').on('click', function(){
var course=$(this).attr('data-course');
var id=$('#getvalue').val();
var id11=parseInt($('#getvalue').val())+2;
var newid=parseInt($('#getvalue').val())+1;
var minNumber = 1; // le minimum
var maxNumber = 1000000; // le maximum
var randomnumber = Math.floor(Math.random() * (maxNumber + 1) + minNumber); // la fonction magique
$('#getvalue').val(newid);
$('<div class="col-md-12  remove'+randomnumber+'"><div class="row"><div class="form-group col-sm-12 col-12"><label for="exampleInputPassword10">Heading Title</label><input type="text" required  name="title[0][title][]" class="form-control form-control-square" id="" placeholder=""><input type="hidden" name="title[0][random_no][]" value="'+randomnumber+'"></div></div><div class="width-100 p_scents'+newid+'"><a href="javascript:void(0)" class="remScnt rmvs-s heading" data-course="'+course+'" data-table="syllabus" data-random="'+randomnumber+'" ><i class="fa fa-times"></i></a></div>').appendTo(scntDiv);
i++;
$( '.content7' ).last().each( function() {
CKEDITOR.replace( this );
} );
$( '.content99' ).last().each( function() {
CKEDITOR.replace( this );
} );
return false;
});


$('body').on('click', '.remScnt77', function(){

if( i > 0 ) {
$(this).parents('.rmvs').remove();
i--;
}	else if( m > 0 ) {
$(this).parents('.rmvs').remove();
m--;
}
return false;
});
$('body').on('click', '.remScnt', function(){
if( i > 0 ) {
$(this).parents('.rmvs').remove();
i--;
}	else if( m > 0 ) {
$(this).parents('.rmvs').remove();
m--;
}
return false;
});
});


</script>


