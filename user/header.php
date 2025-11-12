<?php
include "conn.php";
include "../func.php";
session_start();

if (!isset($_SESSION['nama'])) {
    echo "<script>alert('Login dulu ya!'); window.location = '../login.php'</script>";
}
$pesanErr = "";

?>
<!DOCTYPE html>
<html lang="en" id="demo">
	<head>

		<meta charset="utf-8">
		<meta content="width=device-width, initial-scale=1, shrink-to-fit=no" name="viewport">
		<meta name="description" content="Spruha -  Admin Panel HTML Dashboard Template">
		<meta name="author" content="Spruko Technologies Private Limited">
		<meta name="keywords" content="admin,dashboard,panel,bootstrap admin template,bootstrap dashboard,dashboard,themeforest admin dashboard,themeforest admin,themeforest dashboard,themeforest admin panel,themeforest admin template,themeforest admin dashboard,cool admin,it dashboard,admin design,dash templates,saas dashboard,dmin ui design">

		<!-- Favicon -->
		<link rel="icon" href="../assets/img/brand/favicon.ico" type="image/x-icon"/>

		<!-- Title -->
		<title>INV - PONPES IMAM BUKHARI SURAKARTA</title>

		<!-- Bootstrap css-->
		<link  id="style" href="../assets/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet"/>

		<!-- Icons css-->
		<link href="../assets/plugins/web-fonts/icons.css" rel="stylesheet"/>
		<link href="../assets/plugins/web-fonts/font-awesome/font-awesome.min.css" rel="stylesheet">
		<link href="../assets/plugins/web-fonts/plugin.css" rel="stylesheet"/>

		<!-- DATA TABLE CSS -->
		<link href="../assets/plugins/datatable/css/dataTables.bootstrap5.css" rel="stylesheet" />
		<link href="../assets/plugins/datatable/css/buttons.bootstrap5.min.css"  rel="stylesheet">
		<link href="../assets/plugins/datatable/css/responsive.bootstrap5.css" rel="stylesheet" />


		<!-- Style css-->
		<link href="../assets/css/style.css" rel="stylesheet">
		<link href="../assets/css/boxed.css" rel="stylesheet" />
		<link href="../assets/css/dark-boxed.css" rel="stylesheet" />
		<link href="../assets/css/skins.css" rel="stylesheet">
		<link href="../assets/css/dark-style.css" rel="stylesheet">
		<link href="../assets/css/colors/default.css" rel="stylesheet">

		<!-- Color css-->
		<link id="theme" rel="stylesheet" type="text/css" media="all" href="../assets/css/colors/color.css">

		<!-- Select2 css-->
		<link href="../assets/plugins/select2/css/select2.min.css" rel="stylesheet">

		<!-- Mutipleselect css-->
		<link rel="stylesheet" href="../assets/plugins/multipleselect/multiple-select.css">

	</head>
