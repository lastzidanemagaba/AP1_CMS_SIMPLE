<?php
session_start();
include '../config/koneksi.php';

if(isset($_SESSION['username'])&&$_SESSION['aplikasi']=="maintenance"){
	if(isset($_POST['status'])){
		if(($_POST['status'])=="Tambah"&&($_POST['password']==$_POST['repassword'])){
			$exe="INSERT INTO user_list VALUES(
			  '',
			  '".($_POST['nip'])."',
			  '".ucfirst($_POST['nama_lengkap'])."',
			  '".($_POST['username'])."',
			  '".md5($_POST['password'])."',
			  '".$_POST['no_hp']."',
			  '".$_POST['email']."',
			  '".$_POST['id_level']."',
			  '1',
			  '0')";
			$execute = mysqli_query($con, $exe);
			history($_SESSION['id'],"User web app","Menambahkan user");

			if($execute){
				header("location: user?alert=".md5("tambah"));
			}
		}else if(($_POST['status'])=="Edit"){
			$exe="UPDATE user_list SET
			  nip = '".($_POST['nip'])."',
			  nama_lengkap = '".ucfirst($_POST['nama_lengkap'])."',
			  username = '".$_POST['username']."',
			  no_hp = '".$_POST['no_hp']."',
			  email = '".$_POST['email']."',
			  id_level = '".$_POST['id_level']."'
			  WHERE (md5(id) ='".$_POST['id']."')";
			  
			$execute = mysqli_query($con, $exe);
			history($_SESSION['id'],"User web app","Mengedit user");

			if($execute){
				header("location: user?alert=".md5("update"));
			}
			echo "asdadas";
		}else{
			header("location: user?alert=".md5("gagal"));
		}
		
	}else if(isset($_GET['user']) && isset($_GET['status'])){
	  
		if($_GET['status']==md5("aktifkan")){
			$update = "UPDATE user_list SET status= '1' WHERE (md5(id) ='".$_GET['user']."')";
			$execute = mysqli_query($con, $update);
			history($_SESSION['id'],"User web app","Mengaktifkan user");
		}else if($_GET['status']==md5("nonaktifkan")){
			$update = "UPDATE user_list SET status= '0' WHERE (md5(id) ='".$_GET['user']."')";
			$execute = mysqli_query($con, $update);
			history($_SESSION['id'],"User web app","Menonaktifkan user");
		}else if($_GET['status']==md5("hapus")){
			$update = "UPDATE user_list SET status= '2' WHERE (md5(id) ='".$_GET['user']."')";
			$execute = mysqli_query($con, $update);
			history($_SESSION['id'],"User web app","Menghapus user");
		}
		
		if($execute&&$_GET['status']==md5("aktifkan")){
			header("location: user?alert=".md5("aktif"));
		}else if($execute&&$_GET['status']==md5("nonaktifkan")){
			header("location: user?alert=".md5("nonaktif"));
		}else if($execute&&$_GET['status']==md5("hapus")){
			header("location: user?alert=".md5("hapus"));
		}else{
			echo "GAGAL";
		}
	}
}else{
	session_destroy();
	header("location: ../index?alert=".md5("belum"));
}




function history($id_user, $menu, $aksi){
	include '../config/koneksi.php';
	$exe="INSERT INTO history_sistem VALUES(
			  '',
			  '1',
			  '".($menu)."',
			  '".($aksi)."',
			  '".($id_user)."',
			  '".$sekarang."')";
	$execute = mysqli_query($con, $exe);
}


?>