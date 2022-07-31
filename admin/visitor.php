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

  <title>Visitor</title>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Visitor</h1>
          </div>
          <!--div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Visitor <?php //echo get_project();?></li>
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
                    <th>Name</th>
                    <th>Corporation</th>
                    <th>Phone Number</th>
                    <th>Meet with</th>
                    <th>Purpose</th>
                    <th>Time</th>
                    <th>Operator</th>
					<?php
					if(session_level()!="0"){
						echo "<th>Action</th>";
					}
					?>
                  </tr>
                  </thead>
                  <tbody>
				  
				  <?php
					if($awal == ""){
						$result = mysqli_query($con,"SELECT visitor_report.id ID,
						visitor_report.nama VISITOR, visitor_report.perusahaan PERUSAHAAN,
						visitor_report.nomor NOMOR, visitor_report.bertemu BERTEMU,
						visitor_report.tujuan TUJUAN, visitor_report.create_date WAKTU,
						user_list.nama_lengkap NAMA
						FROM visitor_report
						LEFT JOIN user_list on user_list.id = visitor_report.create_by
						ORDER BY visitor_report.id DESC LIMIT 100");
					}else if($awal != ""){
						$result = mysqli_query($con,"SELECT visitor_report.id ID,
						visitor_report.nama VISITOR, visitor_report.perusahaan PERUSAHAAN,
						visitor_report.nomor NOMOR, visitor_report.bertemu BERTEMU,
						visitor_report.tujuan TUJUAN, visitor_report.create_date WAKTU,
						user_list.nama_lengkap NAMA
						FROM visitor_report
						LEFT JOIN user_list on user_list.id = visitor_report.create_by
						WHERE (DATE(visitor_report.create_date) BETWEEN '$awal' AND '$akhir')
						ORDER BY visitor_report.id DESC LIMIT 100");
					}
					
					
					
					$no=1;
					while($row = mysqli_fetch_array($result)){
						echo"
						<tr>
							<td>".($no++)."</td>
							<td>$row[VISITOR]</td>
							<td>$row[PERUSAHAAN]</td>
							<td>$row[NOMOR]</td>
							<td>$row[BERTEMU]</td>
							<td>$row[TUJUAN]</td>
							<td>$row[WAKTU]</td>
							<td align='center'>$row[NAMA]</td>";
							
						if(session_level()!="0"){
							echo"
							<td align='center'>
								<b>
								<a href='#' data-toggle='modal' data-target='#modaledit".$row["ID"]."' class='btn btn-small btn-warning' style='color:white'>Edit</a> |
								<a href='visitor_act?visitor=".md5($row['ID'])."&status=".md5("hapus")."' class='btn btn-danger btn-small' onClick=\"return confirm('Do you want delete this data ?')\" >Delete</a>
								</b>
							</td>
						</tr>";
						}
						?>
						
						
  <div id="modaledit<?php echo $row['ID']; ?>" class="modal fade">
	<div class="modal-dialog">
		<form action="visitor_act" method="post" enctype="multipart/form-data">
			<div class="modal-content">
				<div class="modal-header">Visitor Edit</div>
				<div class="modal-body">
					<div class="form-group">
						<label>Name <span style="color:red"> *</span></label>
						<input type="text" name="nama" value="<?php echo $row['VISITOR'];?>" placeholder="name" id="name" class="form-control" required />
					</div>
					<div class="form-group">
						<label>Corporation <span style="color:red"> *</span></label>
						<input type="text" name="perusahaan" value="<?php echo $row['PERUSAHAAN'];?>" placeholder="corporation" id="alamat" class="form-control" required />
					</div>
					<div class="form-group">
						<label>Phone Number <span style="color:red"> *</span></label>
						<input type="text" name="nomor" value="<?php echo $row['NOMOR'];?>" placeholder="phone number" id="tag" class="form-control" required />
					</div>
					<div class="form-group">
						<label>Meet with <span style="color:red"> *</span></label>
						<input type="text" name="bertemu" value="<?php echo $row['BERTEMU'];?>" placeholder="meet with" id="tag" class="form-control" required />
					</div>
					<div class="form-group">
						<label>Purpose <span style="color:red"> *</span></label>
						<input type="text" name="tujuan" value="<?php echo $row['TUJUAN'];?>" placeholder="purpose" id="tag" class="form-control" required />
					</div>
					
				</div>
				<div class="modal-footer">
					<input type="hidden" name="id" id="id" value="<?php echo md5($row['ID']);  ?>" />
					<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
					<input type="submit" name="status" class="btn btn-success" value="Edit" />
				</div>
			</div>
		</form>
	</div>
</div>						
						
						
						
						
						
						
						
						
						
						
						
						
						
						
						
						
						
						<?php
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
