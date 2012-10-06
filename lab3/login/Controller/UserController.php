<?php

namespace Controller;

require_once ('View/UserView.php');

class UserController {

	private $_userIdArray = array();
	private $_userNameArray = array();
	
	public function DoControl(\Model\UserHandler $userHandler, $userView) {

		$xhtml = "";
		$userArray = array();

		if ($userView->TriedToRemoveUser()) {
			$userIds = $userView->GetUsersToRemove();
		}

		$userArray = $userHandler->GetAllUsers();

		$xhtml = $userView->ShowUsers($userArray);

		/* if ($userView->TriedToRemoveUser()) {
			$userView->GetUserToRemove();
			$userHandler->RemoveUser()
		}*/

		return $xhtml;

	}
}