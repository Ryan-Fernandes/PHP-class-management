<?php
    include_once("Database.php");
    class GeneralFunctions{
        private $connection;
        
        public  function __CONSTRUCT(){
            global $database;
            $this->connection = $database->getConnection();
        }
        
        
        public function getTotalRecordsCountWithCondition($tablename,$condition){
            $sql = "SELECT count(*) AS total_count from $tablename WHERE deleted=0 ".$condition;
            $result_set = $this->connection->query($sql);
            if($row = mysqli_fetch_assoc($result_set)){
                return $row['total_count'];
            }else{
                die("Error while Fetching total count of record");
            }
        }

        public function getTotalRecordCount($tablename){
                $sql = "SELECT count(*) AS total_count from $tablename WHERE deleted=0";
                $result_set = $this->connection->query($sql);
                if($row = mysqli_fetch_assoc($result_set)){
                    return $row['total_count'];
                }else{
                    die("Error while Fetching total count of Record");
                }
            }

        public function readAllRecordsWithCondition($tablename,$condition)
        {
            $result_set = $this->connection->query("SELECT * FROM $tablename WHERE deleted = 0 ".$condition);
            return $result_set;
        }

        public function readAllRecords($tablename){

                $result_set = $this->connection->query("SELECT * FROM $tablename WHERE deleted=0");
                return $result_set;
            }
        
        public function getAllDetailsByID($tablename,$id){
            $result_set =$this->connection->query("SELECT * FROM $tablename WHERE id = $id");
            return $result_set;
        }
        
    }

?>