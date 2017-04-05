<!DOCTYPE html>
<html lang="en">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <!-- Meta, title, CSS, favicons, etc. -->
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title><?php echo $template['title'] ?> </title>

        <!-- Bootstrap -->
        <link href="<?php echo backend_asset_url() ?>vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
        <!-- Font Awesome -->
        <link href="<?php echo backend_asset_url() ?>vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">
        <!-- NProgress -->
        <link href="<?php echo backend_asset_url() ?>vendors/nprogress/nprogress.css" rel="stylesheet">
        <!-- iCheck -->
        <link href="<?php echo backend_asset_url() ?>vendors/iCheck/skins/flat/green.css" rel="stylesheet">

        <!-- bootstrap-progressbar -->
        <link href="<?php echo backend_asset_url() ?>vendors/bootstrap-progressbar/css/bootstrap-progressbar-3.3.4.min.css" rel="stylesheet">
        <!-- JQVMap -->
        <link href="<?php echo backend_asset_url() ?>vendors/jqvmap/dist/jqvmap.min.css" rel="stylesheet"/>
        <!-- bootstrap-daterangepicker -->
        <link href="<?php echo backend_asset_url() ?>vendors/bootstrap-daterangepicker/daterangepicker.css" rel="stylesheet">

        <!-- Custom Theme Style -->
        <link href="<?php echo backend_asset_url() ?>build/css/custom.min.css" rel="stylesheet">
        <?php if ($page == 'project_list') { ?>
        <link href="<?php echo backend_asset_url() ?>vendors/datatables.net-bs/css/dataTables.bootstrap.min.css" rel="stylesheet">
        <link href="<?php echo backend_asset_url() ?>vendors/datatables.net-buttons-bs/css/buttons.bootstrap.min.css" rel="stylesheet">
        <link href="<?php echo backend_asset_url() ?>vendors/datatables.net-fixedheader-bs/css/fixedHeader.bootstrap.min.css" rel="stylesheet">
        <link href="<?php echo backend_asset_url() ?>vendors/datatables.net-responsive-bs/css/responsive.bootstrap.min.css" rel="stylesheet">
        <link href="<?php echo backend_asset_url() ?>vendors/datatables.net-scroller-bs/css/scroller.bootstrap.min.css" rel="stylesheet">
        <?php } ?>
		
		<!-- Dropzone.js -->
        <link href="<?php echo backend_asset_url() ?>vendors/dropzone/dist/min/dropzone.min.css" rel="stylesheet">
    </head>

    <body class="nav-md">
        <div class="container body">
            <div class="main_container">
                <?php if (isset($template['partials']['sidebar'])) echo $template['partials']['sidebar']; ?>
                <?php if (isset($template['partials']['header'])) echo $template['partials']['header']; ?>
                <?php echo $template['body']; ?>
                <?php if (isset($template['partials']['footer'])) echo $template['partials']['footer']; ?>
            </div>
        </div>

        <!-- jQuery -->
        <script src="<?php echo backend_asset_url() ?>vendors/jquery/dist/jquery.min.js"></script>
        <!-- Bootstrap -->
        <script src="<?php echo backend_asset_url() ?>vendors/bootstrap/dist/js/bootstrap.min.js"></script>
        <!-- FastClick -->
        <script src="<?php echo backend_asset_url() ?>vendors/fastclick/lib/fastclick.js"></script>
        <!-- NProgress -->
        <script src="<?php echo backend_asset_url() ?>vendors/nprogress/nprogress.js"></script>
        <!-- Chart.js -->
        <script src="<?php echo backend_asset_url() ?>vendors/Chart.js/dist/Chart.min.js"></script>
        <!-- gauge.js -->
        <script src="<?php echo backend_asset_url() ?>vendors/gauge.js/dist/gauge.min.js"></script>
        <!-- bootstrap-progressbar -->
        <script src="<?php echo backend_asset_url() ?>vendors/bootstrap-progressbar/bootstrap-progressbar.min.js"></script>
        <!-- iCheck -->
        <script src="<?php echo backend_asset_url() ?>vendors/iCheck/icheck.min.js"></script>
        <!-- Skycons -->
        <script src="<?php echo backend_asset_url() ?>vendors/skycons/skycons.js"></script>
        <!-- Flot -->
        <script src="<?php echo backend_asset_url() ?>vendors/Flot/jquery.flot.js"></script>
        <script src="<?php echo backend_asset_url() ?>vendors/Flot/jquery.flot.pie.js"></script>
        <script src="<?php echo backend_asset_url() ?>vendors/Flot/jquery.flot.time.js"></script>
        <script src="<?php echo backend_asset_url() ?>vendors/Flot/jquery.flot.stack.js"></script>
        <script src="<?php echo backend_asset_url() ?>vendors/Flot/jquery.flot.resize.js"></script>
        <!-- Flot plugins -->
        <script src="<?php echo backend_asset_url() ?>vendors/flot.orderbars/js/jquery.flot.orderBars.js"></script>
        <script src="<?php echo backend_asset_url() ?>vendors/flot-spline/js/jquery.flot.spline.min.js"></script>
        <script src="<?php echo backend_asset_url() ?>vendors/flot.curvedlines/curvedLines.js"></script>
        <!-- DateJS -->
        <script src="<?php echo backend_asset_url() ?>vendors/DateJS/build/date.js"></script>
        <!-- JQVMap -->
        <script src="<?php echo backend_asset_url() ?>vendors/jqvmap/dist/jquery.vmap.js"></script>
        <script src="<?php echo backend_asset_url() ?>vendors/jqvmap/dist/maps/jquery.vmap.world.js"></script>
        <script src="<?php echo backend_asset_url() ?>vendors/jqvmap/examples/js/jquery.vmap.sampledata.js"></script>
        <!-- bootstrap-daterangepicker -->
        <script src="<?php echo backend_asset_url() ?>vendors/moment/min/moment.min.js"></script>
        <script src="<?php echo backend_asset_url() ?>vendors/bootstrap-daterangepicker/daterangepicker.js"></script>
        <?php if ($page == 'project_list') { ?>
            <script src="<?php echo backend_asset_url() ?>vendors/datatables.net/js/jquery.dataTables.min.js"></script>
            <script src="<?php echo backend_asset_url() ?>vendors/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
            <script src="<?php echo backend_asset_url() ?>vendors/datatables.net-buttons/js/dataTables.buttons.min.js"></script>
            <script src="<?php echo backend_asset_url() ?>vendors/datatables.net-buttons-bs/js/buttons.bootstrap.min.js"></script>
            <script src="<?php echo backend_asset_url() ?>vendors/datatables.net-buttons/js/buttons.flash.min.js"></script>
            <script src="<?php echo backend_asset_url() ?>vendors/datatables.net-buttons/js/buttons.html5.min.js"></script>
            <script src="<?php echo backend_asset_url() ?>vendors/datatables.net-buttons/js/buttons.print.min.js"></script>
            <script src="<?php echo backend_asset_url() ?>vendors/datatables.net-fixedheader/js/dataTables.fixedHeader.min.js"></script>
            <script src="<?php echo backend_asset_url() ?>vendors/datatables.net-keytable/js/dataTables.keyTable.min.js"></script>
            <script src="<?php echo backend_asset_url() ?>vendors/datatables.net-responsive/js/dataTables.responsive.min.js"></script>
            <script src="<?php echo backend_asset_url() ?>vendors/datatables.net-responsive-bs/js/responsive.bootstrap.js"></script>
            <script src="<?php echo backend_asset_url() ?>vendors/datatables.net-scroller/js/dataTables.scroller.min.js"></script>
            <script src="<?php echo backend_asset_url() ?>vendors/jszip/dist/jszip.min.js"></script>
            <script src="<?php echo backend_asset_url() ?>vendors/pdfmake/build/pdfmake.min.js"></script>
            <script src="<?php echo backend_asset_url() ?>vendors/pdfmake/build/vfs_fonts.js"></script>
        <?php } ?>
		
		<?php if($page=="upload_files"){?>
		
		 <!-- Dropzone.js -->
         <script src="<?php echo backend_asset_url() ?>vendors/dropzone/dist/min/dropzone.min.js"></script>
		
		<?php }?>
		
        <!-- validator -->
        <script src="<?php echo backend_asset_url() ?>vendors/validator/validator.js"></script>
		<!-- Parsley Form Validator -->
         <script src="<?php echo backend_asset_url() ?>vendors/parsleyjs/dist/parsley.min.js"></script>
        <!-- Custom Theme Scripts -->
        <script src="<?php echo backend_asset_url() ?>build/js/custom.min.js"></script>

    </body>
</html>
