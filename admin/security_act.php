<?php
session_start();
include '../config/koneksi.php'; 

if(isset($_SESSION['username'])&&$_SESSION['aplikasi']=="patrol"){
  if(isset($_POST['status'])){
		if($_POST['status']=="Add"&&($_POST['password']==$_POST['repassword'])){
			$result = mysqli_query($con,"SELECT id FROM user_list ORDER BY id DESC LIMIT 1"); $id = 0;
			while($row = mysqli_fetch_array($result)){ $id = $row['id']+1; }
			
			$exe="INSERT INTO user_list VALUES(
			  '".($id)."',
			  '1',
			  '".ucfirst($_POST['nama_lengkap'])."',
			  '".($_POST['username'])."',
			  '".md5($_POST['password'])."',
			  '".($_POST['no_hp'])."',
			  'petugas@gmail.com',
			  '4',
			  '1')";
			$execute = mysqli_query($con, $exe);
			
			$exe2="INSERT INTO user_other VALUES(
			  '".($id)."',
			  '".($_POST['alamat'])."',
			  '".($_POST['jenis_kelamin'])."',
			  '".($_POST['sertifikat'])."',
			  '".($_POST['tgl_lahir'])."')";
			$execute2 = mysqli_query($con, $exe2);

			if($execute&&$execute2){
				header("location: security?alert=".md5("tambah"));
			}
		}else if(($_POST['status'])=="Edit"){
			$exe="UPDATE user_list SET
			  nama_lengkap = '".ucfirst($_POST['nama_lengkap'])."',
			  username = '".($_POST['username'])."',
			  no_hp = '".($_POST['no_hp'])."',
			  status = '1'
			  WHERE (md5(id) ='".$_POST['id']."')";
			$execute = mysqli_query($con, $exe);
			
			$exe2="UPDATE user_other SET
			  alamat = '".ucfirst($_POST['alamat'])."',
			  jenis_kelamin = '".($_POST['jenis_kelamin'])."',
			  sertifikat = '".($_POST['sertifikat'])."',
			  tgl_lahir = '".($_POST['tgl_lahir'])."'
			  WHERE (md5(id) ='".$_POST['id']."')";
			$execute2 = mysqli_query($con, $exe2);

			if($execute&&$execute2){
				header("location: security?alert=".md5("update"));
			}
		}else if(($_POST['status'])=="Reset"&&($_POST['password']==$_POST['repassword'])){
			$exe="UPDATE user_list SET
			  password = '".md5($_POST['password'])."'
			  WHERE (md5(id) ='".$_POST['id']."')";
			$execute = mysqli_query($con, $exe);

			if($execute){
				header("location: security?alert=".md5("update"));
			}
		}else{
			header("location: security?alert=".md5("gagal"));
		}
		
	}else if(isset($_GET['security']) && isset($_GET['status'])){
	  
		if($_GET['status']==md5("aktifkan")){
			$update = "UPDATE user_list SET status= '1' WHERE (md5(id) ='".$_GET['security']."')";
			$execute = mysqli_query($con, $update);
		}else if($_GET['status']==md5("nonaktifkan")){
			$update = "UPDATE user_list SET status= '0' WHERE (md5(id) ='".$_GET['security']."')";
			$execute = mysqli_query($con, $update);
		}else if($_GET['status']==md5("hapus")){
			$update = "UPDATE user_list SET status= '2' WHERE (md5(id) ='".$_GET['security']."')";
			$execute = mysqli_query($con, $update);
		}
		
		if($execute&&$_GET['status']==md5("aktifkan")){
			header("location: security?alert=".md5("aktif"));
		}else if($execute&&$_GET['status']==md5("nonaktifkan")){
			header("location: security?alert=".md5("nonaktif"));
		}else if($execute&&$_GET['status']==md5("hapus")){
			header("location: security?alert=".md5("hapus"));
		}else{
			echo "GAGAL";
		}
	}else{
		echo "CUKK ".$_POST['status'];
		
	}
	
}else{
	session_destroy();
	header("location: ../index?alert=".md5("belum"));
}
?>