@include('layouts/admin_header')
	<!-- Content_right -->
	<style>
	.tr_link{cursor:pointer}
	</style>
	<div class="container_full">
		@include('layouts/admin_sidebar')
    	<div class="content_wrapper">
				<div class="container-fluid">
					<section class="chart_section">
						<div class="row">
							<div class="col-xl-3 col-sm-6 mb-4">
								<div class="card card-shadow">
									<div class="card-body p-0">
										<div class="row d-flex align-items-center" onclick="window.location.href = '{{url('admin/users')}}'" style="cursor: pointer;">
											<div class="col-5">
												<div class="home_counter card-left text-center">
													<i class="fa fa-users"></i>
												</div>
											</div>
											<div class="col-7">
												<span class="counter">{{count($users_all)}}</span>
												<h6 class="mt-2 mb-0 color_gray">Total Users</h6>
											</div>
										</div>
									</div>
								</div>
							</div>
							
							<div class="col-xl-3 col-sm-6 mb-4">
								<div class="card card-shadow">
									<div class="card-body p-0">
										<div class="row d-flex align-items-center" onclick="window.location.href = '{{url('admin/mentors')}}'" style="cursor: pointer;">
											<div class="col-5">
												<span class="home_counter card-left text-center"> <i class="fa fa-user-circle-o"></i> </span>
											</div>
											<div class="col-7">
												<span class="counter">{{count($mentors)}}</span>
												<h6 class="mt-2 mb-0 color_gray">Total Mentors</h6>
											</div>
										</div>
									</div>
								</div>
							</div>
							
							<div class="col-xl-3 col-sm-6 mb-4">
								<div class="card card-shadow ">
									<div class="card-body p-0">
										<div class="row d-flex align-items-center" onclick="window.location.href = '{{url('admin/applications')}}'" style="cursor: pointer;">
											<div class="col-5">
												<div class="home_counter card-left text-center">
													<i class="fa fa-file-text-o" aria-hidden="true"></i>
												</div>
											</div>
											<div class="col-7">
												<span class="counter">123</span>
												<h6 class="mt-2 mb-0 color_gray">Total Applications</h6>
											</div>
										</div>
									</div>
								</div>
							</div>
							
							<div class="col-xl-3 col-sm-6 mb-4">
								<div class="card card-shadow">
									<div class="card-body p-0">
										<div class="row d-flex align-items-center" onclick="window.location.href = '{{url('admin/courses')}}'" style="cursor: pointer;">
											<div class="col-5">
												<div class="home_counter card-left text-center">
													<span class="icon-book-open"></span>
												</div>
											</div>
											<div class="col-7">
												<span class="counter">{{count($courses)}}</span>
												<h6 class="mt-2 mb-0 color_gray">Total Courses</h6>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>

						<div class="row">
							<div class="col-xl-12 col-lg-12 mb-4 d-flex align-items-stretch">
								<div class="widthfull card card-shadow">
									<div class="card-header">
										<div class="card-title">
											Recent Users
										</div>
									</div>
									<div class="card-body">
										<div class="bd-example table_style">
											<table  class="tr_link table table-responsive-md">
												<thead>
													<tr>
														<th scope="col">Id</th>
														<th scope="col">User Image</th>
														<th scope="col">First Name</th>
														<th scope="col">Last Name</th>
														<th scope="col">Email</th>
														<th scope="col">Phone Number</th>
													</tr>
												</thead>
												<tbody>
												    <?php $it=1;?>
												    @forelse($user as $u)
												    <?php $im=$it++;?>
												
													    <tr data-href="{{url('admin/view-user-progress/'.$u->id)}}">
														<td>#<?=$im;?></td>
														<td>
															<ul class="list-unstyled users-list m-0">
																<li data-toggle="tooltip" data-popup="tooltip-custom" data-original-title="{{$u->first_name}} {{$u->last_name}}" class="pull-up list_membler">
																@if(!empty($u->image))
																 <?php if(file_exists('public/uploads/'.$u->image)){ ?>
    																	<img class="media-object rounded-circle" src="{{url('/')}}/public/uploads/{{$u->image}}" alt="">
    																<?php }else{ ?>
    																<img class="media-object rounded-circle" src="{{url('/')}}/public/profile/{{$u->image}}" alt="">
    																<?php } ?>
    																
																	@else
																	<img class="media-object rounded-circle" src="{{url('/')}}/public/uploads/no-image-icon-6.png" alt="">
																	@endif
																</li>
																
															</ul>
														</td>
														<td>{{$u->first_name}}</td>
														<td>{{$u->last_name}}</td>
														<td>
														{{$u->email}}
														</td>
														<td>{{$u->phone}}</td>
											     
											     	</tr>
													
													@empty
													<tr>
													    <td></td>
													    <td></td>
													    <td></td>
													    No user found
													    <td></td>
													    <td></td>
													 </tr>
													  @endforelse
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
<script>
$('tr[data-href]').on("click", function() {
document.location = $(this).data('href');
});
</script>