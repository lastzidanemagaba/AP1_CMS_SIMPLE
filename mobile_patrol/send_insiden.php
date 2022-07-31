<?php 
	include 'koneksi.php'; 
	

 if($_SERVER['REQUEST_METHOD'] == 'POST'){
	$id = "0";
	$id_subarea = $_POST['id_subarea'];
	$deskripsi = $_POST['deskripsi'];
	$id_shift  = $_POST['id_shift'];
	$time  = $_POST['time'];
	$create_date  = date('Y-m-d H:i:s');
	$create_by  = $_POST['create_by'];
	
	$file = $_POST['file'];
	
	$menu = "Menu insiden mobile app";
	$aksi = "Memasukkan data insiden";
	

	//SYSTEM
	$data = "SELECT * FROM insiden_report ORDER BY id DESC LIMIT 1";	$d_data = mysqli_query($con,$data);	
	while($kode = mysqli_fetch_array($d_data)){	$id=$kode['id'];	} $id=$id+1;
	
	$data = "SELECT * FROM history_sistem ORDER BY id DESC LIMIT 1";	$d_data = mysqli_query($con,$data);	
	while($kode = mysqli_fetch_array($d_data)){	$id2=$kode['id'];	} $id2=$id2+1;
	
	
    $image = "image_".$id.".jpg"; $Path = "../assets/upload/insiden/$image";
	    
	$insert = "INSERT INTO insiden_report 
	VALUES ('$id','$id_subarea','$deskripsi','$id_shift','$time','$image','$create_date','$create_by')";
	
	$history = "INSERT INTO history_sistem 
	VALUES ('$id2','$create_date','$create_by','$menu','$aksi')";

	$exeinsert = mysqli_query($con,$insert);
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