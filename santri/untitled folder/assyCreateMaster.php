            <?php 
                if(isset($_POST['input'])){
//SANGAT PENTING....!!!! JIKA GAGAL UPLOAD KEMUNGKINAN PERMISSION FOLDER HARUS DIUBAH.
//sekretariat@sekretariat-Aspire-E1-410 /var/www/html/app_inv/admin/gbr_inv $ sudo chmod 0777 -R /var/www/html/app_inv/admin
		$id           		= $_POST['id'];
		$part_assy         	= addslashes($_POST['part_assy']);
		$assy_name			= addslashes($_POST['assy_name']);
        $weight	            = $_POST['weight'];
		$customer	        = addslashes($_POST['customer']);
		$remarks            = addslashes($_POST['remarks']);
		$cek=mysqli_num_rows(mysqli_query($conn,"select * from mc_assy where part_assy='$part_assy' and customer='$customer'"));
		if($cek=='0') {
        		$ekstensi_diperbolehkan	= array('png','jpg', 'jpeg', 'gif');
				$nama = $_FILES['nama_file']['name'];
				$gambar='image/'.$nama;
				$x = explode('.', $nama);
				$ekstensi = strtolower(end($x));
				$ukuran	= $_FILES['nama_file']['size'];
				$file_tmp = $_FILES['nama_file']['tmp_name'];	
				if(in_array($ekstensi, $ekstensi_diperbolehkan) === true){
		    	if($ukuran < 5044070){			
				move_uploaded_file($file_tmp, 'image/'.$nama);
				
				$sql="INSERT INTO mc_assy(part_assy,assy_name,weight,customer,remarks,image) VALUES
					('$part_assy','$assy_name','$weight','$customer','$remarks','$gambar')";
				$res=mysqli_query($conn, $sql) or die (mysqli_error());
			
		    }else{
			echo "<script>alert('Ukuran file terlalu besar!'); window.location = '?page=CreateMasterAssy'</script>";
		    }
	       }else{
		$id           		= $_POST['id'];
		$part_assy         	= addslashes($_POST['part_assy']);
		$assy_name			= addslashes($_POST['assy_name']);
        $weight	            = $_POST['weight'];
		$customer	        = addslashes($_POST['customer']);
		$remarks            = addslashes($_POST['customer']);
		$sql="INSERT INTO mc_assy(part_assy,assy_name,weight,customer,remarks,image) VALUES
					('$part_assy','$assy_name','$weight','$customer','$remarks','$gambar')";
				$res=mysqli_query($conn, $sql) or die (mysqli_error());
		
		
	       }
} else { echo "<script>alert('Part Assy dan Customer sudah terdaftar!'); window.location = '?page=CreateMasterAssy'</script>";	 }
    }
?>
			<!-- Main Content-->
			<div class="main-content side-content pt-0">
				<div class="container-fluid">
					<div class="inner-body">
						<!-- Page Header -->
						<div class="page-header">
							<div>
								<h2 class="main-content-title tx-24 mg-b-5">Add Master Assy</h2>
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
													 <form  action="?page=CreateMasterAssy" method="POST" enctype="multipart/form-data" name="form1" id="form1"> 
														<div class="d-sm-flex">
															<div class="parsley-select wd-sm-250" id="slWrapper">
															    <p class="mg-b-10 text-muted">Part No Assy</p>
																<input name="part_assy" id="part_assy"  class="form-control" value="" required/>
																</div>
																<div class="mg-sm-l-10 mg-t-10 mg-sm-t-0">
																<p class="mg-b-10 text-muted">Part Name</p>
																	<input name="assy_name" id="assy_name" class="form-control" type="text" >
																</div>
																<div class="mg-sm-l-10 mg-t-10 mg-sm-t-0">
																<p class="mg-b-10 text-muted">Weight</p>
																	<input name="weight" id="weight" class="form-control" type="number" value=""/>
																</div>
																<div class="mg-sm-l-10 mg-t-10 mg-sm-t-0">
																<p class="mg-b-10 text-muted">Customer</p>
																	<input name="customer" id="customer" class="form-control"type="text"  value=""/>
																</div>
																<div class="mg-sm-l-10 mg-t-10 mg-sm-t-0">
																<p class="mg-b-10 text-muted">Sketch</p>
																	<input name="nama_file" id="nama_file" class="form-control"type="file"  value=""/>
																</div>
																<div class="mg-sm-l-10 mg-t-10 mg-sm-t-0">
																<p class="mg-b-10 text-muted">Remarks</p>
																	<input name="remarks" id="remarks" class="form-control"type="text"  value=""/>
																</div>
																<div class="mg-sm-l-10 mg-t-10 mg-sm-t-0">
																<p class="mg-b-10 text-muted"></p><br>
																	<button class="btn ripple btn-primary pd-x-20" name="input" type="submit">Input</button>
																</div>
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
			                                                                    <?php
			                                                                    $no=0;
			                                                                    $sql=mysqli_query($conn,"select * from mc_assy order by id desc limit 5");
			                                                                    while($row=mysqli_fetch_array($sql)) {
			                                                                    $no++;
			                                                                    ?>
			                                                                    <tr>
			                                                                        <td><?=$no;?></td>
			                                                                        <td><?=$row['part_assy'];?></td>
			                                                                        <td><?=$row['assy_name'];?></td>
			                                                                        <td><?=$row['weight'];?></td>
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
			<?php include "footer.php";?>
