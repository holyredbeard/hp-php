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

    //private $m_cookieLocation = "CookieMonster";

    // Funktion som returnerar inloggningsformuläret i (X)HTML.
	public function DoLoginBox() {
  		return "<div id='form'>
					<form id='form1' method='get' action=''>
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
		return "<form method='get' action=''>
					<input type='submit' id='$this->logoutButton' name='$this->logoutButton' value='Logout' />
				</form>";
  	}

    /*// Funktion som kontrollerar om en kaka finns (alltså om användaren klickat på "Remember me")
    public function UserRemembered() {
        return isset($_COOKIE[$this->m_cookieLocation]);
    }

    */

    // Funktion som kontrollerar om användaren klickat i "Remember me".
    public function RememberMe() {
        if (isset($_GET[$this->rememberMe])) {
            return true;
        }
        return false;
    }

    // Funktion som kontrollerar om ett användarnamn är ifyllt och om så är fallet returnerar detta.
	public function GetUserName() {
		if (isset($_COOKIE[$this->loginUserName])) {
			return $_COOKIE[$this->loginUserName];
		}
        else if (isset($_GET[$this->loginUserName])){
            return $_GET[$this->loginUserName];
        }
		else {
			return null;
		};
    }

    // Funktion som kontrollerar om ett lösenord är ifyllt och om så är fallet returnerar detta.
    public function GetPassword() {
    	if (isset($_COOKIE[$this->loginPassword])) {
    		return $_COOKIE[$this->loginPassword];
    	}
        else if (isset($_GET[$this->loginPassword])){
            return $_GET[$this->loginPassword];
        }
    	else {
    		return null;
    	};
    }

    // Funktion som kontrollerar om användaren tryckte på login-knappen och returnerar 'true' om så är fallet.
    public function TriedToLogin() {
    	if (isset($_GET[$this->loginButton]) == true) {
    		return true;
    	}
    	else {
    		return false;
    	}
    }

    // Funktion som kontrollerar om användaren tryckte på logout-knappen och returnerar 'true' om så är fallet.
    public function TriedToLogout() {
    	if (isset($_GET[$this->logoutButton]) == true) {
    		return true;
    	}
    	else {
    		return false;
    	}
    }

    public function CreateCookie($username, $password) {
        setcookie("loginUsername", $loginUserName, time() + 30);
        setcookie("loginPassword", $loginPassword, time() + 30);
    }

    public function DestroyCookie() {
        setcookie("loginUsername", "", time() - 30);
        setcookie("loginPassword", "", time() - 30);

    }
}