@include('layouts/admin_header')
	<!-- Content_right -->
	<div class="container_full">
		@include('layouts/admin_sidebar')
		
<?php
    $fb_link = ''; $tweet_link=''; $pinterest_link=''; $insta_link=''; $google_link='';
?>

@if(!empty($options))
 <?php 
 
    foreach($options as $option)
    {
        if($option->coulmn_name == 'fb_link')
        {
            $fb_link= $option->coulmn_value; 
        }
        if($option->coulmn_name == 'tweet_link')
        {
            $tweet_link= $option->coulmn_value; 
        }
        if($option->coulmn_name == 'pinterest_link')
        {
            $pinterest_link= $option->coulmn_value; 
        }
        if($option->coulmn_name == 'insta_link')
        {
            $insta_link = $option->coulmn_value; 
        }
        if($option->coulmn_name == 'google_link')
        {
            $google_link= $option->coulmn_value; 
        }
      
    }
  
 ?>

@endif

		<div class="content_wrapper">
			<div class="container-fluid">
				<section class="chart_section">
					
					<div class="row">
						<div class="col-xl-12 col-lg-12 mb-4">
							
								<div class="card card-shadow mb-4">
									<div class="card-header">
										<div class="card-title">
											Social Links
										</div>
									</div>
									<div class="card-body tabs-ctds">
										<div class="row">
										<div class="col-xl-12">
										    <form method="POST" data-next="" class="socail_link_form" data-action="{{url('admin/addoptions')}}" class="mt-4"> 
                                                <div class="row">
                                                    <div class="col-md-6">
                                                      @csrf
                                                        <input type="hidden" name="pages" value="Social Links">
                                                        
                                                        <div class="form-group">
                                                           <label class="fw-500">Facebook Link</label>
                                                             <input type="text" name="fb_link" style="color:black;" @if(!empty($fb_link)) value="{{$fb_link}}" @endif class="checkss form-control form-control-lg">
                                                        </div>
                                                        <div class="form-group">
                                                           <label class="fw-500">Twitter Link</label>
                                                             <input type="text" name="tweet_link" style="color:black;" @if(!empty($tweet_link)) value="{{$tweet_link}}" @endif class="checkss form-control form-control-lg">
                                                        </div>
                                                        <div class="form-group">
                                                           <label class="fw-500">Pinterest Link</label>
                                                             <input type="text" name="pinterest_link" style="color:black;" @if(!empty($pinterest_link)) value="{{$pinterest_link}}" @endif class="checkss form-control form-control-lg">
                                                        </div>
                                                        <div class="form-group">
                                                           <label class="fw-500">Instagram Link</label>
                                                             <input type="text" name="insta_link" style="color:black;" @if(!empty($insta_link)) value="{{$insta_link}}" @endif class="checkss form-control form-control-lg">
                                                        </div>
                                                        <div class="form-group">
                                                           <label class="fw-500">Google Plus Link</label>
                                                             <input type="text" name="google_link" style="color:black;" @if(!empty($google_link)) value="{{$google_link}}" @endif class="checkss form-control form-control-lg">
                                                        </div>
                                                        <div class="form-group">
                                                          <button class="btn btn-info socail_link_formbtn">Save</button>  
                                                        </div>
                                                    </div>
                                                </div>
                                            </form>
                                          
										</div>
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
    $('.socail_link_formbtn').click(function(){
        $('.socail_link_form').validate();
    });
    
    $('.socail_link_form').validate({
       rules: {
            fb_link: {
                url: true,
            },  
            tweet_link: {
                url: true,
            },  
            pinterest_link: {
                url: true,
            },  
            insta_link: {
                url: true,
            },  
            google_link: {
                url: true,
            },  
            
           },
           messages: {
                fb_link:{
                     url: "Please enter valid url",
                },
                tweet_link:{
                     url: "Please enter valid url",
                },
                pinterest_link:{
                     url: "Please enter valid url",
                },
                insta_link:{
                     url: "Please enter valid url",
                },
                google_link:{
                     url: "Please enter valid url",
                },
                
           },
           submitHandler: function(form) {
            $('.socail_link_formbtn').attr('disabled',true);
            $('.socail_link_formbtn').html('<i class="fa fa-spinner fa-spin"></i> Processing...');
            submitform('socail_link_form','socail_link_formbtn');
              
           }
    });
    
    
</script>



