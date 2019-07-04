<?php
    $enquiry = new Enquiry();
    if(isset($_GET['id'])){
        $id = $_GET['id'];
        $get_enquiry_details_resultset = $enquiry->getAllDetailsOfAEnquiry($id);
        $row = mysqli_fetch_assoc($get_enquiry_details_resultset);
        extract($row);
    }
    
    if(isset($_POST['add_enquiry_details'])){
        extract($_POST);
        
        $enquiry_id = $enquiry->updateEnquiry($student_first_name,$student_last_name,$student_email,$student_number,$student_branch,$student_sem,$stream_id,$reference,$student_college,$comments);
        
        Functions::redirect("enquiry.php?q=view&op=update&p=success&page=enquiry");
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
	<li class='breadcrumb-item active'>Add Enquiry</li>";
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

							<form class="" name="add-enquiry" id="add-enquiry" action="#" method="post">
								<h4>Personal Details</h4>
								<!--STUDENT DETAILS-->
								<div class="form-group">
									<label for="student_first_name">First Name</label>
									<input type="text" class="form-control" name="student_first_name" value="<?php $student_first_name?>" id="student_first_name" required placeholder="Enter First Name" />
								</div>
                                <div class="form-group">
									<label for="student_last_name">Last Name</label>
									<input type="text" class="form-control" name="student_last_name" value="<?php $student_last_name?>" id="student_last_name" required placeholder="Enter Last Name" />
								</div>
                                <div class="form-group">
									<label for="student_email">Email</label>
									<input type="email" class="form-control" name="student_email" value="<?php $student_email?>" id="student_email" required parsley-type="email" required placeholder="Enter a valid e-mail" />
								</div>  
                                <div class="form-group">
									<label for="student_number">Number</label>
									<input type="text" class="form-control" name="student_number" value="<?php $student_number?>" id="student_number" required placeholder="Enter Contact Number" />
								</div>                                
                                <!--BRANCH-->
                                <div class="form-group">
									<label for="student_branch">Branch</label>
									<input type="text" class="form-control" name="student_branch" value="<?php $student_branch?>" id="student_branch" required placeholder="Enter Branch" />
								</div>   
                                <!--END OF BRANCH--> 
                                <!--Sem-->
                                <div class="form-group">
									<label for="student_sem">Semester</label>
									<input type="text" class="form-control" name="student_sem" value="<?php $student_sem?>" id="student_sem" required placeholder="Enter Semester" />
								</div>   
                                <!--END OF Sem-->                                                               
                                <!--COLLEGE-->
                                <div class="form-group">
									<label for="student_college">College</label>
									<input type="text" class="form-control" name="student_college" value="<?php $student_college?>" id="student_college" required placeholder="Enter College" />
								</div>   
                                <!--END OF College-->                                                                
                                <!--Stream ID-->
                                <div class="form-group">
									<label for="stream_id">Stream ID</label>
									<input type="text" class="form-control" name="stream_id" value="<?php $stream_id?>" id="stream_id" required placeholder="Enter Stream ID" />
								</div>
                                <div class="form-group">
									<label for="reference">Reference</label>
									<input type="text" class="form-control" name="reference" value="<?php $reference?>" id="reference" required placeholder="Enter Reference" />
								</div> 
                                <div class="form-group">
									<label for="comments">Comments</label>
									<input type="text" class="form-control" name="comments" value="<?php $comments?>" id="comments" required placeholder="Enter Comments" />
								</div>   
                                <!--END OF Stream ID-->
                                
                                <!--END OF STUDENT DETAILS-->
                
								<div class="form-group">
									<div>
										<button type="submit" name="add_enquiry_details" class="btn btn-custom waves-effect waves-light">
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


<!-- ============================================================== -->
<!-- End Right content here -->
<!-- ============================================================== -->
