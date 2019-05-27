                                        <div class="col-md-12">
                                        <div class="row">
                                        <div class="form-group col-sm-12 col-12">
                                        <h4 class="dvl-brdr"> <?php echo $query['title'];?> 
                                        <input type="hidden" value="0" id="getvalue">
                                        </h4>
                                        <input type="hidden" name="syllabus_id[]" value="<?php echo $syllabus_id;?>">
                                        </div>
                                        </div>
                                        <div class="row">
									    <div class="bg-ns-a">
										<div class="form-group col-sm-12 col-12">
										<label class="d-block" for="exampleInputPassword10">Lesson Name
										<a href="javascript:void(0)" class="float-right pull-right btn btn-info addScnt btn-adda" 
										id="addScnt" data-id="'.$random.'"> Add Lesson </a></label>
										<input type="text" class="form-control form-control-square" id="" 
										name="title[<?php echo $syllabus_id;?>][name][]" placeholder="" required>
										<input type="hidden"  name="title[<?php echo $syllabus_id;?>][random_no][]" value="<?php echo $random;?>">
										</div>
										<div class="form-group col-sm-12 col-12">
										<label for="exampleInputPassword10">Content Type</label>
										<select id="colorselector" class="form-control form-control-square" name="title[<?php echo $syllabus_id;?>][type][]" 
										required>
										<option value="">Select One</option>
										<option value="Video">Video</option>
										<option value="Exercise" selected>Exercise</option>
										</select>
										</div>
										<div class="form-group col-sm-12 col-12 colors" id="Video" style="display:none">
										<label for="exampleInputPassword10">Add Video</label>
										<input type="hidden"  name="title[<?php echo $syllabus_id;?>][file][]" class="file_video0">
                                        <input type="file"   data-random="'.$random.'"  
                                        class="form-control form-control-square files file_video" id="file_video0" placeholder="">
                                        </div>
                                        <div class="form-group col-sm-12 col-12 colors" id="Exercise">
                                        <label for="exampleInputPassword10">Learn Column</label>
                                        <textarea class="summernote" id="content21" name="title[<?php echo $syllabus_id;?>][description][]" ></textarea>
                                        </div>
                                        </div>
                                        <div class="p_scents  p_scents<?php echo $random;?>"></div>
                                        </div>