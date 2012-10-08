<?php

namespace Controller;

require_once ('View/UserView.php');

class UserController {

	private $_userIdArray = array();
	private $_userNameArray = array();
	
	public function DoControl(\Model\UserHandler $userHandler, \View\UserView $userView) {

		$xhtml = "";
		$userArray = array();

		if ($userView->TriedToRemoveUser()) {
			$userIds = $userView->GetUsersToRemove();

			$removeTry = $userHandler->RemoveUser($userIds);

			if ($removeTry == true) {
				// TODO: Ev. lägga till mer sofistikerat meddelande?
				$xhtml = "Failed to remove user(s)!";
			}
			else {
				$xhtml = "User(s) successfully removed!";
			}
		}

		$userArray = $userHandler->GetAllUsers();

		$xhtml .= $userView->ShowUsers($userArray);

		/* if ($userView->TriedToRemoveUser()) {
			$userView->GetUserToRemove();
			$userHandler->RemoveUser()
		}*/

		return $xhtml;

	}
}