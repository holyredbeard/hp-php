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
    public function Prepare($query) {
            $ret = $this->mysqli->prepare($query);
            
            if ($ret == FALSE) {
                    throw new \Exception($this->mysqli->error);
            }
            
            return $ret;
            
    }

    public function CheckUser($stmt) {

        if ($stmt->execute() == false) {
            throw new \Exception($this->mysqli->error);
        }
        $ret = 0;   // TODO: Vad gör denna för nytta?
        
        if ($stmt->bind_result($field1, $field2, $field3) == FALSE) {
            throw new \Exception($this->mysqli->error);
        }

        // TODO: När namn är en parameter, hämta då ut och "välkomna" personen här.

        if ($stmt->fetch()) {
            return true;        // Match exists in db           
        } else {
            return false;       // Match doesn't exist in db
        }
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

    public static function test(DBConfig $dbConfig) {
        $db = new Database();
        
        if ($db->Connect($dbConfig) == false) {
            echo "Database Connect failed";
            return false;
        }
        
        //$numberOfPostBefore = $db->SelectOne("SELECT COUNT(*) FROM InsertTable");
        
        //$stmt = $db->Prepare("INSERT INTO InsertTable VALUES (1)");
        //$db->RunInsertQuery($stmt);
        
        //$numberOfPostAfter = $db->SelectOne("SELECT COUNT(*) FROM InsertTable");
        
        /*if ($numberOfPostBefore +1 != $numberOfPostAfter) {
            echo "Prepare or RunInsertQuery failed";
            return false;
        }*/
        
        /*if ($db->SelectOne("SELECT COUNT(*) FROM NotEmpty") != 2) {
            echo "Database SelectOne failed";
            return false;
        }*/
        
        if ($db->Close() == false) {
            echo "Database Close failed";
            return false;
        }
        
        
        return true;
}  
}