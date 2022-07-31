<?php

function session_user(){
	return $_SESSION['id'];
}function session_level(){
	return $_SESSION['id_level'];
}

function alert($fungsi){ 
	if($fungsi=="tambah"){ ?>
		<script>
			$(function() {
				var Toast = Swal.mixin({
				toast: true,
				position: 'top-end',
				showConfirmButton: false,
				timer: 2000
				});
				Toast.fire({
					icon: 'success',
					title: ' Data added successfully.'
				})
			});
		</script> 
	<?php } else if($fungsi=="update"){	?>
		<script>
			$(function() {
				var Toast = Swal.mixin({
				toast: true,
				position: 'top-end',
				showConfirmButton: false,
				timer: 2000
				});
				Toast.fire({
					icon: 'success',
					title: ' Data updated successfully.'
				})
			});
		</script>
	<?php } else if($fungsi=="hapus"){	?>
		<script>
			$(function() {
				var Toast = Swal.mixin({
				toast: true,
				position: 'top-end',
				showConfirmButton: false,
				timer: 2000
				});
				Toast.fire({
					icon: 'success',
					color: 'yellow',
					title: ' Data deleted successfully.'
				})
			});
		</script>
	<?php } else if($fungsi=="aktif"){	?>
		<script>
			$(function() {
				var Toast = Swal.mixin({
				toast: true,
				position: 'top-end',
				showConfirmButton: false,
				timer: 2000
				});
				Toast.fire({
					icon: 'success',
					title: ' Data activated successfully.'
				})
			});
		</script>
	<?php } else if($fungsi=="nonaktif"){	?>
		<script>
			$(function() {
				var Toast = Swal.mixin({
				toast: true,
				position: 'top-end',
				showConfirmButton: false,
				timer: 2000
				});
				Toast.fire({
					icon: 'error',
					title: ' Data disabled successfully.'
				})
			});
		</script>
	<?php }else if($fungsi=="gagal"){	?>
		<script>
			$(function() {
				var Toast = Swal.mixin({
				toast: true,
				position: 'top-end',
				showConfirmButton: false,
				timer: 2000
				});
				Toast.fire({
					icon: 'error',
					title: ' Data failed to update.'
				})
			});
		</script>
	<?php }
}

function auth_menu($menu,$id_level){	
	if($menu=="satudua"&&($id_level=="1"||$id_level=="2")&&($_SESSION['aplikasi']=="patrol")){
		return 1;
	}else if($menu=="satuduatiga"&&($id_level=="1"||$id_level=="2"||$id_level=="3")&&($_SESSION['aplikasi']=="patrol")){
		return 1;
	}else if($menu=="satu"&&$id_level=="1"&&($_SESSION['aplikasi']=="patrol")){
		return 1;
	}else if($menu=="user"&&$id_level=="1"&&($_SESSION['aplikasi']=="patrol")){
		return 1;
	}else{
		$uri = '../index?alert='.md5("bukan");
		echo '<script type="text/javascript"> setTimeout( function(){window.location = "'.$uri.'" },0);</script>';
		
		return 0;
	}
}


function hari_ini($today){
	switch($today){
		case 'Sun':	$hari_ini = "Minggu";	break;
		case 'Mon':	$hari_ini = "Senin";	break;
		case 'Tue': $hari_ini = "Selasa";	break;
		case 'Wed': $hari_ini = "Rabu"; 	break;
		case 'Thu': $hari_ini = "Kamis"; 	break;
		case 'Fri': $hari_ini = "Jumat"; 	break;
		case 'Sat': $hari_ini = "Sabtu"; 	break;
		
		default: 	$hari_ini = "null"; 	break;
	}
	return $hari_ini;
}

function to_tanggal($tanggal,$i){
	if($i==1){
		$result = $tanggal[6].$tanggal[7].$tanggal[8].$tanggal[9]."/".$tanggal[0].$tanggal[1]."/".$tanggal[3].$tanggal[4];
	}else{
		$result = $tanggal[19].$tanggal[20].$tanggal[21].$tanggal[22]."/".$tanggal[13].$tanggal[14]."/".$tanggal[16].$tanggal[17];
	}
	return $result;
}

function ke_tanggal($tanggal,$i){
	if($i==1){
		$result = $tanggal[0].$tanggal[1]."/".$tanggal[3].$tanggal[4]."/".$tanggal[6].$tanggal[7].$tanggal[8].$tanggal[9];
	}else{
		$result = $tanggal[13].$tanggal[14]."/".$tanggal[16].$tanggal[17]."/".$tanggal[19].$tanggal[20].$tanggal[21].$tanggal[22];
	}
	return $result;
}
 
