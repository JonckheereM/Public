<!DOCTYPE html> 
<html> 
    <head>
        <title>Public - Drink</title>
        <link rel="stylesheet" href="http://code.jquery.com/mobile/1.0a1/jquery.mobile-1.0a1.min.css" />
        <link rel="stylesheet" href="css/screen.css" />
        <script type="text/javascript" src="http://code.jquery.com/jquery-1.4.3.min.js"></script>
        <script type="text/javascript" src="http://code.jquery.com/mobile/1.0a1/jquery.mobile-1.0a1.min.js"></script>
    </head>
    <body>

        <div data-role="page">

            <div data-role="header">
                <a href="logout.php" rel="external" data-icon="delete" class="ui-btn-right" data-theme="b">Log Out</a>
                <h1>pub<span id="lic">lic</span> - {$name}</h1>
            </div><!-- /header -->
                
            <div data-role="content">
                 <h2>{$name}</h2>

                 

            </div><!-- /content -->

            <div data-role="footer">
                <h4>&#169; pub<span id="lic">lic</span></h4>
            </div><!-- /header -->
        </div><!-- /page -->

    </body>
</html>
