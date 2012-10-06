<?php

namespace Controller;

class UserController {

	private $userIdArray = array();
	private $userNameArray = array();
	
	public function DoControl(\Model\UserHandler $userHandler, \View\UserView $userView) {

		$xhtml = "";

		$xhtml = $userView::ShowUsers();

		//$xhtml = $userHandler->GetAllUsers();

		/* if ($userView->TriedToRemoveUser()) {
			$userView->GetUserToRemove();
			$userHandler->RemoveUser()
		}*/

		return $xhtml;

	}
}