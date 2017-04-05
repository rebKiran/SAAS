<!-- page content -->
        <div class="right_col" role="main">
          <div class="">
            <div class="page-title">
              <div class="title_left">
                <h3>Funding Detail</h3>
              </div>

              <div class="title_right">
                <div class="col-md-5 col-sm-5 col-xs-12 form-group pull-right top_search">
                  
                </div>
              </div>
            </div>
            
            <div class="clearfix"></div>

            <div class="row">
              <div class="col-md-12">
                <div class="x_panel">
                  <div class="x_title">
                     <h2 style="font-size:33px"><?php echo $project->project_title; ?></h2>
                   
                    <ul class="nav navbar-right panel_toolbox">
                      <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                      </li>
                      <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench"></i></a>
                        <ul class="dropdown-menu" role="menu">
                          <li><a href="#">Settings 1</a>
                          </li>
                          <li><a href="#">Settings 2</a>
                          </li>
                        </ul>
                      </li>
                      <li><a class="close-link"><i class="fa fa-close"></i></a>
                      </li>
                    </ul>
                    <div class="clearfix"></div>
                  </div>

                  <div class="x_content">

                    <div class="col-md-9 col-sm-9 col-xs-12">

                      <ul class="stats-overview">
                        <li>
                          <span class="name">pledged of $<?php if(is_object($project_details)) { echo $project_details->total; } else { echo ' 0.00'; } ?> goal</span>
                          <span class="value text-success"> $<?php if(is_object($project_details)) { echo $project_details->total; } else { echo ' 0.00'; } ?> </span>
                        </li>
                        <li>
                          <span class="name"> backers</span>
                          <span class="value text-success"> <?php if(is_object($project_details)) {  echo $project_details->cnt_records; } else { echo ' 0'; } ?></span>
                        </li>
                        
                      </ul>
                      <br />

                      <div id="mainb" style="height:350px;"><?php
                                if ($project->media_type == 1) {
                                    ?>
                                    <img src="<?php echo base_url(); ?>uploads/projects/project_media/<?php echo $project->project_media; ?>" height="300" width="500"/>
                                <?php } else { ?>
                                    <video width="700" height="300" controls>
                                        <source src="<?php echo base_url(); ?>uploads/projects/project_media/<?php echo $project->project_media; ?>" type="video/mp4">
                                        <source src="<?php echo base_url(); ?>uploads/projects/project_media/<?php echo $project->project_media; ?>" type="video/ogg">
                                        Your browser does not support the video tag.
                                    </video>
                                <?php } ?></div>

                      <div>

                        <h4>Description</h4>

                        <!-- end of user messages -->
                      <?php echo $project->project_description; ?>
                        <!-- end of user messages -->


                      </div>


                    </div>

                    <!-- start project-detail sidebar -->
                    <div class="col-md-3 col-sm-3 col-xs-12">

                      <section class="panel">
					  <div class="x_title">
                          <h2>Project Summary</h2>
						  <div class="clearfix"></div>
                       </div>
						  <div class="panel-body">
						 
						  <p><?php echo $project->short_description; ?></p>
                          <div class="clearfix"></div>
						  
                        </div>
 
                        <div class="x_title">
                          <h2> Offers</h2>
                          <div class="clearfix"></div>
                        </div>
                        <div class="panel-body">
						<?php 
							    $i = 1;
							    foreach($offers as $offer){
							 
							?>
                          <p><?php echo $offer->offers;?> </p>
                        <?php 
						      $i++;
						   } ?>  <br />

                          
                          </div>
						  <br />
                          <h5>Funded History</h5>
                          <ul class="list-unstyled project_files">
						  <?php 
							    $i = 1;
							    foreach($fundingDetails as $fundingDetail){
							 
							?>
                            <li><a href=""><?php echo '$ ' . $fundingDetail->price . ', ' . date('d F Y',strtotime($fundingDetail->created_date));?></a>
                            </li>
							<?php 
						      $i++;
						   } ?>
                           
                          </ul>
                          <br />
                        </div>

                      </section>

                    </div>
                    <!-- end project-detail sidebar -->

                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
<!-- /page content -->