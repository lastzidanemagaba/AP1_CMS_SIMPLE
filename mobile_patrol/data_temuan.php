<?php

	include 'koneksi.php';
	
	if(isset($_GET['id_user'])){
		
		$id_user = $_GET['id_user'];
	
		//Membuat SQL Query
		$sql = "SELECT temuan_report.id ID, temuan_report.deskripsi DESKRIPSI, temuan_report.id_subarea LOK, temuan_report.image FOTO, 
				temuan_report.create_date TIME, user_list.id, user_list.nama_lengkap NAMA, subarea_list.id, subarea_list.subarea LOKASI
				FROM temuan_report
				LEFT JOIN user_list on user_list.id = temuan_report.create_by
				LEFT JOIN subarea_list on subarea_list.id = temuan_report.id_subarea
				WHERE temuan_report.create_by = '$id_user' ORDER BY temuan_report.id DESC LIMIT 500";
		$r = mysqli_query($con,$sql);
		$result = array();
		while($row = mysqli_fetch_array($r)){
			array_push($result,array(
				"id"=>$row['ID'],
				"lokasi"=>$row['LOKASI'],
				"deskripsi"=>$row['DESKRIPSI'],
				"foto"=>$row['FOTO'],
				"petugas"=>$row['NAMA'],
				"create_date"=>$row['TIME'],
			));
		}
		//Menampilkan Array dalam Format JSON
		echo json_encode(array('data'=>$result,'count'=>count($result)));

		mysqli_close($con);
		
	}
	
?>