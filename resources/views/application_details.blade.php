@include('layouts/header')

<style>
.prof-sec
{
display:none;
}
.subs-box
{
display:none;
}
</style>
	
    <div class="course-details-area default-padding">
        <div class="container">
            <div class="row">
				<div class="col-sm-12 application-sec">
                    <h3>Application Details
					<a href="{{ url('dynamic_pdf/pdf') }}/{{$act[0]->course_id}}" target="blank" class="btn btn-warning btn-back"><i class="fas fa-download"></i> <span class="d-sm-none">Download</span> </a>
					</h3>
                </div>
                <div class="col-sm-12">
                    <div class="course-details-info">
                       	<div class="tab-area-self">
							<div class="info title m-t-0">
									<!-- Start Course List -->
									<div class="course-list-items acd-items acd-arrow">
										<div class="panel-group symb" id="accordion">
												    <?php $i=1;?>
												    @foreach($act as $a)
													<div class="panel panel-default">
														<div class="panel-heading" role="tab" id="headingOne">
															<h4 class="panel-title">
																<a data-toggle="collapse" data-parent="#accordion" href="#ac{{$a->id}}" aria-expanded="false" aria-controls="collapseOne">
																	Activity {{$i++}}
																</a>
															</h4>
															
														</div>
														<div id="ac{{$a->id}}" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingOne">
															<div class="panel-body">
																<div class="dtls-actv">
																    	<div class="actv-ss"><h5>Activity Title</h5>
																	   <?=$a->activity_title;?>
																	</div>
																	<div class="actv-ss"><h5>Description</h5>
																	   <?=$a->user_input;?>
																	</div>
																	
																	<div class="actv-ss"><h5>Participation grade levels     </h5>
																	   <?=$a->participation_grade;?>
																	</div>
																	<div class="actv-ss"><h5>Hour spent per week    </h5>
																	   <?=$a->hour_week;?>
																	</div>
																	<div class="actv-ss"><h5>Weeks spend per year       </h5>
																	   <?=$a->week_year;?>
																	</div>
																</div>
															</div>
														</div>
													</div>
													@endforeach
												</div>
											</div>
											<!-- End Course List -->
								</div>
						</div>
                    </div>
                </div>
             
            </div>
        </div>
    </div>
    <!-- End Course Details -->
 <section class="subs-sec">
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                    <div class="subs-box">
                        <div class="text-center">
                            <span class="main-txt-icn refresh-icon">
                                <i class="fas fa-cloud-upload-alt"></i>
                            </span>
                            <h4 class=""><b>4</b> days left this month.</h4>
							<p id="demo" class="timer"></p>
                            <p>Your trial will expire in 4 days. Click below to upgrade to standard subscription <br> so that you can keep learning on this platform.</p>
                            <div class="row">
                                  <div class="col-sm-12">
                                        <a href="pricing.html" class="btn btn-resume btn-upgrade">Upgrade</a>
                                  </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

@include('layouts/footer')

<script>
 	$('.panel-title a:first').attr('aria-expanded',true);
   	$('.panel-collapse:first').addClass('in');
   	
   	$(document).on('click', '.download_pdf', function () {
    $dompdf->loadHtml('<h1>Welcome to CodexWorld.com</h1>');
    $dompdf->setPaper('A4', 'landscape');
    $dompdf->render();
    $dompdf->stream("codexworld",array("Attachment"=>1));
   	});
   	</script>