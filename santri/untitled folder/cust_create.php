<?php
if(isset($_POST['save'])){
	$id_customer = $_POST['id_customer'];
	$name_customer = addslashes($_POST['name_customer']);
	$country	= addslashes($_POST['country']);
	$remarks	= addslashes($_POST['remarks']);
	$cek = mysqli_num_rows(mysqli_query($conn,"select * from mc_customer where name_customer = '$name_customer' or id_customer='$id_customer'"));
	if($cek == '0'){
	$insert = mysqli_query($conn,"insert into mc_customer (id_customer, name_customer, country, remarks) values('$id_customer', '$name_customer', '$country', '$remarks')");
	if($insert) {
		echo "<script>alert('Data Successfully Added!'); window.location ='?page=CreateCustomer'</script>";
		}else{
		echo "<script>alert('Data Failed to Added!'); window.location ='?page=CreateCustomer'</script>";
		}
}
}
?>
			<!-- Main Content-->
			<div class="main-content side-content pt-0">
				<div class="container-fluid">
					<div class="inner-body">
						<!-- Page Header -->
						<div class="page-header">
							<div>
								<h2 class="main-content-title tx-24 mg-b-5">Add Customer</h2>
								<ol class="breadcrumb">
									<li class="breadcrumb-item"><a href="?page=Home">Home</a></li>
									<li class="breadcrumb-item active" aria-current="page">Customer</li>
								</ol>
							</div>
							<!--<div class="d-flex">
								<div class="justify-content-center">
									<button type="button" class="btn btn-white btn-icon-text my-2 me-2">
									  <i class="fe fe-download me-2"></i> Import
									</button>
									<button type="button" class="btn btn-white btn-icon-text my-2 me-2">
									  <i class="fe fe-filter me-2"></i> Filter
									</button>
									<button type="button" class="btn btn-primary my-2 btn-icon-text">
									  <i class="fe fe-download-cloud me-2"></i> Download Report
									</button>
								</div>
							</div>-->
						</div>
						<!-- End Page Header -->
						<div class="col-sm-12 col-lg-12 col-xl-12 mt-xl-12">
								<!--row-->
								<div class="row row-sm">
									<div class="col-sm-12 col-lg-12 col-xl-12">
										<div class="card custom-card overflow-hidden">
											<div class="card-header border-bottom-0">
												<!--<div>
													<label class="main-content-label mb-2">Judul</label> <span class="d-block tx-12 mb-0 text-muted">Deskripsi</span>
												</div>-->
											</div>
											<div class="card-body ps-0">
												<div class="">
													<div class="container-fluid">
													 <!--Content start-->
													 <form action="?page=CreateCustomer" name="modal_popup" enctype="multipart/form-data" method="POST">
															<div class="modal-body">
																<div class="row">
																	<table class="table text-nowrap text-md-nowrap mg-b-0">
																		<tr>
																			<td>ID Customer</td>
																			<td>:</td>
																			<td><input class="form-control" type="text" name="id_customer" style="color:muted"></td>
																		</tr>
																		<tr>
																			<td>Customer Name</td>
																			<td>:</td>
																			<td><input class="form-control" type="text" name="name_customer" style="color:muted"></td>
																		</tr>
																		<tr>
																			<td>Country</td>
																			<td>:</td>
																			<td><input class="form-control" type="text" name="country" style="color:muted"></td>
																		</tr>
																		<tr>
																			<td>Remarks</td>
																			<td>:</td>
																			<td><input class="form-control" type="text" name="remarks" style="color:muted"></td>
																		</tr>
																	</table>
																</div>
															</div>
															<div class="modal-footer justify-content-center">
																<button id="save" name="save" class="btn ripple btn-primary" type="submit">Save</button>
															</div>
														</form>
													 <!--content end-->
													</div>
												</div>
											</div>
										</div>
									</div><!-- col end -->
							</div><!-- col end -->
						</div><!-- Row end -->
					</div>
				</div>
			</div>
			<!-- End Main Content-->
			<?php include "footer.php";?>
