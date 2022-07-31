<?php
	//Import File Koneksi Database
	include 'koneksi.php';
	
    
    if(isset($_GET['id_user'])){
	    $id_user = $_GET['id_user'];
		
		$sql = "SELECT area_list.id ID_AREA, area_list.area AREA, subarea_list.setelah,
		subarea_list.id ID_SUBAREA, subarea_list.subarea SUBAREA, subarea_list.tag TAG
		FROM subarea_list
		LEFT JOIN area_list on area_list.id = subarea_list.id_area
		WHERE subarea_list.status = '1'
		ORDER BY subarea_list.setelah";
		
		//Mendapatkan Hasil
		$r = mysqli_query($con,$sql);

		//Membuat Array Kosong
		$result = array();

		while($row = mysqli_fetch_array($r)){
			$sql2 = "SELECT id_subarea, create_date FROM tour_report 
					WHERE (id_subarea = '".$row['ID_SUBAREA']."' AND create_date LIKE '%$tanggal_sekarang%')";
			$row22 = mysqli_query($con,$sql2);	$scan = 0;
			while($row2 = mysqli_fetch_array($row22)){
				$scan++;
			}
			
			//Memasukkan Nama dan ID kedalam Array Kosong yang telah dibuat
			array_push($result,array(
				"id_area"=>$row['ID_AREA'],
				"area"=>$row['AREA'],
				"id_subarea"=>$row['ID_SUBAREA'],
				"subarea"=>$row['SUBAREA'],
				"tag"=>$row['TAG'],
				"scan"=>$scan,
			));
		}

		//Menampilkan Array dalam Format JSON
		echo json_encode(array('area'=>$result,'result'=>count($result)));

		mysqli_close($con);
	
	}
?>