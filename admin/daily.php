<!-----BODDY Header-->
<html>
<head>
<?php include 'header.php'; auth_menu("satuduatiga",session_level()); 

	$awal = ""; $awalnya = $hari; 
	$akhir = ""; $akhirnya = $hari;
	if(isset($_POST['tanggal'])){
		$tanggal = str_split($_POST['tanggal']);
		$awal = to_tanggal($tanggal,1);
		$awalnya = ke_tanggal($tanggal,1);
		$akhir = to_tanggal($tanggal,2);
		$akhirnya = ke_tanggal($tanggal,2);
	}

?>

  <title>Check Result</title>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Check Result</h1>
          </div>
          <!--div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active"Check Result <?php //echo get_project();?></li>
            </ol>
          </div-->
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            <div class="card">
              <!--div class="card-header">
                <h3 class="card-title">DataTable with minimal features & hover style</h3>
              </div-->
              <!-- /.card-header -->
              <div class="card-body">
				<div class="row">
					<div class="col-sm-6">
					<form action = "" method = "POST">						
						<div class="input-group">
							<div class="input-group-prepend">
							  <span class="input-group-text">
								<i class="far fa-calendar-alt"></i>
							  </span>
							<input name = "tanggal" type="text" class="form-control float-right" id="reportrange">&ensp;
							<button type="submit" class="btn btn-block btn-primary col-sm-3">Filter</button>
							</div>
						  </div>
					</form>
					</div>
				</div>
                <table id="example1" class="table table-bordered table-hover">
                  <thead>
                  <tr>
                    <th>No</th>
                    <th>Location</th>
                    <th>Condition</th>
                    <th>Time</th>
                    <th>Security Guard</th>
                    <th>Action</th>
                  </tr>
                  </thead>
                  <tbody>
				  
				  <?php
					if($awal == ""){
						$result = mysqli_query($con,"SELECT 
						tour_report.create_date CREATEDATE, tour_report.create_by BYY, tour_report.id_kondisi KONDISI, tour_report.id_subarea, 
						subarea_list.id ID, subarea_list.subarea SUBAREA, tour_report.id IDD,
						user_list.id, user_list.nama_lengkap NAMA
						FROM tour_report
						LEFT JOIN subarea_list on subarea_list.id = tour_report.id_subarea
						LEFT JOIN user_list on user_list.id = tour_report.create_by
						ORDER BY tour_report.id DESC LIMIT 500");
					}else if($awal != ""){						
						$result = mysqli_query($con,"SELECT 
						tour_report.create_date CREATEDATE, tour_report.create_by BYY, tour_report.id_kondisi KONDISI, tour_report.id_subarea, 
						subarea_list.id ID, subarea_list.subarea SUBAREA, tour_report.id IDD,
						user_list.id, user_list.nama_lengkap NAMA
						FROM tour_report
						LEFT JOIN subarea_list on subarea_list.id = tour_report.id_subarea
						LEFT JOIN user_list on user_list.id = tour_report.create_by
						WHERE (DATE(tour_report.create_date) BETWEEN '$awal' AND '$akhir')
						ORDER BY tour_report.id DESC LIMIT 500");
					}
					
					$no=1;
					while($row = mysqli_fetch_array($result)){
						if ($row['KONDISI'] == 1){
							$KONDISI = 'Aman';
						}else{
							$KONDISI = 'Temuan';
						}
						echo"
						<tr>
							<td>".($no++)."</td>
							<td>$row[SUBAREA]</td>
							<td>$KONDISI</td>
							<td>$row[CREATEDATE]</td>
							<td align='left'>$row[NAMA]</td>
							
							<td align='center'>
								<b>
								<a href='daily_act?daily=".md5($row['IDD'])."&status=".md5("hapus")."' class='btn btn-small btn-danger' onClick=\"return confirm('Do you want delete this data ?')\" >Delete</a>
								</b>
							</td>
							
						</tr>";
							
					}
				  
				  ?>
				  
				  
                  </tbody>
                </table>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->



            <!-- /.card -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
      </div>
      <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>

<?php include 'footer.php'; 
 
  if(isset($_GET['alert'])&&$_GET['alert']==md5("tambah")){
    alert("tambah");
  }else if(isset($_GET['alert'])&&$_GET['alert']==md5("update")){
    alert("update");
  }else if(isset($_GET['alert'])&&$_GET['alert']==md5("aktif")){
    alert("aktif");
  }else if(isset($_GET['alert'])&&$_GET['alert']==md5("nonaktif")){
    alert("nonaktif");
  }else if(isset($_GET['alert'])&&$_GET['alert']==md5("hapus")){
    alert("hapus");
  }else if(isset($_GET['alert'])&&$_GET['alert']==md5("gagal")){
    alert("gagal");
  }
  

  

?>

<script type="text/javascript">

$(function() {
	var start = "'<?php echo $awalnya; ?>'";
	var end = "'<?php echo $akhirnya; ?>'";

    function cb(start, end) {
        $('#reportrange span').html(start.format('D/M/YYYY') + ' - ' + end.format('D/M/YYYY'));
    }

    $('#reportrange').daterangepicker({
        startDate: start,
        endDate: end,
        ranges: {
           'Now': [moment(), moment()],
           'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
           '7 Days ago': [moment().subtract(6, 'days'), moment()],
           '30 Days ago': [moment().subtract(29, 'days'), moment()],
           'This Month': [moment().startOf('month'), moment().endOf('month')],
           'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
        }
    }, cb);

    cb(start, end);

});
</script>

