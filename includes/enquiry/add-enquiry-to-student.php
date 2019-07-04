<?php
    if(isset($_POST['add_student_details'])){
        $sid = $_GET['sid'];
        
        extract($_POST);
        
        $student = new Student();
        $student_id = $student->insertStudent($student_first_name, $student_last_name, $student_email, $student_number, $student_address, $student_branch, $student_dob, $student_college, $student_gender, $stream_id );
        
        $parent = new Parents();
        // FATHER
        $gender = "Male";
        $father_id = $parent->insertParentDetails($father_first_name, $father_number, $father_email, $gender);
        
        //MOTHER
        $gender = "Female";
        $mother_id = $parent->insertParentDetails($mother_first_name, $mother_number, $mother_email, $gender);
        
        //LINKNG
        $student->linkWithGuardian($student_id, $father_id);
        $student->linkWithGuardian($student_id, $mother_id);
        
        $enquiry = new Enquiry();
        $enquiry->admitStudent($sid);
        
        Functions::redirect("student.php");
    }
?>
   
<?php
    if(isset($_GET['sid'])){
        $sid = $_GET['sid'];
        $enquiry = new Enquiry();
        
        $result_set = $enquiry->getAllDetailsOfAEnquiry($sid);
        
        if($row = mysqli_fetch_assoc($result_set)){
            extract($row);
        }
?>
    <!-- ============================================================== -->
    <!-- Start right Content here -->
    <!-- ============================================================== -->

    <div class="content-page">

        <?php
	$page_title = "Manage Enquiry";
	$breadcrumb = "
	<li class='breadcrumb-item'>Enquiry Management</li>
	<li class='breadcrumb-item active'>Add Student</li>";
	include_once("includes/top-bar.php");
	?>
            <!-- Start Page content -->
            <div class="content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="card-box">
                                <!--<p class="text-muted font-14 m-b-20">
								Parsley is a javascript form validation library. It helps you provide your users with feedback on their form submission before sending it to your server.
							</p>-->

                                <form class="" name="add-student" id="add-student" action="#" method="post">
                                    <h4>Personal Details</h4>
                                    <!--STUDENT DETAILS-->
                                    <div class="form-group">
                                        <label for="student_first_name">First Name</label>
                                        <input type="text" class="form-control" name="student_first_name" id="student_first_name" value="<?php echo $student_first_name?>" required placeholder="Enter First Name" />
                                    </div>
                                    <div class="form-group">
                                        <label for="student_last_name">Last Name</label>
                                        <input type="text" class="form-control" name="student_last_name" id="student_last_name" value="<?php echo $student_last_name?>" required placeholder="Enter Last Name" />
                                    </div>
                                    <div class="form-group">
                                        <label for="student_email">Email</label>
                                        <input type="email" class="form-control" name="student_email" value="<?php echo $student_email?>" id="student_email" required parsley-type="email" required placeholder="Enter a valid e-mail" />
                                    </div>
                                    <div class="form-group">
                                        <label for="student_number">Number</label>
                                        <input type="text" class="form-control" name="student_number" value="<?php echo $student_number?>" id="student_number" required placeholder="Enter Contact Number" />
                                    </div>
                                    <div class="form-group">
                                        <label for="student_address">Address</label>
                                        <textarea type="text" class="form-control" name="student_address" id="student_address" required placeholder="Enter Address"></textarea>
                                    </div>
                                    <!--BRANCH-->
                                    <div class="form-group">
                                        <label for="student_branch">Branch</label>
                                        <input type="text" class="form-control" name="student_branch" value="<?php echo $student_branch?>" id="student_branch" required placeholder="Enter Branch" />
                                    </div>
                                    <!--END OF BRANCH-->
                                    <!--DOB-->
                                    <div class="form-group">
                                        <label for="student_dob">DOB</label>
                                        <input type="text" class="form-control" name="student_dob" id="student_dob" required placeholder="Enter DOB" />
                                    </div>
                                    <!--END OF DOB-->
                                    <!--COLLEGE-->
                                    <div class="form-group">
                                        <label for="student_college">College</label>
                                        <input type="text" class="form-control" name="student_college" value="<?php echo $college_name?>" id="student_college" required placeholder="Enter College" />
                                    </div>
                                    <!--END OF College-->
                                    <!--Gender-->
                                    <div class="form-group">
                                        <label for="student_gender">Gender</label>
                                        <input type="text" class="form-control" name="student_gender" id="student_gender" required placeholder="Enter Gender" />
                                    </div>
                                    <!--END OF Gender-->
                                    <!--Stream ID-->
                                    <div class="form-group">
                                        <label for="stream_id">Stream ID</label>
                                        <input type="text" class="form-control" name="stream_id" value="<?php echo $stream_id?>" id="stream_id" required placeholder="Enter Stream ID" />
                                    </div>
                                    <!--END OF Stream ID-->

                                    <!--END OF STUDENT DETAILS-->



                                    <!--Father DETAILS-->
                                    <h4>Father Details</h4>
                                    <input type="hidden" name="father_id"/>
                                    <div class="form-group">
                                        <label for="father_first_name">First Name</label>
                                        <input type="text" class="form-control" name="father_first_name" id="father_first_name" required placeholder="Enter First Name" />
                                    </div>

                                    <div class="form-group">
                                        <label for="father_number">Number</label>
                                        <input type="text" class="form-control" name="father_number" id="father_number" required placeholder="Enter Number" />
                                    </div>

                                    <div class="form-group">
                                        <label for="father_email">Email</label>
                                        <input type="email" class="form-control" name="father_email" id="father_email" required parsley-type="email" required placeholder="Enter a valid e-mail" />
                                    </div>
                                    <!--END OF FATHER DETAILS-->


                                    <!--Mother DETAILS-->
                                    <h4>Mother Details</h4>
                                    <input type="hidden" name="mother_id" />
                                    <div class="form-group">
                                        <label for="mother_first_name">First Name</label>
                                        <input type="text" class="form-control" name="mother_first_name" id="mother_first_name" required placeholder="Enter First Name" />
                                    </div>

                                    <div class="form-group">
                                        <label for="mother_number">Number</label>
                                        <input type="text" class="form-control" name="mother_number" id="mother_number" required placeholder="Enter Number" />
                                    </div>

                                    <div class="form-group">
                                        <label for="mother_email">Email</label>
                                        <input type="email" class="form-control" name="mother_email" id="mother_email" required parsley-type="email" required placeholder="Enter a valid e-mail" />
                                    </div>
                                    <!--END OF Mother DETAILS-->

                                    <div class="form-group">
                                        <div>
                                            <button type="submit" name="add_student_details" class="btn btn-custom waves-effect waves-light">
                                            Submit
                                        </button>
                                            <button type="reset" class="btn btn-light waves-effect m-l-5">
                                            Cancel
                                        </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <!--end row-->
                </div>
                <!-- container -->

            </div>
            <!-- content -->

            <?php include_once("includes/footer.php");?>

    </div>
<?php
    }
?>

    <!-- ============================================================== -->
    <!-- End Right content here -->
    <!-- ============================================================== -->