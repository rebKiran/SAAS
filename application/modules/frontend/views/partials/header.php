<?php
$session_data = $this->session->userdata('user_account');
$this->load->library('cart');
$cartdata = $this->cart->contents();


//die;
?>


<!-- BEGIN: HEADER -->
<header class="c-layout-header c-layout-header-6 c-navbar-fluid">
    <div class="c-topbar">
        <div class="container">
            <nav class="c-top-menu">
                <ul class="c-icons c-theme-ul">
                    <li>
                        <a href="#"><i class="icon-social-twitter"></i></a>
                    </li>
                    <li>
                        <a href="#"><i class="icon-social-facebook"></i></a>
                    </li>
                    <li>
                        <a href="#"><i class="icon-social-dribbble"></i></a>
                    </li>
                    <?php if (!empty($this->session->userdata('user_account'))) { ?>

                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-user"></i>Welcome, <?php echo ucfirst($session_data['username']) ?></a>
                            <ul class="dropdown-menu top-arrow" style="padding-bottom: 0;padding-top: 0;border-top: 3px solid #32c5d2;">
                                <li><a style="padding: 8px 20px;" href="<?php echo base_url()?>user/dashboard">Dashboard </a></li>
                                <li class="divider" style="margin: 0;"></li>
                                <li><a style="border-radius: 3px;padding: 8px 20px;" href="<?php echo base_url()?>logout">Sign Out <span class="glyphicon glyphicon-log-out pull-right"></span></a></li>
                            </ul>
                        </li>
                        <li>


                            <ul class="dropdown-menu">
                                <li><a href="#">Account Settings <span class="glyphicon glyphicon-cog pull-right"></span></a></li>
                                <li class="divider"></li>
                                <li><a href="#">User stats <span class="glyphicon glyphicon-stats pull-right"></span></a></li>
                                <li class="divider"></li>
                                <li><a href="#">Messages <span class="badge pull-right"> 42 </span></a></li>
                                <li class="divider"></li>
                                <li><a href="#">Favourites Snippets <span class="glyphicon glyphicon-heart pull-right"></span></a></li>
                                <li class="divider"></li>
                                <li><a href="#">Sign Out <span class="glyphicon glyphicon-log-out pull-right"></span></a></li>
                            </ul>


                        <?php } else { ?>
                        <li>
                            <a href="javascript:;" data-toggle="modal" data-target="#login-form" class="btn c-theme-btn c-btn-square c-btn-uppercase c-btn-bold">Sign In</a>
                        </li>
                    <?php } ?>
                </ul>

            </nav>
            <div class="c-brand">
                <a href="index.html" class="c-logo">
                    <img src="<?php echo frontend_asset_url() ?>assets/base/img/layout/logos/LOGO_SA.png" alt="SA" class="c-desktop-logo">
                    <img src="<?php echo frontend_asset_url() ?>assets/base/img/layout/logos/LOGO_SA.png" alt="SA" class="c-desktop-logo-inverse">
                    <img src="<?php echo frontend_asset_url() ?>assets/base/img/layout/logos/LOGO_SA.png" alt="SA" class="c-mobile-logo">
                </a>

                <button class="c-hor-nav-toggler" type="button" data-target=".c-mega-menu">
                    <span class="c-line"></span>
                    <span class="c-line"></span>
                    <span class="c-line"></span>
                </button>
                <button class="c-search-toggler" type="button">
                    <i class="fa fa-search"></i>
                </button>
            </div>
        </div>
    </div>
    <div class="c-navbar">
        <div class="container">
            <!-- BEGIN: BRAND -->
            <div class="c-navbar-wrapper clearfix">
                <!-- END: BRAND -->
                <!-- BEGIN: QUICK SEARCH -->
                <form class="c-quick-search" action="#">
                    <input type="text" name="query" placeholder="Type to search..." value="" class="form-control" autocomplete="off">
                    <span class="c-theme-link">&times;</span>
                </form>
                <!-- END: QUICK SEARCH -->
                <!-- BEGIN: HOR NAV -->
                <!-- BEGIN: LAYOUT/HEADERS/MEGA-MENU -->
                <!-- BEGIN: MEGA MENU -->
                <nav class="c-mega-menu c-pull-right c-mega-menu-dark c-mega-menu-dark-mobile c-fonts-uppercase c-fonts-bold">
                    <!-- BEGIN: MEGA MENU -->
                    <ul class="nav navbar-nav c-theme-nav">
                        <li class="c-menu-type-classic">
                            <a href="<?php echo base_url() ?>" class="c-link">Home</a>
                        </li>

                        <li>
                            <a href="<?php echo base_url() ?>about-us" class="c-link"> About Us</a>
                        </li>

                        <li class="c-menu-type-classic">
                            <a href="<?php echo base_url() ?>management-page" class="c-link dropdown-toggle"> Management Consulting</a>
                            <ul class="dropdown-menu c-menu-type-classic c-pull-left">
                                <li>
                                    <a href="<?php echo base_url() ?>management-expertise">Our Expertise</a>
                                </li>
                                <li>
                                    <a href="<?php echo base_url() ?>management-industry">Industry Focus</a>
                                </li>
                                <!--li>
                                        <a href="<?php echo base_url() ?>management-sucess-story">Success Stories</a>
                                </li>
                                <li>
                                        <a href="#">Careers</a>
                                </li-->
                            </ul>
                        </li>
                        <li class="c-menu-type-classic">
                            <a href="<?php echo base_url() ?>engineering-page" class="c-link"> Engineering Consulting</a>
                            <ul class="dropdown-menu c-menu-type-classic c-pull-left">
                                <li>
                                    <a href="<?php echo base_url() ?>engineering-expertise">Our Expertise</a>
                                </li>
                                <li>
                                    <a href="<?php echo base_url() ?>engineering-industry">Industry Focus</a>
                                </li>
                                <li>
                                    <a href="<?php echo base_url() ?>engineering-sucess-story">Success Stories</a>
                                </li>
                                <!--li>
                                        <a href="#">Careers</a>
                                </li-->
                            </ul>
                        </li>

                        <li class="c-menu-type-classic">
                            <a href="<?php echo base_url() ?>research-page" class="c-link"> Publications</a>
                        </li>
                        <li>
                            <a href="<?php echo base_url() ?>fundraiser/" class="c-link"> Fundraiser</a>
                        </li>
                        <li>
                            <a href="<?php echo base_url() ?>blog" class="c-link"> Blogs</a>
                        </li>

                        <li>
                            <a href="<?php echo base_url() ?>contact-us" class="c-link"> Contact Us</a>
                        </li>
                        <!-- class="c-quick-sidebar-toggler-wrapper">
                                <a href="#" class="c-quick-sidebar-toggler">
                                <span class="c-line"></span>
                                <span class="c-line"></span>
                                <span class="c-line"></span>
                                </a>
                        </li-->
                        <!--				<li class="c-search-toggler-wrapper">
                                                                <a href="#" class="c-btn-icon c-search-toggler"><i class="fa fa-search"></i></a>
                                                        </li>-->
                        <li class="c-cart-toggler-wrapper">
                            <a href="<?php echo base_url() . 'cart'; ?>" style="padding:15px 0" class="c-btn-icon c-cart-toggler">
                                <i class="icon-handbag c-cart-icon"></i>
                                <span class="c-cart-number c-theme-bg"><?php
                                    if (isset($cartdata)) {
                                        echo count($cartdata);
                                    }
                                    ?></span>
                            </a>
                        </li>
                    </ul>
                    <!-- END MEGA MENU -->
                </nav>
                <!-- END: MEGA MENU -->
                <!-- END: LAYOUT/HEADERS/MEGA-MENU -->
                <!-- END: HOR NAV -->
            </div>
        </div>
    </div>
</header>
<!-- END: HEADER -->

