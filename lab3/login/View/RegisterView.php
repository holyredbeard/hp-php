<?php

namespace View;

class RegisterView {

	    // Variablar för formulär.
	private $registerUserName = "username";
	private $registerPassword = "password";
	private $registerPassword2 = "password2";
    private $registerButton = "registerButton";
    private $registerCancel = "registerCancel";

    private $register = "register";

    // Variablar för meddelanden.
    const SUCCESSFULLY_REGISTERED = '<p>Registrering lyckades. Logga in med det användarnamn och lösenord du registrerade dig med.</p>';
    const PASSWORD_DID_NOT_MATCH = '<p>Lösenorden matchade inte!</p>';

    /**
     * Generera och returnera registrerings-formulär
     *
     * @return String, HTML
     */
	public function DoRegisterBox() {
		return "<div id='form'>
				<form id='form2' method='post' action=''>
					<fieldset>
						<label for='$this->registerUserName'>Username:<br /><input type='text' id='$this->registerUserName' name='$this->registerUserName' size='20' /></label><br/>
						<label for='$this->registerPassword' >Password:<br /><input type='password' id='$this->registerPassword' name='$this->registerPassword' size='20' /></label><br/>
						<label for='$this->registerPassword2' >Repeat password:<br /><input type='password' id='$this->registerPassword2' name='$this->registerPassword2' size='20' /></label><br/>
						<input type='submit' id='$this->registerButton' name='$this->registerButton' value='Register' />
						<input type='submit' name='$this->registerCancel' value='Cancel' /></label>
					</fieldset>
				</form>
			</div>";
	}

	/**
     * Generera och returnera registrerings-knapp
     *
     * @return String, HTML
     */
	public function DoRegisterButton() {
		return "<form method='post' action='index.php'>
					<input type='submit' id='$this->register' name='$this->register' value='Register' />
			</form>";
	}

	/**
    * Kontrollera om användaren klickat på registrerings-knappen
    * 
    * @return boolean
    */
    public function WantToRegister() {
    	if (isset($_POST[$this->register])) {
    		return true;
    	}
    	else {
    		return false;
    	}
    }

	/**
    * Returnera användarnamn från formulär
    * 
    * @return boolean
    */
   
	public function GetUsername() {
		if (isset($_POST[$this->registerUserName])){
            return $_POST[$this->registerUserName];
        }
		else {
			return null;
		};
	}

	/**
    * Returnera lösenord från forumlär
    * 
    * @return boolean
    */
   	public function GetPassword() {
		if (isset($_POST[$this->registerPassword])){
            return $_POST[$this->registerPassword];
        }
		else {
			return null;
		};
    }

	/**
    * Returnera upprepat lösenord från formulär
    * 
    * @return boolean
    */
   
   	public function GetPasswordMatching() {
   		if (isset($_POST[$this->registerPassword2])){
            return $_POST[$this->registerPassword2];
        }
		else {
			return null;
		};
   	}

    /**
    * Kontrollera om användaren valt att skicka in registrerings-formuläret
    * 
    * @return boolean
    */
    public function TredToRegister() {
    	if (isset($_POST[$this->registerButton])) {
    		return true;
    	}
    	else {
    		return false;
    	}
    }
}