<?php

/**
 * A view that only generates output 
 * This view is/can be used from several controllers
 */
class LoginView {

    // Variablar för formulär.
	private $loginUserName = "username";
	private $loginPassword = "password";
    private $rememberMe = "rememberMe";
    private $loginButton = "loginButton";
    private $logoutButton = "logoutButton";

    // Variablar för cookies.
    private $cookieUsername = "cookieUsername";
    private $cookiePassword = "cookiePassword";

    // Variablar för meddelanden.
    const LOGGED_OUT = "<p>Du är utloggad!</p>";
    const LOGGED_IN = "<p>Du är inloggad!</p>";
    const EMPTY_FIELD = "<p>Du måste fylla i både användarnamn och lösenord!";
    const WRONG_USERNAME_OR_PASSWORD = "Fel användarnamn eller lösenord!</p>";

    /**
     * Generera och returnera inloggnings-formulär
     * 
     * @return String,  HTML
     */
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

    /**
     * Generera och returnera utloggnings-knapp
     * 
     * @return String,  HTML
     */
	public function DoLogoutBox() {
		return "<form method='post' action=''>
					<input type='submit' id='$this->logoutButton' name='$this->logoutButton' value='Logout' />
				</form>";
  	}

    /**
     * Kontrollerar om användaren klickat i "Remember me"-checkboxen
     * 
     * @return boolean
     */
    public function RememberMe() {
        if (isset($_POST[$this->rememberMe])) {
            return true;
        }
        return false;
    }

    /**
     * Returnera användarnamn från cookie eller formulär
     * 
     * @return String,  HTML
     */
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
    
    /**
     * Returnera lösenord från cookie eller formulär
     * 
     * @return String,  HTML
     */
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

    /**
     * Returnera lösenord från cookie eller formulär
     * 
     * @return boolean
     */
    public function TriedToLogin() {
    	if (isset($_POST[$this->loginButton])) {
    		return true;
    	}
    	else {
    		return false;
    	}
    }

    /**
     * Kontrollera om användaren valt att logga ut
     * 
     * @return boolean
     */
    public function TriedToLogout() {
    	if (isset($_POST[$this->logoutButton])) {
    		return true;
    	}
    	else {
    		return false;
    	}
    }

    /**
     * Kontrollera om kakor finns
     * 
     * @return boolean
     */
    public function CookieSet(){
        if (isset($_COOKIE[$this->cookieUsername]) && isset($_COOKIE[$this->cookiePassword])){
            return true;
        }
        else {
            return false;
        }
    }

    /**
     * Skapar kakor innehållandes användarnamn och lösenord
     * 
     * @param String, $loginUsername, användarnamnet
     * @param String, $loginPassword, lösenordet
     */
    public function CreateCookie($loginUsername, $loginPassword) {
        setcookie($this->cookieUsername, $loginUsername, time() + 6000);
        setcookie($this->cookiePassword, $loginPassword, time() + 6000);
    }

    /**
     * Tar bort kakor
     */
    public function DeleteCookie() {
        setcookie($this->cookieUsername, "", time() - 60);
        setcookie($this->cookiePassword, "", time() - 60);
        unset($_COOKIE[$this->cookieUsername]);
        unset($_COOKIE[$this->cookiePassword]);
    }
}