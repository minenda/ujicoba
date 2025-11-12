
			<!-- Main Content-->
			<div class="main-content side-content pt-0">
				<div class="container-fluid">
					<div class="inner-body">
						<!-- Page Header -->
						<div class="page-header">
							<div>
								<h2 class="main-content-title tx-24 mg-b-5">Product By Customer</h2>
								<ol class="breadcrumb">
									<li class="breadcrumb-item"><a href="?page=Home">Home</a></li>
									<li class="breadcrumb-item active" aria-current="page">Product List</li>
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
													 <form action="?page=ProductByCustomer" method="post" name="form1" id="form1">
													 <div class="d-sm-flex">	
														<div class="mg-sm-l-10 mg-t-10 mg-sm-t-0">
															<p class="mg-b-10 text-muted"></p>
															<select name="customer" id="customer" class="form-control select select2" type="text"/>
															<option><?php if(isset($_POST['customer'])){ echo $_POST['customer'];} else { echo '--  Select Customer  --';}?></option>
															<?php 
															$sql=mysqli_query($conn,"select id_customer, name_customer from mc_customer order by name_customer ASC LIMIT 10");
															while($row=mysqli_fetch_array($sql)) {?>
																<option value="<?=$row['name_customer'];?>"><?=$row['name_customer'];?></option>
															<?php }?>
															</select>
														</div>
														<div class="mg-sm-l-10 mg-t-10 mg-sm-t-0">
															<p class="mg-b-10 text-muted"></p>
															<button class="btn btn-success"type="submit" name="submit"/>Select</button>
														</div>
													 </div><br>
													 </form>
													 <?php
													 if(isset($_POST['submit'])){  
													 $cust = $_POST['customer']; ?>
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
																$sql=mysqli_query($conn,"select * from mc_part where customer='$cust' order by part_no ASC");
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
													 <?php } else { echo "Select Customer First";}?>
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
		<script>
        $(document).ready(function() {
				var dataTable = $('#lookup').DataTable( {
					"processing": true,
					"serverSide": true,
					"ajax":{
						url :"prodbycustAjax.php", // json datasource
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