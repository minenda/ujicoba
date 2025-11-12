<?php
    include '../conn.php';
		$id=$_GET['id'];
	    $data=mysqli_fetch_array(mysqli_query($conn,"select * from mc_assy where id='$id'"));
	    $part_assy = $data['part_assy'];
	    $assy_name = $data['assy_name'];
	    $weight    = $data['weight'];
	    $customer  = $data['customer'];
		if(isset($_POST['input'])) {
		$assy_no		= $_POST['assy_no'];
        $assy_name  	= $_POST['assy_name'];
		$customer   	= $_POST['customer'];
		$part_no  		= $_POST['part_no'];
		$qty	  		= $_POST['qty'];
        $remarks    	= $_POST['remarks'];
        $cek = mysqli_num_rows(mysqli_query($conn,"select * from mc_part_assy where assy_number='$assy_no' and part_number='$part_no' and customer='$customer'"));
        if($cek == '0') {
        $sql=mysqli_query($conn,"insert into mc_part_assy (assy_number, qty_unit, part_number, assy_name, customer, remarks) values ('$assy_no', '$qty', '$part_no', '$assy_name', '$customer', '$remarks')");
        }
       }
       elseif(isset($_POST['update'])){
       $qty = $_POST['qty_unit'];
       $id_child = $_POST['id_child'];
       $remarks = $_POST['remarks'];
       $upd = mysqli_query($conn,"update mc_part_assy set qty_unit = '$qty', remarks='$remarks' where id = '$id_child'");
       }
       if(isset($_GET['aksi'])=='delete'){
       $idel = $_GET['idel'];
       $delete = mysqli_query($conn,"delete from mc_part_assy where id = '$idel'");
       }
		?>
			<!-- Main Content-->
			<div class="main-content side-content pt-0">
				<div class="container-fluid">
					<div class="inner-body">
						<!-- Page Header -->
						<div class="page-header">
							<div>
								<h2 class="main-content-title tx-24 mg-b-5">Add Breakdown <?=$part_assy;?> - <?=$assy_name;?> - <?=$customer;?></h2>
								<ol class="breadcrumb">
									<li class="breadcrumb-item"><a href="?page=Home">Home</a></li>
									<li class="breadcrumb-item active" aria-current="page">Breakdown Assy </li>
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
									        $("#part_no").autocomplete({
														        source: 'auto_sf.php'
													        });
												        });
									        </script>
											<div class="card-body ps-0">
												<div class="">
													<div class="container-fluid">
													 <!--Content start-->
													 <form  action="?page=CreateBreakdownAssy&id=<?=$id;?>" method="POST" enctype="multipart/form-data" name="form1" id="form1"> 
														<div class="d-sm-flex">
															<div class="parsley-select wd-sm-250" id="slWrapper">
															    <input type="hidden" name="assy_no" id="assy_no"  class="form-control" value="<?=$part_assy;?>" required/>
															    <input type="hidden" name="assy_name" id="assy_name"  class="form-control" value="<?=$assy_name;?>" required/>
															    <input type="hidden" name="customer" id="customer"  class="form-control" value="<?=$customer;?>" required/>
															    <p class="mg-b-10 text-muted">Part No</p>
																	<input tabindex="1" name="part_no" id="part_no"  class="form-control" value="" type="text" required/>
																</div>
																<div class="mg-sm-l-10 mg-t-10 mg-sm-t-0">
																<p class="mg-b-10 text-muted">Qty/Unit</p>
																	<input tabindex="2"name="qty" id="qty" class="form-control" type="text" required>
																</div>
																<div class="mg-sm-l-10 mg-t-10 mg-sm-t-0">
																<p class="mg-b-10 text-muted">Remarks</p>
																	<input tabindex="3" name="remarks" id="remarks" class="form-control"type="text"  value=""/>
																</div>
																<div class="mg-sm-l-10 mg-t-10 mg-sm-t-0">
																<p class="mg-b-10 text-muted"></p><br>
																	<button tabindex="4" class="btn ripple btn-primary pd-x-20" name="input" type="submit">Input</button>
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
																            <thead class="bg-primary">
									                                            <th>No</th>
									                                            <th>Part No</th>
									                                            <th>Part Name</th>
									                                            <th>Qty/Unit</th>
									                                            <th>Weight</th>
									                                            <th>Thick</th>
									                                            <th>Spec</th>
									                                            <th>Image</th>
									                                            <th>Remarks</th>
									                                            <th>Action</th>
								                                            </thead>
																            <tbody>
			                    <?php
								$no=0;
								$a=mysqli_query($conn,"select mc_part_assy.id as ids, mc_part_assy.remarks as ket, mc_part_assy.*, mc_part.* from mc_part_assy left join mc_part on mc_part_assy.part_number = mc_part.part_no where mc_part_assy.assy_number='$part_assy' and mc_part_assy.customer = '$customer'");
								while($aa=mysqli_fetch_array($a)) { $no++; ?>
									<tr>
										<td><?=$no;?></td>
										<td><?=$aa['part_number'];?></td>
										<td><?=$aa['part_name'];?></td>
										<td><?=$aa['qty_unit'];?></td>
										<td><?=$aa['weight'];?></td>
										<td><?=$aa['thick'];?></td>
										<td><?=$aa['spec'];?></td>
										<td><img src="<?=$aa['image'];?>" class="img-rounded" height="50" width="60"></td>
										<td><?=$aa['ket'];?></td>
										<td><center>
										 <a class="btn ripple btn-primary" data-bs-target="#edit<?=$aa['ids'];?>" data-bs-toggle="modal" href="" style="font-size:14px"><i class="ti ti-pencil-alt"></i></a>
				     <a href="?page=CreateBreakdownAssy&aksi=delete&idel=<?=$aa['ids'];?>&id=<?=$id; ?>"  data-toggle="tooltip" title="Delete" onclick="return confirm(\'Anda yakin akan menghapus data penting '<?=$aa['part_number'];?>'?\')" class="btn ripple btn-danger"> <i class="ti ti-trash"></i> </a></center>
<!-- MODAL-->

    <div id="edit<?=$aa['ids'];?>" class="modal fade" role="dialog">
		 <div class="modal-dialog modal-lg">
			<!-- konten modal-->
			<div class="modal-content">
				<!-- heading modal -->
				<div class="modal-header bg-success">
				<h4 class="modal-title">Update Qty/Unit</h4>
					<button type="button" class="close" data-dismiss="modal">x</button>
					
				</div>
				<!-- body modal -->
				<div class="modal-body">
					 <form class="form-horizontal style-form" action="?page=CreateBreakdownAssy&id=<?=$id;?>" method="post" enctype="multipart/form-data" name="form1" id="form1">
					<div class="form-group row">
                      <label class="col-sm-2 control-label">Qty</label>
                     	 <div class="col-sm-4">
                     	    <input name="id_child" id="id_child" class="form-control" type="hidden" value="<?php echo $aa['ids'];?>">
							<input name="qty_unit" id="qty_unit" class="form-control" type="number" value="<?php echo $aa['qty_unit'];?>">
						</div>
					</div>
				    <div class="form-group row">
                      <label class="col-sm-2 control-label">Remarks</label>
                     	 <div class="col-sm-4">
							<input name="remarks" id="remarks" class="form-control" type="text" value="<?php echo $aa['ket'];?>">
						</div>
					</div>
				<!-- footer modal -->
				<div class="modal-footer">
					 <button type="submit" name="update" class="btn btn-info">Submit</button>&nbsp;<button class="btn ripple btn-secondary" data-bs-dismiss="modal" type="button">Close</button>
				</div>
			</form>
		</div>
		</div>
		</div>
		</td>
									</tr><!-- /.End Modal -->

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
		<script type="text/javascript">
            function isi_otomatis(){
                var keterangan = $("#keterangan").val();
                $.ajax({
                    url: 'autofillket.php',
                    data:"keterangan="+keterangan ,
                }).success(function (data) {
                    var json = data,
                    obj = JSON.parse(json);
					$('#kd_keu').val(obj.kd_keu);
                    $('#jumlah').val(obj.jumlah2);
					$('#blth').val(obj.blth);
					$('#kdcari').val(obj.kdcari);
					$('#id_santri').val(obj.id_santri);
                });
            }
        </script>
