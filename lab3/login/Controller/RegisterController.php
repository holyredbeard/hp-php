<?php

namespace Controller;

class RegisterController {

	public function DoControl(\Model\RegisterHandler $registerHandler, \View\RegisterView $registerView, \Model\EncryptionHandler $encryptionHandler, \Model\LoginHandler $loginHandler) {

        $loginView = new \View\loginView();
        $loginController = new \Controller\loginController();

		$xhtml = "";

    	if ($registerView->WantToRegister()) {
    		$xhtml = $registerView->DoRegisterBox();
    	}
    	
    	else if ($registerView->TredToRegister()) {
    		
            $regUsername = $registerView->GetUsername();
            $regPassword = $registerView->GetPassword();
            $regPasswordMatch = $registerView->GetPasswordMatching();

            $checkPasswordMatch = $registerHandler->checkPasswordMatch($regPassword, $regPasswordMatch);

            if ($checkPasswordMatch === true) {
                $encryptedPass = $encryptionHandler->Encrypt($regPassword);

                $regTry = $registerHandler->DoRegister($regUsername, $encryptedPass);

                if ($regTry === true) {
                    $xhtml = \View\RegisterView::SUCCESSFULLY_REGISTERED;
                    $xhtml.= $loginController->DoControl($loginHandler, $loginView, $registerView, $encryptionHandler);
                }
            }
            else {
                $xhtml = \View\RegisterView::PASSWORD_DID_NOT_MATCH;
                $xhtml.= $registerView->DoRegisterBox();
            }
    	}
    	return $xhtml;
	}
}