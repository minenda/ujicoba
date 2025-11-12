<?php
/**
 * @author Wellington Ribeiro
 * @version 1.0
 * @since 2010-02-09
 */

header('Content-type: text/html; charset=UTF-8');

include "..koneksi.php";

if( isset( $_REQUEST['query'] ) && $_REQUEST['query'] != "" )
{
    $q = mysqli_real_escape_string( $_REQUEST['query'] );
	
    // Catatan : 
	// 'identifier' ==> id dari text input
    if( isset( $_REQUEST['identifier'] ) && substr($_REQUEST['identifier'],0,11) == "kd_akun")
    {
		$sql = "SELECT * FROM tbl_akun where locate('$q',concat(kd_akun, nama_akun) > 0 order by locate('$q', kd_akun) limit 10";
		$r = mysql_query( $sql, $id_mysql );
		if ( $r ) {
	    	echo '<ul>'."\n";
	    	while( $l = mysqli_fetch_array( $r ) ){
				$p = $l['kd_akun']." (".$l['nama_akun'].")";
				$p = preg_replace('/(' . $q . ')/i', '<span style="font-weight:bold;">$1</span>', $p);			
				echo "\t".'<li id="autocomplete_'.$l['nama_akun'].'" rel="'.$l['nama_akun'].'">'. utf8_encode( $p ) .'</li>'."\n";	
	    	}
	    	echo '</ul>';
		}
    }

    
}

?>
