<?php
    include_once("Database.php");
    include_once("GeneralFunctions.php");
    
    /* SCHEMA OF BRANCH TABLE:
    
        id,branch_code,branch_name,created_at,updated_at,updated_by,deleted,deleted_at,deleted_by
    */

    class Branch extends GeneralFunctions{
        private $connection;
        public $recordsPerPage;
        private $tablename;
        
        public function __CONSTRUCT(){
            parent::__CONSTRUCT();
            global $database;
            $this->connection = $database->getConnection();
            $this->recordsPerPage = 2 ;
            $this->tablename = "branch";
        }
        
        public function readBranch(){
            
            $result_set = $this->connection->query("SELECT * FROM $this->tablename");
            return $result_set;
        }
        
        public function getDetailsByID($id){
            return ($this->getAllDetailsByID($this->tablename,$id));
        }
        
        public function insert($branch_code, $branch_name){
            
            $current_date = date("Y-m-d h:i:sa");
            $updated_by = 1;
            $deleted = 0;
            
            $query = "INSERT INTO $this->tablename(branch_code,branch_name,created_at,updated_at,updated_by,deleted) VALUES(?,?,?,?,?,?)";
            $preparedStatement = $this->connection->prepare($query);
            $preparedStatement->bind_param("ssssii",$branch_code, $branch_name, $current_date, $current_date, $updated_by, $deleted);
            
            if($preparedStatement->execute()){
                return $this->connection->insert_id;
            }else{
                die("ERROR WHILE INSERTING RECORD IN $this->tablename");
            }
        }
        
        public function update($id,$branch_code, $branch_name){
            $current_date = date("Y-m-d h:i:sa");
            $updated_by = 1;
            $deleted = 0;
            
            $query = "UPDATE $this->tablename SET branch_code = ?,branch_name = ?, updated_at = ?,updated_by = ? where id = ?";
            $preparedStatement = $this->connection->prepare($query);
            $preparedStatement->bind_param("sssii",$branch_code,$branch_name,$current_date,$updated_by,$id);
            
            if($preparedStatement->execute()){
                return true;
            }else{
                die("ERROR WHILE UPDATING BRANCH");
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
                        <th>Branch Name</th>
                        <th>Branch Code</th>
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
                $condition = "AND (branch_name like '%$key%' or branch_code like '%$key%' ) ";
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
                    <?php echo $row['branch_code']; ?>
                </td>
                <td>
                    <?php echo $row['branch_name']; ?>
                </td>
                
                <td>
                    <div class="button-list">
                        <a type="button" class="btn btn-icon waves-effect waves-light btn-purple" data-toggle="tooltip" title="Edit Branch!" href="branch.php?q=edit&id=<?php echo $id; ?>"> <i class="fa fa-pencil"></i> </a>
                        <a type="button" class="btn btn-icon waves-effect waves-light btn-danger delete-branch" data-toggle="tooltip" title="Delete Branch!" data-record-id="<?php echo $id; ?>"> <i class="fa fa-remove"></i> </a>
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
        public function populateBranches(){
        $result = $this->readAllRecords($this->tablename);
        $options = "";
        while($row = mysqli_fetch_assoc($result)){
            extract($row);
            $options .= "<option value = '$id'>$branch_name</option>";
        }
        echo $options;
    }
        
    }
?>