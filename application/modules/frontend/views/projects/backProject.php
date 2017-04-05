<div class="c-layout-page">
    <!-- BEGIN: LAYOUT/BREADCRUMBS/BREADCRUMBS-3 -->
    
    <!-- END: LAYOUT/BREADCRUMBS/BREADCRUMBS-3 -->
    <!-- BEGIN: CONTENT/SHOPS/SHOP-PRODUCT-DETAILS-2 -->
    <div class="c-content-box c-size-lg c-overflow-hide c-bg-white">
        <div class="container">
            <div class="col-md-8">
			
			<h2>Support this project</h2>
				<form class="form-horizontal">
				<div class="box-shadow">
					
					<div class="form-group no-margin">
					   
						<div class="col-md-1">
							<div class="c-radio-list mt10">
								<div class="c-radio">
									<input type="radio" id="radio1-112" class="c-radio" name="radios1">
									<label for="radio1-112">
										<span></span>
										<span class="check"></span>
										<span class="box"></span></label>
								</div>
							   
							</div>
						</div>
						
					<div class="col-md-11">
					<div class="col-md-6">
					<h2 class="">Make a pledge without a reward</h2>
					
					<div class="icon-addon addon-lg" >
					<label for="email" class="fa fa-usd" rel="tooltip" title="email"></label>
						<input type="text" placeholder="Amount" class="form-control" name="amount" id="amount1-112"  value="">
						
					</div>
										<input type="hidden" id='price' value=''>
										<input type="hidden" id='name' value='<?php echo $data->project_title; ?>'>
										<input type="hidden" id='product_id' value='<?php echo $project_id; ?>'>
										<input type="hidden" id='qty' value='1'>	

					</div>
					<div class="col-md-6">
										<a href="javascript:;" class="btn c-theme-btn c-btn-uppercase btn-lg c-btn-bold c-btn-square add_to_cart" >Donate</a>
										</div>
					
					</div>
					
					</div>
                                       
                                       
                                   
				</div>
				<?php	foreach($offers as $key => $value ){	?>
				<div class="box-shadow">
					
                                        <div class="form-group no-margin">
                                           
                                            <div class="col-md-1">
                                                <div class="c-radio-list mt10">
                                                    <div class="c-radio">
                                                        <input type="radio" id="radio<?php echo $key+1;?>" class="c-radio" name="radios1">
                                                        <label for="radio<?php echo $key+1;?>">
                                                            <span></span>
                                                            <span class="check"></span>
                                                            <span class="box"></span></label>
                                                    </div>
                                                   
                                                </div>
                                            </div>
											
										<div class="col-md-11">
										<div class="col-md-6">
										<h2 class=""><?php echo '$ ' . $value->price; ?></h2>

										<h3><?php echo $value->offers;?></h3>
										
										<div class="icon-addon addon-lg">
										<label for="email" class="fa fa-usd" rel="tooltip" title="email"></label>
											<input type="text" placeholder="Amount" name="amount" class="form-control" id="amount<?php echo $key+1;?>" value="<?php echo $value->price;?>">
											
										</div>
											
										<input type="hidden" id='price' value='<?php echo $value->price; ?>'>
										<input type="hidden" id='name' value='<?php echo $data->project_title; ?>'>
										<input type="hidden" id='product_id' value='<?php echo $project_id; ?>'>
										<input type="hidden" id='qty' value='1'>	

										
										<!--<h3>Digital Background</h3>-->

										<!--<p></p>-->
                                        </div>
										<div class="col-md-6">
										<a href="javascript:;" class="btn c-theme-btn c-btn-uppercase btn-lg c-btn-bold c-btn-square add_to_cart">Donate</a>
										</div>
										<!--<div class="col-md-6">
										<p class="no-margin">ESTIMATED DELIVERY</p>
										<h2 class="no-margin">Apr 2017</h2>
                                        </div>
										<div class="clear"></div>
										<div class="box-shadow-footer">
											<div class="row">
											<div class="col-md-12">
											
											<form>
											<div class="col-md-9">
												<div class="icon-addon addon-lg">
													<input type="text" placeholder="Email" class="form-control" id="email">
													<label for="email" class="fa fa-usd" rel="tooltip" title="email"></label>
												</div>
											</div>
											<div class="col-md-3">
												<div class="icon-addon addon-md">
													<button class="btn btn-lg c-btn-green c-font-uppercase c-btn-square">Continue</button>
												</div>
											</div>
											</form>
											</div>
											</div>
										</div> -->
										
                                        </div>
                                        </div>
                                       
                                       
                                   
				</div>
				
				<?php }?>
				
				 </form>
				
			</div>

			<div class="col-md-1"></div>
			
            <div class="col-md-3">
                            <!-- BEGIN: CONTENT/BLOG/BLOG-SIDEBAR-1 -->
                           <div class="c-content-ver-nav">
                                <div class="c-content-title-1 c-theme c-title-md c-margin-t-40">
                                    <h3 class="c-font-bold c-font-uppercase">Lorem ipsum</h3>
                                    <div class="c-line-left c-theme-bg"></div>
                                </div>
								<p>
								Lorem ipsum dolor sit amet, consectetur adipiscing elit. Fusce nisl libero, blandit vel purus et, 
								finibus sodales nulla. Morbi sagittis pulvinar odio elementum consectetur. Orci varius natoque penatibus 
								et magnis dis parturient montes, nascetur ridiculus mus.
								</p>
                            </div>
						   
						   
                            <div class="c-content-ver-nav">
                                <div class="c-content-title-1 c-theme c-title-md c-margin-t-40">
                                    <h3 class="c-font-bold c-font-uppercase">Lorem ipsum dolor</h3>
                                    <div class="c-line-left c-theme-bg"></div>
                                </div>
                                <ul class="c-menu c-arrow-dot1 c-theme">
                                    <li>
                                        <a href="#">Consectetur adipiscing</a>
                                    </li>
                                    <li>
                                        <a href="#">Fusce nisl libero</a>
                                    </li>
                                    <li>
                                        <a href="#">Orci varius</a>
                                    </li>
                                    <li>
                                        <a href="#">Morbi sagittis</a>
                                    </li>
                                    <li>
                                        <a href="#">nascetur ridiculus</a>
                                    </li>
                                </ul>
                            </div>
                            
                            <div class="c-content-ver-nav">
                                <div class="c-content-title-1 c-theme c-title-md c-margin-t-40">
                                    <h3 class="c-font-bold c-font-uppercase">Parturient montes</h3>
                                    <div class="c-line-left c-theme-bg"></div>
                                </div>
                                <ul class="c-menu c-arrow-dot c-theme">
                                     <li>
                                        <a href="#">Consectetur adipiscing</a>
                                    </li>
                                    <li>
                                        <a href="#">Fusce nisl libero</a>
                                    </li>
                                    <li>
                                        <a href="#">Orci varius</a>
                                    </li>
                                    <li>
                                        <a href="#">Morbi sagittis</a>
                                    </li>
                                    <li>
                                        <a href="#">nascetur ridiculus</a>
                                </ul>
                            </div>
                            <!-- END: CONTENT/BLOG/BLOG-SIDEBAR-1 -->
                        </div>
                           
					
		</div>
    </div>
    <!-- END: CONTENT/SHOPS/SHOP-PRODUCT-DETAILS-2 -->

    <!-- END: PAGE CONTENT -->
    <!-- END: PAGE CONTENT -->
</div>
