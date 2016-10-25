<?php 
	$email 		= $_POST['email'];
	$nama 		= $_POST['name'];
	$ktp		= $_POST['ktp'];
	$alamat 	= $_POST['alamat'];
	$gender 	= $_POST['gender'];
	$kelahiran 	= $_POST['kelahiran'];
	$tgllahir 	= $_POST['tgllahir'];
	
	echo json_encode(array('email' => $email,
						   'nama' => $nama,
						   'ktp' => $ktp,
						   'alamat' => $alamat,
						   'gender' => $gender,
						   'kelahiran' => $kelahiran,
						   'tgllahir' => $tgllahir));
 ?>