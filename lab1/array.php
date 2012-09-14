<?php

	/**
	 *  Klass för att hantera med arrayer
	 */
	class ArrayHandler {
		//En funktion som vänder på ordningen på en array
		public function ReverseArray($array) {
			$result = array();				// skapar arrayen
			$nrOfElems = count($array);		// variabel som tilldelas antalet element i arrayen

			$count = 0;
			
			// Itererar baklänges genom arrayen och tilldelar allts arrayen $result dess värde i omvänd ordning (genom att iterera över dess element med $count)
			for($i = $nrOfElems - 1; $i > -1; $i--){ 
			    $result[$count++] = $array[$i]; 
			}

			return $result;
		}
		
		// Funktion som returnerar det sista elementet i en array.
		public function ReturnLastItem($array) {
			$nrOfElems = count($array);				// variabel som tilldelas antalet element i arrayen

			$lastElement = $array[$nrOfElems-1];	// med hjälp av variabeln $nrOfElems hämtas det sista elementet i arrayen ut och tilldelas variabeln $lastElement

			return $lastElement;
		}
		
	
		// Funktion som innehåller ett antal enhetstester.
		public function Test() {
	  		
			$testArray = array(1, 2, 3, 4, 5, 6, 7);
			
			//Testa ReverseArray
			$resultArray = $this->ReverseArray($testArray);
			$reversedArray = array(7, 6, 5, 4, 3, 2, 1);
			
			for ($i = 0; $i < 7; $i++) {
				if (isset($resultArray[$i]) == false) {
					echo "ReverseArray test misslyckades: inget index i returnerad array $i </br>";
					return false;
				} else if ($resultArray[$i] != $reversedArray[$i]) {
					echo "ReverseArray test misslyckades: felaktig array returnerades  </br>";
					return false;
				}
			}
			
			
			//Testa ReturnLastItem
			if ($this->ReturnLastItem($testArray) != 7) {
				echo "ReturnLastItem test misslyckades: felaktigt returvärde </br>";
				return false;
			}
			
			return true;   	
	  }
  }
  

