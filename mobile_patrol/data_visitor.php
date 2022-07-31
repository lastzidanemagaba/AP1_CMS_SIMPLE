<?php

	include 'koneksi.php';
	
	if(isset($_GET['id_user'])){
		
		$id_user = $_GET['id_user'];
	
		//Membuat SQL Query
		$sql = "SELECT visitor_report.id ID, visitor_report.nama NAMA, visitor_report.perusahaan PERUSAHAAN, 
				visitor_report.nomor NOMOR, visitor_report.bertemu BERTEMU, visitor_report.tujuan TUJUAN, 
				visitor_report.create_date TIME, user_list.id, user_list.nama_lengkap PETUGAS
				FROM visitor_report
				LEFT JOIN user_list on user_list.id = visitor_report.create_by
				WHERE visitor_report.create_by = '$id_user' ORDER BY visitor_report.id DESC LIMIT 500";
		$r = mysqli_query($con,$sql);
		$result = array();
		while($row = mysqli_fetch_array($r)){
			array_push($result,array(
				"id"=>$row['ID'],
				"nama"=>$row['NAMA'],
				"perusahaan"=>$row['PERUSAHAAN'],
				"nomor"=>$row['NOMOR'],
				"bertemu"=>$row['BERTEMU'],
				"tujuan"=>$row['TUJUAN'],
				"petugas"=>$row['PETUGAS'],
				"create_date"=>$row['TIME'],
			));
		}
		//Menampilkan Array dalam Format JSON
		echo json_encode(array('data'=>$result,'count'=>count($result)));

		mysqli_close($con);
		
	}
	
?>