<?php
include "../conn.php";
include "../func.php";
// storing  request (ie, get/post) global array to a variable  
$requestData= $_REQUEST;
$columns = array( 
// datatable column index  => database column name
	0 => 'id',
	1 => 'id_customer',
	2 => 'name_customer',
	3 => 'country',
	4 => 'remarks',
);

// getting total number records without any search
$sql = "SELECT * ";
$sql.=" FROM mc_customer";
$query=mysqli_query($conn, $sql) or die("custAjax.php: get id_customer");
$totalData = mysqli_num_rows($query);
$totalFiltered = $totalData;  // when there is no search parameter then total number rows = total number filtered rows.


if( !empty($requestData['search']['value']) ) {
	// if there is a search parameter
	$sql = "SELECT *";
	$sql.=" FROM mc_customer";
	$sql.=" WHERE id_customer LIKE '%".$requestData['search']['value']."%' ";
	$sql.=" OR name_customer LIKE '%".$requestData['search']['value']."%' ";
	$sql.=" OR country LIKE '%".$requestData['search']['value']."%'";
	$query=mysqli_query($conn, $sql) or die("custAjax.php: get id_customer");
	$totalFiltered = mysqli_num_rows($query); // when there is a search parameter then we have to modify total number filtered rows as per search result without limit in the query 

	$sql.=" ORDER BY ". $columns[$requestData['order'][0]['column']]."   ".$requestData['order'][0]['dir']."   LIMIT ".$requestData['start']." ,".$requestData['length']."   "; // $requestData['order'][0]['column'] contains colmun index, $requestData['order'][0]['dir'] contains order such as asc/desc , $requestData['start'] contains start row number ,$requestData['length'] contains limit length.
	$query=mysqli_query($conn, $sql) or die("custAjax.php: get id_customer"); // again run query with limit
	
} else {	

	$sql = "SELECT *  ";
	$sql.=" FROM mc_customer";
	$sql.=" ORDER BY ". $columns[$requestData['order'][0]['column']]."   ".$requestData['order'][0]['dir']."   LIMIT ".$requestData['start']." ,".$requestData['length']."   ";
	$query=mysqli_query($conn, $sql) or die("custAjax.php: get id_customer");   
	
}
$data = array();
$no=0;
while( $row=mysqli_fetch_array($query) ) {  // preparing an array
$no++;
	$nestedData=array(); 
	$nestedData[] = $no;
    $nestedData[] = $row["id_customer"];
	$nestedData[] = $row["name_customer"];
	$nestedData[] = $row["country"];
	$nestedData[] = $row["remarks"];
   	$nestedData[] = '<td><center>
                    <a class="btn ripple btn-primary" data-bs-target="#ModalEdit'.$row['id'].'" data-bs-toggle="modal" href="?page=MasterAssy&id='.$row['id'].'" style="font-size:14px"><i class="fa fa-pencil-alt"></i></a>
				     <a href="?page=CustomerList&aksi=delete&id='.$row['id'].'"  data-toggle="tooltip" title="Delete" onclick="return confirm(\'Anda yakin akan menghapus data '.$row['part_assy'].'?\')" class="btn ripple btn-danger"> <i class="fa fa-trash"> </i> </a>
				     
	                 </center>
				
				<div class="modal" id="ModalEdit'.$row['id'].'">
                        <div class="modal-dialog modal-lg col-8" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h6 class="modal-title">Update Customer Name</h6><button aria-label="Close" class="btn-close" data-bs-dismiss="modal" type="button">X</button>
                                </div>
									 <form action="?page=CustomerList&id='.$row['id'].'" name="modal_popup" enctype="multipart/form-data" method="POST">
                                    <div class="modal-body">
                                        <div class="row">
                                            <table class="table text-nowrap text-md-nowrap mg-b-0">
                                                <tr>
                                                    <td>ID Customer</td>
                                                    <td>:</td>
                                                    <td><input class="form-control" type="text" name="id_customer" style="color:red" value="'.$row['id_customer'].'" readonly></td>
                                                </tr>
                                                <tr>
                                                    <td>Customer Name</td>
                                                    <td>:</td>
                                                    <td><input class="form-control" type="text" name="name_customer" style="color:red" value="'.$row['name_customer'].'"></td>
                                                </tr>
												<tr>
                                                    <td>Country</td>
                                                    <td>:</td>
                                                    <td><input class="form-control" type="text" name="country" style="color:red" value="'.$row['country'].'" readonly></td>
                                                </tr>
                                            </table>
                                        </div>
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



