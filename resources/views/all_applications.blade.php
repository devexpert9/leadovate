@include('layouts/header')
    <section class="application-sec">
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                    <h3>My Applications</h3>
                </div>
                  @foreach($act as $a)
                  <div class="col-sm-6 col-md-4">
                    <div class="card card-80">
                        <div class="card-img">
                            <a href="{{url('/')}}/application-details/{{$a->lesson_id}}">
                                  @if(empty($a->image))
							<img class="card-img-top" src="{{url('/')}}/resources/assets/img/card-icon.png" alt="Card image cap">
							@else
							<img class="card-img-top" src="{{url('/')}}/public/uploads/{{$a->image}}" alt="Card image cap">
							@endif
							</a>
                          </div>
                          <div class="card-body courses-body">
							<a href="application-details.html">	
								<h5 class="card-title">{{$a->name}}</h5>
							</a>
                            <p class="card-text"><?php
                            $string = strip_tags($a->description);
                            if (strlen($string) > 120) {
                            $stringCut = substr($string, 0, 120);
                            $endPoint = strrpos($stringCut, ' ');
                            $string = $endPoint? substr($stringCut, 0, $endPoint) : substr($stringCut, 0);
                            $string .= '...';
                            }
                            echo $string;
                          ?></p>
                            <a class="btn btn-resume btn-dwld"  target="blank" href="{{ url('dynamic_pdf/pdf') }}/{{$a->lesson_id}}"><i class="fa fa-download"></i>Download</a>
                        </div>
                    </div>
                  </div>
                  @endforeach

               			  
            </div>
          
        </div>

    </section>
@include('layouts/footer')