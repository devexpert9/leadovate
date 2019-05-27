@include('layouts/admin_header')
<div class="container_full">
@include('layouts/admin_sidebar')

<?php $tc_title=''; $tc_content='';  ?>
@if(!empty($options))
<?php 
                                 
    foreach($options as $option)
    {
        if($option->coulmn_name == 'tc_title')
        {
            $tc_title = $option->coulmn_value; 
        }
        if($option->coulmn_name == 'tc_content')
        {
            $tc_content = $option->coulmn_value; 
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
											Terms & Conditions
										</div>
									</div>
									<div class="card-body tabs-ctds">
										<div class="row">
										<div class="col-xl-12">
										    <form method="POST" data-next="" class="addterms_conditions" data-action="{{url('admin/addoptions')}}" class="mt-4">
                                                <div class="row">
                                                    <div class="col-md-12"> @csrf
                                    
                                                      <input type="hidden" name="pages" value="Terms & Conditions">
                                                      
                                                      <div class="form-group">
                                                        <label class="fw-500">Title</label>
                                                        <input name="tc_title" id="tc_title" style="color:black;" @if(!empty($tc_title))value="{{$tc_title}}" @endif  class="checkss form-control form-control-lg"> 
                                                      </div>
                                                      <div class="form-group">
                                                        <label class="fw-500">Description</label>
                                                        <textarea id="editor1" rows="10" cols="80">@if(!empty($tc_content)){{$tc_content}}@endif</textarea> <span class="editor1" style="display:none;color:red;font-size: 12px;font-weight: 500;">This Field is required</span> 
                                                      </div>
                                                      <!--------------------------------------------->
                                    
                                                      <div class="form-group">
                                                        <button class="btn btn-info addterms_conditionsbtn">Save</button>
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
    
    $('.addterms_conditionsbtn').click(function(){
        $('.addterms_conditions').validate();
    });
    
    $('.addterms_conditions').validate({
       rules: {
            tc_title: {
                required: true,
            },  
            
           },
           messages: {
                tc_title:{
                    required: 'Title is required',
                },
           },
           submitHandler: function(form) {
            $('.addterms_conditionsbtn').attr('disabled',true);
            $('.addterms_conditionsbtn').html('<i class="fa fa-spinner fa-spin"></i> Processing...');
            submitform('addterms_conditions','addterms_conditionsbtn');
              
           }
    });
    
</script>

