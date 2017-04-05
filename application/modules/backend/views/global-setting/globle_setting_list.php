<!-- page content -->
<div class="right_col" role="main">
    <!-- top tiles -->






    <div class="row"> 

        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
                <div class="x_title">
                    <?php
                    $msg = $this->session->userdata('msg');
                    ?>
                    <?php if ($msg != '') { ?>
                        <div class="msg_box alert alert-success">
                            <button type="button" class="close" data-dismiss="alert" id="msg_close" name="msg_close">X</button>
                            <?php
                            echo $msg;
                            $this->session->unset_userdata('msg');
                            ?> 
                        </div>
                        <?php
                    }
                    ?> 
                    <h2>Global Settings</h2>
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



                    <div class="table-responsive">
                        <table class="table table-striped jambo_table bulk_action">
                            <thead>
                                <tr class="headings">
                                    <th class="column-title">Sr No </th>
                                    <th class="column-title">Parameter Name </th>
                                    <th class="column-title">Parameter Value </th>
                                    </th>
                                    <th class="column-title">Action</th>
                                </tr>
                            </thead>

                            <tbody>
                                <?php
                                $cnt = 1;
                                foreach ($arr_global_settings as $global) {
                                    ?>
                                    <tr class="gradeA odd">
                                        <td class="center "><?php echo $cnt; ?></td>
                                        <td class=" sorting_1"><?php echo $global['name']; ?></td>
                                        <td class=" "><?php echo $global['value']; ?></td>
                                        <td class="last"><a href="<?php echo base_url(); ?>admin/global-settings/edit/<?php echo base64_encode($global['global_id']); ?>" class="btn btn-warning"><i class="fa fa-edit"></i> Edit</a> </td>
                                    </tr>
                                    <?php
                                    $cnt++;
                                }
                                ?>
                            </tbody>
                        </table>
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