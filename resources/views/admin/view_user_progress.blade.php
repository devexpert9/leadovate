@include('layouts/admin_header')
	<div class="container_full">
		@include('layouts/admin_sidebar')
		<style>
		.label_username
		{
		    
		    display: block;
		}
		#username:focus:invalid + label[for="username"]:after {
        content: "Username must contain only letters and digits";
        color:red;
        }
		</style>

		<div class="content_wrapper">
			<div class="container-fluid">
				<section class="chart_section">
					
					<div class="row">
						<div class="col-xl-12 col-lg-12 mb-4">
							
								<div class="card card-shadow mb-4">
									<div class="card-header">
										<div class="card-title">
											User Progress
										</div>
									</div>
									<div class="card-body">
    									<ul class="nav nav-pills nav-pills-success mb-4 cs-tabs" role="tablist">
    										<li class="nav-item">
    											<a class="nav-link active" data-toggle="tab" href="#tab-p-info_1"> <i class="icon-user pr-2"></i>User Details</a>
    										</li>
    										<li class="nav-item">
    											<a class="nav-link" data-toggle="tab" href="#tab-p-info_2"> <i class="fa fa-file-text-o pr-2"></i>Subscriptions</a>
    										</li>
    										<li class="nav-item">
    											<a class="nav-link" data-toggle="tab" href="#tab-p-info_3"> <i class="icon-grid pr-2"></i>Applications</a>
    										</li>
    										<li class="nav-item">
    											<a class="nav-link" data-toggle="tab" href="#tab-p-info_4"> <i class="icon-book-open pr-2"></i>Courses</a>
    										</li>
    
    									</ul>
    
    									<div class="tab-content">
    										<div class="tab-pane active" id="tab-p-info_1" role="tabpanel">
    											<form class="edituser" method="POST" data-action="{{ url('/') }}/admin/edituser/{{$user->id}}" data-next="{{url('/')}}/admin/users">
										    	@csrf
										    	<input type="hidden" value="{{$user->id}}"  id="id">
        											<div class="row">
        												<div class="form-group col-sm-6 col-12">
        													<label for="exampleInputPassword10">User ID</label>
        													<input type="text" class="form-control form-control-square" disabled id="disabledTextInput" value="{{$user->id}}">
        												</div>
        													<div class="form-group col-sm-6 col-12">
        													<label for="exampleInputPassword10">User Name</label>
        													<input type="text" class="form-control form-control-square" id="username"  name="username" value="{{$user->username}}">
        												</div>

        												<div class="form-group col-sm-6 col-12">
        													<label for="exampleInputPassword10">First Name</label>
        													<input type="text" class="form-control form-control-square" id=""  name="first_name" value="{{$user->first_name}}">
        												</div>
        												
        												<div class="form-group col-sm-6 col-12">
        													<label for="exampleInputPassword10">Last Name</label>
        													<input type="text" class="form-control form-control-square" id="" name="last_name" value="{{$user->last_name}}">
        												</div>
        												
        											
        
        												<div class="form-group col-sm-6 col-12">
        													<label for="exampleInputEmail10">Email Address</label>
        													<input type="email" class="form-control form-control-square" id="" aria-describedby="emailHelp"  name="email" value="{{$user->email}}">
        												</div>
        												<div class="form-group col-sm-6 col-12">
        													<label for="phone">Phone Number</label>
        													<input type="tel" class="form-control form-control-square" id="phone"   name="phone" value="{{$user->phone}}">
        												</div>
        												
        												<div class="form-group col-sm-6 col-12">
                                                        <label class="label_username">User Image</label>
                                                        <label class="custom-file">
                                                        <input type="file" name="file" id="files" class="custom-file-input fileupload">
                                                        <span class="custom-file-control"></span> 
                                                        </label>
                                                        @if(!empty($user->image))
                                                        <?php if(file_exists('public/uploads/'.$user->image)){ ?>
                                                        <img class="media-object upsave" src="{{url('/')}}/public/uploads/{{$user->image}}" alt="">
                                                       <?php }else{?>
                                                       <img class="media-object upsave" src="{{url('/')}}/public/profile/{{$user->image}}" alt="">
                                                       
                                                       <?php } ?>
                                                       
                                                        @endif
                                                        <img id="blah" src="#" class="media-object" alt="your image" style="display:none;" />
                                                        </div>
        												
        												<div class="form-group col-sm-6 col-12">
                											<label for="">Subscription Level</label>
                											<select class="form-control" id="" name="package_id">
                											    <option value="">Choose Plan</option>
                											    @if(!empty($subscription))
                											    @foreach($subscription as $s)
                												<option 
                												@if(!empty($user->package_id))
                												@if($user->package_id == $s->id)
                												selected
                												@endif
                												@endif
                												value="{{$s->id}}">{{$s->plan_name}}</option>
                											    @endforeach
                											    @endif
                											</select>
                										</div>

        												<div class="form-group col-sm-12 col-12 mt-2">
        													<button class="btn btn-info mr-2 updateuser" type="submit" >
        														Update
        													</button>
        
        													<button class="btn btn-secondary" type="button">
        														Cancel
        													</button>
        												</div>
        												
        											
        												
        											</div>
        
        										</form>
    										</div>
    									
    										<div class="tab-pane" id="tab-p-info_2" role="tabpanel">
    										    <div class="row">
                                					<div class="col-sm-12">
                                						<h3 class="cs-head m-b-15">Your Subscription Plan</h3>
                                					</div>
                                					
                                					<div class="col-sm-12">
                                						<div class="subs-box">
                                							<div class="text-center">
                                								<span class="main-txt-icn refresh-icon price-pls">
                                									@if(!empty($package->price))
                                									<sup> $</sup>
                                									{{$package->price}}
                                									@endif
                                								</span>
                                								@if(!empty($package->plan_name))
                                								<h4 class="">{{$package->plan_name}} Activated</h4>
                                								@endif
                                								@if(!empty($current_package->end_date))
                                								<?php
                                                             
                                                                $datestr=$current_package->end_date;
                                                                $date=strtotime($datestr);
                                                                $diff=$date-time();
                                                                $days=floor($diff/(60*60*24));
                                                                $hours=round(($diff-$days*60*60*24)/(60*60));
                                                                ?>
                                                                	<p id="demo" class="timer"><?=$days;?>d <?=$hours;?>h </p>
                                								@endif
                                							</div>
                                						</div>
                                					</div>
                                				</div>
    										    
    										    <h3 class="cs-head">Your Previous Plans</h3>
    											<div class="bd-example table_style">
            										<table class="table table-responsive-md subs-table" id="bs4-table_info">
            											<thead>
            											   
            												<tr>
            													<th scope="col">Id</th>
            													<th scope="col">Subscription Plan</th>
            													<th scope="col">Date of Purchase</th>
            													<th scope="col">Expiry Date</th>
            													<th scope="col">Created By</th>
            												</tr>
            											
            											</thead>
            											<tbody> <?php if(!empty($transaction)){ 
            											    $i=1;
            											    foreach($transaction as $t){ ?>
            												<tr>
            													<td>#<?=$i++;?></td>
            													<td>{{\App\Subscription::getdatawithid($t->package_id)}}</td>
            													<td><span class="badge badge-success"><?php echo date('M d-Y',strtotime($t->created_at)); ?></td>
            													<td><span class="badge badge-success"><?php echo date('M d-Y',strtotime($t->end_date)); ?></td>
            													<td><?=$t->added_by;?></td>
            												</tr>
            												<?php }} ?>
            											</tbody>
            										</table>
            									</div>
    										</div>
    										
    										<div class="tab-pane" id="tab-p-info_3" role="tabpanel">
    										<div class="row">
    									    @forelse($application as $a)
                                            <div class="col-xl-6 col-lg-6 col-sm-12">
                                            <div class="card course-card apply-card mb-4">
                                            <div class="card-body">
                                            <div class="card-icon">
                                            @if(empty($a->image))
                                            <img src="{{url('/')}}/resources/assets/img/card-icon.png" alt="Card image cap">
                                            @else
                                            <img src="{{url('/')}}/public/uploads/{{$a->image}}" alt="Card image cap">
                                            @endif
                                            </div>
                                            <h4 class="card-title">{{$a->name}}</h4>
                                            <p class="card-text">
                                            </p>
                                            <a class="btn btn-resume btn-info btn-dwld" target="blank" href="{{ url('dynamic_pdf/pdf') }}/{{$a->lesson_id}}/{{$user_id}}"><i class="fa fa-download"></i>Download</a>
                                            </div>
                                            </div>
                                            </div>
                            				@empty
                            				No Applications found...!
                            				@endforelse
                            		    	</div>	
    										</div>
    										<div class="tab-pane" id="tab-p-info_4" role="tabpanel">
    											<div class="row">
                            						@forelse($course as $c)
                            						<div class="col-xl-6 col-lg-6 col-sm-12">
                            						<?php        
                                                    $tt=App\Usercourse::where('user_id',$user_id)->where('course_id',$c->id)->first();
                                                    $user=App\User::where('id',$user_id)->first();
                                                 
                                                    if(!empty($tt))
                                                    {
                                                    $percentage =\App\Userlesson::getviewedlessons($user_id,$c->id);
                                                    $totalWidth =\App\Lesson::getlessoneithcoursecon1($c->id,$user->package_id,$user_id);
                                                    if($totalWidth != '0'){
                                                    $new_width = ($percentage / $totalWidth) * 100;
                                                    echo '<style>
                                                    .user-course_card.card-'.$c->id.':before
                                                    {
                                                    width:'.$new_width.'% !important; 
                                                    }
                                                    </style>';
                                                    }
                                                    echo '<div class="card course-card  user-course_card  apply-card mb-4 card-'.$c->id.'"  > ';
                                                    }else
                                                    {
                                                    $new_width='0';
                                                    echo '<div class="card course-card   user-course_card  apply-card mb-4  card-'.$c->id.'" > ';
                                                    echo '<style>
                                                   .user-course_card.card-'.$c->id.':before
                                                    {
                                                    width:'.$new_width.'% !important; 
                                                    }
                                                    </style>';  
                                                    }
                                                    ?>
                            					
                                                    <div class="card-body">
                                                    <div class="card-icon">
                                                    @if(empty($c->image))
                                                    <img  src="{{url('/')}}/resources/assets/img/card-icon.png" alt="Card image cap">
                                                    @else
                                                    <img src="{{url('/')}}/public/uploads/{{$c->image}}" alt="Card image cap">
                                                    @endif
                                                    </div>
                                                    <h4 class="card-title">{{$c->title}}</h4>
                                                    <p class="card-text">
                                                    <?php
                                                    $string = strip_tags($c->description);
                                                    if (strlen($string) > 120) {
                                                    $stringCut = substr($string, 0, 120);$endPoint = strrpos($stringCut, ' ');$string = $endPoint? substr($stringCut, 0, $endPoint) : substr($stringCut, 0);$string .= '...';
                                                    }echo $string;
                                                    ?>	</p>
                                                    <a class="btn btn-resume btn-info btn-dwld"  target="blank" href="{{url('course-details')}}/{{$c->id}}">View</a>
                                                    </div>
                                                    </div>
                                                    </div>
                            						@empty
                            							No Courses found...!
                            						@endforelse
                            					</div>	
    										</div>
    									</div>
    								</div>
								</div>
						</div>
					</div>
				</section>
			</div>
		</div>
	</div>
	<!-- Content_right_End -->
	
@include('layouts/admin_footer')

