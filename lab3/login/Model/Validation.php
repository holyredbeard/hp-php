<?php
class Validator {
    private $errorNumber = null;

    private static $kMinPasswordLength = 8;
    private static $kMaxPasswordLength = 15;

    // Valideringsfel
    const WRONG_USERNAME_FORMAT = 0;
    const WRONG_PASSWORD_FORMAT = 1;
    const WRONG_SSN_FORMAT = 2;
    const WRONG_DATE_FORMAT = 3;
    
    public function GetValidationError() {
        return $this->errorNumber;
    }
    
    public function ValidateUsername($username) {
		if (preg_match('/^[a-zA-Z0-9]{5,}$/', $username)) {
			return true;
		} else {
			$this->errorNumber = self::WRONG_USERNAME_FORMAT;
			return false;
		}
    }

	public function ValidatePassword($password) {
		if (preg_match('#.*^(?=.{8,20})(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*\W).*$#', $password)) {
			return true;
		} else {
			$this->errorNumber = self::WRONG_PASSWORD_FORMAT;
			return false;
		}
    }
}

function Test() {

        // korrekt username
        if ($valid->ValidateUsername('Username222') == true) {
        	echo 'OK. Korrekt username <br />';
        }
        // fel username, för kort
        if ($valid->ValidateUsername('Um22') == false) {
        	echo 'OK. Felaktigt username <br />';
        }}

Test();