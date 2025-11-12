<?php
include "../conn.php"; //Include file koneksi
//$kd_kredit=$_GET['kd_kredit'];
$searchTerm = $_GET['term']; // Menerima kiriman data dari inputan pengguna
$sql="SELECT * FROM mc_part WHERE part_no LIKE '%".$searchTerm."%' ORDER BY part_no ASC LIMIT 10"; // query sql untuk 
$hasil=mysqli_query($conn,$sql); //Query dieksekusi

//Disajikan dengan menggunakan perulangan
while ($row = mysqli_fetch_array($hasil)) {
    $data[] =$row['part_no'];
}
//Nilainya disimpan dalam bentuk json
echo json_encode($data);
?>

