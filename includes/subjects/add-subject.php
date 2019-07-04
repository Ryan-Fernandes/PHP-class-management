<?php
    if(isset($_POST['add_subject_details'])){
        extract($_POST);
        
        $subject = new Subject();
        $subject_id = $subject->insert($subject_name,$subject_fees,$semester_id, $branch_id);
        
        Functions::redirect("subject.php?q=view&op=add&p=success&page=subject");
    }
?>
<!-- ============================================================== -->
<!-- Start right Content here -->
<!-- ============================================================== -->

<div class="content-page">

	<?php
	$page_title = "Manage Subject";
	$breadcrumb = "
	<li class='breadcrumb-item'>Subject Management</li>
	<li class='breadcrumb-item active'>Add Subject</li>";
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

							<form class="" name="add-subject" id="add-subject" action="#" method="post">
								<h4>Subject Details</h4>
								<div class="form-row">
                                    <!--SUBJECT DETAILS-->
                                    <div class="form-group col-md-6">
                                        <label for="subject_name">Subject Name</label>
                                        <input type="text" class="form-control" name="subject_name" id="subject_name" required placeholder="Enter subject name" />
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="subject_fees">Subject Fees</label>
                                        <input type="text" class="form-control" name="subject_fees" id="subject_fees" required placeholder="Enter subject fees" />
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <label for="semester_id">Semester</label>
                                        <select name="semester_id" id="semester_id" class="form-control">
                                            <?php
                                                $semester = new Semester();
                                                $semester->populateSemesters();
                                            ?>
                                        </select>
                                    </div>

                                    <div class="form-group col-md-6">
                                        <label for="branch_id">Branch</label>
                                        <select name="branch_id" id="branch_id" class="form-control">
                                            <?php
                                                $branch = new Branch();
                                                $branch->populateBranches();
                                            ?>
                                        </select>
                                    </div>
                                </div>
                                
								<div class="form-group">
									<div>
										<button type="submit" name="add_subject_details" class="btn btn-custom waves-effect waves-light">
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
