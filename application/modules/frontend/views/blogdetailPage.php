
<!-- END: LAYOUT/SIDEBARS/QUICK-SIDEBAR -->
<!-- BEGIN: PAGE CONTAINER -->
<div class="c-layout-page">
    <!-- BEGIN: LAYOUT/BREADCRUMBS/BREADCRUMBS-1 -->
    <div class="c-layout-breadcrumbs-1 c-fonts-uppercase c-fonts-bold c-bordered c-bordered-both">
        <div class="container">
            <div class="c-page-title c-pull-left">
                <h3 class="c-font-uppercase c-font-bold"></h3>
            </div>
            <ul class="c-page-breadcrumbs c-theme-nav c-pull-right c-fonts-regular">
                <li>
                </li>
                <li>
                </li>
                <li class="c-state_active">

                </li>
            </ul>
        </div>
    </div>
    <!-- END: LAYOUT/BREADCRUMBS/BREADCRUMBS-1 -->
    <!-- BEGIN: PAGE CONTENT -->
    <!-- BEGIN: BLOG LISTING -->
    <div class="c-content-box c-size-md">
        <div class="container">
            <div class="row">
                <div class="col-md-9">
                    <div class="c-content-blog-post-1-view">
                        <div class="c-content-blog-post-1">
                            <div class="c-media">
                                <div class="c-content-media-2-slider" data-slider="owl" data-single-item="true" data-auto-play="4000">
                                    <div class="owl-carousel owl-theme c-theme owl-single">
                                        <div class="item">
                                            <div class="c-content-media-2" style="background-image: url(<?php echo base_url() . 'uploads/blogs/540x360/' . $data[0]['blog_image']; ?>); min-height: 460px;">
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                            <div class="c-title c-font-bold c-font-uppercase">
                                <a href="#"><?php echo $data[0]['post_title']; ?></a>
                            </div>
                            <div class="c-panel c-margin-b-30">

                                <div class="c-date">
                                    on <span class="c-font-uppercase"><?php echo date('d M Y, H:i A', strtotime($data[0]['posted_on'])); ?></span>
                                </div>
                                <!--<ul class="c-tags c-theme-ul-bg">
                                        <li>
                                                ux
                                        </li>
                                        <li>
                                                marketing
                                        </li>
                                        <li>
                                                events
                                        </li>
                                </ul>-->
                                <div class="c-comments">
                                    <a href="#msgF"><i class="icon-speech"></i> <?php echo count($blog_posts[0]['comments'])?> comments</a>
                                </div>
                            </div>
                            <div class="c-desc">
                                <?php echo $data[0]['post_content']; ?>
                            </div>
                            <div class="c-comments">
                                <div class="c-content-title-1">
                                    <h3 class="c-font-uppercase c-font-bold">Comments(<?php echo count($blog_posts[0]['comments'])?>)</h3>
                                    <div class="c-line-left">
                                    </div>
                                </div>
                                <div class="c-comment-list"  id="msg">
                                    <?php foreach ($blog_posts[0]['comments'] as $comment) { ?>
                                        <div class="media">
                                            <div class="media-left">
                                                <a href="#">
                                                    <img class="media-object" alt="" src="<?php echo frontend_asset_url() ?>assets/base/img/content/team/team1.jpg">
                                                </a>
                                            </div>
                                            <div class="media-body">
                                                <h4 class="media-heading"><a href="#" class="c-font-bold"><?php echo $comment['commented_user'] ?></a> on <span class="c-date"><?php echo date("d M Y, h:ia", strtotime($comment['comment_on'])) ?></span></h4>
                                                <?php echo $comment['comment'] ?>
                                            </div>
                                        </div>
                                    <?php } ?>


                                </div>
                                
                                <?php if ($this->session->userdata('success_msg') != ''): ?>
                                    <div class="alert alert-success alert-dismissible fade in" id="success_msg" role="alert">
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">x</span>
                                        </button>
                                        <strong><?php echo $this->session->userdata('success_msg'); ?></strong> 
                                    </div>
                                <?php
                                endif;
                                $this->session->unset_userdata('success_msg');
                                ?>
