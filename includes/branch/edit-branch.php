<?php
    $branch = new Branch();
    if(isset($_GET['id'])){
        
        $id = $_GET['id'];
        $get_branch_details_resultset = $branch->getDetailsByID($id);
        $row = mysqli_fetch_assoc($get_branch_details_resultset);
        extract($row);
        if(isset($_POST['edit_branch_details'])){
            extract($_POST);

            $branch_id = $branch->update($id,$branch_code,$branch_name);

            Functions::redirect("branch.php?q=view&op=update&p=success&page=branch");
        }
    }
?>
<!-- ============================================================== -->
<!-- Start right Content here -->
<!-- ============================================================== -->

<div class="content-page">

	<?php
	$page_title = "Manage Branch";
	$breadcrumb = "
	<li class='breadcrumb-item'>Branch Management</li>
	<li class='breadcrumb-item active'>Edit Branch</li>";
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

							<form class="" name="add-branch" id="add-branch" action="#" method="post">
								<h4>Branch Details</h4>
								<!--STUDENT DETAILS-->
								<div class="form-group">
									<label for="branch_code">Branch Code</label>
									<input type="text" class="form-control" value="<?php echo $branch_code?>" name="branch_code" id="branch_code" required placeholder="Enter Branch Code" />
								</div>
                                <div class="form-group">
									<label for="branch_name">Branch Name</label>
									<input type="text" class="form-control" value="<?php echo $branch_name?>" name="branch_name" id="branch_name" required placeholder="Enter Branch Name" />
								</div>
								
								<div class="form-group">
									<div>
										<button type="submit" name="edit_branch_details" class="btn btn-custom waves-effect waves-light">
                                        Edit
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
