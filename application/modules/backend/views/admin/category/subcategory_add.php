<style>
    .danger, .mandatory {
        color: #BD4247;
    }
    .alert{
        padding:8px 0px;
    }
</style>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/backend/js/jquery.validate.min.js"></script>
<script src="<?php echo base_url(); ?>assets/backend/js/ckeditor/ckeditor.js"></script> 
<script type="text/javascript">
    $(document).ready(function (e) {
        jQuery("#frm_add_subcategory").validate({
            errorClass: 'danger',
            rules: {
                sub_category_name:
                        {
                            required: true,
                            minlength: 3
                        },
                cat_id:
                        {
                            required: true
                        }
            },  
            messages: {
                sub_category_name: {
                    required: "Please enter sub category name.",
                    minlength: "Please enter at least 3 characters."
                },
                cat_id: {
                    required: "Please select category.",
                    minlength: "Please enter at least 3 characters."
                }

            }
        });

    });
</script>
<div class="content-wrapper" style="min-height: 946px; ">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Add Sub Category
        </h1>
        <ol class="breadcrumb">
            <li><a href="<?php echo base_url(); ?>backend/dashboard"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li class="active"><a href="javascript:void(0);">Manage Sub Categories</a></li>
        </ol>
    </section>
    <!-- Main content -->
    <section class="content">
        <div class="row">
            <!-- left column -->

            <!-- right column -->
            <div class="col-md-10">
                <!-- Horizontal Form -->
                <div class="box box-info">
                    <div class="box-header with-border">
                    </div><!-- /.box-header -->
                    <!-- form start -->
                    <form class="form-horizontal" name='frm_add_category'  id='frm_add_subcategory' action="<?php echo base_url() ?>backend/subcategory-add" method="POST">
                        <div class="box-body">
                            <div class="form-group">
                                <label for="inputEmail3" class="col-sm-3 control-label">Category<sup class="mandatory">*</sup> :</label>
                                <div class="col-sm-9">
                                    <select class="form-control" name="cat_id">
                                        <option value="">Select Category</option>
                                        <?php foreach($category_data as $cat_data)
                                        {
                                            echo "<option value=".$cat_data['category_id'].">".$cat_data['category_name']."</option>";
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputEmail3" class="col-sm-3 control-label">Sub Category Name <sup class="mandatory">*</sup> :</label>
                                <div class="col-sm-9">
                                    <input type="text" name="sub_category_name" class="form-control" id="sub_category_name"  placeholder="Enter Subject">
                                </div>
                            </div>
                            <div class="box-footer">
                                <button type="submit" class="btn btn-info pull-right"><i class="fa fa-plus-square"></i> Add</button>
                            </div><!-- /.box-footer -->
                        </div><!-- /.box-body -->

                    </form>
                </div><!-- /.box -->
                <!-- general form elements disabled -->

            </div><!--/.col (right) -->
        </div>   <!-- /.row -->
    </section><!-- /.content -->
</div>
<script>
    function showblock()
    {
        $(".passblock").show();
    }
</script>