function format_indo($date){
	$tahun = substr($date, 0, 4);               
	$bulan = substr($date, 5, 2);
	$tgl   = substr($date, 8, 2);
	$result = $tgl . "-" . $bulan. "-". $tahun;
	return $result;
}

function format_indo_to_inter($date){
	$tahun = substr($date, 6, 4);               
	$bulan = substr($date, 3, 2);
	$tgl   = substr($date, 0, 2);
	$result = $tahun . "-" . $bulan. "-". $tgl;
	return $result;
}

function format_indo_from_inter($date){
	$tahun = substr($date, 6, 4);               
	$bulan = substr($date, 3, 2);
	$tgl   = substr($date, 0, 2);
	$result = $tgl . "-" . $bulan. "-". $tahun;
	return $result;
}

function format_indo_lengkap($date){
	$tahun = substr($date, 0, 4);               
	$bulan = substr($date, 5, 2);
	if($bulan=="01"){ $bulan = "Januari"; }
	else if($bulan=="02"){ $bulan = "Februari"; }
	else if($bulan=="03"){ $bulan = "Maret"; }
	else if($bulan=="04"){ $bulan = "April"; }
	else if($bulan=="05"){ $bulan = "Mei"; }
	else if($bulan=="06"){ $bulan = "Juni"; }
	else if($bulan=="07"){ $bulan = "Juli"; }
	else if($bulan=="08"){ $bulan = "Agustus"; }
	else if($bulan=="09"){ $bulan = "September"; }
	else if($bulan=="10"){ $bulan = "Oktober"; }
	else if($bulan=="11"){ $bulan = "November"; }
	else if($bulan=="12"){ $bulan = "Desember"; }
	$tgl   = substr($date, 8, 2);
	
	$waktu = substr($date, 11, 5);
	$result = $tgl . " " . $bulan. " ". $tahun ." / ". $waktu ."";
	return $result;
}

function format_inggris_lengkap($date){
	$tahun = substr($date, 0, 4);               
	$bulan = substr($date, 5, 2);
	if($bulan=="01"){ $bulan = "January"; }
	else if($bulan=="02"){ $bulan = "February"; }
	else if($bulan=="03"){ $bulan = "March"; }
	else if($bulan=="04"){ $bulan = "April"; }
	else if($bulan=="05"){ $bulan = "May"; }
	else if($bulan=="06"){ $bulan = "June"; }
	else if($bulan=="07"){ $bulan = "July"; }
	else if($bulan=="08"){ $bulan = "August"; }
	else if($bulan=="09"){ $bulan = "September"; }
	else if($bulan=="10"){ $bulan = "October"; }
	else if($bulan=="11"){ $bulan = "November"; }
	else if($bulan=="12"){ $bulan = "December"; }
	$tgl   = substr($date, 8, 2);
	
	$waktu = substr($date, 11, 5);
	$result = $tgl . " " . $bulan. " ". $tahun ." / ". $waktu ."";
	return $result;
}

function waktu($time){
	$result = substr($time, 11, 8);

	return $result;
}

