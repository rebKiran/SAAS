<!-- page content -->
<div class="right_col" role="main">
    <div class="">
        <div class="page-title">
            <div class="title_left">
                <h3>Connected Users</h3>
            </div>

            <div class="title_right">
                <div class="col-md-5 col-sm-5 col-xs-12 form-group pull-right top_search">
                    <div class="input-group">
                        <input type="text" class="form-control" placeholder="Search for...">
                        <span class="input-group-btn">
                            <button class="btn btn-default" type="button">Go!</button>
                        </span>
                    </div>
                </div>
            </div>
        </div>

        <div class="clearfix"></div>

        <div class="row">




            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                    <div class="x_title">
                        <h2>Project List</h2>
                        <!--ul class="nav navbar-right panel_toolbox">
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
                        </ul-->
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="card-box table-responsive">
                                    <!--p class="text-muted font-13 m-b-30">
                                      KeyTable provides Excel like cell navigation on any table. Events (focus, blur, action etc) can be assigned to individual cells, columns, rows or all cells.
                                    </p-->

                                    <table id="datatable-keytable" class="table table-striped table-bordered">
                                        <thead>
                                            <tr>
                                                <th>S. No.</th>
                                                <th>Username</th>
                                                <th>Added Date</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>


                                        <tbody>

                                            <?php
                                            $i = 1;
                                            if ($connected_users != '') {
                                                foreach ($connected_users as $connected_users) {
                                                    ?>
                                                    <tr>
                                                        <td><?php echo $i; ?></td>
                                                        <td><?php echo $connected_users['username']; ?></td>
                                                        <td><?php echo date('d F Y', strtotime($connected_users['created_time'])); ?></td>
                                                        <td>
                                                            <a title="Edit Project" href="javascript:;" onclick="showchatmodal(<?php echo $connected_users['id'], "," . $projectid ?>)" class="btn btn-info btn-xs" ><i class="fa fa-comment"></i> Chat</a>
                                                        </td>
                                                    </tr>
                                                    <?php
                                                    $i++;
                                                }
                                            } else {
                                                echo "<tr><td colspan=5>No records found</td></tr>";
                                            }
                                            ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>


    </div>
</div>
<!-- /page content -->
<div class="modal fade" id="chatpopup" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title" id="myModalLabel">Message Summary</h4>
            </div>
            <div class="modal-body">
                <div class="container">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="panel panel-primary">

                                <div class="panel-body" id="msgdata">

                                </div>
                                <div class="panel-footer">
                                    <div class="input-group">
                                        <input id="message" type="text" class="form-control input-sm" placeholder="Type your message here..." />
                                        <span class="input-group-btn">
                                            <button class="btn btn-warning btn-sm" onclick="sendmsg(<?php echo $projectid ?>)" id="btn-chat">

                                                Send</button>
                                            <input type="hidden" id="hiduserid">
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<script>
    function showchatmodal(userid, projectid) {
        $('#chatpopup').modal('toggle');
        $('#hiduserid').val(userid);

        var url = "<?php echo base_url() ?>backend/project/getConnectedChats"; // the script where you handle the form input.


        $.ajax({
            type: "POST",
            url: url,
            data: {user_id: userid, project_id: projectid}, // serializes the form's elements.
            dataType: 'json',
            success: function (data)
            {
                //alert(data.data);
                if (data.status === '1') {
                    $("#msgdata").html(data.data);
                    return true;
                } else {
                    $("#testi_status").html('<div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert">X</button><strong>' + data.msg + '</div>');
                    return false;
                }
            }
        });

    }
    function sendmsg(projectid) {
        var url = "<?php echo base_url() ?>backend/project/sendMsg"; // the script where you handle the form input.

        if ($("#message").val() === '') {
            $("#message").css("border-color", "red");
            return false;
        }
        $.ajax({
            type: "POST",
            url: url,
            data: {userid: $("#hiduserid").val(), project_id: projectid, message: $("#message").val()}, // serializes the form's elements.
            dataType: 'json',
            success: function (data)
            {
                //alert(data.data);
                if (data.status === '1') {
                    $("#msgdata").html(data.data);
                    return true;
                } else {
                    $("#testi_status").html('<div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert">X</button><strong>' + data.msg + '</div>');
                    return false;
                }
            }
        });

    }
</script>
<style>
    .chat
    {
        list-style: none;
        margin: 0;
        padding: 0;
    }
    .circle_init {
        width: 50px;
        height: 50px;
        padding: 4px 15px;
        font-size: 32px;
        border-radius: 50%;
        float: left;
        color: #fff;
    }

    .chat li
    {
        width:100%;
        margin-bottom: 10px;
        padding-bottom: 5px;
        border-bottom: 1px dotted #B3A9A9;
    }

    .chat li.left .chat-body
    {
        margin-left: 60px;
    }

    .chat li.right .chat-body
    {
        margin-right: 60px;
    }


    .chat li .chat-body p
    {
        margin: 0;
        color: #777777;
    }

    .panel .slidedown .glyphicon, .chat .glyphicon
    {
        margin-right: 5px;
    }

    .panel-body
    {
        overflow-y: scroll;
        height: 250px;
    }

    ::-webkit-scrollbar-track
    {
        -webkit-box-shadow: inset 0 0 6px rgba(0,0,0,0.3);
        background-color: #F5F5F5;
    }

    ::-webkit-scrollbar
    {
        width: 12px;
        background-color: #F5F5F5;
    }

    ::-webkit-scrollbar-thumb
    {
        -webkit-box-shadow: inset 0 0 6px rgba(0,0,0,.3);
        background-color: #555;
    }

</style>