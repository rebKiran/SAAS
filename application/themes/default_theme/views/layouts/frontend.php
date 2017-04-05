<!DOCTYPE html>
<!-- 
Theme: JANGO - Ultimate Multipurpose HTML Theme Built With Twitter Bootstrap 3.3.5
Version: 1.0.0
Author: Themehats
Site: http://www.themehats.com
Contact: support@themehats.com
Follow: www.twitter.com/themehats
-->
<!--[if IE 9]> <html lang="en" class="ie9"> <![endif]-->
<!--[if !IE]><!-->
<html lang="en">
    <!--<![endif]-->
    <!-- BEGIN HEAD -->
    <head>
        <meta charset="utf-8"/>
        <title><?php echo $template['title']?></title>
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
        <meta http-equiv="Content-type" content="text/html; charset=utf-8">
        <meta content="" name="description"/>
        <meta content="" name="author"/>
		<link rel="icon" href="<?php echo frontend_asset_url()?>assets/base/img/favicon.png" type="image/gif" sizes="16x16">
        <!-- BEGIN GLOBAL MANDATORY STYLES -->
        <link href='http://fonts.googleapis.com/css?family=Roboto+Condensed:300italic,400italic,700italic,400,300,700&amp;subset=all' rel='stylesheet' type='text/css'>
        <link href="<?php echo frontend_asset_url()?>assets/plugins/socicon/socicon.css" rel="stylesheet" type="text/css"/>
        <link href="<?php echo frontend_asset_url()?>assets/plugins/bootstrap-social/bootstrap-social.css" rel="stylesheet" type="text/css"/>
        <link href="<?php echo frontend_asset_url()?>assets/plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css"/>
        <link href="<?php echo frontend_asset_url()?>assets/plugins/simple-line-icons/simple-line-icons.min.css" rel="stylesheet" type="text/css"/>
        <link href="<?php echo frontend_asset_url()?>assets/plugins/animate/animate.min.css" rel="stylesheet" type="text/css"/>
        <link href="<?php echo frontend_asset_url()?>assets/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
        <!-- END GLOBAL MANDATORY STYLES -->
        <!-- BEGIN: BASE PLUGINS  -->
        <link href="<?php echo frontend_asset_url()?>assets/plugins/revo-slider/css/settings.css" rel="stylesheet" type="text/css"/>
        <link href="<?php echo frontend_asset_url()?>assets/plugins/cubeportfolio/css/cubeportfolio.min.css" rel="stylesheet" type="text/css"/>
        <link href="<?php echo frontend_asset_url()?>assets/plugins/owl-carousel/owl.carousel.css" rel="stylesheet" type="text/css"/>
        <link href="<?php echo frontend_asset_url()?>assets/plugins/owl-carousel/owl.theme.css" rel="stylesheet" type="text/css"/>
        <link href="<?php echo frontend_asset_url()?>assets/plugins/owl-carousel/owl.transitions.css" rel="stylesheet" type="text/css"/>
        <link href="<?php echo frontend_asset_url()?>assets/plugins/fancybox/jquery.fancybox.css" rel="stylesheet" type="text/css"/>
        <!-- END: BASE PLUGINS -->
        <!-- BEGIN THEME STYLES -->
        <link href="<?php echo frontend_asset_url()?>assets/base/css/plugins.css" rel="stylesheet" type="text/css"/>
        <link href="<?php echo frontend_asset_url()?>assets/base/css/components.css" id="style_components" rel="stylesheet" type="text/css"/>
        <link href="<?php echo frontend_asset_url()?>assets/base/css/themes/default.css" rel="stylesheet" id="style_theme" type="text/css"/>
        <link href="<?php echo frontend_asset_url()?>assets/base/css/custom.css" rel="stylesheet" type="text/css"/>
        <!-- END THEME STYLES -->
        <link rel="shortcut icon" href="favicon.ico"/>
		 <script type="text/javascript">
            var base_url = '<?php echo base_url(); ?>';
        </script>
       
    </head>
    <body class="c-layout-header-fixed c-layout-header-topbar">
        <!-- BEGIN: LAYOUT/HEADERS/HEADER-1 -->
        <?php
        if (isset($template['partials']['header'])) {
            echo $template['partials']['header'];
        }
        ?>
        <!-- END: LAYOUT/HEADERS/HEADER-1 -->
        
        
        <!-- BEGIN: PAGE CONTAINER -->
        <?php echo $template['body']; ?>
        <!-- END: PAGE CONTAINER -->
        <?php
            if (isset($template['partials']['footer'])) {
                echo $template['partials']['footer'];
            }
            ?>
        <!-- BEGIN: LAYOUT/BASE/BOTTOM -->
        <!-- BEGIN: CORE PLUGINS -->
        <!--[if lt IE 9]>
                <script src="../<?php echo frontend_asset_url()?>assets/global/plugins/excanvas.min.js"></script> 
                <![endif]-->
        <script src="<?php echo frontend_asset_url()?>assets/plugins/jquery.min.js" type="text/javascript"></script>
        <script src="<?php echo frontend_asset_url()?>assets/plugins/jquery-migrate.min.js" type="text/javascript"></script>
        <script src="<?php echo frontend_asset_url()?>assets/plugins/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
        <!-- END: CORE PLUGINS -->
        <!-- BEGIN: LAYOUT PLUGINS -->
        <script src="<?php echo frontend_asset_url()?>assets/plugins/revo-slider/js/jquery.themepunch.tools.min.js" type="text/javascript"></script>
        <script src="<?php echo frontend_asset_url()?>assets/plugins/revo-slider/js/jquery.themepunch.revolution.min.js" type="text/javascript"></script>
        <script src="<?php echo frontend_asset_url()?>assets/plugins/cubeportfolio/js/jquery.cubeportfolio.min.js" type="text/javascript"></script>
        <script src="<?php echo frontend_asset_url()?>assets/plugins/owl-carousel/owl.carousel.min.js" type="text/javascript"></script>
  
        <script src="<?php echo frontend_asset_url()?>assets/plugins/counterup/jquery.counterup.min.js" type="text/javascript"></script>
		      <script src="<?php echo frontend_asset_url()?>assets/plugins/counterup/jquery.waypoints.min.js" type="text/javascript"></script>
        <script src="<?php echo frontend_asset_url()?>assets/plugins/fancybox/jquery.fancybox.pack.js" type="text/javascript"></script>
        <!-- END: LAYOUT PLUGINS -->
        <!-- BEGIN: THEME SCRIPTS -->
        <script src="<?php echo frontend_asset_url()?>assets/base/js/components.js" type="text/javascript"></script>
		<script src="<?php echo frontend_asset_url()?>assets/base/js/components-shop.js" type="text/javascript"></script>
        <script src="<?php echo frontend_asset_url()?>assets/base/js/app.js" type="text/javascript"></script>
		<script src="<?php echo frontend_asset_url()?>scripts/login.js" type="text/javascript"></script>
		
        <script type="text/javascript" src='<?php echo frontend_asset_url() ?>scripts/cart.js'></script>
