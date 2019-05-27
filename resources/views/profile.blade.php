@include('layouts/header')
<style>
.subs-sec
{
    display:none;
}
</style>
<section class="application-sec">
        <div class="container">
            <div class="row">
				<div class="col-sm-12">
					<h3 class="m-b-15">Profile Settings</h3>
				</div>
				<div class="col-md-4">
					<div class="profls-sts">
						<div class="usr-ics">
						   	@if(!empty($user_details->image))
						       	<?php if(file_exists('public/uploads/'.$user_details->image)){ ?>
						       		<img src="{{url('/')}}/public/uploads/{{$user_details->image}}" alt="User Image" id="imgFileUpload" >
						       	
							   <?php }else{ ?>
							   <img src="{{url('/')}}/public/profile/{{$user_details->image}}" alt="User Image" id="imgFileUpload" >
						      
							   		  <?php }?>
							  	@else
							  	 <img src="{{url('resources/assets/img/user.jpg')}}"  alt="User Image" id="imgFileUpload" >
							 	@endif  
						    
							
							<label for="upld" class="upload-penc">
								<i class="fas fa-pencil-alt"></i>
								<input type="file" id="upld" style="visibility:hidden; width:0px; height:0px;" class="FileUpload1">
							</label>
						</div>
						<h4 class="user_profile_name"> @if(!empty($user_details->first_name)) {{$user_details->first_name}} @endif  @if(!empty($user_details->last_name)) {{$user_details->last_name}} @endif </h4>
						<h5> @if(!empty($user_details->username)) {{$user_details->username}} @endif  </h5>
					</div>
				</div>
                <div class="col-md-8">
					<div class="row">
					
						<form class="col-md-12 actvt-frm editprofile"  method="post" data-action="{{url('editprofile')}}" data-next="{{url('profile')}}">
						     @csrf
							<div class="card">
							<div class="row">
								<div class="col-md-6">
									<div class="form-group">
										<label> First Name </label>
										<input type="text" class="form-control" id="first_name" name="first_name" placeholder="Enter First Name"  @if(!empty($user_details->first_name)) value="{{$user_details->first_name}}" @endif >
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group">
										<label> Last Name </label>
										<input type="text" class="form-control" id="last_name"  name="last_name" placeholder="Enter last Name" @if(!empty($user_details->last_name)) value="{{$user_details->last_name}}" @endif >
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-md-6">
									<div class="form-group">
										<label> Email Address </label>
										<input type="email" class="form-control" id="email" name="email" placeholder="Enter Email" @if(!empty($user_details->email)) value="{{$user_details->email}}" @endif>
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group">
										<label> Phone Number </label>
										<input type="text" class="form-control" id="phone" name="phone" placeholder="Enter Phone Number" @if(!empty($user_details->phone)) value="{{$user_details->phone}}" @endif>
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-md-6">
									<div class="form-group">
										<label> Address </label>
										<input type="text" class="form-control" id="address"  name="address" placeholder="Enter Address" @if(!empty($user_details->address)) value="{{$user_details->address}}" @endif>
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group">
										<label> City </label>
										<input type="text" class="form-control" id="city" name="city"  placeholder="Enter City" @if(!empty($user_details->city)) value="{{$user_details->city}}" @endif>
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-md-6">
									<div class="form-group">
										<label> Country </label>
										<select name="country" id="country" class="form-control" required >
										    	<option value=""> Select Country </option>
										     @if(!empty($country_list))
                                           <?php $x =1; ?>
                                            @forelse($country_list as $u)
                                            	<option value="<?=  $u->code; ?>" @if($user_details->country != "") @if($user_details->country == "$u->code" ) selected @endif @endif ><?=  $u->name;?></option>
                                            @empty
                                           	<option>No Countries Found</option>
                                            @endforelse
                                            @endif
                                            
										</select>
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group">
										<label> Zip </label>
										<input type="text" class="form-control" id="zip_code" name="zip_code" placeholder="Enter Zip Code" @if(!empty($user_details->zip_code)) value="{{$user_details->zip_code}}" @endif>
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-md-12">
									<div class="form-group">
										<label> Old Password </label>
										<input type="password" class="form-control" id="oldpassword" name="oldpassword" placeholder="Enter Old Password" value="">
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group">
										<label> New Password </label>
										<input type="password" class="form-control" name="newpassword" id="newpassword" placeholder="Enter New Password" value="">
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group">
										<label> Confirm Password </label>
										<input type="password" class="form-control" name="conpassword" id="conpassword" placeholder="Confirm New Password" value="">
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-md-12">
								    <button type="submit" class="btn btn-warning btn-adds pull-left editprofilebtn">Save Changes</button>
								</div>
							</div>
							</div>
							</div>
						</form>
					</div>
				</div>
				<div class="row">
					<div class="col-sm-12">
						<h3 class="m-b-15">Your Subscription Plan</h3>
					</div>
					<div class="col-sm-12">
						<div class="subs-box">
							<div class="text-center">
                            <?php if(Session()->exists('user')){
                            $user=App\User::where('id',Session::get('userid'))->first();
                            }else
                            {
                            $user=array();
                            }
                            if(!empty($user)){
                            if(!empty($user->package_id)){
                            $package=App\Subscription::getwithid($user->package_id);
                            $current_package=App\Transaction::get_active_payment_details($user->id);
                            
                            $datestr=$current_package->end_date;//Your date
                            $date=strtotime($datestr);//Converted to a PHP date (a second count)
                            
                          
                            $diff=$date-time();//time returns current time in seconds
                            $days=floor($diff/(60*60*24));//seconds/minute*minutes/hour*hours/day)
                            $hours=round(($diff-$days*60*60*24)/(60*60));
                             if(date('Y-m-d') >=$current_package->end_date){?>
                             
                            <h4 class="">Plan expired</h4>
                            <p>Your trial is expired. Click below to upgrade subscription <br> so that you can keep learning on this platform.</p>
                            <?php }else{ ?>
                            <h4 class="">{{$package->plan_name}} Activated<br/><b><h5><?=$days;?>days  <?=$hours;?>hours   left.</h4>
                            	<span class="main-txt-icn refresh-icon price-pls">
								${{$package->price}}
								</span>
								 <p>Your trial will expire in <?=$days;?> days. Click below to upgrade to standard subscription <br> so that you can keep learning on this platform.</p>
                            <?php }}else
                            {
                               echo'<h4 class="">Free Trail Activated</h4>';  
                            echo '<p> Click below to upgrade to subscription packages <br> so that you can keep learning on this platform.</p>';
                            }
                            }?>
                          
							    
								<!--p id="demo" class="timer"></p-->
								<!--p>Your trial will expire in <b>4 days </b>. Click below to upgrade to standard subscription <br> so that you can keep learning on this platform.</p-->
                                <div class="row">
                                <div class="col-sm-12">
                                <a href="{{url('/')}}/pricing" class="btn btn-resume btn-upgrade"> Upgrade Now </a>
                                </div>
                                </div>
							</div>
						</div>
					</div>
				</div>
            </div>

                      
        </div>

    </section>

