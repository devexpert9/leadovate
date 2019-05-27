@include('auth/login_head')
<style>
.subs-box
{
display:none;
}
</style>
<section class="application-sec">
<div class="container">
<div class="row">
<div class="col-lg-12 col-md-12">
<h4 class="pricr-head"> Pricing Plan </h4>
</div>
<form class="registerform" method="POST"  enctype="multipart/form-data" 
data-action="{{ url('/') }}/register_user_add" data-next="{{url('/')}}" >
@csrf
<input type="hidden" name="first_name" value="<?php if(isset($data)){ if(!empty($data['first_name'])) { echo $data['first_name']; }}?>">
<input type="hidden" name="last_name" value="<?php if(isset($data)){ if(!empty($data['last_name'])) { echo $data['last_name']; }}?>">
<input type="hidden" name="username" value="<?php if(isset($data)){ if(!empty($data['username'])) { echo $data['username']; }}?>">
<input type="hidden" name="email" value="<?php if(isset($data)){ if(!empty($data['email'])) { echo $data['email']; }}?>">
<input type="hidden" name="phone" value="<?php if(isset($data)){ if(!empty($data['phone'])) { echo $data['phone']; }}?>">
<input type="hidden" name="password" value="<?php if(isset($data)){ if(!empty($data['password'])) { echo $data['password']; }}?>">
<input type="hidden" id="pack_id" name="package_id" value="">
<input type="hidden" id="feature" name="feature" value="">
<input type="hidden" name="school_year" value="<?php if(isset($data)){ if(!empty($data['school_year'])) { echo $data['school_year']; }}?>">
@if(!empty($subsriptions))
@foreach($subsriptions as $sub)
<div class="col-lg-4 col-md-6">
<div class="pricing-box text-center mb-30">
<div class="pricing-head mb-35">
<div class="price-icon mb-45">
<img @if(!empty($sub->plan_img)) src="{{url('public/uploads/'.$sub->plan_img)}}"  @else src="assets/img/p_icon01.png" @endif alt="">
</div>
<h4>@if(!empty($sub->plan_name)){{$sub->plan_name}} @endif</h4>
</div>
<div class="pricing-list mb-40">
<ul>
@if(!empty($sub->detailed_features))
<?php $dd = explode('#',$sub->detailed_features); ?>
@foreach($dd as $d)
<li><i class="fas fa-check"></i>{{$d}}</li>
@endforeach
@endif
</ul>
</div>
<div class="price-count mb-45">
<h5>${{$sub->price}}</h5>
<span>{{$sub->duration}} Month(s)</span>
</div>
<div class="price-btn">
<a href="javascript:void(0);"  data-id="{{$sub->id}}" data-feature="{{$sub->features}}" class="btn choose_plan" >Choose Plan</a>
</div>
</div>
</div>
@endforeach
@endif
</form>
</div>
</div>
</section>

<!-- Modal -->
<div id="confirm" class="modal fade" role="dialog">
<div class="modal-dialog">
<!-- Modal content-->
<div class="modal-content">
<div class="modal-header">
<button type="button" class="close" data-dismiss="modal">&times;</button>
<h4 class="modal-title">Confirm Package</h4>
</div>
<div class="modal-body">
<p>Are you sure you want to select this package ..?</p>
</div>
<div class="modal-footer">
<button type="button" class="btn btn-success confirm_package" >Yes</button>
<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
</div>
</div>
</div>
</div>


@include('layouts/footer')
<script>
$('.choose_plan').click(function()
{
$('#confirm').modal('show');

});
$('.confirm_package').click(function()
{
submitform11('registerform','check_pack'); 
});
$('.check_pack').click(function()
{
if($('#pack_id').val() == '')
{
alert('Please select package first');
return;
}else
{
submitform11('registerform','check_pack'); 
}

});
$('.choose_plan').click(function()
{
var id=  $(this).attr('data-id');
var feature= $(this).attr('data-feature');
$('#pack_id').val(id);
$('#feature').val(feature);

});
function submitform11(form,btn)
{

var data = new FormData('.'+form);
var other_data = $('.'+form).serializeArray();
$.each(other_data,function(key,input){
data.append(input.name,input.value);
});

var action = $('.'+form).attr('data-action');


$.ajax({
headers: {
'X-CSRF-Token': $('input[name="_token"]').val()
},
type: 'post',
url: action,
data: data,
contentType: false,
cache: false,
processData:false,
dataType:'json',
success: function (data) {
if(data.erro==202)
{
$(".dg1").html(data.message);
$(".dg1").show();
setTimeout(function(){ $('.alert-danger').hide(); }, 3000);
$('.'+btn).attr('disabled',false);
$('.'+btn).html('Save');   
}
if(data.erro==101)
{
$('#confirm').modal('hide');
$(".as1").html(data.message);
$(".as1").show();  
var next = $('.'+form).attr('data-next');
setTimeout(function(){  $('.alert-success').hide();window.location.href= next; }, 3000); 

}
},
}); 
}


</script>