<!DOCTYPE html>
<html>
	<?php
    ob_start();
    include_once("includes/init.php");
    Session::startSession();
    User::checkActiveSession();
	$page = "Stream";
	$title ="Study Link | Manage Stream";
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
				    include_once("includes/stream/add-stream.php"); 
					break;
                case 'edit':
				    include_once("includes/stream/edit-stream.php"); 
					break;
				default:
					include_once("includes/stream/manage-stream.php"); 
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
        <script type="text/javascript" src="plugins/parsleyjs/parsley.min.js"></script>
        <!--Sweet Alert is used for creating user friednly modal-->
        <script src="plugins/sweet-alert/sweetalert2.min.js"></script>
        <!--Toastr is  used for showing notifications-->
        <script src="plugins/toastr/toastr.min.js"></script>
        <?php include_once("includes/scripts/show-notification.php")?>
        
        <!-- Dashboard Init -->
        <script src="assets/pages/jquery.stream.init.js"></script>

        <!-- App js -->
        <script src="assets/js/jquery.core.js"></script>
        <script src="assets/js/jquery.app.js"></script>

    </body>
</html>