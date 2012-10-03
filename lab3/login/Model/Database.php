<?php

namespace Model;

class Database {
    private $mysqli = NULL;

    public function Connect(DBConfig $config) {
        $this->mysqli = new \mysqli(
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
     * Prepares query
     * @param $sql String Sql query 
     * @return mysqli_stmt 
     */
    public function Prepare($sql) {
            $ret = $this->mysqli->prepare($sql);
            
            if ($ret == FALSE) {
                    throw new \Exception($this->mysqli->error);
            }
            
            return $ret;
            
    }
    
    /**
     * @param $stmt mysqli_stmt 
     * @return integer insert id  
     */
    /*public function RunInsertQuery(\mysqli_stmt $stmt) {
                    
                    
            if ($stmt->execute() == FALSE) {
                    throw new \Exception($this->mysqli->error);
            }
            
            $ret = $stmt->insert_id;
            
            $stmt->close();
            
            return $ret;
    }*/

    public function Close() {
            return $this->mysqli->close();
    }
}