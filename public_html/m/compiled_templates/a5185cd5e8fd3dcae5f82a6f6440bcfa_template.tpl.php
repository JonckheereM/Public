<?php error_reporting(E_ALL | E_STRICT); ini_set('display_errors', 'On'); ?>
<!DOCTYPE html> 
<html> 
    <head>
        <title>Public</title>
        <link rel="stylesheet" href="http://code.jquery.com/mobile/1.0a1/jquery.mobile-1.0a1.min.css" />
        <link rel="stylesheet" href="css/screen.css" />
        <script type="text/javascript" src="http://code.jquery.com/jquery-1.4.3.min.js"></script>
        <script type="text/javascript" src="http://code.jquery.com/mobile/1.0a1/jquery.mobile-1.0a1.min.js"></script>
    </head>
    <body>

        <div data-role="page">
            <?php echo $this->variables['content']; ?>
        </div><!-- /page -->

    </body>
</html>