function total_subarea(){
	require '../config/koneksi.php';
	$id_level = session_level();
	
	$sql = mysqli_query($con,"SELECT subarea_list.id FROM subarea_list
	WHERE (subarea_list.status = '1')");

	$jumlah = mysqli_num_rows($sql);

	return $jumlah;
}

function total_manpower(){
	require '../config/koneksi.php';
	$id_level = session_level();
	
	$sql = mysqli_query($con,"SELECT id FROM user_list WHERE (id_level = '3')");
	$jumlah = mysqli_num_rows($sql);

	return $jumlah;
}

function total_check(){
	require '../config/koneksi.php';	$id_level = session_level();
	
	$sql = mysqli_query($con,"SELECT tour_report.id,  
	area_list.id, subarea_list.id
	FROM tour_report
	LEFT JOIN subarea_list on subarea_list.id = tour_report.id_subarea
	LEFT JOIN area_list on area_list.id = subarea_list.id_area
	WHERE (tour_report.create_date LIKE '%$tanggal_sekarang%')");
	
	$jumlah = mysqli_num_rows($sql);

	return $jumlah;
}

function total_aman(){
	require '../config/koneksi.php';
	$id_level = session_level();
	
	
	$sql = mysqli_query($con,"SELECT tour_report.id,  
	area_list.id, subarea_list.id
	FROM tour_report
	LEFT JOIN subarea_list on subarea_list.id = tour_report.id_subarea
	LEFT JOIN area_list on area_list.id = subarea_list.id_area
	WHERE (tour_report.create_date LIKE '%$tanggal_sekarang%' AND tour_report.id_kondisi LIKE '1')");
	
	
	$jumlah = mysqli_num_rows($sql);

	return $jumlah;
}

function total_temuan(){
	require '../config/koneksi.php';
	$id_level = session_level();
	
	$sql = mysqli_query($con,"SELECT temuan_report.id,  
	area_list.id, subarea_list.id
	FROM temuan_report
	LEFT JOIN subarea_list on subarea_list.id = temuan_report.id_subarea
	LEFT JOIN area_list on area_list.id = subarea_list.id_area
	WHERE (temuan_report.create_date LIKE '%$tanggal_sekarang%')");
	
	
	$jumlah = mysqli_num_rows($sql);

	return $jumlah;
}

function total_insiden(){
	require '../config/koneksi.php';
	$id_level = session_level();
	
	$sql = mysqli_query($con,"SELECT insiden_report.id,  
	area_list.id, subarea_list.id
	FROM insiden_report
	LEFT JOIN subarea_list on subarea_list.id = insiden_report.id_subarea
	LEFT JOIN area_list on area_list.id = subarea_list.id_area
	WHERE (insiden_report.create_date LIKE '%$tanggal_sekarang%')");
	
	
	$jumlah = mysqli_num_rows($sql);

	return $jumlah;
}


function total_laporan(){
	
	$jumlah = total_temuan() + total_insiden();
	
	return $jumlah;
}

function total_tamu(){
	require '../config/koneksi.php';
	$id_level = session_level();
	
	$sql = mysqli_query($con,"SELECT visitor_report.id,  
	user_list.id
	FROM visitor_report
	LEFT JOIN user_list on user_list.id = visitor_report.create_by
	WHERE (visitor_report.create_date LIKE '%$tanggal_sekarang%')");
	
	
	$jumlah = mysqli_num_rows($sql);

	return $jumlah;
}

function tampil_insiden($id_cabang,$id_level){
	require '../config/koneksi.php';
	//$sql = mysqli_query($con,"SELECT * FROM check_result WHERE network_status = '0' AND create_date LIKE '%$tanggal_sekarang%'");
	if(($id_level==1||$id_level==3)){
		$sql = mysqli_query($con,"SELECT check_result.id_atm, check_result.create_date TIME,
		atm_list.id_project, atm_list.no_mesin NOMESIN, atm_list.nama_lokasi ATM, project_list.id_cabang
		FROM check_result
		LEFT JOIN atm_list on atm_list.id_atm = check_result.id_atm
		LEFT JOIN project_list on project_list.id_project = atm_list.id_project
		WHERE (check_result.network_status = '0' AND check_result.create_date LIKE '%$tanggal_sekarang%' AND project_list.id_project = '$id_cabang')");
	}else{
		$sql = mysqli_query($con,"SELECT check_result.id_atm, check_result.create_date TIME,
		atm_list.id_project, atm_list.no_mesin NOMESIN, atm_list.nama_lokasi ATM
		FROM check_result
		LEFT JOIN atm_list on atm_list.id_atm = check_result.id_atm
		WHERE (check_result.network_status = '0' AND check_result.create_date LIKE '%$tanggal_sekarang%' AND atm_list.id_project = '$id_project')");
	}
	$no=1;
	while($row = mysqli_fetch_array($sql)){
		echo "<h4>".$no++.". ".$row['NOMESIN']." - ".$row['ATM']." , diketahui offline pada ".substr($row['TIME'],11,5)." ";
	}
}

function get_level($id_level){
	require '../config/koneksi.php';
	
	$level = "";
	$result = mysqli_query($con,"SELECT hak_akses FROM level_user WHERE (id = '$id_level')");
	while($h = mysqli_fetch_array($result)){
		$level = $h['hak_akses'];
	}
	return $level;
}

function get_user(){
	require '../config/koneksi.php';
	
	$user = session_user();
	$result = mysqli_query($con,"SELECT nama_lengkap FROM user_list WHERE (id = '$user')");
	while($h = mysqli_fetch_array($result)){
		$user = $h['nama_lengkap'];
	}
	return $user;	
}

function get_project(){
	require '../config/koneksi.php';
	
	$id_project = session_project();
	$project = "Semua Project";
	$result = mysqli_query($con,"SELECT nama_klien FROM project_list WHERE (id = '$id_project')");
	while($h = mysqli_fetch_array($result)){
		$project = $h['nama_klien'];
	}
	return $project;
}

function get_image_project($id_project){
	require '../config/koneksi.php';
	
	$project = "Semua Project";
	$result = mysqli_query($con,"SELECT image FROM project_list WHERE (id_project = '$id_project')");
	while($h = mysqli_fetch_array($result)){
		$project = $h['image'];
	}
	return $project;
}

function jumlah_check($id_subarea, $waktu){
	require '../config/koneksi.php';
	$jumlah = 0;
	if($waktu == "harian"){ $waktu = $tanggal_sekarang; }
	else if($waktu == "bulanan"){ $waktu = $bulan_sekarang; }
	else if($waktu == "tahunan"){ $waktu = $tahun_sekarang; }
	else if($waktu == "all"){ $waktu = ""; }
	
	$sql = mysqli_query($con,"SELECT id_check FROM tour_report WHERE (id_atm = '$id_atm' AND create_date LIKE '%$waktu%') ORDER BY id_check DESC");
	while($h = mysqli_fetch_array($sql)){
		$jumlah++;
	}

	return $jumlah;
}

function jumlah_aman($id_project, $waktu){
	require '../config/koneksi.php';
	$jumlah = 0;
	if($waktu == "harian"){ $waktu = $tanggal_sekarang; }
	else if($waktu == "bulanan"){ $waktu = $bulan_sekarang; }
	else if($waktu == "tahunan"){ $waktu = $tahun_sekarang; }
	else if($waktu == "all"){ $waktu = ""; }
	
	$sql = mysqli_query($con,"SELECT id_check FROM check_result WHERE (id_atm = '$id_atm' AND create_date LIKE '%$waktu%') ORDER BY id_check DESC");
	while($h = mysqli_fetch_array($sql)){
		$jumlah++;
	}

	return $jumlah;
}

function jumlah_general($id_atm, $waktu){
	require '../config/koneksi.php';
	$jumlah = 0;
	if($waktu == "harian"){ $waktu = $tanggal_sekarang; }
	else if($waktu == "bulanan"){ $waktu = $bulan_sekarang; }
	else if($waktu == "tahunan"){ $waktu = $tahun_sekarang; }
	else if($waktu == "all"){ $waktu = ""; }
	
	
	//$sql = mysqli_query($con,"SELECT id_general_check FROM general_check WHERE (id_atm = '$id_atm' AND create_date LIKE '%$waktu%')");
	//$jumlah = mysqli_num_rows($sql);
	
	$sql = mysqli_query($con,"SELECT id_general_check FROM general_check WHERE (id_atm = '$id_atm' AND create_date LIKE '%$waktu%')");
	while($h = mysqli_fetch_array($sql)){
		$jumlah++;
	}

	return $jumlah;
}

function ngecek_terakhir($id_user){
	require '../config/koneksi.php';
	$return = "";
	$result = mysqli_query($con,"SELECT tour_report.create_date CREATEDATE,
	subarea_list.subarea SUBAREA 
	FROM tour_report
	LEFT JOIN subarea_list on subarea_list.id = tour_report.id_subarea
	WHERE (tour_report.create_by = '$id_user') ORDER BY tour_report.id DESC LIMIT 1");
	while($h = mysqli_fetch_array($result)){
		$return = $h['SUBAREA']." (".substr($h['CREATEDATE'],0,16).")";
	}
	return $return;
}

function pengecekaan_terakhir($id_subarea){
	require '../config/koneksi.php';
	$return = "";
	$result = mysqli_query($con,"SELECT create_date FROM tour_report WHERE (id_subarea = '$id_subarea') ORDER BY id DESC LIMIT 1");
	while($h = mysqli_fetch_array($result)){
		$return = $h['create_date'];
	}
	return $return;
}

function status_terakhir($id_subarea){
	require '../config/koneksi.php';
	$return = "";
	$result = mysqli_query($con,"SELECT id_kondisi FROM tour_report WHERE (id_subarea = '$id_subarea') ORDER BY id DESC LIMIT 1");
	while($h = mysqli_fetch_array($result)){
		if($h['id_kondisi']=="1"){
			$return = "Aman";
		}else if($h['id_kondisi']=="2"){
			$return = "Temuan";
		}else{
			$return = "Insiden";
		}
	}
	return $return;
}
function pengecek_terakhir($id_subarea){
	require '../config/koneksi.php';
	$return = "";
	$result = mysqli_query($con,"SELECT tour_report.id_kondisi,
	user_list.nama_lengkap NAMA
	FROM tour_report
	LEFT JOIN user_list on user_list.id = tour_report.create_by
	WHERE (tour_report.id_subarea = '$id_subarea') ORDER BY tour_report.id DESC LIMIT 1");
	while($h = mysqli_fetch_array($result)){
		$return = $h['NAMA'];
	}
	return $return;
}




  ?>

