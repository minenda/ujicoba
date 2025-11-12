<?php
include "../conn.php";
include "../func.php";
// storing  request (ie, get/post) global array to a variable  
$requestData= $_REQUEST;
$columns = array( 
// datatable column index  => database column name
	0 => 'id',
	1 => 'part_assy',
	2 => 'assy_name',
	3 => 'weight',
	4 => 'image',
	5 => 'customer',
	6 => 'remarks',
);

// getting total number records without any search
$sql = "SELECT * ";
$sql.=" FROM mc_assy";
$query=mysqli_query($conn, $sql) or die("assyAjax.php: get part_assy");
$totalData = mysqli_num_rows($query);
$totalFiltered = $totalData;  // when there is no search parameter then total number rows = total number filtered rows.


if( !empty($requestData['search']['value']) ) {
	// if there is a search parameter
	$sql = "SELECT *";
	$sql.=" FROM mc_assy";
	$sql.=" WHERE part_assy LIKE '%".$requestData['search']['value']."%' ";
	$sql.=" OR assy_name LIKE '%".$requestData['search']['value']."%' ";
	$sql.=" OR customer LIKE '%".$requestData['search']['value']."%'";
	$query=mysqli_query($conn, $sql) or die("assyAjax.php: get part_assy");
	$totalFiltered = mysqli_num_rows($query); // when there is a search parameter then we have to modify total number filtered rows as per search result without limit in the query 

	$sql.=" ORDER BY ". $columns[$requestData['order'][0]['column']]."   ".$requestData['order'][0]['dir']."   LIMIT ".$requestData['start']." ,".$requestData['length']."   "; // $requestData['order'][0]['column'] contains colmun index, $requestData['order'][0]['dir'] contains order such as asc/desc , $requestData['start'] contains start row number ,$requestData['length'] contains limit length.
	$query=mysqli_query($conn, $sql) or die("assyAjax.php: get part_assy"); // again run query with limit
	
} else {	

	$sql = "SELECT *  ";
	$sql.=" FROM mc_assy";
	$sql.=" ORDER BY ". $columns[$requestData['order'][0]['column']]."   ".$requestData['order'][0]['dir']."   LIMIT ".$requestData['start']." ,".$requestData['length']."   ";
	$query=mysqli_query($conn, $sql) or die("assyAjax.php: get part_assy");   
	
}
$data = array();
$no=0;
while( $row=mysqli_fetch_array($query) ) {  // preparing an array
$no++;
	$nestedData=array(); 
	$nestedData[] = $no;
    $nestedData[] = $row["part_assy"];
	$nestedData[] = $row["assy_name"];
	$nestedData[] = $row["weight"];
	$nestedData[] = '<a href="'.$row['image'].'" target="_blank"><img src="'.$row['image'].'" class="img-rounded" height="45" width="80" alt="User Image" style="border: 2px solid #666;"></a>';
	$nestedData[] = $row["customer"];
	$nestedData[] = $row["remarks"];
   	$nestedData[] = '<td><center>
   	                <a href="?page=CreateBreakdownAssy&id='.$row['id'].'"  data-toggle="Add Breakdown" title="Add Breakdown Assy" class="btn ripple btn-warning"> <i class="fa fa-plus"> </i> </a>
                    <a class="btn ripple btn-primary" data-bs-target="#ModalEdit'.$row['id'].'" data-bs-toggle="modal" href="?page=MasterAssy&id='.$row['id'].'" style="font-size:14px"><i class="fa fa-pencil-alt"></i></a>
				     <a href="?page=deleteAssy&aksi=delete&id='.$row['id'].'"  data-toggle="tooltip" title="Delete" onclick="return confirm(\'Anda yakin akan menghapus data '.$row['part_assy'].'?\')" class="btn ripple btn-danger"> <i class="fa fa-trash"> </i> </a>
				     
	                 </center>
				
				<div class="modal" id="ModalEdit'.$row['id'].'">
                        <div class="modal-dialog modal-lg col-8" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h6 class="modal-title">Update Assy Product</h6><button aria-label="Close" class="btn-close" data-bs-dismiss="modal" type="button">X</button>
                                </div>
									 <form action="?page=MasterAssy&id='.$row['id'].'" name="modal_popup" enctype="multipart/form-data" method="POST">
                                    <div class="modal-body">
                                        <div class="row">
                                            <table class="table text-nowrap text-md-nowrap mg-b-0">
                                                <tr>
                                                        <td rowspan="5" width="300px">
                                                            <div class="pull-right image">
                                                              <img src="' . $row['image'] . '" class="img-rounded" height="100%" width="100%" alt="User Image" style="border: 2px solid #666;" />
                                                            </div>
                                                        </td>
                                                    <td>Part Assy</td>
                                                    <td>:</td>
                                                    <td><input class="form-control" type="text" name="part_assy" style="color:red" value="'.$row['part_assy'].'" readonly></td>
                                                </tr>
                                                <tr>
                                                    <td>Assy Name</td>
                                                    <td>:</td>
                                                    <td><input class="form-control" type="text" name="assy_name" style="color:red" value="'.$row['assy_name'].'"></td>
                                                </tr>
                                                <tr>
                                                    <td>Weight</td>
                                                    <td>:</td>
                                                    <td><input class="form-control" type="number" name="weight" style="color:red" value="'.$row['weight'].'"></td>
                                                </tr>
												<tr>
                                                    <td>Customer</td>
                                                    <td>:</td>
                                                    <td><input class="form-control" type="text" name="customer" style="color:red" value="'.$row['customer'].'" readonly></td>
                                                </tr>
												<tr>
                                                    <td>Remarks</td>
													<td>:</td>
                                                    <td><input class="form-control" type="text" name="remarks" style="color:red" value="'.$row['remarks'].'"></td>
                                                </tr>
                                            </table>
                                        </div>
                                        <tr><td>
										<div class="form-group">
											<label for="nama_file">Update Picture</label>
											<input class="form-control"  id="nama_file" name="nama_file" class="form-control" placeholder="Foto" type="file">
										</div>
										</td></tr>
                                    </div>
                                    <div class="modal-footer justify-content-center">
                                        <button id="update" name="update" class="btn ripple btn-primary" type="submit">Save changes</button>
                                        <button class="btn ripple btn-secondary" data-bs-dismiss="modal" type="button">Close</button>
                                    </div>
                                </form>
							</div>
                        </div>
                    </div>
					
</td>';		
	
	$data[] = $nestedData;
}

$json_data = array(
			"draw"            => intval( $requestData['draw'] ),   // for every request/draw by clientside , they send a number as a parameter, when they recieve a response/data they first check the draw number, so we are sending same number in draw. 
			"recordsTotal"    => intval( $totalData ),  // total number of records
			"recordsFiltered" => intval( $totalFiltered ), // total number of records after searching, if there is no searching then totalFiltered = totalData
			"data"            => $data   // total data array
			);

echo json_encode($json_data);  // send data as json format

?>



