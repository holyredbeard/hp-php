<?php

class LoginController {

	public function DoControl(LoginHandler $loginHandler, LoginView $loginView){

		$controlInfo = "";

    	if ($loginHandler->IsLoggedIn()){
        //echo "Är inloggad"; <- test-echo         

    		if ($loginView->TriedToLogout()){

                //echo "Klickat på logut"; <- test-echo
    			$loginHandler->DoLogout($loginView);
    			$controlInfo = "<p>Du är utloggad!</p>";
    		}
    		else {
    			$loginView->DoLogoutBox();
    		}
    	}
    	else {
            //echo "<p><b>LoginController</b>: False från IsLoggedIn()</p>"; <- test-echo
    		if (($loginView->TriedToLogin()) || ($loginView->CookieSet())){

                //echo "Antingen har användaren försökt logga in eller finns cookie";

    			$loginUsername = $loginView->GetUserName();
    			$loginPassword = $loginView->GetPassword();

				if ($loginHandler->DoLogin($loginUsername, $loginPassword)){

                    // Kontrollerar om användaren klickat i "Remember me"?
                    if ($loginView->RememberMe()){
                        //echo "<h4>Skapar cookie</h4>";
                        $loginView->CreateCookie($loginUsername, $loginPassword);
                    }

                    $controlInfo = "<p>Du är inloggad!</p>";
				}
				else {
					$controlInfo = "<p>Fel användarnamn eller lösenord!</p>";
				}
    		}
        }

        if ($loginHandler->IsLoggedIn()){
            // echo "<b>LoginController:</b> Testar igen om man är inloggad."; <- test-echo
        	$html = $loginView->DoLogoutBox();
        }
        else {
        	$html = $loginView->DologinBox();
        }

	return $controlInfo . $html;

    }
}
?>