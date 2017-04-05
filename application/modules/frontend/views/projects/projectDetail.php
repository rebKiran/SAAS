

<div class="c-layout-page">
    <!-- BEGIN: LAYOUT/BREADCRUMBS/BREADCRUMBS-3 -->

    <div class="banner" style="margin-top:55px">
        <div class="container">
            <div class="row">
                <div class="col-md-3">
                </div>
                <div class="col-md-9">
                    <h2 style="font-size:33px"><?php echo $project->project_title; ?></h2>
                    <p><?php echo $project->short_description; ?></p>
                </div>
            </div>
        </div>
    </div>



    <!-- END: LAYOUT/BREADCRUMBS/BREADCRUMBS-3 -->



    <div class="clearfix c-content-box c-size-lg c-overflow-hide c-bg-white" style="padding:24px 0;">
        <div class="container">
            <div class="c-shop-product-details-2">
                <div class="row">
                    <div class="col-md-7">
                        <div class="c-product-gallery">
                            <div class="c-product-gallery-content">
                                <?php
                                if ($project->media_type == 1) {
                                    ?>
                                    <img src="<?php echo base_url(); ?>uploads/projects/project_media/<?php echo $project->project_media; ?>"/>
                                <?php } else { ?>
                                    <video width="700" height="300" controls>
                                        <source src="<?php echo base_url(); ?>uploads/projects/project_media/<?php echo $project->project_media; ?>" type="video/mp4">
                                        <source src="<?php echo base_url(); ?>uploads/projects/project_media/<?php echo $project->project_media; ?>" type="video/ogg">
                                        Your browser does not support the video tag.
                                    </video>
                                <?php } ?>
                            </div>

                        </div>
                    </div>
                    <div class="col-md-5">
                        <div class="c-product-meta">
                            <!--div class="c-content-title-1">
                                <h3 class="c-font-uppercase c-font-bold">Lorem ipsum dolor</h3>
                                <div class="c-line-left"></div>
                            </div-->

                            <div class="clear"></div>
                            <div class="c-product-price" style="margin-bottom: 0px;">$<?php if(is_object($project_details)) { echo $project_details->total; } else { echo ' 0.00'; } ?></div>
                            <div class="c-product-short-desc"> pledged of $<?php if(is_object($project_details)) {  echo $project_details->total; } ?> goal </div>

                            <div class="c-product-price" style="margin-bottom: 0px;"><?php if(is_object($project_details)) {  echo $project_details->cnt_records; } else { echo ' 0'; } ?></div>
                            <div class="c-product-short-desc"> backers </div>

                            <div class="c-product-add-cart c-margin-t-20">
                                <div class="row">

                                    <div class="col-sm-12 col-xs-12 c-margin-t-20">
                                        <a href="<?php echo base_url(); ?>back-project/<?php echo $project->project_id; ?>" class="btn col-sm-5 c-btn btn-lg c-font-bold c-font-white c-theme-btn c-btn-square c-font-uppercase">Back this project</a>
                                        <a id="connect" onclick="connectToProject(<?php echo $project->project_id; ?>)" class="btn c-btn  col-sm-5 btn-lg c-font-bold c-font-white c-theme-btn c-btn-square c-font-uppercase">Connect</a>
                                    </div>
                                    <div class="clear" style="margin: 17px;"></div>
                                    <!--div class="col-sm-6 col-xs-12">
<a href="#" class="btn btn-lg c-btn-green c-btn-square c-btn-border-2x btn-block">
                                      <i class="fa fa-bell-o"></i> 
                                      Remind Me</a>
</div-->
                                    <!--div class="col-sm-6 col-xs-12">
<a href="#" class="btn btn-lg c-btn-green c-btn-square c-btn-border-2x btn-block">
                                      <i class="fa fa-share-alt" aria-hidden="true"></i> Share</a>
</div-->
                                </div>
                            </div>
                        </div>




                    </div>
                </div>
            </div>
        </div>
    </div>



    <!-- BEGIN: CONTENT/SHOPS/SHOP-PRODUCT-TAB-1 -->
    <div class="c-content-box c-size-md c-no-padding">
        <div class="c-shop-product-tab-1" role="tabpanel" style="padding-bottom:0px">
            <div class="container">
                <ul class="nav nav-justified" role="tablist">
                    <li role="presentation" class="active">
                        <a class="c-font-uppercase c-font-bold" href="#tab-1" role="tab" data-toggle="tab">Description</a>
                    </li>
                    <!--li role="presentation">
                        <a class="c-font-uppercase c-font-bold" href="#tab-2" role="tab" data-toggle="tab">Additional Information</a>
                    </li-->
                </ul>
            </div>
            <div class="tab-content">
                <div role="tabpanel" class="tab-pane fade in active" id="tab-1">
                    <div class="c-product-desc c-center" style="padding-top: 22px;">
                        <div class="container">
                            <div class="col-md-8">
                                <?php echo $project->project_description; ?>
                            </div>
                            <div class="col-md-4">

                                <?php
                                $i = 1;
                                foreach ($offers as $offer) {
                                    ?>
                                    <div>
                                        <div class="bloc-section bloc-section<?php echo $i; ?>">
    <?php echo $offer->offers; ?>
                                            <div class="form-group">

                                            </div>
                                            <div class="reward reward<?php echo $i; ?> hide-div<?php echo $i; ?> close-reward">
                                                <div class="reward-content">Select This Reward</div>
                                            </div>
                                        </div>

                                    </div>

    <?php
    $i++;
}
?>



                            </div>
                        </div>
                    </div>

                </div>


                <div role="tabpanel" class="tab-pane fade" id="tab-2">
                    <div class="container">
                        <p class="c-center">
                        <p>Lorem ipsum dolor sit amet, dolor adipisicing dolor sit amet dolor sit amet elit. Nulla nemo ad sapiente officia amet ipsum dolor sit amet.</p>
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
<script>
    function connectToProject(projectid) {
        $.ajax({
            url: base_url + 'frontend/project/connectToProject',
            type: 'POST',
            data: {id : projectid},
            dataType: 'json',
            success: function (response) {
                //alert(response.msg);
                if (response.status === '1') {
                    $("#connect").html("Connected <i class='fa fa-check'></i>");
                    return true;
                } else {
                    return false;
                }
            }
        });
    }
    

</script>