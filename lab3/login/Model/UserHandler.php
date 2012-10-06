<?php

namespace Model;

class UserHandler {

	private $m_db = null;

	public function __construct(Database $db) {
		$this->m_db = $db;
	}

	public function GetAllUsers() {

		$userArray = array(
                0 => array(),
                1 => array()
        );

		$query = 'SELECT * FROM Users'; 

		$stmt = $this->m_db->Prepare($query);
		
		$userArray = $this->m_db->GetUsers($stmt);

		return $userArray;
	}

	public function RemoveUser() {
		
	}

}