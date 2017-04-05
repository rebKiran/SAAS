<div class="c-layout-page">
            <!-- BEGIN: LAYOUT/BREADCRUMBS/BREADCRUMBS-3 -->
	<div class="c-layout-breadcrumbs-1 c-bgimage c-subtitle c-fonts-uppercase c-fonts-bold c-bg-img-center" style="background-image: url(<?php echo frontend_asset_url()?>assets/base/img/content/backgrounds/bg-28.jpg)">
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
	<!-- BEGIN: BLOG LISTING -->
	<div class="c-content-box c-size-md">
		<div class="container">
		
		<?php 
		
		if(!empty($search)){ ?>
			<div class="c-content-title-1">
				<h3 class="c-center c-font-uppercase">Search Results For "<?php echo $search;?>"</h3>
			</div>
			
			
		<?php } ?>
		<?php if(!empty($paper_categories)){ ?>
			<div class="c-content-title-1">
				<h3 class="c-center c-font-uppercase">"<?php  echo $paper_categories['category_name']; ?>"</h3>
			</div>
		<?php } ?>
		<p><br/></p>
			<div class="row">
				<div class="col-md-9">
					<div class="c-content-blog-post-1-list">
					<?php 
					 if(!empty( $blogs )){
					foreach( $blogs as $key => $value ) { ?>
						<div class="c-content-blog-post-1">
							<div class="c-media">
								<div class="c-content-media-2-slider" data-slider="owl" data-single-item="true" data-auto-play="4000">
									<div class="owl-carousel owl-theme c-theme owl-single">
										<div class="item">
											<div class="c-content-media-2" style="background-image: url(<?php echo base_url().'uploads/blogs/670x470/'.$value['blog_image']; ?>); min-height: 460px;">
											</div>
										</div>
										
									</div>
								</div>
							</div>
							<div class="c-title c-font-bold c-font-uppercase">
								<a href="<?php echo base_url() . 'blog-page/'.$value['slug'];?>"><?php echo $value['post_title']; ?></a>
							</div>
							<div class="c-desc">
								<?php echo $value['post_content']; ?><a href="<?php echo base_url() . 'blog-page/'.$value['slug'];?>">read more...</a>
							</div>
							<div class="c-panel">
								<div class="c-date">
									on <span class="c-font-uppercase"><?php echo date('d M Y, H:i A', strtotime( $value['posted_on'] ));?>
									</span>
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
								<!--<div class="c-comments">
									<a href="#"><i class="icon-speech"></i> 30 comments</a>
								</div> -->
							</div>
						</div>
					<?php } 
					 } else {	?>
					 <div class="c-content-title-1">
									<h3 class="c-center c-font-lowercase c-font-sbold">No Result Found.</h3>
									<div class="c-line-center c-theme-bg"></div>
							</div>
					 <?php } ?>
						<!--<div class="c-content-blog-post-1">
							<div class="c-media">
								<iframe src="https://player.vimeo.com/video/105329112" width="100%" height="381" frameborder="0" webkitallowfullscreen mozallowfullscreen allowfullscreen>
								</iframe>
							</div>
							<div class="c-title c-font-bold c-font-uppercase">
								<a href="#">The Future...</a>
							</div>
							<div class="c-desc">
								 Lorem ipsum dolor sit amet, coectetuer diam ipsum dolor sit amet nonummy coectetuer diam ipsum dolor sit coectetuer adipiscing elit adipiscing consectetuer ipsum dolor sit amipiscing elit sit amet, sit amet, coectetuer adipiscing elit adipiscing consectetuer ipsum dolor sit amet diam nonummy adipiscing elit sit amet, sit ame. <a href="#">read more...</a>
							</div>
							<div class="c-panel">
								<div class="c-author">
									<a href="#">By <span class="c-font-uppercase">Nick Strong</span></a>
								</div>
								<div class="c-date">
									on <span class="c-font-uppercase">20 May 2015, 10:30AM</span>
								</div>
								<ul class="c-tags c-theme-ul-bg">
									<li>
										hi-tech
									</li>
									<li>
										enginering
									</li>
									<li>
										robots
									</li>
								</ul>
								<div class="c-comments">
									<a href="#"><i class="icon-speech"></i> 30 comments</a>
								</div>
							</div>
						</div>
						<div class="c-content-blog-post-1">
							<div class="c-media">
								<div class="c-content-media-2-slider" data-slider="owl" data-single-item="true" data-auto-play="4000">
									<div class="owl-carousel owl-theme c-theme owl-single">
										<div class="item">
											<div class="c-content-media-2" style="background-image: url(<?php echo frontend_asset_url()?>assets/base/img/content/stock/23.jpg); min-height: 360px;">
											</div>
										</div>
										<div class="item">
											<div class="c-content-media-2" style="background-image: url(<?php echo frontend_asset_url()?>assets/base/img/content/stock/34.jpg); min-height: 360px;">
											</div>
										</div>
										<div class="item">
											<div class="c-content-media-2" style="background-image: url(<?php echo frontend_asset_url()?>assets/base/img/content/stock/37.jpg); min-height: 360px;">
											</div>
										</div>
									</div>
								</div>
							</div>
							<div class="c-title c-font-bold c-font-uppercase">
								<a href="#">TAKE THE WEB BY STORM WITH JANGO</a>
							</div>
							<div class="c-desc">
								 Lorem ipsum dolor sit amet, coectetuer diam ipsum dolor sit amet nonummy coectetuer diam ipsum dolor sit coectetuer adipiscing elit adipiscing consectetuer ipsum dolor sit amipiscing elit sit amet, sit amet, coectetuer adipiscing elit adipiscing consectetuer ipsum dolor sit amet diam nonummy adipiscing elit sit amet, sit ame. <a href="#">read more...</a>
							</div>
							<div class="c-panel">
								<div class="c-author">
									<a href="#">By <span class="c-font-uppercase">Nick Strong</span></a>
								</div>
								<div class="c-date">
									on <span class="c-font-uppercase">20 May 2015, 10:30AM</span>
								</div>
								<ul class="c-tags c-theme-ul-bg">
									<li>
										ux
									</li>
									<li>
										web
									</li>
									<li>
										html
									</li>
								</ul>
								<div class="c-comments">
									<a href="#"><i class="icon-speech"></i> 30 comments</a>
								</div>
							</div>
						</div> -->
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
					<form action="<?php echo base_url().'blog/'?>" method="post">
						<div class="input-group">
							<input type="text"  name="search_blog" id="search_blog" class="form-control c-square c-theme-border" placeholder="Search blog...">
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
								<a href="<?php echo base_url() . 'blog/cat/'.$value['category_id'];?>"><?php echo $value['category_name'];?> (<?php echo $value['total'];?>)</a>
							</li>
						<?php  } ?>
							
						</ul>
					</div>
					<div class="c-content-tab-1 c-theme c-margin-t-30">
						<div class="nav-justified">
							<ul class="nav nav-tabs nav-justified">
								<li class="active">
									<a href="#blog_recent_posts" data-toggle="tab">Recent Blogs</a>
								</li>
								<li>
									<a href="#blog_popular_posts" data-toggle="tab">Popular Blogs</a>
								</li>
							</ul>
							<div class="tab-content">
								<div class="tab-pane active" id="blog_recent_posts">
								<ul class="c-content-recent-posts-1">
									<?php 
									
									foreach( $blog_posts as $key => $value ) { ?>
										<li>
											<div class="c-image">
												<img src="<?php echo base_url().'uploads/blogs/233x155/'. $value['blog_image']; ?>" alt="" class="img-responsive"	>
											</div>
											<div class="c-post">
												<a href="<?php echo base_url() . 'blog-page/'.$value['slug'];?>" class="c-title">
												<?php echo $value['post_title'];?></a>
												<div class="c-date">
													<?php echo date('d M Y', strtotime( $value['posted_on'] ));?>
												</div>
											</div>
										</li>
									<?php } ?>
									</ul>
									
									<!--<ul class="c-content-recent-posts-1">
										<li>
											<div class="c-image">
												<img src="<?php echo frontend_asset_url()?>assets/base/img/content/stock/09.jpg" alt="" class="img-responsive">
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
										</li>
									</ul> -->
								</div>
								<div class="tab-pane" id="blog_popular_posts">
									<ul class="c-content-recent-posts-1">
									
										<?php 
										
										foreach( $popular_posts as $key => $value ) { ?>
											<li>
												<div class="c-image">
													<img src="<?php echo base_url().'uploads/blogs/233x155/'. $value['blog_image']; ?>" alt="" class="img-responsive"	>
												</div>
												<div class="c-post">
													<a href="<?php echo base_url() . 'blog-page/'.$value['slug'];?>" class="c-title">
													<?php echo $value['post_title'];?></a>
													<div class="c-date">
														<?php echo date('d M Y', strtotime( $value['posted_on'] ));?>
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
					<!--<div class="c-content-ver-nav">
						<div class="c-content-title-1 c-theme c-title-md c-margin-t-40">
							<h3 class="c-font-bold c-font-uppercase">Blogs</h3>
							<div class="c-line-left c-theme-bg">
							</div>
						</div>
						<ul class="c-menu c-arrow-dot c-theme">
							<li>
								<a href="#">Fasion & Arts</a>
							</li>
							<li>
								<a href="#">UX & Web Design</a>
							</li>
							<li>
								<a href="#">Mobile Development</a>
							</li>
							<li>
								<a href="#">Internet Marketing</a>
							</li>
							<li>
								<a href="#">Frontend Development</a>
							</li>
						</ul>
					</div>-->
					<!-- END: CONTENT/BLOG/BLOG-SIDEBAR-1 -->
				</div>
			</div>
		</div>
	</div>
	<!-- END: BLOG LISTING  -->
	<!-- END: PAGE CONTENT -->
</div>