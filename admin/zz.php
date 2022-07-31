<?php 

include '../config/koneksi.php'; 


	$result = mysqli_query($con,"SELECT * FROM tour_report");
	while($row = mysqli_fetch_array($result)){
		echo $cuk = rand(1,6)."<br>";
		$exe="UPDATE tour_report SET id_subarea = '".rand(1,6)."' WHERE id ='".$row['id']."'";
		$execute = mysqli_query($con, $exe);
	}
							
?>