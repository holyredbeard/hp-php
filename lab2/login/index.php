<?php
session_start();

  	//länka in filer med funktioner som används
  	require_once "classes/LoginView.php";
    require_once "classes/LoginHandler.php";
    require_once "classes/LoginController.php";
    require_once "test/TestAll.php";

    $title = "Login form";
    $body = "";

    $loginHandler = new LoginHandler();
    $loginView = new LoginView();
    $controller = new LoginController();

    $control = $controller->DoControl($loginHandler, $loginView);

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

        echo $body;

        echo $control;
        echo $loggedIn;
        ?>
        </p>
    </body>
</html>