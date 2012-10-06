<?php
session_start();

  	//länka in filer med funktioner som används
  	require_once ('View/RegisterView.php');
    require_once ('View/LoginView.php');

    require_once ('Controller/RegisterController.php');
    require_once ('Controller/LoginController.php');

    require_once ('Model/RegisterHandler.php');
    require_once ('Model/LoginHandler.php');
    require_once ('Model/EncryptionHandler.php');
    require_once ('Model/DBConfig.php');
    require_once ('Model/Database.php');


    $title = "Login form";
    $body = "";

    class MasterController{

        public static function DoControl(){

            $db = new \Model\Database();
            $db->Connect(new \Model\DBConfig());

            // Initiate objects for registering

            $registerHandler = new \Model\RegisterHandler($db);
            $registerView = new \View\RegisterView();
            $registerController = new \Controller\RegisterController();

            // Initiate objects for login
            $loginHandler = new \Model\LoginHandler($db);
            $loginView = new \View\LoginView();
            $loginController = new \Controller\LoginController();

            /*
            alternativ till nedan:

            $body .= $loginController->DoControl($loginHandler, $loginView, $registerView);

            if ($body === false){
                $body .= $registerController->DoControl($registerHandler, $registerView, $loginView);
            }

             */

            // TODO: Kontrollera om det är okej att göra på detta sätt!
            if ($registerView->WantToRegister() || $registerView->TredToRegister()) {
                $body .= $registerController->DoControl($registerHandler, $registerView, $loginView);
            }
            else {
                $body .= $loginController->DoControl($loginHandler, $loginView, $registerView);
            }

            //Close the database since it is no longer used
            $db->Close();

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