<?php $session_data = $this->session->userdata(); ?>
<!-- top navigation -->
<div class="top_nav">
    <div class="nav_menu">
        <nav>
            <div class="nav toggle">
                <a id="menu_toggle"><i class="fa fa-bars"></i></a>
            </div>

            <ul class="nav navbar-nav navbar-right">
                <li class="">
                    <a href="javascript:;" class="user-profile dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                        <img src="<?php echo backend_asset_url() ?>images/img.jpg" alt=""><?php echo $session_data['user_account']['username']; ?>
                        <span class=" fa fa-angle-down"></span>
                    </a>
                    <ul class="dropdown-menu dropdown-usermenu pull-right">
                        <li><a href="javascript:;"> Profile</a></li>
                        <li>
                            <a href="javascript:;">
                                <span class="badge bg-red pull-right">50%</span>
                                <span>Settings</span>
                            </a>
                        </li>
                        <li><a href="javascript:;">Help</a></li>
                        <li><a href="<?php echo base_url() ?>logout"><i class="fa fa-sign-out pull-right"></i> Log Out</a></li>
                    </ul>
                </li>

                <li role="presentation"   class="dropdown">
                    <a  href="javascript:;" class="dropdown-toggle info-number" data-toggle="dropdown" aria-expanded="false">
                        <i class="fa fa-envelope-o"></i>
                        <span class="badge bg-green" id="msgcount"></span>
                    </a>
                    <ul style="overflow:auto;height:200px" id="menu1" class="dropdown-menu list-unstyled msg_list" role="menu">
                        
                    </ul>
                    
                </li>
            </ul>
        </nav>
    </div>
</div>
<!-- /top navigation -->
<script>
    setInterval(function ()
    { //$("#msgdata").html("");
        $.ajax({
            type: "post",
            url: "<?php echo base_url()?>backend/project/geRecentMessages",
            dataType: 'json',
            success: function (data)
            {
                console.log(data.msg);
                $("#menu1").html(data.msg);                
                $("#msgcount").html(data.count);                
            }
        });
    }, 5000);
</script>