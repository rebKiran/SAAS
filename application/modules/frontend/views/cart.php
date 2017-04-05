<div class="c-layout-page">
    <!-- BEGIN: LAYOUT/BREADCRUMBS/BREADCRUMBS-3 -->
    <div class="c-layout-breadcrumbs-1 c-bgimage c-subtitle c-fonts-uppercase c-fonts-bold c-bg-img-center" >
        <div class="container">
	<div class="row">
		<div class="col-xs-12">
			<div class="panel panel-info">
				<div class="panel-heading">
					<div class="panel-title">
						<div class="row">
							<div class="col-xs-6">
								<h5><span class="glyphicon glyphicon-shopping-cart"></span> Shopping Cart</h5>
							</div>
							<div class="col-xs-6">
								<button type="button" class="btn btn-primary btn-sm btn-block">
									<span class="glyphicon glyphicon-share-alt"></span> <a href="<?php echo base_url()?>research-page">Continue shopping </a>
								</button>
							</div>
						</div>
					</div>
				</div>
				<div class="panel-body">
                                   <?php
                                   
                            if (!empty($cart_data)) {
                                $total = 0;
                                foreach ($cart_data as $cart) {
                                    $price = $cart['price'] * $cart['qty'];
                                    $total = $price + $total;
                                    ?>
					<div class="row">
						<div class="col-xs-2"><img class="img-responsive" width="100" src="<?php echo $cart['options']['product_img']?>">
						</div>
						<div class="col-xs-4">
							<h4 class="product-name"><strong><?php echo $cart['name']?></strong></h4><h4><small><?php echo $cart['options']['product_desc']?></small></h4>
						</div>
						<div class="col-xs-6">
							<div class="col-xs-6 text-right">
								<h3><strong>$<?php echo $price ?> <span class="text-muted"></span></strong></h3>
							</div>
							<div class="col-xs-2">
								<button type="button" onclick='removeItem("<?php echo $cart["rowid"];?>")' class="btn btn-link btn-xs">
									<span class="glyphicon glyphicon-trash"> </span>
								</button>
							</div>
						</div>
					</div>
					
					<hr>
                            <?php } } else {
                                echo "<tr><td colspan=4><h4>Your cart is empty</h4></td></tr>";
                            }
                            ?>
				</div>
				<div class="panel-footer">
					<div class="row text-center">
						<div class="col-xs-9">
							<h4 class="text-right">Total <strong>$<?php echo $this->cart->total()?></strong></h4>
						</div>
						<div class="col-xs-3">
							<a href="<?php echo base_url()?>cart/checkout" class="btn c-theme-btn c-btn-square c-btn-uppercase c-btn-bold">
								Checkout
							</a>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
    </div>
    <!-- END: LAYOUT/BREADCRUMBS/BREADCRUMBS-3 -->
    <!-- BEGIN: CONTENT/SHOPS/SHOP-PRODUCT-DETAILS-2 -->
    
    <!-- END: CONTENT/SHOPS/SHOP-PRODUCT-DETAILS-2 -->
    <!-- BEGIN: CONTENT/SHOPS/SHOP-PRODUCT-TAB-1 -->
    
    <!-- END: CONTENT/SHOPS/SHOP-PRODUCT-TAB-1 -->

    <!-- END: PAGE CONTENT -->
    <!-- END: PAGE CONTENT -->
</div>