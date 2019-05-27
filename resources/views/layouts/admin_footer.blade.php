<footer class="footer ptb-20">
	<div class="row">
		<div class="col-md-12 text-center">
			<div class="copy_right">
				<p>
					2019 © Leadovate By
					<a href="#">Indi IT Solutions</a>
				</p>
			</div>

		</div>
	</div>
</footer>
</div>

<div class="modal del-modal fade" id="archive_redo_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-body text-center">
				<i class="icon-close"></i>
				<h1>Are you sure?</h1>	
				<input type="hidden" id="del_id" value="">
				<input type="hidden" id="del_table" value="">
				<input type="hidden" id="del_action" value="">
				<p class="lbl">Do you really want to Publish this course? This action cannot be undone.</p>
				<ul class="action-btns">					
					<li>
						<button type="button" class="btn  btn-light mr-2" data-dismiss="modal">Cancel</button>
					</li>
					<li>
					    <button type="button" class="btn  btn-danger confirm_publish">Publish</button>
					</li>
				</ul>
			</div>
		</div>
	</div>
</div>

<div class="modal del-modal fade" id="archive_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-body text-center">
				<i class="icon-close"></i>
				<h1>Are you sure?</h1>	
				<input type="hidden" id="del_id" value="">
				<input type="hidden" id="del_table" value="">
				<input type="hidden" id="del_action" value="">
				<p class="lbl">Do you really want to Archive this course? This action cannot be undone.</p>
				<ul class="action-btns">					
					<li>
						<button type="button" class="btn  btn-light mr-2" data-dismiss="modal">Cancel</button>
					</li>
					<li>
					    <button type="button" class="btn  btn-danger confirm_archive">Archive</button>
					</li>
				</ul>
			</div>
			
		</div>
	</div>
</div>
<!-- Delete Modal -->
<!-- Delete Modal -->
<div class="modal del-modal fade" id="delete_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-body text-center">
				<i class="icon-close"></i>
				<h1>Are you sure?</h1>	
				<input type="hidden" id="del_id" value="">
				<input type="hidden" id="del_table" value="">
				<input type="hidden" id="del_action" value="">
				<p class="lbl">Do you really want to delete this user? This action cannot be undone.</p>
				<ul class="action-btns">					
					<li>
						<button type="button" class="btn  btn-light mr-2" data-dismiss="modal">Cancel</button>
					</li>
					<li>
					    <button type="button" class="btn  btn-danger confirm_delete">Delete</button>
					</li>
				</ul>
			</div>
			
		</div>
	</div>
</div>
<!-- Delete Modal -->
<div class="modal fade bd-example-modal-lg"  id="update_assign_user" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title mt-0" id="myLargeModalLabel">Update Assign Users</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
			   <form class="assignuser" method="POST" data-action="{{ url('/') }}/admin/assign-user"  data-next="{{ url('/') }}/admin/mentors" >
				@csrf
				<div class="bd-example table_style">
				    <input type="hidden" value="" id="mentor_id" name="mentor_id">
                    <div class="form-group slcts">
                    <input type="file" id="files" style="display:none">
                    <div id="show_assign">
                    <select class="test1 form-control js-example-basic-single"  name="assigned_users[]" id="test" multiple="multiple" required>
                    <?php if(!empty($user_p)){ 
                    foreach($user_p as $p){ 
                    echo $p;?>
                    <?php }} ?>
                    </select>
                    </div>
                    </div>
					<button type="button" class="btn btn-success save_assign_btn">Assign</button>
				</div>
			</form>
			</div>
		</div>
	</div>
</div>
<!--Assign User Modal-->
<div class="modal fade bd-example-modal-lg"  id="assign_user" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title mt-0" id="myLargeModalLabel">Assign Users</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
			   <form class="assignuser" method="POST" data-action="{{ url('/') }}/admin/assign-user" data-next="{{ url('/') }}/admin/mentors">
				@csrf
				<div class="bd-example table_style">
                    <div class="form-group slcts">
                    <input type="file" id="files" style="display:none">
                    
                    <select class="test form-control js-example-basic-single"  name="assigned_users[]" id="test" multiple="multiple" required>
                    <?php if(!empty($user_p)){ 
                    foreach($user_p as $p){ 
                    echo $p;?>
                    <?php }} ?>
                    </select>
                    </div>
					<button type="button" class="btn btn-success save_assign_btn">Assign</button>
				</div>
			</form>
			</div>
		</div>
	</div>
