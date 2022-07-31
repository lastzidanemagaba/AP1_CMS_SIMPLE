<?php 
	include 'koneksi.php'; 
	

 if($_SERVER['REQUEST_METHOD'] == 'POST'){
	$id = "0";
	$id_subarea = $_POST['id_subarea'];
	$id_shift = "1";
	$create_date  = date('Y-m-d H:i:s');
	$create_by  = $_POST['create_by'];
	$id_kondisi  = "1";
	$tag_lokasi  = "tag_lokasi";
	
	$menu = "Menu tour mobile app";
	$aksi = "Memasukkan data tour";
	
	$data = "SELECT * FROM subarea_list WHERE (id = $id_subarea)";	$d_data = mysqli_query($con,$data);	
	while($kode = mysqli_fetch_array($d_data)){	$lokasi = ucfirst($kode['subarea']);	}
	
	$aksi = "Pengecekan Lokasi $lokasi";
	

	//SYSTEM
	$data = "SELECT * FROM tour_report ORDER BY id DESC LIMIT 1";	$d_data = mysqli_query($con,$data);	
	while($kode = mysqli_fetch_array($d_data)){	$id=$kode['id'];	} $id=$id+1;
	
	$data = "SELECT * FROM history_sistem ORDER BY id DESC LIMIT 1";	$d_data = mysqli_query($con,$data);	
	while($kode = mysqli_fetch_array($d_data)){	$id2=$kode['id'];	} $id2=$id2+1;
	
		    
	$insert = "INSERT INTO tour_report 
	VALUES ('$id','$id_subarea','$id_shift','$create_date','$create_by','$id_kondisi','$tag_lokasi')";
	
	$history = "INSERT INTO history_sistem 
	VALUES ('$id2','$create_date','$create_by','$menu','$aksi')";

	$exeinsert = mysqli_query($con,$insert);
	$exehistory = mysqli_query($con,$history);

	if($exeinsert)
	{
        
		echo "Send Success";
		///$response['message'] = "Success ! Data di tambahkan";
	}
	else
	{
		echo "Send Error: " . $insert . "<br>" . mysqli_error($con);
		///$response['message'] = "Failed ! Data Gagal di tambahkan";
	}
	
}else{
	echo "Please Try Again";
}
		
 ?>