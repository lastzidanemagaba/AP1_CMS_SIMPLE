<?php

	include 'koneksi.php';
	
	if(isset($_GET['id_user'])){
		
		$id_user = $_GET['id_user'];
	
		//Membuat SQL Query
		$sql = "SELECT insiden_report.id ID, insiden_report.deskripsi DESKRIPSI, insiden_report.id_subarea LOK, 
				insiden_report.image FOTO, insiden_report.time PERKIRAAN, insiden_report.create_date TIME, 
				user_list.id, user_list.nama_lengkap NAMA, subarea_list.id, subarea_list.subarea LOKASI
				FROM insiden_report
				LEFT JOIN user_list on user_list.id = insiden_report.create_by
				LEFT JOIN subarea_list on subarea_list.id = insiden_report.id_subarea
				WHERE insiden_report.create_by = '$id_user' ORDER BY insiden_report.id DESC LIMIT 500";
		$r = mysqli_query($con,$sql);
		$result = array();
		while($row = mysqli_fetch_array($r)){
			array_push($result,array(
				"id"=>$row['ID'],
				"lokasi"=>$row['LOKASI'],
				"deskripsi"=>$row['DESKRIPSI'],
				"foto"=>$row['FOTO'],
				"perkiraan"=>$row['PERKIRAAN'],
				"petugas"=>$row['NAMA'],
				"create_date"=>$row['TIME'],
			));
		}
		//Menampilkan Array dalam Format JSON
		echo json_encode(array('data'=>$result,'count'=>count($result)));

		mysqli_close($con);
		
	}
	
?>