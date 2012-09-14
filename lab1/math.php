<?php

	/**
	 * Klass för att göra matematiska beräkningar
	 */
	class MathLib {
		//Beräknar arean av en fyrkant
		public function CalculateAreaOfSquare ($side) {
			return $side * $side;
		}
		
		//Ber�knar max värdet av två tal
		public function MaxValue($value1, $value2) {
			if ($value1 > $value2) 
				return $value1;
			else 
				return $value2;
		}
	
	  	//Test för funktionerna i math.php
		public function Test() {
			
			//Testfall vi provar med sidan 3
			if ($this->CalculateAreaOfSquare(3) != 9) {
				echo "CalculateAreaOfCircle test failed";
				return false;
			}
			//Vi jämför två tal
			if ($this->MaxValue(3, 3.15) != 3.15) {
				echo "MaxValue test failed";
				return false;
			}
			
			return true;
		}
	}

