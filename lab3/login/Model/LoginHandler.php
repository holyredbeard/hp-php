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
			return true;
		}
		else {
			return false;
		}
	}

	/**
	 * Logga in användaren
	 * 
	 * @param String $username, användarnamnet
	 * @param String $password, lösenordet
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
	 * @param Database $db
	 * @return boolean
	 */
	public static function Test(Database $db) {

			$loginHandler = new LoginHandler($db);
			$loginView = new \View\LoginView();

			$loginHandler->DoLogout($loginView);	// loggar ut användaren som förberedelse för testerna.
				
			/**
			 * Test 1: Testa så att man inte är inloggad.
			 */
			 
			if($loginHandler->IsLoggedIn()){
				echo "LoginHandler - Test 1: DoLogut(), misslyckades (är inloggad).";
				return false;
			}
			

			/**
			 * Test 2: Testa så att det inte går att logga in med fel lösenord.
			 */
			
			if ($loginHandler->DoLogin("testuser01", "wrongPass")){
				echo "LoginHandler - Test 2: DoLogin(), misslyckades (det går att logga in med fel lösenord).";
				return false;
			}
			

			/**
			 * Test 3: Testa så att det går att logga in.
			 */
			
			if ($loginHandler->DoLogin("testuser01", "zLziXN9DAEAkT4A4TGGPRQdVqPVznsugBxquZCvz2ME=") == FALSE){
				echo "LoginHandler - Test 3: DoLogin(), misslyckades (det går inte att logga in med korrekta uppgifter).";
				return false;
			}


			/**
			 * Test 4: Testa så att man är inloggad.
			 */
			
			if ($loginHandler->IsLoggedIn() == FALSE){
				echo "LoginHandler - Test 4: IsLoggedIn(), misslyckades (var ej inloggad).";
				return false;
			}

			$loginHandler->DoLogout($loginView);	// loggar ut användaren igen


			/**
			 * Test 5: Testa så att man inte är inloggad.
			 */
			
			if ($loginHandler->IsLoggedIn()){
				echo "LoginHandler - Test 5: IsLoggedIn(), misslyckades (är fortfarande inloggad).";
				return false;
			}

			/**
			 * Test 6: Testa så att man inte kan logga in med fel användarnamn.
			 */
			
			if ($loginHandler->DoLogin("testuser01", "654321")){
				echo "LoginHandler - Test 6: DoLogin(), misslyckades (det gick att logga in med fel användarnamn).";
				return false;
			}

			return true;
		}
	}

?>