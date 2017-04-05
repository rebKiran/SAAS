<?php $session_data = $this->session->userdata('user_account'); ?>
<div class="col-md-3 left_col menu_fixed">
    <div class="left_col scroll-view">
        <div class="navbar nav_title" style="border: 0;">
            <a href="index.html" class="site_title"><i class="fa fa-paw"></i> <span>Gentelella Alela!</span></a>
        </div>

        <div class="clearfix"></div>

        <!-- menu profile quick info -->
        <div class="profile clearfix">
            <div class="profile_pic">
                <img src="<?php echo backend_asset_url() ?>images/img.jpg" alt="" class="img-circle profile_img">
            </div>
            <div class="profile_info">
                <span>Welcome,</span>
                <h2><?php echo ucfirst($session_data['username']) ?></h2>
            </div>
        </div>
        <!-- /menu profile quick info -->

        <br />

        <!-- sidebar menu -->
        <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
            <div class="menu_section">
                <h3>General</h3>
                <ul class="nav side-menu">
                    <li><a href="<?php echo base_url() ?>admin/dashboard"><i class="fa fa-home"></i> Dashboard </a>

                    </li>
                    <li><a href="<?php echo base_url() ?>admin/global-setting"><i class="fa fa-globe"></i> Global Setting </a>

                    </li>
                    <li><a href="<?php echo base_url() ?>admin/blog"><i class="fa fa-globe"></i> Manage Blogs </a>

                    </li>
                     
                    <li>
                        <a><i class="fa fa-table"></i> Manage Products<span class="fa fa-chevron-down"></span></a>
                        <ul class="nav child_menu">
                            <li><a href="<?php echo base_url() ?>admin/product-list">Product List</a></li>
                            <li><a href="<?php echo base_url() ?>admin/add-product">Add Product</a></li>
                        </ul>
                    </li>
                    <li><a><i class="fa fa-table"></i> Product categories <span class="fa fa-chevron-down"></span></a>
                        <ul class="nav child_menu">
                            <li><a href="<?php echo base_url() ?>admin/product-category-list">Category</a></li>
                        </ul>
                    </li>





                </ul>
            </div>


        </div>
        <!-- /sidebar menu -->

        <!-- /menu footer buttons -->
        <div class="sidebar-footer hidden-small">
            <a data-toggle="tooltip" data-placement="top" title="Settings">
                <span class="glyphicon glyphicon-cog" aria-hidden="true"></span>
            </a>
            <a data-toggle="tooltip" data-placement="top" title="FullScreen">
                <span class="glyphicon glyphicon-fullscreen" aria-hidden="true"></span>
            </a>
            <a data-toggle="tooltip" data-placement="top" title="Lock">
                <span class="glyphicon glyphicon-eye-close" aria-hidden="true"></span>
            </a>
            <a data-toggle="tooltip" data-placement="top" title="Logout" href="login.html">
                <span class="glyphicon glyphicon-off" aria-hidden="true"></span>
            </a>
        </div>
        <!-- /menu footer buttons -->
    </div>
</div>