<script>
	$(document).ready(function() {    
		App.init(); // init core    
	});
	</script>
	
<!-- END: THEME SCRIPTS -->
<script src="<?php echo frontend_asset_url()?>assets/base/js/scripts/pages/4col-portfolio.js" type="text/javascript"></script>
 
<!-- BEGIN: PAGE SCRIPTS -->
<script>
			$(document).ready(function() {
    var slider = $('.c-layout-revo-slider .tp-banner');
    var cont = $('.c-layout-revo-slider .tp-banner-container');
    var api = slider.show().revolution({
        delay: 15000,    
        startwidth:1170,
        startheight: (App.getViewPort().width < App.getBreakpoint('md') ? 1024 : 620),
        navigationType: "hide",
        navigationArrows: "solo",
        touchenabled: "on",
        onHoverStop: "on",
        keyboardNavigation: "off",
        navigationStyle: "circle",
        navigationHAlign: "center",
        navigationVAlign: "center",
        fullScreenAlignForce:"off",
        shadow: 0,
        fullWidth: "on",
        fullScreen: "off",       
        spinner: "spinner2",
        forceFullWidth: "on",
        hideTimerBar:"on",
        hideThumbsOnMobile: "on",
        hideNavDelayOnMobile: 1500,
        hideBulletsOnMobile: "on",
        hideArrowsOnMobile: "on",
        hideThumbsUnderResolution: 0,
        videoJsPath: "rs-plugin/videojs/",
    });
}); //ready	
			</script>
        <!-- END: LAYOUT/BASE/BOTTOM -->
		
		
		 <script>
      function initMap() {
        var chicago = {lat: 41.85, lng: -87.65};
        var indianapolis = {lat: 39.79, lng: -86.14};

        var map = new google.maps.Map(document.getElementById('gmapbg'), {
          center: chicago,
          scrollwheel: false,
          zoom: 7
        });

        var directionsDisplay = new google.maps.DirectionsRenderer({
          map: map
        });

        // Set destination, origin and travel mode.
        var request = {
          destination: indianapolis,
          origin: chicago,
          travelMode: 'DRIVING'
        };

        // Pass the directions request to the directions service.
        var directionsService = new google.maps.DirectionsService();
        directionsService.route(request, function(response, status) {
          if (status == 'OK') {
            // Display the route on the map.
            directionsDisplay.setDirections(response);
          }
        });
      }

    </script>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAnKU1fwp6CifqzA1mtTChLIcACvJ4MJ3g&callback=initMap"
        async defer></script>
		
		<script>
		
		$(".hide-div1").click(function(){
			$(".hide-div1").hide();
		});
		
		$(".hide-div2").click(function(){
			$(".hide-div2").hide();
		});
		
		$('.bloc-section1').hover(
		   function(){ $('.reward1').addClass('show-reward') },
		   function(){ $('.reward1').removeClass('show-reward') }
		)
		
		$('.bloc-section2').hover(
		   function(){ $('.reward2').addClass('show-reward') },
		   function(){ $('.reward2').removeClass('show-reward') }
		)
		
		

        // Example 3 - With jQuery prop  
			$("input[name='radios1']").on("click", function(){
				
				
			}); 
		
		</script>
    </body>
</html>