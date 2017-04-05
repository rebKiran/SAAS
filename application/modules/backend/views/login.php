<!DOCTYPE html>
<html lang="en">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <!-- Meta, title, CSS, favicons, etc. -->
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Login | Silo </title>

        <!-- Bootstrap -->
        <link href="<?php echo backend_asset_url() ?>/vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
        <!-- Font Awesome -->
        <link href="<?php echo backend_asset_url() ?>/vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">
        <!-- NProgress -->
        <link href="<?php echo backend_asset_url() ?>/vendors/nprogress/nprogress.css" rel="stylesheet">
        <!-- Animate.css -->
        <link href="<?php echo backend_asset_url() ?>/vendors/animate.css/animate.min.css" rel="stylesheet">

        <!-- Custom Theme Style -->
        <link href="<?php echo backend_asset_url() ?>/build/css/custom.min.css" rel="stylesheet">

        <!-- PNotify -->
        <link href="<?php echo backend_asset_url() ?>/vendors/pnotify/dist/pnotify.css" rel="stylesheet">
        <link href="<?php echo backend_asset_url() ?>/vendors/pnotify/dist/pnotify.buttons.css" rel="stylesheet">
        <link href="<?php echo backend_asset_url() ?>/vendors/pnotify/dist/pnotify.nonblock.css" rel="stylesheet">
    </head>

    <body class="login">
        <div>
            <a class="hiddenanchor" id="signup"></a>
            <a class="hiddenanchor" id="signin"></a>

            <div class="login_wrapper">
                <div class="animate form login_form">
                    <section class="login_content">
                        <?php if ($this->session->userdata('msg')!='') { ?> 
                            <div class="alert alert-danger alert-dismissible fade in" role="alert">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">x</span>
                                </button>
                                <?php echo $this->session->userdata('msg'); ?>
                            </div>
                        <?php } ?>
                        <form novalidate method="POST" action="<?php echo base_url() ?>submitlogin">
                            <h1>Login Form</h1>
                            <div>
                                <input type="text" name="user_name" class="form-control" placeholder="Username" required="" />
                            </div>
                            <div>
                                <input type="password" name="user_password" class="form-control" placeholder="Password" required="" />
                            </div>
                            <div>
                                <button id="send" type="submit" class="btn btn-success">Login</button>
                                <a class="reset_pass" href="#">Lost your password?</a>
                            </div>

                            <div class="clearfix"></div>

                            <div class="separator">
                                <p class="change_link">New to site?
                                    <a href="#signup" class="to_register"> Create Account </a>
                                </p>

                                <div class="clearfix"></div>
                                <br />

                               
                            </div>
                        </form>
                    </section>
                </div>

                <div id="register" class="animate form registration_form">
                    <section class="login_content">
                        <?php if ($this->session->userdata('msg')!='') { ?> 
                            <div class="alert alert-danger alert-dismissible fade in" role="alert">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">x</span>
                                </button>
                                <?php echo $this->session->userdata('msg'); ?>
                            </div>
                        <?php } ?>
                        <form novalidate action="<?php echo base_url() ?>register/employee" method="post">
                            <h1>Create Account</h1>
                            <div>
                                <input type="text" name="username" class="form-control" placeholder="Username" required="" />
                            </div>
                            <div>
                                <input type="email" name="email" class="form-control" placeholder="Email" required="" />
                            </div>
                            <div>
                                <input type="password" name="password" class="form-control" placeholder="Password" required="" />
                            </div>
                            <div>
                                <!--<a class="btn btn-default submit" href="index.html">Submit</a>-->
                                <button id="send" type="submit" class="btn btn-success">Submit</button>
                            </div>

                            <div class="clearfix"></div>

                            <div class="separator">
                                <p class="change_link">Already a member ?
                                    <a href="#signin" class="to_register"> Log in </a>
                                </p>

                                <div class="clearfix"></div>
                                <br />

                                <div>
                                    <h1><i class="fa fa-paw"></i> Gentelella Alela!</h1>
                                    <p>©2016 All Rights Reserved. Gentelella Alela! is a Bootstrap 3 template. Privacy and Terms</p>
                                </div>
                            </div>
                        </form>
                    </section>
                </div>
            </div>
        </div>
    </body>
    <!-- PNotify -->
    <!-- jQuery -->
    <script src="<?php echo backend_asset_url() ?>/vendors/jquery/dist/jquery.min.js"></script>
    <script src="<?php echo backend_asset_url() ?>/vendors/pnotify/dist/pnotify.js"></script>
    <script src="<?php echo backend_asset_url() ?>/vendors/pnotify/dist/pnotify.buttons.js"></script>
    <script src="<?php echo backend_asset_url() ?>/vendors/pnotify/dist/pnotify.nonblock.js"></script>
</html>