</div>
<!--Assign User Modal-->
 
	<script type="text/javascript" src="{{url('/')}}/resources/admin_assets/js/jquery.min.js"></script>
	 <script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.4/jquery-ui.min.js" type="text/javascript"></script>
	<script type="text/javascript" src="{{url('/')}}/resources/admin_assets/js/popper.min.js"></script>
	<script type="text/javascript" src="{{url('/')}}/resources/admin_assets/js/bootstrap.min.js"></script>
	<script type="text/javascript" src="{{url('/')}}/resources/admin_assets/js/jquery.mCustomScrollbar.concat.min.js"></script>
	<!--sparkline chart-->
	<script src="{{url('/')}}/resources/admin_assets/js/index/jquery.sparkline.js"></script>
	<script src="{{url('/')}}/resources/admin_assets/js/index/sparkline-init.js"></script>
		
	<!--easy pie chart-->
	<script src="{{url('/')}}/resources/admin_assets/js/index/jquery.easy-pie-chart.js"></script>
	<script src="{{url('/')}}/resources/admin_assets/js/index/easy-pie-chart-init.js"></script>
	<!-- ++++++ -->
	<script src="{{url('/')}}/resources/admin_assets/js/index/vendorscripts.bundle.js"></script>
	<script src="{{url('/')}}/resources/admin_assets/js/index/knob.bundle.js"></script>
	<script src="{{url('/')}}/resources/admin_assets/js/index/infobox-1.js"></script>
	<script src="{{url('/')}}/resources/admin_assets/js/Chart.bundle.js"></script>
	<script src="{{url('/')}}/resources/admin_assets/js/utils.js"></script>
	<!--vectormap-->
	<script src="{{url('/')}}/resources/admin_assets/js/index/jquery-jvectormap-1.2.2.min.js"></script>
	<script src="{{url('/')}}/resources/admin_assets/js/index/jquery-jvectormap-world-mill-en.js"></script>
	<script src="{{url('/')}}/resources/admin_assets/js/index/vmap-init.js"></script>
	<!--echarts-->
	<script type="text/javascript" src="{{url('/')}}/resources/admin_assets/js/index/echarts/echarts-all-3.js"></script>
	<!--flot-chart-init.-->
    <script src="{{url('/')}}/resources/admin_assets/js/flot-chart/jquery.flot.js"></script>
     <script src="{{url('/')}}/resources/assets/js/validate.js"></script>
	<script type="text/javascript" src="{{url('/')}}/resources/admin_assets/js/index/flot-chart/flot-chart-init.js"></script>
	<!--init echarts-->
	<script type="text/javascript" src="{{url('/')}}/resources/admin_assets/js/index/echarts/init-echarts.js"></script>
	<script type="text/javascript" src="{{url('/')}}/resources/admin_assets/js/jquery.dcjqaccordion.2.7.js"></script>
	<script type="text/javascript" src="{{url('/')}}/resources/admin_assets/js/owl.carousel.min.js"></script>
	<script src="{{url('/')}}/resources/admin_assets/js/custom.js" type="text/javascript"></script>
	<script src="{{url('/')}}/resources/admin_assets/js/fSelect.js" type="text/javascript"></script>
	<script src="{{url('/')}}/resources/admin_assets/js/chosen.jquery.js" type="text/javascript"></script>
     
    <script src="{{url('/')}}/resources/assets/js/jquery.dataTables.min.js"></script>
    <script src="{{url('/')}}/resources/assets/js/dataTables.bootstrap4.min.js"></script>
    <script src="{{url('/')}}/resources/admin_assets/js/select2.min.js"></script>
    <script src="{{url('/')}}/resources/admin_assets/js/jquery.richtext.js" type="text/javascript"></script>
    <!--<script src="https://cdn.ckeditor.com/4.11.1/basic/ckeditor.js"></script-->
    <script src="https://cdn.ckeditor.com/4.11.1/standard/ckeditor.js"></script>
    <!--<script src="https://cdn.ckeditor.com/4.11.1/full/ckeditor.js"></script>-->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.11/summernote.js"></script>
    <!--script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.0.3/js/bootstrap.min.js"></script--->
    <script src="https://cdn.rawgit.com/davidstutz/bootstrap-multiselect/master/dist/js/bootstrap-multiselect.js"
    type="text/javascript"></script>

