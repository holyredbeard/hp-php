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

			  	if ($password == 1234 ){
			  		$_SESSION[$this->checkLoginState] = "isLoggedIn";
			  		return true;
			  	}
			  	else {
			  		return false;	
			  	}

				case "nisse";

				if ($password === "abcd"){
					$_SESSION[$this->checkLoginState] = "isLoggedIn";
					return true;
				}
				else {
					echo $password;
					return false;
				}

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
			return "empty";
		}
	}

	// Funktion som om den körs loggar ut användaren genom att nollställa sessionen.
	public function DoLogout($loginView){
		if (isset($_SESSION[$this->checkLoginState])){
			unset($_SESSION[$this->checkLoginState]);

			$loginView->DeleteCookie();		// Kör funktionen DeleteCookie för att ta bort kakorna
		}
	}

	public function Encrypt($toBeEncrypted) {
		$iv_size = mcrypt_get_iv_size(MCRYPT_RIJNDAEL_256, MCRYPT_MODE_ECB);
		$iv = mcrypt_create_iv($iv_size, MCRYPT_RAND);
		$key = "The secret key is";
		$encrypedText = base64_encode(mcrypt_encrypt(MCRYPT_RIJNDAEL_256, $key, $toBeEncrypted, MCRYPT_MODE_ECB, $iv));

		return $encrypedText;
	}

	public function Decrypt($encrypedText) {
		$key = "The secret key is";
		$decryptedText = mcrypt_decrypt(MCRYPT_RIJNDAEL_256, $key, base64_decode($encrypedText), MCRYPT_MODE_ECB);

		$trimmedString = rtrim($decryptedText);

		return $trimmedString;
	}

public static function Test() {

		$LoginHandler = new LoginHandler();
		$loginView = new LoginView();

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

			$newpassLenght = strlen($encryptationTest);
			$oldpassLenght = strlen($notEncryptedPass);

			echo "Dekrypterat: " . $encryptationTest . ", size: " . $newpassLenght . "</br>";
			echo "Ej krypterat: " . $notEncryptedPass . ", size: " . $oldpassLenght . "</br>";
			echo "Test 8: Decrypt(), misslyckades (lösenordet återställdes inte).";
			return false;
		}

		return true;
	}
}

?>