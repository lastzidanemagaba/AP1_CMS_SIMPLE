<?php 
	include 'koneksi.php'; 
	

 if($_SERVER['REQUEST_METHOD'] == 'POST'){
	$id = "0"; $id2 = "0";
	$create_date  = date('Y-m-d H:i:s');
	$create_by = $_POST['create_by'];
	
	if($_POST['update']=="akun"){
		
		$username = $_POST['username'];
		$namalengkap = $_POST['namalengkap'];
		$password = $_POST['password'];
		$repassword = $_POST['repassword'];
		
		$menu = "Menu update mobile app";
		$aksi = "Mengedit akun user";

		//SYSTEM	
		$data = "SELECT * FROM history_sistem ORDER BY id DESC LIMIT 1";	$d_data = mysqli_query($con,$data);	
		while($kode = mysqli_fetch_array($d_data)){	$id2=$kode['id'];	} $id2=$id2+1;
		
		$update = "UPDATE user_list SET nama_lengkap = '".$_POST['namalengkap']."' WHERE ((id) ='".$_POST['create_by']."')";
		
		$history = "INSERT INTO history_sistem 
		VALUES ('$id2','$create_date','$create_by','$menu','$aksi')";

		$exeupdate = mysqli_query($con,$update);
		$exehistory = mysqli_query($con,$history);
		
		if($exeupdate&&$exehistory)
		{        
			echo "Edit Success";
			///$response['message'] = "Success ! Data di tambahkan";
		}
		else
		{
			echo "Edit Error: " . $insert . "<br>" . mysqli_error($con);
			///$response['message'] = "Failed ! Data Gagal di tambahkan";
		}
		
	}else if($_POST['update']=="logbook"){
		
		$id = $_POST['id'];
		$uraian_kegiatan = $_POST['uraian_kegiatan'];
		$hasil_pengawasan = $_POST['hasil_pengawasan'];
		
		$menu = "Menu update mobile app";
		$aksi = "Mengedit data logbook";

		//SYSTEM	
		$data = "SELECT * FROM history_sistem ORDER BY id DESC LIMIT 1";	$d_data = mysqli_query($con,$data);	
		while($kode = mysqli_fetch_array($d_data)){	$id2=$kode['id'];	} $id2=$id2+1;
		
		$update = "UPDATE logbook_report SET 
		uraian_kegiatan = '".$_POST['uraian_kegiatan']."', 
		hasil_pengawasan = '".$_POST['hasil_pengawasan']."'
		WHERE ((id) ='".$_POST['id']."')";
		
		$history = "INSERT INTO history_sistem 
		VALUES ('$id2','$create_date','$create_by','$menu','$aksi')";

		$exeupdate = mysqli_query($con,$update);
		$exehistory = mysqli_query($con,$history);
		
		if($exeupdate&&$exehistory)
		{        
			echo "Edit Success";
			///$response['message'] = "Success ! Data di tambahkan";
		}
		else
		{
			echo "Edit Error: " . $insert . "<br>" . mysqli_error($con);
			///$response['message'] = "Failed ! Data Gagal di tambahkan";
		}
		
	}else if($_POST['update']=="temuan"){
		
		$id = $_POST['id'];
		$deskripsi = $_POST['deskripsi'];
		
		$menu = "Menu update mobile app";
		$aksi = "Mengedit data temuan";

		//SYSTEM	
		$data = "SELECT * FROM history_sistem ORDER BY id DESC LIMIT 1";	$d_data = mysqli_query($con,$data);	
		while($kode = mysqli_fetch_array($d_data)){	$id2=$kode['id'];	} $id2=$id2+1;
		
		$update = "UPDATE temuan_report SET 
		deskripsi = '".$_POST['deskripsi']."'
		WHERE ((id) ='".$_POST['id']."')";
		
		$history = "INSERT INTO history_sistem 
		VALUES ('$id2','$create_date','$create_by','$menu','$aksi')";

		$exeupdate = mysqli_query($con,$update);
		$exehistory = mysqli_query($con,$history);
		
		if($exeupdate&&$exehistory)
		{        
			echo "Edit Success";
			///$response['message'] = "Success ! Data di tambahkan";
		}
		else
		{
			echo "Edit Error: " . $insert . "<br>" . mysqli_error($con);
			///$response['message'] = "Failed ! Data Gagal di tambahkan";
		}
		
	}else if($_POST['update']=="insiden"){
		
		$id = $_POST['id'];
		$deskripsi = $_POST['deskripsi'];
		$perkiraan = $_POST['perkiraan'];
		
		$menu = "Menu update mobile app";
		$aksi = "Mengedit data insiden";

		//SYSTEM	
		$data = "SELECT * FROM history_sistem ORDER BY id DESC LIMIT 1";	$d_data = mysqli_query($con,$data);	
		while($kode = mysqli_fetch_array($d_data)){	$id2=$kode['id'];	} $id2=$id2+1;
		
		$update = "UPDATE insiden_report SET 
		deskripsi = '".$_POST['deskripsi']."',
		time = '".$_POST['perkiraan']."'
		WHERE ((id) ='".$_POST['id']."')";
		
		$history = "INSERT INTO history_sistem 
		VALUES ('$id2','$create_date','$create_by','$menu','$aksi')";

		$exeupdate = mysqli_query($con,$update);
		$exehistory = mysqli_query($con,$history);
		
		if($exeupdate&&$exehistory)
		{        
			echo "Edit Success";
			///$response['message'] = "Success ! Data di tambahkan";
		}
		else
		{
			echo "Edit Error: " . $update . "<br>" .$history . "<br>" . mysqli_error($con);
			///$response['message'] = "Failed ! Data Gagal di tambahkan";
		}
		
	}
		
	

	
	
}else{
	echo "Please Try Again";
}
		
 ?>