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
										Subscriptions
										<a href="{{url('/')}}/admin/add-subscription" class="btn btn-success float-right">
											Add Subscription
										</a>
									</div>
								</div>
								<div class="card-body">
									<div class="bd-example table_style">
										<table class="table table-responsive-md">
											<thead>
												<tr>
												    <th scope="col">Subscription Plan</th>
													<th scope="col">Image</th>
													<th scope="col">Price</th>
													<th scope="col">Duration</th>
													<th scope="col">Status</th>
													<th scope="col">Action</th>
												</tr>
											</thead>
											<tbody>
											     @if(!empty($subsription))
											     @foreach($subsription as $s)
											    	<tr>
													<td>{{$s->plan_name}}</td>
													<td>
													@if($s->plan_img == '')
													<img class="subs-icons" src="{{url('/')}}/resources/assets/img/p_icon01.png" alt="">
													@else
													<img class="subs-icons" src="{{url('/')}}/public/uploads/{{$s->plan_img}}" alt="">
													@endif
													</td>
													<td>${{$s->price}}</td>
													<td>
													{{$s->duration}} Month (s)
													</td>
													<td id="statususer{{$s->id}}">@if($s->status == '1')
													<label class="badge badge-success active_user" 
                                                    data-id="{{$s->id}}" data-table="plans" data-status="{{$s->status}}">Active </label>
													@else
													<label class="badge badge-danger active_user" 
                                                    data-id="{{$s->id}}" data-table="plans" data-status="{{$s->status}}">Inactive </label>
													@endif
													</td>
													<td>
													<a href="{{url('/')}}/admin/edit-subscription/{{$s->id}}" class="btn btn-success round" data-toggle="tooltip" data-original-title="Edit">
												    <i class="icon-note "></i>
													</a>
													</td>
												</tr>
											@endforeach
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

	
