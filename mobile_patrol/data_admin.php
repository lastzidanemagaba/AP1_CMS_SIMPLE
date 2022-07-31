<?php
	//Import File Koneksi Database
	include('koneksi.php');

	//Membuat SQL Query
	$sql = "SELECT * FROM user";

	//Mendapatkan Hasil
	$r = mysqli_query($con,$sql);

	//Membuat Array Kosong
	$result = array();

	while($row = mysqli_fetch_array($r)){

		//Memasukkan Nama dan ID kedalam Array Kosong yang telah dibuat
		array_push($result,array(
			//"id"=>$row['id_user'],
			//"nama"=>$row['nama_lengkap'],
			//"username"=>$row['username'],
			//"jabatan"=>$row['jabatan'],
			//"level"=>$row['id_level'],
			//"id_lokasi"=>$row['id_project'],
			"hash"=>rand(0,1000),
			
		));
	}

	//Menampilkan Array dalam Format JSON
	echo json_encode(array('login'=>$result));

	mysqli_close($con);
?>
