@include('layouts/header')
    <section class="application-sec">
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                    <h3>Completed Courses</h3>
                </div>
                 @forelse($act as $a)
                <div class="col-sm-6 col-md-4 check{{$a->id}} ">
                                <?php        
                                $tt=App\Usercourse::where('user_id',Session()->get('userid'))->where('course_id',$a->id)->first();
                                if(!empty($tt))
                                {
                                $percentage =\App\Userlesson::getviewedlessons(Session()->get('userid'),$a->id);
                                $totalWidth =\App\Lesson::getlessoneithcoursecon($a->id,$user->package_id);
                                if($totalWidth != '0'){
                                $new_width = ($percentage / $totalWidth) * 100;
                                echo '<style>
                                .application-sec .newstyle'.$a->id.':before
                                {
                                width:'.$new_width.'% !important; 
                                }
                                </style>';
                                }
                                echo '<div class="card card-00 newstyle'.$a->id.'"  > ';
                                }else
                                {
                                $new_width='0';
                                echo '<div class="card card-00  newstyle'.$a->id.'" > ';
                                echo '<style>
                                .application-sec .newstyle'.$a->id.':before
                                {
                                width:'.$new_width.'% !important; 
                                }
                                </style>';  
                                }
                                ?>
                            <div class="card-img">
                            <a href="{{url('/')}}/course-details/{{$a->id}}">
                            @if(empty($a->image))
							<img class="card-img-top" src="{{url('/')}}/resources/assets/img/card-icon.png" alt="Card image cap">
							@else
							<img class="card-img-top" src="{{url('/')}}/public/uploads/{{$a->image}}" alt="Card image cap">
							@endif
							</a>
                            </div>
                            <div class="card-body courses-body">
							<a href="{{url('/')}}/course-details/{{$a->id}}">	
							<h5 class="card-title">{{$a->title}}</h5>
							</a>
                            <p class="card-text"><?php
                            $string = strip_tags($a->description);
                            if (strlen($string) > 120) {
                            $stringCut = substr($string, 0, 120);
                            $endPoint = strrpos($stringCut, ' ');
                            $string = $endPoint? substr($stringCut, 0, $endPoint) : substr($stringCut, 0);
                            $string .= '...';
                            }
                            echo $string;
                          ?></p>
                          <a class="btn btn-resume redo_completed" data-id="{{$a->id}}"  data-toggle="modal" data-target="#redo">Redo</a>
                        </div>
                    </div>
                  </div>
                  @empty
               
                  <p class="label_completed">No data found...!</p>
                  @endforelse
            </div>
        </div>
    </section>
@include('layouts/footer')
<div id="redo" class="modal fade" role="dialog">
        <div class="modal-dialog">
        <!-- Modal content-->
            <div class="modal-content">
                    <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Redo Course</h4>
                    </div>
                    <div class="modal-body">
                    <p>Are you sure want to redo this course ? This action can't be undone.</p>
                    </div>
                    <input type="hidden" id="redo_id">
                    <div class="modal-footer">
                    <button type="button" class="btn btn-success confirm_redo">Yes</button>
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
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
$('.check'+id).remove();
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
$('.get_act').html(data1);
},
});
});
</script>