<?php
include '../config/koneksi.php'; 

require('../vendor/autoload.php');


// Include librari PhpSpreadsheet
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

$spreadsheet = new Spreadsheet();
$sheet = $spreadsheet->getActiveSheet();

// ambil tanggal dari inputan
$hasiltangkap = $_POST['thn']."-".$_POST['bln']."-01";
$tanggal = $hasiltangkap;
$thnbln =  explode("-", $tanggal);
// ambil hari terakhir dr bulan inputan
$hari = date("Y-m-t", strtotime($tanggal));
$hari = (int) explode("-", $hari)[2];
// array untuk keperluan tanggal
$kolom = ['C', 'D', 'E', 'F','G','H','I','J','K','L','M','N','O','P','Q','R','S','T','U','V','W','X','Y','Z','AA','AB','AC','AD','AE','AF','AG'];
$bulan = array(
    "januari", "februari", "maret", "april", "mei", "juni", "juli", "agustus", "september", "oktober", "november" , "desember"
);
$baris = 3;
// Buat sebuah variabel untuk menampung pengaturan style dari header tabel
$sheet->setCellValue('A1', "Tahun ".$thnbln[0]. " Bulan ".strtoupper($bulan[(int) $thnbln[1]-1]));
$sheet->setCellValue('B2', "Nama");  
for($i = 0; $i<$hari; $i++){
    $sheet->setCellValue($kolom[$i] . '2',  $i+1);
}


// Apply style header yang telah kita buat tadi ke masing-masing kolom header


// Set height baris ke 1, 2 dan 3
$sheet->getRowDimension('1')->setRowHeight(20);
$sheet->getRowDimension('2')->setRowHeight(20);
$sheet->getRowDimension('3')->setRowHeight(20);

// definisikan bulan
//$tgl = date('Y-m');
//if(isset($_POST['bln'])){
$tgl = date('Y-m', strtotime($tanggal));
//}

// Buat query untuk menampilkan semua data siswa
$sql = mysqli_query($con,"SELECT jadwal_dinas.id ID,jadwal_dinas.id_user, jadwal_dinas.tanggal TANGGAL, jadwal_dinas.id_shift ID_SHIFT, user_list.nama_lengkap NAMA, level_shift.shift SHIFT, level_shift.kode KODE FROM jadwal_dinas LEFT JOIN user_list on user_list.id = jadwal_dinas.id_user LEFT JOIN level_shift on level_shift.id = jadwal_dinas.id_shift WHERE jadwal_dinas.tanggal LIKE '".$tgl."%';");
$sql_user = mysqli_query($con,"SELECT nama_lengkap,id,username FROM user_list WHERE user_list.id_level = '4' ORDER BY id ASC;");

$no = 1; // Untuk penomoran tabel, di awal set dengan 1
$row = 3; // Set baris pertama untuk isi tabel adalah baris ke 4
// agar loop bisa berulang denga normal
$dt = $sql_user;
$dt2 = $sql->fetch_all(MYSQLI_ASSOC);

while ($data = mysqli_fetch_array($dt)) { // Ambil semua data dari hasil eksekusi $sql_user

    $sheet->setCellValue('A' . $row, $no);
    $sheet->setCellValue('B' . $row, $data['username']);

    foreach ($dt2 as $data2) { // Ambil semua data dari hasil eksekusi $sql untuk ambil data jadwal
        $tgl = (int) explode("-",$data2['TANGGAL'])[2];
        $index = $tgl-1;
        if($data2['id_user'] == $data['id']){
            $sheet->setCellValue($kolom[$index] . $row, $data2['KODE']);    
        }
    }

    $no++; // Tambah 1 setiap kali looping
    $row++; // Tambah 1 setiap kali looping
}

$spreadsheet->getActiveSheet()->getColumnDimension('B')->setAutoSize(true);
$spreadsheet->getActiveSheet()->getColumnDimension('C')->setWidth('3');
$spreadsheet->getActiveSheet()->getColumnDimension('D')->setWidth('3');
$spreadsheet->getActiveSheet()->getColumnDimension('E')->setWidth('3');
$spreadsheet->getActiveSheet()->getColumnDimension('F')->setWidth('3');
$spreadsheet->getActiveSheet()->getColumnDimension('G')->setWidth('3');
$spreadsheet->getActiveSheet()->getColumnDimension('H')->setWidth('3');
$spreadsheet->getActiveSheet()->getColumnDimension('I')->setWidth('3');
$spreadsheet->getActiveSheet()->getColumnDimension('J')->setWidth('3');
$spreadsheet->getActiveSheet()->getColumnDimension('K')->setWidth('3');
$spreadsheet->getActiveSheet()->getColumnDimension('L')->setWidth('3');
$spreadsheet->getActiveSheet()->getColumnDimension('M')->setWidth('3');
$spreadsheet->getActiveSheet()->getColumnDimension('N')->setWidth('3');
$spreadsheet->getActiveSheet()->getColumnDimension('O')->setWidth('3');
$spreadsheet->getActiveSheet()->getColumnDimension('P')->setWidth('3');
$spreadsheet->getActiveSheet()->getColumnDimension('Q')->setWidth('3');
$spreadsheet->getActiveSheet()->getColumnDimension('R')->setWidth('3');
$spreadsheet->getActiveSheet()->getColumnDimension('S')->setWidth('3');
$spreadsheet->getActiveSheet()->getColumnDimension('T')->setWidth('3');
$spreadsheet->getActiveSheet()->getColumnDimension('U')->setWidth('3');
$spreadsheet->getActiveSheet()->getColumnDimension('V')->setWidth('3');
$spreadsheet->getActiveSheet()->getColumnDimension('W')->setWidth('3');
$spreadsheet->getActiveSheet()->getColumnDimension('X')->setWidth('3');
$spreadsheet->getActiveSheet()->getColumnDimension('Y')->setWidth('3');
$spreadsheet->getActiveSheet()->getColumnDimension('Z')->setWidth('3');
$spreadsheet->getActiveSheet()->getColumnDimension('AA')->setWidth('3');
$spreadsheet->getActiveSheet()->getColumnDimension('AB')->setWidth('3');
$spreadsheet->getActiveSheet()->getColumnDimension('AC')->setWidth('3');
$spreadsheet->getActiveSheet()->getColumnDimension('AD')->setWidth('3');
$spreadsheet->getActiveSheet()->getColumnDimension('AE')->setWidth('3');
$spreadsheet->getActiveSheet()->getColumnDimension('AF')->setWidth('3');
$spreadsheet->getActiveSheet()->getColumnDimension('AG')->setWidth('3');


// Set orientasi kertas jadi LANDSCAPE
$sheet->getPageSetup()->setOrientation(\PhpOffice\PhpSpreadsheet\Worksheet\PageSetup::ORIENTATION_LANDSCAPE);

// Set judul file excel nya
$filename = date('Y-m-d-His'). '-FormatDinas';
$sheet->setTitle($filename);
// Proses file excel
header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment;filename=' . $filename . '.xlsx');
header('Cache-Control: max-age=0');

$writer = new Xlsx($spreadsheet);
$writer->save('php://output');


?>