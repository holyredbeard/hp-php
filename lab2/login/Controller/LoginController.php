<?php

class LoginController {

	public function DoControl(LoginHandler $loginHandler, LoginView $loginView){

		$controlInfo = "";

    	if ($loginHandler->IsLoggedIn()){       

    		if ($loginView->TriedToLogout()){
    			$loginHandler->DoLogout($loginView);
    			$controlInfo = "<p>Du är utloggad!</p>";
    		}
    		else {
    			$loginView->DoLogoutBox();
    		}
    	}
    	else {

            if ($loginView->TriedToLogin() || $loginView->CookieSet()){

    			$loginUsername = $loginView->GetUserName();
    			$loginPassword = $loginView->GetPassword();

                if ($loginView->CookieSet()) {
                    $loginPassword = $loginHandler->Decrypt($loginPassword);
                }

                $loginTry = $loginHandler->DoLogin($loginUsername, $loginPassword);

				if ($loginTry === true){

                    // Kontrollerar om användaren klickat i "Remember me"?
                    if ($loginView->RememberMe()){
                        
                        $loginPassword = $loginHandler->Encrypt($loginPassword);

                        $loginView->CreateCookie($loginUsername, $loginPassword);

                    }

                    $controlInfo = "<p>Du är inloggad!</p>";
				}
                else if ($loginTry === "empty"){
                    $controlInfo = "<p>Du måste fylla i både användarnamn och lösenord!";
                }

				else {
					$controlInfo = "Fel användarnamn eller lösenord!</p>";
				}
    		}
        }

        if ($loginHandler->IsLoggedIn()){
        	$html = $loginView->DoLogoutBox();
        }
        else {
        	$html = $loginView->DologinBox();
        }

	return $controlInfo . $html;

    }
}
?>