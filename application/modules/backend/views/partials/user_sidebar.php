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
                    <li><a href="<?php echo base_url() ?>user/dashboard"><i class="fa fa-home"></i> Dashboard </a>

                    </li>
                    <li><a href="<?php echo base_url() ?>user/order-list"><i class="fa fa-globe"></i> My Purchase </a>

                    </li>
                    <li><a href="<?php echo base_url() ?>user/download-paper"><i class="fa fa-globe"></i> Download Research Papers</a>

                    </li>

                    <li>
                        <a><i class="fa fa-table"></i> My Projects<span class="fa fa-chevron-down"></span></a>
                        <ul class="nav child_menu">
                            <li><a href="<?php echo base_url() ?>user/add-project">Add New Project</a></li>
                            <li><a href="<?php echo base_url() ?>user/project-list">Project List</a></li>
                            
                        </ul>
                    </li>
                    </li>
                   
                    <li><a href="<?php echo base_url() ?>user/donation-list"><i class="fa fa-globe"></i> Funded Projects </a>



                    </li> 
                    <li><a href="<?php echo base_url() ?>user/connected-projects"><i class="fa fa-folder"></i>Connected Projects</a></li>

                    <li>
                        <a><i class="fa fa-table"></i> Reports<span class="fa fa-chevron-down"></span></a>
                        <ul class="nav child_menu">
                            <li><a href="<?php echo base_url() ?>#">Report 1</a></li>
                            <li><a href="<?php echo base_url() ?>#">Report 2</a></li>
                        </ul>
                    </li>
                    <li><a href="<?php echo base_url() ?>#"><i class="fa fa-gear"></i> Setting </a>

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