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
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
                <div class="x_title">
                    <h2>Add Project</h2>
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
                    <form  id="demo-form2"  class="form-horizontal form-label-left" novalidate action="<?php echo base_url(); ?>backend/Project/saveNewProject"  enctype="multipart/form-data" method="POST">

                        <div class="item form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Project Title <span class="required">*</span>
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input type="text" class="form-control col-md-7 col-xs-12" maxlength="100" name="project_title"  required="required"  id="project_title">
                            </div>
                        </div>
						
						 <div class="item form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Project Category <span class="required">*</span>
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <select name="cat_id" id="cat_id" required="required"  class="form-control">
                                    <option value="">Select</option>
                                    <?php foreach ($category as $cat) { ?>
                                        <option value="<?php echo $cat->category_id;?>"><?php echo $cat->category_name; ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
						
						 <div class="item form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Cover Image <span class="required">*</span>
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input class="form-control col-md-7 col-xs-12" id="cover_image" required="required" name="cover_image" type="file" accept="image/*">
                            </div>
                        </div>
						
						
						
						<div class="form-group">
							<label class="col-md-3 col-sm-3 col-xs-12 control-label">Description File Type

							</label>

							<div class="col-md-9 col-sm-9 col-xs-12">

								<div class="radio">
									<label>
										<input value="1" required name="project_media" onclick="showImage();" type="radio">Image
									</label>
								</div>
								<div class="radio">
									<label>
										<input value="2" required name="project_media" onclick="showVideo();" type="radio"> Video
									</label>
								</div>
							</div>
						</div>
						
						<div id="project_attachment"></div>
						
						<div class="item control-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Short Description</label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <textarea name="short_description" cols="5" required="required" maxlength="240" class="form-control" id="short_description"> </textarea>
                                </br>
                            </div>
                        </div>
						
						<div class="clear"></div>
						
						
                        <div class="item form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Description<span class="required">*</span>
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <textarea class="ckeditor form-control col-md-7 col-xs-12" required="required" data-validate-length-range="5,100"  id="project_description" name="project_description" ></textarea>
                                <div class="error hidden" id="labelProductError">Enter content length should be greater than 12. </div>

                            </div>
                        </div>
                        
						<div class="input_fields_wrap">
						   
						  <div id="1">
							<div class="item form-group">
								<label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Price <span class="required">*</span>
								</label>
								<div class="col-md-6 col-sm-6 col-xs-12">
									<input type="text" class="form-control col-md-7 col-xs-12" name="price[]" required="required"  id="price1">
								</div>
							</div>
							
							 <div class="item form-group">
								<label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Price Offer <span class="required">*</span>
								</label>
							   <div class="col-md-6 col-sm-6 col-xs-12">
									<textarea name="offers[]" cols="12" rows="10" required="required"  class="form-control" id="short_description"> </textarea>
									</br>
								</div>
								<a href="javascript:;" class="add_field_button" class="remove_field">Add More</a>
							</div>
							
							</div>
							
						</div>	


                        <div class="ln_solid"></div>
                        <div class="form-group">
                            <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                                <button id="send" type="submit" class="btn btn-success">Submit</button>

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



function isNumberKey(evt)
  {
   var charCode = (evt.which) ? evt.which : event.keyCode;
   if (charCode != 46 && charCode > 31
      && (charCode < 48 || charCode > 57))
    return false;

   return true;
  }
  
  
 function showVideo()
 {
     var dy_text =' <div class="item form-group"><label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Project Video <span class="required">*</span></label><div class="col-md-6 col-sm-6 col-xs-12"> <input class="form-control col-md-7 col-xs-12" id="project_video" required="required" name="project_video" type="file" accept="video/*"></div></div>';
	 $("#project_attachment").empty();
	 $("#project_attachment").html(dy_text);
 }
 
 function showImage()
 {
     var dy_text =' <div class="item form-group"><label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Project Image <span class="required">*</span></label><div class="col-md-6 col-sm-6 col-xs-12"> <input class="form-control col-md-7 col-xs-12" id="project_image" required="required" name="project_image" type="file" accept="image/*"></div></div>';
	 $("#project_attachment").empty();
	 $("#project_attachment").html(dy_text);
 } 
 

</script>


<script type="text/javascript">
var dy_x = 0;

if(dy_x==0)
{
	var x = 1; //initlal text box count
}
else
{
    var x = dy_x; //initlal text box count
}

 
$(document).ready(function() {
    var max_fields      = 10; //maximum input boxes allowed
    var wrapper         = $(".input_fields_wrap"); //Fields wrapper
    var add_button      = $(".add_field_button"); //Add button ID

   
    $(add_button).click(function(e){ //on add input button click
	
	  e.preventDefault();
        if(x < max_fields){ //max input box allowed
            x++; //text box increment
            $(wrapper).append(' <div id="'+x+'"><div class="item form-group">' +
                '<label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Price <span class="required">*</span></label>' +
                '<div class="col-md-6 col-sm-6 col-xs-12">' +
                '<input type="text" class="form-control col-md-7 col-xs-12" name="price[]"  required="required"  id="price'+x+'">' +
                '</div>' +
                '<a href="javascript:;" class="remove_field" onclick="removeDiv('+x+')">Remove</a>' +
            '</div>'+
			'<div class="clear"></div>'+
			'<div class="item form-group">'+
			'<label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Price Offer <span class="required">*</span></label>'+
			'<div class="col-md-6 col-sm-6 col-xs-12">'+
			'<textarea name="offers[]" cols="12" rows="10" required="required"  class="form-control" id="short_description'+x+'"> </textarea>'+
			'</br></div>'+
			'</div>'+
			'</br></div>');
    }
    });
   
   /*
    $(wrapper).on("click",".remove_field", function(e){ //user click on remove text
        e.preventDefault(); 
		$("#"+x).remove();
		x--;
    })
	
	*/
	
	
});

    function removeDiv(div)
	{
		$("#"+div).remove();
		x--;
	}
</script>
<!-- /page content -->
