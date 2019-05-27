@include('layouts/admin_header')
<!-- Content_right -->
<div class="container_full">
@include('layouts/admin_sidebar')
<style>
#username:focus:invalid + label[for="username"]:after {
content: "Username must contain only letters and digits";
color:red;
}
</style>
		<div class="content_wrapper">
			<div class="container-fluid">
				<section class="chart_section">
					<div class="row">
						<div class="col-xl-12 col-lg-12 mb-4">
								<div class="card card-shadow mb-4">
									<div class="card-header">
										<div class="card-title">
											Add User
										</div>
									</div>
									<div class="card-body">
										<form class="adduser" method="POST" data-action="{{ route('admin.user') }}" data-next="{{url('/')}}/admin/users">
										    	@csrf
											<div class="row">
												<div class="form-group col-sm-6 col-12">
													<label for="exampleInputPassword10">First Name</label>
													<input type="text" class="form-control form-control-square" id="" name="first_name" placeholder="First Name">
												</div>
												<div class="form-group col-sm-6 col-12">
													<label for="exampleInputPassword10">Last Name</label>
													<input type="text" class="form-control form-control-square" id="" name="last_name"  placeholder="Last name">
												</div>
												<div class="form-group col-sm-6 col-12">
													<label for="exampleInputPassword10">User Name</label>
													<input type="text" class="form-control form-control-square" id="username"  pattern="\w+|d\+"  name="username" placeholder="User Name">
												<label for="username"></label></div>
												<div class="form-group col-sm-6 col-12">
													<label for="exampleInputEmail10">Email Address</label>
													<input type="email" class="form-control form-control-square" id="email_user" name="email" aria-describedby="emailHelp" placeholder="Enter email">
												</div>
											   <div class="form-group col-sm-6 col-12">
													<label for="exampleInputEmail10">Password</label>
													<input type="password" class="form-control form-control-square" id="password" name="password" aria-describedby="emailHelp" placeholder="Enter Password">
												</div>	
												<div class="form-group col-sm-6 col-12">
													<label for="exampleInputEmail10">Confirm Password</label>
													<input type="password" class="form-control form-control-square" id="" name="confirm_password" aria-describedby="emailHelp" placeholder="Enter Confirm Password">
												</div>	
												<div class="form-group col-sm-6 col-12">
													<label for="phone">Phone Number</label>
													<input type="tel" class="form-control form-control-square" id="phone" name="phone" placeholder="Phone Number">
												</div>
												<div class="form-group col-sm-6 col-12">
													<label>User Image</label>
													<label class="custom-file">
													<input type="file" id="files" accept="image/x-png,image/jpeg,image/jpg" class="fileupload" name="uplod-img" style="visibility:hidden; width:0px;  height:0px;" class="custom-file">
														<span class="custom-file-control"></span> 
													</label>
												</div>
        										<div class="form-group col-sm-6 col-12">
                    								<label for="">Subscription Level</label>
                        								<select name="package_id" class="form-control" id="">
                            								 <option value="">Choose Plan</option>
                            								 <?php if(!empty($subscription)){ 
                            								foreach($subscription as $s){ ?>
                            								<option value="{{$s->id}}">{{$s->plan_name}}</option>
                            								<?php }} ?>
                        								</select>
                								</div>
        								        <div class="form-group col-sm-6 col-12">
                                                    <label class="custom-file">
                                                    <img id="blah" src="#" alt="your image" class="media-object" style="display:none;" />
                                                </div>
                                                <div class="form-group col-sm-12 col-12 mt-2">
                                                    <button  class="save_user btn btn-info mr-2" type="submit">
                                                    Submit
                                                    </button>
                                                    <button   class="btn btn-secondary" type="button">
                                                    Cancel
                                                    </button>
                                                </div>
											</div>
										</form>
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