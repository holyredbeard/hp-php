<?php
session_start();

class LoginHandler {

	// Privat variabel för hantering av session.
	private $checkLoginState = 'login_session';

	// Funktion som håller reda på om användaren är inloggad eller ej.
	public function IsLoggedIn() {

		// echo "<b>LoginHandler:</b> kontrollerar om man är inloggad<br/>"; <- test-echo

		// print_r($_SESSION); <- för test

		if($_SESSION[$this->checkLoginState] == "isLoggedIn") {
			// echo "<p><b>LoginHandler:</b> Returnerar true från <b>isLoggedIn()</b></p>"; <- test-echo
			return true;
		}
		else {
			// echo "<p><b>LoginHandler:</b> Returnerar false från <b>isLoggedIn()</b></p>"; <- test-echo
			return false;
		}
	}

	// Funktion som tar emot användarnamn och lösenord via två parametrar, och via en switch-sats dels kontrollerar
	// att inloggnings-fälten inte är tomma och vidare kontrollerar användarnamn och lösenord mot de hårdkodade användarna.
	// Om användarnamn och lösenord är korrekta sätts sessions-variabeln till 'isLoggedIn' samt att funktionen returnerar true (i annat fall false).
	public function DoLogin($username, $password){

		if ($username != null && $password != null){
			switch ($username){
				case "henke";
			  	if ($password == "1234"){
			  		$_SESSION[$this->checkLoginState] = "isLoggedIn";
			  		return true;
			  	}
			  	else return false;

				case "nisse";
				if ($password == "abcd"){
					$_SESSION[$this->checkLoginState] = "isLoggedIn";
					return true;
				}
				else return false;

				case "laban";
				if ($password == "qwerty"){
					$_SESSION[$this->checkLoginState] = "isLoggedIn";
					return true;
				}
				else return false;
			}
		}
		else {
			return false;
		}
	}

	// Funktion som om den körs loggar ut användaren genom att nollställa sessionen.
	public function DoLogout($loginView){
		if (isset($_SESSION[$this->checkLoginState])){
			unset($_SESSION[$this->checkLoginState]);
		}

		$loginView->DeleteCookie();
	}
}

?>