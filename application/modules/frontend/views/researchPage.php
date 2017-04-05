<div class="c-layout-page">
            <!-- BEGIN: LAYOUT/BREADCRUMBS/BREADCRUMBS-3 -->
	<div class="c-layout-breadcrumbs-1 c-bgimage c-subtitle c-fonts-uppercase c-fonts-bold c-bg-img-center" style="background-image: url(<?php echo frontend_asset_url()?>assets/base/img/content/backgrounds/bg-28.jpg)">
		<div class="container">
			<div class="c-page-title c-pull-left">
				<h3 class="c-font-uppercase c-font-bold c-font-white c-font-20 c-font-slim">Research page</h3>
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
					Research page
				</li>
			</ul>
		</div>
	</div>
	<!-- END: LAYOUT/BREADCRUMBS/BREADCRUMBS-3 -->
	<!-- BEGIN: BLOG LISTING -->
	<div class="c-content-box c-size-md">
		<div class="container">
		<?php if(!empty($search)){ ?>
			<div class="c-content-title-1">
				<h3 class="c-center c-font-uppercase">Search Results For "<?php echo $search;?>"</h3>
			</div>
			
			
		<?php } ?>
		<?php if(!empty($paper_categories)){ ?>
			<div class="c-content-title-1">
				<h3 class="c-center c-font-uppercase">"<?php if( !empty($paper_categories)) { echo $paper_categories['category_name']; } ?>"</h3>
			</div>
		<?php } ?>
		<p><br/></p>
			<div class="row">
				<div class="col-md-9">
					<div class="c-content-blog-post-card-1-grid">
						<div class="row">
						<?php 
						  if(!empty($data)){
							foreach( $data as $key => $value ) { ?>
							<div class="col-md-6">
							
								<div class="c-content-blog-post-card-1 c-option-2 c-bordered">
									<div class="c-media c-content-overlay">
										<div class="c-overlay-wrapper">
											<div class="c-overlay-content">
												<a href="<?php echo base_url() . 'product-page/'.$value['slug'];?>"><i class="icon-link"></i></a>
											</div>
										</div>
										<img class="c-overlay-object img-responsive" src="<?php echo base_url().'uploads/papers/thumbnail/'. $value['image_file']; ?>" alt="">
									</div>
									<div class="c-body">
										<div class="c-title c-font-bold c-font-uppercase">
											<a href="<?php echo base_url() . 'product-page/'.$value['slug'];?>"><?php echo $value['name'];?></a>
										</div>
										
										<div class="c-panel">
										<?php  if(!empty($value['tags'])) {?>
											<ul class="c-tags c-theme-ul-bg">
											<?php 
											
												$arrTags = $value['tags'];
											     $tags = explode( ',', $arrTags);
												 
												
												 foreach( $tags as $tag ) {
											?>
												<li>
													<?php echo $tag;?>
												</li>
												 <?php } ?>
											</ul>
										<?php } else { ?>
										<ul class="c-tags">
										<li></li>
										</ul>
										<?php } ?>
										</div>
										<?php /*echo $desc = substr(stripslashes($value['long_desc']), 0, 50); */
										$desc = preg_replace('/[ \t]+/', ' ', preg_replace('/\s*$^\s*/m', "\n", trim(strip_tags($value['long_desc']))));
										echo $desc = substr(stripslashes( $desc ), 0, 45 );
										
										?>
										<div><a href="<?php echo base_url() . 'product-page/'.$value['slug'];?>">read more...</a></div>
									</div>
									
								</div>
								
								<!--<div class="c-content-blog-post-card-1 c-option-2 c-bordered">
									<div class="c-media c-content-overlay">
										<div class="c-overlay-wrapper">
											<div class="c-overlay-content">
												<a href="#"><i class="icon-link"></i></a>
												<a href="<?php echo frontend_asset_url()?>assets/base/img/content/stock2/06.jpg" data-lightbox="fancybox" data-fancybox-group="gallery">
												<i class="icon-magnifier"></i>
												</a>
											</div>
										</div>
										<img class="c-overlay-object img-responsive" src="<?php echo frontend_asset_url()?>assets/base/img/content/stock2/06.jpg" alt="">
									</div>
									<div class="c-body">
										<div class="c-title c-font-bold c-font-uppercase">
											<a href="#">Efficient Coding</a>
										</div>
										<div class="c-author">
											 By <a href="#"><span class="c-font-uppercase">Greg Idra</span></a>
											on <span class="c-font-uppercase">23 May 2015, 10:30AM</span>
										</div>
										<div class="c-panel">
											<ul class="c-tags c-theme-ul-bg">
												<li>
													HTML
												</li>
												<li>
													CSS
												</li>
												<li>
													PHP
												</li>
											</ul>
											<div class="c-comments">
												<a href="#"><i class="icon-speech"></i> 14 comments</a>
											</div>
										</div>
										<p>
											 Lorem ipsum dolor sit amet, dolor adipisicing dolor sit amet dolor sit amet elit. Nulla nemo ad sapiente officia amet ipsum dolor sit amet.
										</p>
									</div>
								</div>-->
								<!--<div class="c-content-blog-post-card-1 c-option-2 c-bordered">
									<div class="c-media">
										<iframe src="https://player.vimeo.com/video/105329112" width="100%" height="300" frameborder="0" webkitallowfullscreen mozallowfullscreen allowfullscreen>
										</iframe>
									</div>
									<div class="c-body">
										<div class="c-title c-font-bold c-font-uppercase">
											<a href="#">Modern Web Trends</a>
										</div>
										<div class="c-author">
											 By <a href="#"><span class="c-font-uppercase">Tracy Trendy</span></a>
											on <span class="c-font-uppercase">25 May 2015, 10:30AM</span>
										</div>
										<div class="c-panel">
											<ul class="c-tags c-theme-ul-bg">
												<li>
													Design
												</li>
												<li>
													web
												</li>
												<li>
													trends
												</li>
											</ul>
											<div class="c-comments">
												<a href="#"><i class="icon-speech"></i> 36 comments</a>
											</div>
										</div>
										<p>
											 Lorem ipsum dolor sit amet, dolor adipisicing dolor sit amet dolor sit amet elit. Nulla nemo ad sapiente officia amet ipsum dolor sit amet.
										</p>
									</div>
								</div> -->
							</div>
							<?php }	
						  } else {	?>
						  		
							<div class="c-content-title-1">
									<h3 class="c-center c-font-lowercase c-font-sbold">No Result Found.</h3>
									<div class="c-line-center c-theme-bg"></div>
							</div>
						  <?php } ?>
							<!--<div class="col-md-6">
								<div class="c-content-blog-post-card-1 c-option-2 c-bordered">
									<div class="c-media c-content-overlay">
										<div class="c-overlay-wrapper">
											<div class="c-overlay-content">
												<a href="#"><i class="icon-link"></i></a>
												<a href="<?php echo frontend_asset_url()?>assets/base/img/content/stock2/2.jpg" data-lightbox="fancybox" data-fancybox-group="gallery">
												<i class="icon-magnifier"></i>
												</a>
											</div>
										</div>
										<img class="c-overlay-object img-responsive" src="<?php echo frontend_asset_url()?>assets/base/img/content/stock2/2.jpg" alt="">
									</div>
									<div class="c-body">
										<div class="c-title c-font-bold c-font-uppercase">
											<a href="#">Code optimization</a>
										</div>
										<div class="c-author">
											 By <a href="#"><span class="c-font-uppercase">Paul Roger</span></a>
											on <span class="c-font-uppercase">26 May 2015, 10:30AM</span>
										</div>
										<div class="c-panel">
											<ul class="c-tags c-theme-ul-bg">
												<li>
													code
												</li>
												<li>
													clean
												</li>
												<li>
													HTML
												</li>
											</ul>
											<div class="c-comments">
												<a href="#"><i class="icon-speech"></i> 17 comments</a>
											</div>
										</div>
										<p>
											 Lorem ipsum dolor sit amet, dolor adipisicing dolor sit amet elit. Nulla nemo ad sapiente officia amet.
										</p>
									</div>
								</div>
								<div class="c-content-blog-post-card-1 c-option-2 c-bordered">
									<div class="c-media c-content-overlay">
										<div class="c-overlay-wrapper">
											<div class="c-overlay-content">
												<a href="#"><i class="icon-link"></i></a>
												<a href="<?php echo frontend_asset_url()?>assets/base/img/content/stock2/03.jpg" data-lightbox="fancybox" data-fancybox-group="gallery">
												<i class="icon-magnifier"></i>
												</a>
											</div>
										</div>
										<img class="c-overlay-object img-responsive" src="<?php echo frontend_asset_url()?>assets/base/img/content/stock2/03.jpg" alt="">
									</div>
									<div class="c-body">
										<div class="c-title c-font-bold c-font-uppercase">
											<a href="#">Device Optimization</a>
										</div>
										<div class="c-author">
											 By <a href="#"><span class="c-font-uppercase">Tim Book</span></a>
											on <span class="c-font-uppercase">28 May 2015, 10:30AM</span>
										</div>
										<div class="c-panel">
											<ul class="c-tags c-theme-ul-bg">
												<li>
													iOS
												</li>
												<li>
													Android
												</li>
												<li>
													Web
												</li>
											</ul>
											<div class="c-comments">
												<a href="#"><i class="icon-speech"></i> 38 comments</a>
											</div>
										</div>
										<p>
											 Lorem ipsum atis unde omnis iste natus error sit dolor dolor sit amet, atis unde omnis iste natus error sit dolor dolor adipisicing dolor sit amet elit. Nulla nemo ad sapiente officia amet.
										</p>
									</div>
								</div>
								<div class="c-content-blog-post-card-1 c-option-2 c-bordered">
									<div class="c-media c-content-overlay">
										<div class="c-overlay-wrapper">
											<div class="c-overlay-content">
												<a href="#"><i class="icon-link"></i></a>
												<a href="<?php echo frontend_asset_url()?>assets/base/img/content/stock2/01.jpg" data-lightbox="fancybox" data-fancybox-group="gallery">
												<i class="icon-magnifier"></i>
												</a>
											</div>
										</div>
										<img class="c-overlay-object img-responsive" src="<?php echo frontend_asset_url()?>assets/base/img/content/stock2/01.jpg" alt="">
									</div>
									<div class="c-body">
										<div class="c-title c-font-bold c-font-uppercase">
											<a href="#">Customer Satisfaction</a>
										</div>
										<div class="c-author">
											 By <a href="#"><span class="c-font-uppercase">Sara Conner</span></a>
											on <span class="c-font-uppercase">29 May 2015, 10:30AM</span>
										</div>
										<div class="c-panel">
											<ul class="c-tags c-theme-ul-bg">
												<li>
													Guide
												</li>
												<li>
													live
												</li>
												<li>
													events
												</li>
											</ul>
											<div class="c-comments">
												<a href="#"><i class="icon-speech"></i> 9 comments</a>
											</div>
										</div>
										<p>
											 Lorem ipsum dolor sit amet, Sed ut perspiciatis unde omnis iste natus error sit dolor adipisicing dolor sit amet elit. Nulla nemo ad sapiente officia amet ipsum dolor sit amet ipsum dolor sit amet perspiciatis unde omnis iste natus error sit dolo.
										</p>
									</div>
								</div>
							</div>-->
						</div>
						<div class="c-pagination">
							<!--<ul class="c-content-pagination c-theme">
								<li class="c-prev">
									<a href="#"><i class="fa fa-angle-left"></i></a>
								</li>
								<li>
									<a href="#">1</a>
								</li>
								<li class="c-active">
									<a href="#">2</a>
								</li>
								<li>
									<a href="#">3</a>
								</li>
								<li>
									<a href="#">4</a>
								</li>
								<li class="c-next">
									<a href="#"><i class="fa fa-angle-right"></i></a>
								</li>
							</ul>-->
							<ul class="c-content-pagination c-theme">

                        <?php echo $pg_link; ?>
                    </ul>
						</div> 
					</div>
				</div>
				<div class="col-md-3">
					<!-- BEGIN: CONTENT/BLOG/BLOG-SIDEBAR-1 -->
					<form action="<?php echo base_url().'research-page/'?>" method="post">
						<div class="input-group">
							<input type="text" name="search_paper" id="search_paper" class="form-control c-square c-theme-border" placeholder="Search ...">
							<span class="input-group-btn">
							<button class="btn c-theme-btn c-theme-border c-btn-square" type="submit">Go!</button>
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
						<?php 
						
						foreach( $categories as $key => $value ) { ?>
							<li>
								<a href="<?php echo base_url() . 'research-page/cat/'.$value['category_id'];?>"><?php echo $value['category_name'];?> (<?php echo $value['total'];?>)</a>
							</li>
						<?php  } ?>
							
						</ul>
					</div>
					<div class="c-content-tab-1 c-theme c-margin-t-30">
						<div class="nav-justified">
							<ul class="nav nav-tabs nav-justified">
								<li class="active">
									<a href="#blog_recent_posts" data-toggle="tab">Recent Papers</a>
								</li>
								<li>
									<a href="#blog_popular_posts" data-toggle="tab">Popular Papers</a>
								</li>
							</ul>
							<div class="tab-content">
								<div class="tab-pane active" id="blog_recent_posts">
									<ul class="c-content-recent-posts-1">
									<?php 
									
									foreach( $blogs as $key => $value ) { ?>
										<li>
											<div class="c-image">
												<img src="<?php echo base_url().'uploads/papers/thumbnail/'. $value['image_file']; ?>" alt="" class="img-responsive">
											</div>
											<div class="c-post">
												<a href="<?php echo base_url() . 'product-page/'.$value['slug'];?>" class="c-title">
												<?php echo $value['name'];?></a>
												<div class="c-date">
													<?php echo date('d M Y', strtotime( $value['created_on'] ));?>
												</div>
											</div>
										</li>
									<?php } ?>
										<!--<li>
											<div class="c-image">
												<img src="<?php echo frontend_asset_url()?>assets/base/img/content/stock/08.jpg" alt="" class="img-responsive">
											</div>
											<div class="c-post">
												<a href="" class="c-title">
												UX Design Expo 2015... </a>
												<div class="c-date">
													27 Jan 2015
												</div>
											</div>
										</li>
										<li>
											<div class="c-image">
												<img src="<?php echo frontend_asset_url()?>assets/base/img/content/stock/07.jpg" alt="" class="img-responsive">
											</div>
											<div class="c-post">
												<a href="" class="c-title">
												UX Design Expo 2015... </a>
												<div class="c-date">
													27 Jan 2015
												</div>
											</div>
										</li>
										<li>
											<div class="c-image">
												<img src="<?php echo frontend_asset_url()?>assets/base/img/content/stock/32.jpg" alt="" class="img-responsive">
											</div>
											<div class="c-post">
												<a href="" class="c-title">
												UX Design Expo 2015... </a>
												<div class="c-date">
													27 Jan 2015
												</div>
											</div>
										</li>-->
									</ul>
								</div>
								<div class="tab-pane" id="blog_popular_posts">
									<ul class="c-content-recent-posts-1">
									<?php 
									
									foreach( $popular_posts as $key => $value ) { ?>
										<li>
											<div class="c-image">
												<img src="<?php echo base_url().'uploads/papers/thumbnail/'. $value['image_file']; ?>" alt="" class="img-responsive">
											</div>
											<div class="c-post">
												<a href="<?php echo base_url() . 'product-page/'.$value['slug'];?>" class="c-title">
												<?php echo $value['name'];?></a>
												<div class="c-date">
													<?php echo date('d M Y', strtotime( $value['created_on'] ));?>
												</div>
											</div>
										</li>
									<?php } ?>
										<!--<li>
											<div class="c-image">
												<img src="<?php echo frontend_asset_url()?>assets/base/img/content/stock/34.jpg" class="img-responsive" alt=""/>
											</div>
											<div class="c-post">
												<a href="" class="c-title">
												UX Design Expo 2015... </a>
												<div class="c-date">
													27 Jan 2015
												</div>
											</div>
										</li>
										<li>
											<div class="c-image">
												<img src="<?php echo frontend_asset_url()?>assets/base/img/content/stock/37.jpg" class="img-responsive" alt=""/>
											</div>
											<div class="c-post">
												<a href="" class="c-title">
												UX Design Expo 2015... </a>
												<div class="c-date">
													27 Jan 2015
												</div>
											</div>
										</li>
										<li>
											<div class="c-image">
												<img src="<?php echo frontend_asset_url()?>assets/base/img/content/stock/32.jpg" class="img-responsive" alt=""/>
											</div>
											<div class="c-post">
												<a href="" class="c-title">
												UX Design Expo 2015... </a>
												<div class="c-date">
													27 Jan 2015
												</div>
											</div>
										</li>
										<li>
											<div class="c-image">
												<img src="<?php echo frontend_asset_url()?>assets/base/img/content/stock/54.jpg" class="img-responsive" alt=""/>
											</div>
											<div class="c-post">
												<a href="" class="c-title">
												UX Design Expo 2015... </a>
												<div class="c-date">
													27 Jan 2015
												</div>
											</div>
										</li>-->
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