<?php
    include_once("Database.php");
    include_once("GeneralFunctions.php");
    
    /* SCHEMA OF SUBJECT TABLE:
    
        id,subject_name,subject_fees,created_at,updated_at,updated_by,deleted,deleted_at,deleted_by
        
    */

    class Subject extends GeneralFunctions{
        private $connection;
        public $recordsPerPage;
        private $tablename;
        
        public function __CONSTRUCT(){
            parent::__CONSTRUCT();
            global $database;
            $this->connection = $database->getConnection();
            $this->recordsPerPage = 2 ;
            $this->tablename = "subjects";
        }
        
        public function readSubject(){
            
            $result_set = $this->connection->query("SELECT * FROM $this->tablename");
            return $result_set;
        }
        
        public function getDetailsByID($id){
            return ($this->getAllDetailsByID($this->tablename,$id));
        }
        
        public function insert($subject_name, $subject_fees, $semester_id, $branch_id){
            
            $current_date = date("Y-m-d h:i:sa");
            $created_by = $_SESSION['member_id'];
            $updated_by = 1;
            $deleted = 0;
            
            $query = "INSERT INTO $this->tablename(subject_name,subject_fees,semester_id,branch_id,created_by,created_at) VALUES(?,?,?,?,?,?)";
            $preparedStatement = $this->connection->prepare($query);
            $preparedStatement->bind_param("ssiiis",$subject_name, $subject_fees,$semester_id, $branch_id, $created_by, $current_date);
            
            if($preparedStatement->execute()){
                return $this->connection->insert_id;
            }else{
                die("ERROR WHILE INSERTING RECORD IN $this->tablename");
            }
        }
        
        public function update($id,$subject_name, $subject_fees){
            $current_date = date("Y-m-d h:i:sa");
            $updated_by = 1;
            $deleted = 0;
            
            $query = "UPDATE $this->tablename SET subject_name = ?,subject_fees = ?, updated_at = ?,updated_by = ? where id = ?";
            $preparedStatement = $this->connection->prepare($query);
            $preparedStatement->bind_param("sssii",$subject_name,$subject_fees,$current_date,$updated_by,$id);
            
            if($preparedStatement->execute()){
                return true;
            }else{
                die("ERROR WHILE UPDATING RECORD");
            }
        
        }
        
        public function delete($id){
            $current_date = date("Y-m-d h:i:sa");
            $deleted = 1;
            $deleted_by = 1;
            
            $sql = "UPDATE $this->tablename SET deleted=$deleted, deleted_at='$current_date', deleted_by=$deleted_by WHERE id = $id";
            $this->connection->query($sql);
            
            
        }
        
        public function displayRecordsWithPagination($records_Per_Page){
            echo "<table class='table'>
                <thead class='thead-light'>
                    <tr>
                        <th>#</th>
                        <th>Subject Name</th>
                        <th>Subject Code</th>
                        <th>Action</th>
                    </tr>
                </thead>
            <tbody>";
                            
             
            if(isset($_POST['page'])){
                $page = $_POST['page'];
            }else{
                $page=1;
            }
            if($page=="" || $page == 1){
                $limit_start = 0;
            }else{
                $limit_start = ($page * $records_Per_Page) - $records_Per_Page;
            }
            
            $condition = "";
            if(isset($_POST['key'])){
                $key = $_POST['key'];
                $condition = "AND (subject_name like '%$key%') ";
            }
            $total_record = $this->getTotalRecordsCountWithCondition($this->tablename,$condition);
            $num_of_pages = ceil($total_record/$records_Per_Page);
            $condition = $condition . " LIMIT $limit_start,$records_Per_Page";
            $result_set = $this->readAllRecordsWithCondition($this->tablename,$condition);

            $sr_no = $records_Per_Page * $page - $records_Per_Page + 1;
            
            while ($row = mysqli_fetch_assoc($result_set)) {
            $id = $row['id'];
            ?>
            <tr>
                <th scope="row">
                    <?php echo $sr_no; ?>
                </th>
                <td>
                    <?php echo $row['subject_name']; ?>
                </td>
                <td>
                    <?php echo $row['subject_fees']; ?>
                </td>
                
                <td>
                    <div class="button-list">
                        <a type="button" class="btn btn-icon waves-effect waves-light btn-purple" data-toggle="tooltip" title="Edit subject!" href="subject.php?q=edit&id=<?php echo $id; ?>"> <i class="fa fa-pencil"></i> </a>
                        <a type="button" class="btn btn-icon waves-effect waves-light btn-danger delete-subject" data-toggle="tooltip" title="Delete subject!" data-record-id="<?php echo $id; ?>"> <i class="fa fa-remove"></i> </a>
                    </div>
                </td>
            </tr>
            <?php
                $sr_no++;
            }
            ?>
            </tbody>
            </table>
            <hr>
            <ul class="pagination justify-content-end pagination-split mt-0">
            <?php
            $li_class= "page-item";
            $a_class = "page-link";
            $li_active_class = $li_class." active";
            $page_num = $page==1?1:$page-1;
            echo "<li class='$li_class'><a onclick='PaginationLinkClicked($page_num)' class='$a_class'>&lt;&lt;</a></li>";
            for($i=1; $i<=$num_of_pages; $i++) {
                if($i==$page)
                    echo "<li class='$li_active_class'><a onclick='PaginationLinkClicked($i)' class='$a_class'>$i</a></li>";
                else
                    echo "<li class='$li_class'><a  class='$a_class' onclick='PaginationLinkClicked($i)'>$i</a></li>";
            }
            $page_num = $page==$num_of_pages?$num_of_pages:$page+1;
            echo "<li class='$li_class'><a onclick='PaginationLinkClicked($page_num)' class='$a_class'>&gt;&gt;</a></li>";
            ?>
            </ul>
            <?php
        }
        public function populateSubjects($sem_id,$branch_id){
            $query = "SELECT * FROM subjects WHERE semester_id = $sem_id AND branch_id = $branch_id";
            $result = $this->connection->query($query);
            $options = "";
            while($row = mysqli_fetch_assoc($result)){
                extract($row);
                $options .= "<option value='$id'>$subject_name</option>";
            }
            echo $options;
        }
    }
?>