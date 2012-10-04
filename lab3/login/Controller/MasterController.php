<?php

	namespace Controller;

  	//länka in filer med funktioner som används
  	require_once ('View/LoginView.php');
    require_once ('Controller/LoginController.php');

    require_once ('Model/LoginHandler.php');
    require_once ('Model/DBConfig.php');
    require_once ('Model/Database.php');

    class MasterController{

        public static function DoControl(){

            $db = new \Model\Database();
            $db->Connect(new \Model\DBConfig());

            $loginHandler = new \Model\LoginHandler($db); // TODO: Kolla om detta är rätt!
            $loginView = new \View\LoginView();
            $controller = new \Controller\LoginController();

            $body .= $controller->DoControl($loginHandler, $loginView);

            return $body;
        }
    }