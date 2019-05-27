@include('layouts/admin_header')
		
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
											Archived Course
										</div>
									</div>
									<div class="card-body">
								    <div class="row getdata droppable">
								        @forelse($course as $c)
                						<div class="col-xl-12 col-lg-12 col-sm-12 getdata1 ui-state-default hide{{$c->id}}" id="{{$c->id}}" >
                							<div class="card course-card mb-4">
                								<div class="card-body">
												
                									<button type="button" class="btn round btn-danger course-delete redo_course" data-toggle="modal" 
                									data-table="courses" data-title="course" data-id="{{$c->id}}"  data-action="{{url('/')}}/admin/archive_record" 
                									data-target="#archive_redo_modal">
                									<i class="fa fa-repeat" data-toggle="tooltip" data-placement="bottom" data-title="Publish"></i>
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
		

<!-- Modal -->

<div class="modal fade edit-type" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="myLargeModalLabel">Add Activity Type</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
				<form class="addadactivity" method="POST" data-action="{{url('/')}}/admin/add_act" data-next="">
				@csrf
			<div class="modal-body">
				<div class="form-group">
					<label for="exampleFormControlSelect2">Add Type</label>
					<input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Type" name="name" >
				</div>
			</div>
			</form>
			<div class="modal-footer">
				<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
				<button type="button" class="btn btn-primary add_admin_activity">Submit</button>
			</div>
		</div>
	</div>
</div>

<div class="modal fade bd-example-modal-lg"  id="eidt_act" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="myLargeModalLabel">Edit Type</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
		<form class="editactivity" method="POST" data-action="{{url('/')}}/admin/add_act" data-next="">
		    @csrf
			<div class="modal-body">
				<div class="form-group">
				<label for="exampleFormControlSelect2">Edit Type</label>
				<input type="hidden" id="id" name="id">
				<input type="text"name="name" class="form-control" id="editname" aria-describedby="emailHelp" value="Type One">
				</div>
			</div>
			<div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">
                Close
                </button>
                <button type="button" class="btn btn-primary edit_ad">
                Update
                </button>
			</div>
		</form>
		</div>
	</div>
</div>

@include('layouts/admin_footer')
