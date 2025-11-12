			

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<style>
table {
	border-collapse: collapse;
	width=120%;
}
th, td {
	border: 1px solid #000000;
	text-align: left;
	padding: 8px;
}
th {
	background-color: #f2f2f2;
}

</style>
<?php
$part_assy=$_GET['assy'];
$customer=$_GET['customer'];
$qty_suply=$_GET['qty'];
?>
</head>
<p><h3><b>PT KATSUSHIRO INDONESIA</b></h3></p>
<p><h4><b>PPIC Section</b></h4></p>
<p><h3><b>CONTROL SUPPLY ASSY <?=$part_assy;?> <?=$customer;?><br><?=date('d F Y');?></b></h3></p>
<?php include '../conn.php';?>
<table id="example1" class="table table-bordered border-t0 key-buttons text-nowrap w-100" style="font-size:14px">
	<thead>
		<tr>
			<th>No</th>
			<th>Part No</th>
			<th>Qty/Unit</th>
			<th>Weight</th>
			<th>Thick</th>
			<th>Spec</th>
			<th>Image</th>
			<th>Qty Suply</th>
			<th>Remarks</th>
			
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
			<td><center><?=$row['qty_unit'];?></center></td>
			<td><center><?=$row['weight'];?></center></td>
			<td><center><?=$row['thick'];?></center></td>
			<td><center><?=$row['mat'];?></center></td>
			<td><center> <img src="<?= $row['image'];?>" class="img-rounded" height="30px" width="50px" alt="User Image" style="border: 2px solid #666;" /></center></td>
			 <td><center><?=intval($row['qty_unit'])*$qty_suply;?></center></td>
			 <td><?=$row['remarks'];?></td>
			 
		 </tr>
			<?php } ?>
	</tbody>
</table>
<br><br>
<table id="example1" class="table table-bordered border-t0 key-buttons text-nowrap w-100" style="font-size:14px">
                <tr>
				
                  <td  width="100" align="center"><b><center>Approved</center></b></td>  
                  <td  width="100" align="center"><b><center>Checked</center></b></td>  
                  <td  width="100" align="center"><b><center>Prepared</center></b></td>  
                </tr>
                <tr>
					
                  <td  width="100" align="center"><b><br /><br /><br /></b></td>  
                  <td  width="100" align="center"><b><br /><br /><br /></b></td>  
                  <td  width="100" align="center"><b><br /><br /><br /></b></td>  
                </tr>
<tr>
				
                  <td  width="100" align="center"><b></b></td>  
                  <td  width="100" align="center"><b></b></td>  
                  <td  width="100" align="center"><b>_</b></td>  
                </tr>
            </table>
<script>
window.print();
</script>
</html>
