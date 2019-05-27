 
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
    <script src="{{url('/resources/assets/js/validate.js')}}"></script>
    <script src="{{url('/')}}/resources/assets/js/isotope.pkgd.min.js"></script>
    <script src="{{url('/')}}/resources/assets/js/imagesloaded.pkgd.min.js"></script>
    <script src="{{url('/')}}/resources/assets/js/count-to.js"></script>
    <script src="{{url('/')}}/resources/assets/js/bootsnav.js"></script>
    <script src="{{url('/')}}/resources/assets/js/main.js"></script>

</body>

</html>