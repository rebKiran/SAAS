<script src="<?php echo base_url(); ?>assets/backend/js/select-all-delete.js"></script> 

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Manage Categories
        </h1>
        <ol class="breadcrumb">
            <li><a href="<?php echo base_url(); ?>backend/dashboard"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li class="active"><a href="javascript:void(0);">Manage Sub Categories</a></li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-xs-12">

                <div class="box">
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
                    <div class="box-header">
                        <h3 class="box-title"></h3>
                        <a title="Add New Category " class="btn btn-info pull-right" href="<?php echo base_url(); ?>backend/subcategory-add"><i class="fa fa-plus-circle"></i></a>
                    </div>
                    <form name="frm_newsletter" id="frm_newsletter" action="<?php echo base_url(); ?>backend/subcategory-list" method="post">
                        <div class="box-body">
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th class="workcap">
                                            <input type="checkbox" name="check_all" id="check_all"  class="select_all_button_class" value="select all" />
                                            </center>
                                        </th>
                                        <th>Sub Category Name</th>
                                        <th>Category Name</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    foreach ($subcat_data as $cat) {
                                        ?>
                                        <tr>
                                            <td>
                                    <center>
                                        <input name="checkbox[]" class="case" type="checkbox" id="checkbox[]" value="<?php echo $cat['sub_category_id']; ?>" />        
                                    </center>
                                    </td>
                                    <td><?php echo $cat['sub_category_name']; ?></td>
                                    <td><?php echo $cat['category_name']; ?></td>
                                    <td><a title="Edit Sub Category Details" href="<?php echo base_url(); ?>backend/subcategory-edit/<?php echo $cat['sub_category_id']; ?>" class="btn btn-info"><i class="fa fa-edit"></i></a></td>
                                    </td>
                                    </tr>
                                    <?php
                                }
                                ?>
                                </tbody>
                            </table>
                            <?php if (count($subcat_data) > 0) { ?>
                                <input type="submit" id="btn_delete_all" name="btn_delete_all" class="btn btn-danger" onClick="return deleteConfirm();"  value=" Delete Selected">
<?php } ?>
                        </div>
                    </form>
                </div><!-- /.box -->
            </div><!-- /.col -->
        </div><!-- /.row -->
    </section><!-- /.content -->
</div><!-- /.content-wrapper -->