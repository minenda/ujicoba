<?php
if(isset($_GET['aksi'])=='delete') {
$id=$_GET['id'];
$del=mysqli_query($conn,"delete from mc_customer where id='$id'");
if($del) {
echo '<div class="alert alert-primary alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button> Data berhasil dihapus.</div>';
}else{
echo '<div class="alert alert-danger alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button> Data gagal dihapus.</div>';
}
}
if(isset($_POST['update'])){
	$id_customer = $_POST['id_customer'];
	$name_customer = addslashes($_POST['name_customer']);
	$country	= addslashes($_POST['country']);
	$remarks	= addslashes($_POST['remarks']);
	$cek = mysqli_num_rows(mysqli_query($conn,"select * from mc_customer where name_customer = '$name_customer'"));
	if($cek == '0'){
	$update = mysqli_query($conn,"update mc_customer set name_customer='$name_customer', country = '$country', remarks = '$remarks' where id_customer='$id_customer'");
	$up_mcassy = mysqli_query($conn,"update mc_assy set customer = '$name_customer' where customer = '$name_customer'");
	$up_mcpartassy = mysqli_query($conn,"update mc_part_assy set customer = '$name_customer' where customer = '$name_customer'");
	$up_mcpart = mysqli_query($conn,"update mc_part set customer = '$name_customer' where customer = '$name_customer'");
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
								<h2 class="main-content-title tx-24 mg-b-5">Customer List</h2>
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
													<div class="container-fluid">
													 <!--Content start-->
													 <div class="row row-sm">
														<div class="col-lg-12">
															<div class="card custom-card overflow-hidden">
																<div class="card-body">
																	<div><a href="?page=CreateCustomer" class="btn btn-success">Add Cust</a>
																	</div><br>
																		<div class="table-responsive">
																			<table id="lookup" class="table table-bordered border-t0 key-buttons text-nowrap w-100" style="font-size:14px">
																				<thead>
																					<tr>
																						<th>No</th>
																						<th>ID Cust</th>
																						<th>Customer Name</th>
																						<th>Country</th>
																						<th>Remarks</th>
																						<th>Tool</th>
																					</tr>
																				</thead>
																				<tbody>
																				   
																				</tbody>
																			</table>
																		</div>
																	</div>
																</div>
															</div>
														</div>
													 <!--content end-->
											</div>
										</div>
									</div><!-- col end -->
							</div><!-- col end -->
						</div><!-- Row end -->
					</div>
				</div>
			</div>
			<!-- End Main Content-->
			<script src="../assets/plugins/jquery/jquery.min.js"></script>
		<?php include "footer.php";?>
<script>
        $(document).ready(function() {
				var dataTable = $('#lookup').DataTable( {
					"processing": true,
					"serverSide": true,
					"ajax":{
						url :"custAjax.php", // json datasource
						type: "post",  // method  , by default get
						error: function(){  // error handling
							$(".lookup-error").html("");
							$("#lookup").append('<tbody class="employee-grid-error"><tr><th colspan="3">No data found in the server</th></tr></tbody>');
							$("#lookup_processing").css("display","none");
							
						}
					}
				} );
			} );
        </script>