<script>
	$(document).ready(function() {
		$('#bs4-table').DataTable({
        "ordering": false
        } );
		$('.js-example-basic-single').select2();
	});
		
	function submitform(form,btn)
    {
       
        var data = new FormData('.'+form);
        if(form == "addprivacy_policy")
        {
            data.append('pp_content', CKEDITOR.instances['editor1'].getData());
        }
        
        if(form == "addterms_conditions")
        {
            data.append('tc_content', CKEDITOR.instances['editor1'].getData());
        }
        
        
        var other_data = $('.'+form).serializeArray();
        $.each(other_data,function(key,input){
            data.append(input.name,input.value);
        });
       
        var url = $('.'+form).attr('data-next');
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
                    setTimeout(function(){ $('.alert-danger').hide(); }, 5000);
                    $('.'+btn).attr('disabled',false);
                }
                if(data.erro==101)
                {
                  
                    $(".as1").html(data.message);
                    $(".as1").show();  
                    setTimeout(function(){ $('.alert-success').hide(); }, 5000);
                    $('.'+btn).attr('disabled',false);
                    $('.'+btn).html('save');
                    if(url!='')
                    {
                        setTimeout(function(){  window.location.href= url; }, 3000);
                    }
                }
            },
        }); 
    }
    
	</script>
	<script>
	/*	var countDownDate = new Date("Apr 6, 2019 15:37:25").getTime();
		var x = setInterval(function() {
	    var now = new Date().getTime();
		var distance = countDownDate - now;
    	var days = Math.floor(distance / (1000 * 60 * 60 * 24));
    	var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
	    var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
    	var seconds = Math.floor((distance % (1000 * 60)) / 1000);
	    document.getElementById("demo").innerHTML = days + "d " + hours + "h "
		 + minutes + "m " + seconds + "s ";
		if (distance < 0) {
		clearInterval(x);
			document.getElementById("demo").innerHTML = "EXPIRED";
		 }
		}, 1000);*/
	(function($){
		$(window).on("load",function(){
			$("#content-3").mCustomScrollbar({
				scrollButtons:{enable:true},
				theme:"light-thick",
				scrollbarPosition:"outside"
			});
			
			$("#content-4").mCustomScrollbar({
				theme:"rounded-dots",
				scrollInertia:400
			});
			
			$("#content-5").mCustomScrollbar({
				axis:"x",
				theme:"dark-thin",
				autoExpandScrollbar:true,
				advanced:{autoExpandHorizontalScroll:true}
			});
			
			$("#content-6").mCustomScrollbar({
				axis:"x",
				theme:"light-3",
				advanced:{autoExpandHorizontalScroll:true}
			});
			
			$("#content-7").mCustomScrollbar({
				scrollButtons:{enable:true},
				theme:"3d-thick"
			});
			
			$("#content-8").mCustomScrollbar({
				axis:"yx",
				scrollButtons:{enable:true},
				theme:"3d",
				scrollbarPosition:"outside"
			});
			
			$("#content-9").mCustomScrollbar({
				scrollButtons:{enable:true,scrollType:"stepped"},
				keyboard:{scrollType:"stepped"},
				mouseWheel:{scrollAmount:188},
				theme:"rounded-dark",
				autoExpandScrollbar:true,
				snapAmount:188,
				snapOffset:65
			});
			
		});
	})(jQuery);
	if ( screen.width < 500 ){
		  function openNav() {
	  document.getElementById("myNav").style.width = "100%";
	}

	function closeNav() {
	  document.getElementById("myNav").style.width = "0%";
	}
	}
	else{
		function openNav() {
	  document.getElementById("myNav").style.width = "400px";
	}

	function closeNav() {
	  document.getElementById("myNav").style.width = "0%";
	}
	}
$('a.full-vie').click(function() {
    $('ul.list-expend li.current').removeClass('current');
    $(this).closest('li').addClass('current');
});
$("a.full-hide").click(function(){
  $("ul.list-expend").addClass("full-one");
});

$("a.full-show").click(function(){
  $("ul.list-expend").removeClass("full-one");
  $("ul.list-expend li").removeClass("current");
});

$(".scroll_auto").mCustomScrollbar({
		setWidth: false,
		setHeight: false,
		setTop: 0,
		setLeft: 0,
		axis: "y",
		scrollbarPosition: "inside",
		scrollInertia: 950,
		autoDraggerLength: true,
		autoHideScrollbar: false,
		autoExpandScrollbar: false,
		alwaysShowScrollbar: 0,
		snapAmount: null,
		snapOffset: 0
	});
	$('#dc_accordion').dcAccordion();
</script>
</body>
</html>