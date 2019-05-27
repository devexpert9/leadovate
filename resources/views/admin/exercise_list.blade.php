@include('layouts/admin_header')
<div class="container_full">
@include('layouts/admin_sidebar')
<div class="content_wrapper">
<div class="container-fluid">
<section class="chart_section">

<div class="row">
<div class="col-xl-12 col-lg-12 mb-4 d-flex align-items-stretch">
<div class="widthfull card card-shadow">
<div class="card-header">
<div class="card-title">
Examples
<a href="{{url('/')}}/admin/add-exercise" class="btn btn-success float-right">
Add Example
</a>
</div>
</div>
<div class="card-body">																				<div class="row">
<div class="col-xl-12 col-lg-12 col-sm-12">												<div class="card course-card mb-4">													<div class="card-body">														<a href="{{url('/')}}/admin/edit-exercise" class="btn round btn-success course-edit course-delete" data-toggle="tooltip" data-placement="bottom" title="Edit Example">															<i class="icon-note "></i>														</a>														<button type="button" class="btn round btn-danger course-delete" data-toggle="modal" data-target="#exampleModal">															<i class="fa fa-trash" data-toggle="tooltip" data-placement="bottom" title="Delete"></i>														</button>																												<h4 class="card-title mt-0">Example One</h4>														<span class="type-s"> <b> Type: </b>  Community Service </span>														<p class="card-text">															<b> Description: </b> 															Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam.														</p>													</div>												</div>											</div>											<div class="col-xl-12 col-lg-12 col-sm-12">												<div class="card course-card mb-4">													<div class="card-body">														<a href="{{url('/')}}/admin/edit-exercise" class="btn round btn-success course-edit course-delete" data-toggle="tooltip" data-placement="bottom" title="Edit Example">															<i class="icon-note "></i>														</a>														<button type="button" class="btn round btn-danger course-delete" data-toggle="modal" data-target="#exampleModal">															<i class="fa fa-trash" data-toggle="tooltip" data-placement="bottom" title="Delete"></i>														</button>																												<h4 class="card-title mt-0">Example Two</h4>														<span class="type-s"> <b> Type: </b>   Academics </span>														<p class="card-text">															<b> Description: </b> 															At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque corrupti quos dolores et quas molestias.														</p>													</div>												</div>											</div>											<div class="col-xl-12 col-lg-12 col-sm-12">												<div class="card course-card mb-4">													<div class="card-body">														<a href="{{url('/')}}/admin/edit-exercise" class="btn round btn-success course-edit course-delete" data-toggle="tooltip" data-placement="bottom" title="Edit Example">															<i class="icon-note "></i>														</a>														<button type="button" class="btn round btn-danger course-delete" data-toggle="modal" data-target="#exampleModal">															<i class="fa fa-trash" data-toggle="tooltip" data-placement="bottom" title="Delete"></i>														</button>																												<h4 class="card-title mt-0">Example Three</h4>														<span class="type-s"> <b> Type: </b>    Work/Job</span>														<p class="card-text">															<b> Description: </b> 															Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis.														</p>													</div>												</div>											</div>                						</div>										

</div>
</div>
</div>


</div>


</section>
</div>
</div>
</div>
<div class="modal del-modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
<div class="modal-dialog" role="document">
<div class="modal-content">
<div class="modal-body text-center">
<i class="icon-close"></i>
<h1>Are you sure?</h1>				
<p>Do you really want to delete this user? This action cannot be undone.</p>
<ul class="action-btns">					
<li>
<button type="button" class="btn  btn-light mr-2" data-dismiss="modal">
Cancel
</button>
</li>
<li><button type="button" class="btn  btn-danger">
Delete
</button>
</li>
</ul>
</div>
</div>
</div>
</div>

<div class="modal fade edit-type" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
<div class="modal-dialog modal-lg">
<div class="modal-content">
<div class="modal-header">
<h5 class="modal-title" id="myLargeModalLabel">Add Type</h5>
<button type="button" class="close" data-dismiss="modal" aria-label="Close">
<span aria-hidden="true">&times;</span>
</button>
</div>
<div class="modal-body">
<div class="form-group">
<label for="exampleFormControlSelect2">Add Type</label>
<input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Type">
</div>


</div>
<div class="modal-footer">
<button type="button" class="btn btn-secondary" data-dismiss="modal">
Close
</button>
<button type="button" class="btn btn-primary">
Submit
</button>
</div>
</div>
</div>
</div>

<div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
<div class="modal-dialog modal-lg">
<div class="modal-content">
<div class="modal-header">
<h5 class="modal-title" id="myLargeModalLabel">Edit Type</h5>
<button type="button" class="close" data-dismiss="modal" aria-label="Close">
<span aria-hidden="true">&times;</span>
</button>
</div>
<div class="modal-body">
<div class="form-group">
<label for="exampleFormControlSelect2">Edit Type</label>
<input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" value="Type One">
</div>

</div>
<div class="modal-footer">
<button type="button" class="btn btn-secondary" data-dismiss="modal">
Close
</button>
<button type="button" class="btn btn-primary">
Update
</button>
</div>
</div>
</div>
</div>

@include('layouts/admin_footer')
