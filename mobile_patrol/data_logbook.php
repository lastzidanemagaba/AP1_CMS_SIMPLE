<?php

	include 'koneksi.php';
	
	if(isset($_GET['id_user'])){
		
		$id_user = $_GET['id_user'];
	
		//Membuat SQL Query
		$sql = "SELECT logbook_report.id ID, logbook_report.create_by, logbook_report.uraian_kegiatan KEGIATAN, 
				logbook_report.hasil_pengawasan HASIL, logbook_report.create_date TIME, user_list.id, user_list.nama_lengkap NAMA
				FROM logbook_report
				LEFT JOIN user_list on user_list.id = logbook_report.create_by
				WHERE logbook_report.create_by = '$id_user' ORDER BY logbook_report.id DESC LIMIT 500";
		$r = mysqli_query($con,$sql);
		$result = array();
		while($row = mysqli_fetch_array($r)){
			array_push($result,array(
				"id"=>$row['ID'],
				"petugas"=>$row['NAMA'],
				"kegiatan"=>$row['KEGIATAN'],
				"hasil"=>$row['HASIL'],
				"create_date"=>$row['TIME'],
			));
		}
		
			
		//Membuat SQL Query
		$sql = "SELECT * FROM user_list WHERE (id_level = '4') ORDER BY nama_lengkap";
		$r = mysqli_query($con,$sql);
		$result_user = array();
		while($row = mysqli_fetch_array($r)){
			array_push($result_user,array(
				"id"=>$row['id'],
				"nama"=>$row['nama_lengkap'],
			));
		}
		
		
		

		//Menampilkan Array dalam Format JSON
		echo json_encode(array('data'=>$result,'security'=>$result_user,'count'=>count($result)));
		//echo json_encode(array('data'=>$result,'count'=>count($result)));

		mysqli_close($con);
		
	}
	
?>