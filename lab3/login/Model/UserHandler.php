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

	public function RemoveUser(Array $userIds) {

		if ($userIds != null) {
			$c = Array();
			$s = '';

			foreach ($userIds AS $u) {
				$c[] = "?";
				$s.= 's';
			}

			$inPart = "(" . implode(",", $c) . ")";
			$query = "DELETE FROM Users WHERE id IN $inPart"; 

			$stmt = $this->m_db->Prepare($query);

			array_unshift($userIds, $s);

			call_user_func_array(array($stmt, 'bind_param'), $this->makeValuesReferenced($userIds));

			$ret = $this->m_db->DeleteUsers($stmt);

			$stmt->Close();

			return $ret;
		}
		else {
			return false;
		}

	}

	public function makeValuesReferenced(Array $arr) {
    		$refs = array();

    		foreach($arr as $key => $value)
        		$refs[$key] = &$arr[$key];
    		return $refs;

	}

}