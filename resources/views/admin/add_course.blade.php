@include('layouts/admin_header')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.7/dist/css/bootstrap-select.min.css">
<!-- Content_right -->
<div class="container_full">
@include('layouts/admin_sidebar')
<style>
.note-children-container
{
    display:none;
}
div.syllabus_scents {
    float: left;
    width: 100%;
}
.example_html
{
    float: left;
    width: 100%;
}
div.p_scents_act {
   float: left;
    width: 100%;  
}
div.syllabus_scents1 {
    float: left;
    width: 100%;
}
div.p_scents ,div.width-100{
    float: left;
    width: 100%;
}
.add_new_ep
{   
    float: left;
    width:100%;
}
.ap_exp 
{
     float: left;
    width:100%;
}
.add_act
{
    margin-bottom: 12px;
}
.add_exp
{
    margin-bottom:0px;
}
.exp_des
{
        margin-top: 24px;
}
a.rmvs-s ,a .remScnt{
    position: absolute;
    top: 0;
    right: 15px;
    width: 25px;
    height: 25px;
    background: #F44336;
    line-height: 25px;
    text-align: center;
    color: #fff;
}
</style>
</div>
		<div class="content_wrapper">
			<div class="container-fluid">
				<section class="chart_section">
					<div class="row">
						<div class="col-xl-12 col-lg-12 mb-4">
								<div class="card card-shadow mb-4">
									<div class="card-header">
										<div class="card-title">
											Add Course
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
													<a class="nav-link tab2course disabled" data-toggle="tab" href="#tab_3">Course Overview</a>
												</li>
												<li class="nav-item">
													<a class="nav-link  tab3course disabled" data-toggle="tab" href="#tab_4">Heading</a>
												</li>
												<li class="nav-item">
													<a class="nav-link  tab4course  tab44 disabled" data-toggle="tab" href="#tab_5">Lesson</a>
												</li>
												<li class="nav-item">
													<a class="nav-link  tab5ourse disabled" data-toggle="tab" href="#tab_6">Activity</a>
												</li>
													<li class="nav-item">
													<a class="nav-link  tab6course disabled" data-toggle="tab" href="#tab_7">Example</a>
												</li>
											</ul>
                                          
											<div class="tab-content">
												<div class="tab-pane active" id="tab_1" role="tabpanel">
												     <form class="addcourse" method="POST" data-next="" data-action="{{ url('/') }}/admin/add-course" >
			                                         @csrf
													<input type="hidden" id="course_id" name="course_id" >
														<div class="row">
															<div class="form-group col-sm-12 col-12">
																<label for="exampleInputPassword10">Course Title</label>
																<input type="hidden" name="type" id="type"> 
																<input type="text"  name="title" class="form-control form-control-square" id="" placeholder="">
															</div>
														</div>
														<div class="row">
															<div class="form-group col-sm-10 col-10">
																<label for="exampleInputPassword10">Course Image</label>
																<input type="file" name="file" class="form-control form-control-square fileupload" id="files" placeholder="">
															</div>
															<div class="form-group col-sm-2 col-2">
																<img src="{{url('/')}}/resources/admin_assets/images/card-icon.png" class="upsave" >
																<img id="blah" src="#" alt="your image" class="media-object" style="display:none;" />
															</div>
														</div>
														<div class="row">	
															<div class="form-group col-sm-12 col-12">
																<label for="exampleInputPassword10">Description</label>
																<textarea  class="content description"  id ="content"  name="description"></textarea>
																<div class="description_label"></div>
															</div>
														</div>
                                                    <div class="row">	
                                                         <div class="form-group col-sm-12 col-12">
                                                            <button class="btn btn-info btn-lg add_course_btn pull-right mr-1" type="submit">
                                                            Submit
                                                            </button>
                                                            <a href="{{url('/')}}/admin/courses"class="btn btn-secondary btn-lg pull-right mr-1" type="">
                                                            Cancel
                                                            </a>
                                                         </div>
                                                    </div>	
                                                </form>
                                            </div>
						                <div class="tab-pane " id="tab_3" role="tabpanel">
                                        <form class="addcourse_overview" method="POST" data-next='' data-action="{{ url('/') }}/admin/add-course" >
                                        @csrf
                                        <div class="row">
                                            <input type="hidden" id="course_id1" name="course_id" >	
                                            <div class="form-group col-sm-12 col-12">
                                            <label for="exampleInputPassword10">Course Overview</label>
                                            <textarea class="content1 overview" id="content1"  name="course_overview"></textarea>
                                            <div class="overview_label"></div>
                                            </div>
                                        </div>
                                        <div class="row">	
                                            <div class="form-group col-sm-12 col-12">
                                                <button class="btn btn-info btn-lg add_course_overview pull-right mr-1" type="button">
                                                Submit
                                                </button>
                                                <a href="{{url('/')}}/admin/courses" class="btn btn-secondary btn-lg pull-right mr-1" type="">
                                                Cancel
                                                </a>
                                            </div>
                                        </div>	
                                        </form>
										</div>
										<div class="tab-pane" id="tab_4" role="tabpanel">
                                        <form class="addcourse_syllabs_form" method="POST" data-next="" data-action="{{ url('/') }}/admin/add-course" >
                                        @csrf
                                        <input type="hidden" id="" name="add_syllabus" value="add_heading">
                                        <input type="hidden" id="course_id2" name="course_id" >
                                        <div class="row">	
                                            <div class="form-group col-sm-12 col-12">
                                                    <h4 class="dvl-brdr"> Heading 
                                                    <input type="hidden" value="0" id="getvalue">
                                                    </h4>
                                            </div>
										<div class="col-md-12">
        										<div class="row">
            										<div class="form-group col-sm-12 col-12">
            										<label class="d-block">Heading Title <a href="javascript:void(0)" 
            										class="pull-right btn btn-success btn-adda" id="add-syllabus"> Add Heading </a></label>
            										<input type="hidden" value="0" id="getvalue">
            										<input type="text" class="form-control form-control-square" id="" name="title[0][title]" placeholder="" required>
            										<input type="hidden"  name="title[0][random_no]" value="{{mt_rand(100000, 999999)}}">
            										</div>
        										</div>
                                        </div>
                                        <div class="syllabus_scents1"></div>
                                        </div>
                                        <div class="row">	
                                            <div class="form-group col-sm-12 col-12">
                                                <button class="btn btn-info btn-lg add_course_syl1 pull-right mr-1 " type="button">
                                                Submit
                                                </button>
                                                <a href="{{url('/')}}/admin/courses" class="btn btn-secondary btn-lg pull-right mr-1" type="">
                                                Cancel
                                                </a>
                                            </div>
                                        </div>
                                        </form>
										</div>
										<div class="tab-pane" id="tab_5" role="tabpanel">
                                        <form class="lesson_form" method="POST"  data-next="" data-action="{{ url('/') }}/admin/add-course" >
                                        @csrf
                                        <input type="hidden" id="" name="add_syllabus" value="add_lesson">
                                        <input type="hidden" id="course_id3" name="course_id" >
                                        <span class="lesson_html"></span>
                                        <div class="row">	
                                        <div class="form-group col-sm-12 col-12">
                                        </div>
                                        <div class="chosen-select" style="width:100%"></div>
										<div class="col-md-12">
                                       
                                        <div class="row">	
                                            <div class="form-group col-sm-12 col-12">
                                                <button class="btn btn-info btn-lg add_lesson_syl pull-right mr-1 " type="button">
                                                Submit
                                                </button>
                                                 <a href="{{url('/')}}/admin/courses" class="btn btn-secondary btn-lg pull-right mr-1" type="">
                                                     Cancel
                                                 </a>
                                            </div>
                                        </div>
                                        </form>
										</div>
										</div>  
										</div>
										<div class="tab-pane" id="tab_6" role="tabpanel">
                                        <form class="activity_form" method="POST"  data-next="" data-action="{{ url('/') }}/admin/add-course" >
                                        @csrf
                                        <input type="hidden" id="" name="add_syllabus" value="add_activity">
                                        <input type="hidden" id="course_id5" name="course_id" >
                                        <div class="row">
                                        <div class="form-group col-sm-12 col-12">
                                        <h4 class="dvl-brdr"> Activity 
                                        </h4>
                                        </div>
										<div class="col-md-12">
                                                    <select id="langOpt" name="activity_type[]"  class=" form-control" multiple >
                                                    @foreach($activity_admin as $s)
                                                    <option value="{{$s->id}}">{{$s->name}}</option>
                                                    @endforeach
                                                    </select>
                                                <span class="activity_html"></span> 
                                        <div class="row">	
                                                <div class="form-group col-sm-12 col-12">
                                                    <button class="btn btn-info btn-lg add_activity_syl pull-right mr-1 " type="button">
                                                    Submit
                                                    </button>
                                                    <a href="{{url('/')}}/admin/courses" class="btn btn-secondary btn-lg pull-right mr-1" type="">
                                                    Cancel
                                                    </a>
                                                </div>
                                        </div>
                                        </div>
                                        </div>  
                                        </form>
										</div>
										<div class="tab-pane" id="tab_7" role="tabpanel">
                                        <form class="example_form" method="POST"  data-next="" data-action="{{ url('/') }}/admin/add-course" data-next="" >
                                        @csrf
                                        <input type="hidden" id="" name="add_syllabus" value="add_example">
                                        <input type="hidden" id="course_id7" name="course_id" >
                                        <div class="row">
                                            <div class="form-group col-sm-12 col-12">
                                            <h4 class="dvl-brdr"> Example 	   
                                                <a href="javascript:void(0);" class="float-right pull-right btn btn-info  btn-adda btn 
                                                btn-success pull-right add_new" data-head="" data-less=""
                                                data-act="" data-id="0" 
                                                data-count="" data-id2="101010">
                                                <input type="hidden" id="example" value="0">
                                               
                                                <i class="fa fa-plus"></i>Add</a>
                                            <input type="hidden" id="example" value="0">
                                            </h4>
                                            </div>
                                        <span class="example_html"></span> 
										<div class="col-md-12">
										<div class="color_div exp_add">
    										<div class="row">	
                                                <div class="form-group col-sm-12 col-12">
                                                <label class="label_act">Activity Type</label>
                                                <select required name="title[0][category_id][]" class="form-control headings_lesson_activity">
                                                </select>
                                                </div>
                                            </div>
                                        <div class="row">
                                        <div class="form-group col-sm-12 col-12 mb-0" >
                                        <label class="d-block"> Example
                                        <a href="javascript:void(0);" class="float-right pull-right btn btn-info  btn-adda btn 
                                        btn-success pull-right add_exp" data-head="" data-less=""
                                        data-act="" data-id="0" 
                                        data-count="" data-id2="230292">
                                        <input type="hidden" id="example" value="0">
                                        <i class="fa fa-plus"></i>Add Example</a></label>
                                        <div class="form-group col-sm-12 col-12"style="
                                        padding-left: 0px;
                                        padding-right: 0px;
                                        ">
                                        <textarea   required class="content22"
                                        id="content22" 
                                        name="title[0][example_description][]">
                                        </textarea>
                                        <?php $random=mt_rand(100000, 999999);?>
                                        <input type="hidden" name="title[0][random][]" value="{{$random}}">
                                         
                                        </div>
                                        </div><span class="ap_exp ap_exp230292"></span>  
                                        <div class="clearfix"></div>
                                        </div>
                                        </div>
                                        <span class="add_new_ep add_new_ep101010 "></span>
                                        <div class="clearfix"></div>
                                        <div class="row">	
                                        <div class="form-group col-sm-12 col-12">
                                        <button class="btn btn-info btn-lg add_example_syl pull-right mr-1 " type="button">
                                        Submit
                                        </button>
                                        <a href="{{url('/')}}/admin/courses" class="btn btn-secondary btn-lg pull-right mr-1" type="">
                                             Cancel
                                        </a>
                                        </div>
                                        </div>
                                        </form>
										</div>
										</div>  
										</div>
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
<div class="modal fade" id="myModal_cat" tabindex="-1"  data-backdrop="static"   role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg m-t-100" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Add Course</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        </button>
      </div>
      <div class="modal-body">
        <div class="row">
			<div class="col-lg-12">
				<div class="input-group">
				    
					<select class="form-control select_cat" required>
					    <option value="">Select Type</opton>
					    <option value="A">Activity Type</option>
					    <option value="E">Essay Type</option>
					</select>
				
				</div>
			</div>
		</div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-success choose_category">Choose</button>
      </div>
    </div>
  </div>
