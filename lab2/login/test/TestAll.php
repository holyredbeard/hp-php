<?php

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

?>