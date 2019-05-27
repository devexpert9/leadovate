@include('layouts/admin_header')
		<!-- Content_right -->
	<div class="container_full">
		@include('layouts/admin_sidebar')
		
    	<div class="content_wrapper">
				<div class="container-fluid">
					<section class="chart_section">
						

						<div class="row">
							<div class="col-xl-12 col-lg-12 mb-4 d-flex align-items-stretch">
								<div class="widthfull card card-shadow">
									<div class="card-header">
										<div class="card-title">
											Notifications
										</div>
									</div>
									<div class="card-body notify-page">
										<div class="panel">
            								
        								    <div class="feeds-panel bt-0">
            								<ul class="nav">
            								@forelse($notification as $n)
                                            <li  class="view_notification" data-id="{{$n->id}}" data-status="{{$n->status}}"  @if($n->status =='0')
                                            style="background:#eee"
                                            @endif>	
                                            <button type="button" data-toggle="modal" class="btn delete_notification  btn-danger round dlt-rgt" data-table="activities" data-title="activities" data-id="{{$n->id}}" data-action="https://sites.indiit.com/leadovate/dev/admin/delete_record" data-target="#modal_del">
									        	<i class="fa fa-trash"></i>
									    	</button>
                                            <a href="{{$n->url}}">
                                            
                                            <span class="time"><?php  $curr_time = $n->created_at;  
                                            $time_ago = strtotime($curr_time); 
                                            echo time_Ago($time_ago); ?></span>
                                            <i class="fa icon-book-open text-white bg-blue"></i>
                                            <span class="text"><?=$n->description;?></span>
                                            </a>
                                            
                                            </li> 
                                        
            										@empty
            										@endforelse
            								</ul>
            								</div> 
            							
            							</div>{!! $notification->render() !!}
									</div>
								</div>
							</div>

						</div>

						
					</section>
				</div>
			</div>
	</div>
	<!-- Content_right_End -->		
<div class="modal del-modal fade" id="modal_del" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-body text-center">
				<i class="icon-close"></i>
				<h1>Are you sure?</h1>	
				<input type="hidden" id="notid" value="">
			
				<p class="lbl">Do you really want to delete this notification? This action cannot be undone.</p>
				<ul class="action-btns">					
					<li>
						<button type="button" class="btn  btn-light mr-2" data-dismiss="modal">Cancel</button>
					</li>
					<li>
					    <button type="button" class="btn  btn-danger delete_notificationaa">Delete</button>
					</li>
				</ul>
			</div>
			
		</div>
	</div>
</div>
@include('layouts/admin_footer')

<script>
$('.delete_notification').click(function(){
       var id=$(this).attr("data-id");
       $('#notid').val(id);
    
});
$('.delete_notificationaa').click(function(){
     var id=$('#notid').val();
    
    var table="notification";
    var base=$('#base_url').val();
    var action =base+'/delete_notification';
    var token=$('input[name="_token"]').val();
    var data ={_token:token,table:table,id:id};
    $.ajax({
    headers: {
    'X-CSRF-Token': $('input[name="_token"]').val()
    },
    type: 'post',
    url: action,
    data: data,
    success: function (data1) {
       location.reload();
    },
    }); 
});

</script>
