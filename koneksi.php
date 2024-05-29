<?php

$koneksi = mysqli_connect("localhost", "root", "", "ecommerce");

if($koneksi){

	// echo "Database berhasil Conect";
	
} else {
	echo "gagal Connect";
}

?>