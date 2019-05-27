@include('layouts/admin_header')
<style>
div.sortIt { margin: 1px;}
</style>
	<div class="container_full">
		@include('layouts/admin_sidebar')
		<div class="content_wrapper">
			<div class="container-fluid">
				<section class="chart_section">
					<div class="row">
						<div class="col-xl-12 col-lg-12 mb-4 d-flex align-items-stretch">
							<div class="widthfull card card-shadow">
								<div class="card-header">
									<div class="card-title">
										Courses
										<a href="{{url('/')}}/admin/add-course" class="btn btn-success float-right">
											Add Course
										</a>
									</div>
								</div>	<span class="show"></span>
								<div class="card-body">
								    <div class="row  droppable" id="getdata">
								        @forelse($course as $c)
                						<div class="col-xl-12 col-lg-12 col-sm-12  hide{{$c->id}} sortIt" id="{{$c->id}}" >
                							<div class="card course-card mb-4">
                								<div class="card-body">        
                                                    <a href="{{url('/')}}/admin/edit-course/{{$c->id}}" 
                                                    class="btn round btn-success course-edit course-delete" 
                                                    data-toggle="tooltip" 
                                                    data-placement="bottom" title="Edit Course">
                                                    <i class="icon-note " ></i>
                                                    </a>
                									<button type="button" class="btn round btn-danger course-delete delete_request" data-toggle="modal" 
                									data-table="courses" data-title="course" data-id="{{$c->id}}"  data-action="{{url('/')}}/admin/delete_record" 
                									data-target="#delete_modal">
                									<i class="fa fa-trash" data-toggle="tooltip" data-placement="bottom" data-title="Delete"></i>
                									</button>
                									<button type="button" class="btn round btn-danger course-delete c_archive course-archive " data-toggle="modal" 
                									data-table="courses" data-title="course" data-id="{{$c->id}}"  data-action="{{url('/')}}/admin/archive_record" 
                									data-target="#archive_modal">
                									<i class="fa fa-repeat" data-toggle="tooltip" data-placement="bottom" data-title="Archive"></i>
                									</button>
                								    <div class="card-icon">
                								        @if(!empty($c->image))
                    							        <img src="{{url('/')}}/public/uploads/{{$c->image}}">
                    							        @else
                    							        <img src="{{url('/')}}/resources/admin_assets/images/card-icon.png">
                    							        @endif
                    							        </div>
                    									<h4 class="card-title">{{$c->title}}</h4>
                        									<p class="card-text show-read-more">
                                                            <?php
                                                            $string = strip_tags($c->description);
                                                            if (strlen($string) > 120) {
                                                           
                                                            $stringCut = substr($string, 0, 120);
                                                            $endPoint = strrpos($stringCut, ' ');
                                                            
                                                         
                                                            $string = $endPoint? substr($stringCut, 0, $endPoint) : substr($stringCut, 0);
                                                            $string .= '...';
                                                            }
                                                            echo $string;
                                                            ?>
                                                            </p>
                    								</div>
                							</div>
                						</div>
                						@empty
                						<div class="col-xl-12 col-lg-12 col-sm-12">No Courses found !!
                					</div>
                				@endforelse
                		 </div>
						@if(!empty($course))
                        {!! $course->render() !!}
                        @endif
								</div>
							</div>
						</div>

						
					</div>

					
				</section>
			</div>
		</div>
	</div>
	<!-- Content_right_End -->
	
@include('layouts/admin_footer')



<script src="https://code.jquery.com/jquery-migrate-3.0.0.min.js" type="text/javascript"></script>
<script>
$(document).ready(function() {
   $('#getdata').sortable({
         forcePlaceholderSize: true,
        placeholder: 'draggable-placeholder',
        tolerance: 'pointer',
        axis: 'y',
         opacity: 1.0,
        stop: function (event, ui) {
        var productOrder = $(this).sortable('toArray').toString();
        var base=$('#base_url').val();
        var lid=productOrder;
        var action =base+'/updateorder';
        var data ={lid:lid};
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
        }
   });
   $('<br><br><div id=buttonDiv><button>Get Order of Elements</button></div>').appendTo('body');
   
   $('button').button().click(function() {
   var itemOrder = $('#sortableContainer').sortable("toArray");
   for (var i = 0; i < itemOrder.length; i++) {
    alert("Position: " + i + " ID: " + itemOrder[i]);
                }
            })

        });
    </script>
<script type="text/javascript">


    function updateOrder(data) {
        $.ajax({
            url:"ajaxPro.php",
            type:'post',
            data:{position:data},
            success:function(){
                alert('your change successfully saved');
            }
        })
    }
</script>