<?php

namespace View;

/**
 * A view that only generates output 
 * This view is/can be used from several controllers
 */
class UserView {

	private $_checkBox = 'check[]';
	private $_check = 'check';
	private $_submitRemove = 'submitRemove';

	// Variablar för meddelanden.
    const USER_REMOVED = "<p class='success'>User(s) successfully removed!</p>";
    const FAILED_TO_REMOVE_USER = "<p class='fail'>Failed to remove user(s)!</p>";

	public function ShowUsers(Array $userArray) {

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
		
		$userList = "<div id='userList'>
						<form id='form3' method='post' action=''>
							<fieldset>
								<p><h3>Delete users</h3></p>
								<p>$users</p>
								<input type='submit' id='$this->_submitRemove' name='$this->_submitRemove' Value='Delete' />
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
		if (isset($_POST[$this->_check])) {
            return $_POST[$this->_check];
        }
		else {
			return null;
		};
	}
}