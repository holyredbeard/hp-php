<?php

namespace View;

class UserView {

	public function ShowUsers() {

		$userIdArray = array(
			[]  => "Användare 1",
    		[] => "Användare 2",
    		[] => "Användare 3",
		);

		$userNameArray = array(
			[]  => "1",
    		[] => "2",
    		[] => "3",
		);

		$users = "";
		$nrOfUsers = strlen($userIdArray);

		for ($i = 0; $i < $nrOfUsers; $i++) {
			$users .= "<label for='$userIdArray[$i]'
						<input type='checkbox' name='$userIdArray[$i]' value='$userNameArray[$i]' /><br/>
						</label>";
		}
		
		$userList = "<div class='userList'>
					<form id='form3' method='post' action=''>
						<fieldset>
							<p>Existing users</p>
							$users
							<input type='submit' Value='Ta bort' />
						</fieldset>
					</form>
					</div>";

		return $userList;
	}

	public function TriedToRemoveUser() {

	}

	public function GetUserToRemove() {
		if (isset($_POST[$this->loginUserName])){
            return $_POST[$this->loginUserName];
        }
		else {
			return null;
		};
	}
}