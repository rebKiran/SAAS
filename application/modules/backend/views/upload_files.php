<!-- page content -->
        <div class="right_col" role="main">
          <div class="">
            <div class="page-title">
              <div class="title_left">
                <h3>Project Images Upload </h3>
              </div>

              <!--div class="title_right">
                <div class="col-md-5 col-sm-5 col-xs-12 form-group pull-right top_search">
                  <div class="input-group">
                    <input type="text" class="form-control" placeholder="Search for...">
                    <span class="input-group-btn">
                      <button class="btn btn-default" type="button">Go!</button>
                    </span>
                  </div>
                </div>
              </div-->
            </div>

            <div class="clearfix"></div>

            <div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  
				  
				  <div id="project_selector">
				 
                   <div class="x_title">
                    <h2>Select A Project To Upload Files</h2>
                    
                    <div class="clearfix"></div>
                  </div>				 
				 
				 <div class="x_content">
                    <br />
					
					<div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Project Name <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                         <select class="form-control col-md-7 col-xs-12" onchange="setProjectValue(this.value)">
						  <option value="">Select Project</option>
						  <?php 
						      foreach($project_list as $project){
						  ?>
						  <option value="<?php echo $project->project_name;?>"><?php echo $project->project_name;?></option>
							  <?php }?>
						 </select>
                        </div>
                      </div>
				   </div>	
				 
				 </div>
				  
				  
				  <div id="uploader" style="display:none;">
				  <div class="x_title">
                    <h2>Drag & Drop Images To Upload</h2>
                    
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                    <p>Drag multiple files to the box below for multi upload or click to select files.</p>
                    <form action="<?php echo base_url();?>backend/project/uploadProjectFiles" class="dropzone">
					 <!--input type="hidden" name="project_id" name="project_id"/-->
					</form>
                    <br />
                    <br />
                    <br />
                    <br />
                  </div>
				 </div>
				 
				 
				 
				 
				 
				 
				 
				 
                </div>
              </div>
            </div>
          </div>
        </div>
        <!-- /page content -->
		
<script>
     function setProjectValue(project_id)
	 {
		 
		 if(project_id=="")
		 {
			 $("#uploader").hide();
		 }
		 else
		 {
			 
			 $("#uploader").show();
			 //$("#project_id").val(project_id);
			 $.ajax({
				 
				 url:'<?php echo base_url();?>backend/project/setProjectId',
				 method:'post',
				 async: false,
				 data:{'project_id':project_id},
				 success:function(data){
							   
						 }	
			     
			 });
		 }	 
		 
	 }
</script>		