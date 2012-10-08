<?php

namespace Model;

require_once ('View/RegisterView.php');
require_once ('Model/registerHandler.php');


class Validation {

    private $errors = array();
    private static $kMinPasswordLength = 6;

    $registerHandler = new \Model\RegisterHandler();

    public function __construct($regUsername, $regPassword, $regPassword2) {
        $usernameCheck = ValidateUsername($regUsername);
        $passwordCheck = ValidatePassword($regPassword, $regPassword2);

        if ((!$usernameCheck) || (!$passwordCheck)) {
            return false;
        }
        else {
            return true;
        }
    }
    
    public function GetValidationError() {
        return $this->errorNumber;
    }
    
    public function ValidateUsername($username) {
		if (!preg_match('/^[a-zA-Z0-9]{5,}$/', $username)) {
            $this->errors[] = \View\RegisterView::WRONG_USERNAME_FORMAT;
            echo 'nej';
			return false;
		}
        echo 'ja';
        return true;
    }

	public function ValidatePassword($password, $password2) {

        $checkPasswordMatch = $registerHandler->checkPasswordMatch($password, $password2);

        if (!$checkPasswordMatch) {
            $this->errorNumber[] = \View\RegisterView::PASSWORD_DID_NOT_MATCH;
            return false;
        }
		else if (!preg_match('/^[a-z0-9_-]*$/i', $password)) {
            $this->errorNumber[] = \View\RegisterView::PASSWORD_WRONG_FORMAT;
			return false;
        }
        else if (strlen($password) < $this->kMinPasswordLength) {
            $this->errorNumber[] = \View\RegisterView::PASSWORD_TO_SHORT;
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