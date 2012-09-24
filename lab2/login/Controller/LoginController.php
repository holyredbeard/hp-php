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
            
    		if ($loginView->TriedToLogin()){

    			$loginUsername = $loginView->GetUserName();
    			$loginPassword = $loginView->GetPassword();

                if ($loginView->CookieSet()) {
                    $loginPassword = $loginHandler->decrypt($loginPassword);
                }

				if ($loginHandler->DoLogin($loginUsername, $loginPassword)){

                    // Kontrollerar om användaren klickat i "Remember me"?
                    if ($loginView->RememberMe()){
                        
                        $newPass = $loginHandler->encrypt($loginPassword);
                        $loginView->CreateCookie($loginUsername, $newPass);
                    }

                    $controlInfo = "<p>Du är inloggad!</p>";
				}
				else {
					$controlInfo = "<p>Fel användarnamn eller lösenord!</p>";
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