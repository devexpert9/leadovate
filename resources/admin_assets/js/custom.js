(function($) {
	"use strict";
	$(".dropdown-menu li a").on('click',function () {
		$(this).parents(".dropdown").find('.btn').html($(this).html() + ' <span class="caret"></span>');
		$(this).parents(".dropdown").find('.btn').val($(this).data('value'));
	});
	//Full_Screen
	$(".fullscreen-btn").on("click", function () {
		document.fullScreenElement && null !== document.fullScreenElement || !document.mozFullScreen && !document.webkitIsFullScreen ? document.documentElement.requestFullScreen ? document.documentElement.requestFullScreen() : document.documentElement.mozRequestFullScreen ? document.documentElement.mozRequestFullScreen() : document.documentElement.webkitRequestFullScreen && document.documentElement.webkitRequestFullScreen(Element.ALLOW_KEYBOARD_INPUT) : document.cancelFullScreen ? document.cancelFullScreen() : document.mozCancelFullScreen ? document.mozCancelFullScreen() : document.webkitCancelFullScreen && document.webkitCancelFullScreen()
	});
	// collapse button in panel
	$(document).on('click', '.t-collapse', function () {
		var el = $(this).parents(".card").children(".card_chart");
		if ($(this).hasClass("fa-chevron-down")) {
			$(this).removeClass("fa-chevron-down").addClass("fa-chevron-up");
			el.slideUp(200);
		} else {
			$(this).removeClass("fa-chevron-up").addClass("fa-chevron-down");
			el.slideDown(200);

		}
	});
	
	
	
	
	
	//close button in panel
	$(document).on('click', '.t-close', function () {
		$(this).parents(".card, .stats-wrap").parent().remove();
	});
	//Scroll_BAr
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
	//Click_menu_icon_Add_Class_body
	$(".icon_menu").on('click', function () {
			$('body').toggleClass("nav_small");
			$('#dc_accordion .down_menu').parent().find('> a').removeClass('active');
			$('#dc_accordion .down_menu').hide();
	});
	//Click_menu_icon_Add_Class_body
	$(".icon_rightpenle").on('click', function () {

			$('#right-sidebar').toggleClass("open");

	});
    //Progress bar
    $('.progress-bar').each(function(){
    	var progress_val = $(this).attr('aria-valuenow');
    	$(this).width(progress_val)
    })
	// back-to-top
	$(window).on('scroll', function () {
		if ($(this).scrollTop() > 50) {
			$('#back-to-top').fadeIn();
		} else {
			$('#back-to-top').fadeOut();
		}
	});
	// scroll body to 0px on click
	$('#back-to-top').on('click', function () {

		$('body,html').animate({
			scrollTop: 0
		}, 800);
		return false;
	});

	//===ToolTip
	$(function () {
		$('[data-toggle="tooltip"]').tooltip();
		$('[data-toggle="popover"]').popover();
	});



	//Add_li
	$(".todo--panel").on("submit", "form", function (a) {
        a.preventDefault();
        a = $(this);
        var c = a.find(".form-control");
        
        $('<li class="list-group-item" style="display: none;"><label class="todo--label"><input type="checkbox" name="" value="1" class="todo--input"><span class="todo--text">' + c.val() + '</span></label><a href="#" class="todo--remove">&times;</a></li>').appendTo(".list-group").slideDown("slow");
        c.val("");
        }).on("click", ".todo--remove", function (a) {
        a.preventDefault();
        var c = $(this).parent("li");
        c.slideUp("slow", function () {
        c.remove();
		});
	});
	//$('#dc_accordion').dcAccordion();
	$(window).on('load',function(){
	$('#loader_wrpper').delay(500).fadeOut();
	
	$('#imageaddsuser').on('change', function(e){
			var action=$(this).attr('data-action');
			var url=$(this).attr('data-url');
              e.preventDefault();
              if($('#uplod-img').val() == '')
              {
                  alert("please select file");
              }
              else
              {
                 $.ajax({
                      method:'POST',
                      url: action,
                      data: new FormData(this),
                      cache: false,
                      contentType: false,
                      processData: false,
                      success: function(data)
                      {
                          
                        $('.blah').attr('src',url+'/public/uploads/'+data );
                        $('.pro_pic').attr('src',url+'/public/uploads/'+data );
						$('#image').val(data);
						$('.header_image').attr('src',url+'/public/uploads/'+data );
						$(".as1").html("Profile picture updated successfully..");
                        $(".as1").show();  
                        setTimeout(function(){ $('.alert-success').hide(); }, 2000);
                      }
                 });                      
              }                            
           });  
	  
	  
	
	////27 feb 

	$(document).on('change', '.lessons', function () {
	    
	    //alert($(this).val());
	    var id=$(this).val();
	    var random=$(this).find(':selected').data('random');
	    $(this).parent().parent().parent().addClass('hideexamplelesson'+random);
	    
	});
	$(document).on('click', '.save_user_act', function () {
        submitform('addactivityuser','save_user_act'); 
	});
	$(document).on('click', '.edit_ad', function () {
	  if($('.editactivity').valid())
      {
       $('.edit_ad').attr('disabled',true);
       $('.edit_ad').html(' Processing...'); 
        submitform('editactivity','edit_ad'); 
      }     
	});
	$(document).on('click', '.add_admin_activity', function () {
	   if($('.addadactivity').valid())
      {
       $('.add_admin_activity').attr('disabled',true);
       $('.add_admin_activity').html(' Processing...'); 
        submitform('addadactivity','add_admin_activity'); 
      }    
	});
	$(document).on('click', '.update_plan', function () {
	   if($('.editplan').valid())
      {
       $('.update_plan').attr('disabled',true);
       $('.update_plan').html(' Processing...'); 
        submitform('editplan','update_plan'); 
      }  
	});
	$(document).on('click', '.updateuser', function () {
	   if($('.edituser').valid())
      {
       $('.updateuser').attr('disabled',true);
       $('.updateuser').html(' Processing...'); 
        submitform('edituser','updateuser'); 
      }  
	});
	$(document).on('click', '.save_mentor', function () {
	    var fileExtension = ['jpeg', 'jpg', 'png', 'gif'];
	    if($('.addmentor').valid())
      {
       $('.save_mentor').attr('disabled',true);
       $('.save_mentor').html(' Processing...'); 
      submitform('addmentor','save_mentor'); 
      }
	    
	});
	$(document).on('click', '.confirm_publish', function () {
	    var id=$('#del_id').val();
	    var status="redo";
	    var table=$('#del_table').val();
	    var action=$('#del_action').val();
        var token=$('input[name="_token"]').val();
		var data ={id:id,_token:token,table:table,status:status};
         $.ajax({
          headers: {
              'X-CSRF-Token': $('input[name="_token"]').val()
          },
                type: 'post',
                url: action,
                data: data,
                success: function (data1) {
                    if(table == 'activities')
                    {
                        $(".as1").html("Deleted successfully...");
                        $(".as1").show();  
                        setTimeout(function(){ $('.alert-success').hide(); }, 1000);   
                        $('#delete_modal').modal('hide');
                        window.location.reload();
                       
                    }
                     if(table == 'usermentor')
                    {
                        $(".as1").html("Deleted successfully...");
                        $(".as1").show();  
                        setTimeout(function(){ $('.alert-success').hide(); }, 1000);   
                        $('#delete_modal').modal('hide');
                        window.location.reload();
                       
                    }
                    else
                    {
                        if(table == 'courses')
                        {
                            
                            $('#archive_redo_modal').modal('hide');
                            $(".as1").html("Published successfully...");
                            $(".as1").show();  
                            setTimeout(function(){ $('.alert-success').hide(); }, 1000);  
                            $('.hide'+id).remove();
                        }
    					
                    }
                    
                    
						
                },
            }); 
	    
	});	
	
	
	
		$(document).on('click', '.confirm_archive', function () {
	    var id=$('#del_id').val();
	    var table=$('#del_table').val();
	    var action=$('#del_action').val();
        var token=$('input[name="_token"]').val();
		var data ={id:id,_token:token,table:table};
         $.ajax({
          headers: {
              'X-CSRF-Token': $('input[name="_token"]').val()
          },
                type: 'post',
                url: action,
                data: data,
                success: function (data1) {
                    if(table == 'activities')
                    {
                        $(".as1").html("Deleted successfully...");
                        $(".as1").show();  
                        setTimeout(function(){ $('.alert-success').hide(); }, 1000);   
                        $('#delete_modal').modal('hide');
                        window.location.reload();
                       
                    }
                     if(table == 'usermentor')
                    {
                        $(".as1").html("Deleted successfully...");
                        $(".as1").show();  
                        setTimeout(function(){ $('.alert-success').hide(); }, 1000);   
                        $('#delete_modal').modal('hide');
                        window.location.reload();
                       
                    }
                    else
                    {
                        if(table == 'courses')
                        {
                            $('#archive_modal').modal('hide');
                            $(".as1").html("Archived successfully...");
                            $(".as1").show();  
                            setTimeout(function(){ $('.alert-success').hide(); }, 1000);  
                            $('.hide'+id).remove();
                        }
    					
                    }
                    
                    
						
                },
            }); 
	    
	});
	$(document).on('click', '.confirm_delete', function () {
	    var id=$('#del_id').val();
	    var table=$('#del_table').val();
	    var action=$('#del_action').val();
        var token=$('input[name="_token"]').val();
		var data ={id:id,_token:token,table:table};
         $.ajax({
          headers: {
              'X-CSRF-Token': $('input[name="_token"]').val()
          },
                type: 'post',
                url: action,
                data: data,
                success: function (data1) {
                    if(table == 'activities')
                    {
                        $(".as1").html("Deleted successfully...");
                        $(".as1").show();  
                        setTimeout(function(){ $('.alert-success').hide(); }, 1000);   
                        $('#delete_modal').modal('hide');
                        window.location.reload();
                       
                    }
                     if(table == 'usermentor')
                    {
                        $(".as1").html("Deleted successfully...");
                        $(".as1").show();  
                        setTimeout(function(){ $('.alert-success').hide(); }, 1000);   
                        $('#delete_modal').modal('hide');
                        window.location.reload();
                       
                    }
                    else
                    {
                        if(table == 'courses')
                        {
                         $(".as1").html("Deleted successfully...");
                          $(".as1").show();  
                          setTimeout(function(){ $('.alert-success').hide(); }, 1000);   
                        }
    					var obj = JSON.parse(data1);
    					$('#delete_modal').modal('hide');
    					$('#bs4-table').DataTable().destroy();
    					$('#getdata').html(obj.data);
    					$('#bs4-table').DataTable();
    					$('.getdata').html(obj.data);
                    }
                    
                    
						
                },
            }); 
	    
	});
	$(document).on('click', '.edit_assign_user', function () {
	     var id=$(this).attr('data-id');
	     var selected=$(this).attr('data-selected');
	    
	     $('#mentor_id').val(id);
	     var data={id:id,selected:selected}
	     var base=$('#base_url').val();
	     var action =base+'/getpremium_users_mentor';
	     $.ajax({
         headers: {
              'X-CSRF-Token': $('input[name="_token"]').val()
          },
                type: 'post',
                url: action,
                data: data,
                success: function (data) {
                  $('.test1').html(data);
	              $('.test1').select2();
                },
	     });
	     
	});
	$(document).on('click', '.assign_user', function () {
	     var id=$(this).attr('data-id');
	     $('#mentor_id').val(id);
	     var base=$('#base_url').val();
	     var action =base+'/getpremium_users';
	     $.ajax({
         headers: {
              'X-CSRF-Token': $('input[name="_token"]').val()
          },
                type: 'post',
                url: action,
                data: '',
                success: function (data) {
                    $('.test').select2();
                },
	     });
	});
	$(document).on('click', '.active_user', function () {
	    var id=$(this).attr('data-id');
	    var table=$(this).attr('data-table');
	    var status=$(this).attr('data-status');
	    var base=$('#base_url').val();
	    var data={'id':id,'table':table,'status':status};
	    var action =base+'/updatestatus';
         $.ajax({
          headers: {
              'X-CSRF-Token': $('input[name="_token"]').val()
          },
                type: 'post',
                url: action,
                data: data,
                success: function (data) {
                    var data = JSON.parse(data);
                    if(data.erro==102)
                    {
                      $(".dg1").html(data.message);
                      $(".dg1").show();
                       setTimeout(function(){ $('.alert-danger').hide(); }, 3000);
                      $('.'+btn).attr('disabled',false);
                      $('.'+btn).html('Save');   
                    }
                    if(data.erro==101)
                    {
                      $(".as1").html(data.message);
                      $(".as1").show();  
                      setTimeout(function(){ $('.alert-success').hide(); }, 2000);
                      if(status ==1){
                      $('#statususer'+id).html("<label class='badge badge-danger active_user' data-id='"+id+"' data-table='"+table+"' data-status='0'>Inactive</label>");
                      }else
                      {
                      $('#statususer'+id).html("<label class='badge badge-success active_user' data-id='"+id+"' data-table='"+table+"' data-status='1'>Active</label>");
                      }
                    } 
                },
         });
	});
    $(document).on('click', '.redo_course', function () {
    var id=$(this).attr('data-id');
    var table=$(this).attr('data-table');
    var title=$(this).attr('data-title');
    var action=$(this).attr('data-action');
    $('#del_id').val(id);
    $('#del_table').val(table);
    $('#del_action').val(action);
    });
    $(document).on('click', '.c_archive', function () {
    var id=$(this).attr('data-id');
    var table=$(this).attr('data-table');
    var title=$(this).attr('data-title');
    var action=$(this).attr('data-action');
    $('#del_id').val(id);
    $('#del_table').val(table);
    $('#del_action').val(action);
    });
	$(document).on('click', '.delete_request', function () {
	    var id=$(this).attr('data-id');
	    var table=$(this).attr('data-table');
	    var title=$(this).attr('data-title');
	    if(table=='users')
	   { 
	       $('.lbl').text('Do you really want to delete this user ? This action cannot be undone.');
	   }else if(table=='mentor')
	   { 
	      $('.lbl').text('Do you really want to delete this mentor ? This action cannot be undone.');  
	   }else if(table=='courses')
	   { 
	      $('.lbl').text('Do you really want to delete this course ? This action cannot be undone.');  
	   }
	    var action=$(this).attr('data-action');
	   $('#del_id').val(id);
	   $('#del_table').val(table);
	   $('#del_action').val(action);
	   
	});
	$(document).on('click', '.edit_mentor_btn', function () {
	   if($('.editmentor').valid())
      {
       $('.edit_mentor_btn').attr('disabled',true);
       $('.edit_mentor_btn').html(' Processing...'); 
        submitform('editmentor','edit_mentor_btn'); 
      } 
	});
	$(document).on('click', '.save_assign_btn', function () {
	 if($('.assignuser').valid())
      {
       $('.save_assign_btn').attr('disabled',true);
       $('.save_assign_btn').html(' Processing...'); 
       submitform('assignuser','save_assign_btn'); 
      }   
	    
	});
	$(document).on('click', '.edit_course_btn', function () {
	   if($('.editcourse').valid())
      {
          $('.edit_course_btn').attr('disabled',true);
          $('.edit_course_btn').html(' Processing...'); 
            if($('.content1').summernote('isEmpty')) {
            $('.description_label').text('This field is required');
            $('.description_label').css('color','red');
            setTimeout(function(){ 
            $('.description_label').text('');
            }, 3000);
          }else
          {
           submitform('editcourse','edit_course_btn'); 
          }
      }      
	});
        $(document).on('click', '.add_course_btn ', function () {
          
        if($('.addcourse').valid())
        {
            $('.add_course_btn').attr('disabled',true);
        $('.add_course_btn').html(' Processing...'); 
         submitform('addcourse','add_course_btn'); 
        /*if($('.content').summernote('isEmpty')) {
        $('.description_label').text('This field is required');
        $('.description_label').css('color','red');
        setTimeout(function(){ 
        $('.description_label').text('');
        $('.add_course_btn').attr('disabled',false);
        $('.add_course_btn').html('Submit');
        }, 3000);
        }
        else {
              $('.add_course_btn').attr('disabled',true);
        $('.add_course_btn').html(' Processing...');   
       
        
        }*/
          
         /*  
          if($('.description').val() == '')
          {
               $('.description_label').text('This field is required');
               $('.description_label').css('color','red');
              setTimeout(function(){ 
                 $('.description_label').text('');
              }, 3000);
             
          }else if($('.description').val() != '' )
          {
           submitform('addcourse','add_course_btn'); 
          }
              */
              
        
       //$('.add_course_btn').attr('disabled',true);
      // $('.add_course_btn').html(' Processing...'); 
      // 
      }  
	});
	 $(document).on('click', '.edit_course_syl', function () {
     if($('.edit_heading').valid())
    {
    $('.edit_course_syl').attr('disabled',true);
    $('.edit_course_syl').html(' Processing...');  
    submitform('edit_heading','edit_course_syl'); 
    }
    });
    $(document).on('click', '.add_course_syl1', function () {
    //alert();
    if($('.addcourse_syllabs_form').valid())
    {
        var data = new FormData('.addcourse_syllabs_form');
        var other_data = $('.addcourse_syllabs_form').serializeArray();
        $.each(other_data,function(key,input){
        data.append(input.name,input.value);
        });
    $('.add_course_syl1').attr('disabled',true);
    $('.add_course_syl1').html(' Processing...');  
    submitform2('addcourse_syllabs_form','add_course_syl1',data,'lesson_form'); 
    
    }
    
    });
	
	$(document).on('click', '.edit_activity_syl ', function () {
	if($('.edit_activity').valid())
    {
    $('.edit_activity_syl').attr('disabled',true);
    $('.edit_activity_syl').html(' Processing...');
    submitform('edit_activity','edit_activity_syl'); 
    }
	});
	$(document).on('click', '.add_activity_syl ', function () {
	if($('.activity_form').valid())
    {
    $('.add_activity_syl').attr('disabled',true);
    $('.add_activity_syl').html(' Processing...');
    submitform('activity_form','add_activity_syl'); 
    }
	});
		$(document).on('click', '.edit_example_syl ', function () {
	 if($('.edit_example').valid())
      {
          $('.edit_example_syl').attr('disabled',true);
        $('.edit_example_syl').html(' Processing...');
          submitform('edit_example','edit_example_syl'); 
      }
	    
	});
	$(document).on('click', '.add_example_syl ', function () {
	 if($('.example_form').valid())
      {
          $('.add_example_syl').attr('disabled',true);
        $('.add_example_syl').html(' Processing...');
          submitform('example_form','add_example_syl'); 
      }
	    
	});
	

	$(document).on('click', '.edit_lesson_syl', function () {
	     if($('.edit_lesson').valid())
      {
        $('.edit_lesson_syl').attr('disabled',true);
        $('.edit_lesson_syl').html(' Processing...');
          
        submitform('edit_lesson','edit_lesson_syl'); 
      }
	    
	    
	    
	});
	$(document).on('click', '.add_act', function () {
	    $('.addadactivity').trigger("reset");
	});
	$(document).on('click', '.add_lesson_syl', function () {
	    if($('.lesson_form').valid())
      {
        $('.add_lesson_syl').attr('disabled',true);
        $('.add_lesson_syl').html(' Processing...');
        var data = new FormData('.addcourse_syllabs_form');
        var other_data = $('.addcourse_syllabs_form').serializeArray();
        $.each(other_data,function(key,input){
        data.append(input.name,input.value);
        });
        //$('.add_course_syl1').attr('disabled',true);
        //$('.add_course_syl1').html(' Processing...');  
        //submitform2('addcourse_syllabs_form','add_course_syl1',data,'lesson_form');   
        submitform('lesson_form','add_lesson_syl'); 
      }
	    
	});
	/*$(document).on('click', '.add_course_syl ', function () {
	      if($('.addcourse_syllabs_form').valid())
      {
           $( '.content2' ).each( function() {
            var editior1= CKEDITOR.replace( this );
              $(this).val(editior1.getData());
        } );
          $( '.content22' ).each( function() {
            var editior1= CKEDITOR.replace( this );
              $(this).val(editior1.getData());
        } );
           $( '.content99' ).each( function() {
          var editior1= CKEDITOR.replace( this );
              $(this).val(editior1.getData());
        });
         $( '.content36' ).each( function() {
          var editior1= CKEDITOR.replace( this );
              $(this).val(editior1.getData());
        });
         $( '.content8' ).each( function() {
          var editior1= CKEDITOR.replace( this );
              $(this).val(editior1.getData());
        });
         $( '.content9' ).each( function() {
          var editior1= CKEDITOR.replace( this );
              $(this).val(editior1.getData());
        });
         $( '.content7' ).each( function() {
          var editior1= CKEDITOR.replace( this );
              $(this).val(editior1.getData());
        });
	    $( ".addcourse_syllabs_form" ).submit();
	    
      }
      
	});*/
	$(document).on('click', '.add_course_overview ', function () {
                $('.add_course_overview').attr('disabled',true);
                $('.add_course_overview').html(' Processing...');
  
                if($('.content1').summernote('isEmpty')) {
               
                $('.overview_label').text('This field is required');
                $('.overview_label').css('color','red');
                setTimeout(function(){ 
                $('.overview_label').text('');
                $('.add_course_overview').attr('disabled',false);
                $('.add_course_overview').html('Submit');  
                }, 3000);
                
                }else 
                {
                $('.add_course_overview').attr('disabled',true);
                $('.add_course_overview').html(' Processing...');
                submitform('addcourse_overview','add_course_overview'); 
                }
	    
	});
	$(document).on('click', '.save_plan', function () {
	    if($('.addplan').valid())
      {
       $('.save_plan').attr('disabled',true);
       $('.save_plan').html(' Processing...'); 
        submitform('addplan','save_plan'); 
      } 
	    
	});
	
		$(document).on('keypress', '.quantity ', function (e) {

     //if the letter is not digit then display error and don't type anything
     if (e.which != 8 && e.which != 0 && (e.which < 48 || e.which > 57)) {
        //display error message
        $("#errmsg").html("Digits Only").show().fadeOut("slow");
               return false;
    }
   });
	
	
	$(document).on('click', '.save_user', function () {
	    if($('.adduser').valid())
      {
       $('.save_user').attr('disabled',true);
       $('.save_user').html(' Processing...'); 
        submitform('adduser','save_user'); 
      }
	    
	});
	$(document).on('click', '.save_profile', function () {
	  if($('.adminprofile').valid())
      {
       $('.save_profile').attr('disabled',true);
       $('.save_profile').html(' Processing...');
      
       if($('#password').val() == '' && $('#cpassword').val()=='' && $('#oldpassword').val()=='')
       {
          
           submitform('adminprofile','save_profile'); 
       }
       else if($('#oldpassword').val()!='' )
       {
           if($('#cpassword').val() == '' && $('#password').val() == ''){
            $(".dg1").show();
            $(".dg1").html("Please enter password and confirm password");
            setTimeout(function(){ $('.alert-danger').hide(); }, 3000);
            $('.save_profile').attr('disabled',false);
            $('.save_profile').html('Save');
           }else if($('#cpassword').val() =='')
           {
              $(".dg1").show();
            $(".dg1").html("Please enter confirm password");
            setTimeout(function(){ $('.alert-danger').hide(); }, 3000);
            $('.save_profile').attr('disabled',false);
            $('.save_profile').html('Save');   
            }else if($('#password').val() != $('#cpassword').val() )
           {
            $(".dg1").show();
            $(".dg1").html("Password and confirm password should be same");
            setTimeout(function(){ $('.alert-danger').hide(); }, 3000);
            $('.save_profile').attr('disabled',false);
            $('.save_profile').html('Save');
           }
           else
           {
               submitform('adminprofile','save_profile'); 
           }
           
       } else if($('#password').val() != ''  && $('#cpassword').val()!=''  && $('#oldpassword').val()!='')
       {
           if($('#password').val() != $('#cpassword').val() )
           {
            $(".dg1").show();
            $(".dg1").html("Password and confirm password should be same");
            setTimeout(function(){ $('.alert-danger').hide(); }, 3000);
            $('.save_profile').attr('disabled',false);
            $('.save_profile').html('Save');
            
           }else if($('#password').val() == $('#cpassword').val() )
           {
            submitform('adminprofile','save_profile'); 
           }
       }
      }
	    
	});
$('.editactivity').validate({
            rules: {
            name:{
            required:true
            },
            },
            messages: {
            name:{
            required: 'Name is Required',
            },
            },
            submitHandler: function(form) {
            }  
});
$('.addadactivity').validate({
            rules: {
            name:{
            required:true
            },
            },
            messages: {
            name:{
            required: 'Name is Required',
            
            },
            },
            submitHandler: function(form) {
            
            
            }  
});
$('.edituser').validate({
   rules: {
       first_name:{
           required:true
       },
        last_name:{
           required:true
       },
       phone:{
           required:true,
            digits:true,
            minlength:10,
            maxlength:15
       },
       username:{
           required:true,
            remote: {
              url: $('#base_url').val()+"/checkusernamewithid",
                    type: "post",
                    data:{_token:$('input[name="_token"]').val(),id:$('#id').val()},
                 }
       },
       package_id:{
           required:true,
          
       },
      email: {
        required: true,
        email: true,
         remote: {
              url: $('#base_url').val()+"/checkemailwithid",
                    type: "post",
                    data:{_token:$('input[name="_token"]').val(),id:$('#id').val()},
                 }
       }, 
             
       },
       messages: {
             email:{
                required: 'Email is Required',
                email: 'Please enter valid email',
                remote:'Email already exists',
            },
            username:{
              remote:'Username already exists',  
            },
            password: {
                required: 'Password is Required',
            }, 
             
       },
       submitHandler: function(form) {
          
          
       }
});
$('.addmentor').validate({
   rules: {
       first_name:{
           required:true
       },
        last_name:{
           required:true
       },
       phone:{
          // required:true,
            digits:true,
            minlength:10,
            maxlength:15
       },
       username:{
           required:true
       },
       
        file:{
           //required:true
       }, 
     
      email: {
        required: true,
        email: true,
         remote: {
              url: $('#base_url').val()+"/checkemailmentor",
                    type: "post",
                    data:{_token:$('input[name="_token"]').val()},
                 }
       }, 
             
       },
       messages: {
             email:{
                required: 'Email is Required',
                email: 'Please enter valid email',
                remote:'Email already exists',
            },
            password: {
                required: 'Password is Required',
            }, 
             phone: {
               // required: 'Phone Number is Required',
            },  first_name: {
                required: 'First Name is Required',
            },  last_name: {
                required: 'Last Name is Required',
            }, 
             
       },
       submitHandler: function(form) {
          
          
       }
});
$('.editmentor').validate({
   rules: {
       first_name:{
           required:true
       },
        last_name:{
           required:true
       },
       phone:{
          // required:true,
            digits:true,
            minlength:10,
            maxlength:15
       },
       
      email: {
        required: true,
        email: true,
         remote: {
              url: $('#base_url').val()+"/checkemailmentorwithid",
                    type: "post",
                    data:{_token:$('input[name="_token"]').val(),id:$('#id').val()},
                 }
       }, 
             
       },
       messages: {
             email:{
                required: 'Email is Required',
                email: 'Please enter valid email',
                remote:'Email already exists',
            },
            password: {
                required: 'Password is Required',
            }, 
             phone: {
                //required: 'Phone Number is Required',
            },  first_name: {
                required: 'First Name is Required',
            },  last_name: {
                required: 'Last Name is Required',
            }, 
             
       },
       submitHandler: function(form) {
       }
});
    $(document).on('keyup', '.search_admin', function () {
    var id=$(this).val();
    var base=$('#base_url').val();
    var action =base+'/get_results';
    var token=$('input[name="_token"]').val();
    var data ={_token:token,id:id};
    $.ajax({
    headers: {
    'X-CSRF-Token': $('input[name="_token"]').val()
    },
    type: 'post',
    url: action,
    data: data,
    success: function (data1) {
        $('.show_results').html(data1);
        
    },
    }); 
	});
	
	$(document).on('click', '.view_notification', function () {
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
        $('.editcourse').validate({
        rules: {
        title:{
        required:true
        },
        },
        messages: {
        title:{
        required: 'Title is Required',
        
        },
        },
        submitHandler: function(form) {
        
        $('textarea[name="description"]').rules('add', {
        required: true,
        messages:
        {
        required: 'Pepe is required'
        }
        });
        
        }
        });
$('.addcourse').validate({
        rules: {
        
        title:{
        required:true
        }
       
        },
        messages: {
        title:{
        required: 'Title is Required',
        
        }
       
        
        },
        submitHandler: function(form) {
        
        $('textarea[name="description"]').rules('add', {
        required: true,
        messages:
        {
        required: 'Pepe is required'
        }
        });
        
        }
        });
$('.editplan').validate({
   rules: {
       plan_name:{
           required:true,
            remote: {
              url: $('#base_url').val()+"/checkplannamewithid",
                    type: "post",
                     data:{_token:$('input[name="_token"]').val(),id:$('#id').val()},
                 }
       },
       price:{
           required:true,
            digits:true,
          
       },
       duration:{
           required:true,
            digits:true,
          
       },
       },
       messages: {
             plan_name:{
                required: 'Plan name is Required',
                remote:'Plan name already exists'
                
            },
            price:{
                 
                  remote:'Username already exists'
            }
       },
       submitHandler: function(form) {
          
          
       }
});
$('.addplan').validate({
   rules: {
       plan_name:{
           required:true,
            remote: {
              url: $('#base_url').val()+"/checkplanname",
                    type: "post",
                    data:{_token:$('input[name="_token"]').val()},
                 }
       },
        file:{
           required:true
       },
       price:{
           required:true,
            digits:true,
          
       },
       duration:{
           required:true,
            digits:true,
          
       },
       },
       messages: {
             plan_name:{
                required: 'Plan name is Required',
                remote:'Plan name already exists'
                
            },
            price:{
                 
                  remote:'Username already exists'
            }
       },
       submitHandler: function(form) {
          
          
       }
});
$('.adduser').validate({
   rules: {
       first_name:{
           required:true
       },
        last_name:{
           required:true
       },
       phone:{
           required:true,
            digits:true,
            minlength:10,
            maxlength:15
       },
       username:{
           required:true,
           remote: {
              url: $('#base_url').val()+"/checkusername",
                    type: "post",
                    data:{_token:$('input[name="_token"]').val()},
                 }
       },
        password:{
           required:true,
           minlength:6,
            maxlength:10
       },
       confirm_password:{
           required:true,
           equalTo: "#password"
       },
        
        file:{
           required:true
       }, 
       package_id:{
           required:true,
          
       },
      email: {
        required: true,
        email: true,
         remote: {
              url: $('#base_url').val()+"/checkemail",
                    type: "post",
                    data:{_token:$('input[name="_token"]').val()},
                 }
       }, 
             
       },
       messages: {
             email:{
                required: 'Email is Required',
                email: 'Please enter valid email',
                remote:'Email already exists',
            },
            password: {
                required: 'Password is Required',
            }, 
             username:{
                 
                  remote:'Username already exists'
             }
       },
       submitHandler: function(form) {
          
          
       }
});
$('.adminprofile').validate({
   rules: {
       first_name:{
           required:true
       },
        last_name:{
           required:true
       },
       phone:{
           required:true,
            digits:true,
            minlength:10,
            maxlength:15
       },
       country:{
           required:true
       },
        city:{
           required:true
       },
       state:{
           required:true
       },
        address:{
           required:true
       }, 
       zip_code:{
           required:true,
           digits:true
       },
      email: {
        required: true,
        email: true
       }, 
             
       },
       messages: {
             email:{
                required: 'Email is Required',
                email: 'Please enter valid email'
            },
            password: {
                required: 'Password is Required',
            }, 
             
       },
       submitHandler: function(form) {
          
          
       }
});
 var totalvfiles = [];
$(document).on('change', '.file_video', function (e) {
    
var fileExtension = ['mp4'];
if ($.inArray($(this).val().split('.').pop().toLowerCase(), fileExtension) == -1) {
    $(".dg1").html('This file type is not supported.');
    $(".dg1").show(); 
    $(this).val("");
    setTimeout(function(){ $('.dg1').hide(); }, 3000);
}else
{

            var random=$(this).attr('data-random');
            totalvfiles.push(random);
            console.log(totalvfiles);
            var fileName = e.target.files[0].name;
            var id=$(this).attr('id');
            $('.file_video'+random).val(fileName);
}
    
});
function submitform(form,btn)
{
  
  if(form == 'lesson_form')
  {
    var data =   new FormData($('.'+form)[0]);
    var other_data = $('.'+form).serializeArray();
    /*$.each(other_data,function(key,input){
    data.append(input.name,input.value);
    });*/
      
  }
  else
  {
    var data = new FormData($('.'+form)[0]);
    //var data = new FormData('.'+form);
    var other_data = $('.'+form).serializeArray();
    /*$.each(other_data,function(key,input){
        data.append(input.name,input.value);
    });*/
  }
   if(form=='lesson_form' || form=='edit_lesson')
   {
    var totalFiles = totalvfiles.length;
    //alert(totalFiles);
    for (var i =0; i <= totalFiles; i++) {
    //alert(file_data = $("#file_video"+i).prop("files"));
    var file_data = $("#file_video"+totalvfiles[i]).prop("files");
    //alert(file_data);
    if(file_data==undefined)
    {
    // alert('un');
    }else
    {
    var file_data1 = $("#file_video"+totalvfiles[i]).prop("files")['length'];   
  //  alert('me');alert(file_data1);
    
    if(file_data1 == '0')
    {
        
    }else
    {
    var file_data2 = $("#file_video"+totalvfiles[i]).prop("files")[0];   
    //print_r(file_data2);
    data.append("file_video[]", file_data2);   
    }
   
    }
    //console.log(file_data);
    }
   }
  
    if(form != 'adminprofile' || form != 'addcourse_syllabs_form' || form != 'lesson_form'|| form != 'addactivityuser' ){
    var totalFiles = document.getElementById("files").files.length;
    for (var i = 0; i < totalFiles; i++) {
    var file_data = $("#files").prop("files")[i];
     data.append("file", file_data);
    }
    }
    
   /* if(form == 'addcourse_syllabs_form')
    {
     $('.file_video').each(function() {   
         var file_data1 = $(this).prop("files")[0];
      
         data.append("video[]", file_data1);    
     });
    }*/
    
    
    
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
                    $(".as1").html(data.message);
                    $(".as1").show();  
                    setTimeout(function(){ $('.alert-success').hide(); }, 3000);
                    $('.'+btn).attr('disabled',false);
                    $('.'+btn).html('Save');   
                    if(form != 'adminprofile' && form != 'assignuser'){ 
                    var next = $('.'+form).attr('data-next');
                    if(next !=''){
                    setTimeout(function(){  window.location.href= next; }, 3000); 
                    }
                    }
                    if(form == 'editactivity')
                    {
                    $('.bd-example-modal-lg').modal('hide');   
                    $(".as1").html(data.message);
                    $(".as1").show(); 
                    $('#actname'+data.id).html(data.name);
                    setTimeout(function(){
                    //window.location.href= data.url;
                    $('.alert-success').hide(); }, 2000);     
                    }
                    if(form == 'addadactivity')
                    {
                    $('.edit-type').modal('hide');   
                    $(".as1").html(data.message);
                    $(".as1").show(); 
                    $('#bs4-table').DataTable().destroy();
    				$('#getdata').html(data.data);
                        $('#bs4-table').DataTable({
                        "ordering": false
                        } );
    				//$('.getdata').html(obj.data);
                    setTimeout(function(){
                    //window.location.href= data.url;
                    $('.alert-success').hide(); }, 2000); 
                    }   
                    
                    if(form == 'example_form')
                    {
                    $(".as1").html(data.message);
                    $(".as1").show();  
                    setTimeout(function(){
                    window.location.href= "javascript:void(0)";
                    $('.alert-success').hide(); }, 2000); 
                    }
                    if(form == 'edit_example')
                    {
                    $(".as1").html(data.message);
                    $(".as1").show();  
                    setTimeout(function(){
                        window.location.href= "javascript:void(0)";
                    $('.alert-success').hide(); }, 2000); 
                    }
                    if(form=='lesson_form')
                    {
                    $(".as1").html(data.message);
                    $(".as1").show();  
                    setTimeout(function(){ $('.alert-success').hide(); }, 1000);
                    $('.headings_lesson_name').html(data.data);
                    $( ".activity_html" ).append(data.html);
                    if(data.update !='')
                    {
                    data.update.forEach(function(data){
                    $('.editlesson'+data.random).html(data.text);
                    $('.editlesson'+data.random).text(data.text);
                    })
                    }
                    $('.tab5ourse').removeClass('disabled');
                    $('.tab5ourse').trigger('click');
                    $('#course_id5').val(data.dataid);   
                    
                    }
                    if(form=='activity_form')
                    {
                     $(".as1").html(data.message);
                     $(".as1").show();  
                     setTimeout(function(){ $('.alert-success').hide(); }, 1000);
                  if(data.data1 != '')
                 {
                 $('.example_html').html(data.data1);
                 $('.exp_add').hide();
                 $('.headings_lesson_activity').attr('disabled','disabled');
                 $('.content22').html("");
                 $('.content22').text("");
                 $('.content22').attr("required",'');
                 $('.content22').attr('disabled','disabled');
                 $('.content23').summernote({
                 height: 150   //set editable area's height  
                 });
                 }
                 if(data.data1 == '')
                 {
                     
                    // $('.content22').code("");  
                      //$('.content22').text("");
                 }
                    if(data.data == '')
                    {
                    $(".as1").hide();  
                    $(".as1").html("");  
                    $(".dg1").html(data.message);
                    $(".dg1").show();  
                    setTimeout(function(){
                    window.location.href= "javascript:void(0)";
                    $('.alert-danger').hide(); }, 2000); 
                    $(".message").show();  
                    setTimeout(function(){
                    $('.message').hide(); $('.message').html(''); }, 2000);  
                    $('.message').css('display','block !important');
                    $('.color_div').hide();
                    $('.add_example_syl ').attr('disabled',true);
                  //  $('.add_activity_syl  ').attr('disabled',true);
                      $('.headings_lesson_activity').attr('disabled','disabled');
                      $('.headings_lesson_activity').hide();
                      $('.lessons').attr('disabled','disabled');
                      $('.lessons').hide();
                      $('.add_new').hide();
                      $('.label_act').hide();
                      
                     }else
                     {
                    $(".message").hide();  
                    setTimeout(function(){
                    $('.message').html(''); }, 2000); 
                    $('.message').html('');
                    $('.message').css('display','none !important');
                    $('.add_example_syl ').attr('disabled',false); 
                    $('.add_activity_syl ').attr('disabled',false); 
                    if(data.examples =='0')
                    {
                       // $('.color_div1').show();
                        $('.color_div').show();
                        $('.rmvs').hide();
                        $('.content22').summernote('reset');
                        $('.content22').summernote('code', '');
                         $('.content36').summernote('reset');
                        $('.content36').summernote('code', '');
                         $('.content36').attr('disabled',true); 
                       // $('.content22').code('');
                        $('.hideit').attr('disabled',true); 
                        $('.hideits').attr('disabled',true); 
                        
                    }else
                    {
                        $('.color_div').show();
                    }
                    $('.headings_lesson_activity').show();
                    $('.lessons').show();
                    $('.headings_lesson_activity').attr('disabled',false);
                    $('.lessons').attr('disabled',false);
                    $('.add_new').show();
                    $('.label_act').show();
                    $('.headings_lesson_activity').html(data.data);
                    $('.lessons').html(data.lessons);
                    $('.tab6course').removeClass('disabled');
                    $('.tab6course').trigger('click');
                     }
                   //  $('.tab6course').removeClass('disabled');
                   //  $('.tab6course').trigger('click');
                     $('#course_id7').val(data.dataid);  
                     $('#course_id6').val(data.dataid);  
                     $( ".example_html" ).append(data.html);
                      if(data.update !='')
                        {
                        data.update.forEach(function(data){
                            $('.editactivity'+data.random).html(data.text);
                             $('.editactivity'+data.random).text(data.text);
                        })
                        }
                         $('.content22').summernote({
                    height: 150  //set editable area's height
                    
                    });
                    }
                    if(form == 'addcourse_syllabs_form')
                    {
                    $('.tab44').removeClass('disabled');
                    $('.tab44').trigger('click');
                    $(".as1").html(data.message);
                    $(".as1").show();  
                    setTimeout(function(){ $('.alert-success').hide(); }, 1000);
                    $('.chosen-select').html(data.data);
                    $('.summernote').summernote({
                    height: 150  //set editable area's height
                    
                    });
                 $('.chosen-select').trigger("chosen:updated");
                     //  $('.my-select').append(data.data);
                     //  $('.my-select').selectpicker('refresh');
                    $('#course_id3').val(data.dataid);
                    }   
                    if(form=='assignuser')
                    {
                    $('#assign_user').modal('hide');
                    $('#update_assign_user').modal('hide');
                    var next = $('.'+form).attr('data-next');
                    setTimeout(function(){  window.location.href= next; }, 3000); 
                    }
                    if(form == 'addplan')
                    {
                    $(".as1").html(data.message);
                    $(".as1").show();  
                    setTimeout(function(){ $('.alert-success').hide(); }, 3000);
                    $('.'+btn).attr('disabled',false);
                    $('.'+btn).html('Save');   
                    var next = $('.'+form).attr('data-next');
                    setTimeout(function(){  window.location.href= next; }, 3000); 
                    }
                    if(form == 'addcourse_overview')
                    {
                    $('#course_id').val(data.dataid);
                    $('#course_id1').val(data.dataid);
                    $('#course_id2').val(data.dataid);
                    $('.tab3course').removeClass('disabled');
                    $('.tab3course').trigger('click');
                    }
                    if(form=='adminprofile')
                    {
                    $('#first').text(data.first_name);
                    $('.admin_name').text(data.first_name);
                    $('#email_edit').text(data.email);
                    }
                    if(form=='edit_heading')
                    {
                    $(".as1").html(data.message);
                    $(".as1").show();  
                    setTimeout(function(){ $('.alert-success').hide(); }, 3000);
                    $('.headings_lesson ').html(data.data);
                     $( ".learn_html" ).append(data.html);
                       if(data.update !='')
                        {
                        data.update.forEach(function(data){
                            $('.edit'+data.random).html(data.text);
                             $('.editlesson'+data.random).text(data.text);
                        })
                        }
                        $('.summernote').summernote();
                    }
                    if(form=='edit_lesson')
                    {
                    $(".as1").html(data.message);
                    $(".as1").show();  
                    setTimeout(function(){ $('.alert-success').hide(); }, 3000);
                    $('.headings_lesson_name').html(data.data);
                    }
                    if(form=='edit_activity')
                    {
                    $(".as1").hide();  
                    $(".as1").html("");  
                    $(".dg1").html(data.message);
                    setTimeout(function(){
                    window.location.href= "javascript:void(0)";
                    $('.alert-danger').hide(); }, 2000); 
                    $(".dg1").show();  
                    $('.headings_lesson_activity').html(data.data);
                    $('#course_id7').val(data.dataid);  
                    $('#course_id6').val(data.dataid);  
                    $( ".example_html" ).append(data.html);
                    if(data.update !='')
                    {
                    data.update.forEach(function(data){
                    $('.editactivity'+data.random).html(data.text);
                    $('.editactivity'+data.random).text(data.text);
                    })
                    }
                    if(data.data == '')
                    {
                    if(data.examples =='0')
                    {
                    // $('.color_div1').show();
                    $('.color_div').show();
                    $('.rmvs').hide();
                    $('.content22').summernote('reset');
                    $('.content22').summernote('code', '');
                    $('.content36').summernote('reset');
                    $('.content36').summernote('code', '');
                    $('.content36').attr('disabled',true); 
                    // $('.content22').code('');
                    $('.hideit').attr('disabled',true); 
                    $('.hideits').attr('disabled',true); 
                    }else
                    {
                    $('.color_div').show();
                    }
                      $('.headings_lesson_activity').hide();
                      $('.add_new').hide();
                      $('.label_act').hide();
                      $('.color_div').hide();
                      $('.edit_example_syl').attr('disabled',true);
                       $('.lessons').attr('disabled','disabled');
                      $('.lessons').hide();
                      $('.add_new').hide();
                      $('.label_act').hide();
                     }else
                     {
                          if(data.examples =='0')
                    {
                    // $('.color_div1').show();
                    $('.color_div').show();
                    $('.rmvs').hide();
                    $('.content22').summernote('reset');
                    $('.content22').summernote('code', '');
                    $('.content36').summernote('reset');
                    $('.content36').summernote('code', '');
                    $('.content36').attr('disabled',true); 
                    // $('.content22').code('');
                    $('.hideit').attr('disabled',true); 
                    $('.hideits').attr('disabled',true); 
                    }else
                    {
                    $('.color_div').show();
                    }
                     $('#example123').val(data.examples)
                     $('.edit_example_syl').attr('disabled',false);
                     $('.headings_lesson_activity').show();
                     $('.add_new').show();
                     $('.label_act').show();
                     $('.headings_lesson_activity').html(data.data);
                     }
                    $('.content22').summernote({
                    height: 150  //set editable area's height
                    
                    });
                    }
                    if(form == 'addcourse')
                    {
                    $('#course_id').val(data.dataid);
                    $('#course_id1').val(data.dataid);
                    $('.tab2course').removeClass('disabled');
                    $('.tab2course').trigger('click');
                    }
                    }
                    },
                    }); 
                    }


$(document).on('click', '.edit_adact', function () {
    var id=$(this).attr('data-id');
    var name=$('#actname'+id).html();
    $('#editname').val(name);
    $('#id').val(id);
   // alert(id);
    
    
});

$(document).on('click', '.choose_category ', function () {
	   
	
        var id=$('.select_cat').val();
    
        if(id !="")
        {
            $('#myModal_cat').modal('hide');
            $('#type').val(id);
            $(".as1").html("Saved successfully...");
            $(".as1").show();  
            setTimeout(function(){ $('.alert-success').hide(); }, 1000);   
            
            
        }else
        {
            $(".dg1").html("Please select category type");
            $(".dg1").show();  
            setTimeout(function(){ $('.alert-danger').hide(); }, 1000);
            
        }
    
	    
	});


$(document).on('change', '.country', function () {
	    var id=$(this).val();
	    var token=$('input[name="_token"]').val();
		var data ={id:id,_token:token};
        var action =$('#base_url').val()+'/getstates';
       
         $.ajax({
          headers: {
              'X-CSRF-Token': $('input[name="_token"]').val()
          },
                type: 'post',
                url: action,
                data: data,
               
                success: function (data) {
                 $('.city').attr('disabled',false);
                 $('.city').html(data);
                },
            }); 
	});
})	
})(jQuery);

