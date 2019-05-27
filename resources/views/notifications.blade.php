@if (Session()->exists('user'))
@include('layouts/header')
@else
@include('auth/login_head') 
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
            			<h4>Notifications </h4>
            			<ol class="breadcrumb">
            			  <li><a href="{{url('/')}}">Home</a></li>
            			  <li class="active">Notifications</li>
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
                    <h3>Notifications</h3>
                    </div>
                    <?php 
                    $data=array('to_id'=>Session()->get('userid'));
                    $noti=\App\Notification::getdata2($data);
                    
                    ?>
                    <div class="col-sm-12 col-md-12">
                 <div class="card-body notify-page">
										<div class="panel">
            								
        								    <div class="feeds-panel bt-0">
            								<ul class="nav noti-list">
            							    @forelse($noti as $n)
                                            <li  class="view_notification hide{{$n->id}}" data-id="{{$n->id}}" data-status="{{$n->status}}"  @if($n->status =='0')
                                            style="background:#eee"
                                            @endif>	
                                            <i class="fa fa-bell nof-bell"></i>
                                            <a href="{{$n->url}}">
                                            <span class="text"><?=$n->description;?></span>
                                            <span class="time"><?php  $curr_time = $n->created_at;  
                                            $time_ago = strtotime($curr_time); 
                                            echo time_Ago($time_ago); ?></span>
                                            </a>
                                            <button type="button" data-toggle="modal" class="hide{{$n->id}} btn delete_notification 
                                            btn-danger round btn-nots" data-table="activities" data-title="activities" 
                                            data-id="{{$n->id}}" 
                                            data-action="https://sites.indiit.com/leadovate/dev/admin/delete_record"
                                            data-target="#modal_del">
                                            <i class="fa fa-trash"></i>
                                            </button>
                                            </li>
                                            
            								@empty
            								@endforelse
            										
            									</ul>
            								</div> 
            							
            							</div>
									</div>
                </div>
            </div>
        </div>
    </section>    
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
@include('auth/login_foot')
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
    $('#modal_del').modal('hide');
    $('.hide'+id).remove();
    $(".as1").html("Deleted Successfully..!");
    $(".as1").show();  
    setTimeout(function(){ $('.alert-success').hide(); }, 2000);
    },
    }); 
});

</script>
<script>
$('.view_notification').click(function(){
    var id=$(this).attr("data-id");
    var status=$(this).attr("data-status");
    var table="notification";
    var base=$('#base_url').val();
    var action =base+'/update_status_notification';
    var token=$('input[name="_token"]').val();
    var data ={_token:token,table:table,status:status,id:id};
    $.ajax({
    headers: {
    'X-CSRF-Token': $('input[name="_token"]').val()
    },
    type: 'post',
    url: action,
    data: data,
    success: function (data1) {
       
    },
    }); 
    
});
</script>