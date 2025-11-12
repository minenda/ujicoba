       <?php 
                if(isset($_POST['input'])){
//SANGAT PENTING....!!!! JIKA GAGAL UPLOAD KEMUNGKINAN PERMISSION FOLDER HARUS DIUBAH.
//sekretariat@sekretariat-Aspire-E1-410 /var/www/html/app_inv/admin/gbr_inv $ sudo chmod 0777 -R /var/www/html/app_inv/admin
		//$id           		= $_POST['id'];
		$part_no         	= addslashes($_POST['part_no']);
		$part_name			= addslashes($_POST['part_name']);
        $weight	            = $_POST['weight'];
		$thick	            = $_POST['thick'];
		$wide	            = $_POST['wide'];
		$length	            = $_POST['length'];
		$mat	            = $_POST['mat'];
		$customer	        = addslashes($_POST['customer']);
		$remarks            = addslashes($_POST['remarks']);
		$cek=mysqli_num_rows(mysqli_query($conn,"select * from mc_part where part_no='$part_no' and customer='$customer'"));
		if($cek=='0') {
        		$ekstensi_diperbolehkan	= array('png','jpg', 'jpeg', 'gif');
				$nama = $_FILES['nama_file']['name'];
				$gambar='imagesf/'.$nama;
				$x = explode('.', $nama);
				$ekstensi = strtolower(end($x));
				$ukuran	= $_FILES['nama_file']['size'];
				$file_tmp = $_FILES['nama_file']['tmp_name'];	
				if(in_array($ekstensi, $ekstensi_diperbolehkan) === true){
		    	if($ukuran < 5044070){			
				move_uploaded_file($file_tmp, 'imagesf/'.$nama);
				
				$sql="INSERT INTO mc_part(part_no,part_name,weight,thick,wide,length,mat,customer,remarks,image) VALUES
					('$part_no','$part_name','$weight','$thick','$wide','$length','$mat','$customer','$remarks','$gambar')";
				$res=mysqli_query($conn, $sql) or die (mysqli_error());
			
		    }else{
			echo "<script>alert('Image size is too large!'); window.location = '?page=CreateMasterProduct'</script>";
		    }
	       }else{
		//$id           		= $_POST['id'];
		$part_no         	= addslashes($_POST['part_no']);
		$part_name			= addslashes($_POST['part_name']);
        $weight	            = $_POST['weight'];
		$thick	            = $_POST['thick'];
		$wide	            = $_POST['wide'];
		$length	            = $_POST['length'];
		$mat	            = $_POST['mat'];
		$customer	        = addslashes($_POST['customer']);
		$remarks            = addslashes($_POST['remarks']);
		$sql="INSERT INTO mc_part(part_no,part_name,weight,thick,wide,length,mat,customer,remarks,image) VALUES
					('$part_no','$part_name','$weight','$thick','$wide','$length','$mat','$customer','$remarks','')";
				$res=mysqli_query($conn, $sql) or die (mysqli_error());
		
		
	       }
} else { echo "<script>alert('Product Master is existing!'); window.location = '?page=CreateMasterProduct'</script>";	 }
				}
