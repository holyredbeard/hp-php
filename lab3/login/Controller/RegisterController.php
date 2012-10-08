<?php

namespace Controller;

require_once ('Model/Validation.php');

class RegisterController {

	public function DoControl(\Model\RegisterHandler $registerHandler, \View\RegisterView $registerView, \Model\EncryptionHandler $encryptionHandler, \Model\LoginHandler $loginHandler) {

        $validation = new \Model\Validation();
        $loginView = new \View\loginView();
        $loginController = new \Controller\loginController();

		$xhtml = "";

    	if ($registerView->WantToRegister()) {
    		$xhtml = $registerView->DoRegisterBox();
    	}
    	
    	else if ($registerView->TredToRegister()) {
    		
            $regUsername = $registerView->GetUsername();
            $checkUserName = $validation->ValidateUsername($regUsername);
            echo $checkUserName;

            $regPassword = $registerView->GetPassword();

            $checkPasswordMatch = $registerHandler->checkPasswordMatch($regPassword, $registerView->GetPasswordMatching());

            if ($checkPasswordMatch) {
                $checkPassword = $validation->ValidatePassword($regPassword);

                if ($checkUserName == true) {
                    echo "jepppp";
                }
                
                $encryptedPass = $encryptionHandler->Encrypt($regPassword);

                $regTry = $registerHandler->DoRegister($regUsername, $encryptedPass);

                if ($regTry) {
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