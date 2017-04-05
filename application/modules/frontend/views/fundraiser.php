
<div class="c-layout-page">
            <!-- BEGIN: LAYOUT/BREADCRUMBS/BREADCRUMBS-1 -->
            <div class="c-layout-breadcrumbs-1 c-fonts-uppercase c-fonts-bold">
                <div class="container">
                    <div class="c-page-title c-pull-left">
                        <h3 class="c-font-uppercase c-font-sbold"></h3>
                    </div>
                    <ul class="c-page-breadcrumbs c-theme-nav c-pull-right c-fonts-regular">
                        <li>
                            <a href="#"></a>
                        </li>
                        <li></li>
                        <li>
                            <a href="page-4col-portfolio.html"></a>
                        </li>
                        <li></li>
                        <li class="c-state_active"></li>
                    </ul>
                </div>
            </div>
			
			<!-- BEGIN: PAGE CONTENT -->
	<div class="c-content-box c-size-md">
		<div class="container">
			<?php if(!empty($project_categories)){ ?>
			<div class="c-content-title-1">
				<h3 class="c-center c-font-uppercase">"<?php if( !empty($project_categories)) { echo $project_categories['category_name']; } ?>"</h3>
			</div>
		<?php } ?>
			<div id="grid-container" class="cbp">
			<?php 
						 if(!empty( $projects )){
							 $i=1;
							foreach( $projects as $key => $value ) {
								if($i % 5==0){ ?>
								<div class="clearfix"></div>	
									
							<?php	}
						?>
				<div class="cbp-item graphic" style="height:380px">
					<div class="cbp-caption">
						<div class="cbp-caption-defaultWrap">
							<img src="<?php echo base_url().'uploads/projects/cover_image/thumbnail/'.$value['cover_image'];?>" alt="">
						</div>
						<div class="cbp-caption-activeWrap">
							<div class="cbp-l-caption-alignCenter">
								<div class="cbp-l-caption-body">
									<a href="<?php echo base_url() . 'project-detail/'.$value['project_id'];?>" class="cbp-l-caption-buttonLeft btn btn-sm c-btn-square c-btn-border-1x c-btn-white c-btn-uppercase">Explore</a>
									<!--<a href="#" class="cbp-lightbox cbp-l-caption-buttonRight btn btn-sm c-btn-square c-btn-border-1x c-btn-white c-btn-uppercase" data-title="Dashboard<br>by Paul Flavius Nechita">Zoom</a>-->
								</div>
							</div>
						</div>
					</div>
					<div class="cbp-l-grid-projects-title" style="white-space:NORMAL;">
						<?php echo $value['project_title'];?>
					</div>
					<div class="cbp-l-grid-projects-desc " style="white-space:NORMAL;">
						<?php /*echo $desc = substr(stripslashes($value['long_desc']), 0, 50); */
										$desc = preg_replace('/[ \t]+/', ' ', preg_replace('/\s*$^\s*/m', "\n", trim(strip_tags($value['short_description']))));
										//echo $desc = substr(stripslashes( $desc ), 0, 100 );
										echo $value['short_description'] ;
										
										?>
					</div>
				</div>
				 <?php 
				      $i++;
				     } } ?>
			
				
			</div>
			<div id="loadMore-container" class="cbp-l-loadMore-button c-margin-t-60">
				<div class="c-pagination">
							
							<ul class="c-content-pagination c-theme">

                        <?php echo $pg_link; ?>
                    </ul>
						</div>
			</div>
		</div>
	</div>
	<div class="c-content-box c-size-md c-bg-white">
						<div class="container">
							<!-- Begin: Testimonals 1 component -->
							<div class="c-content-client-logos-slider-1" data-slider="owl">
								<!-- Begin: Title 1 component -->
								<div class="c-content-title-1">
									<h3 class="c-center c-font-uppercase c-font-bold">Categories</h3>
									<div class="c-line-center c-theme-bg"></div>
								</div>
								<!-- End-->
								<!-- Begin: Owlcarousel -->
								<div class="owl-carousel owl-theme c-theme c-owl-nav-center" data-items="5" data-desktop-items="4" data-desktop-small-items="3" data-tablet-items="3" data-mobile-small-items="1" data-auto-play="false" data-rtl="false" data-slide-speed="5000"        data-auto-play-hover-pause="true">
								<?php 
								 if(!empty( $categories )){
									foreach( $categories as $key => $value ) {
								?>
									<div class="item">
										<a href="<?php echo base_url().'fundraiser/cat/'.$value['category_id'];?>"><?php /*echo $value['category_name'];*/ ?>
											<img src="<?php echo base_url().'uploads/projects/category/'.$value['image'];?>" alt="<?php echo $value['category_name'];?>"  title="<?php echo $value['category_name'];?>"/> 
										</a>
									</div>
								 <?php } } ?>	
									
								</div>
								<!-- End-->
							</div>
							<!-- End-->
						</div>
					</div>
				
	<!-- END: PAGE CONTENT -->
        </div>

 
 