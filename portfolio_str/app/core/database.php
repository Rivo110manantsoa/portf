<?php 
class Database {
    private function connect() {
        try {
            $con = new PDO("sqlite:portfolioo.db");
        } catch (PDOException $e) {
            echo $e->getMessage();
        }

        return $con;
    }

    public function runQuery($query,$data=[],$data_type="object") {
        $con = $this->connect();
        $stm = $con->prepare($query);

        if ($stm) {
            $check = $stm->execute($data);
            if ($check) {
                if ($data_type == "object") {
                    $data = $stm->fetchAll(PDO::FETCH_OBJ);
                } else {
                    $data = $stm->fetchAll(PDO::FETCH_ASSOC);
                }
                
                if (is_array($data) && count($data) > 0) {
                    return $data;
                }
            }
        }
        
        return true;
    }
}