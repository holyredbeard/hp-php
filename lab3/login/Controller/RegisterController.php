<?php

namespace Controller;

require_once ('Model/Validation.php');

class RegisterController {

	public function DoControl(\Model\RegisterHandler $registerHandler,
                              \View\RegisterView $registerView,
                              \Model\EncryptionHandler $encryptionHandler,
                              \Model\LoginHandler $loginHandler,
                              \Model\UserHandler $userHandler) {

        $validation = new \Model\Validation();
        $loginView = new \View\loginView();
        $loginController = new \Controller\loginController();

		$xhtml = '';
        $errorMessages = array();
        $okToRegister = true;

    	if ($registerView->WantToRegister()) {
    		$xhtml = $registerView->DoRegisterBox();
    	}
    	else if ($registerView->TredToRegister()) {
            $regUsername = $registerView->GetUsername();
            $regPassword = $registerView->GetPassword();
            $regPassword2 = $registerView->GetPassword2();

            if ((!$regUsername) || (!$regPassword) || (!$regPassword2)){ 
                $errorMessages[] = \View\RegisterView::ALL_FIELDS_NOT_FILLED;
                $okToRegister = FALSE;
            }
            else {
                $usersArray = $userHandler->GetAllUsers();
                $users = $usersArray[1];

                $checkUnique = $registerHandler->CheckUnique($regUsername, $users);

                if (!$checkUnique) {
                    $errorMessages[] = \View\RegisterView::USERNAME_EXISTS;
                    $okToRegister = false;
                }

                $validation = new \Model\Validation();
                $validate = $validation->DoValidate($regUsername, $regPassword, $regPassword2);

                if (!$validate) {
                    $validationErrors = $validation->GetValidationError();
                    $okToRegister = FALSE;
                }
            }

            if ($okToRegister) {
                $encryptedPass = $encryptionHandler->Encrypt($regPassword);
                $regTry = $registerHandler->DoRegister($regUsername, $encryptedPass);

                if ($regTry){
                    $xhtml = \View\RegisterView::SUCCESSFULLY_REGISTERED;
                    $xhtml.= $loginController->DoControl($loginHandler, $loginView, $registerView, $encryptionHandler);
                }
                else {
                    $xhtml = \View\RegisterView::UNSUCCESSFULLY_REGISTERED;
                    $xhtml.= $registerView->DoRegisterBox();
                }
            }
            else {
                $showErrors = $registerView->GetErrorMessages($errorMessages, $validationErrors);

                $xhtml = \View\RegisterView::UNSUCCESSFULLY_REGISTERED;
                $xhtml.= $showErrors;
                $xhtml.= $registerView->DoRegisterBox();
            }
    	}
    	return $xhtml;
	}
}