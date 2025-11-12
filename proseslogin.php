<?php
include 'conn.php';
date_default_timezone_set('Asia/Jakarta');
session_start();

if(isset($_POST['login'])){
$no_hp = mysqli_real_escape_string($conn, $_POST['no_hp']);
$pass = mysqli_real_escape_string($conn, $_POST['pass']);

$cek = mysqli_query($conn,"select * from tbl_pendaftar where no_hp = '$no_hp'");
$hitung = mysqli_num_rows($cek);
$data = mysqli_fetch_array($cek);
$passnow = $data['passhash'];
echo $pass. " - ".$passnow;
if($hitung == 1){
if(password_verify($pass,$passnow)){
	// cek jika user login sebagai admin
	
	$_SESSION['id'] = $data['id'];
	$_SESSION['id_daftar'] = $data['id_daftar'];
	$_SESSION['nama'] = $data['nama'];
	//header('location:admin/?page=Home');
	header('location:user/?page=Home');
		
	// cek jika user slogin sebagai pegawai
	}else{
//Jika salah
echo '
<script>
alert("Login Gagal");
window.location.href="login.php";
</script>
';
	}

	}else {
//Jika salah
echo '
<script>
alert("tidak ditemukan");
window.location.href="login.php";
</script>
';
}
	
} else {
//Jika salah
echo '
<script>
alert("gagal awal");
window.location.href="login.php";
</script>
';
}
?>
