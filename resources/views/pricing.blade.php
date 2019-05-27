@include('layouts/header')
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
							<a href="javascript:void(0)" data-id="{{$sub->id}}" class="btn choose_plan">Choose Plan</a>
						</div>
					</div>
				</div>
				@endforeach
				@endif
			</div>
		</div>
	</section>

@include('layouts/footer')
<script>
$('.choose_plan').click(function()
{       var url='{{url('/home')}}';
        var id=$(this).attr('data-id'); 
        var base=$('#base_url').val();
        var action =base+'/upgradeplan';
        var data ={id:id};
         $.ajax({
          headers: {
              'X-CSRF-Token': $('input[name="_token"]').val()
          },
                type: 'post',
                url: action,
                data: data,
                success: function (data1) {
                   	var obj = JSON.parse(data1);
                    if(obj.code == '101')
                    {
                        $(".as1").html(obj.status);
                        $(".as1").show();  
                        setTimeout(function(){
                            window.location.href= url;
                            $('.alert-success').hide();
                            }, 2000);
                        
                    }
	
                },
            });
});



</script>