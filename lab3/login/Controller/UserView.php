<?php

namespace View;

class UserView {

	public function ShowUser($userId, $userArray) {

		$users = "";
		$nrOfUsers = strlen($users);

		for ($i = 0; $i < $nrOfUsers; $i++) {
			$users .= "<li>$userId[$i]. <input type="button" value="$userId">Delete user</input></li>";
		}
		
		$userList = "<div class='userList'>
					<p>Existing users</p>
					<ul>
					$users
					</ul>
					</div>";

		return $userList;
	}
}