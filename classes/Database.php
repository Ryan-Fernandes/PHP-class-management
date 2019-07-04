<?php
    class Database{
        private $host;
        private $username;
        private $password;
        private $database;
        private $connection;
        
        public function __construct(){
            $this->host="localhost";
            $this->username="project";
            $this->password="project";
            $this->database="classmanagement";
            $this->connectDB();
        }  
        //NOTE: PHP deosnt support OVERLOADING
        /*public function __construct($host,$username,$password,$database){
            $this->host=$host;
            $this->username=$username;
            $this->password=$password;
            $this->$database=$database;
        }*/
        
        public function connectDB(){
            $this->connection = new mysqli($this->host, $this->username, $this->password);
            if(mysqli_connect_error()){
                //instead of "mysqli_connect_error()" we can aslo use "!$this->connection->errno"
                //if connection is not successful
                die("Connection Failed: ".mysqli_error());
                    //$this->connection->connect_error can also print error no
            }
            
            $db_selected = $this->connection->select_db($this->database);
            
            if(!$db_selected){
                /*
                    query for databse creation
                    eecute it
                    query fr all tables simally
                        (this ll load the databses n tables automaticalaly if rn for the frst tym during deployment)
                */
                //echo "Database not selected";
            }else{
                //echo "Database Selected";
            }
            //return $this->connection;
        }
        
        public function query($sql){
            $result =$this->connection->query($sql);
            if(!$result){
                die("Query failed!" .$sql);
            }
            return $result;
        }
        
        public function getConnection(){
            return $this->connection;
        }
        
        public function escape_string($string){
            $escaped_string = $this->connection->real_escape_string($string);
            return $escaped_string;
        }
        
        public function __destruct(){
            //this is destructor in php
        }
    }
    $database = new Database();
?>