@include('layouts/footer')

<script>
/*FILE UPLOAD SCRIPT*/

$(function () {
    var fileupload = $(".FileUpload1");
    var image = $("#imgFileUpload");
    image.click(function () {
       fileupload.click();
   });
    fileupload.change(function () {
            var fileExtension = ['jpeg', 'jpg', 'png', 'gif'];
            if ($.inArray($(this).val().split('.').pop().toLowerCase(), fileExtension) == -1) {
                //alert("Only formats are allowed : "+fileExtension.join(', '));
                $('.uploaderror').html("Only formats are allowed : "+fileExtension.join(', '));
                $('.uploaderror').css({'color':'red'});
            }else
            {
                   $('.uploaderror').html('');
                var fileName = $(this).val().split('\\')[$(this).val().split('\\').length - 1];
               
                var file_data = $(".FileUpload1").prop("files")[0]; // Getting the properties of file from file field
                 var form_data = new FormData(); // Creating object of FormData class
             form_data.append("file", file_data)
                
	      $.ajax({
	       headers: {
          'X-CSRF-Token': $('input[name="_token"]').val()
      },
	       url : '{{url("/uploadprofile")}}',
	       type : 'POST',
	       data : form_data,
	       processData: false,  // tell jQuery not to process the data
	       contentType: false, 
	       dataType:'json', // tell jQuery not to set contentType
	       success : function(data) {
			if(data.erro==202)
			{
			$(".alert-danger").html(data.message);
			$(".alert-danger").show();
			 setTimeout(function(){ $('.alert-danger').hide(); }, 5000);
			}
			if(data.erro==101)
			
			{   
			    var srcimg = "{{url('public/profile')}}";
			    $('#imgFileUpload').attr('src',srcimg+'/'+data.path);
			    $('.profile-pic').attr('src',srcimg+'/'+data.path);
			    $('.user_profile_image').attr('src',srcimg+'/'+data.path);
			    $(".as1").html(data.message);
		    	$(".as1").show();
		    	setTimeout(function(){ $('.as1').hide(); }, 5000);
			}
	        }
           });
            }
    });
});




$('.editprofilebtn').click(function(){
    $('.editprofile').validate();
});

$('.editprofile').validate({
   rules: {
        first_name: {
                required: true,
            },   
        last_name: {
                required: true
            },
        email: {
            required: true,
            email : true
        },
        phone: {
           digits : true,
           minlength:10,
           maxlength:11
        },
        address: {
            required: true
        },
        city: {
            required: true
        }, 
        country: {
            required: true
        },
        zip_code: {
            required: true
        },
        
       },
       messages: {
            first_name:{
                required: 'First name is required',
            },
            last_name:{
                required: 'Last name is required',
            },
            email: {
                required: 'Email is required',
                email : 'Please enter valid email'
            },
            phone: {
                digits: 'Inavlid phone number'
            }, 
            address: {
                required: 'Address is required'
            },
            city: {
                required: 'City is required'
            }, 
            country: {
                required: 'Country is required'
            }, 
            zip_code: {
                required: 'Zip Code is required'
            }, 
       },
       submitHandler: function(form) {
           $('.editprofilebtn').attr('disabled',true);
           $('.editprofilebtn').html('<i class="fa fa-spinner fa-spin"></i> Processing...');
           submitprofileform('editprofile','editprofilebtn');
       }
});


function submitprofileform(form,btn)
{
    var data = $('.'+form).serialize();
    
    var url = $('.'+form).attr('data-next');
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
                setTimeout(function(){ $('.alert-danger').hide(); }, 5000);
                $('.'+btn).attr('disabled',false);
                $('.editprofilebtn').html('Save Changes');
                
            }
            if(data.erro==101)
            {
                $(".as1").html(data.message);
                var first_name = $('#first_name').val();
                var last_name = $('#last_name').val();
                $(".user_profile_name").html(first_name +' '+ last_name);
                $(".as1").show();  
                setTimeout(function(){ $('.alert-success').hide(); }, 3000);
                $('.'+btn).attr('disabled',false);
                 $('.editprofilebtn').html('Save Changes');
                 
                if(url!='')
                {
                //setTimeout(function(){  window.location.href= url; }, 3000);
                 
                }
            }
        },
    }); 
}
    
</script>

