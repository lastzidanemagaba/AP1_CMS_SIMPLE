<?php
session_start();
include '../config/koneksi.php'; 

if(isset($_SESSION['username'])&&$_SESSION['aplikasi']=="patrol"){
  if(isset($_POST['status'])){
		if($_POST['status']=="Tambah"){
			$exe="INSERT INTO user_list VALUES(
			  '',
			  '".ucfirst($_POST['nama'])."',
			  '".($_POST['nomor'])."',
			  '1')";
			$execute = mysqli_query($con, $exe);

			if($execute){
				header("location: index?alert=".md5("tambah"));
			}
		}else if(($_POST['status'])=="Edit"){
			$exe="UPDATE user_list SET
			  nama_lengkap = '".ucfirst($_POST['nama_lengkap'])."',
			  username = '".($_POST['username'])."',
			  status = '".($_POST['aktif'])."'
			  WHERE (md5(id) ='".$_POST['id']."')";
			$execute = mysqli_query($con, $exe);
			
			if($_POST['password']==$_POST['repassword']){
				$exe2="UPDATE user_list SET
				  password = '".md5($_POST['password'])."'
				  WHERE (md5(id) ='".$_POST['id']."')";
				$execute2 = mysqli_query($con, $exe2);
			}

			if($execute){
				session_destroy();
				header("location: index?alert=".md5("update"));
			}
		}else{
			header("location: index?alert=".md5("gagal"));
		}
		
	}else if(isset($_GET['user']) && isset($_GET['status'])){
	  
		if($_GET['status']==md5("aktifkan")){
			$update = "UPDATE user_list SET status= '1' WHERE (md5(id) ='".$_GET['daily']."')";
			$execute = mysqli_query($con, $update);
		}else if($_GET['status']==md5("nonaktifkan")){
			$update = "UPDATE user_list SET status= '0' WHERE (md5(id) ='".$_GET['daily']."')";
			$execute = mysqli_query($con, $update);
		}else if($_GET['status']==md5("hapus")){
			$update = "DELETE FROM user_list WHERE (md5(id) ='".$_GET['daily']."')";
			$execute = mysqli_query($con, $update);
		}
		
		if($execute&&$_GET['status']==md5("aktifkan")){
			header("location: index?alert=".md5("aktif"));
		}else if($execute&&$_GET['status']==md5("nonaktifkan")){
			header("location: index?alert=".md5("nonaktif"));
		}else if($execute&&$_GET['status']==md5("hapus")){
			header("location: index?alert=".md5("hapus"));
		}else{
			header("location: index?alert=".md5("gagal"));
		}
	}
	
}else{
	session_destroy();
	header("location: ../index?alert=".md5("belum"));
}
?>