<?php
if($_GET){
switch ($_GET['page']){
		case 'Home' :				
			if(!file_exists ("depan.php")) die ("Empty Main Page!"); 
			include "depan.php";
		break;
		
		//Assy Master
		case 'MasterAssy':
			if(!file_exists ("assyMaster.php")) die ("File tidak ditemukan!");
			include "assyMaster.php";
		break;
		case 'deleteAssy':
			if(!file_exists ("assyMaster.php")) die ("File tidak ditemukan!");
			include "assyMaster.php";
		break;
		case 'BreakDownAssy';
			if(!file_exists ("assyBreakdown.php")) die ("File tidak ditemukan!");
			include "assyBreakdown.php";
		break;
		case 'CreateMasterAssy';
			if(!file_exists ("assyCreateMaster.php")) die ("File tidak ditemukan!");
			include "assyCreateMaster.php";
		break;
		case 'CreateBreakdownAssy';
			if(!file_exists ("assyCreateBD.php")) die ("File tidak ditemukan!");
			include "assyCreateBD.php";
		break;
		
		//Master Product
		case 'ListProduct';
			if(!file_exists ("sf_daftar.php")) die ("File tidak ditemukan!");
			include "sf_daftar.php";
		break;
		case 'CreateMasterProduct';
			if(!file_exists ("sf_buatmaster.php")) die ("File tidak ditemukan!");
			include "sf_buatmaster.php";
		break;
		case 'DeleteProduct';
			if(!file_exists ("sf_daftar.php")) die ("File tidak ditemukan!");
			include "sf_daftar.php";
		break;
		
		//Master Customer
		case 'CustomerList';
			if(!file_exists ("cust_list.php")) die ("File tidak ditemukan!");
			include "cust_list.php";
		break;
		case 'CreateCustomer';
			if(!file_exists ("cust_create.php")) die ("File tidak ditemukan!");
			include "cust_create.php";
		break;
		
		//Laporan
		case 'ProductByCustomer';
			if(!file_exists ("productpercustomer.php")) die ("File tidak ditemukan!");
			include "productpercustomer.php";
		break;
		case 'BreakdownAssy';
			if(!file_exists ("assyBreakdown.php")) die ("File tidak ditemukan!");
			include "assyBreakdown.php";
		break;
		case 'PrintAssyBreakdownpdf';
			if(!file_exists ("assy_pdf.php")) die ("File tidak ditemukan!");
			include "assy_pdf.php";
		break;
		case 'PartTag';
			if(!file_exists ("partTag.php")) die ("File tidak ditemukan!");
			include "partTag.php";
		break;
}
}
