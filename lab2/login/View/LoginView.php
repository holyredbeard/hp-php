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
    private $rememberMe = "rememberMe";

    private $cookieUsername = "cookieUsername";
    private $cookiePassword = "cookiePassword";

    //private $m_cookieLocation = "CookieMonster";

    // Funktion som returnerar inloggningsformuläret i (X)HTML.
	public function DoLoginBox() {
  		return "<div id='form'>
					<form id='form1' method='post' action=''>
						<fieldset>
							<label for='$this->loginUserName'>Name:<br /><input type='text' id='$this->loginUserName' name='$this->loginUserName' size='20' /></label><br/>
							<label for='$this->loginPassword' >Password:<br /><input type='password' id='$this->loginPassword' name='$this->loginPassword' size='20' /></label><br/>
							<input type='submit' id='$this->loginButton' name='$this->loginButton' value='Login' />
							<label for='$this->rememberMe' >Remember me:<input type='checkbox' name='$this->rememberMe' value='loggedIn' /></label>
						</fieldset>
					</form>
				</div>";
	}

    // Funktion som returnerar utloggningsknappen i (X)HTML.
	public function DoLogoutBox() {
		return "<form method='post' action=''>
					<input type='submit' id='$this->logoutButton' name='$this->logoutButton' value='Logout' />
				</form>";
  	}

    // Funktion som kontrollerar om användaren klickat i "Remember me".
    public function RememberMe() {
        if (isset($_POST[$this->rememberMe])) {
            return true;
        }
        return false;
    }

    // Funktion som kontrollerar om ett användarnamn är ifyllt och om så är fallet returnerar detta.
	public function GetUserName() {
		if (isset($_COOKIE[$this->cookieUsername])) {
			return $_COOKIE[$this->cookieUsername];
		}
        else if (isset($_POST[$this->loginUserName])){
            return $_POST[$this->loginUserName];
        }
		else {
			return null;
		};
    }

    // Funktion som kontrollerar om ett lösenord är ifyllt och om så är fallet returnerar detta.
    public function GetPassword() {
    	if (isset($_COOKIE[$this->cookiePassword])) {
    		return $_COOKIE[$this->cookiePassword];
    	}
        else if (isset($_POST[$this->loginPassword])){
            return $_POST[$this->loginPassword];
        }
    	else {
    		return null;
    	};
    }

    // Funktion som kontrollerar om användaren tryckte på login-knappen och returnerar 'true' om så är fallet.
    public function TriedToLogin() {
        //echo "tried to login";
    	if (isset($_POST[$this->loginButton])) {
    		return true;
    	}
    	else {
    		return false;
    	}
    }

    // Funktion som kontrollerar om användaren tryckte på logout-knappen och returnerar 'true' om så är fallet.
    public function TriedToLogout() {
    	if (isset($_POST[$this->logoutButton])) {

    		return true;
    	}
    	else {
    		return false;
    	}
    }

    public function CookieSet(){
        echo "checkar om cookies finns";
        if (isset($_COOKIE[$this->cookieUsername]) && isset($_COOKIE[$this->cookiePassword])){
            echo "jepp, cookies finns!";
            return true;
        }
        else {
            return false;
        }
    }

    public function CreateCookie($loginUsername, $loginPassword) {
        setcookie($this->cookieUsername, $loginUsername, time() + 600000);
        setcookie($this->cookiePassword, $loginPassword, time() + 600000);
    }

    public function DeleteCookie() {
        setcookie($this->cookieUsername, "", time() + 600000);
        setcookie($this->cookiePassword, "", time() + 600000);
        unset($_COOKIE[$this->cookieUsername]);
        unset($_COOKIE[$this->cookiePassword]);
    }
}