<?php

namespace Model;

require_once ('View/RegisterView.php');
//require_once ('Model/registerHandler.php');


class Validation {

    private $errors = array();

    const kMinPasswordLength = 6;
    const kMinUsernameLength = 5;

    public function DoValidate($regUsername, $regPassword, $regPassword2) {
        $usernameCheck = $this->ValidateUsername($regUsername);

        $passwordCheck = $this->ValidatePassword($regPassword, $regPassword2);

        if (!$usernameCheck || !$passwordCheck) {
            return false;
        }
        else {
            return true;
        }
    }
    
    public function GetValidationError() {
        return $this->errors;
    }
    
    public function ValidateUsername($username) {
		if (!preg_match('/^[a-z0-9_-]*$/i', $username)) {
            $this->errors[] = \View\RegisterView::USERNAME_WRONG_FORMAT;
			return false;
		}
        else if (strlen($username) < self::kMinUsernameLength){
            $this->errors[] = \View\RegisterView::USERNAME_TOO_SHORT;
            return false;
        }
        return true;
    }

	public function ValidatePassword($password, $password2) {

        if ($password != $password2) {
            $this->errors[] = \View\RegisterView::PASSWORD_DID_NOT_MATCH;
            return false;
        }
		else if (!preg_match('/^[a-z0-9_-]*$/i', $password)) {
            $this->errors[] = \View\RegisterView::PASSWORD_WRONG_FORMAT;
			return false;
        }
        else if (strlen($password) < self::kMinPasswordLength) {
            $this->errors[] = \View\RegisterView::PASSWORD_TOO_SHORT;
            return false;
        }
        return true;
    }
}

/*function Test() {

        // korrekt username
        if ($valid->ValidateUsername('Username222') == true) {
        	echo 'OK. Korrekt username <br />';
        }
        // fel username, för kort
        if ($valid->ValidateUsername('Um22') == false) {
        	echo 'OK. Felaktigt username <br />';
        }}

Test();*/