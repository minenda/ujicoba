<?php
function format_wa($hp)
{
	if (substr($hp, 0, 1) == '0') {
		$telpone = "62" . substr($hp, 1, 12);
	} elseif (substr($hp, 0, 1) == '+') {
		$telpone = substr($hp, 1, 12);
	} elseif (substr($hp, 0, 1) == '8') {
		$telpone = "62" . $hp;
	} else {
		$telpone = $hp;
	}
	return $telpone;
}


function prodine($prodi)
{
	global $prd;
	if ($prodi == "1") {
		$prd = "IPK";
	} elseif ($prodi == "2") {
		$prd = "MTW";
	} elseif ($prodi == "3") {
		$prd = "IL";
	} elseif ($prodi == "4") {
		$prd = "TSN";
	} elseif ($prodi == "5") {
		$prd = "PGD";
	} elseif ($prodi == "6") {
		$prd = "CUTI";
	} elseif ($prodi == "7") {
		$prd = "MA";
	} elseif ($prodi == "8") {
		$prd = "KELUAR";
	} elseif ($prodi == "9") {
		$prd = "LULUS";
	}
	return $prd;
}


function kelase($id_kelas)
{
	global $prd;
	$prodi = substr($id_kelas, 0, 1);

	if ($prodi == "1") {
		$prd = "IPK - " . substr($id_kelas, 1, 2) . ' (' . substr($id_kelas, 3, 1) . ')';
	} elseif ($prodi == "2") {
		$prd = "MTW - " . substr($id_kelas, 1, 2) . ' (' . substr($id_kelas, 3, 1) . ')';
	} elseif ($prodi == "3") {
		$prd = "IL - " . substr($id_kelas, 1, 2) . ' (' . substr($id_kelas, 3, 1) . ')';
	} elseif ($prodi == "4") {
		$prd = "TSN - " . substr($id_kelas, 1, 2) . ' (' . substr($id_kelas, 3, 1) . ')';
	} elseif ($prodi == "5") {
		$prd = "PGD " . '(' . substr($id_kelas, 3, 1) . ')';
	} elseif ($prodi == "6") {
		$prd = "CUTI " . '(' . substr($id_kelas, 3, 1) . ')';
	} elseif ($prodi == "7") {
		$prd = "MA - " . substr($id_kelas, 1, 2) . ' (' . substr($id_kelas, 3, 1) . ')';
	} elseif ($prodi == "8") {
		$prd = "KELUAR";
	} elseif ($prodi == "9") {
		$prd = "LULUS";
	} elseif ($prodi == "") {
		$prd = "";
	}
	return $prd;
}

//fungsi format rupiah 
function format_rupiah($rp)
{
	$hasil = "Rp." . number_format($rp, 0, "", ".") . ",00";
	return $hasil;
}

function tgl_indo($tgl)
{
	$pc_satu	= explode(" ", $tgl);
	if (count($pc_satu) < 2) {
		$tgl1		= $pc_satu[0];
		$jam1		= "";
	} else {
		$jam1		= $pc_satu[1];
		$tgl1		= $pc_satu[0];
	}

	$pc_dua		= explode("-", $tgl1);
	$tgl		= $pc_dua[2];
	$bln		= $pc_dua[1];
	$thn		= $pc_dua[0];


	if ($bln == "01") {
		$bln_txt = "Jan";
	} else if ($bln == "02") {
		$bln_txt = "Feb";
	} else if ($bln == "03") {
		$bln_txt = "Mar";
	} else if ($bln == "04") {
		$bln_txt = "Apr";
	} else if ($bln == "05") {
		$bln_txt = "Mei";
	} else if ($bln == "06") {
		$bln_txt = "Jun";
	} else if ($bln == "07") {
		$bln_txt = "Jul";
	} else if ($bln == "08") {
		$bln_txt = "Ags";
	} else if ($bln == "09") {
		$bln_txt = "Sep";
	} else if ($bln == "10") {
		$bln_txt = "Okt";
	} else if ($bln == "11") {
		$bln_txt = "Nov";
	} else if ($bln == "12") {
		$bln_txt = "Des";
	} else {
		$bln_txt = "";
	}

	return $tgl . " " . $bln_txt . " " . $thn . "  " . $jam1;
}

function randomPassword()
{

	$digit = 6;
	$karakter = "ABCDEFGHJKLMNPQRSTUVWXYZ23456789";

	srand((float)microtime() * 1000000);
	$i = 0;
	$pass = "";
	while ($i <= $digit - 1) {
		$num = rand() % 32;
		$tmp = substr($karakter, $num, 1);
		$pass = $pass . $tmp;
		$i++;
	}
	return $pass;
}


