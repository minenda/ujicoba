<?php
if($_GET){
switch ($_GET['page']){
		case 'Home' :				
			if(!file_exists ("depan.php")) die ("Empty Main Page!"); 
			include "depan.php";
		break;
		case 'tambahDaftar' :				
			if(!file_exists ("tambahPendaftar.php")) die ("Empty Main Page!"); 
			include "tambahPendaftar.php";
		break;
		case 'listSantri' :				
			if(!file_exists ("daftarSantri.php")) die ("Empty Main Page!"); 
			include "daftarSantri.php";
		break;
		case 'updateSantri' :				
			if(!file_exists ("updateDataSantri.php")) die ("Empty Main Page!"); 
			include "updateDataSantri.php";
		break;
		case 'master' :				
			if(!file_exists ("z.php")) die ("Empty Main Page!"); 
			include "z.php";
		break;
		
		
}
}
