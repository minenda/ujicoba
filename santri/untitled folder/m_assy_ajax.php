<?php
include "../conn.php";

// storing  request (ie, get/post) global array to a variable  
$requestData= $_REQUEST;


$columns = array( 
// datatable column index  => database column name
	0 => 'id',
    1 => 'part_assy', 
	2 => 'assy_name',
	3 => 'weight',
	4 => 'customer',
	5 => 'image',
	6 => 'remarks'
);

// getting total number records without any search
$sql = "SELECT * ";
$sql.=" FROM mc_assy";
$query=mysqli_query($conn, $sql) or die("m_assy_ajax.php: get part_assy");
$totalData = mysqli_num_rows($query);
$totalFiltered = $totalData;  // when there is no search parameter then total number rows = total number filtered rows.


if( !empty($requestData['search']['value']) ) {
	// if there is a search parameter
	$sql = "SELECT * ";
	$sql.=" FROM mc_assy";  // $requestData['search']['value'] contains search parameter
	$sql.=" WHERE part_assy LIKE '%".$requestData['search']['value']."%' ";
	$sql.=" OR assy_name LIKE '%".$requestData['search']['value']."%' ";
	$sql.=" OR weight LIKE '%".$requestData['search']['value']."%' ";
	$sql.=" OR customer LIKE '%".$requestData['search']['value']."%' ";
	$sql.=" OR remarks LIKE '%".$requestData['search']['value']."%' ";
	$query=mysqli_query($conn, $sql) or die("m_assy_ajax.php: get part_assy");
	$totalFiltered = mysqli_num_rows($query); // when there is a search parameter then we have to modify total number filtered rows as per search result without limit in the query 

	$sql.=" ORDER BY ". $columns[$requestData['order'][0]['column']]."   ".$requestData['order'][0]['dir']."   LIMIT ".$requestData['start']." ,".$requestData['length']."   "; // $requestData['order'][0]['column'] contains colmun index, $requestData['order'][0]['dir'] contains order such as asc/desc , $requestData['start'] contains start row number ,$requestData['length'] contains limit length.
	$query=mysqli_query($conn, $sql) or die("ajax-data-barang.php: get barang"); // again run query with limit
	
} else {	
$no=0;
	$sql = "SELECT * ";
	$sql.=" FROM mc_assy";
	$sql.=" ORDER BY ". $columns[$requestData['order'][0]['column']]."   ".$requestData['order'][0]['dir']."   LIMIT ".$requestData['start']." ,".$requestData['length']."   ";
	$query=mysqli_query($conn, $sql) or die("ajax-data-barang.php: get barang");   
	
}

$data = array();
while( $row=mysqli_fetch_array($query) ) {  // preparing an array
$no++;
	$nestedData=array(); 
	$nestedData[] = $no;
    $nestedData[] = $row["part_assy"];
	$nestedData[] = $row["assy_name"];
	$nestedData[] = $row["weight"];
	$nestedData[] = '<a href="'.$row['image'].'" target="_blank"><img src="'.$row['image'].'" class="img-rounded" height="50" width="60" alt="User Image" style="border: 2px solid #666;"></a>';
	$nestedData[] = $row["customer"];
	$nestedData[] = $row["remarks"];
    $nestedData[] = '<td><center>
					<a href="m_assy_bd.php?id='.$row['part_assy'].'"  data-toggle="tooltip" title="Breakdown Assy" class="btn btn-sm btn-warning"> <i class="glyphicon glyphicon-plus"></i> </a>
                     <a href="m_assy_edit.php?id='.$row['id'].'"  data-toggle="tooltip" title="Edit" class="btn btn-sm btn-info"> <i class="glyphicon glyphicon-edit"></i> </a>
				     <a href="m_assy.php?aksi=delete&id='.$row['id'].'"  data-toggle="tooltip" title="Delete" onclick="return confirm(\'Anda yakin akan menghapus data '.$row['part_assy'].'?\')" class="btn btn-sm btn-danger"> <i class="glyphicon glyphicon-trash"> </i> </a>
	                 </center></td>';		
	
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