<?php if ($this->session->userdata('error_msg') != ''): ?>
                                    <div class="alert alert-danger alert-dismissible fade in" id="error_msg" role="alert">
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">x</span>
                                        </button>
                                        <strong><?php echo $this->session->userdata('error_msg'); ?></strong> 
                                    </div>
                                <?php
                                endif;
                                $this->session->unset_userdata('error_msg');
                                ?>
                                <div class="c-content-title-1">
                                    <h3 class="c-font-uppercase c-font-bold">Leave A Comment</h3>
                                    <div class="c-line-left">
                                    </div>
                                </div>
                                <?php if($this->session->userdata('user_account') != ""){?>
                                <form method="POST" id="demo-form2" action="<?php echo base_url() ?>addComment/<?php echo $blog_posts[0]['slug'] ?>">

                                    <div class="form-group">
                                        <input type="text" placeholder="Your Email" required value="<?php echo $this->session->userdata('user_account')['email']; ?>" name="email" class="form-control c-square">
                                    </div>
                                    <div class="form-group">
                                        <textarea rows="8" name="comment" required placeholder="Write comment here ..." class="form-control c-square"></textarea>
                                    </div>
                                    <div class="form-group">
                                        <button type="submit" class="btn c-theme-btn c-btn-uppercase btn-md c-btn-sbold btn-block c-btn-square">Submit</button>
                                    </div>
                                </form>
                                <?php } else { echo "<p>Please <a href='javascript:;' data-toggle='modal' data-target='#login-form' >login </a>to comment</p>";}?>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <!-- BEGIN: CONTENT/BLOG/BLOG-SIDEBAR-1 -->
                    <form action="#" method="post">
                        <div class="input-group">
                            <input type="text" class="form-control c-square c-theme-border" placeholder="Search blog...">
                            <span class="input-group-btn">
                                <button class="btn c-theme-btn c-theme-border c-btn-square" type="button">Go!</button>
                            </span>
                        </div>
                    </form>
                    <div class="c-content-ver-nav">
                        <div class="c-content-title-1 c-theme c-title-md c-margin-t-40">
                            <h3 class="c-font-bold c-font-uppercase">Categories</h3>
                            <div class="c-line-left c-theme-bg">
                            </div>
                        </div>
                        <ul class="c-menu c-arrow-dot1 c-theme">
<?php foreach ($categories as $key => $value) { ?>
                                <li>
                                    <a href="<?php echo base_url() . 'blog/cat/' . $value['category_id']; ?>"><?php echo $value['category_name']; ?> (<?php echo $value['total']; ?>)</a>
                                </li>
<?php } ?>

                        </ul>
                    </div>
                    <div class="c-content-tab-1 c-theme c-margin-t-30">
                        <div class="nav-justified">
                            <ul class="nav nav-tabs nav-justified">
                                <li class="active">
                                    <a href="#blog_recent_posts" data-toggle="tab">Recent Posts</a>
                                </li>
                                <li>
                                    <a href="#blog_popular_posts" data-toggle="tab">Popular Posts</a>
                                </li>
                            </ul>
                            <div class="tab-content">
                                <div class="tab-pane active" id="blog_recent_posts">
                                    <ul class="c-content-recent-posts-1">
<?php foreach ($blog_posts as $key => $value) { ?>
                                            <li>
                                                <div class="c-image">
                                                    <img src="<?php echo base_url() . 'uploads/blogs/233x155/' . $value['blog_image']; ?>" alt="" class="img-responsive"	>
                                                </div>
                                                <div class="c-post">
                                                    <a href="<?php echo base_url() . 'blog-page/' . $value['slug']; ?>" class="c-title">
                                                        <?php echo $value['post_title']; ?></a>
                                                    <div class="c-date">
    <?php echo date('d M Y', strtotime($value['posted_on'])); ?>
                                                    </div>
                                                </div>
                                            </li>
<?php } ?>
                                    </ul>
                                </div>
                                <div class="tab-pane" id="blog_popular_posts">
                                    <ul class="c-content-recent-posts-1">
<?php foreach ($popular_posts as $key => $value) { ?>
                                            <li>
                                                <div class="c-image">
                                                    <img src="<?php echo base_url() . 'uploads/blogs/233x155/' . $value['blog_image']; ?>" alt="" class="img-responsive"	>
                                                </div>
                                                <div class="c-post">
                                                    <a href="<?php echo base_url() . 'blog-page/' . $value['slug']; ?>" class="c-title">
                                                        <?php echo $value['post_title']; ?></a>
                                                    <div class="c-date">
    <?php echo date('d M Y', strtotime($value['posted_on'])); ?>
                                                    </div>
                                                </div>
                                            </li>
<?php } ?>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- END: CONTENT/BLOG/BLOG-SIDEBAR-1 -->
                </div>
            </div>
        </div>
    </div>
    <!-- END: BLOG LISTING  -->
    <!-- END: PAGE CONTENT -->
</div>
<!-- END: PAGE CONTAINER -->
<!-- BEGIN: LAYOUT/FOOTERS/FOOTER-5 -->
