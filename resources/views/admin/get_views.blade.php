@if(isset($get) && $get=='leasson_view')
@foreach($syallabuses as $key=>$stylbus)
<?php  $random=mt_rand(100000, 999999); ?>
<input type="hidden" id="" name="add_syllabus" value="add_lesson">
 <input type="hidden" id="course_id3" name="course_id"  value="{{$stylbus->course_id}}">
<div class="col-md-12">
<div class="row">
<div class="form-group col-sm-12 col-12">
<h4 class="dvl-brdr"> {{$stylbus->title}}
<input type="hidden" value="0" id="getvalue">
</h4>
<input type="hidden" name="title[{{$key}}][syllabus_id][]" class="sylb_id" data-count="{{$key}}" value="{{$stylbus->id}}">
</div>
</div>
<div class="row">
<div class="bg-ns-a">
<div class="form-group col-sm-12 col-12">
<label class="d-block" for="exampleInputPassword10">Lesson Name
<a href="javascript:void(0)" data-count="{{$key}}" data-val="{{$stylbus->id}}" class="float-right pull-right btn btn-info addScnt btn-adda" 
id="addScnt" data-id="{{$random}}"> Add Lesson </a></label>
<input type="text" class="form-control form-control-square" id="" 
name="title[{{$key}}][name][]" placeholder="" required>
<input type="hidden"  name="title[{{$key}}][random_no][]" value="{{$random}}">
</div>
<div class="form-group col-sm-12 col-12">
<label for="exampleInputPassword10">Content Type</label>
<select id="colorselector" class="form-control form-control-square" name="title[{{$key}}][type][]" 
required>
<option value="">Select One</option>
<option value="Video">Video</option>
<option value="Exercise" selected>Exercise</option>
</select>
</div>
<div class="form-group col-sm-12 col-12 colors" id="Video" style="display:none">
<label for="exampleInputPassword10">Add Video</label>
<input type="hidden"  name="title[{{$key}}][file][]" class="file_video0">
<input type="file"   data-random="{{$stylbus->random}}"  
class="form-control form-control-square files file_video" id="file_video0" placeholder="">
</div>
<div class="form-group col-sm-12 col-12 colors" id="Exercise">
<label for="exampleInputPassword10">Learn Column</label>
<textarea class="summernote" id="content21" name="title[{{$key}}][description][]" ></textarea>
</div>
</div>
<div class="p_scents  p_scents{{$random}}"></div>
</div>
@endforeach
<div class="chosen-select" style="width:100%"></div>
<div class="col-md-12">
<div class="row">	
<div class="form-group col-sm-12 col-12">
<button class="btn btn-info btn-lg add_lesson_syl pull-right mr-1 " type="button">
Submit
</button>
<button class="btn btn-secondary btn-lg pull-right mr-1" type="">
Cancel
</button>
</div>
</div>
</form>
</div>
</div>
@endif

@if(isset($get) && $get=='leasson_view_edit')
@foreach($syallabuses as $key=>$stylbus)
<?php /*echo '<pre>'; print_r($lessonsd); echo '-----'; print_r($syallabuses); */ ?>
<?php  $random=mt_rand(100000, 999999); ?>
@foreach($lessonsd as $dky=>$less)
@if($stylbus->id == $less->syllabus_id)
<input type="hidden" id="" name="add_syllabus" value="add_lesson">
 <input type="hidden" id="course_id3" name="course_id"  value="{{$less->course_id}}">
