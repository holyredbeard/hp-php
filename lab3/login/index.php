<?php
session_start();

    // Models
    require_once ('Model/DBConfig.php');
    require_once ('Model/Database.php');
    require_once ('Model/RegisterHandler.php');
    require_once ('Model/LoginHandler.php');
    require_once ('Model/EncryptionHandler.php');
    require_once ('Model/UserHandler.php');

  	//Views
  	require_once ('View/RegisterView.php');
    require_once ('View/LoginView.php');
    require_once ('View/UserView.php');

    // Controllers
    require_once ('Controller/RegisterController.php');
    require_once ('Controller/LoginController.php');
    require_once ('Controller/UserController.php');

    $title = "Login form";
    $body = "";

    class MasterController{

        public static function DoControl(){

            $db = new \Model\Database();
            $db->Connect(new \Model\DBConfig());

            // Initiate objects
            $registerView = new \View\RegisterView();
            $loginView = new \View\LoginView();
            $userView = new \View\UserView();
            
            $registerHandler = new \Model\RegisterHandler($db);
            $loginHandler = new \Model\LoginHandler($db);
            $encryptionHandler = new \Model\EncryptionHandler();
            $userHandler = new \Model\UserHandler($db);

            $registerController = new \Controller\RegisterController();
            $loginController = new \Controller\LoginController();
            $userController = new \Controller\UserController();

            // TODO: Kontrollera om det är okej att göra på detta sätt!
            if ($registerView->WantToRegister() || $registerView->TredToRegister()) {
                $body .= $registerController->DoControl($registerHandler, $registerView, $encryptionHandler, $loginHandler);
            }
            else {
                $body .= $loginController->DoControl($loginHandler, $loginView, $registerView, $encryptionHandler);
            }

            // TODO: Kolla om det finns annat sätt att kolla detta, t ex med en private variabel bool som sätts (true/false)
            if ($loginHandler->IsLoggedIn()){
                $body .= $userController->DoControl($userHandler, $userView);
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
        <script src="js/jquery-1.7.1.js"></script>
        <script src="js/external.js"></script>
    </body>
</html>