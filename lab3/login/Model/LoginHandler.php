<?php

namespace Model;

session_start();

class LoginHandler {

	// Privat variabel för hantering av session.
	private $checkLoginState = 'login_session';
	private $sessionCheck = "isLoggedIn";

	private $m_db = null;

	public function __construct(Database $db) {
		$this->m_db = $db;
	}

	/**
	 * Kontrollera om användaren är inloggad
	 * @return boolean
	 */
	public function IsLoggedIn() {
		if($_SESSION[$this->checkLoginState] == $this->sessionCheck) {
			//echo "is logged in</br>";
			return true;
		}
		else {
			//echo "is logged out</br>";
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

		$query = "SELECT * FROM Users WHERE username=? AND password=?"; 
		$stmt = $this->m_db->Prepare($query);

		$stmt->bind_param("ss", $username, $password);
		
		$ret = $this->m_db->CheckUser($stmt);
		
		$stmt->close();

		if ($ret){
			$_SESSION[$this->checkLoginState] = $this->sessionCheck;
		}

		return $ret;
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
	 * Kedje-tester för applikationen
	 *
	 * @return boolean
	 */
	public static function Test(Database $db) {

			$LoginHandler = new LoginHandler($db);
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
				echo "Test 4: IsLoggedIn(), misslyckades (var ej inloggad).";
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

			/*if ()*/

			return true;
		}
	}

?>