function hitung_umur($tanggal_lahir)
{
	$birthDate = new DateTime($tanggal_lahir);
	$today = new DateTime("today");
	if ($birthDate > $today) {
		return "0";
	}
	$y = $today->diff($birthDate)->y;
	$m = $today->diff($birthDate)->m;
	$d = $today->diff($birthDate)->d;
	return $y . " th " . $m . " bl";
}

function hitung_umur_vaksin($tanggal_lahir)
{
	$birthDate = new DateTime($tanggal_lahir);
	$today = new DateTime("today");
	if ($birthDate > $today) {
		return "0";
	}
	$y = $today->diff($birthDate)->y;
	$m = $today->diff($birthDate)->m;
	$d = $today->diff($birthDate)->d;
	return $y . " th " . $m . " bl";
}

function bln_indo($blne)
{
	$bulan = array(
		1 =>   'Januari',
		'Februari',
		'Maret',
		'April',
		'Mei',
		'Juni',
		'Juli',
		'Agustus',
		'September',
		'Oktober',
		'November',
		'Desember'
	);

	return  $bulan[(int)$blne];
}

function penyebut($nilai)
{
	$nilai = abs($nilai);
	$huruf = array("", "satu", "dua", "tiga", "empat", "lima", "enam", "tujuh", "delapan", "sembilan", "sepuluh", "sebelas");
	$temp = "";
	if ($nilai < 12) {
		$temp = " " . $huruf[$nilai];
	} else if ($nilai < 20) {
		$temp = penyebut($nilai - 10) . " belas";
	} else if ($nilai < 100) {
		$temp = penyebut($nilai / 10) . " puluh" . penyebut($nilai % 10);
	} else if ($nilai < 200) {
		$temp = " seratus" . penyebut($nilai - 100);
	} else if ($nilai < 1000) {
		$temp = penyebut($nilai / 100) . " ratus" . penyebut($nilai % 100);
	} else if ($nilai < 2000) {
		$temp = " seribu" . penyebut($nilai - 1000);
	} else if ($nilai < 1000000) {
		$temp = penyebut($nilai / 1000) . " ribu" . penyebut($nilai % 1000);
	} else if ($nilai < 1000000000) {
		$temp = penyebut($nilai / 1000000) . " juta" . penyebut($nilai % 1000000);
	} else if ($nilai < 1000000000000) {
		$temp = penyebut($nilai / 1000000000) . " milyar" . penyebut(fmod($nilai, 1000000000));
	} else if ($nilai < 1000000000000000) {
		$temp = penyebut($nilai / 1000000000000) . " trilyun" . penyebut(fmod($nilai, 1000000000000));
	}
	return $temp;
}

function terbilang($nilai)
{
	if ($nilai < 0) {
		$hasil = "minus " . trim(penyebut($nilai));
	} else {
		$hasil = trim(penyebut($nilai));
	}
	return $hasil;
}

function get_hafalan($data, $conn)
{
	$hafalan = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM ajo_hafalan_ayat WHERE id_ayat='$data'"));

	return $hafalan['keterangan'];
}

function get_halaqoh($data, $conn)
{
	$halaqoh=mysqli_fetch_array(mysqli_query($conn, "select * from ajo_halaqoh where id_halaqoh='$data'"));
	return $halaqoh['nama_halaqoh'];
}
function kelas($data, $conn)
{
	$kls=mysqli_fetch_array(mysqli_query($conn, "select id_kelas from ajo_santri where id_santri='$data'"));
	return $kls['id_kelas'];
}
function nama_santri($data, $conn)
{
	$kls=mysqli_fetch_array(mysqli_query($conn, "select nama_santri from ajo_santri where id_santri='$data'"));
	return $kls['nama_santri'];
}
function nama_santri_baru($data, $conn)
{
	$kls=mysqli_fetch_array(mysqli_query($conn, "select nama from psb_pendaftaran where no_daftar='$data'"));
	return $kls['nama'];
}
function asramane($data, $conn)
{
	$kls=mysqli_fetch_array(mysqli_query($conn, "select asrama from ajo_santri where id_santri='$data'"));
	return $kls['asrama'];
}
function total_santri($prodi,$jns,$conn){
	$tot=mysqli_num_rows(mysqli_query($conn,"select id_santri from ajo_santri where id_prodi_sekarang='$prodi' and lk_pr='$jns'"));
	return $tot;
}
function generate($data,$conn)
{
$cek=mysqli_num_rows(mysqli_query($conn, "select id_kelas from ajo_santri where mid(id_kelas,1,2)='$data'"));
 if($cek == '0'){ $button = '<button class="btn btn-primary" name ="sub'.$data.'" type="submit">Generate</button>'; } else { $button = '';}
return $button;
}
