
			<!-- Main Content-->
	<!DOCTYPE html>
	<html lang="en">
	<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<style>
	th, td {
	border: 1px solid #0e0101;
	}
	</style>		
<table id="lookup" border="1" style="font-size:12px">
	<thead>
		<tr>
			<th>No</th>
			<th>Part No</th>
			<th>Part Name</th>
			<th>Image</th>
			<th>Thick</th>
			<th>Weight</th>
			<th>Length</th>
			<th>Wide</th>
			<th>Spec</th>
			<th>Customer</th>
			<th>Remarks</th>
		</tr>
	</thead>
	<tbody>
	   <?php
	   include '../conn.php';
	   $no=0;
	   $sql=mysqli_query($conn,"select * from mc_part order by part_no ASC");
	   while($r=mysqli_fetch_array($sql)) { $no++; ?>
	   <tr>
	   <td><?=$no;?></td>
	   <td><?=$r['part_no']?></td>
	   <td><?=$r['part_name']?></td>
	   <td><a href="'.$row['image'].'" target="_blank"><img src="<?=$r['image']?>" class="img-rounded" height="45" width="50" alt="User Image" style="border: 2px solid #666;"></a></td>
	   <td><?=$r['thick']?></td>
	   <td><?=$r['weight']?></td>
	   <td><?=$r['length']?></td>
	   <td><?=$r['wide']?></td>
	   <td><?=$r['mat']?></td>
	   <td><?=$r['customer']?></td>
	   <td></td>
	   </tr>
	   <?php } ?>
	</tbody>
</table>
</html>
