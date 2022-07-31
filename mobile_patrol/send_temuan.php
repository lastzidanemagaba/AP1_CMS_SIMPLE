<?php 
	include 'koneksi.php'; 
	

 if($_SERVER['REQUEST_METHOD'] == 'POST'){
	$id = "0";
	$id_subarea = $_POST['id_subarea'];
	$deskripsi = $_POST['deskripsi'];
	$id_shift  = $_POST['id_shift'];
	$create_date  = date('Y-m-d H:i:s');
	$create_by  = $_POST['create_by'];
	
	$file = $_POST['file'];
	
	$menu = "Menu temuan mobile app";
	$aksi = "Memasukkan data temuan";
	

	//SYSTEM
	$data = "SELECT * FROM tour_report ORDER BY id DESC LIMIT 1";	$d_data = mysqli_query($con,$data);	
	while($kode = mysqli_fetch_array($d_data)){	$id=$kode['id'];	} $id=$id+1;
	
	$data = "SELECT * FROM temuan_report ORDER BY id DESC LIMIT 1";	$d_data = mysqli_query($con,$data);	
	while($kode = mysqli_fetch_array($d_data)){	$id2=$kode['id'];	} $id2=$id2+1;
	
	$data = "SELECT * FROM history_sistem ORDER BY id DESC LIMIT 1";	$d_data = mysqli_query($con,$data);	
	while($kode = mysqli_fetch_array($d_data)){	$id3=$kode['id'];	} $id3=$id3+1;
	
	
    $image = "image_".$id.".jpg"; $Path = "../assets/upload/temuan/$image";
		
	$insert = "INSERT INTO tour_report 
	VALUES ('$id','$id_subarea','$id_shift','$create_date','$create_by','$id_kondisi','$tag_lokasi')";
	$exeinsert = mysqli_query($con,$insert);
	
	$insert = "INSERT INTO temuan_report 
	VALUES ('$id2','$id_subarea','$deskripsi','$id_shift','$image','$create_date','$create_by')";
	$exeinsert = mysqli_query($con,$insert);
	
	$history = "INSERT INTO history_sistem 
	VALUES ('$id3','$create_date','$create_by','$menu','$aksi')";

	$exehistory = mysqli_query($con,$history);

	if($exeinsert)
	{
        //unlink($Path);
        file_put_contents($Path,base64_decode($file));
        
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