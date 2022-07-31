<?php

	include 'koneksi.php';
	
	if(isset($_GET['id_user'])){
		
		$id_user = $_GET['id_user'];
	
		//Membuat SQL Query
		$sql = "SELECT * FROM history_sistem WHERE create_by = '$id_user' ORDER BY id DESC LIMIT 500";

		//Mendapatkan Hasil
		$r = mysqli_query($con,$sql);

		//Membuat Array Kosong
		$result = array();
		
		while($row = mysqli_fetch_array($r)){
			//Memasukkan Nama dan ID kedalam Array Kosong yang telah dibuat
			array_push($result,array(
				"create_date"=>$row['create_date'],
				"menu"=>$row['menu'],
				"aksi"=>$row['aksi'],
			));
		}

		//Menampilkan Array dalam Format JSON
		echo json_encode(array('data'=>$result,'result'=>count($result)));

		mysqli_close($con);
		
	}
	
?>