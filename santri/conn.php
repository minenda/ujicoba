<?php
//fungsi format rupiah 
/**function format_rupiah($rp) {
	$hasil = "Rp." . number_format($rp, 0, "", ".") . ",00";
	return $hasil;
    }
    **/

$db_host = "localhost";
$db_user = "root";
$db_pass = "minenda";
$db_name = "db_ponpes";
$conn = mysqli_connect($db_host, $db_user, $db_pass, $db_name);
//$koneksi = mysqli_connect("localhost","root","minenda","db_akuntansi");


if(mysqli_connect_errno()){
	echo 'Gagal melakukan koneksi ke Database : '.mysqli_connect_error();
}   


if($aa==1) {$bulan='Januari';}
elseif($aa==2) {$bulan='Februari';}
elseif($aa==3) {$bulan='Maret';}
elseif($aa==4) {$bulan='April';}
elseif($aa==5) {$bulan='Mei';}
elseif($aa==6) {$bulan='Juni';}
elseif($aa==7) {$bulan='Juli';}
elseif($aa==8) {$bulan='Agustus';}
elseif($aa==9) {$bulan='September';}
elseif($aa==10) {$bulan='Oktober';}
elseif($aa==11) {$bulan='November';}
elseif($aa==12) {$bulan='Desember';}


?>