?>
			<!-- Main Content-->
			<div class="main-content side-content pt-0">
				<div class="container-fluid">
					<div class="inner-body">
						<!-- Page Header -->
						<div class="page-header">
							<div>
								<h2 class="main-content-title tx-24 mg-b-5">Add Master Product</h2>
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
					<script src="../assets/js1/jquery.js"></script>
					<script src="../assets/js1/jquery-ui.js"></script>
					<link rel="stylesheet" href="../assets/js1/jquery-ui.css">
			        <script>
			        $(function() {
			        $("#customer").autocomplete({
								        source: 'autoCustomer.php'
							        });
						        });
			        </script>
											<div class="card-body ps-0">
												<div class="">
													<div class="container-fluid">
													 <!--Content start-->
													 <form  action="?page=CreateMasterProduct" method="POST" enctype="multipart/form-data" name="form1" id="form1"> 
														<div class="d-sm-flex">
														<table class="table table-bordered">
														<tr><td>		<div class="parsley-select wd-sm-250" id="slWrapper">
															    <center><p class="mg-b-10 text-muted">Part No</p></center>
																<input tabindex="1" name="part_no" id="part_no"  class="form-control" value="" required/>
																</div></td>
														<td>		<div class="mg-sm-l-10 mg-t-10 mg-sm-t-0">
																<center><p class="mg-b-10 text-muted">Part Name</p></center>
																	<input tabindex="2" name="part_name" id="part_name" class="form-control" type="text" >
																</div></td>
														<td>		<div class="mg-sm-l-10 mg-t-10 mg-sm-t-0">
																<center><p class="mg-b-10 text-muted">Thick</p></center>
																	<input tabindex="3" name="thick" id="thick" class="form-control" type="number" value=""/>
																</div></td>
														<td>		<div class="mg-sm-l-10 mg-t-10 mg-sm-t-0">
																<center><p class="mg-b-10 text-muted">Weight</p></center>
																	<input tabindex="4" name="weight" id="weight" class="form-control" type="number" value=""/>
																</div></td>
														<td>		<div class="mg-sm-l-10 mg-t-10 mg-sm-t-0">
																<center><p class="mg-b-10 text-muted">Wide</p></center>
																	<input tabindex="5" name="wide" id="wide" class="form-control" type="number" value=""/>
																</div></td>
														<td>		<div class="mg-sm-l-10 mg-t-10 mg-sm-t-0">
																<center><p class="mg-b-10 text-muted">Length</p></center>
																	<input tabindex="6" name="length" id="length" class="form-control" type="number" value=""/>
																</div></td></tr>
														</div>
														<br>
														<div class="d-sm-flex">	
														<tr><td>		<div class="mg-sm-l-10 mg-t-10 mg-sm-t-0">
																<center><p class="mg-b-10 text-muted">Spec</p></center>
																	<input tabindex="7" name="mat" id="mat" class="form-control" type="text" value=""/>
																</div></td>
														<td>		<div class="mg-sm-l-10 mg-t-10 mg-sm-t-0">
																<center><p class="mg-b-10 text-muted">Customer</p></center>
																	<input tabindex="8" name="customer" id="customer" class="form-control"type="text" value=""/>
																</div></td>
														<td>		<div class="mg-sm-l-10 mg-t-10 mg-sm-t-0">
																<center><p class="mg-b-10 text-muted">Image</p></center>
																	<input tabindex="9" name="nama_file" id="nama_file" class="form-control"type="file" value=""/>
																</div></td>
														<td colspan="2">		<div class="mg-sm-l-10 mg-t-10 mg-sm-t-0">
																<center><p class="mg-b-10 text-muted">Remarks</p></center>
																	<input tabindex="10" name="remarks" id="remarks" class="form-control"type="text" value=""/>
																</div></td>
														<td>		<div class="mg-sm-l-10 mg-t-10 mg-sm-t-0">
																<p class="mg-b-10 text-muted"></p>
																	<button tabindex="11" class="btn ripple btn-primary pd-x-20" name="input" type="submit">Submit</button>
																</div></td></tr></table>
															</div>
														</form>
														</div>
														</div>
														</div>
														</div>
														<div class="row row-sm">
														<div class="col-lg-12">
															<div class="card custom-card overflow-hidden">
																<div class="card-body">
														            <div class="table-responsive">
															            <table id="example1" class="table table-bordered border-t0 key-buttons text-nowrap w-100" style="font-size:14px">
																            <thead>
																	            <tr>
																		            <th>No</th>
																		            <th>Part No</th>
																		            <th>Part Name</th>
																		            <th>Weight</th>
																					<th>Thick</th>
																		            <th>Image</th>
																		             <th>Customer</th>
																		            <th>Remarks</th>
																		            <th>Tool</th>
																	            </tr>
																            </thead>
																            <tbody>
			                                                                    <?php
			                                                                    $no=0;
			                                                                    $sql=mysqli_query($conn,"select * from mc_part order by id desc limit 5");
			                                                                    while($row=mysqli_fetch_array($sql)) {
			                                                                    $no++;
			                                                                    ?>
			                                                                    <tr>
			                                                                        <td><?=$no;?></td>
			                                                                        <td><?=$row['part_no'];?></td>
			                                                                        <td><?=$row['part_name'];?></td>
			                                                                        <td><?=$row['weight'];?></td>
																					<td><?=$row['thick'];?></td>
			                                                                        <td> <img src="<?= $row['image'];?>" class="img-rounded" height="30px" width="50px" alt="User Image" style="border: 2px solid #666;" /></td>
			                                                                         <td><?=$row['customer'];?></td>
			                                                                         <td><?=$row['remarks'];?></td>
			                                                                         <td></td>
			                                                                     </tr>
			                                                                        <?php } ?>
																            </tbody>
															            </table>
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
			<?php include "footer2.php";?>
