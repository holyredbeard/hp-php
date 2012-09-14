<?php
  	//länka in filer med funktioner som används
  	require_once "LoginView.php";
    require_once "LoginHandler.php";

  	$title = "Login form";
    $body = "";

    // Skapar en instans av klassen LoginView
  	$login = new LoginView();

    $body = $login->DoLoginBox();   // anropar funktionen 'DoLoginBox()' som returnerar formuläret till variabeln $body.
    $body .= $login->DoLogoutBox(); // anropar funktionen 'DoLogoutBox()' som returnerar logout-knapp som läggs till variabeln $body.

    // Testar om användaren klickat på login-knappen, och om så är fallet skrivs meddelande samt användarnamn och lösenord ut.
    // Har användaren klickat på logout-knappen skrivs meddelande om detta ut och om ingen knapp är klickad meddelas detta.
    if ($login->TriedToLogin() ) {
        $body .= "<p> Användaren har klickat på Login-knappen med användarnamn: <i><strong>";
        $body .= $login->GetUserName() . "</strong></i> och lösenord: <i><strong>" . $login->GetPassword() . "</strong></i></p>";
    }
    else if ($login->TriedToLogout() ){
        $body .= "<p> Användaren har klickat på Logout-knappen</p>";  
    }
    else {
      $body .= "<p> Användaren har inte klickat på någon knapp ännu.</p>";
    }

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <title><?php echo $title;?></title>
        <meta http-equiv="content-type" content="text/html; charset=utf-8" />
    </head>
    <body class="">
        <p>
      	<?php

        //Skriver ut innehållet i $body till dokumentet.
        echo $body;
      	?>
        </p>
    </body>
</html>