@include('layouts/admin_header')

		<!-- Content_right -->
		<div class="container_full">
			@include('layouts/admin_sidebar')

			<div class="content_wrapper">
				<div class="container-fluid">
					<section class="chart_section">
						@csrf()
						<div class="row">
							<div class="col-xl-12 col-lg-12 mb-4 d-flex align-items-stretch">
								<div class="widthfull card card-shadow">
									<div class="card-header">
										<div class="card-title">
											Users
											<a href="{{url('/')}}/admin/add-user" class="btn btn-success float-right">
												Add User
											</a>
										</div>
									</div>
									<div class="card-body">
										<div class="bd-example table_style">
											<table class="table table-responsive-md" id="bs4-table">
												<thead>
													<tr>
														<th scope="col">Sr No.</th>
														<th scope="col">Image</th>
														<th scope="col">First Name</th>
														<th scope="col">Last Name</th>
														<th scope="col">User Name</th>
														<th scope="col">Email</th>
														<th scope="col">Phone Number</th>
														<th scope="col">Status</th>
														<th scope="col">Subscription Level</th>
														<th scope="col">Action</th>
													</tr>
												 </thead>
												 
												 
                                                    <tbody id="getdata">
                                                    <?php 
                                                    if(!empty($users)){
                                                    $it=1;
                                                    foreach($users as $u){
                                                        $im=$it++;
                                                    ?>
                                                    <tr>
                                                    <td>#<?=$im;?></td>
                                                    <td>
                                                    <ul class="list-unstyled users-list m-0">
                                                    <li data-toggle="tooltip" data-popup="tooltip-custom" data-original-title="{{$u->first_name}} {{$u->last_name}}" class="pull-up list_membler">
                                                    
                                                    @if($u->image == '')
                                                    
                                                    <img class="media-object rounded-circle" src="{{url('/')}}/public/uploads/no-image-icon-6.png" alt="">
                                                    
                                                    @else
                                                    <?php if(file_exists('public/uploads/'.$u->image)){ ?>
                                                    <img class="media-object rounded-circle" src="{{url('/')}}/public/uploads/{{$u->image}}" alt="">
                                                    <?php }else{ ?>
                                                    <img class="media-object rounded-circle" src="{{url('/')}}/public/profile/{{$u->image}}" alt="">
                                                    <?php } ?>
                                                    @endif
                                                    </li>
                                                    </ul>
                                                    </td>
                                                    <td>{{$u->first_name}}</td>
                                                    <td>{{$u->last_name}}</td>
                                                    <td>
                                                    @if(!empty($u->username))
                                                    {{$u->username}}
                                                    @else
                                                    N/A
                                                    @endif
                                                    </td>
                                                    <td>
                                                    @if(!empty($u->email))
                                                    {{$u->email}}
                                                    @else
                                                    N/A
                                                    @endif
                                                    </td>
                                                    <td>@if(!empty($u->phone))
                                                    {{$u->phone}}
                                                    @else
                                                    N/A
                                                    @endif</td>
                                                    <td id="statususer{{$u->id}}">@if($u->status == '1')
                                                    <label class="badge badge-success active_user" data-id="{{$u->id}}" data-table="users" data-status="{{$u->status}}">Active </label>
                                                    @else
                                                    <label class="badge badge-danger active_user" data-id="{{$u->id}}" data-table="users" data-status="{{$u->status}}">Inactive </label>
                                                    @endif
                                                    </td>
                                                    <td>{{\App\Subscription::getdatawithid($u->package_id)}}</td>
                                                    <td>
                                                    <a href="{{url('/')}}/admin/view-user-progress/{{$u->id}}" class="btn round btn-info" data-toggle="tooltip" data-original-title="View Progress">
                                                    <i class="fa fa-eye"></i>
                                                    </a>
                                                    <span data-toggle="tooltip" data-original-title="Delete">
                                                    <button type="button" class="btn btn-danger round delete_request"  data-toggle="modal"  data-table="users" data-id="{{$u->id}}"  data-action="{{url('/')}}/admin/delete_record" data-target="#delete_modal">
                                                    <i class="fa fa-trash"></i>
                                                    </button>
                                                    </span>
                                                    </td>
                                                    </tr>
                                                    <?php } } ?>
                                                    
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

@include('layouts/admin_footer')

