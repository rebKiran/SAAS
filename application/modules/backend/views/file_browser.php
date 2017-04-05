<!DOCTYPE html>
<html>
    <head lang="en">
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

        <title>Cute file browser</title>


        <!-- Include our stylesheet -->
        <link href="<?php echo base_url(); ?>assets/file_browser/css/styles.css" rel="stylesheet"/>

        <script>
            var BASE_URL = '<?php echo base_url(); ?>';
        </script>

    </head>
    <body>

        <div class="filemanager">

            <div class="search">
                <input type="search" placeholder="Find a file.." />
            </div>

            <div class="breadcrumbs"></div>

            <ul class="data"></ul>

            <div class="nothingfound">
                <div class="nofiles"></div>
                <span>No files here.</span>
            </div>

        </div>

        <footer>
            <a class="tz" href="http://tutorialzine.com/2014/09/cute-file-browser-jquery-ajax-php/">Cute File Browser with jQuery, AJAX and PHP</a>
            <div id="tzine-actions"></div>
            <span class="close"></span>
        </footer>

        <!-- Include our script files -->
        <script src="<?php echo base_url(); ?>assets/file_browser/js/jquery.js"></script>
        <script src="<?php echo base_url(); ?>assets/file_browser/js/script.js"></script>

    </body>
</html>