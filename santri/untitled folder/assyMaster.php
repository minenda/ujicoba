<?php
if(isset($_GET['aksi'])=='delete') {
$id=$_GET['id'];
$del=mysqli_query($conn,"delete from mc_assy where id='$id'");
if($del) {
echo '<div class="alert alert-primary alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button> Data berhasil dihapus.</div>';
}else{
echo '<div class="alert alert-danger alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button> Data gagal dihapus.</div>';
}
}
$id= $_GET['id'];
if(isset($_POST['update'])){
$namafolder="image/"; //tempat menyimpan file
if (!empty($_FILES["nama_file"]["tmp_name"]))
{
		$jenis_gambar=$_FILES['nama_file']['type'];
		$part_assy         	= addslashes($_POST['part_assy']);
		$assy_name			= addslashes($_POST['assy_name']);
        $weight	            = $_POST['weight'];
		$customer	        = addslashes($_POST['customer']);
		$remarks            = addslashes($_POST['remarks']);
		
	if($jenis_gambar=="image/jpeg" || $jenis_gambar=="image/jpg" || $jenis_gambar=="image/gif" || $jenis_gambar=="image/x-png")
	{			
		$gambar = $namafolder . basename($_FILES['nama_file']['name']);		
		if (move_uploaded_file($_FILES['nama_file']['tmp_name'], $gambar)) {
			$sql="UPDATE mc_assy SET part_assy='$part_assy', assy_name='$assy_name', weight='$weight', customer='$customer', remarks='$remarks', image='$gambar' WHERE id='$id'";
			$res=mysqli_query($conn, $sql) or die (mysqli_error());
            echo "<script>alert('Data Asset berhasil diupdate!'); window.location ='?page=MasterAssy'</script>";	   		 
		} else {
		   echo '<div class="alert alert-danger alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>Ups, data gagal di update.!</div>';
		}
   } else {
		echo "Jenis gambar yang anda kirim salah. Harus .jpg .gif .png";
   }
} else {
        $id           		= $_GET['id'];
		$part_assy         	= addslashes($_POST['part_assy']);
		$assy_name			= addslashes($_POST['assy_name']);
        $weight	            = $_POST['weight'];
		$customer	        = addslashes($_POST['customer']);
		$remarks            = addslashes($_POST['remarks']);
		$sql="UPDATE mc_assy SET part_assy='$part_assy', assy_name='$assy_name', weight='$weight', customer='$customer', remarks='$remarks' WHERE id='$id'";
		$res=mysqli_query($conn, $sql) or die (mysqli_error());
		if ($res){
           echo "<script>alert('Data Asset berhasil diupdate!'); window.location = '?page=MasterAssy'</script>";	   		   			
		} else {
            echo "<script>alert('Data Asset Gagal diupdate!'); window.location = '?page=MasterAssy'</script>";	   	   			
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
								<h2 class="main-content-title tx-24 mg-b-5">Assy List</h2>
								<ol class="breadcrumb">
									<li class="breadcrumb-item"><a href="?page=Home">Home</a></li>
									<li class="breadcrumb-item active" aria-current="page">Master Assy</li>
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
													<div class="row row-sm">
														<div class="col-lg-12">
															<div class="card custom-card overflow-hidden">
																<div class="card-body">
																	<div>
																	</div>
																		<div class="table-responsive">
																			<table id="lookup" class="table table-bordered border-t0 key-buttons text-nowrap w-100" style="font-size:14px">
																				<thead>
																					<tr>
																						<th>No</th>
																						<th>Part Assy</th>
																						<th>Part Name</th>
																						<th>Weight</th>
																						<th>Image</th>
																						 <th>Customer</th>
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
											</div>
										</div>
									</div><!-- col end -->
							</div><!-- col end -->
						</div><!-- Row end -->
					</div>
				</div>
			</div>
			<!-- End Main Content-->
			<!-- Back-to-top -->
		<!-- Jquery js-->
		<script src="../assets/plugins/jquery/jquery.min.js"></script>
		<?php include "footer.php";?>
<script>
        $(document).ready(function() {
				var dataTable = $('#lookup').DataTable( {
					"processing": true,
					"serverSide": true,
					"ajax":{
						url :"assyAjax.php", // json datasource
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
</html>
