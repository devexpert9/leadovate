@include('layouts/admin_header')
		
		<!-- Content_right -->
		<div class="container_full">
			@include('layouts/admin_sidebar')
			<div class="content_wrapper">
			<div class="container-fluid">
				<section class="chart_section">
					<div class="row">
						<div class="col-xl-12 col-lg-12 mb-4">
								<div class="card card-shadow mb-4">
									<div class="card-header">
										<div class="card-title">
											Add Mentor
										</div>
									</div>
									<div class="card-body">
			                    	<form class="addmentor" method="POST" data-action="{{ url('/') }}/admin/add-mentor" 
			                    	data-next="{{url('/')}}/admin/mentors">
										    	@csrf()
											<div class="row">
												<!--div class="form-group col-sm-6 col-12">
													<label for="exampleInputPassword10">Mentor ID</label>
													<input type="text" class="form-control form-control-square" disabled id="disabledTextInput" value="152">
												</div-->

												<div class="form-group col-sm-6 col-12">
													<label for="exampleInputPassword10">First Name</label>
													<input type="text" class="form-control form-control-square" id=""  name="first_name" placeholder="First Name">
												</div>
												
												<div class="form-group col-sm-6 col-12">
													<label for="exampleInputPassword10">Last Name</label>
													<input type="text" class="form-control form-control-square" id="" placeholder="Last name"  name="last_name">
												</div>

												<div class="form-group col-sm-6 col-12">
													<label for="exampleInputEmail10">Email Address</label>
													<input type="email" class="form-control form-control-square" id="" aria-describedby="emailHelp" placeholder="Enter email"  name="email">
												</div>

												<div class="form-group col-sm-6 col-12">
													<label for="phone">Phone Number</label>
													<input type="tel" class="form-control form-control-square" id="phone" placeholder="Phone Number"  name="phone">
												</div>
												
												
    
												<div class="form-group col-sm-6 col-12">
													<label>Mentor Image</label>
													<label class="custom-file">
														<input type="file" id="files" name="file" class="custom-file-input fileupload">
														<span class="custom-file-control"></span> 
													</label>
												</div>
												<div class="form-group col-sm-6 col-12">
                                                
                                                <label class="custom-file">
                                                <img id="blah" src="#" alt="your image" class="media-object" style="display:none;" />
                                                </div>
												
												<div class="form-group col-sm-12 col-12 mt-2">
													<button class="btn btn-info mr-2 save_mentor" type="submit">
														Submit
													</button>

													<button class="btn btn-secondary" type="button">
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
		
@include('layouts/admin_footer')
