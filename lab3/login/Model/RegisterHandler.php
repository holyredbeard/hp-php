<?php

namespace Model;

class RegisterHandler {

	private $m_db = null;

	public function __construct(Database $db) {
		// TODO: Implement
		$this->m_db = $db;
	}
	

	public function DoRegister($username, $password){

		$query = "INSERT INTO Users (username, password) VALUES (?, ?)";

		$stmt = $this->m_db->Prepare($query);

		$stmt->bind_param("ss", $username, $password);
		
		$ret = $this->m_db->RunInsertQuery($stmt);

		$stmt->Close();

		return $ret;
	}

	public function CheckUnique($regUsername, Array $users){

		foreach ($users as $username) {
			if ($regUsername === $username){
				return false;
			}
		}

		return true;
	}
}