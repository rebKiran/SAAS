<script src="<?php echo base_url(); ?>assets/backend/js/select-all-delete.js"></script> 
<script type="text/javascript">

    function changeBlogStatus(post_id, post_status)
    {
        /* changing the user status*/
        var obj_params = new Object();
        obj_params.post_id = post_id;
        obj_params.post_status = post_status;
        jQuery.post("<?php echo base_url(); ?>backend/blog/change-status", obj_params, function (msg) {
            if (msg.error == "1")
            {
                alert(msg.error_message);
            } else
            {
                /* togling the Active and Inactive div of user*/
                if (post_status == '0')
                {
                    $("#inactive_div" + post_id).css('display', 'inline-block');
                    $("#active_div" + post_id).css('display', 'none');
                } else
                {
                    $("#active_div" + post_id).css('display', 'inline-block');
                    $("#inactive_div" + post_id).css('display', 'none');
                }
            }
        }, "json");
    }
</script>

<script>
    function confirmDeletion(id)
    {
        if (confirm("Are you sure to delete this comment?"))
        {
            var objParams = new Object();
            objParams.comment_id = id;
            jQuery.post("<?php echo base_url(); ?>backend/blog/delete-post-comment", objParams, function (msg) {
                if (msg.error == "1")
                {
                    alert(msg.errorMessage);
                } else
                {
                    alert("Your request has been completed successfully!");
                    location.href = location.href;
                }
            }, "json");
        }
    }

    jQuery("#chkAll").bind("click", function () {
        if (jQuery(this).is(":checked"))
        {
            jQuery(".chkselect").attr("checked", "checked");
        } else
        {
            jQuery(".chkselect").removeAttr("checked");
        }
    });

    jQuery(".chkselect").bind("click", function () {
        updateSelectAll();
    });

    function updateSelectAll()
    {
        var totChecked = jQuery(".chkselect:checked").length;
        var totCheckboxes = jQuery(".chkselect").length;

        if (totChecked < totCheckboxes)
        {
            jQuery("#chkAll").removeAttr("checked");
        } else
        {
            jQuery("#chkAll").attr("checked", "checked");
        }

    }

    jQuery("#btnDeleteAll").bind("click", function () {

        if (jQuery(".chkselect:checked").length < 1)
        {
            alert("Please select atleast one comment to delete");
            return;
        }

        if (confirm("Are you sure to delete these comments?"))
        {
            var arrPostIds = [];

            jQuery(".chkselect").each(function (index, element) {

                if (jQuery(element).is(":checked"))
                    arrPostIds.push(jQuery(element).val());

            });

            var objParams = new Object();
            objParams.comment_ids = arrPostIds;

            jQuery.post("<?php echo base_url(); ?>backend/blog/delete-post-comment", objParams, function (msg) {
                if (msg.error == "1")
                {
                    alert(msg.errorMessage);
                } else
                {
                    alert("Your request has been completed successfully!");
                    location.href = location.href;
                }
            }, "json");
        }
    });
</script>




















<!-- page content -->
<div class="right_col" role="main">

    <!-- /top tiles -->


    <br />



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
    <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
            <div class="x_title">
                <h2>Responsive example<small>Users</small></h2>
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
                <a title="Add new blog post" class="btn btn-info pull-right" href="<?php echo base_url(); ?>admin/blog/add-post"><i class="fa fa-plus-circle"></i></a>		
                <table id="datatable-responsive" class="table table-striped table-bordered dt-responsive nowrap dataTable no-footer dtr-inline" cellspacing="0" width="100%" role="grid" aria-describedby="datatable-responsive_info" style="width: 100%;">
                                <thead>
                                    <tr role="row">
                                        <th>Comment By</th>
                                        <th>Comment</th>
                                        <th>Comment On</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                        
                                    </tr>

                                </thead>
                                <tbody>
                                    <?php
                                    $cnt = 0;
                                    foreach ($arr_post_comments as $comment) {
                                        $cnt++;
                                        ?>
                                        <tr>
                                            
                                    <td>
                                        <?php
                                        if ($comment['user_details'][0]['username'] != '') {
                                            echo $comment['user_details'][0]['username'];
                                        } else {
                                            echo $comment['user_details'][0]['username'];
                                        }
                                        ?>
                                    </td>
                                    <td>
                                        <?php
                                        if (strlen($comment['comment'] > 100)) {
                                            echo substr(stripcslashes(nl2br($comment['comment'])), 0, 100) . "...";
                                        } else {
                                            echo stripcslashes(nl2br($comment['comment']));
                                        }
                                        ?>
                                    </td>
                                    <td>
                                        <?php echo date("d<\s\up>S</\s\up> M Y<b\\r>h:i A", strtotime($comment['comment_on'])); ?>
                                    </td>
                                    <td>
                                        <?php
                                        if ($comment['status'] == "0")
                                            echo "Unpublished";
                                        elseif ($comment['status'] == "1")
                                            echo "Published";elseif ($comment['status'] == "2")
                                            echo "Removed";
                                        ?>
                                    </td>
                                    <td>
                                        <a class="btn btn-info" href="<?php echo base_url(); ?>admin/blog/edit-post-comment/<?php echo $comment['post_id']; ?>/<?php echo $comment['comment_id']; ?>">
                                            <i class="fa fa-edit"></i> Edit</a>
                                           <!-- <a class="btn btn-danger" href="javascript:void(0);" onClick="confirmDeletion('<?php echo $comment['comment_id']; ?>')">
                                            <i class="icon-remove icon-white"></i> Delete</a> -->
                                    </td>
                                    </tr>
                                <?php }
                                ?>
                                </tbody>
                            </table>
                            <th colspan="6">
                                <?php if (!empty($comment)) { ?>
                                    <input type="submit" id="btn_delete_all" name="btn_delete_all" class="btn btn-danger" onClick="return deleteConfirm();"  value=" Delete Selected">
                                <?php } ?>
                            </th>
            </div>
            </div>
            </div>
            </div>
            <!-- /page content -->