<?php
    include '../config/koneksi.php'; 

    require('../vendor/autoload.php');
    // Include librari PhpSpreadsheet
    use PhpOffice\PhpSpreadsheet\Spreadsheet;
    use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
    use PhpOffice\PhpSpreadsheet\Style\Border;
    use PhpOffice\PhpSpreadsheet\Style\Color;

$spreadsheet = new Spreadsheet();
$sheet = $spreadsheet->getActiveSheet();

$bulan = array(
    "januari" => 1, "februari" => 2, "maret" => 3,"april" => 4, "mei" => 5, "juni" => 6, "juli" => 7, "agustus" => 8, "september" => 9, "oktober" => 10, "november" => 11, "desember" => 12
);


    $path = $_FILES['excel']['tmp_name'];
    $reader = new \PhpOffice\PhpSpreadsheet\Reader\Xlsx();
    $spreadsheet = $reader->load($path); // Load file yang tadi diupload ke folder tmp
    $sheet = $spreadsheet->getActiveSheet()->toArray(null, true, true, true);

    // menghitung kolom dan baris
    $jml_baris = 1;
    $jml_kolom = 0;
    $kolom = ['A', 'B','C', 'D', 'E', 'F','G','H','I','J','K','L','M','N','O','P','Q','R','S','T','U','V','W','X','Y','Z','AA','AB','AC','AD','AE','AF','AG'];
    // hitung kolom
    while($sheet[3][$kolom[$jml_kolom+2]] != "" && $jml_kolom+1 < 31){
        $jml_kolom++;
    }

    $numrow = 3;
    $text = $sheet[2]['C'];
    $perintah = explode(" ",$text);
    $bln = preg_replace('/\s+/', '', $perintah[0]);
    $bln = strtolower($bln);
    $thnbln = $perintah[1] . "-" . $bulan[$bln] . "-";
    foreach($sheet as $row){
    // Ambil data pada excel sesuai Kolom
    $nomor = $row['A']; // Ambil data nomor
    $username = $row['B']; // Ambil data id
    // ambil id user
    $sql_id = $pdo->prepare("SELECT id FROM user_list WHERE nama_lengkap = '". $username ."' LIMIT 1");
    $sql_id->execute();
    $id_user = $sql_id->fetchAll();
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
    if($numrow > 3){
      // Loop -> Buat query Insert dan ambil data shift dari excel
        for($i=0; $i<=$jml_kolom; $i++){
            // ambil data shift
            $jadwal = strtoupper($row[$kolom[$i+2]]);

            // cek apakah kolom jadwal diisi sesuai dengan format
            

            // ambil id shift dari database
            $sql_shift = $pdo->prepare("SELECT id FROM level_shift WHERE kode LIKE '". $jadwal ."%' LIMIT 1");
            $sql_shift->execute();
            $id_shift = $sql_shift->fetchAll();
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
            $sql_cek_jadwal = $pdo->prepare("SELECT * FROM jadwal_dinas WHERE id_user = '" . $id . "' AND  tanggal = '" . $tgl . "'");
            $sql_cek_jadwal->execute();

            if($sql_cek_jadwal->fetchAll() == null && $sql_id != null && $sql_shift != null){// jika data sudah ada update
                // query insert
                $query = $pdo->prepare("INSERT INTO jadwal_dinas (id_user,tanggal,id_shift) VALUES('" . $id . "','" . $tgl . "' ,'" . $shift . "')");   
                $query->execute();
            }else {// jika data belum ada insert
                // query update
                $query = $pdo->prepare("UPDATE jadwal_dinas SET id_shift = '" . $shift . "' WHERE id_user = '" . $id . "' AND tanggal = '" . $tgl . "'");
                $query->execute();
            }
        }
    }

    $numrow++; // Tambah 1 setiap kali looping
  }

    



header('location: schedule.php'); // Redirect ke halaman awal