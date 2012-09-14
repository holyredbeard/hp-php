<?php
session_start();

class LoginHandler {

	// Privat variabel för hantering av session.
	private $checkLoginState = 'login_session';

	// Funktion som håller reda på om användaren är inloggad eller ej.
	public function IsLoggedIn() {
		if($_SESSION[$this->checkLoginState] == "isLoggedIn") {
			return true;
		}
		else {
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
	public function DoLogout(){
		if (isset($_SESSION[$this->checkLoginState])){
			unset($_SESSION[$this->checkLoginState]);
		}
	}

	// Funktion som innehåller ett antal enhetstester.
	public function Test() {
		
		$this->DoLogout();	// loggar ut användaren som förberedelse för testerna.
		
		// Test 1: Kolla så att man inte är inloggad.
		if($this->IsLoggedIn() == true){
			echo "Test 1 misslyckades";
			return false;
		}
		
		// Test 2: Kolla så att det inte går att logga in med fel lösenord.
		if ($this->DoLogin("henke", "4321") == true){
			echo "Test 2 misslyckades";
			return false;
		}
		
		// Test 3: Kolla så att det går att logga in.
		if ($this->DoLogin("henke", "1234") == false){
			echo "Test 3 misslyckades";
			return false;
		}

		// Test 4: Kolla så att man är inloggad.
		if ($this->IsLoggedIn() == false){
			echo "Test 4 misslyckades";
			return false;
		}

		$this->DoLogout();	// loggar ut användaren igen

		// Test 5: Kolla så att man inte är inloggad.
		if ($this->IsLoggedIn() == true){
			echo "Test 5 misslyckades";
			return false;
		}

		// Test 6: Kolla så att man inte kan logga in med fel lösenord.
		if ($this->DoLogin("henke", "1235") == true){
			echo "Test 6 misslyckades";
			return false;
		}

		return true;
	}
}

?>