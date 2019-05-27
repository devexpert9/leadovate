          @include('auth/login_head') 
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
    </section>   <section class="application-sec courses-sec login-pds">
            <div class="container">
            <div class="row">
            <div class="col-md-6 col-md-offset-3 col-sm-6 col-sm-offset-3">
            <div class="login-pgs">
            <h4>Forgot Password </h4>
            <p class="text-rest"> Please enter your Email Address to reset your password. </a>
             @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
            <form method="POST" action="{{ route('password.email') }}">
            @csrf
            <div class="row">
            <div class="col-md-12">
            <div class="form-group">
            <label for="exampleInputEmail1">Email address</label>
            <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required>
            
            @if ($errors->has('email'))
            <span class="invalid-feedback" role="alert">
            <strong>{{ $errors->first('email') }}</strong>
            </span>
            @endif	</div>
            </div>
            </div>
             <div class="row">
            
            <div class="form-group row mb-0">
            <div class="col-md-12 offset-md-4">
            <button type="submit" class="btn btn-default btn-block login-bns">
            Reset Password
            </button>
            </div>
            </div><div class="col-md-12">
            <p class="dont"><a href="{{url('/')}}/login">Back to Login ! </a></p> 
            </div>
            </form>
            </div>
            </div>
            </div>
            </div>
            </section>
            @include('auth/login_foot')