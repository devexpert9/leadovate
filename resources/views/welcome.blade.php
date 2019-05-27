@include('layouts/header')
 
    <section class="application-sec" id="applications">
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                    
                    <div class="alert alert-danger alert-dismissible" role="alert">
                      <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                      <strong>Trial Notification.</strong>  Your trial has expired. Please upgrade to the standard subscription so that you can keep learning. Upgrade to standard subscription? Yes.
                    </div>
                </div>
                
                <div class="col-sm-12">
                    <h3>My Applications</h3>
                </div>

                  <div class="col-sm-6 col-md-4">
                    <div class="card">
                        <div class="card-img">
                           <a href="application-details.html">
							<img class="card-img-top" src="{{url('/')}}/resources/assets/img/card-icon.png" alt="Card image cap">
							</a>
                        </div>

                          <div class="card-body courses-body">
                            <h5 class="card-title">Activity List</h5>
                            <p class="card-text">Make the most of your extra curiculars by organizing them.</p>
                            <!-- <a class="progress-circle half-circle" href="#">25%</a> -->
                            
                                <a class="btn btn-resume btn-dwld" href="#"><i class="fa fa-download"></i>Download</a>
                            
                        </div>
                    </div>
                  </div>

                  <div class="col-sm-6 col-md-4">
                    <div class="card card-80">
                        <div class="card-img">
                            <a href="application-details.html">
								<img class="card-img-top" src="{{url('/')}}/resources/assets/img/card-icon.png" alt="Card image cap">
							</a>
                        </div>

                          <div class="card-body courses-body">
                            <h5 class="card-title">College List</h5>
                            <p class="card-text">Make the most of your extra curiculars by organizing them.</p>
                            <!-- <a class="progress-circle half-circle" href="#">25%</a> -->
                            
                                <a class="btn btn-resume btn-dwld" href="#"><i class="fa fa-download"></i>Download</a>
                            
                        </div>
                    </div>
                  </div>

                  <div class="col-sm-6 col-md-4">
                    <div class="card card-60">
                        <div class="card-img">
                            <a href="application-details.html">
								<img class="card-img-top" src="{{url('/')}}/resources/assets/img/essay.png" alt="Card image cap">
							</a>
                        </div>

                          <div class="card-body courses-body">
                            <h5 class="card-title">Intro to Writing Essays</h5>
                            <p class="card-text">Make the most of your extra curiculars by organizing them.</p>
                            <!-- <a class="progress-circle half-circle" href="#">25%</a> -->
                            
                                <a class="btn btn-resume btn-dwld" href="#"><i class="fa fa-download"></i>Download</a>
                            
                        </div>
                    </div>
                  </div>                  
            </div>

            <div class="row">
                <div class="col-sm-12 text-center">
                     <a class="btn btn-resume btn-see" href="{{url('/')}}/all-applications">See All</a>
                </div>
            </div>           
        </div>

    </section>
	
	<section class="application-sec courses-sec  mt-0 pb-0" id="courses">
        <div class="container">
            <div class="row">
               
                
                <div class="col-sm-12">
                    <h3>Active Courses</h3>
                </div>

                <div class="col-sm-6 col-md-4">
                  <div class="card card-80">
                    <div class="card-img">
                        <a href="{{url('course-details')}}">
							<img class="card-img-top" src="{{url('/')}}/resources/assets/img/card-icon.png" alt="Card image cap">
						</a>
                    </div>

                      <div class="card-body courses-body">
						<a href="{{url('course-details')}}">
						<h5 class="card-title">
							 Filling out the Activity List 
						</h5>
						</a>
                        <p class="card-text">Make the most of your extra curiculars by organizing them.</p>
                        <!-- <a class="progress-circle half-circle" href="#">25%</a> -->
                        <a class="btn btn-resume" href="{{url('/')}}/course-details">Resume</a>
                      </div>
                    </div>
                </div>
  
                  <div class="col-sm-6 col-md-4">
                    <div class="card card-60">
                    <div class="card-img">
                         <a href="{{url('course-details')}}">
							<img class="card-img-top" src="{{url('/')}}/resources/assets/img/card-icon.png" alt="Card image cap">
						</a>
                    </div>

                      <div class="card-body courses-body">
						<a href="{{url('course-details')}}">
							<h5 class="card-title">Intro to Writing Personal Essays</h5>
						</a>
                        <p class="card-text">Make the most of your extra curiculars by organizing them.</p>
                        <!-- <a class="progress-circle half-circle" href="#">25%</a> -->
                        <a class="btn btn-resume" href="{{url('/')}}/course-details">Resume</a>
                      </div>
                    </div>
                  </div>

                  <div class="col-sm-6 col-md-4">
                    <div class="card card-40">
                    <div class="card-img">
                         <a href="{{url('course-details')}}">
							<img class="card-img-top" src="{{url('/')}}/resources/assets/img/interview.png" alt="Card image cap">
						</a>
                    </div>

                      <div class="card-body courses-body">
						<a href="{{url('course-details')}}">	
							<h5 class="card-title">Interview Preparation</h5>
						</a>
                        <p class="card-text">Make the most of your extra curiculars by organizing them.</p>
                        <!-- <a class="progress-circle half-circle" href="#">25%</a> -->
                        <a class="btn btn-resume" href="{{url('/')}}/course-details">Resume</a>
                      </div>
                    </div>
                  </div>

                  <div class="col-sm-6 col-md-4">
                    <div class="card card-40">
                    <div class="card-img">
                         <a href="{{url('course-details')}}">
							<img class="card-img-top" src="{{url('/')}}/resources/assets/img/construct.png" alt="Card image cap">
						</a>
                    </div>

                      <div class="card-body courses-body">
						<a href="{{url('course-details')}}">	
							<h5 class="card-title">Construct a Compelling App</h5>
						</a>
                        <p class="card-text">Make the most of your extra curiculars by organizing them.</p>
                        <!-- <a class="progress-circle half-circle" href="#">25%</a> -->
                        <a class="btn btn-resume" href="{{url('/')}}/course-details">Resume</a>
                      </div>
                    </div>
                  </div>

                  <div class="col-sm-6 col-md-4">
                    <div class="card card-80">
                    <div class="card-img">
                         <a href="{{url('course-details')}}">
							<img class="card-img-top" src="{{url('/')}}/resources/assets/img/discipline.png" alt="Card image cap">
						</a>
                    </div>

                      <div class="card-body courses-body">
						<a href="{{url('course-details')}}">	
							<h5 class="card-title">Disciplinary History Cases</h5>
						</a>
                        <p class="card-text">Make the most of your extra curiculars by organizing them.</p>
                        <!-- <a class="progress-circle half-circle" href="#">25%</a> -->
                        <a class="btn btn-resume" href="{{url('/')}}/course-details">Resume</a>
                      </div>
                    </div>
                  </div>

                  <div class="col-sm-6 col-md-4">
                    <div class="card card-60">
                    <div class="card-img">
						 <a href="{{url('course-details')}}">
							<img class="card-img-top" src="{{url('/')}}/resources/assets/img/common-app.png" alt="Card image cap">
						</a>
                    </div>

                      <div class="card-body courses-body">
						<a href="{{url('course-details')}}">	
							<h5 class="card-title">Common App Strategy</h5>
						</a>
                        <p class="card-text">Make the most of your extra curiculars by organizing them.</p>
                        <!-- <a class="progress-circle half-circle" href="#">25%</a> -->
                        <a class="btn btn-resume" href="{{url('/')}}/course-details">Resume</a>
                      </div>
                    </div>
                  </div>

            
               
            </div>
        </div>
    </section>

    <section class="application-sec courses-sec">
        <div class="container">
            <div class="row">
               
                <div class="col-sm-12">
                    <h3>Completed Courses</h3>
                </div>

                <div class="col-sm-6 col-md-4">
                  <div class="card">
                    <div class="card-img">
                         <a href="{{url('course-details')}}">
							<img class="card-img-top" src="{{url('/')}}/resources/assets/img/how-read.png" alt="Card image cap">
						</a>
                    </div>

                      <div class="card-body courses-body">
						<a href="{{url('course-details')}}">	
							<h5 class="card-title">How Your App is Read</h5>
						</a>
                        <p class="card-text">Make the most of your extra curiculars by organizing them.</p>
                        <!-- <a class="progress-circle" href="#">100%</a> -->
                        <a class="btn btn-resume" href="{{url('/')}}/course-details">Redo</a>
                      </div>
                    </div>
                </div>
  
                  <div class="col-sm-6 col-md-4">
                    <div class="card">
                    <div class="card-img">
                         <a href="{{url('course-details')}}">
							<img class="card-img-top" src="{{url('/')}}/resources/assets/img/card-icon.png" alt="Card image cap">
						</a>
                    </div>

                      <div class="card-body courses-body">
						<a href="{{url('course-details')}}">	
							<h5 class="card-title">Writing the College Essay</h5>
						</a>
                        <p class="card-text">Make the most of your extra curiculars by organizing them.</p>
                        <!-- <a class="progress-circle" href="#">100%</a> -->
                        <a class="btn btn-resume" href="{{url('/')}}/course-details">Redo</a>
                      </div>
                    </div>
                  </div>

                  <div class="col-sm-6 col-md-4">
                    <div class="card">
                    <div class="card-img">
                         <a href="{{url('course-details')}}">
							<img class="card-img-top" src="{{url('/')}}/resources/assets/img/financial.png" alt="Card image cap">
						</a>
                    </div>

                      <div class="card-body courses-body">
						<a href="{{url('course-details')}}">	
							<h5 class="card-title">Procuring Financial Aid</h5>
						</a>
                        <p class="card-text">Make the most of your extra curiculars by organizing them.</p>
                        <!-- <a class="progress-circle" href="#">100%</a> -->
                        <a class="btn btn-resume" href="{{url('/')}}/course-details">Redo</a>
                      </div>
                    </div>
                  </div>

                  <div class="col-sm-6 col-md-4">
                    <div class="card">
                    <div class="card-img">
                         <a href="{{url('course-details')}}">
							<img class="card-img-top" src="{{url('/')}}/resources/assets/img/essay.png" alt="Card image cap">
						</a>
                    </div>

                      <div class="card-body courses-body">
						<a href="{{url('course-details')}}">	
							<h5 class="card-title">Persuasive Short Essays</h5>
						</a>
                        <p class="card-text">Make the most of your extra curiculars by organizing them.</p>
                        <!-- <a class="progress-circle" href="#">100%</a> -->
                        <a class="btn btn-resume" href="{{url('/')}}/course-details">Redo</a>
                      </div>
                    </div>
                  </div>

                  <div class="col-sm-6 col-md-4">
                    <div class="card">
                    <div class="card-img">
                         <a href="{{url('course-details')}}">
							<img class="card-img-top" src="{{url('/')}}/resources/assets/img/common-app.png" alt="Card image cap">
						</a>
                    </div>

                      <div class="card-body courses-body">
						<a href="{{url('course-details')}}">	
							<h5 class="card-title">Common App Strategy</h5>
						</a>
                        <p class="card-text">Make the most of your extra curiculars by organizing them.</p>
                        <!-- <a class="progress-circle" href="#">100%</a> -->
                        <a class="btn btn-resume" href="{{url('/')}}/course-details">Redo</a>
                      </div>
                    </div>
                  </div>

                  <div class="col-sm-6 col-md-4">
                    <div class="card">
                    <div class="card-img">
						 <a href="{{url('course-details')}}">
							<img class="card-img-top" src="{{url('/')}}/resources/assets/img/card-icon.png" alt="Card image cap">
						</a>
                    </div>

                      <div class="card-body courses-body">
						<a href="{{url('course-details')}}">	
							<h5 class="card-title">Writing the Personal Essay</h5>
						</a>
                        <p class="card-text">Make the most of your extra curiculars by organizing them.</p>
                        <!-- <a class="progress-circle" href="#">100%</a> -->
                        <a class="btn btn-resume" href="{{url('/')}}/course-details">Redo</a>
                      </div>
                    </div>
                  </div>

             
                  </div>

               
            </div>
        </div>
    </section>
	
    <section class="subs-sec">
        <div class="container">
            <div class="row">
                <!-- <div class="col-sm-12">
                    <h3 class="mt-50">Premium Subscription </h3>
                </div> -->

                <div class="col-sm-12">
                    <div class="subs-box">
                        <!-- <p>4 hours left this month.</p> -->
                        <div class="text-center">
                            <span class="main-txt-icn refresh-icon">
                                <!-- <img src="assets/img/trophy.png"> -->
                                <i class="fas fa-cloud-upload-alt"></i>
                            </span>
                            <h4 class=""><b>4</b> days left this month.</h4>
							<p id="demo" class="timer"></p>
                            <p>Your trial will expire in 4 days. Click below to upgrade to standard subscription <br> so that you can keep learning on this platform.</p>
                            <div class="row">
                                <!-- <div class="col-sm-7 col-sm-offset-2">
                                    <div class="progress">
                                         <div class="progress-bar progress-bar-danger progress-bar-striped active" role="progressbar"
                                          aria-valuenow="90" aria-valuemin="0" aria-valuemax="100" style="width:90%">
                                          </div>

                                    </div>
                                      <p class="main-under-cls text-center"></p>
                                  </div>

                                  <div class="col-sm-1">
                                    <span class="main-txt-icn refresh-icon">
                                        
                                        <i class="fas fa-sync-alt"></i>
                                    </span>
                                  </div> -->

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
   
@include('layouts/footer')
  