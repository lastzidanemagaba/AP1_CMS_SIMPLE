<?php
	//Import File Koneksi Database
	require_once('koneksi.php');
	
	$id_user = "";
	$id_project = "";
	$id_atm = "";
	$date = "";
	$level = "";
	
	if(isset($_GET['id_user'])){
	    $id_user = $_GET['id_user'];
	    if($id_user!="0"){
	        $level = "2";
	    }else{
	        $level = "4";
	        if(isset($_GET['id_project'])){
	            $id_project = $_GET['id_project'];
	            $level = "4";
	        }else{
	            $level = "1";
	        }
	    }
	}else if(isset($_GET['periode'])){
	    if($_GET['periode']=="harian"){
	        $date = date('Y-m-d');
	    }else if($_GET['periode']=="bulanan"){
	        $date = date('Y-m');
	    }
	}else if(isset($_GET['id_project'])){
	    $id_project = $_GET['id_project'];
	    $level = "4";
	}else if(isset($_GET['id_atm'])){
	    $id_atm = $_GET['id_atm'];
	    $date = date('Y-m-d');
	    $level = "00";
	}if(isset($_GET['id_user'])&&isset($_GET['id_project'])&&isset($_GET['level'])){
	    $id_user = $_GET['id_user'];
	    $id_project = $_GET['id_project'];
	    $level = $_GET['level'];
	}

	//Membuat SQL Query
	if($level=="1"&&$id_project=="0"){ //untuk All
	    $sql = "SELECT check_result.id_check, check_result.create_date TANGGAL, check_result.network_status NETWORK, user.nama_lengkap MANPOWER,
	    check_result.image_before_screen GAMBAR1, check_result.image_before_room GAMBAR2, check_result.image_after_screen GAMBAR3, check_result.image_after_room GAMBAR4, check_result.image_receipt GAMBAR5, 
	    atm_list.no_mesin NOMESIN, atm_list.nama_lokasi NAMA, atm_list.id_project PROJECT FROM check_result
	    left join atm_list on atm_list.id_atm=check_result.id_atm
	    left join user on user.id_user=check_result.create_by
		WHERE (check_result.create_date LIKE '%$date%')
		ORDER BY check_result.id_check DESC LIMIT 200";
	}else if($level=="2"||$level=="22"){ //untuk manpower
	    $sql = "SELECT check_result.id_check, check_result.create_date TANGGAL, check_result.network_status NETWORK, user.nama_lengkap MANPOWER,
	    check_result.image_before_screen GAMBAR1, check_result.image_before_room GAMBAR2, check_result.image_after_screen GAMBAR3, check_result.image_after_room GAMBAR4, check_result.image_receipt GAMBAR5, 
	    atm_list.no_mesin NOMESIN, atm_list.nama_lokasi NAMA, atm_list.id_project PROJECT FROM check_result
	    left join atm_list on atm_list.id_atm=check_result.id_atm
	    left join user on user.id_user=check_result.create_by
		WHERE (check_result.create_by = '$id_user' AND check_result.create_date LIKE '%$date%')
		ORDER BY check_result.id_check DESC LIMIT 200";
	}else if($level=="1"||$level=="3"||$level=="4"){ //untuk client atau supervisor
	    $sql = "SELECT check_result.id_check, check_result.create_date TANGGAL, check_result.network_status NETWORK, user.nama_lengkap MANPOWER,
	    check_result.image_before_screen GAMBAR1, check_result.image_before_room GAMBAR2, check_result.image_after_screen GAMBAR3, check_result.image_after_room GAMBAR4, check_result.image_receipt GAMBAR5, 
	    atm_list.no_mesin NOMESIN, atm_list.nama_lokasi NAMA, atm_list.id_project PROJECT FROM check_result
	    left join atm_list on atm_list.id_atm=check_result.id_atm
	    left join user on user.id_user=check_result.create_by
		WHERE (atm_list.id_project = '$id_project' AND check_result.create_date LIKE '%$date%')
		ORDER BY check_result.create_date DESC LIMIT 200";
	}else if($level=="00"){ //untuk client atau supervisor history hari ini
	    $sql = "SELECT check_result.id_check, check_result.create_date TANGGAL, check_result.network_status NETWORK, user.nama_lengkap MANPOWER,
	    check_result.image_before_screen GAMBAR1, check_result.image_before_room GAMBAR2, check_result.image_after_screen GAMBAR3, check_result.image_after_room GAMBAR4, check_result.image_receipt GAMBAR5, 
	    atm_list.no_mesin NOMESIN, atm_list.nama_lokasi NAMA, atm_list.id_project PROJECT FROM check_result
	    left join atm_list on atm_list.id_atm=check_result.id_atm
	    left join user on user.id_user=check_result.create_by
		WHERE (check_result.id_atm = '$id_atm' AND check_result.create_date LIKE '%$date%')
		ORDER BY check_result.id_check ASC LIMIT 200";
	}
	
		
	//Mendapatkan Hasil
	$r = mysqli_query($con,$sql);

	//Membuat Array Kosong
	$result = array();
	while($row = mysqli_fetch_array($r)){
		//Memasukkan Nama dan ID kedalam Array Kosong yang telah dibuat
		if($row['NETWORK']=="1"){
		    $nama = $row['NAMA']." √";
		}else{
		    $nama = $row['NAMA']." ×";
		}
		//$nama = $row['NAMA'];
		
		if($level=="00"){
		    $date = substr($row['TANGGAL'],11,5);
		}else{
		    /*if($row['NETWORK']=="1"){
		        $date = $row['TANGGAL']." √";
    		}else{
		        $date = $row['TANGGAL']." ×";
    		}*/
		    $date = $row['TANGGAL'];
		}
		
		array_push($result,array(
			"nomor"=>$row['NOMESIN'],
			"nama"=>$nama,
			"tanggal"=>$date,
			"network"=>$row['NETWORK'],
			"gambar1"=>$row['GAMBAR1'],
			"gambar2"=>$row['GAMBAR2'],
			"gambar3"=>$row['GAMBAR3'],
			"gambar4"=>$row['GAMBAR4'],
			"gambar5"=>$row['GAMBAR5'],
			"manpower"=>$row['MANPOWER'],
		));
	}

	//Menampilkan Array dalam Format JSON
	echo json_encode(array('history_check'=>$result,'result'=>count($result)));
	//echo json_encode(array('history_check'=>$result));

	mysqli_close($con);
?>