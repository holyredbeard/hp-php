<?php

namespace Model;

session_start();

class LoginHandler {

	// Privat variabel för hantering av session.
	private $checkLoginState = 'login_session';
	private $sessionCheck = "isLoggedIn";

	/**
	 * Kontrollera om användaren är inloggad
	 * @return boolean
	 */
	public function IsLoggedIn() {

		if($_SESSION[$this->checkLoginState] == $this->sessionCheck) {
			return true;
		}
		else {
			return false;
		}
	}

	/**
	 * Logga in användaren
	 * 
	 * @param String, $username, användarnamnet
	 * @param String, $password, lösenordet
	 * @return boolean
	 */
	public function DoLogin($username, $password){

		// Kontrollera så att användarnamn och lösenord är ifyllda
		if ($username != null && $password != null){

			//Kontrollerar genom en switch-sats om inloggningsuppgifterna är korrekta eller ej.
			switch ($username){
				case "henke";

			  	if ($password == "1234" ){
			  		$_SESSION[$this->checkLoginState] = $this->sessionCheck;
			  		return true;
			  	}
			  	else {
			  		return false;	
			  	}

				case "nisse";

				if ($password === "abcd"){
					$_SESSION[$this->checkLoginState] = $this->sessionCheck;
					return true;
				}
				else {
					echo $password;
					return false;
				}

				case "laban";
				if ($password == "qwerty"){
					$_SESSION[$this->checkLoginState] = $this->sessionCheck;
					return true;
				}
				else {
					return false;
				}
			}
		}
		else {
			// Returnerar "emptyField" om användarnamn eller/och lösenord saknas.
			return "emptyField";
		}
	}

	/**
	 * Logga ut användaren
	 * 
	 * @param Object $loginView instans av LoginView()
	 */
	public function DoLogout(\View\LoginView $loginView){
		if (isset($_SESSION[$this->checkLoginState])){
			unset($_SESSION[$this->checkLoginState]);

			// Kör funktionen DeleteCookie för att ta bort kakorna.
			$loginView->DeleteCookie();
		}
	}

	/**
	 * Krypterar lösenordet vilket returneras
	 * 
	 * @param String, $toBeEncrypted, lösenordet (okrypterat)
	 * @return String
	 */
	public function Encrypt($toBeEncrypted) {
		$iv_size = mcrypt_get_iv_size(MCRYPT_RIJNDAEL_256, MCRYPT_MODE_ECB);
		$iv = mcrypt_create_iv($iv_size, MCRYPT_RAND);
		$key = "The secret key is";
		$encrypedText = base64_encode(mcrypt_encrypt(MCRYPT_RIJNDAEL_256, $key, $toBeEncrypted, MCRYPT_MODE_ECB, $iv));

		return $encrypedText;
	}

	/**
	 * Dekrypterar lösenordet vilket returneras
	 * 
	 * @param String, $encrypedText, lösenordet (krypterat)
	 * @return String
	 */
	public function Decrypt($encrypedText) {
		$key = "The secret key is";
		$decryptedText = mcrypt_decrypt(MCRYPT_RIJNDAEL_256, $key, base64_decode($encrypedText), MCRYPT_MODE_ECB);

		$trimmedString = rtrim($decryptedText);

		return $trimmedString;
	}

	/**
	 * Kedje-tester för applikationen
	 *
	 * @return boolean
	 */
	public static function Test() {

			$LoginHandler = new LoginHandler();
			$loginView = new \View\LoginView();

			$LoginHandler->DoLogout($loginView);	// loggar ut användaren som förberedelse för testerna.
				
			// Test 1: Kolla så att man inte är inloggad.
			if($LoginHandler->IsLoggedIn()){
				echo "Test 1: DoLogut(), misslyckades (är inloggad).";
				return false;
			}
			
			// Test 2: Kolla så att det inte går att logga in med fel lösenord.
			if ($LoginHandler->DoLogin("henke", "4321")){
				echo "Test 2: DoLogin(), misslyckades (det går att logga in med fel lösenord).";
				return false;
			}
			
			// Test 3: Kolla så att det går att logga in.
			if ($LoginHandler->DoLogin("henke", "1234") == false){
				echo "Test 3: DoLogin(), misslyckades (det går inte att logga in med korrekta uppgifter).";
				return false;
			}

			// Test 4: Kolla så att man är inloggad.
			if ($LoginHandler->IsLoggedIn() == false){
				echo "Test 4: IsLoggedIn(), misslyckades (ej var inloggad).";
				return false;
			}

			$LoginHandler->DoLogout($loginView);	// loggar ut användaren igen

			// Test 5: Kolla så att man inte är inloggad.
			if ($LoginHandler->IsLoggedIn()){
				echo "Test 5: IsLoggedIn(), misslyckades (är fortfarande inloggad).";
				return false;
			}

			// Test 6: Kolla så att man inte kan logga in med fel lösenord.
			if ($LoginHandler->DoLogin("heke", "1235")){
				echo "Test 6: DoLogin(), misslyckades (det gick att logga in med fel användarnamn och lösenord).";
				return false;
			}

			// Test 7: Kolla så kryptering fungerar.
			$notEncryptedPass = "testPass";
			$encryptationTest = $LoginHandler->Encrypt($notEncryptedPass);

			if ($notEncryptedPass === $encryptationTest) {
				echo "Test 7: Encrypt(), misslyckades (lösenordet blev inte krypterat).";
				return false;
			}

			// Test 8: Kolla så dekryptering fungerar.
			$encryptationTest = $LoginHandler->decrypt($encryptationTest);

			if ($encryptationTest != $notEncryptedPass){
				return false;
			}

			return true;
		}
	}

?>