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
										Assigned Users
										<a href="{{url('/')}}/admin/mentors" class="btn btn-success float-right">
											Back to Mentor
										</a>
									</div>
								</div>
								<div class="card-body">
									<div class="bd-example table_style">
										<table class="table table-responsive-md">
											<thead>
												<tr>
													<th scope="col">Id</th>
													<th scope="col">Image</th>
													<th scope="col">Name</th>
													<th scope="col">User Name</th>
													<th scope="col">Email</th>
													<th scope="col">Phone Number</th>
													<th scope="col">Subscription Level</th>
													<th scope="col">Action</th>
												</tr>
											</thead>
											<tbody>
                                                @if(!empty($getassignedselected))
                                                    <?php $x =1; ?>
                                                    @forelse($getassignedselected as $u)
												<tr>
													<td>#<?php echo $x++; ?></td>
													<td>
														<ul class="list-unstyled users-list m-0">
															<li data-toggle="tooltip" data-popup="tooltip-custom" data-original-title="{{ $u->first_name }} {{$u->last_name}}" class="pull-up list_membler">
																<img class="media-object rounded-circle" src="{{url('/')}}/public/uploads/{{$u->image}}" alt="">
															</li>
															
														</ul>
													</td>
													<td>{{ $u->first_name }} {{$u->last_name}}</td>
													<td>{{ $u->username }}</td>
													<td>{{ $u->email }}</td>
													<td>{{ $u->phone }}</td>
													<td>{{ $u->plan_name }}</td>
													<td>
														<span data-toggle="tooltip" data-original-title="Delete">
														    <button type="button" class="btn btn-danger round delete_request"  data-toggle="modal"  data-table="usermentor" data-id="{{$u->usermentor_id}}"  data-action="{{url('/')}}/admin/delete_record" data-target="#delete_modal">
                                                                <i class="fa fa-trash"></i>
														    </button>
														</span>
													</td>
												</tr>
												@empty
                                                <tr>
                                                      <td>No Users Assigned</td>
                                                </tr>
                                                @endforelse
                                                @endif
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