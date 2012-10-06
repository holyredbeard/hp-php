<?php

namespace Model;

class RegisterHandler {
	

	public function DoRegister($username, $password){

		/*$query = "SELECT * FROM Users WHERE username=? AND password=?"; 
		$stmt = $this->m_db->Prepare($query);

		$stmt->bind_param("ss", $username, $password);
		
		$ret = $this->m_db->CheckUser($stmt);
		
		$stmt->close();

		if ($ret === true){
			$_SESSION[$this->checkLoginState] = $this->sessionCheck;
		}

		return $ret;*/
	}
}