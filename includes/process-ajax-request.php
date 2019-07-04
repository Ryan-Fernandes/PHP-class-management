<?php
    $manage = $_POST['manage'];
    if($manage == "student"){
        require_once("../classes/Student.php");
        $student = new Student();
        if(isset($_POST['rows'])){
            $numRows = $_POST['rows'];
            if($numRows == 0){
                $numRows = $student->studentPerPage;
            }
        }
       $student->displayStudentsWithPagination($numRows);
    }else if($manage == "branch"){
        require_once("../classes/Branch.php");
        $branch = new Branch();
        if(isset($_POST['rows'])){
            $numRows = $_POST['rows'];
            if($numRows == 0){
                $numRows = $branch->recordsPerPage;
            }
        }
       $branch->displayRecordsWithPagination($numRows);
    }else if($manage == "subject"){
        require_once("../classes/Subject.php");
        $subject = new Subject();
        if(isset($_POST['rows'])){
            $numRows = $_POST['rows'];
            if($numRows == 0){
                $numRows = $subject->recordsPerPage;
            }
        }
       $subject->displayRecordsWithPagination($numRows);
    }else if($manage == "stream"){
        require_once("../classes/Stream.php");
        $stream = new Stream();
        if(isset($_POST['rows'])){
            $numRows = $_POST['rows'];
            if($numRows == 0){
                $numRows = $stream->recordsPerPage;
            }
        }
       $stream->displayRecordsWithPagination($numRows);
    }else if($manage == "semester"){
        require_once("../classes/Semester.php");
        $semester = new Semester();
        if(isset($_POST['rows'])){
            $numRows = $_POST['rows'];
            if($numRows == 0){
                $numRows = $semester->recordsPerPage;
            }
        }
       $semester->displayRecordsWithPagination($numRows);
    }else if($manage == "batch"){
        require_once("../classes/Batch.php");
        $batch = new Batch();
        if(isset($_POST['rows'])){
            $numRows = $_POST['rows'];
            if($numRows == 0){
                $numRows = $semester->recordsPerPage;
            }
        }
       $batch->displayRecordsWithPagination($numRows);
    }else if($manage == "addBatch"){
        $data = $_POST['data'];
        if($data == "branch"){
            require_once("../classes/Branch.php");
            $branch = new Branch();
            $options = "<option value='select'>Select...</option>";
            echo $options;
            return ($branch->populateBranches());
        }elseif($data == "semester"){
            require_once("../classes/Semester.php");
            $semester = new Semester();
            $options = "<option value='select'>Select...</option>";
            echo $options;
            return ($semester->populateSemesters());
        }  
    }else if($manage == "showSubject"){
        require_once("../classes/Subject.php");
        $branch_id = $_POST['branch'];
        $sem_id = $_POST['sem'];
        $subject = new Subject();
        $subject->populateSubjects($sem_id,$branch_id);
    }
    
?>