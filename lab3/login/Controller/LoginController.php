<?php

namespace Controller;

class LoginController {

    /**
     * Genererar XHTML (forumlär, felmeddelanden etc...)
     * 
     * @param $loginHandler, instance of LoginHandler()
     * @param $loginView, instance of LoginView()
     * @return String, XHTML
     */
	public function DoControl(\Model\LoginHandler $loginHandler, \View\LoginView $loginView, \View\RegisterView $registerView){

		$controlInfo = "";

        // Kontrollerar om användaren loggat in
    	if ($loginHandler->IsLoggedIn()){      

            // Kontrollerar om användaren försökt logga ut
    		if ($loginView->TriedToLogout()){

                // Kör DoLogout() för att logga ut användaren
    			$loginHandler->DoLogout($loginView);
    			
                $controlInfo = \View\LoginView::LOGGED_OUT;
    		}

            // Har användaren inte försökt logga ut visas logout-knappen
    		else {
    			$loginView->DoLogoutBox();
    		}
    	}

    	else {
            // Kontrollerar om användaren försökt logga in eller cookies existerar hos klienten.
            if ($loginView->TriedToLogin() || $loginView->CookieSet()){

                // Hämtar användarnamn och lösenord
    			$loginUsername = $loginView->GetUserName();
    			$loginPassword = $loginView->GetPassword();

                // Kontrollerar om cookies finns och om så är fallet dekrypteras lösenordet
                if ($loginView->CookieSet()) {
                    $loginPassword = $loginHandler->Decrypt($loginPassword);
                }

                // Loggar in användaren (hur inloggningen gick returneras)
                $loginTry = $loginHandler->DoLogin($loginUsername, $loginPassword);

				if ($loginTry === true){
                    //echo "true";
                    if ($loginView->RememberMe()){
                        
                        // Krypterar lösenordet och skapar cookies hos klienten.
                        $loginPassword = $loginHandler->Encrypt($loginPassword);
                        $loginView->CreateCookie($loginUsername, $loginPassword);

                    }

                    $controlInfo = \View\LoginView::LOGGED_IN;

				}
                else if ($loginTry === "emptyField"){
                    $controlInfo = \View\LoginView::EMPTY_FIELD;    // TODO: behöver imlementera detta!
                }

				else {
                    $controlInfo = \View\LoginView::WRONG_USERNAME_OR_PASSWORD;
				}
    		}
        }

        // Kontrollerar åter om användaren är inloggad, och om så är fallet läggs logout-knappen till $xhtml-variabeln.
        // I annat fall läggs login-formuläret till $xhtml-variabeln.
        if ($loginHandler->IsLoggedIn()){
        	$xhtml = $loginView->DoLogoutBox();
        }
        else {
        	$xhtml = $loginView->DologinBox();
            $xhtml.= $registerView->DoRegisterButton();
        }

	return $controlInfo . $xhtml;

    }
}
?>