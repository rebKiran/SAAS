<style>
    .danger, .mandatory {
        color: #BD4247;
    }
    .alert{
        padding:8px 0px;
    }
</style>
<script type="text/javascript" language="javascript">

    jQuery(document).ready(function () {

        jQuery("#frmComment").validate({
            errorClass: 'danger',
            rules: {
                inputComment: {
                    required: true,
                    minlength: 3
                }
            },
            messages: {
                inputComment: {
                    required: "Please enter title for post comment",
                    minlength: "Please enter at least 3 characters"
                }
            },
            success: function (label) {
                label.hide();
            }
        });

    });
</script>

<script>
    function showblock()
    {
        $(".passblock").show();
    }
</script>
<style>
    .danger, .mandatory {
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
                    <h2>Edit Blog Comments</h2>
                    <ul class="nav navbar-right panel_toolbox">
                        <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                        </li>
                        <li class="dropdown">
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
                    <form id="demo-form2" data-parsley-validate="" class="form-horizontal form-label-left" action="<?php echo base_url(); ?>admin/blog/edit-post-comment/<?php echo $post_id; ?>/<?php echo $comment_id ?>" method="POST">
                        <input type="hidden" name="edit_id" value="<?php echo $post_id; ?>" id="edit_id" />
                        <input type="hidden" name="email_template_hidden_id" id="email_template_hidden_id" value="<?php echo(isset($email_template_id)) ? $email_template_id : ''; ?>">
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Comment <span class="required">*</span>
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <textarea name="inputComment" class="form-control" ><?php echo stripcslashes($arr_post_comment_info["comment"]); ?></textarea>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Status <span class="required">*</span>
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <select name="inputPublishStatus" class="form-control" autocomplete="off">
                                    <option <?php if ($arr_post_comment_info['status'] == "0") echo 'selected="selected"'; ?> value="0">Unpublished</option>
                                    <option <?php if ($arr_post_comment_info['status'] == "1") echo 'selected="selected"'; ?> value="1">Published</option>
                                </select>
                            </div>
                        </div>






                        <div class="ln_solid"></div>
                        <div class="form-group">
                            <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                                <button type="submit" class="btn btn-info pull-right"><i class="fa fa-edit"></i> Edit</button>
                                <input type="hidden" name="post_id" value="<?php echo $post_id; ?>">
                                <input type="hidden" name="comment_id" value="<?php echo $comment_id; ?>">

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