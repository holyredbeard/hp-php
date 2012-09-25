<?php
session_start();

	require_once "View/LoginView.php";
	require_once "Handler/LoginHandler.php";
	require_once "View/FileUploadView.php";
	require_once "Handler/FileUploadHandler.php";

$html = "<h1>Tester</h1>";


/* --------------- Test av inloggning ------------------- */

// Test av LoginHandler
$html .= "<hr><h2>Test av Login</h2>";
if (LoginHandler::Test() == false) {
	$html .= "<br/>Testet av LoginHandler() misslyckades.<hr/>";
}
else {
	$html .= "<br/>Testet av LoginHandler() lyckades.<hr/>";
}


/* --------------- Test av filuppladdning ------------------- */

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <title><?php echo $title;?></title>
        <link rel="stylesheet" type="text/css" href="style.css" />
        <meta http-equiv="content-type" content="text/html; charset=utf-8" />
    </head>
    <body class="">
        <p>
        <?php
        //Skriver ut innehållet i $body till dokumentet.

        //echo $body;

        echo $html;
        //echo $loggedIn;
        ?>
        </p>
    </body>
</html>