</div>
@include('layouts/admin_footer')
<script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.7/dist/js/bootstrap-select.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.7/dist/js/i18n/defaults-*.min.js"></script>
<script>
$(function() {
$(document).on('change', '#colorselector', function () {
$('.colors').hide();
$('#' + $(this).val()).show();
if($(this).val() == 'Exercise')
{
$('.' + $(this).val()).show();
}
});
});
$(function() {
});
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
});
});
$('.content22').summernote({
height: 150   //set editable area's height  
});
$('.content23').summernote({
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
$(function() {
var j=1;
$(document).on('click', '.add_act ', function () {
var id=$(this).attr('data-id');
var id11=$(this).attr('data-id2');
var count=$(this).attr('data-count');
var get=$('#getvalue').val();
var minNumber = 1; // le minimum
var maxNumber = 1000000; // le maximum
var randomnumber = Math.floor(Math.random() * (maxNumber + 1) + minNumber); // la fonction magique
var scntDiv = $('.p_scents_act'+id11);
$('<div class="col-md-12 rmvs"><div class="row"><div class="form-group col-sm-12 col-12 colors"><label class="label_act" for="exampleInputPassword10">Activity Type</label><input type="text" name="title['+count+'][activity_name][]" required class="form-control"><input type="hidden" name="title['+count+'][random_no][]" value="'+randomnumber+'"></div><div class="example_append'+randomnumber+'"></div><a href="javascript:void(0)" class="remScnt rmvs-s heading" data-table="activity" data-random="'+randomnumber+'"><i class="fa fa-times"></i></a></div></div>').appendTo(scntDiv);
j++;
$( '.content99' ).last().each( function() {
CKEDITOR.replace( this );
} );
});var m = 1;
var file = 2;
$('body').on('click','.add_new', function(){
var id=$(this).attr('data-id');
var id1=$(this).attr('data-id2');
var minNumber = 1; // le minimum
var maxNumber = 1000000; // le maximum
var randomnumber = Math.floor(Math.random() * (maxNumber + 1) + minNumber); // la fonction magique
var i=$('#example').val();
var newid=parseInt($('#example').val())+1;
$('#example').val(newid);
var scntDiv = $('.add_new_ep'+id1);
var htm=$('.headings_lesson_activity').html();
var htmlesson=$('.lessons').html();
$('<div class="color_div rmvs"><div class="row"><div class="form-group col-sm-12 col-12"><label class="label_act" >Activity Type</label><select   name="title['+newid+'][category_id][]" class="hideits form-control headings_lesson_activity">'+htm+'</select></div></div><div class=" "><div class="row"><div class="form-group col-sm-12 col-12 colors" ><label class="d-block"> Example<a href="javascript:void(0);" class="float-right pull-right btn btn-info  btn-adda btn btn-success pull-right add_exp" data-head="" data-less="" data-act="" data-id="'+newid+'" data-count="" data-id2="'+randomnumber+'"><i class="fa fa-plus"></i>Add Example</a></label><p><textarea class="content36 hideit"   name="title['+newid+'][example_description][]"></textarea><input type="hidden" class="hideit" name="title['+newid+'][random][]" value="'+randomnumber+'"></p></div><span class="ap_exp ap_exp'+randomnumber+'"></span></div><a href="javascript:void(0)" data-table="" data-random="'+randomnumber+'" class="remScnt44  heading rmvs-s"><i class="fa fa-times"></i></a></div></div>').insertBefore(scntDiv);
m++;
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

var t = 1;

$('body').on('click','.add_exp', function(){
var id=$(this).attr('data-id');
var id1=$(this).attr('data-id2');
var minNumber = 1; // le minimum
var maxNumber = 1000000; // le maximum
var randomnumber = Math.floor(Math.random() * (maxNumber + 1) + minNumber); // la fonction magique
var i=$('#example').val();
var scntDiv = $('.ap_exp'+id1);
$('<div class="col-md-12 rmvs1"><div class="row"><div class="form-group col-sm-12 col-12 colors" ><label for="exampleInputPassword10">Example</label><p"><textarea class="content36"   name="title['+id+'][example_description][]"></textarea><input type="hidden" value="'+randomnumber+'" name="title['+id+'][random][]" class="hideit"></p></div><a href="javascript:void(0)"  data-table="example" data-random="'+randomnumber+'" class="remScnt3 heading rmvs-s"><i class="fa fa-times"></i></a></div></div>').appendTo(scntDiv);
$('.content36').summernote({
height: 150  //set editable area's height

});		t++;
});
$('body').on('click', '.remScnt3', function(){
if( t > 0 ) { 
$(this).parents('.rmvs1').remove();
t--;
}
});
$('body').on('click','.addScnt', function(){
var id=$(this).attr('data-id');
var scntDiv = $('.p_scents'+id);
var minNumber = 1; // le minimum
var maxNumber = 1000000; // le maximum
var newid=parseInt($('#getvalue').val())+1;
var randomnumber = Math.floor(Math.random() * (maxNumber + 1) + minNumber); // la fonction magique
var sylbid = $(this).attr('data-val');
var count = $(this).attr('data-count');
$('<div class="col-md-12 rmvs"><div class="row"><div class="bg-ns-a lesson-append_box"><div class="form-group col-sm-12 col-12"><label for="exampleInputPassword10" class="d-block">Lesson Name</label><input type="hidden" name="title['+count+'][syllabus_id][]" class="sylb_id" data-count="'+count+'" value="'+sylbid+'"><input type="text" maxlength="30" name="title['+count+'][name][]" required class="form-control form-control-square" id="" placeholder=""><input type="hidden" value="'+randomnumber+'" name="title['+count+'][random_no][]"></div><div class="form-group col-sm-12 col-12"><label for="exampleInputPassword10">Content Type</label><select id="colorselector'+randomnumber+'" onchange="chnagefun('+randomnumber+');" name="title['+count+'][type][]" class="colorselector'+randomnumber+' form-control form-control-square" required><option value="">Select One</option><option value="Video'+randomnumber+'">Video</option><option value="Exercise'+randomnumber+'">Exercise</option></select></div><div class="form-group col-sm-12 col-12"><label for="exampleInputPassword10" class="">Lesson Number</label><input type="text" name="title['+count+'][lesson_no][]" required class="form-control quantity form-control-square" id="" placeholder=""></div><div class="form-group col-sm-12 col-12"><label for="exampleInputPassword10" class="">Duration</label><input type="text" name="title['+count+'][duration][]" required class="form-control form-control-square quantity" id="" placeholder=""></div><div class="form-group col-sm-12 col-12 colors'+randomnumber+' Video'+randomnumber+'" style="display:none;"><label for="exampleInputPassword10">Add Video</label><input type="hidden" class="file_video'+randomnumber+'" name="title['+count+'][file][]"><input type="file"  class="form-control form-control-square files file_video"  data-random="'+randomnumber+'" id="file_video'+randomnumber+'" placeholder=""></div><div class="form-group col-sm-12 col-12 colors'+randomnumber+' Exercise'+randomnumber+'" id="Exercise'+randomnumber+'" style="display:none;"><label for="exampleInputPassword10">Learn Column</label><textarea class="content7" name="title['+count+'][description][]"></textarea></div><a href="javascript:void(0)" class="remScnt1 rmvs-s heading" data-random="'+randomnumber+'" data-table="lesson"><i class="fa fa-times"></i></a></div><div class="width-100 p_scents'+newid+'"></div>').appendTo(scntDiv);
m++;
file++;
$('.content8').summernote({
height: 150  //set editable area's height
});	
$('.content7').summernote({
height: 150  //set editable area's height
});	
$('.content9').summernote({
height: 150  //set editable area's height
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
$('.'+slec).show();
});
function chnagefun(idss)
{

$(".colors"+idss).hide();
var slec = $('.colorselector'+idss).children("option:selected").val();
$('.'+slec).show();
}
</script>
<script>
$(function() {
var scntDiv = $('.syllabus_scents1');
var i = 1;
$('#add-syllabus').on('click', function(){
var id=$('#getvalue').val();
var id11=parseInt($('#getvalue').val())+2;
var newid=parseInt($('#getvalue').val())+1;
var minNumber = 1; // le minimum
var maxNumber = 1000000; // le maximum
var randomnumber = Math.floor(Math.random() * (maxNumber + 1) + minNumber); 
$('#getvalue').val(newid);
$('<div class="col-md-12 rmvs"><div class="row"><div class="form-group col-sm-12 col-12"><label for="exampleInputPassword10">Heading Title</label><input type="text" required  name="title['+newid+'][title]" class="form-control form-control-square" id="" placeholder=""><input type="hidden" name="title['+newid+'][random_no]" value="'+randomnumber+'"></div></div><div class="width-100 p_scents'+newid+'"><a href="javascript:void(0)" class="remScnt rmvs-s heading"  data-table="heading" data-random="'+randomnumber+'" ><i class="fa fa-times"></i></a></div>').appendTo(scntDiv);
i++;
$( '.content7' ).last().each( function() {
CKEDITOR.replace( this );
} );
$( '.content99' ).last().each( function() {
CKEDITOR.replace( this );
} );
return false;
});

$('body').on('click','.lesson', function(){
var id=$(this).attr('data-random');
var base=$('#base_url').val();
var action =base+'/deleteheading';
var data ={id:id};
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
$('body').on('click','.heading', function(){
var id=$(this).attr('data-random');
var table=$(this).attr('data-table');
var base=$('#base_url').val();
var action =base+'/deleteheading';
var data ={id:id,table:table};
$.ajax({
headers: {
'X-CSRF-Token': $('input[name="_token"]').val()
},
type: 'post',
url: action,
data: data,
success: function (data1) {
var obj = JSON.parse(data1);
if(table == 'heading')
{
$('.headings_lesson').html(obj.data);
$('.lessons').html(obj.data1);
$('.remove'+id).remove();
}
else if(table == 'lesson')
{
$('.headings_lesson_name').html(obj.data); 
$('.removelesson'+id).remove();
$('.hideexamplelesson'+id).remove();
}
else if(table == 'activity')
{
$('.headings_lesson_activity').html(obj.data);   
$('.removeact'+id).remove();
}
},
});
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
<script type="text/javascript">
    $(window).on('load',function(){
        $('#myModal_cat').modal('show');
    });
</script>

