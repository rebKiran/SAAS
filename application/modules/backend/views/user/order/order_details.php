<style>
    .danger, .mandatory {
        color: #BD4247;
    }
    .alert{
        padding:8px 20px;
    }
	#tags_1_tagsinput {
		width:66% !important;
	}
	
</style>
</style>
<script src="<?php echo base_url(); ?>assets/backend/js/jquery.validate.min.js"></script> 
<script src="//cdn.ckeditor.com/4.6.2/standard/ckeditor.js"></script>


<!-- page content -->
<div class="right_col" role="main"> <!-- top tiles -->
    <div class="row">
	
        <div class="col-md-12 col-sm-12 col-xs-12">
		<?php
    $msg = $this->session->userdata('msg');
    $this->session->unset_userdata('msg');
    if (isset($msg) != '') {
        ?>
        <div class="alert alert-success alert-dismissable">
            <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
            <h4><i class="icon fa fa-check"></i> Success!</h4>
            <?php echo $msg; ?>
        </div>
    <?php } ?>
    
    <?php
    $error = $this->session->userdata('error');
    $this->session->unset_userdata('error');
    if (isset($error) != '') {
        ?>
        <div class="alert alert-danger alert-dismissable">
            <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
            <h4><i class="fa fa-times" aria-hidden="true"></i></i> Error!</h4>
            <?php echo $error; ?>
        </div>
    <?php } ?>
            <div class="x_panel">
                <div class="x_title">
                    <h2>Order Details</h2>
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
                    <br>
                       
					   <div class="col-md-8 col-sm-12 col-xs-12">
							<div class="x_panel">
								<div class="x_title">
									<h2>Customer Details</h2>

									<div class="clearfix"></div>
								</div>
								<div class="x_content">                           
									<div class="form-group">
										<label class="col-md-3 col-sm-3 col-xs-12">Order Number</label>
										<div class="col-md-9 col-sm-9 col-xs-12">
											<?php 
											$arrOrder = explode( '-', $order[0]['ord_order_number'] );
											$orderNo = $arrOrder[2];
										   if(!empty($orderNo)) { echo stripslashes($order[0]['ord_order_number']); } ?>                        </div>
									</div>
								</div>
								<div class="x_content">   
									<div class="form-group">
										<label class="col-md-3 col-sm-3 col-xs-12">Email</label>
										<div class="col-md-9 col-sm-9 col-xs-12">
											 <?php 
											
										   if(!empty($order[0]['ord_email'])) { echo stripslashes($order[0]['ord_email']); } ?>                         </div>
									</div>
								</div>
								<div class="x_content">   
									<div class="form-group">
										<label class="col-md-3 col-sm-3 col-xs-12">Phone</label>
										<div class="col-md-9 col-sm-9 col-xs-12">
										   <?php 
											
										   if(!empty($order[0]['ord_phone'])) { echo stripslashes($order[0]['ord_phone']); } ?>                          </div>
									</div>
								</div>
								<div class="x_content">   
									<div class="form-group">
										<label class="col-md-3 col-sm-3 col-xs-12">Postal Code</label>
										<div class="col-md-9 col-sm-9 col-xs-12">
											<?php 
											
										   if(!empty($order[0]['ord_bill_post_code'])) { echo stripslashes($order[0]['ord_bill_post_code']); } ?>                         </div>
									</div>
								</div>
								<div class="x_content">   
									<div class="form-group">
										<label class="col-md-3 col-sm-3 col-xs-12">Shipping Details</label>
										<div class="col-md-9 col-sm-9 col-xs-12">
											<?php echo stripslashes($order[0]['ord_bill_address_01']) . ', ' .stripslashes($order[0]['ord_bill_address_02']). ', ' .stripslashes($order[0]['state']). ', ' .stripslashes($order[0]['city']) . ', ' . stripslashes($order[0]['ord_bill_post_code']); ?>                        </div>
									</div>
								</div>
								<div class="x_content">   
									<div class="form-group">
										<label class="col-md-3 col-sm-3 col-xs-12">Order Date</label>
										<div class="col-md-9 col-sm-9 col-xs-12">
											   <?php if(!empty($order[0]['ord_date'])) { echo stripslashes($order[0]['ord_date']); } ?>                        </div>
									</div>
								</div>
								<div class="x_content">   
									<div class="form-group">
										<label class="col-md-3 col-sm-3 col-xs-12">Payment Mode</label>
										<div class="col-md-9 col-sm-9 col-xs-12">
											<b><?php if(!empty($order[0]['delivery_option'])) { echo stripslashes($order[0]['delivery_option']); } ?></b>
										</div>
									</div>
								</div>
							</div>
						</div>
						<br/>
						<div class="x_content">
							<div class="x_title">
                        <h2>Item List</h2>

                        <div class="clearfix"></div>
                    </div>
					<table class="table table-hover table-bordered">
                    <thead>
                        <tr role="row">
                           
                            <th>Name</th>
                            <th>Price</th>
                            <th>Quantity</th>
                            <th>Total</th>
                        </tr>


                    </thead>
                    <tbody>
					<?php  
					
						if(!empty($post_info)) {
							$total = 0;
							foreach($post_info as $key => $value ){
								
								$total += $value['ord_det_price_total'];
								?>
						<tr>

							<td class="worktd" align="left"><?php echo $value['ord_det_item_name']; ?></td>
							<td><?php echo $global['currency_symbol'] . ' ' . $value['ord_det_price']; ?> </td>
							<td class="worktd" align="left"><?php echo $value['ord_det_quantity']; ?></td>
							<td><?php echo $global['currency_symbol'] . ' ' . $value['ord_det_price_total']; ?></td>

						</tr>
						<?php }  ?>
						<tr>
							<td colspan="3" style="text-align:center;font-weight:bold;color:000">Total Amount</td>
							<td colspan="" style="font-weight:bold;color:000"><?php echo $global['currency_symbol'] . ' ' . $total;?></td>
						</tr>
						<?php }  ?>	
                    </tbody>
                </table>
                                    <!--<input type="submit" id="btn_delete_all" name="btn_delete_all" class="btn btn-danger" onClick="return deleteConfirm();"  value=" Delete Selected">-->
                

            </div>
                        <div class="ln_solid"></div>
                        <div class="form-group">
                            <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                                <!--button type="submit" class="btn btn-success">Submit</button>-->
                               
                            </div>
                        </div>

                   
                </div>
            </div>
        </div>
    </div>
    <!-- end of weather widget -->
</div>
</div>
</div>
</div>
<!-- /page content -->