<?php

class Database {
    private $mysqli = NULL;

    public function Connect(DBConfig $config) {
        $this->mysqli = new mysqli(
            $config->m_host,
            $config->m_user,
            $config->m_pass,
            $config->m_db
        );

        if ($this->mysqli->connect_error) {
            throw new Exception($this->mysqli->connect_error);
        }

        $this->mysqli->set_charset("utf8");

        return true;
    }

    /**
     *
     *
     * 
     */
    public function SelectOne($sqlQuery) {
        /*$stmt = $this->mysqli->prepare($sqlQuery);

        if ($stmt === FALSE) {
            throw new Exception($this->mysqli->error);
        }
        $ret = 0;
*/
        
    }
}