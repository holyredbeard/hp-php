<?php

namespace Controller;

require_once ('View/UserView.php');

class UserController {

	private $_userIdArray = array();	// lagrar hämtade användar-ids
	private $_userNameArray = array();	// lagrar hämtade användarnamn
	
	public function DoControl(\Model\UserHandler $userHandler, \View\UserView $userView) {

		$xhtml = "";
		$userArray = array();

		// Kontrollerar om användaren valt att ta bort användare
		if ($userView->TriedToRemoveUser()) {
			$userIds = $userView->GetUsersToRemove();		// hämtar den/de användare från fomuläret som ska tas bort

			if ($userIds != 0) {
				$removeTry = $userHandler->RemoveUsers($userIds);		// testar att ta bort användaren/användarna

				// Visar meddelanden för användaren om hur det gick
				if ($removeTry) {
					$xhtml = \View\UserView::USER_REMOVED;
				}
				else {
					$xhtml = \View\UserView::FAILED_TO_REMOVE_USER;
				}
			}
		}

		// Hämtar användarna igen och visar för användaren
		$userArray = $userHandler->GetAllUsers();

		$xhtml .= $userView->ShowUsers($userArray);

		return $xhtml;

	}
}