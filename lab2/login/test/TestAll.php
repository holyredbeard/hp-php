<?php

	require_once "./classes/LoginController.php";

	class TestAll {
	
		// Funktion som innehåller ett antal enhetstester.
		public function Test() {

			$LoginHandler = new LoginHandler();

			$LoginHandler->DoLogout();	// loggar ut användaren som förberedelse för testerna.
			
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

			$LoginHandler->DoLogout();	// loggar ut användaren igen

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

			return true;
		}
	}

?>