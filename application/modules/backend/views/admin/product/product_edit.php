<style>
    .danger, .mandatory {
        color: #BD4247;
    }
    .alert{
        padding:8px 20px;
    }
	#tags_1_tagsinput {
		width:66% !important;
	}
	
</style>
</style>
<script src="<?php echo base_url(); ?>assets/backend/js/jquery.validate.min.js"></script> 
<script src="//cdn.ckeditor.com/4.6.2/standard/ckeditor.js"></script>


<!-- page content -->
<div class="right_col" role="main"> <!-- top tiles -->
    <div class="row">
	
        <div class="col-md-12 col-sm-12 col-xs-12">
		<?php
    $msg = $this->session->userdata('msg');
    $this->session->unset_userdata('msg');
    if (isset($msg) != '') {
        ?>
        <div class="alert alert-success alert-dismissable">
            <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
            <h4><i class="icon fa fa-check"></i> Success!</h4>
            <?php echo $msg; ?>
        </div>
    <?php } ?>
    
    <?php
    $error = $this->session->userdata('error');
    $this->session->unset_userdata('error');
    if (isset($error) != '') {
        ?>
        <div class="alert alert-danger alert-dismissable">
            <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
            <h4><i class="fa fa-times" aria-hidden="true"></i>
</i> Error!</h4>
            <?php echo $error; ?>
        </div>
    <?php } ?>
            <div class="x_panel">
                <div class="x_title">
                    <h2>Edit Paper</h2>
                    <ul class="nav navbar-right panel_toolbox">
                        <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                        </li>
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench"></i></a>
                            <ul class="dropdown-menu" role="menu">
                                <li><a href="#">Settings 1</a>
                                </li>
                                <li><a href="#">Settings 2</a>
                                </li>
                            </ul>
                        </li>
                        <li><a class="close-link"><i class="fa fa-close"></i></a>
                        </li>
                    </ul>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content">
                    <br>
                    <form id="demo-form2" class="form-horizontal form-label-left" novalidate action="<?php echo base_url(); ?>admin/edit-paper/<?php echo $post_id; ?>"  enctype="multipart/form-data"  method="POST">
                        <input type="hidden" name="edit_id" value="<?php echo $post_id; ?>" id="edit_id" />
                        <input type="hidden" name="email_template_hidden_id" id="email_template_hidden_id" value="<?php echo(isset($email_template_id)) ? $email_template_id : ''; ?>">
                        <div class="item form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Title <span class="required">*</span>
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input type="text" class="form-control col-md-7 col-xs-12" required="required" name="name" value="<?php if(!empty($post_info["name"])) { echo stripslashes($post_info["name"]); } ?>"  id="name">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Image <span class="required">*</span>
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input  dir="ltr"  class="form-control" id="image_file" name="image_file" type="file" accept="image/*" <?php if (empty($post_info["image_file"]) ) { ?>required="required" <?php } ?> >
                                    <?php if ( !empty($post_info["image_file"]) && $post_info["image_file"] != '') { ?>
                                        <input type="hidden" name="old_img_file" id="old_img_file" value="<?php echo stripslashes($post_info["image_file"]); ?>">
                                        <br>
                                        <img width="100" height="100" src="<?php echo base_url(); ?>uploads/papers/thumbnail/<?php echo stripslashes($post_info["image_file"]); ?>" id="front_image_tag_id" title="image" > 
                                    <?php } ?>
                            </div>
                        </div>
						<div class="item form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Paper file <span class="required">*</span>
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input class="form-control col-md-7 col-xs-12" id="img_file" <?php if ( empty($post_info["paper_file"])) { ?>required="required" <?php } ?> name="img_file" type="file" accept=".doc, .docx,.pdf">
								 
                            </div>
							
                        </div>
						
						<?php if (!empty($post_info["paper_file"]) && $post_info["paper_file"] != '') { ?>
							<div class="item form-group">
								<input type="hidden" name="old_img_file" id="old_img_file" value="<?php echo stripslashes($post_info["paper_file"]); ?>">
								<br>
								 <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name"> 
                            </label>
							<div class="col-md-6 col-sm-6 col-xs-12">
								<a href="<?php echo base_url(); ?>uploads/papers/<?php echo stripslashes($post_info["paper_file"]); ?>" target="_blank" > <?php echo stripslashes($post_info["paper_file"]); ?></a> 
							</div>
							</div>
						<?php } ?>
							
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Content <span class="required">*</span>
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <textarea class="ckeditor form-control col-md-7 col-xs-12" id="long_desc" name="long_desc" ><?php if ( !empty($post_info["long_desc"]) ) { echo stripslashes($post_info['long_desc']); } ?></textarea>
                                    <div class="error hidden" id="labelProductError">Enter content length should be greater than 12. </div>
                                
                            </div>
                        </div>
						
						<div class="control-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Input Tags</label>
                            <div class="col-md-9 col-sm-9 col-xs-12">
                                <input id="tags_1" type="text" class="tags form-control" name="tags" value="<?php if ( !empty($post_info["tags"]) ) { echo $post_info['tags']; } ?>" placeholder="enter product tags" />
                                <div id="suggestions-container" style="position: relative; float: left; width: 250px; margin: 10px;"></div>
                            </div>
                        </div>
                         <div class="item form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Category <span class="required">*</span>
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <select name="cat_id" required="required" class="form-control" autocomplete="off">
                                        <option value="">Select</option>
                                        <?php foreach($category as $category){?>
                                        <option <?php if ( !empty($post_info["cat_id"]) && $post_info["cat_id"] == $category['category_id']) echo 'selected="selected"';?> value="<?php echo $category['category_id']?>"><?php echo $category['category_name']?></option>
                                        <?php }?>
                                    </select>
                            </div>
                        </div>
						 <div class="item form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Price <span class="required">*</span>
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input type="number" class="form-control col-md-7 col-xs-12" name="price"  required="required"  id="price" value="<?php if ( !empty($post_info["price"]) ) { echo stripslashes($post_info['price']); } ?>">
                            </div>
                        </div>
                        <div class="item form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Status <span class="required">*</span>
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <select required="required" name="blog_status" name="blog_status" class="form-control col-md-7 col-xs-12" autocomplete="off">
                                        <option value="">Select</option>
                                        <option <?php if ( !empty($post_info["cat_id"]) && $post_info["status"] == "1") echo 'selected="selected"'; ?> value="1">Published</option>
                                        <option <?php if ( !empty($post_info["cat_id"]) && $post_info["status"] == "0") echo 'selected="selected"'; ?> value="0">Unpublished</option>
                                    </select>
                            </div>
                        </div>
   
                        <div class="ln_solid"></div>
                        <div class="form-group">
                            <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                                <button type="submit" class="btn btn-success">Submit</button>
                               
                            </div>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- end of weather widget -->
</div>
</div>
</div>
</div>
<script src="<?php echo backend_asset_url() ?>vendors/jquery/dist/jquery.min.js"></script>
<script type="text/javascript">

$('#image_file').change( function () { 
	var fileExtension = ['jpg','jpeg','gif','png']; 
	if ($.inArray($(this).val().split('.').pop().toLowerCase(), fileExtension) == -1) { 
		alert("Only 'jpg','jpeg','gif','png' format is allowed."); 
		this.value = ''; 
	}
});

$('#img_file').change( function () { 
	var fileExtension = ['pdf','doc','docx']; 
	if ($.inArray($(this).val().split('.').pop().toLowerCase(), fileExtension) == -1) { 
		alert("Only 'pdf','doc','docx format is allowed."); 
		this.value = ''; 
	}
});
</script>
<!-- /page content -->