 @include('auth/login_head') 
<style>
button.btn.btn-default.btn-block.login-bns.classlogin[disabled]:hover {
    background: #f48164;
    color: #fff;
}
 </style>
<meta name="google-signin-client_id" content="567402969779-4thile1dr58lfh6h2043qvbu16smcd40.apps.googleusercontent.com">
<script src="https://apis.google.com/js/platform.js" async defer></script>
  <section class="prof-sec">
        <div class="container">
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="bread-cums ">
						<h4> Login </h4>
						<ol class="breadcrumb hide">
						  <li><a href="#">Home</a></li>
						  <li class="active">Login</li>
						</ol>
					</div>
                </div>
            </div>
        </div>
    </section>   
 <section class="application-sec courses-sec login-pds">
        <div class="container">
            <div class="row">  @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
				<div class="col-md-6 col-md-offset-3 col-sm-6 col-sm-offset-3">
                    <div class="login-pgs">
						<h4>Login to account </h4>
	                	<form method="POST" action="{{ route('loginuser') }}" class="loginform form-logins">
                        @csrf
							<div class="row">
                                    <div class="col-md-12">
                                    <div class="form-group">
                                    <label for="exampleInputEmail1">Email address</label>
                                    <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" 
                                    name="email" value="{{ old('email') }}"  autofocus   placeholder="Email address">
                                    @if ($errors->has('email'))
                                    <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                    @endif
									</div> 
								</div>
								<div class="col-md-12">
                                        <div class="form-group">
                                        <label for="exampleInputPassword1">Password</label>
                                        <input id="password" type="password"
                                        class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password"
                                        placeholder="Password" value="{{ old('password') }}">
                                        
                                        @if ($errors->has('password'))
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('password') }}</strong>
                                        </span>
                                        @endif
                                        </div>
								</div>
							</div>
							<div class="row">
								<div class="col-md-6">
									<div class="checkbox">
										<label for="remember">
											<input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}> Remember me
										</label>
									</div>
								</div>
								<div class="col-md-6">
									<a href="{{ route('password.request') }}" class="pull-right right-for"> Forgot Password ? </a>
								</div>
							</div>
							<div class="row">
								<div class="col-md-12">
									<button type="submit" class="btn btn-default btn-block login-bns">Login</button>
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
									<p class="dont">Don't have an account? <a href="{{url('/')}}/register">Sign Up here! </a></p> 
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
$('.loginform').validate({
   rules: {
        email: {
                required: true,
                email: true
            }, 
            password: {
                required: true,
                
                
            }
       },
       messages: {
             email:{
                required: 'Email address is required',
                email: 'Please enter a valid email address'
            },
             password:{
                required: 'Password is required',
               
            },
       },
});
$( ".loginbtn" ).click(function( ) {
    if($('.loginform').valid())
    {
        $('.loginbtn').attr('disabled',true);
       $('.loginbtn').html('<i class="fa fa-spinner fa-spin"></i> Processing...');
        $('.loginform').submit();
    }
  
});
$(document).ready(function(){
	  setTimeout(function(){ $('.alert-success').hide(); }, 5000);
	  setTimeout(function(){ $('.alert-danger').hide(); }, 5000);
	});
	</script>