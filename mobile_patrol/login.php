<?php 
	include_once('koneksi.php'); 

    $user = $_GET['user'];
	$pass = md5($_GET['pass']);
	$result = array();

	$data = "SELECT * FROM user_list WHERE(username = '$user' AND password = '$pass')";
	$d_data = mysqli_query($con,$data);	
	while($row = mysqli_fetch_array($d_data)){
	    //Memasukkan Nama dan ID kedalam Array Kosong yang telah dibuat
	    
	    if($row['id_level']=="1"){  $jabatan = "superadmin"; }
	    if($row['id_level']=="2"){  $jabatan = "supervisor"; }
	    if($row['id_level']=="3"){  $jabatan = "admin"; }
	    if($row['id_level']=="4"){  $jabatan = "petugas"; }
	    if($row['id_level']=="6"){  $jabatan = ""; }
	    
		array_push($result,array(
			"id"=>$row['id'],
			"user"=>$row['username'],
			"nama"=>$row['nama_lengkap'],
			"level"=>$row['id_level'],
			"jabatan"=>$jabatan,
			"id_project"=>$row['id_project'],
		));
	} 
	
	//Menampilkan Array dalam Format JSON
	echo json_encode(array('login'=>$result,'result'=>count($result)));

	mysqli_close($con);
		
 ?>