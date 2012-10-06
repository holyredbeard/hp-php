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

		return $ret;
	}	

	/**
    * Returnerar true om lösenorden matchar
    * 
    * @return boolean
    */
	public function CheckPasswordMatch ($password, $password2) {
		if ($password === $password2) {
			return true;
		}

		return false;
	}
}