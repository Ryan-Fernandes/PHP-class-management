<!DOCTYPE html>
<html>
	<?php
    ob_start();
    include_once("includes/init.php");
    Session::startSession();
    User::checkActiveSession();
	$page = "Enquiry";
	$title ="Study Link | Manage Enquiry";
	include_once("includes/head.php");
    ?>
    <body>

        <!-- Begin page -->
        <div id="wrapper">
			<!--INCLUDING SIDEBAR-->
            <?php include_once("includes/sidebar.php"); ?>
            
            <!--INCLUDING MAIN CONTENTS OF THE PAGE-->
            <?php 
			if(isset($_GET['q'])){
				$q = $_GET['q'];
            }else{
                $q = "default";
            }
            switch ($q)
            {
				case 'add':
				    include_once("includes/enquiry/add-enquiry.php"); 
					break;
                case 'addstudent':
				    include_once("includes/enquiry/add-enquiry-to-student.php"); 
					break;
                case 'edit':
				    include_once("includes/enquiry/edit-enquiry.php"); 
					break;
				default:
					include_once("includes/enquiry/manage-enquiry.php"); 
					break;
			}	
			?>
            
        </div>
        <!-- END wrapper -->
        <!-- jQuery  -->
        <script src="assets/js/jquery.min.js"></script>
        <script src="assets/js/popper.min.js"></script>
        <script src="assets/js/bootstrap.min.js"></script>
        <script src="assets/js/metisMenu.min.js"></script>
        <script src="assets/js/waves.js"></script>
        <script src="assets/js/jquery.slimscroll.js"></script>
        <!-- Parsley js USED FOR VALIDATION-->
        <script type="text/javascript" src="../plugins/parsleyjs/parsley.min.js"></script>
        <!--Toastr is  used for showing notifications-->
        <script src="plugins/toastr/toastr.min.js"></script>
        <?php include_once("includes/scripts/show-notification.php")?>
        
        <!-- Dashboard Init -->
        <script src="assets/pages/jquery.student.init.js"></script>

        <!-- App js -->
        <script src="assets/js/jquery.core.js"></script>
        <script src="assets/js/jquery.app.js"></script>

    </body>
</html>