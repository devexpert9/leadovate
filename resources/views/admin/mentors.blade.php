@include('layouts/admin_header')

	<div class="container_full">
	   @include('layouts/admin_sidebar')
	    <style>
	    select.test.form-control.hidden {
       display: none;
       }
</style>
		<div class="content_wrapper">
			<div class="container-fluid">
				<section class="chart_section">
					
					<div class="row">
						
						<div class="col-xl-12 col-lg-12 mb-4 d-flex align-items-stretch">
							<div class="widthfull card card-shadow">
								<div class="card-header">
									<div class="card-title">
										Mentors
										<a href="{{url('/')}}/admin/add-mentor" class="btn btn-success float-right">
											Add Mentor
										</a>
									</div>
								</div>	@csrf()
								<div class="card-body">
									<div class="bd-example table_style">
										<table class="table table-responsive-md" id="bs4-table">
											<thead>
												<tr>
													<th scope="col">Id</th>
													<th scope="col">User Image</th>
													<th scope="col">First Name</th>
													<th scope="col">Last Name</th>
													<th scope="col">Email</th>
													<th scope="col">Assigned Users</th>
												    <th scope="col">Status</th>
													<th scope="col">Phone Number</th>
													<th scope="col">Action</th>
												</tr>
											</thead>
											<tbody id="getdata">
											    <?php if(!empty($mentor)){
											        $i=1;
											        foreach($mentor as $m){
											        $data=\App\Usermentor::getdatawithmentorid($m->id); ?>
												<tr>
													<td>#<?=$i++;?></td>
													<td>
                                                    <ul class="list-unstyled users-list m-0">
                                                    <li data-toggle="tooltip" data-popup="tooltip-custom" data-original-title="{{$m->first_name}} {{$m->last_name}}" class="pull-up list_membler">
                                                    
                                                    @if($m->image == '')
                                                    <img class="media-object rounded-circle" src="{{url('/')}}/public/uploads/no-image-icon-6.png" alt="">
                                                    @else
                                                    <img class="media-object rounded-circle" src="{{url('/')}}/public/uploads/{{$m->image}}" alt="">
                                                    @endif
                                                    </li>
                                                    </ul>
                                                    </td>
													<td>{{$m->first_name}}</td>
													<td>{{$m->last_name}} </td>
													<td>{{$m->email}}</td>
													<td><a href="{{url('/')}}/admin/assigned_user_list/{{$m->id}}"><?php echo count($data);?></a></td>
													<td id="statususer{{$m->id}}">
                                                    @if($m->status == '1')
                                                    <label class="badge badge-success active_user" data-id="{{$m->id}}" data-table="mentor" data-status="{{$m->status}}">Active </label>
                                                    @else
                                                    <label class="badge badge-danger active_user" data-id="{{$m->id}}" data-table="mentor" data-status="{{$m->status}}">Inactive </label>
                                                    @endif
                                                    </td>
													<td>{{$m->phone}}</td>
													<td>
													    <a href="{{url('/')}}/admin/edit-mentor/{{$m->id}}" class="btn btn-success round" data-toggle="tooltip" data-original-title="Edit">
														<i class="icon-note "></i>
														</a>
														@if($m->status == '1')
													<?php	
												    	if(count($data) >0){
												    	  $data=array($data);
												    	 $string_version = implode(',', $data);
												         ?>
														<span data-toggle="tooltip" data-original-title="Update Assign User">
    													<button type="button" class="btn round btn-info edit_assign_user" data-selected="{{$string_version}}" data-id="{{$m->id}}" data-original-title="Update Assign User" data-toggle="modal" data-target="#update_assign_user"><i class="fa fa-user-plus"></i>
    													</button>
														</span>
														<?php } else{ ?>
													    <span data-toggle="tooltip" data-original-title="Assign User">
    													<button type="button" class="btn round btn-info assign_user" data-id="{{$m->id}}" data-original-title="Assign User" data-toggle="modal" data-target="#assign_user"><i class="fa fa-user-plus"></i>
    													</button>
														</span>
														<?php } ?>
														@endif
														<span data-toggle="tooltip" data-original-title="Delete">
														<button type="button" class="btn btn-danger round delete_request"  data-toggle="modal"  data-table="mentor" data-id="{{$m->id}}"  data-action="{{url('/')}}/admin/delete_record" data-target="#delete_modal">
                                                           <i class="fa fa-trash"></i>
														</button>
														</span>
													</td>
												</tr>
											<?php }} ?>
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

@include('layouts/admin_footer')

<script>
(function($) {
   $(function() {
      
   });
})(jQuery);
</script>
	
