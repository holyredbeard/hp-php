<?php

/**
 * A view that only generates output 
 * This view is/can be used from several controllers
 */
class LoginView {

    // Privata variablar
	private $loginUserName = "username";
	private $loginPassword = "password";
	private $loginButton = "login";
	private $logoutButton = "logout";

    // Funktion som returnerar inloggningsformuläret i (X)HTML.
	public function DoLoginBox() {
  		return "<div id='form'>
					<form id='form1' method='get' action=''>
						<fieldset>
							<label for='$this->loginUserName'>Name:<br /><input type='text' id='$this->loginUserName' name='$this->loginUserName' size='20' /></label><br/>
							<label for='$this->loginPassword' >Password:<br /><input type='text' id='$this->loginPassword' name='$this->loginPassword' size='20' /></label><br/>
							<input type='submit' id='$this->loginButton' name='$this->loginButton' value='Login' />
							<label>Remember me:<input type='checkbox' name='loggedInBox' value='loggedIn' /></label>
						</fieldset>
					</form>
				</div>";
	}

    // Funktion som returnerar utloggningsknappen i (X)HTML.
	public function DoLogoutBox() {
		return "<form method='get' action=''>
					<input type='submit' id='$this->logoutButton' name='$this->logoutButton' value='Logout' />
				</form>";
  	}

    // Funktion som kontrollerar om ett användarnamn är ifyllt och om så är fallet returnerar detta.
	public function GetUserName() {
		if(isset($_GET[$this->loginUserName]) == true) {
			return $_GET[$this->loginUserName];
		}
		else {
			return null;
		};
    }

    // Funktion som kontrollerar om ett lösenord är ifyllt och om så är fallet returnerar detta.
    public function GetPassword() {
    	if(isset($_GET[$this->loginPassword]) == true) {
    		return $_GET[$this->loginPassword];
    	}
    	else {
    		return null;
    	};
    }

    // Funktion som kontrollerar om användaren tryckte på login-knappen och returnerar 'true' om så är fallet.
    public function TriedToLogin() {
    	if(isset($_GET[$this->loginButton]) == true) {
    		return true;
    	}
    	else {
    		return false;
    	}
    }

    // Funktion som kontrollerar om användaren tryckte på logout-knappen och returnerar 'true' om så är fallet.
    public function TriedToLogout() {
    	if(isset($_GET[$this->logoutButton]) == true) {
    		return true;
    	}
    	else {
    		return false;
    	}
    }
}