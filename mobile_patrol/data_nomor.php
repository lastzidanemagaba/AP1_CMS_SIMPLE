<?php
	//Import File Koneksi Database
	include 'koneksi.php';
	
    
    if(isset($_GET['id_user'])){
	    $id_user = $_GET['id_user'];
		$id_project = "0";
				
		$sql = "SELECT * FROM nomor_list WHERE status = '1' ORDER BY nama";
		
		//Mendapatkan Hasil
		$r = mysqli_query($con,$sql);

		//Membuat Array Kosong
		$result = array();

		while($row = mysqli_fetch_array($r)){
			
			//Memasukkan Nama dan ID kedalam Array Kosong yang telah dibuat
			array_push($result,array(
				"nama"=>$row['nama'],
				"nomor"=>$row['nomor'],
			));
		}

		//Menampilkan Array dalam Format JSON
		echo json_encode(array('data'=>$result,'result'=>count($result)));

		mysqli_close($con);
	
	}
?>