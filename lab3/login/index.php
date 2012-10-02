<?php
session_start();

  	//länka in filer med funktioner som används
  	require_once ('View/LoginView.php');
    require_once ('Model/LoginHandler.php');
    require_once ('Controller/LoginController.php');
    require_once ('db/DBConfig.php');
    require_once ('db/Database.php');

    $title = "Login form";
    $body = "";


    class MasterController{

        public static function DoControl(){
            $loginHandler = new \Model\LoginHandler();
            $loginView = new \View\LoginView();
            $controller = new \Controller\LoginController();

            $body .= $controller->DoControl($loginHandler, $loginView);

            return $body;
        }
    }

    $body = MasterController::DoControl();


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

        echo $body;
        //echo $loggedIn;
        ?>
        </p>
    </body>
</html>