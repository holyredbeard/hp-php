<?php
session_start();

	require_once "View/LoginView.php";
	require_once "Model/LoginHandler.php";
	require_once "Model/Database.php";
	require_once "Model/DBConfig.php";

	$xhtml = "<h1>Tester</h1>";

	class TestAll {

		/**
		 * Kör testerna
		 * 
		 * @return String, XHTML
		 */
		public static function RunTests(){

			$db = new \Model\Database();
            $db->Connect(new \Model\DBConfig());

			/* --------------- Test av inloggning ------------------- */

			$xhtml .= "<hr><h2>Test av Login</h2>";

			
			if (\Model\LoginHandler::Test($db) == false) {
				$xhtml .= "<br/>Testet av LoginHandler() misslyckades.<hr/>";
			}
			else {
				$xhtml .= "<br/>Testet av LoginHandler() lyckades.<hr/>";
			}

			return $xhtml;
		}
	}

	// Kör TestAll() för att köra testerna.
	$xhtml .= TestAll::RunTests();

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

        //Skriver ut innehållet i dokumentet.
        echo $xhtml;

        ?>
        </p>
    </body>
</html>