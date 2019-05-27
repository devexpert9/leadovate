@include('layouts/admin_header')
	
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
											Edit Subscription
										</div>
									</div>
									<div class="card-body">
									<form class="editplan" method="POST" data-action="{{ url('/') }}/admin/saveplan" 
			                    	data-next="{{url('/')}}/admin/subscriptions">
									@csrf()
									<div class="row">
									<input type="hidden" id="id" name="id" value="{{$sub->id}}">
									<div class="form-group col-sm-6 col-12">
									<label for="">Subscription Plan</label>
										<input type="text" name="plan_name" class="form-control form-control-square" id="" value="{{$sub->plan_name}}">
										</div>
										<div class="form-group col-sm-4 col-12">
    										<label>Plan Image</label>
                                            <label class="custom-file">
                                                <input type="file" id="files" name="file"  class="custom-file-input fileupload">
                                                    <input type="hidden" id="plan_img" name="plan_img" value="{{$sub->plan_img}}">
    												<span class="custom-file-control"></span> 
											</label>
										</div>
									    	<div class="form-group col-sm-2 col-12">
										         @if($sub->plan_img =='')
        												 
        										<img class="media-object upsave" src="{{url('/')}}/public/uploads/p_icon02.png" alt="">
        										@else
        										<img class="media-object upsave" src="{{url('/')}}/public/uploads/{{$sub->plan_img}}" alt="">
        										@endif
        										<img id="blah" src="#" alt="your image" class="media-object" style="display:none;" />
										    </div>	
												<div class="form-group col-sm-6 col-12">
													<label for="exampleInputPassword10">Subscription Price ($)</label>
													<input type="text" class="form-control form-control-square" id=""  name="price" value="{{$sub->price}}">
												</div>
												
												<div class="form-group col-sm-6 col-12">
													<label for="exampleInputPassword10">Subscription Duration</label>
													<input type="text" class="form-control form-control-square" id=""  name="duration" value="{{$sub->duration}}">
												</div>
											<?php $fea=explode(",",$sub->features);?>
												<div class="form-group col-sm-12 col-12">
													<label for="">Feature</label>
                                                    <select class="form-control multiple-select" name="features[]"   multiple="multiple">
                                                    @foreach($feature as $f)
                                                    <option value="{{$f->id}}" <?php if(in_array($f->id, $fea)){ echo 'selected';}    ?>>{{$f->name}}</option>
                                                    @endforeach
                                                    </select>
												</div>
												<div class="form-group col-sm-12 col-12">
												    	<label for="">Subscription Features</label>
												    </div>
											
													<?php $fea1=explode("#&",$sub->detailed_features);
													foreach($fea1 as $f){?>
													<div class="rmvs" style="    display: -webkit-box;">
													<div class="teach form-group col-sm-6 col-12 ">
													
													<input type="text"  name="detailed_features[]" value="<?=$f;?>"  class="form-control form-control-square" id="" value="Push Notifications">
												 </div>	<div class="form-group col-sm-1 col-12 rmvs text-center">
											        <a href="#" class="btn round btn-danger remove_div" id="" data-toggle="tooltip" data-original-title="Remove">
													    <i class="fa fa-times"></i>
													</a>
											
												</div>	<div class="form-group col-sm-1 col-12 add-feat-field">
												  
											        <a href="#" class="btn round btn-success addScnt" id="" data-toggle="tooltip" data-original-title="Add More Features">
													    <i class="fa fa-plus"></i>
													</a>
											    </div>	</div>
												   <?php } ?>
											     <div id="p_scents" class="mx-15"></div>
    
												<div class="form-group col-sm-12 col-12 mt-2">
													<button class="btn btn-info mr-2 update_plan" type="submit">
														Update
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
    $('.addScnt').on('click', function(){
            $('<div class="row"><div class="form-group col-sm-6 col-12"><label for=""></label><input type="text" class="form-control form-control-square" name="detailed_features[]" id="" placeholder="Ex: Push Notifications, 24/7 Support"></div><div class="form-group col-sm-1 col-12 text-center"><a href="#" class="btn round btn-danger remove_div mt-20" id="" data-toggle="tooltip" data-original-title="Remove" aria-describedby="tooltip262215"><i class="fa fa-times"></i></a></div></div>').appendTo(scntDiv);
			i++;
			$('.content').last().richText();    
			/*$("#colorselector"+i).change(function(){
				$(".colors"+i).hide();
				$('#' + $(this).val()).show();
			}); */
            return false;
    });
    $('body').on('click', '.remove_div', function(){
	
				$(this).parent().parent('.rmvs').remove();
			$('.tooltip-inner').hide();
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
