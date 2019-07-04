<?php

/*SCHEMA OF ENQUIRY
id,student_first_name,student_last_name,student_email,student_number,student_branch,student_sem,stream_id,reference,date_of_enquiry,college_name,comments,handled_by,created_at,updated_at,updated_by,deleted,deleted_at,deleted_by,admitted*/
    
    include_once("classes/Database.php");

    class Enquiry{
        private $connection;
        
        public function __CONSTRUCT(){
            global $database;
            $this->connection = $database-> getConnection();
        }
        
        public function readAllEnquiries(){
            $result_set = $this->connection->query("SELECT * FROM enquiry where deleted = 0 and admitted = 0");
            return $result_set;
        }
        
        public function getAllDetailsOfAEnquiry($id){
            $sql = "SELECT * FROM enquiry WHERE id=$id";
            
            $result_set = $this->connection->query($sql);
            if($this->connection->error)
                echo $this->connection->error;
            return ($result_set);
        }
        
        public function insertEnquiry($student_first_name,$student_last_name,$student_email,$student_number,$student_branch,$student_sem,$stream_id,$reference,$college_name,$comments){
            $current_date  = date("y-m-d h:i:sa");
            $current = date("y-m-d");
            $updated_by = 0;
            $deleted = 0;
            $admitted = 0;
            $handle = 1;
            $query = "INSERT INTO enquiry(student_first_name, student_last_name, student_email, student_number, student_branch, student_sem, stream_id, reference, date_of_enquiry, college_name, comments, handled_by, created_at, updated_at, updated_by, deleted, admitted) VALUES(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)";
            $preparedStatement = $this->connection->prepare($query);
            $preparedStatement->bind_param("ssssiiissssissiii",$student_first_name, $student_last_name, $student_email, $student_number, $student_branch, $student_sem, $stream_id, $reference, $current, $college_name, $comments, $handle, $current_date, $current_date, $updated_by, $deleted, $admitted);
            
            if($preparedStatement->execute()){
                return $this->connection->enquiry_id;
            }else{
                die("ERROR WHILE INSERTING ENQUIRY");
            }
        }
        
        public function updateEnquiry($id,$student_first_name,$student_last_name,$student_email,$student_number,$student_branch,$student_sem,$stream_id,$reference,$date_of_enquiry,$college_name,$comments){
            $current_date  = date("y-m-d h:i:sa");
            $updated_by = 0;
            $deleted = 0;
            $admitted = 0;
            $query = "Update enquiry set student_first_name = ?, student_last_name = ?, student_email = ?, student_number = ?, student_branch = ?, student_sem = ?,stream_id = ?,reference = ?,date_of_enquiry = ?,college_name = ?,comments = ? where id = ?";
            $preparedStatement = $this->connection->prepare($query);
            $preparedStatement->bind_param("ssssiiisssisiisii",$student_first_name,$student_last_name,$student_email,$student_number,$student_branch,$student_sem,$stream_id,$reference,$date_of_enquiry,$college_name,$comments,$handled_by,$created_at,$updated_at,$updated_by,$deleted,$deleted_at,$deleted_by,$admitted,$id);
            
            if($preparedStatement->execute()){
                return true;
            }else{
                die("ERROR WHILE UPDATING ENQUIRY");
            }
        }
        
        public function admitStudent($id){
            $admitted = 1;
            $query = "UPDATE enquiry set admitted = ? WHERE id = ?";
            $preparedStatement = $this->connection->prepare($query);
            $preparedStatement->bind_param("ii",$admitted,$id);
            
            if($preparedStatement->execute()){
                return true;
            }else{
                die("ERROR WHILE ADMITTING STUDENT");
            }
        }
        
    }
?>