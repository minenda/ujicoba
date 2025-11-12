
			<!-- Main Content-->
			<div class="main-content side-content pt-0">
				<div class="container-fluid">
					<div class="inner-body">
						<!-- Page Header -->
						<div class="page-header">
							<div>
								<h2 class="main-content-title tx-24 mg-b-5">Assy Breakdown</h2>
								<ol class="breadcrumb">
									<li class="breadcrumb-item"><a href="?page=Home">Home</a></li>
									<li class="breadcrumb-item active" aria-current="page">Assy Breakdown</li>
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
													 <form action="?page=BreakdownAssy" method="post" name="form1" id="form1">
													 <div class="d-sm-flex">	
														<div class="mg-sm-l-10 mg-t-10 mg-sm-t-0">
															<p class="mg-b-10 text-muted"></p>
															<select name="assy" id="assy" class="form-control select select2" type="text"/>
															<option><?php if(isset($_POST['assy'])){ echo $_POST['assy'];} else { echo '--  Select Assy Number  --';}?></option>
															<?php 
															$sql=mysqli_query($conn,"select * from mc_assy order by part_assy ASC LIMIT 10");
															while($row=mysqli_fetch_array($sql)) {?>
																<option value="<?=$row['part_assy'].' '.$row['customer'];?>"><?=$row['part_assy'].' - '.$row['customer'];?></option>
															<?php }?>
															</select>
															
														</div>
														<div class="mg-sm-l-10 mg-t-10 mg-sm-t-0">
															<p class="mg-b-10 text-muted"></p>
															<input type="number" id="qty" name="qty" class="form-control" value="<?=$_POST['qty'];?>">
														</div>
														<div class="mg-sm-l-10 mg-t-10 mg-sm-t-0">
															<p class="mg-b-10 text-muted"></p>
															<button class="btn btn-success"type="submit" name="submit"/>Select</button>
														</div>
													 </div><br>
													 </form>
													 <?php
													 if(isset($_POST['submit'])){  
													 $string = $_POST['assy']; 
													 $qty_suply   = $_POST['qty'];
													 $part_assy = explode(' ',$string,2)[0];
													 $customer = explode(' ',$string,2)[1];
													 ?>
														<table id="example1" class="table table-bordered border-t0 key-buttons text-nowrap w-100" style="font-size:14px">
															<thead>
																<tr>
																	<th>No</th>
																	<th>Part No</th>
																	<th>Qty/Unit</th>
																	<th>Qty Suply</th>
																	<th>Weight</th>
																	<th>Thick</th>
																	<th>Spec</th>
																	<th>Image</th>
																	<th>Remarks</th>
																	<th>Tool</th>
																</tr>
															</thead>
															<tbody>
																<?php
																$no=0;
																$sql=mysqli_query($conn,"select mc_part.*, mc_part_assy.*  from mc_part_assy left join mc_part on mc_part.part_no = mc_part_assy.part_number where mc_part_assy.assy_number = '$part_assy' and mc_part_assy.customer = '$customer' order by part_number ASC");
																while($row=mysqli_fetch_array($sql)) {
																$no++;
																?>
																<tr>
																	<td><?=$no;?></td>
																	<td><?=$row['part_no'];?></td>
																	<td><?=$row['qty_unit'];?></td>
																	<td><?=intval($row['qty_unit'])*$qty_suply;?></td>
																	<td><?=$row['weight'];?></td>
																	<td><?=$row['thick'];?></td>
																	<td><?=$row['mat'];?></td>
																	<td> <img src="<?= $row['image'];?>" class="img-rounded" height="30px" width="50px" alt="User Image" style="border: 2px solid #666;" /></td>
																	 <td><?=$row['remarks'];?></td>
																	 <td></td>
																 </tr>
																	<?php } ?>
															</tbody>
														</table>
														<a href="assy_pdf.php?assy=<?=$part_assy;?>&customer=<?=$customer;?>&qty=<?=$qty_suply;?>" target="_blank" class="btn btn-warning">Print PDF</a>&nbsp;<a href="export_excel.php?assy=<?=$part_assy;?>&customer=<?=$customer;?>&qty=<?=$qty_suply;?>" target="_blank" class="btn btn-warning">Export Excel</a>
													 <?php } else { echo "Select Assy First";}?>
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
			<script src="../assets/plugins/jquery/jquery.min.js"></script>
		<?php include "footer.php";?>	
		<script src="../assets/js/form-layouts.js"></script>
