<!-- END: LAYOUT/BREADCRUMBS/BREADCRUMBS-3 -->
<!-- BEGIN: CONTENT/SHOPS/SHOP-PRODUCT-DETAILS-2 -->
<div class="c-layout-page">
<div class="c-layout-breadcrumbs-1 c-bgimage c-subtitle c-fonts-uppercase c-fonts-bold c-bg-img-center" style="background-image: url(<?php echo frontend_asset_url()?>assets/base/img/content/backgrounds/cart-bg.jpg)">
  <div class="container">
   <div class="c-page-title c-pull-left">
    <h3 class="c-font-uppercase c-font-bold c-font-white c-font-20 c-font-slim">My Cart</h3>
   </div>
  </div>
 </div>
<!-- END: CONTENT/SHOPS/SHOP-PRODUCT-DETAILS-2 -->
<!-- BEGIN: CONTENT/SHOPS/SHOP-CART-1 -->
<div class="c-content-box c-size-lg">
    <div class="container">
        <span id="successmsg"></span>
        <div class="c-shop-cart-page-1">
           
            <!-- BEGIN: SHOPPING CART ITEM ROW -->

            <!-- END: SHOPPING CART ITEM ROW -->
            <!-- BEGIN: SHOPPING CART ITEM ROW -->
            <?php
            if (!empty($cart_data)) {
                $total = 0;
                foreach ($cart_data as $cart) {
                    $price = $cart['price'] * $cart['qty'];
                    $total = $price + $total;
                    ?>
                    <div class="row c-cart-table-row">
                        <h2 class="c-font-uppercase c-font-bold c-theme-bg c-font-white c-cart-item-title">Item 2</h2>
                        <div class="col-md-2 col-sm-3 col-xs-5 c-cart-image">
                            <img src="<?php echo $cart['options']['product_img'] ?>" /> </div>
                        <div class="col-md-6 col-sm-9 col-xs-7 c-cart-desc">
                            <h3>
                                <a href="javascript:;" class="c-font-bold c-theme-link c-font-22 c-font-dark"><?php echo $cart['name'] ?></a>
                            </h3>
                            <p><?php echo $cart['options']['product_desc'] ?>
                            </p>
                        </div>

                        <div class="col-md-2 col-sm-3 col-xs-6 c-cart-price">
                            <p class="c-cart-sub-title c-theme-font c-font-uppercase c-font-bold">Unit Price</p>
                            <p class="c-cart-price c-font-bold">$<?php echo $price ?></p>
                        </div>
                        <div class="col-md-1 col-sm-3 col-xs-6 c-cart-total">
<!--                            <p class="c-cart-sub-title c-theme-font c-font-uppercase c-font-bold">Total</p>
                            <p class="c-cart-price c-font-bold">$<?php echo $this->cart->total() ?></p>-->
                        </div>
                        <div class="col-md-1 col-sm-12 c-cart-remove">
                            <a href="javascript:;" onclick='removeItem("<?php echo $cart["rowid"]; ?>")' class="btn c-btn btn-xs c-theme-btn c-btn-square c-font-white c-font-bold c-font-uppercase c-cart-float-r">Remove</a>
                            <a href="javascript:;"  class="c-cart-remove-mobile btn c-btn c-btn-md c-btn-square c-btn-red c-btn-border-1x c-font-uppercase">Remove item from Cart</a>
                        </div>
                    </div>
                    <?php
                }
            } else {
                echo "<tr><td colspan=4><h4>Your cart is empty</h4></td></tr>";
            }
            ?>
            <!-- END: SHOPPING CART ITEM ROW -->
            <!-- BEGIN: SUBTOTAL ITEM ROW -->
<!--            <div class="row">
                <div class="c-cart-subtotal-row c-margin-t-20">
                    <div class="col-md-2 col-md-offset-9 col-sm-6 col-xs-6 c-cart-subtotal-border">
                        <h3 class="c-font-uppercase c-font-bold c-right c-font-16 c-font-grey-2">Subtotal</h3>
                    </div>
                    <div class="col-md-1 col-sm-6 col-xs-6 c-cart-subtotal-border">
                        <h3 class="c-font-bold c-font-16">$<?php echo $this->cart->total() ?></h3>
                    </div>
                </div>
            </div>-->
            <!-- END: SUBTOTAL ITEM ROW -->
            <!-- BEGIN: SUBTOTAL ITEM ROW -->
           
            <!-- END: SUBTOTAL ITEM ROW -->
            <!-- BEGIN: SUBTOTAL ITEM ROW -->
            <div class="row">
                <div class="c-cart-subtotal-row">
                    <div class="col-md-2 col-md-offset-9 col-sm-6 col-xs-6 c-cart-subtotal-border">
                        <h3 class="c-font-uppercase c-font-bold c-right c-font-16 c-font-grey-2">Grand Total</h3>
                    </div>
                    <div class="col-md-1 col-sm-6 col-xs-6 c-cart-subtotal-border">
                        <h3 class="c-font-bold c-font-16">$<?php echo $this->cart->total() ?></h3>
                    </div>
                </div>
            </div>
            <!-- END: SUBTOTAL ITEM ROW -->
            <div class="c-cart-buttons">
                <a href="<?php echo base_url() ?>research-page" class="btn c-btn btn-lg c-btn-red c-btn-square c-font-white c-font-bold c-font-uppercase c-cart-float-l">Continue Shopping</a>
                <a href="<?php echo base_url() ?>cart/checkout" class="btn c-btn btn-lg c-theme-btn c-btn-square c-font-white c-font-bold c-font-uppercase c-cart-float-r">Checkout</a>
            </div>
        </div>
    </div>
</div>
<!-- END: CONTENT/SHOPS/SHOP-CART-1 -->

<!-- END: PAGE CONTENT -->
<!-- END: PAGE CONTENT -->
</div>