<?php
session_start();
include '../config/koneksi.php'; 

if(isset($_SESSION['username'])&&$_SESSION['aplikasi']=="patrol"){
  if(isset($_POST['status'])){
		if($_POST['status']=="Tambah"){
			$exe="INSERT INTO area_list VALUES(
			  '',
			  '".strtoupper($_POST['area'])."',
			  '1',
			  '".$sekarang."',
			  '1')";
			$execute = mysqli_query($con, $exe);

			if($execute){
				header("location: area?alert=".md5("tambah"));
			}
		}else if(($_POST['status'])=="Edit"){
			$exe="UPDATE area_list SET
			  area = '".strtoupper($_POST['area'])."',
			  status = '".($_POST['status'])."'
			  WHERE (md5(id) ='".$_POST['id']."')";
			  
			$execute = mysqli_query($con, $exe);

			if($execute){
				header("location: area?alert=".md5("update"));
			}
			echo "asdadas";
		}else{
			header("location: area?alert=".md5("gagal"));
		}
		
	}else if(isset($_GET['area']) && isset($_GET['status'])){
	  
		if($_GET['status']==md5("aktifkan")){
			$update = "UPDATE area_list SET status= '1' WHERE (md5(id) ='".$_GET['area']."')";
			$execute = mysqli_query($con, $update);
		}else if($_GET['status']==md5("nonaktifkan")){
			$update = "UPDATE area_list SET status= '0' WHERE (md5(id) ='".$_GET['area']."')";
			$execute = mysqli_query($con, $update);
		}else if($_GET['status']==md5("hapus")){
			$update = "UPDATE area_list SET status= '2' WHERE (md5(id) ='".$_GET['area']."')";
			$execute = mysqli_query($con, $update);
		}
		
		if($execute&&$_GET['status']==md5("aktifkan")){
			header("location: area?alert=".md5("aktif"));
		}else if($execute&&$_GET['status']==md5("nonaktifkan")){
			header("location: area?alert=".md5("nonaktif"));
		}else if($execute&&$_GET['status']==md5("hapus")){
			header("location: area?alert=".md5("hapus"));
		}else{
			echo "GAGAL";
		}
	}
	
}else{
	header("location: ../index?alert=".md5("belum"));
}
?>