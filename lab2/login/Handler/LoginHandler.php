<?php
session_start();

class LoginHandler {

	// Privat variabel för hantering av session.
	private $checkLoginState = 'login_session';

	// Funktion som håller reda på om användaren är inloggad eller ej
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

				echo "Lösen är: " . $password;

			  	if ($password == "1234" ){
			  		$_SESSION[$this->checkLoginState] = "isLoggedIn";
			  		echo "röv";
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
				else {
					return false;
				}
			}
		}
		else {
			echo "tomt";
			return false;
		}
	}

	// Funktion som om den körs loggar ut användaren genom att nollställa sessionen.
	public function DoLogout($loginView){
		if (isset($_SESSION[$this->checkLoginState])){
			unset($_SESSION[$this->checkLoginState]);
		}

		// Kör funktionen DeleteCookie för att ta bort kakorna
		$loginView->DeleteCookie();
	}

	function encrypt($toBeEncrypted) {
		$iv_size = mcrypt_get_iv_size(MCRYPT_RIJNDAEL_256, MCRYPT_MODE_ECB);
		$iv = mcrypt_create_iv($iv_size, MCRYPT_RAND);
		$key = "The secret key is";
		$encrypedText = base64_encode(mcrypt_encrypt(MCRYPT_RIJNDAEL_256, $key, $toBeEncrypted, MCRYPT_MODE_ECB, $iv));

		return $encrypedText;
	}

	function decrypt($encrypedText) {
		$key = "The secret key is";
		$decryptedText = mcrypt_decrypt(MCRYPT_RIJNDAEL_256, $key, base64_decode($encrypedText), MCRYPT_MODE_ECB);

		//$decryptedText = strval($decryptedText);
		return $decryptedText;
	}
}

?>