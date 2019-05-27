@include('layouts/admin_header')
<style>
label.eidt-pen {
width: 34px;
display: inline-block;
position: absolute;
margin: 0px;
height: 34px;
background: #233242;
line-height: 31px;
color: #fff;
border-radius: 50%;
bottom: 0;
right: 18px;
}.mdi-lead-pencil:before {
content: "\F64F"
}
</style>	
		<div class="container_full">
			@include('layouts/admin_sidebar')
			<main class="content_wrapper">
				<div class="container-fluid">
					<div class="row">
						<div class="col-lg-4">
							<div class="panel profile-cover pb-100">
							 <form name="images" id="imageaddsuser" data-id="{{$admin->id}}" method="POST" 
								 data-action="{{url('/')}}/admin/updateimage" data-url="{{url('/')}}" >
							     @csrf()

								<div class="profile-cover__img">
									<div class="prof-img-box">
									@if(empty($admin->profile))
									<img src="{{url('/')}}/resources/admin_assets/images/user1.png"  class="blah" alt="">
									@else
									<img src="{{url('/')}}/public/uploads/{{$admin->profile}}"   class="blah"  alt="">
									@endif

									<label for="uplod-img" class="eidt-pen">
									<i class="fa fa-edit"></i>
									<input type="file" accept="image/x-png,image/jpeg,image/jpg" id="uplod-img" name="uplod-img" style="visibility:hidden; width:0px;  height:0px;">
									</label>
									</div>

								<h3 class="h3 admin_name">{{$admin->first_name}} {{$admin->last_name}} </h3>
								</div>
								</form>
								<div class="profile-cover__action bg--img" data-overlay="0.3">
								</div>
							</div>
							
						</div>
						<div class="col-lg-8">
							<div class="panel">
								<div class="panel-heading">
									<h3 class="panel-title">Profile</h3>
								</div>
								<div class="panel-content panel-about">
									
								<form class="adminprofile" method="POST" data-action="{{ route('admin.profile') }}" >
				
										<fieldset title="Step1" class="step" id="default-step-0">
									@csrf
											<div class="form-group row">
												<label class="col-sm-4 col-form-label col-form-label-sm">First Name</label>
												<div class="col-sm-8">
													<input type="text" class="form-control"  name="first_name" value="{{$admin->first_name}}" placeholder="First Name">
												</div>
											</div>
											<div class="form-group row">
												<label class="col-sm-4 col-form-label col-form-label-sm">Last Name</label>
												<div class="col-sm-8">
													<input type="text" class="form-control"  name="last_name" value="{{$admin->last_name}}" placeholder="Last Name">
												</div>
											</div>
											<div class="form-group row">
												<label class="col-sm-4 col-form-label col-form-label-sm">Email Address</label>
												<div class="col-sm-8">
													<input type="text" class="form-control"   name="email" value="{{$admin->email}}" placeholder="Email Address">
												</div>
											</div>
											<div class="form-group row">
												<label class="col-sm-4 col-form-label col-form-label-sm">Old Password</label>
												<div class="col-sm-8">
													<input type="text" class="form-control" id="oldpassword"  maxlength="6" name="oldpassword" placeholder="Old Password">
												</div>
											</div>
											<div class="form-group row">
												<label class="col-sm-4 col-form-label col-form-label-sm">New Password</label>
												<div class="col-sm-8">
													<input type="text" class="form-control" id="password"  maxlength="6" name="password" placeholder="New Password">
												</div>
											</div>
											<div class="form-group row">
												<label class="col-sm-4 col-form-label col-form-label-sm">Confirm Password</label>
												<div class="col-sm-8">
													<input type="text" class="form-control"   maxlength="6"  id="cpassword" name="cpassword" placeholder="Confirm Password">
												</div>
											</div>
										</fieldset>
										<fieldset title="Step 2" class="step" id="default-step-1">
											<legend></legend>
											<div class="form-group row">
												<label class="col-sm-4 col-form-label col-form-label-sm">Phone</label>
												<div class="col-sm-8">
													<input type="text" class="form-control" name="phone" value="{{$admin->phone}}" placeholder="Phone">
												</div>
											</div>
												<div class="form-group row">
												<label class="col-sm-4 col-form-label col-form-label-sm">Country</label>
												<div class="col-sm-8">
													<select class="form-control country" name="country" id="exampleFormControlSelect1">
														<option value=''>Select</option>
														@if(!empty($country))
														@foreach($country as $c)
														<option  @if(!empty($admin->country))
														@if($admin->country ==$c->id )
														selected
														@endif
														@endif
														value="{{$c->id}}">{{$c->name}}</option>
														@endforeach
														@endif
													</select>
												</div>
											</div>
											<div class="form-group row">
												<label class="col-sm-4 col-form-label col-form-label-sm" >State</label>
												<div class="col-sm-8">
													<select class="form-control city" name="state" id="exampleFormControlSelect1"  @if(!empty($admin->state))
													@else
													disabled
													@endif>	
													@if(!empty($states))
													@foreach($states as $s)
													<option 
													@if(!empty($admin->state))
													@if($admin->state == $s->id )
													selected
													@endif
													@endif
													
													value='{{$s->id}}'>{{$s->name}}</option>
													@endforeach
													@else
													<option value=''>Select</option>
													@endif
													</select>
												</div>
											</div>
												<div class="form-group row">
												<label class="col-sm-4 col-form-label col-form-label-sm">City</label>
												<div class="col-sm-8">
													<input type="text" class="form-control" name="city" value="{{$admin->city}}" placeholder="City">
												</div>
											</div>
											<div class="form-group row">
												<label class="col-sm-4 col-form-label col-form-label-sm">Zip</label>
												<div class="col-sm-8">
													<input type="text" class="form-control" name="zip_code" value="{{$admin->zip_code}}" placeholder="Zip Code">
												</div>
											</div>
											<div class="form-group row">
												<label class="col-sm-4 col-form-label col-form-label-sm">Address</label>
												<div class="col-sm-8">
													<textarea class="form-control" name="address" cols="60" rows="3">{{$admin->address}}</textarea>
												</div>
											</div>
											<button type="submit" class="finish btn btn-info save_profile" value="" />Save</button>
										</fieldset>
									</form>
								</div>
							</div>
						</div>
					</div>
				</div>
			</main>
			
@include('layouts/admin_footer')
