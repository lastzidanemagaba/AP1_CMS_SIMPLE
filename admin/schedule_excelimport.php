<?php
include '../config/koneksi.php'; 

require('../vendor/autoload.php');
// Include librari PhpSpreadsheet
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Reader\Xlsx;

$spreadsheet = new Spreadsheet();
$sheet = $spreadsheet->getActiveSheet();

$bulan = array(
    "januari" => 1, "februari" => 2, "maret" => 3,"april" => 4, "mei" => 5, "juni" => 6, "juli" => 7, "agustus" => 8, "september" => 9, "oktober" => 10, "november" => 11, "desember" => 12
);
 // Jika user mengklik tombol Import
 $upload_file=$_FILES['excel']['name'];
            $extension=pathinfo($upload_file,PATHINFO_EXTENSION);
            if($extension=='csv')
            {
                $reader= new \PhpOffice\PhpSpreadsheet\Reader\Csv();
            } else if($extension=='xls')
            {
                $reader= new \PhpOffice\PhpSpreadsheet\Reader\Xls();
            } else
            {
                $reader= new \PhpOffice\PhpSpreadsheet\Reader\Xlsx();
            }
            $spreadsheet=$reader->load($_FILES['excel']['tmp_name']);
    $sheet = $spreadsheet->getActiveSheet()->toArray(null, true, true, true);

    $jml_baris = 1;
    $jml_kolom = 0;
    $kolom = ['A', 'B','C', 'D', 'E', 'F','G','H','I','J','K','L','M','N','O','P','Q','R','S','T','U','V','W','X','Y','Z','AA','AB','AC','AD','AE','AF','AG'];
    foreach ($sheet as $row){
        // Cek jika semua data tidak diisi
        if ($row['A'] == "" && $row['B'] == ""){
            continue; // Lewat data pada baris ini (masuk ke looping selanjutnya / baris selanjutnya)
        }
        if($jml_baris > 0){
            while($row[$kolom[$jml_kolom]] != "" && $jml_kolom+1 < 33){
                $jml_kolom++;
            }
        }
        $jml_baris++;
    }

    $numrow = 1;
    $bln = preg_replace('/\s+/', '', $sheet[1]['D']);
    $bln = strtolower($bln);
    $thnbln = $sheet[1]['B'] . "-" . $bulan[$bln] . "-";
    foreach($sheet as $row){
    // Ambil data pada excel sesuai Kolom
    $nomor = $row['A']; // Ambil data nomor
    $username = $row['B']; // Ambil data id
    // ambil id user
    $sql_id = mysqli_query($con,"SELECT id FROM user_list WHERE username = '". $username ."' LIMIT 1");
    $id_user = $sql_id;
	foreach($id_user as $rw){
		$id = $rw['id'];
	}
    //jika username kosong maka $sql_id = null
    if($username == null || $id_user == null){
        $sql_id = null;	
    }
    // Cek jika semua data tidak diisi
    if ($nomor == "" && $username == ""){
        continue; // Lewat data pada baris ini (masuk ke looping selanjutnya / baris selanjutnya)
    }
    // Cek $numrow apakah lebih dari 1
    // Artinya karena baris pertama adalah nama-nama kolom
    // Jadi dilewat saja, tidak usah diimport
    if($numrow > 2){
      // Loop -> Buat query Insert dan ambil data shift dari excel
        for($i=0; $i<=$jml_kolom-2; $i++){
            // ambil data shift
            $jadwal = strtoupper($row[$kolom[$i+2]]);
            // ambil id shift dari database dan cek kebenaran data
            $sql_shift = mysqli_query($con,"SELECT id FROM level_shift WHERE kode LIKE '". $jadwal ."%' LIMIT 1");
            $id_shift = $sql_shift;
            foreach($id_shift as $rw){
                $shift = $rw['id'];
            }
            //jika jadwal kosong maka $sql_shift null
            if($jadwal == null || $id_shift == null){
                $sql_shift = null;	
            }
            // membuat date sesuai dengan kolom
            $tgl = date("Y-m-d", strtotime($thnbln .$i+1));

            // cek apakah data sudah ada
            $sql_cek_jadwal = mysqli_query($con,"SELECT * FROM jadwal_dinas WHERE id_user = '" . $id . "' AND  tanggal = '" . $tgl . "'");

            // if($id == null || $shift == null){
            //     continue;
            // }
            if($sql_cek_jadwal == null && $sql_id != null && $sql_shift != null){// jika data sudah ada update
                // query insert
                $query = mysqli_query($con,"INSERT INTO jadwal_dinas (id_user,tanggal,id_shift) VALUES('" . $id . "','" . $tgl . "' ,'" . $shift . "')");   
            }else {// jika data belum ada insert
                // query update
                $query = mysqli_query($con,"UPDATE jadwal_dinas SET id_shift = '" . $shift . "' WHERE id_user = '" . $id . "' AND tanggal = '" . $tgl . "'");
            }
        }
    }

    $numrow++; // Tambah 1 setiap kali looping
}

     // Hapus file excel yg telah diupload, ini agar tidak terjadi penumpukan file


header('location: schedule.php'); // Redirect ke halaman awal