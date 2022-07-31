<?php 
	include 'koneksi.php'; 
	

 if($_SERVER['REQUEST_METHOD'] == 'POST'){
	$id = "0";
	$id_security = $_POST['id_security'];
	$uraian_kegiatan = $_POST['uraian_kegiatan'];
	$hasil_pengawasan = $_POST['hasil_pengawasan'];
	$id_shift  = $_POST['id_shift'];
	$create_date  = date('Y-m-d H:i:s');
	$create_by  = $_POST['create_by'];
		
	$menu = "Menu logbook mobile app";
	$aksi = "Memasukkan data logbook";
	

	//SYSTEM
	$data = "SELECT * FROM logbook_report ORDER BY id DESC LIMIT 1";	$d_data = mysqli_query($con,$data);	
	while($kode = mysqli_fetch_array($d_data)){	$id=$kode['id'];	} $id=$id+1;
	
	$data = "SELECT * FROM history_sistem ORDER BY id DESC LIMIT 1";	$d_data = mysqli_query($con,$data);	
	while($kode = mysqli_fetch_array($d_data)){	$id2=$kode['id'];	} $id2=$id2+1;
	
	
	$insert = "INSERT INTO logbook_report 
	VALUES ('$id','$uraian_kegiatan','$hasil_pengawasan','$id_shift','$create_date','$create_by')";
	
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