function submitform2(form,btn,data,from2='')
{
    if($('.'+from2).valid())
    {
      
    }
   var action = $('.'+form).attr('data-action');
         $.ajax({
          headers: {
              'X-CSRF-Token': $('input[name="_token"]').val()
          }, type: 'post',
                url: action,
                data: data,
                contentType: false,
                cache: false,
                processData:false,
                dataType:'json',
                success: function (data) {
                    if(data.erro==202)
                    {
                        $('.'+btn).attr('disabled',false);
                        $('.'+btn).html('Submit');
                        $(".dg1").html(data.message);
                        $(".dg1").show();  
                        setTimeout(function(){
                        $('.dg1').hide(); }, 2000);
                    } 
                    if(data.erro==101)
                    {
                        $('.'+btn).attr('disabled',false);
                        $('.'+btn).html('Submit');
                        $( ".lesson_html" ).append(data.html);
                        // $('.lesson_form').html(data.html);
                        $(".as1").html(data.message);
                        $(".as1").show();  
                        $('.summernote').summernote({
                        height: 150  //set editable area's height
                        });
                        setTimeout(function(){
                        $('.alert-success').hide(); }, 2000);
                        if(data.update !='')
                        {
                        data.update.forEach(function(data){
                            $('.edit'+data.random).html(data.text);
                            $('.edit'+data.random).text(data.text);
                        })
                        }

                        if(form=='addcourse_syllabs_form')
                        {   $('.headings_lesson').html(data.data);
                        $('.tab4course').removeClass('disabled');
                        $('.tab4course').trigger('click');
                        $('#course_id3').val(data.course_id);
                        
                        }
                    }
                },
                });
}

function readURL(input) {
  if (input.files && input.files[0]) {
    var reader = new FileReader();

    reader.onload = function(e) {
      $('#blah').attr('src', e.target.result);
      $('.upsave').hide();
      $('#blah').show();
    }

    reader.readAsDataURL(input.files[0]);
  }
}





$(".fileupload").change(function() {
var fileExtension = ['jpeg', 'jpg', 'png', 'gif'];
if ($.inArray($(this).val().split('.').pop().toLowerCase(), fileExtension) == -1) {
    $(".dg1").html('This file type is not supported.');
    $(".dg1").show(); 
    $(this).val("");
    setTimeout(function(){ $('.dg1').hide(); }, 3000);
     $('.upsave').show();
      $('#blah').hide();

}else
{
   readURL(this); 
}
});
