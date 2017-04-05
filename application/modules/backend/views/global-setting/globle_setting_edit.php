    
<script type="text/javascript">
    jQuery(document).ready(function(e) {
    jQuery("#frm_edit_global_setting_parameter").validate({
    errorClass: "danger",
            rules: {
            lang_id:{
            required:true
            },
                    value:{
                    required:true
<?php
if ($arr_global_settings['name'] == "site_email" || $arr_global_settings['name'] == "contact_email") {
    echo ",email:true,emailspecialchars:true";
}

if ($arr_global_settings['name'] == "contactus_telephone_number") {
    echo ",number:true";
}
if ($arr_global_settings['name'] == "contactus_company_number") {
    echo ",number:true";
}
if ($arr_global_settings['name'] == "facebook_link") {
    echo ",required:true";
    echo ",url:true";
}
if ($arr_global_settings['name'] == "google_link") {
    echo ",required:true";
    echo ",url:true";
}
if ($arr_global_settings['name'] == "youtube_link") {
    echo ",required:true";
    echo ",url:true";
}
if ($arr_global_settings['name'] == "twitter_link") {
    echo ",required:true";
    echo ",url:true";
}
if ($arr_global_settings['name'] == 'zip_code') {
    echo ",number:true";
    echo ",minlength:3";
    echo ",maxlength:7";
}
if ($arr_global_settings['name'] == 'contact_us_text') {
    echo ",required:true";
}
?>
                    }
            },
            messages:{
            lang_id:{
            required:"Please select language."
            },
                    value:{
<?php
if ($arr_global_settings['name'] == "site_email" || $arr_global_settings['name'] == "contact_email") {
    echo 'required:"Please enter an email address."';
} else if ($arr_global_settings['name'] == "site_title") {
    echo 'required:"Please enter a site title."';
} else if ($arr_global_settings['name'] == "date_format") {
    echo 'required:"Please select a date format."';
} else if ($arr_global_settings['name'] == "contactus_telephone_number") {
    echo 'required:"Please enter telephone number"';
} else if ($arr_global_settings['name'] == "contactus_company_number") {
    echo 'required:"Please enter company number"';
} else if ($arr_global_settings['name'] == "facebook_link") {
    echo 'required:"Please enter facebook link.",';
    echo 'url:"Please enter valid facebook link."';
} else if ($arr_global_settings['name'] == "google_link") {
    echo 'required:"Please enter google link.",';
    echo 'url:"Please enter valid google link."';
} else if ($arr_global_settings['name'] == "twitter_link") {
    echo 'required:"Please enter twitter link.",';
    echo 'url:"Please enter valid twitter link."';
} else if ($arr_global_settings['name'] == "youtube_link") {
    echo 'required:"Please enter youtube link.",';
    echo 'url:"Please enter valid youtube link."';
} else if ($arr_global_settings['name'] == 'address') {
    echo 'required:"Please enter an address."';
} else if ($arr_global_settings['name'] == 'city') {
    echo 'required:"Please enter city."';
} else if ($arr_global_settings['name'] == 'zip_code') {
    echo 'required:"please enter zip code.",';
    echo 'number:"Please enter zip code in numbers only.",';
    echo 'minlength:"Please enter at least 3 numbers long zip code.",';
    echo 'maxlength:"Please enter a only 7 numbers long zip code."';
} else if ($arr_global_settings['name'] == 'state') {
    echo 'required:"Please enter state."';
} else if ($arr_global_settings['name'] == 'country') {
    echo 'required:"Please enter country."';
} else if ($arr_global_settings['name'] == 'country') {
    echo 'required:"Please enter contact us text."';
}

if ($arr_global_settings['name'] == "site_email" || $arr_global_settings['name'] == "contact_mail") {
    echo ',email:"Please enter a valid email address."';
}
?>
                    }
            },
            submitHandler: function (form) {
            if ((jQuery.trim(jQuery("#cke_1_contents iframe").contents().find("body").html())).length < 12)
            {
            jQuery("#labelProductError").removeClass("hidden");
            jQuery("#labelProductError").show();
            }
            else {
            jQuery("#labelProductError").addClass("hidden");
            }
            form.submit();
            }
    });
    jQuery.validator.addMethod("lettersonly", function(value, element) {
    return this.optional(element) || /^[A-Z]+$/i.test(value);
    }, "");
    CKEDITOR.replace('its_easy',
    {
    filebrowserUploadUrl: '<?php echo base_url(); ?>media/backend/editor-image-upload'
    });
    });</script>
<style>
    .danger {
        color: #BD4247;
    }
    .alert{
        padding:8px 0px;
    }
</style>










<!-- page content -->
<div class="right_col" role="main"> <!-- top tiles -->
    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
                <div class="x_title">
                    <h2>Global Parameter</small></h2>
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
                    <form id="demo-form2" data-parsley-validate="" class="form-horizontal form-label-left" action="<?php echo base_url(); ?>admin/global-settings/edit/<?php echo $edit_id; ?>" method="POST" enctype="multipart/form-data" novalidate="">

                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Parameter Name <span class="required">*</span>
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input type="text" class="form-control col-md-7 col-xs-12" readonly="readonly" name="name" id="name" value="<?php echo $arr_global_settings['name']; ?>">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">Parameter Value <span class="required">*</span>
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <?php if ($arr_global_settings['name'] == "date_format") { ?>
                                    <select name="value" id="value" >
                                        <option <?php if ($arr_global_settings['value'] == "Y-m-d") { ?> selected="selected"<?php } ?> value="Y-m-d"><?php echo date("Y-m-d"); ?></option>
                                        <option <?php if ($arr_global_settings['value'] == "Y/m/d") { ?> selected="selected"<?php } ?> value="Y/m/d"><?php echo date("Y/m/d"); ?></option>
                                        <option <?php if ($arr_global_settings['value'] == "Y-m-d H:i:s") { ?> selected="selected"<?php } ?> value="Y-m-d H:i:s"><?php echo date("Y-m-d H:i:s"); ?></option>
                                        <option <?php if ($arr_global_settings['value'] == "Y/m/d H:i:s") { ?> selected="selected"<?php } ?> value="Y/m/d H:i:s"><?php echo date("Y-m-d H:i:s"); ?></option>
                                        <option <?php if ($arr_global_settings['value'] == "F j, Y, g:i a") { ?> selected="selected"<?php } ?> value="F j, Y, g:i a"><?php echo date("F j, Y, g:i a"); ?></option>
                                        <option <?php if ($arr_global_settings['value'] == "m.d.y") { ?> selected="selected"<?php } ?> value="m.d.y"><?php echo date("m.d.y"); ?></option>
                                    </select>	
                                <?php } else if ($arr_global_settings['name'] == 'site_logo') { ?>
                                    <input type="file" dir="ltr"  class="form-control" name="value" id="value"  /><br>
                                <?php } else if ($arr_global_settings['name'] == 'address') { ?>
                                    <textarea dir="ltr"  class="form-control" name="value" id="value" ><?php echo $arr_global_settings['value']; ?></textarea>
                                <?php } else { ?>
                                    <input type="text" dir="ltr"  class="form-control" name="value" id="value" value="<?php echo $arr_global_settings['value']; ?>" />
                                <?php } ?> 
                            </div>
                        </div>



                        <div class="ln_solid"></div>
                        <div class="form-group">
                            <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                                <button type="submit" class="btn btn-success">Submit</button>
                                <input type="hidden" id="edit_id" name="edit_id" value="<?php echo $edit_id; ?>">
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
<!-- /page content -->