@include('layouts/header')
    <section class="application-sec courses-sec  mt-0 pb-0" id="courses">
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                    <h3>All Courses</h3>
                </div>
               @if($user->package_id =='')
               
                <div class="col-sm-12">
                    <div class="subs-box">
                        <div class="text-center">
                            <?php if(!empty($user)){
                            if(!empty($user->package_id)){
                             $package=App\Subscription::getwithid($user->package_id);
                             $current_package=App\Transaction::get_active_payment_details($user->id);?>
                            <span class="main-txt-icn refresh-icon">
                            <i class="fas fa-cloud-upload-alt"></i>
                            </span>
                            <?php if(date('Y-m-d') >=$current_package->end_date){ ?>
                            <h4 class="">Plan expired</h4>
                            <p>Your trial is expired. Click below to upgrade subscription <br> so that you can keep learning on this platform.</p>
                            <?php }else{ ?>
                            
                            <?php } ?>
                            <?php }else{ ?>
                            <p> Click below to upgrade to subscription packages <br> so that you can keep learning on this platform.</p>
                            <?php }} ?>
                              <div class="row">
                                  <div class="col-sm-12">
                                        <a href="{{url('/')}}/pricing" class="btn btn-resume btn-upgrade">Upgrade</a>
                                  </div>
                            </div>
                        </div>
                    </div>
                </div>
               @else
               <div class="row row-margin-null">
                @forelse($course as $c)
                
                <?php  $tt=App\Usercourse::where('user_id',Session()->get('userid'))->where('course_id',$c->id)->where('status','1')->first();
                $ttt=App\Usercourse::where('user_id',Session()->get('userid'))->where('course_id',$c->id)->first();
                $enroled_ids = explode(",",$c->enroled_ids);
                $uid = Session()->get('userid');
                if(empty($ttt)  && !in_array($uid,$enroled_ids)){
                  
                if(!empty($tt))
                {
                $hide='hide';
                }else
                {
                   $hide='';  
                }?>
                <div class="col-sm-6 col-md-4 <?=$hide;?> ">
                <?php        
                $tt=App\Usercourse::where('user_id',Session()->get('userid'))->where('course_id',$c->id)->first();
                if(!empty($tt))
                {
                $percentage =\App\Userlesson::getviewedlessons(Session()->get('userid'),$c->id);
                $totalWidth =\App\Lesson::getlessoneithcoursecon($c->id,$user->package_id);
                if($totalWidth != '0'){
                $new_width = ($percentage / $totalWidth) * 100;
                echo '<style>
                .application-sec .newstyle'.$c->id.':before
                {
                   width:'.$new_width.'% !important; 
                }
                </style>';
                }
                echo '<div class="card card-00 newstyle'.$c->id.'"  > ';
                }else
                {
                 $new_width='0';
                echo '<div class="card card-00  newstyle'.$c->id.'" > ';
                 echo '<style>
                .application-sec .newstyle'.$c->id.':before
                {
                   width:'.$new_width.'% !important; 
                }
                </style>';  
                }
                ?>
                 
            <div class="card-img">
            <a href="{{url('course-details')}}/{{$c->id}}">
            @if(empty($c->image))
            <img class="card-img-top" src="{{url('/')}}/resources/assets/img/card-icon.png" alt="Card image cap">
            @else
            <img class="card-img-top" src="{{url('/')}}/public/uploads/{{$c->image}}" alt="Card image cap">
            @endif
            </a>
            </div>
            <div class="card-body courses-body">
            <a href="{{url('course-details')}}/{{$c->id}}">
            <h5 class="card-title">
            {{$c->title}}
            </h5>
            </a>
            <p class="card-text">
            <?php
            $string = strip_tags($c->description);
            if (strlen($string) > 120) {
            $stringCut = substr($string, 0, 120);$endPoint = strrpos($stringCut, ' ');$string = $endPoint? substr($stringCut, 0, $endPoint) : substr($stringCut, 0);$string .= '...';
            }echo $string;
            ?>
            </p>
            <?php
            $t=0;
            foreach($user_course as $u)
            {
            if($u->course_id == $c->id)
            {
            $t=$t+1;
            }
            }
            if($t=='1'){ ?>
            <a class="btn btn-resume" data-id="{{$c->id}}"  href="{{url('course-details')}}/{{$c->id}}">Resume</a>
            <?php }else{ ?>
            <a class="btn btn-resume enroll_course" data-id="{{$c->id}}"  href="javascript:void(0)">Enroll</a>
            <!--{{url('home')}}-->
            <?php }
            ?>
            </div>
            </div></div>
            <?php } ?>
            @empty
            No Couses found
            @endforelse
            </div>
            @endif
            </div>
            @if($user->package_id !='')
            
            @endif 
            
            </div>
            
            </section>
            @include('layouts/footer')
            
            <script>
            $(document).on('click', '.enroll_course', function () {
            var base=$('#base_url').val();
            var cid=$(this).attr('data-id');
            var action =base+'/enroll_course';
            var data ={cid:cid};
            $.ajax({
            headers: {
            'X-CSRF-Token': $('input[name="_token"]').val()
            },
            type: 'post',
            url: action,
            data: data,
            success: function (data1) {
            window.location.href = base+'/home#courses';
            },
            });
            
            });
            </script>