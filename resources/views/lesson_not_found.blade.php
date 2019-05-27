@if (Session()->exists('user'))
        @include('layouts/header')
@else
        @include('auth/login_head') 
@endif 
<?php
    $options = App\Options::getoption();
    $tc_title=''; $tc_content=''; 
?>
@if(!empty($options))
<?php 
 
    foreach($options as $option)
    {
        if($option->coulmn_name == 'tc_title')
        {
            $tc_title= $option->coulmn_value; 
        }
        if($option->coulmn_name == 'tc_content')
        {
            $tc_content= $option->coulmn_value; 
        }
    }
  
?>
@endif
<style>
.profile_header
{
display:none;
}
</style>
    <section class="prof-sec">
        <div class="container">
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="bread-cums">
            			<h4>404 Not found</h4>
            			<ol class="breadcrumb">
            			 
            			</ol>
            		</div>
                </div>
            </div>
        </div>
    </section>  
    
    <section class="application-sec courses-sec login-pds">
        <div class="container">
            <div class="row">
              
                <div class="col-sm-12 col-md-12">
                   <h5> This lesson has been deleted or not exist.</h5>
                </div>
            </div>
        </div>
    </section>    


@include('auth/login_foot')