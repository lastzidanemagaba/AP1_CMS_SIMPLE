<?php 
	include 'koneksi.php'; 
	

 if($_SERVER['REQUEST_METHOD'] == 'POST'){
	$id = "0";
	$nama = $_POST['nama'];
	$perusahaan = $_POST['perusahaan'];
	$nomor = $_POST['nomor'];
	$bertemu = $_POST['bertemu'];
	$tujuan = $_POST['tujuan'];
	$create_date  = date('Y-m-d H:i:s');
	$create_by  = $_POST['create_by'];
		
	$menu = "Menu visitor mobile app";
	$aksi = "Memasukkan data visitor";
	

	//SYSTEM
	$data = "SELECT * FROM visitor_report ORDER BY id DESC LIMIT 1";	$d_data = mysqli_query($con,$data);	
	while($kode = mysqli_fetch_array($d_data)){	$id=$kode['id'];	} $id=$id+1;
	
	$data = "SELECT * FROM history_sistem ORDER BY id DESC LIMIT 1";	$d_data = mysqli_query($con,$data);	
	while($kode = mysqli_fetch_array($d_data)){	$id2=$kode['id'];	} $id2=$id2+1;
	
	
	$insert = "INSERT INTO visitor_report 
	VALUES ('$id','$nama','$perusahaan','$nomor','$bertemu','$tujuan','$create_date','$create_by')";
	
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