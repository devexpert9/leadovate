
@if (Session()->exists('user'))
        @include('layouts/header')
@else
        @include('auth/login_head') 
@endif


<?php
    $options = App\Options::getoption();
    $pp_title=''; $pp_content=''; 
?>
@if(!empty($options))
<?php 
 
    foreach($options as $option)
    {
        if($option->coulmn_name == 'pp_title')
        {
            $pp_title= $option->coulmn_value; 
        }
        if($option->coulmn_name == 'pp_content')
        {
            $pp_content= $option->coulmn_value; 
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
            			<h4> Privacy Policy </h4>
            			<ol class="breadcrumb">
            			  <li><a href="{{url('/')}}">Home</a></li>
            			  <li class="active">Privacy Policy</li>
            			</ol>
            		</div>
                </div>
            </div>
        </div>
    </section>  
    
    <section class="application-sec courses-sec login-pds">
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                    <h3><?php echo $pp_title; ?></h3>
                </div>

                <div class="col-sm-12 col-md-12">
                    <?php echo $pp_content; ?>
                </div>
            </div>
        </div>
    </section>    


@include('auth/login_foot')