<div class="col-md-12">
<div class="row">
<div class="form-group col-sm-12 col-12">
<h4 class="dvl-brdr"> {{$stylbus->title}}
<input type="hidden" value="0" id="getvalue">
</h4>
<input type="hidden" name="title[{{$dky}}][syllabus_id][]" class="sylb_id" data-count="{{$key}}" value="{{$less->syllabus_id}}">
</div>
</div>
<div class="row">
<div class="bg-ns-a">
<div class="form-group col-sm-12 col-12">
<label class="d-block" for="exampleInputPassword10">Lesson Name
<a href="javascript:void(0)" data-count="{{$dky}}" data-val="{{$less->syllabus_id}}" class="float-right pull-right btn btn-info addScnt btn-adda" 
id="addScnt" data-id="{{$random}}"> Add Lesson </a></label>
<input type="text" class="form-control form-control-square" id="" 
name="title[{{$key}}][name][]" placeholder="" required>
<input type="hidden"  name="title[{{$dky}}][random_no][]" value="{{$random}}">
</div>
<div class="form-group col-sm-12 col-12">
<label for="exampleInputPassword10">Content Type</label>
<select id="colorselector" class="form-control form-control-square" name="title[{{$dky}}][type][]" 
required>
<option value="">Select One</option>
<option value="Video">Video</option>
<option value="Exercise" selected>Exercise</option>
</select>
</div>
<div class="form-group col-sm-12 col-12 colors" id="Video" style="display:none">
<label for="exampleInputPassword10">Add Video</label>
<input type="hidden"  name="title[{{$dky}}][file][]" class="file_video0">
<input type="file"   data-random="{{$less->random_no}}"  
class="form-control form-control-square files file_video" id="file_video0" placeholder="">
</div>
<div class="form-group col-sm-12 col-12 colors" id="Exercise">
<label for="exampleInputPassword10">Learn Column</label>
<textarea class="summernote" id="content21" name="title[{{$dky}}][description][]" ></textarea>
</div>
</div>
<div class="p_scents  p_scents{{$random}}"></div>
</div>
@else
<input type="hidden" id="" name="add_syllabus" value="add_lesson">
 <input type="hidden" id="course_id3" name="course_id"  value="{{$stylbus->course_id}}">
<div class="col-md-12">
<div class="row">
<div class="form-group col-sm-12 col-12">
<h4 class="dvl-brdr"> {{$stylbus->title}}
<input type="hidden" value="0" id="getvalue">
</h4>
<input type="hidden" name="title[{{$dky}}][syllabus_id][]" class="sylb_id" data-count="{{$dky}}" value="{{$stylbus->id}}">
</div>
</div>
<div class="row">
<div class="bg-ns-a">
<div class="form-group col-sm-12 col-12">
<label class="d-block" for="exampleInputPassword10">Lesson Name
<a href="javascript:void(0)" data-count="{{$dky}}" data-val="{{$stylbus->id}}" class="float-right pull-right btn btn-info addScnt btn-adda" 
id="addScnt" data-id="{{$random}}"> Add Lesson </a></label>
<input type="text" class="form-control form-control-square" id="" 
name="title[{{$dky}}][name][]" placeholder="" required>
<input type="hidden"  name="title[{{$dky}}][random_no][]" value="{{$random}}">
</div>
<div class="form-group col-sm-12 col-12">
<label for="exampleInputPassword10">Content Type</label>
<select id="colorselector" class="form-control form-control-square" name="title[{{$dky}}][type][]" 
required>
<option value="">Select One</option>
<option value="Video">Video</option>
<option value="Exercise" selected>Exercise</option>
</select>
</div>
<div class="form-group col-sm-12 col-12 colors" id="Video" style="display:none">
<label for="exampleInputPassword10">Add Video</label>
<input type="hidden"  name="title[{{$dky}}][file][]" class="file_video0">
<input type="file"   data-random="{{$stylbus->random}}"  
class="form-control form-control-square files file_video" id="file_video0" placeholder="">
</div>
<div class="form-group col-sm-12 col-12 colors" id="Exercise">
<label for="exampleInputPassword10">Learn Column</label>
<textarea class="summernote" id="content21" name="title[{{$dky}}][description][]" ></textarea>
</div>
</div>
<div class="p_scents  p_scents{{$random}}"></div>
</div>
@endif
@endforeach
@endforeach
<div class="chosen-select" style="width:100%"></div>
<div class="col-md-12">
<div class="row">	
<div class="form-group col-sm-12 col-12">
<button class="btn btn-info btn-lg add_lesson_syl pull-right mr-1 " type="button">
Submit
</button>
<button class="btn btn-secondary btn-lg pull-right mr-1" type="">
Cancel
</button>
</div>
</div>
</form>
</div>
</div>
@endif

@if(isset($get) && $get=='activity_view')
@foreach($lessonsd as $key=>$less)
<?php echo '<pre>'; print_r($less); ?>
@endforeach
@endif

<script>
    $('.summernote').summernote();
</script>