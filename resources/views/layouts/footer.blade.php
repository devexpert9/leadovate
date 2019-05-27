 <?php
    $options = App\Options::getoption();
    $fb_link=''; $tweet_link='';  $pinterest_link=''; $insta_link=''; $google_link=''; 
?>
@if(!empty($options))
 <?php 
 
  foreach($options as $option)
  {
      
      if($option->coulmn_name == 'fb_link')
      {
         $fb_link= $option->coulmn_value; 
      }
      if($option->coulmn_name == 'tweet_link')
      {
         $tweet_link= $option->coulmn_value; 
      }
      if($option->coulmn_name == 'pinterest_link')
      {
         $pinterest_link = $option->coulmn_value; 
      }
      if($option->coulmn_name == 'insta_link')
      {
         $insta_link = $option->coulmn_value; 
      }
      if($option->coulmn_name == 'google_link')
      {
         $google_link= $option->coulmn_value; 
      }
      
  }
  
 ?>

@endif
<section class="subs-sec     @if(Session()->exists('admin')) hide @endif">
        <div class="container">
            <div class="row">
                <!-- <div class="col-sm-12">
                    <h3 class="mt-50">Premium Subscription </h3>
                </div> -->
<?php if(Session()->exists('user')){
$user=App\User::where('id',Session::get('userid'))->first();
}else
{
$user=array();
}?>
                <div class="col-sm-12">
                    <div class="subs-box">
                        <!-- <p>4 hours left this month.</p> -->
                        <div class="text-center">
                          
                            <?php if(!empty($user)){
                            if(!empty($user->package_id)){
                             $package=App\Subscription::getwithid($user->package_id);
                             $current_package=App\Transaction::get_active_payment_details($user->id);?>
                              <span class="main-txt-icn refresh-icon">
                                <!-- <img src="assets/img/trophy.png"> -->
                                <i class="fas fa-cloud-upload-alt"></i>
                            </span>
                            
                            <?php
                           
                            //$date09=date('Y-m-d',$current_package->end_date);
                            //Convert to date
                            $datestr=$current_package->end_date;//Your date
                            $date=strtotime($datestr);//Converted to a PHP date (a second count)
                            
                            //Calculate difference
                            $diff=$date-time();//time returns current time in seconds
                            $days=floor($diff/(60*60*24));//seconds/minute*minutes/hour*hours/day)
                            $hours=round(($diff-$days*60*60*24)/(60*60));
                            ?>
                            <?php if(date('Y-m-d') >=$current_package->end_date){ ?>
                            <h4 class="">Plan expired</h4>
                            <p>Your trial is expired. Click below to upgrade subscription <br> so that you can keep learning on this platform.</p>
                            <?php }else{ ?>
                            <h4 class="">{{$package->plan_name}} Activated<br/><b><h5><?=$days;?>days  <?=$hours;?>hours   left.</h4>
                            <!--p id="demo" class="timer"></p-->
                            <!--span class="getid"><?=$date;?></span-->
                            <span class="main-txt-icn refresh-icon price-pls">
								${{$package->price}}
								</span>
                            <p>Your trial will expire in <?=$days;?> days. Click below to upgrade to standard subscription <br> so that you can keep learning on this platform.</p>
                            <?php } ?>
                            <?php }else{  echo'<h4 class="">Free Trail Activated</h4>';?>
                            <p> Click below to upgrade to subscription packages <br> so that you can keep learning on this platform.</p>
                            <?php }} ?>
							
                              <div class="row">
                                  <div class="col-sm-12">
                                        <!-- <p><b>Your trial will expire in 4 days. Click below to upgrade to standard subscription <br> so that you can keep learning on this platform.</b> </p> -->
                                        <a href="{{url('/')}}/pricing" class="btn btn-resume btn-upgrade">Upgrade</a>
                                  </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
  <!-- Start Footer 
    ============================================= -->
    <footer class="bg-dark default-padding-top text-light">
        <div class="container">
            <div class="row">
                <img src="{{url('/')}}/resources/assets/img/logo-new.png" class="logo-footer" alt="Logo">
                <ul class="main-footer">
                    <?php if($fb_link){ ?>
                    <li>
                      <a href="<?php echo $fb_link; ?>">
                        <i class="fab fa-facebook-f"></i>
                      </a>
                    </li>
                    <?php } ?>
                    <?php if($tweet_link){ ?>
                    <li>
                      <a href="<?php echo $tweet_link; ?>">
                        <i class="fab fa-twitter"></i>
                      </a>
                    </li>
                    <?php } ?>
                    <?php if($google_link){ ?>
                    <li>
                      <a href="<?php echo $google_link; ?>">
                        <i class="fab fa-google-plus-g"></i>
                      </a>
                    </li>
                    <?php } ?>
                    <?php if($insta_link){ ?>
                    <li>
                      <a href="<?php echo $insta_link; ?>">
                        <i class="fab fa-instagram"></i>
                      </a>
                    </li>
                    <?php } ?>
                    <?php if($pinterest_link){ ?>
                    <li>
                      <a href="<?php echo $pinterest_link; ?>">
                        <i class="fab fa-pinterest-p"></i>
                      </a>
                    </li>
                    <?php } ?>
                </ul>
            </div>
        </div>
        <!-- Start Footer Bottom -->
        <div class="footer-bottom">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
					
                        <div class="col-md-6">
                            <p> Copyright &copy; 2019. All  Rights Reserved</p>
                        </div>
                        <div class="col-md-6 text-right link">
                            <ul>
                               <li>
                                    <a href="{{url('/privacy-policy')}}">Privacy Policy</a>
                                </li>
                                <li>
                                    <a href="{{url('/terms-conditions')}}">Terms & Conditions</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- End Footer Bottom -->
    </footer>
    <!-- End Footer -->

    <!-- jQuery Frameworks
    ============================================= -->
    <script src="{{url('/')}}/resources/assets/js/jquery-1.12.4.min.js"></script>
    <script src="{{url('/')}}/resources/assets/js/bootstrap.min.js"></script>
    <script src="{{url('/')}}/resources/assets/js/equal-height.min.js"></script>
    <script src="{{url('/')}}/resources/assets/js/jquery.appear.js"></script>
    <script src="{{url('/')}}/resources/assets/js/jquery.easing.min.js"></script>
    <script src="{{url('/')}}/resources/assets/js/jquery.magnific-popup.min.js"></script>
    <script src="{{url('/')}}/resources/assets/js/modernizr.custom.13711.js"></script>
    
    <script src="{{url('/')}}/resources/assets/js/owl.carousel.min.js"></script>
    <script src="{{url('/')}}/resources/assets/js/wow.min.js"></script>
     <script src="{{url('/')}}/resources/assets/js/validate.js"></script>
    <script src="{{url('/')}}/resources/assets/js/isotope.pkgd.min.js"></script>
    <script src="{{url('/')}}/resources/assets/js/imagesloaded.pkgd.min.js"></script>
    <script src="{{url('/')}}/resources/assets/js/count-to.js"></script>
    <script src="{{url('/')}}/resources/assets/js/bootsnav.js"></script>
    <script src="{{url('/')}}/resources/assets/js/main.js"></script>
	<script src="{{url('/')}}/resources/assets/js/jquery.mCustomScrollbar.concat.min.js"></script>
	<script src="{{url('/')}}/resources/assets/js/lity.js"></script>
	<script src="{{url('/')}}/resources/admin_assets/js/custom.js" type="text/javascript"></script>
	<script>
		$(document).ready(function(){
		  // Add smooth scrolling to all links
		  /*$("a").on('click', function(event) {

			// Make sure this.hash has a value before overriding default behavior
			if (this.hash !== "") {
			  // Prevent default anchor click behavior
			  event.preventDefault();

			  // Store hash
			  var hash = this.hash;

			  // Using jQuery's animate() method to add smooth page scroll
			  // The optional number (800) specifies the number of milliseconds it takes to scroll to the specified area
			  $('html, body').animate({
				scrollTop: $(hash).offset().top
			  }, 800, function(){
		   
				// Add hash (#) to URL when done scrolling (default click behavior)
				window.location.hash = hash;
			  });
			} // End if
		  });*/
		});
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


</script>
</body>
</html>


