<?php
    $stream = new Stream();
    if(isset($_GET['id'])){
        
        $id = $_GET['id'];
        $get_stream_details_resultset = $stream->getDetailsByID($id);
        $row = mysqli_fetch_assoc($get_stream_details_resultset);
        extract($row);
        if(isset($_POST['edit_stream_details'])){
            extract($_POST);

            $stream_id = $stream->update($id,$stream_name);

            Functions::redirect("stream.php?q=view&op=update&p=success&page=stream");
        }
    }
?>
<!-- ============================================================== -->
<!-- Start right Content here -->
<!-- ============================================================== -->

<div class="content-page">

	<?php
	$page_title = "Manage Stream";
	$breadcrumb = "
	<li class='breadcrumb-item'>Stream Management</li>
	<li class='breadcrumb-item active'>Edit Stream</li>";
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

							<form class="" name="add-Stream" id="add-Stream" action="#" method="post">
								<h4>Stream Details</h4>
								<!--Stream DETAILS-->
                                <div class="form-group">
									<label for="stream_name">Stream Name</label>
									<input type="text" class="form-control" value="<?php echo $stream_name?>" name="stream_name" id="stream_name" required placeholder="Enter Stream Name" />
								</div>
								
								<div class="form-group">
									<div>
										<button type="submit" name="edit_stream_details" class="btn btn-custom waves-effect waves-light">
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
