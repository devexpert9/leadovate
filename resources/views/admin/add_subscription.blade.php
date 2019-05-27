@include('layouts/admin_header')
<script src="{{url('/')}}/resources/admin_assets/js/multi-select.css"></script>
	<!-- Content_right -->
	<div class="container_full">
		@include('layouts/admin_sidebar')
		<div class="content_wrapper">
			<div class="container-fluid">
				<section class="chart_section">
					<div class="row">
						<div class="col-xl-12 col-lg-12 mb-4">
								<div class="card card-shadow mb-4">
									<div class="card-header">
										<div class="card-title">
											Add Subscription
										</div>
									</div>
									<div class="card-body">
									<form class="addplan" method="POST" data-action="{{ url('/') }}/admin/saveplan" 
			                    	data-next="{{url('/')}}/admin/subscriptions">
										    	@csrf()
											<div class="row">
												<div class="form-group col-sm-6 col-12">
													<label for="">Subscription Plan</label>
													<input type="text" class="form-control form-control-square" name="plan_name" id="" placeholder="Ex: Basic Plan">
												</div>
												<div class="form-group col-sm-4 col-12">
													<label>User Image</label>
													<label class="custom-file">
														<input type="file" id="files" class="custom-file-input fileupload" name="file">
														<span class="custom-file-control"></span> 
													</label>
												</div>
												<div class="form-group col-sm-2 col-12">
														<img id="blah" src="{{url('/')}}/resources/admin_assets/images/card-icon.png" alt="your image" class="media-object default-img" />
												</div>
												<div class="form-group col-sm-6 col-12">
													<label for="exampleInputPassword10">Subscription Price ($)</label>
													<input type="text" class="form-control form-control-square" name="price" id="" placeholder="Ex: 49.99">
												</div>
												<div class="form-group col-sm-6 col-12">
													<label for="">Subscription Duration in months</label>
													<input type="text" class="form-control form-control-square"  name="duration" id="" placeholder="Ex: 1/3">
												</div>
													<div class="form-group col-sm-12 col-12">
													<label for="">Feature</label>
                                                    <select class="form-control multiple-select" name="features[]"   multiple="multiple">
                                                    @foreach($feature as $f)
                                                    <option value="{{$f->id}}">{{$f->name}}</option>
                                                    @endforeach
                                                    </select>
												</div>
												<div class="form-group col-sm-6 col-12">
													<label for="">Subscription Features</label>
													<input type="text" name="detailed_features[]" class="form-control form-control-square" id="" placeholder="Ex: Push Notifications, 24/7 Support">
												</div>
												<div class="form-group col-sm-6 col-12 add-feat-field">
												    <label>Add More Features</label>
											        <a href="#" class="btn round btn-success" id="addScnt" data-toggle="tooltip" data-original-title="Add More Features">
													    <i class="fa fa-plus"></i>
													</a>
											    </div>
											    <div id="p_scents"></div>
												<div class="form-group col-sm-12 col-12 mt-2">
													<button class="btn btn-info mr-2 save_plan" type="submit">
														Submit
													</button>
													<button class="btn btn-secondary" type="button">
														Cancel
													</button>
												</div>
											</div>
										</form>
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
<script src="{{url('/')}}/resources/admin_assets/js/jquery.multi-select.js"></script>
<script>
$(document).ready(function() {
$('.single-select').select2();
$('.multiple-select').select2({
noneSelectedText: 'Select Something (required)',
selectedList: 3,
classes: 'my-select'
});
//multiselect start
$('#my_multi_select1').multiSelect();
$('#my_multi_select2').multiSelect({
selectableOptgroup: true
}); 
$('#my_multi_select3').multiSelect({
selectableHeader: "<input type='text' class='form-control search-input' autocomplete='off' placeholder='search...'>",
selectionHeader: "<input type='text' class='form-control search-input' autocomplete='off' placeholder='search...'>",
afterInit: function (ms) {
var that = this,
$selectableSearch = that.$selectableUl.prev(),
$selectionSearch = that.$selectionUl.prev(),
selectableSearchString = '#' + that.$container.attr('id') + ' .ms-elem-selectable:not(.ms-selected)',
selectionSearchString = '#' + that.$container.attr('id') + ' .ms-elem-selection.ms-selected';
that.qs1 = $selectableSearch.quicksearch(selectableSearchString)
.on('keydown', function (e) {
if (e.which === 40) {
that.$selectableUl.focus();
return false;
}
});
that.qs2 = $selectionSearch.quicksearch(selectionSearchString)
.on('keydown', function (e) {
if (e.which == 40) {
that.$selectionUl.focus();
return false;
}
});
},
afterSelect: function () {
this.qs1.cache();
this.qs2.cache();
},
afterDeselect: function () {
this.qs1.cache();
this.qs2.cache();
}
});
$('.custom-header').multiSelect({
selectableHeader: "<div class='custom-header'>Selectable items</div>",
selectionHeader: "<div class='custom-header'>Selection items</div>",
selectableFooter: "<div class='custom-header'>Selectable footer</div>",
selectionFooter: "<div class='custom-header'>Selection footer</div>"
});
});
</script>
<script>
$(function() {
var scntDiv = $('#p_scents');
var i = 1;
$('#addScnt').on('click', function(){
$('<div class="col-sm-12 rmvs"><div class="row"><div class="form-group col-sm-6 col-12"><label for=""></label><input type="text" class="form-control form-control-square" name="detailed_features[]" id="" placeholder="Ex: Push Notifications, 24/7 Support"></div><div class="form-group col-sm-6 col-12 add-feat-field"><label class="mb-0">Add More Features</label><a href="#" class="btn round btn-danger remove_div" id="" data-toggle="tooltip" data-original-title="Remove" aria-describedby="tooltip262215"><i class="fa fa-times"></i></a></div></div></div>').appendTo(scntDiv);
i++;
$('.content').last().richText();    
return false;
});
$('body').on('click', '.remove_div', function(){
if( i > 0 ) {
$(this).parents('.rmvs').remove();
i--;
}
return false;
});
});

function chnagefun(idss)
{
$(".colors"+idss).hide();
var slec = $('#colorselector'+idss).children("option:selected").val();
$('#'+slec).show();

}
</script>
