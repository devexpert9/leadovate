@include('auth/login_head')
<style>
#username:focus:invalid + label[for="username"]:after {
  content: "Username must contain only letters and digits";
  color:red;
}
</style>
<meta name="google-signin-client_id" content="567402969779-4thile1dr58lfh6h2043qvbu16smcd40.apps.googleusercontent.com">
    <script src="https://apis.google.com/js/platform.js" async defer></script>
 <section class="prof-sec">
        <div class="container">
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="bread-cums">
						<h4> Sign Up </h4>
						<ol class="breadcrumb">
						  <li><a href="#">Home</a></li>
						  <li class="active">Sign Up</li>
						</ol>
					</div>
                </div>

            </div>

            
        </div>
    </section>   
 <section class="application-sec courses-sec login-pds">
        <div class="container">
            <div class="row">
				<div class="col-md-8 col-md-offset-2 col-sm-8 col-sm-offset-2">
                    <div class="login-pgs">
						<h4 >Sign Up Form </h4>
						 <form class="registerform" method="POST" data-next="" enctype="multipart/form-data" 
						 action="{{ url('/') }}/register_user" >
			                @csrf
						    <div class="signup">
							<div class="row">
								<div class="col-md-6">
									<div class="form-group">
										<label for="exampleInputEmail1">First Name</label>
										 <input id="name" type="text" class="form-control{{ $errors->has('first_name') ? ' is-invalid' : '' }}"
										 name="first_name" value="{{ old('first_name') }}"  autofocus placeholder="First Name">
									  @if ($errors->has('first_name'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('first_name') }}</strong>
                                    </span>
                                @endif
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group">
										<label for="exampleInputEmail1">Last Name</label>
										<input type="text" class="form-control{{ $errors->has('last_name') ? ' is-invalid' : '' }}" value="{{ old('last_name') }}"
										name="last_name" id="exampleInputEmail1" placeholder="Last Name">
								 @if ($errors->has('last_name'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('last_name') }}</strong>
                                    </span>
                                @endif	</div>
								</div>
							</div>
							<div class="row">
								<div class="col-md-6">
									<div class="form-group">
										<label for="">User Name</label>
										<input type="text" class="form-control" 
										value="{{ old('username') }}" name="username" onkeyup="this.value=this.value.replace(/[^A-Za-z0-9]/g,'');"  id="username" 
										placeholder="User Name" >
											@if ($errors->has('username'))
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('username') }}</strong>
                                        </span>
                                @endif
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group">
										<label for="exampleInputEmail1">Email Address</label>
										<input type="text" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" 
										value="{{ old('email') }}"
										name="email" id="" placeholder="Email Address">
                                        @if ($errors->has('email'))
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('email') }}</strong>
                                        </span>
                                        @endif
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-md-6">
									<div class="form-group">
										<label for="exampleInputEmail1">Phone Number</label>
										<input type="text" class="form-control{{ $errors->has('phone') ? ' is-invalid' : '' }}" 
										value="{{ old('phone') }}"
										name="phone" id="" placeholder="Phone Number">
										 @if ($errors->has('phone'))
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('phone') }}</strong>
                                        </span>
                                        @endif
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group">
										<label>Year of Graduation</label>
										<select class="form-control" name="school_year" >
											<option value=""> Select Year </option>
											<option value="2014"> 2014 </option>
											
										</select>
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-md-6">
									<div class="form-group">
										<label for="exampleInputPassword1">Password</label>
										<input type="password" class="form-control" name="password" id="password" placeholder="Password">
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group">
										<label for="exampleInputPassword1">Confirm Password</label>
										<input type="password" class="form-control" name="cpassword" id="confirm_password" placeholder="Confirm Password">
									</div>
								</div>
							</div>
							<div class="row">
							    
								<div class="col-md-12">
									<button type="submit"  class="btn btn-default btn-block login-bns next_pricing login-btn check_register ">Next</a>
								</div>
								
								<div class="col-md-6">
								<ul class="facebookgoogle text-center">
		                        <fb:login-button style="display:none;" scope="public_profile,email" onlogin="checkLoginState();" 
		                        style="background-color: #4C69BA; background-image: linear-gradient(#4C69BA, #3B55A0); 
		                        Text-shadow: 0 -1px 0 #354C8C;" class="fblogins">Login with Facebook </fb:login-button>
                                <a href="javascript:void(0);" id="fbloginbtn" class="btn btn-default btn-block login-bns fb-btn" >
                                <i class="fab fa-facebook-f"></i>Login with Facebook
                                </a>
								</div>
								
								<div class="col-md-6 signin">
								    <div class="g-signin2" data-onsuccess="onSignIn" data-theme="dark"></div>
								</div>
							</div>
							<div class="row">
								<div class="col-md-12">
									<p class="dont">Already have an account? <a href="{{url('/')}}/login">Login here! </a></p> 
								</div>
							</div>
							</div>
							
			
						</form>
					</div>
                </div>
			</div>
        </div>
    </section>
                 
@include('auth/login_foot')
@include('auth/fb_google')
<script>
$('.check_register').click(function(){
    if($('.registerform').valid())
      {
          $('.registerform')[0].submit();
      }
});
$('.registerform').validate({
   rules: {
       first_name:{
           required:true,
       },
        password:{
           required:true,
           minlength: 6,
           maxlength:15
       },
        school_year:{
           required:true,
       },
        cpassword:{
          required:true,
           equalTo: "#password",
            minlength: 6,
           maxlength:15
       },
        last_name:{
           required:true,
       },
       phone:{
           required:true,
            digits:true,
            minlength:10,
            maxlength:15
       },
       username:{
           required:true,
            remote: {
              url: $('#base_url').val()+"/checkusername",
                    type: "post",
                    data:{_token:$('input[name="_token"]').val()},
                 }
       },
      email: {
        required: true,
        email: true,
         remote: {
              url: $('#base_url').val()+"/checkuseremail",
                    type: "post",
                    data:{_token:$('input[name="_token"]').val(),id:$('#id').val()},
                 }
       }, 
             
       },
       messages: {
             email:{
                required: 'Email is Required',
                email: 'Please enter valid email',
                remote:'Email already exists',
            },
            username:{
              remote:'Username already exists',  
            },
            password: {
                required: 'Password is Required',
            },
             school_year: {
                 
               required: 'Year of Graduation is Required',   
             },
             cpassword: {
                required: 'Confirm Password is Required',
            },
             
       },
       submitHandler: function(form) {
          
          
       }
});
</script>












