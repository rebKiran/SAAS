<div class="c-layout-page">
    <div class="c-layout-breadcrumbs-1 c-bgimage c-subtitle c-fonts-uppercase c-fonts-bold c-bg-img-center" style="background-image: url(<?php echo frontend_asset_url()?>assets/base/img/content/backgrounds/cart-bg.jpg)">
  <div class="container">
   <div class="c-page-title c-pull-left">
    <h3 class="c-font-uppercase c-font-bold c-font-white c-font-20 c-font-slim">Checkout</h3>
   </div>
  </div>
 </div>

    <!-- BEGIN: PAGE CONTENT -->
    <div class="c-content-box c-size-lg">
        <div class="container">
            <form class="c-shop-form-1" method="post" action="<?php echo base_url() ?>frontend/Cart/placeOrder">
                <div class="row">
                    <!-- BEGIN: ADDRESS FORM -->
                    <div class="col-md-7 c-padding-20">
                        <!-- BEGIN: BILLING ADDRESS -->
                        <h3 class="c-font-bold c-font-uppercase c-font-24">Billing Address</h3>

                        <div class="c-shipping-address">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="row">
                                        <div class="form-group col-md-6">
                                            <label class="control-label">First Name</label>
                                            <input type="text" required='required' class="form-control c-square c-theme" name='first_name' placeholder="First Name"> </div>
                                        <div class="col-md-6">
                                            <label class="control-label">Last Name</label>
                                            <input type="text" required='required' class="form-control c-square c-theme" name='last_name' placeholder="Last Name"> </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-md-12">
                                    <label class="control-label">Address</label>
                                    <input type="text" required='required' name='address' class="form-control c-square c-theme" placeholder="Street Address"> </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-md-12">
                                    <label class="control-label">State</label>
                                    <select id="state_dropdown" required='required' onchange="selectCity(this.options[this.selectedIndex].value)" class="form-control" name="state">
                                        <option value="">Select State</option>
                                        <?php foreach ($list as $state) { ?>
                                            <option value="<?php echo $state['id'] ?>"><?php echo $state['name'] ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-md-12">
                                    <label class="control-label">Town / City</label>
                                    <select  name="city" class="form-control" id="city_dropdown">
                                        <option value="">Select City</option>
                                    </select>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-md-12">
                                    <label class="control-label">Zipcode</label>
                                    <input type="text" required='required' name='zipcode' class="form-control c-square c-theme" placeholder="Zipcode">
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-12">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <label class="control-label">Phone</label>
                                            <input type="tel" required='required' name='phone' class="form-control c-square c-theme" placeholder="Phone">
                                        </div>
                                        <div class="col-md-6">
                                            <label class="control-label">Email Address</label>
                                            <input type="email" required='required' name='email' class="form-control c-square c-theme" placeholder="Email Address">
                                        </div>

                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                    <!-- END: ADDRESS FORM -->
                    <!-- BEGIN: ORDER FORM -->
                    <div class="col-md-5">
                        <div class="c-content-bar-1 c-align-left c-bordered c-theme-border c-shadow">
                            <h1 class="c-font-bold c-font-uppercase c-font-24">Your Order</h1>
                            <ul class="c-order list-unstyled">
                                <li class="row c-margin-b-15">
                                    <div class="col-md-6 c-font-20">
                                        <h2>Product</h2>
                                    </div>
                                    <div class="col-md-6 c-font-20">
                                        <h2>Total</h2>
                                    </div>
                                </li>
                                <li class="row c-border-bottom"></li>
                                <?php
                                $total = 0;
                                if (!empty($cart_data)) {
                                    foreach ($cart_data as $cart) {
                                        $price = $cart['price'] * $cart['qty'];
                                        $total = $price + $total;
                                        ?>
                                        <li class="row c-margin-b-15 c-margin-t-15">
                                            <div class="col-md-6 c-font-20">
                                                <a href="javascript:;" class="c-theme-link"><?php echo $cart['name'] ?></a>
                                            </div>
                                            <div class="col-md-6 c-font-20">
                                                <p class="">$<?php echo $price; ?></p>
                                            </div>
                                        </li>
                                        <?php
                                    }
                                } else {
                                    echo "<b>Your cart is empty</b>";
                                }
                                ?>

                                <li class="row c-border-top c-margin-b-15"></li>

                                <li class="row c-margin-b-15 c-margin-t-15">
                                    <div class="col-md-6 c-font-20">
                                        <p class="c-font-30">Total</p>
                                    </div>
                                    <div class="col-md-6 c-font-20">
                                        <p class="c-font-bold c-font-30">$
                                            <span class="c-shipping-total"><?php echo $total; ?></span>
                                        </p>
                                    </div>
                                </li>
                                <li class="row">
                                    <div class="col-md-12">
                                        <div class="c-radio-list">
                                            <div class="c-radio">
                                                <label for="radio3" class="c-font-bold c-font-20">
<!--                                                    <span class="inc"></span>
                                                    <span class="check"></span>
                                                    <span class="box"></span> Paypal </label>-->
                                                <img class="img-responsive" width="250" src="https://www.paypalobjects.com/webstatic/mktg/Logo/AM_mc_vs_ms_ae_UK.png" /> </div>
                                        </div>
                                    </div>
                                </li>
<!--                                <li class="row c-margin-b-15 c-margin-t-15">
                                    <div class="form-group col-md-12">
                                        <div class="c-checkbox">
                                            <input type="checkbox" required='required' id="checkbox1-11" class="c-check">
                                            <label for="checkbox1-11">
                                                <span class="inc"></span>
                                                <span class="check"></span>
                                                <span class="box"></span> I've read and accept the Terms & Conditions </label>
                                        </div>
                                    </div>
                                </li>-->
                                <li class="row">
                                    <div class="form-group col-md-12" role="group">
                                        <!--                                                <button type="submit" class="btn btn-lg c-theme-btn c-btn-square c-btn-uppercase c-btn-bold">Submit</button>
                                                                                        <button type="submit" class="btn btn-lg btn-default c-btn-square c-btn-uppercase c-btn-bold">Cancel</button>-->

                                        <?php
                                        if ($this->session->userdata('user_account') == "") {
                                            echo '<button type="button" data-toggle="modal" data-target="#checkout-signup-form" class="btn btn-lg c-theme-btn c-btn-square c-btn-uppercase c-btn-bold">Place Order</button>';
                                        } else if (empty($this->cart->contents())) {
                                            echo '<a href="' . base_url() . 'research-page" class="btn btn-lg c-theme-btn c-btn-square c-btn-uppercase c-btn-bold">Continue Shopping</a>';
                                        } else {
                                            echo '<button type="submit" class="btn btn-lg c-theme-btn c-btn-square c-btn-uppercase c-btn-bold">Place Order</button>';
                                        }
                                        ?>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <!-- END: ORDER FORM -->
                </div>
            </form>
        </div>
    </div>
    <!-- END: PAGE CONTENT -->

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