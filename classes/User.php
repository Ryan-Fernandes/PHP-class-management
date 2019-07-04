<?php

include_once("Database.php");
require_once("Session.php");
//$_SESSION['result']=0;
class User{
    private $connection;
    public function __construct(){
        global $database;
        $this->connection = $database->getConnection();
        Session::startSession();
    }
    
    /************************************************
    * The below function is used to log in the user
    * It automatically assigns session attributes
    * It is responsibilty of CALLEE to start the session
    * Returns if credentails were correct otherwise false
    ************************************************/

    public function processLogin($email, $password){
        $query = "select * from members where member_email = ?";
        $preparedStatement = $this->connection->prepare($query);
        $preparedStatement->bind_param("s", $email);
            /*
                s string
                i int
                d double
                b blob(files,bytes)
            */
        $preparedStatement->execute();
        $preparedStatement->store_result();//php7 method
        // variable name should be same as column name
        
        //echo $member_role;
        $count = $preparedStatement->num_rows;
        if($count == 1){
            //login
            $preparedStatement->bind_result($id,$member_name,$member_email, $member_password, $member_role, $created_at, $updated_at);
            $preparedStatement->fetch();
            
            if($password === $member_password){
                $_SESSION['login'] = true;
                $_SESSION['member_id'] = $id;
                $_SESSION['member_name'] = $member_name;
                $_SESSION['member_role'] = $member_role;
                $_SESSION['member_email'] = $member_email;
                return true;
                //echo "connected";
            }else{
                return false;
                //echo "wrong";
            }
        }
        
        
        
        /*$query = "select * from members where member_email = ?";
        $select_user = mysqli_query($this->connection,$query);
        while($row = mysqli_fetch_assoc($select_user)){
            extract($row);
        }
        echo $member_role;*/
        
    }
    
    public function get_session(){
        return $_SESSION['login'];
    }
    
    public function user_logout(){
        $_SESSION['login'] = false;
        $_SESSION['member_id'] = null;
        $_SESSION['member_name'] = null;
        $_SESSION['member_role'] = null;
        session_destroy();
    }
    
    public static function checkActiveSession(){
        if(!Session::isSessionStart()){
            Functions::redirect("login.php");
        }
    }
}
?>