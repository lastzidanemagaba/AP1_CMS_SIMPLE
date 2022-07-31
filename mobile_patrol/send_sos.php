<?php 
	include_once('koneksi.php'); 
	

 if($_SERVER['REQUEST_METHOD'] == 'POST'){
	$id = "0";
	$id_atm = $_POST['id_atm'];
	$id_user = $_POST['id_user'];
	$created  = $_POST['time'];
	
	$check_mesin = $_POST['check_mesin'];
	$check_rumah = $_POST['check_rumah'];
	$check_fascia = $_POST['check_fascia'];
	$check_pole = $_POST['check_pole'];
	
	$file1 = $_POST['file1'];
	$file2 = $_POST['file2'];
	$file3 = $_POST['file3'];
	$file4 = $_POST['file4'];
	

	
	//SYSTEM
	$data = "SELECT * FROM general_check ORDER BY id_general_check DESC LIMIT 1";
	$d_data = mysqli_query($con,$data);	
	while($kode = mysqli_fetch_array($d_data)){
		$id=$kode['id_general_check'];
	} $id=$id+1;
	
	
    $image1 = "image_1_".$id.".jpg"; $Path1 = "../assets/upload/general/$image1";
    $image2 = "image_2_".$id.".jpg"; $Path2 = "../assets/upload/general/$image2";
    $image3 = "image_3_".$id.".jpg"; $Path3 = "../assets/upload/general/$image3";
    $image4 = "image_4_".$id.".jpg"; $Path4 = "../assets/upload/general/$image4";
	    
	$insert = "INSERT INTO general_check(id_general_check,id_atm,create_date,create_by,check_mesin,check_rumah,check_fascia,check_pole,image_before_indoor,image_before_outdoor,image_after_indoor,image_after_outdoor) 
	VALUES ('$id','$id_atm','$created','$id_user','$check_mesin','$check_rumah','$check_fascia','$check_pole','$image1','$image2','$image3','$image4')";


	$exeinsert = mysqli_query($con,$insert);

	if($exeinsert)
	{
        //unlink($Path);
        file_put_contents($Path1,base64_decode($file1));
        file_put_contents($Path2,base64_decode($file2));
        file_put_contents($Path3,base64_decode($file3));
        file_put_contents($Path4,base64_decode($file4));
        
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