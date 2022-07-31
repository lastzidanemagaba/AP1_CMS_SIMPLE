<?php
session_start();
include 'config/koneksi.php'; 
if(isset($_POST['username']) && !empty($_POST['password'])){
  
	$level = 0;
	$result = mysqli_query($con,"SELECT * FROM user_list WHERE (username = '".$_POST['username']."' AND password = '".md5($_POST['password'])."')");
	while($row = mysqli_fetch_array($result)){
		$_SESSION['username'] = $row['username'];
		$_SESSION['nama'] = $row['nama_lengkap'];
		$_SESSION['id'] = $row['id'];
		$_SESSION['id_project'] = "1";
		$_SESSION['id_level'] = $row['id_level'];
		$_SESSION['aplikasi'] = "patrol";
		$level = $row['id_level'];
	}
	
  if($level == 1||$level == 2||$level == 3){ //admin cabang & klien & supervisor
	header('Location: admin/');
	//echo '<script type="text/javascript"> setTimeout( function(){window.location = "'.$uri.'" },0);</script>';
	//echo $_SESSION['admin']."<br>";
	//echo $_SESSION['nama']."<br>";
	//echo $_SESSION['id']."<br>";
	//echo $_SESSION['id_cabang']."<br>";
  }else if($level == 4){
	header("location: index?alert=".md5("bukan"))or die(mysql_error());	
  }else{
	header("location: index?alert=".md5("gagal"));
  }
}
?>