<?php

namespace Controller;

class RegisterController {

	public function DoControl(\Model\RegisterHandler $registerHandler,
                              \View\RegisterView $registerView,
                              \View\LoginView $loginView,
                              \Model\EncryptionHandler $encryptionHandler) {

		$xhtml = "";

    	if ($registerView->WantToRegister()) {
    		echo "Regbox me!";
    		$xhtml = $registerView->DoRegisterBox();
    	}
    	
    	else if ($registerView->TredToRegister()) {
    		
            $regUsername = $registerView->GetUsername();
            $regPassword = $registerView->GetPassword();
            $regPasswordMatch = $registerView->GetPasswordMatching();

            $checkPasswordMatch = $registerHandler->checkPasswordMatch($regPassword, $regPasswordMatch);

            if ($checkPasswordMatch === true) {

                // TODO: Lägg in kryptering på lösenord!
                $encryptedPass = $encryptionHandler->Encrypt($regPassword);

                $regTry = $registerHandler->DoRegister($regUsername, $encryptedPass);

                if ($regTry === true) {
                    $xhtml = "Successfully registered!";

                    // TODO: Lägga till kod för att logga in direkt efter registrering?
                    // I så fall skicka med LoginController som arg till metoden.
                }
            }
            else {
                // TODO: Kolla om det är bättre med en enskild klass som vi gjorde i seminariet
                // Dessutom bör felmeddelandet visas utan att registreringen försvinner.
                $xhtml = "Password didn't match!";
            }
    	}

    	return $xhtml;
	}
}