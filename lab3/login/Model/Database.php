<?php

namespace Model;

class Database {
    private $mysqli = NULL;

    /**
     * Ansluter till databasen.
     * @param DBConfig $config
     * @return Databas-objekt
     */
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
     * Preparerar queryn
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

    /**
    * Körs när användare registreras för att lägga till användaren i databasen.
    * @param $stmt mysqli_stmt
    * @return boolean
    */
    public function RunInsertQuery(\mysqli_stmt $stmt) {
                    
        if ($stmt->execute() == FALSE) {
            throw new \Exception($this->mysqli->error);
        }
        
        if ($stmt->insert_id) {
            return true;
        }

        return false;
    }


    /**
     * Körs för att kontrollera om användarnamnet finns registrerat sedan tidigare
     * @param $stmt mysqli_stmt
     * @return boolean
     */
    public function CheckUser($stmt) {

        if ($stmt->execute() == false) {
            throw new \Exception($this->mysqli->error);
        }
        $ret = 0;
        
        if ($stmt->bind_result($field1, $field2, $field3) == FALSE) {
            throw new \Exception($this->mysqli->error);
        }

        if ($stmt->fetch()) {
            return true;        // Match i databasen
        } else {
            return false;       // Ingen match i databasen
        }
    }


    /**
     * Körs för att tat bort en eller flera användare
     * @param \mysqli_stmt $stmt [description]
     */
    public function DeleteUsers(\mysqli_stmt $stmt) {

        if ($stmt === FALSE) {
            throw new \Exception($this->mysqli->error);
        }

        //execute the statement
        if ($stmt->execute() == FALSE) {
            throw new \Exception($this->mysqli->error);
            return false;
        }
        else {
            return true;
        }
    }

    /**
     * Körs för att hämta samtliga användare i databasen
     * @param \mysqli_stmt $stmt
     * @return Array med användare (ids, användarnamn)
     */
    public function GetUsers(\mysqli_stmt $stmt) {
            $userArray = array(
                0 => array(),
                1 => array()
            );
            
            if ($stmt === FALSE) {
                    throw new \Exception($this->mysqli->error);
            }
            
            //execute the statement
            if ($stmt->execute() == FALSE) {
                    throw new \Exception($this->mysqli->error);
            }
            $ret = 0;
                
            //Bind the $ret parameter so when we call fetch it gets its value
            if ($stmt->bind_result($field1, $field2, $field3) == FALSE) {
                throw new \Exception($this->mysqli->error);
            }
            
            // Hämtar ids och användarnamn och lägger i arrayen.
            while ($stmt->fetch()) {
                array_push($userArray[0], $field1);
                array_push($userArray[1], $field2);
            }
            
            $stmt->Close();
            
            return $userArray;
    }

    /**
     * Körs för att stänga databasen
     */
    public function Close() {
            return $this->mysqli->close();
    }


    /**
     * Kedje-tester för applikationen
     *
     * @return boolean
     */
    public static function test() {

        $db = new Database();
        

        /**
         * Test 1: Testa så att man kan ansluta till databasen.
         */

        if ($db->Connect(new DBConfig) == FALSE) {
            echo "Database - Test 1: Connect(), misslyckades (det gick att ansluta).";
            return false;
        }


        /**
         * Test 2: Testa så att man Prepare() fungerar.
         */

        $query = "INSERT INTO Users (username, password) VALUES (?, ?)";

        if ($db->Prepare($query) == FALSE) {
            echo "Database - Test 2: DoLogin(), misslyckades (det gick att ansluta).";
            return false;
        }


        /**
         * Test 3: Testa så att man kan lägga till en användare.
         */

        $query = "INSERT INTO Users (username, password) VALUES ('testuser05', '123456')";
        $stmt = $db->Prepare($query);
        
        if ($db->RunInsertQuery($stmt) == FALSE) {
            echo "Database - Test 3: RunInsertQuery(), misslyckades (det gick att lägga till en användare).";
            return false;
        }


        /**
         * Test 4: Kolla så att användaren kan hittas.
         */

        $query = "SELECT * FROM Users WHERE username='testuser05' AND password='123456'"; 
        $stmt = $db->Prepare($query);

        if ($db->CheckUser($stmt) == FALSE) {
            echo "Database - Test 4: CheckUser(), misslyckades (användaren kunde inte hittas).";
            return false;
        }

        $db->Connect(new DBConfig);


        /**
         * Test 5: Kolla så att det går att ta bort en användare.
         */

        $query = "DELETE FROM Users WHERE username ='testuser05'"; 
        $stmt = $db->Prepare($query);

        if ($db->DeleteUsers($stmt) == FALSE) {
            echo "Database - Test 5: DeleteUsers(), misslyckades (det gick inte att ta bort användaren).";
            return false;
        }


        /**
         * Test 6 och 7: Kolla så att användarna kan hämtas.
         */

        $query = "SELECT * FROM Users";
        $stmt = $db->Prepare($query);
        
        $userArray = $db->GetUsers($stmt);

        if (is_array($userArray) == FALSE) {
            echo "Database - Test 6: GetUsers(), misslyckades (ingen array hämtades med användare).";
            return false;
        }
        else if (count($userArray) != 2){
            echo "Database - Test 7: GetUsers(), misslyckades (arrayen som hämtades innehåller ej de två arrayerna för id och användarnamn).";
            return false;            
        }


        /**
         * Test 8: Kolla så att det går att stänga databasen.
         */
        if ($db->Close() == FALSE) {
            echo "Database - Test 8: Close(), misslyckades (det gick att stänga databasen).";
            return false;
        }
        
        
        return true;
}  
}