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

			if ($userIds != 0) {
				$removeTry = $userHandler->RemoveUser($userIds);

				if ($removeTry) {
					$xhtml = \View\UserView::USER_REMOVED;
				}
				else {
					$xhtml = \View\UserView::FAILED_TO_REMOVE_USER;
				}
			}
		}

		$userArray = $userHandler->GetAllUsers();

		$xhtml .= $userView->ShowUsers($userArray);

		return $xhtml;

	}
}