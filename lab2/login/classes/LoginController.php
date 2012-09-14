<?php

class LoginController {

	public function DoControl(LoginHandler $loginHandler, LoginView $loginView){

		$controlInfo = "";

    	if ($loginHandler->IsLoggedIn()){

    		if($loginView->TriedToLogout()){
    			$loginView->DoLogout();
    			$controlInfo = "<p>Du är nu utloggad!</p>";
    		}
    		else {
    			$loginView->DoLogoutBox();
    		}
    	}
    	else {
            echo "testar en gång.... ";
    		if($loginView->TriedToLogin()){
    			$username = $loginView->GetUserName();
    			$password = $loginView->GetPassword();

				if($loginHandler->DoLogin($username, $password)){
					$controlInfo = "<p>Du är inloggad!</p>";
				}
				else {
					$controlInfo = "<p>Fel användarnamn eller lösenord!</p>";
				}
    		}
        }

        if ($loginHandler->IsLoggedIn()){
            echo "testar igen";
        	$html = $loginView->DoLogoutBox();
        }
        else {
        	$html = $loginView->DologinBox();
        }

	return $controlInfo . $html;

    /*if ($loggedIn == true){
      $body.="Du är inloggad <br/>";

      if ($view->TriedToLogout()){
        $login->DoLogout();
      }
    }
    else {
      $body.="Du är utloggad <br/>";
    }
	}*/
    }
}
?>