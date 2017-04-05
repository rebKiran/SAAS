<div class="c-layout-page">
    <!-- BEGIN: LAYOUT/BREADCRUMBS/BREADCRUMBS-3 -->
    <div class="c-layout-breadcrumbs-1 c-bgimage c-subtitle c-fonts-uppercase c-fonts-bold c-bg-img-center" >
        <div class="container wrapper">
            <div class="row cart-head">
                <div class="container">
                    <div class="row">
                        <p></p>
                    </div>

                    <div class="row">
                        <p></p>
                    </div>
                </div>
            </div>    
            <div class="row cart-body">
                <form class="form-horizontal" method="post" action="<?php echo base_url() ?>frontend/Cart/placeOrder">
                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 col-md-push-6 col-sm-push-6">
                        <!--REVIEW ORDER-->
                        <div class="panel panel-info">
                            <div class="panel-heading">
                                Review Order <div class="pull-right"></div>
                            </div>
                            <div class="panel-body">
                                <?php
                                $total = 0;
                                if(!empty($cart_data)){
                                foreach ($cart_data as $cart) {
                                    $price = $cart['price'] * $cart['qty'];
                                    $total = $price + $total;
                                    ?>
                                    <div class="form-group">
                                        <div class="col-sm-3 col-xs-3">
                                            <img class="img-responsive" width="60" src="<?php echo $cart['options']['product_img'] ?>" />
                                        </div>
                                        <div class="col-sm-6 col-xs-6">
                                            <div class="col-xs-12"><?php echo $cart['name'] ?></div>
                                        </div>
                                        <div class="col-sm-3 col-xs-3 text-right">
                                            <h3><span>$</span><?php echo $price ?></h3>
                                        </div>
                                    </div>
                                <?php } } else { echo "<b>Your cart is empty</b>";}?>
                                <div class="form-group"><hr /></div>
                                <div class="form-group">
                                    <div class="col-xs-12">
                                        <strong>Order Total</strong>
                                        <div class="pull-right"><span>$</span><span><?php echo $total; ?></span></div>
                                    </div>
                                </div>
                                <div class="form-group"><hr /></div>
                                <div class="form-group pull-right">
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <?php
                                        if ($this->session->userdata('user_account') == "") {
                                            echo '<button type="button" data-toggle="modal" data-target="#checkout-signup-form" class="btn btn-primary btn-submit-fix">Place Order</button>';
                                        } else if (empty($this->cart->contents())) {
                                            echo '<a href="'.base_url().'research-page" class="btn btn-primary btn-submit-fix">Continue Shopping</a>';
                                        } else {
                                            echo '<button type="submit" class="btn btn-primary btn-submit-fix">Place Order</button>';
                                        }
                                        ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!--REVIEW ORDER END-->
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 col-md-pull-6 col-sm-pull-6">
                        <!--SHIPPING METHOD-->
                        <div class="panel panel-info">
                            <div class="panel-heading">Address</div>
                            <div class="panel-body">
                                <div class="form-group">
                                    <div class="col-md-12">
                                        <h4>Shipping Address</h4>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-md-6 col-xs-12">
                                        <strong>First Name:</strong>
                                        <input type="text" name="first_name" class="form-control" value="" />
                                    </div>
                                    <div class="span1"></div>
                                    <div class="col-md-6 col-xs-12">
                                        <strong>Last Name:</strong>
                                        <input type="text" name="last_name" class="form-control" value="" />
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-md-12"><strong>Address:</strong></div>
                                    <div class="col-md-12">
                                        <input type="text" name="address" class="form-control" value="" />
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-md-12"><strong>State:</strong></div>
                                    <div class="col-md-12">
                                        <select id="state_dropdown" onchange="selectCity(this.options[this.selectedIndex].value)" class="form-control" name="state">
                                            <option value="">Select State</option>
                                            <?php foreach ($list as $state) { ?>
                                                <option value="<?php echo $state['id'] ?>"><?php echo $state['name'] ?></option>
<?php } ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-md-12"><strong>City:</strong></div>
                                    <div class="col-md-12">
                                        <select required="required" name="city" class="form-control" id="city_dropdown">
                                            <option value="">Select City</option>
                                        </select>
                                    </div>
                                </div>                            
                                <div class="form-group">
                                    <div class="col-md-12"><strong>Zip / Postal Code:</strong></div>
                                    <div class="col-md-12">
                                        <input type="text" name="zipcode" class="form-control" value="" />
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-md-12"><strong>Phone Number:</strong></div>
                                    <div class="col-md-12"><input type="text" name="phone" class="form-control" value="" /></div>
                                </div>
                                <div class="form-group">
                                    <div class="col-md-12"><strong>Email Address:</strong></div>
                                    <div class="col-md-12"><input type="text" name="email" class="form-control" value="" /></div>
                                </div>
                            </div>
                        </div>
                        <!--SHIPPING METHOD END-->

                        <!--CREDIT CART PAYMENT END-->
                    </div>

                </form>
            </div>
            <div class="row cart-footer">

            </div>
        </div>
    </div>
    <!-- END: LAYOUT/BREADCRUMBS/BREADCRUMBS-3 -->
    <!-- BEGIN: CONTENT/SHOPS/SHOP-PRODUCT-DETAILS-2 -->

    <!-- END: CONTENT/SHOPS/SHOP-PRODUCT-DETAILS-2 -->
    <!-- BEGIN: CONTENT/SHOPS/SHOP-PRODUCT-TAB-1 -->

    <!-- END: CONTENT/SHOPS/SHOP-PRODUCT-TAB-1 -->
    <!-- BEGIN: CONTENT/USER/FORGET-PASSWORD-FORM -->
    <div class="modal fade c-content-login-form" id="forget-password-form" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content c-square">
                <div class="modal-header c-no-border">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                </div>
                <div class="modal-body">
                    <h3 class="c-font-24 c-font-sbold">Password Recovery</h3>
                    <p>
                        To recover your password please fill in your email address
                    </p>
                    <form>
                        <div class="form-group">
                            <label for="forget-email" class="hide">Email</label>
                            <input type="email" class="form-control input-lg c-square" id="forget-email" placeholder="Email">
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn c-theme-btn btn-md c-btn-uppercase c-btn-bold c-btn-square c-btn-login">Submit</button>
                            <a href="javascript:;" class="c-btn-forgot" data-toggle="modal" data-target="#login-form" data-dismiss="modal">Back To Login</a>
                        </div>
                    </form>
                </div>
                <div class="modal-footer c-no-border">
                    <span class="c-text-account">Don't Have An Account Yet ?</span>
                    <a href="javascript:;" data-toggle="modal" data-target="#signup-form" data-dismiss="modal" class="btn c-btn-dark-1 btn c-btn-uppercase c-btn-bold c-btn-slim c-btn-border-2x c-btn-square c-btn-signup">Signup!</a>
                </div>
            </div>
        </div>
    </div>
    <!-- END: CONTENT/USER/FORGET-PASSWORD-FORM -->
    <!-- BEGIN: CONTENT/USER/SIGNUP-FORM -->
    <div class="modal fade c-content-login-form" id="checkout-signup-form" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content c-square">
                <div class="modal-header c-no-border">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                </div>

                <div class="modal-body">
                    <span class="submit_status"></span>
                    <h3 class="c-font-24 c-font-sbold">Create An Account</h3>
                    <p>
                        Please fill in below form to create an account before payment
                    </p>
                    <form metho="post" id="frm_checkout_signup" action="<?php echo base_url() ?>frontend/cart/signup">
                        <div class="form-group">
                            <label for="signup-email" class="hide">Email</label>
                            <input type="email" name="email" required class="form-control input-lg c-square" id="signup-email" placeholder="Email">
                        </div>
                        <div class="form-group">
                            <label for="signup-username" class="hide">Username</label>
                            <input type="text" name="username" required class="form-control input-lg c-square" id="signup-username" placeholder="Username">
                        </div>
                        <div class="form-group">
                            <label for="signup-fullname" class="hide">Password</label>
                            <input type="password" required name="password" class="form-control input-lg c-square" id="signup-fullname" placeholder="Fullname">
                        </div>

                        <div class="form-group">
                            <button type="button" id="checkout_signup" class="btn c-theme-btn btn-md c-btn-uppercase c-btn-bold c-btn-square c-btn-login">Signup</button>
                            <a href="javascript:;" class="c-btn-forgot" data-toggle="modal" data-target="#checkout-login-form" data-dismiss="modal">Back To Login</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- END: CONTENT/USER/SIGNUP-FORM -->
    <!-- BEGIN: CONTENT/USER/LOGIN-FORM -->
    <div class="modal fade c-content-login-form" id="checkout-login-form" role="dialog">
        <div class="modal-dialog">

            <div class="modal-content c-square">
                <div class="modal-header c-no-border">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                </div>

                <div class="modal-body">
                    <span class="submit_status"></span>
                    <h3 class="c-font-24 c-font-sbold">Good Afternoon!</h3>
                    <p>
                        Let's make today a great day!
                    </p>
                    <form id="frm_checkout_login" method="POST">
                        <div class="form-group">
                            <label for="login-email" class="hide">Email</label>
                            <input type="text" name="user_name" class="form-control input-lg c-square" id="login-email" placeholder="Email">
                        </div>
                        <div class="form-group">
                            <label for="login-password" class="hide">Password</label>
                            <input type="password" name="user_password" class="form-control input-lg c-square" id="login-password" placeholder="Password">
                        </div>
                        <div class="form-group">
                            <div class="c-checkbox">
                                <input type="checkbox" id="login-rememberme" class="c-check">
                                <label for="login-rememberme" class="c-font-thin c-font-17">
                                    <span></span>
                                    <span class="check"></span>
                                    <span class="box"></span>
                                    Remember Me </label>
                            </div>
                        </div>
                        <div class="form-group">
                            <button type="button" id="checkout_login" class="btn c-theme-btn btn-md c-btn-uppercase c-btn-bold c-btn-square c-btn-login">Login</button>
                            <a href="javascript:;" data-toggle="modal" data-target="#forget-password-form" data-dismiss="modal" class="c-btn-forgot">Forgot Your Password ?</a>
                        </div>
                        <div class="clearfix">
                            <div class="c-content-divider c-divider-sm c-icon-bg c-bg-grey c-margin-b-20">
                                <span style="width: 110px">or signup with</span>
                            </div>
                            <ul class="c-content-list-adjusted">
                                <li>
                                    <a class="btn btn-block c-btn-square btn-social btn-twitter">
                                        <i class="fa fa-twitter"></i>
                                        Twitter </a>
                                </li>
                                <li>
                                    <a class="btn btn-block c-btn-square btn-social btn-facebook">
                                        <i class="fa fa-facebook"></i>
                                        Facebook </a>
                                </li>
                                <li>
                                    <a class="btn btn-block c-btn-square btn-social btn-google">
                                        <i class="fa fa-google"></i>
                                        Google </a>
                                </li>
                            </ul>
                        </div>
                    </form>
                </div>
                <div class="modal-footer c-no-border">
                    <span class="c-text-account">Don't Have An Account Yet ?</span>
                    <a href="javascript:;" data-toggle="modal" data-target="#signup-form" data-dismiss="modal" class="btn c-btn-dark-1 btn c-btn-uppercase c-btn-bold c-btn-slim c-btn-border-2x c-btn-square c-btn-signup">Signup!</a>
                </div>
            </div>
        </div>
    </div>
    <!-- END: CONTENT/USER/LOGIN-FORM -->
    <!-- END: PAGE CONTENT -->
    <!-- END: PAGE CONTENT -->

    <script type="text/javascript">
        function selectState(country_id) {
            if (country_id != "-1") {
                loadData('state', country_id);
                $("#city_dropdown").html("<option value='-1'>Select city</option>");
            } else {
                $("#state_dropdown").html("<option value='-1'>Select state</option>");
                $("#city_dropdown").html("<option value='-1'>Select city</option>");
            }
        }
        function selectCity(state_id) {
            if (state_id != "-1") {
                loadData('city', state_id);
            } else {
                $("#city_dropdown").html("<option value='-1'>Select city</option>");
            }
        }
        function loadData(loadType, loadId) {
            var dataString = 'loadType=' + loadType + '&loadId=' + loadId;
            $("#" + loadType + "_loader").show();
            $("#" + loadType + "_loader").fadeIn(400).html('Loading ' + loadType + '...');
            $.ajax({
                type: "POST",
                url: "<?php echo base_url() ?>frontend/location/loadData",
                data: dataString,
                cache: false,
                success: function (result) {
                    $("#" + loadType + "_loader").hide();
                    $("#" + loadType + "_dropdown").html("<option value='-1'>Select " + loadType + "</option>");
                    $("#" + loadType + "_dropdown").append(result);
                }
            });
        }

    </script>
</div>