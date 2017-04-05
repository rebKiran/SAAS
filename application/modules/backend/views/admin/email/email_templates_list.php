<script type="text/javascript">

    function changeBlogStatus(post_id, post_status)
    {
        /* changing the user status*/
        var obj_params = new Object();
        obj_params.post_id = post_id;
        obj_params.post_status = post_status;
        jQuery.post("<?php echo base_url(); ?>admin/blog/change-status", obj_params, function (msg) {
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
                <h2>Email Template List</h2>
                
                <div class="clearfix"></div>
            </div>
            <div class="x_content">
              
                            
                                    <table id="datatable-responsive" class="table table-striped table-bordered dt-responsive nowrap" >
                                <thead>
                            <tr>
                                <th class="workcap">
                        <center><br>
                            <input type="checkbox" name="check_all" id="check_all"  class="select_all_button_class" value="select all" />
                        </center>
                        </th>
                        <th>Title</th>
                        <th>Subject</th>
                        <th>Created On</th>
                        <th>Updated On</th>
                        <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                            <?php
                            foreach ($arr_email_templates as $email) {
                                ?>
                                <tr>
                                    <td>
                            <center>
                                <input name="checkbox[]" class="case" type="checkbox" id="checkbox[]" value="<?php echo $email['email_template_id']; ?>" />        
                            </center>
                            </td>
                            <td><?php echo $email['email_template_title']; ?></td>
                            <td><?php echo $email['email_template_subject']; ?></td>

                            <td><?php echo date($global['date_format'], strtotime($email['date_created'])); ?></td>
                            <td><?php echo date($global['date_format'], strtotime($email['date_updated'])); ?></td>
                            <td>
                                <a title="Edit Newsletter Details" href="<?php echo base_url(); ?>admin/edit-email-template/<?php echo $email['email_template_id']; ?>" class="btn btn-info btn-xs"><i class="fa fa-edit"></i>Edit</a> 

                            </td>
                            </tr>
                            <?php
                        }
                        ?>
                        </tbody>
                            </table>
                            <?php // if (!empty($blog_posts)) { ?>
                                <!--<input type="submit" id="btn_delete_all" name="btn_delete_all" class="btn btn-danger" onClick="return deleteConfirm();"  value=" Delete Selected">-->
                            <?php //} ?>


            </div>
        </div>
    </div>
</div>
<!-- /page content -->