<?php
    $manage = $_POST['manage'];
    if($manage == "student"){
        require_once("../classes/Student.php");
        if($_REQUEST['sid']){
            $sid = $_REQUEST['sid'];
            $student = new Student();
            $student->deleteStudent($sid);
        }
    }else if($manage == "branch"){
        require_once("../classes/Branch.php");
        if($_REQUEST['id']){
            $id = $_REQUEST['id'];
            $branch = new Branch();
            $branch->delete($id);
        }
    }else if($manage == "subject"){
        require_once("../classes/Subject.php");
        if($_REQUEST['id']){
            $id = $_REQUEST['id'];
            $subject = new Subject();
            $subject->delete($id);
        }
    }else if($manage == "stream"){
        require_once("../classes/Stream.php");
        if($_REQUEST['id']){
            $id = $_REQUEST['id'];
            $stream = new Subject();
            $stream->delete($id);
        }
    }else if($manage == "semester"){
        require_once("../classes/Semester.php");
        if($_REQUEST['id']){
            $id = $_REQUEST['id'];
            $semester = new Semester();
            $semester->delete($id);
        }
    }else if($manage == "batch"){
        require_once("../classes/Batch.php");
        if($_REQUEST['id']){
            $id = $_REQUEST['id'];
            $batch = new Batch();
            $batch->delete($id);
        }
    }
?>