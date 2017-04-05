<div class="c-layout-page">
    <!-- BEGIN: LAYOUT/BREADCRUMBS/BREADCRUMBS-3 -->
    <div class="c-layout-breadcrumbs-1 c-bgimage c-subtitle c-fonts-uppercase c-fonts-bold c-bg-img-center" style="background-image: url(<?php echo frontend_asset_url() ?>assets/base/img/content/backgrounds/bg-28.jpg)">
        <div class="container">
            <div class="c-page-title c-pull-left">
                <h3 class="c-font-uppercase c-font-bold c-font-white c-font-20 c-font-slim">Blogs</h3>
                <h4 class="c-font-white c-font-thin c-opacity-07">
                    Page Sub Title Goes Here </h4>
            </div>
            <ul class="c-page-breadcrumbs c-theme-nav c-pull-right c-fonts-regular">
                <li>
                    <a href="#" class="c-font-white">Home</a>
                </li>
                <li class="c-font-white">
                    /
                </li>
                <li class="c-state_active c-font-white">
                    Blogs
                </li>
            </ul>
        </div>
    </div>
    <!-- END: LAYOUT/BREADCRUMBS/BREADCRUMBS-3 -->
    <!-- BEGIN: CONTENT/SHOPS/SHOP-PRODUCT-DETAILS-2 -->
    <div class="c-content-box c-size-lg c-overflow-hide c-bg-white">
        <div class="container">
            <div class="c-shop-product-details-2">
                <div class="row">
                    <div class="col-md-6">
                        <div class="c-product-gallery">
                            <div class="c-product-gallery-content">
                                <div class="c-zoom">
                                    <img src="<?php echo base_url() . 'uploads/papers/thumbnail/' . $data[0]['image_file']; ?>"> </div>

                            </div>

                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="c-product-meta">
                            <div class="c-content-title-1">
                                <input type="hidden" id='price' value='<?php echo $data[0]['price'] ?>'>
                                <input type="hidden" id='name' value='<?php echo $data[0]['name'] ?>'>
                                <input type="hidden" id='product_id' value='<?php echo $data[0]['product_id'] ?>'>
                                <input type="hidden" id='desc' value='<?php echo substr($data[0]['long_desc'], 0, 40) ?>'>
                                <input type="hidden" id='product_img' value='<?php echo base_url() . 'uploads/papers/thumbnail/' . $data[0]['image_file']; ?>'>
                                <input type="hidden" id='qty' value='1'>
                                <h3 class="c-font-uppercase c-font-bold"><?php echo $data[0]['name']; ?></h3>
                                <div class="c-line-left"></div>
                            </div>
                            <div class="c-product-badge">


                            </div>
                            <div class="c-product-review">

                            </div>
                            <div class="c-product-price">$ <?php echo $data[0]['price']; ?></div>
                            <div class="c-product-short-desc"><?php echo substr($data[0]['long_desc'], 0, 100); ?></div>
                            <div class="row c-product-variant">


                                <div class="col-sm-12 col-xs-12 c-margin-t-20">
                                    <button href="javascript:;" id='add_to_cart' class="btn c-btn btn-lg c-font-bold c-font-white c-theme-btn c-btn-square c-font-uppercase">Add to Cart</button>
                                    <span id='msg'></span>

                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- END: CONTENT/SHOPS/SHOP-PRODUCT-DETAILS-2 -->
    <!-- BEGIN: CONTENT/SHOPS/SHOP-PRODUCT-TAB-1 -->
    <div class="c-content-box c-size-md c-no-padding">
        <div class="c-shop-product-tab-1" role="tabpanel" style="padding-bottom:0px">
            <div class="container">
                <ul class="nav nav-justified" role="tablist">
                    <li role="presentation" class="active">
                        <a class="c-font-uppercase c-font-bold" href="#tab-1" role="tab" data-toggle="tab">Description</a>
                    </li>
                    <li role="presentation">
                        <a class="c-font-uppercase c-font-bold" href="#tab-2" role="tab" data-toggle="tab">Additional Information</a>
                    </li>
                </ul>
            </div>
            <div class="tab-content">
                <div role="tabpanel" class="tab-pane fade in active" id="tab-1">
                    <div class="c-product-desc c-center" style="padding-top: 22px;">
                        <div class="container">
                            <img src="<?php echo base_url() . 'uploads/papers/thumbnail/' . $data[0]['image_file']; ?>" />
                            <p><br></p>
                            <?php echo $data[0]['long_desc']; ?>

                        </div>
                    </div>
                </div>
                <div role="tabpanel" class="tab-pane fade" id="tab-2">
                    <div class="container">
                        <p class="c-center">
                            <?php echo $data[0]['long_desc']; ?>
                            <br>

                        <br/> </div>
                </div>

            </div>
        </div>
    </div>
    <!-- END: CONTENT/SHOPS/SHOP-PRODUCT-TAB-1 -->

    <!-- END: PAGE CONTENT -->
    <!-- END: PAGE CONTENT -->
</div>