@include('layouts/admin_header')

		<!-- Content_right -->
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
											Activity Types
											<a href="add-user.php" class="btn btn-success add_act float-right" data-toggle="modal" data-target=".edit-type">
												Add Type
											</a>
										</div>
									</div>
									<div class="card-body">
										<div class="bd-example table_style">
										<table class="table table-responsive-md" id="bs4-table">
										<thead >
										<tr>		
										<th scope="col">Type Name</th>
										<th scope="col">Status</th>
										<th scope="col">Action</th>
                                        </tr>
                                        </thead>
                                        <tbody id="getdata">
                                        @foreach($activity as $a)
                                        <tr>
										<td id="actname{{$a->id}}">{{$a->name}}</td>	
                                        <td id="statususer{{$a->id}}">@if($a->status == '1')
                                        <label class="badge badge-success active_user" data-id="{{$a->id}}" data-table="activitytype" data-status="{{$a->status}}">Active </label>
                                        @else
                                        <label class="badge badge-danger active_user" data-id="{{$a->id}}" data-table="activitytype" data-status="{{$a->status}}">Inactive </label>
                                        @endif
                                        </td>
                                        <td>
										<button type="button" class="btn edit_adact  btn-success round" data-toggle="modal" data-target="#eidt_act" data-id="{{$a->id}}">
										<i class="icon-note "></i>
										</button>
										<button type="button" data-toggle="modal" class="btn delete_request  btn-danger round" 	data-table="activities" data-title="activities" data-id="{{$a->id}}"  data-action="{{url('/')}}/admin/delete_record" data-target="#delete_modal">
										<i class="fa fa-trash"></i>
										</button>
										</td>
										</tr>
										@endforeach
										</tbody>
										</table>
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
