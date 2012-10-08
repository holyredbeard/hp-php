<?php

namespace View;

/**
 * A view that only generates output 
 * This view is/can be used from several controllers
 */
class UserView {

	private $_checkBox = 'check[]';
	private $_submitRemove = 'submitRemove';

	public function ShowUsers($userArray) {

		$userIdArray = $userArray[0];
		$userNameArray = $userArray[1];
		$usersToInclude = implode(",", $userNameArray);

		$nrOfUsers = count($userIdArray);

		for ($i = 0; $i < $nrOfUsers; $i++) {
			$users .= "<label for='$userIdArray[$i]'>
						$userNameArray[$i]
						<input type='checkbox' user='$userNameArray[$i]' id='$this->_checkBox' name='$this->_checkBox' value='$userIdArray[$i]' /><br/>
						</label>";
		}
		
		$userList = "<div class='userList'>
					<form id='form3' method='post' action=''>
						<fieldset>
							<p>Existing users</p>
							$users
							<input type='submit' id='$this->_submitRemove' name='$this->_submitRemove' Value='Ta bort' />
						</fieldset>
					</form>
					</div>";

		return $userList;
	}

	public function TriedToRemoveUser() {
		if (isset($_POST[$this->_submitRemove])) {
			return true;        
        }
        else {
        	return false;
        }

	}

	// TODO: Kolla vad göra här då det är strängberoenden. Dock ser jag inget annat alternativ.
	// Anledningen är att man inte kan hämta ut check[], då den egentligen endast heter check.
	// Kolla med stack?
	public function GetUsersToRemove() {
		if (isset($_POST['check'])) {
            return $_POST['check'];
        }
		else {
			return null;
		};
	}
}