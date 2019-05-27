 @include('auth/admin_login_head') 
 <style>
button.btn.btn-default.btn-block.login-bns.classlogin[disabled]:hover {
    background: #f48164;
    color: #fff;
}
 </style>
 <section class="application-sec courses-sec login-pds">
        <div class="container">
            <div class="row">
				<div class="col-md-6 col-md-offset-3 col-sm-6 col-sm-offset-3">
                    <div class="login-pgs">
						<h4>Login to account </h4>
						 
		<form class="adminlogin" method="POST" data-action="{{ route('admin.login') }}" >
				
                        @csrf
							<div class="row">
								<div class="col-md-12">
									<div class="form-group">
										<label for="exampleInputEmail1">Email address</label>
										 <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}"  autofocus   placeholder="Email">
										 
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
										 <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password"   placeholder="Password">
									
									 @if ($errors->has('password'))
                                     <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('password') }}</strong>
                                     </span>
                                    @endif
									</div>
								</div>
							</div>
						
							<div class="row">
								<div class="col-md-12">
									<button type="submit" class="btn btn-default btn-block login-bns classlogin">Login</button>
								</div>
							</div>
						</form>
					</div>
                </div>
			</div>
        </div>
    </section>
@include('auth/login_foot')
<script>
  $('.classlogin').click(function(){
      if($('.adminlogin').valid())
      {
       $('.classlogin').attr('disabled',true);
       $('.classlogin').html(' Processing...');
       submitform('adminlogin','classlogin');  
      }
  })
 $('.adminlogin').validate({
   rules: {
        email: {
                required: true,
                email: true
            }, 
             password: {
                required: true
            }, 
       },
       messages: {
             email:{
                required: 'Email is Required',
                email: 'Please enter valid email'
            },
            password: {
                required: 'Password is Required',
            }, 
       },
       submitHandler: function(form) {
       }
});
function submitform(form,btn)
{
     var data = $('.'+form).serialize();
        var action = $('.'+form).attr('data-action');
         $.ajax({
          headers: {
              'X-CSRF-Token': $('input[name="_token"]').val()
          },
                type: 'post',
                url: action,
                data: data,
                dataType:'json',
                success: function (data) {
                  if(data.erro==202)
                    {
                    $(".dg1").html(data.message);
                    $(".dg1").show();
                    setTimeout(function(){ $('.alert-danger').hide(); }, 3000);
                    $('.'+btn).attr('disabled',false);
                    $('.'+btn).html('Log In');   
                    }
                    if(data.erro==101)
                    {
                    $(".as1").html(data.message);
                    $(".as1").show();  
                    setTimeout(function(){ $('.alert-success').hide(); }, 3000);
                    $('.'+btn).attr('disabled',false);
                    $('.'+btn).html('Log In');   
                    setTimeout(function(){  window.location.href= "{{url('admin/dashboard')}}"; }, 3000);
                       
                    }
                },
            }); 
}
  </script>

   
   
   
   