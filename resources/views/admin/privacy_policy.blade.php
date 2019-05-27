@include('layouts/admin_header')
<div class="container_full">
@include('layouts/admin_sidebar')
<?php $pp_title=''; $pp_content='';  ?>
@if(!empty($options))
<?php 

foreach($options as $option)
{
if($option->coulmn_name == 'pp_title')
{
$pp_title = $option->coulmn_value; 
}
if($option->coulmn_name == 'pp_content')
{
$pp_content = $option->coulmn_value; 
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
											Privacy Policy
										</div>
									</div>
									<div class="card-body tabs-ctds">
										<div class="row">
										<div class="col-xl-12">
										    <form method="POST" data-next="" class="addprivacy_policy" data-action="{{url('admin/addoptions')}}" class="mt-4">
                                                <div class="row">
                                                    <div class="col-md-12"> @csrf
                                    
                                                      <input type="hidden" name="pages" value="Privacy Policy">
                                                      
                                                      <div class="form-group">
                                                        <label class="fw-500">Title</label>
                                                        <input name="pp_title" id="pp_title" style="color:black;" @if(!empty($pp_title))value="{{$pp_title}}" @endif  class="checkss form-control form-control-lg"> 
                                                      </div>
                                                      <div class="form-group">
                                                        <label class="fw-500">Description</label>
                                                        <textarea id="editor1" rows="10" cols="80">@if(!empty($pp_content)){{$pp_content}}@endif</textarea> <span class="editor1" style="display:none;color:red;font-size: 12px;font-weight: 500;">This Field is required</span> 
                                                      </div>
                                                      <!--------------------------------------------->
                                    
                                                      <div class="form-group">
                                                        <button class="btn btn-info addprivacy_policybtn">Save</button>
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
	
@include('layouts/admin_footer')

<script>
    CKEDITOR.replace('editor1');
    
    $('.addprivacy_policybtn').click(function(){
        $('.addprivacy_policy').validate();
    });
    
    $('.addprivacy_policy').validate({
       rules: {
            pp_title: {
                required: true,
            },  
            
           },
           messages: {
                pp_title:{
                    required: 'Title is required',
                },
           },
           submitHandler: function(form) {
            $('.addprivacy_policybtn').attr('disabled',true);
            $('.addprivacy_policybtn').html('<i class="fa fa-spinner fa-spin"></i> Processing...');
            submitform('addprivacy_policy','addprivacy_policybtn');
              
           }
    });
    
    
</script>

