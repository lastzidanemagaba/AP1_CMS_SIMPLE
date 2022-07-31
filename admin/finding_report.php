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

  <title>Finding Report</title>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Finding Report</h1>
          </div>
          <!--div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Temuan <?php //echo get_project();?></li>
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
                    <th>Description</th>
                    <th>Shift</th>
                    <th>Reporting Time</th>
                    <th>Informant</th>
                    <th>Image</th>
                    <th>Action</th>
                  </tr>
                  </thead>
                  <tbody>
				  
				  <?php
					if($awal == ""){
						$result = mysqli_query($con,"SELECT 
						temuan_report.id ID, temuan_report.deskripsi DESKRIPSI, temuan_report.id_shift SHIFT, 
						temuan_report.image IMAGE, temuan_report.create_date CREATE_DATE,
						subarea_list.subarea SUBAREA,
						user_list.nama_lengkap NAMA 
						FROM temuan_report
						LEFT JOIN subarea_list on subarea_list.id = temuan_report.id_subarea
						LEFT JOIN user_list on user_list.id = temuan_report.create_by
						ORDER BY temuan_report.id DESC LIMIT 100");
					}else if($awal != ""){
						$result = mysqli_query($con,"SELECT 
						temuan_report.id ID, temuan_report.deskripsi DESKRIPSI, temuan_report.id_shift SHIFT, 
						temuan_report.image IMAGE, temuan_report.create_date CREATE_DATE,
						subarea_list.subarea SUBAREA,
						user_list.nama_lengkap NAMA 
						FROM temuan_report
						LEFT JOIN subarea_list on subarea_list.id = temuan_report.id_subarea
						LEFT JOIN user_list on user_list.id = temuan_report.create_by
						WHERE (DATE(temuan_report.create_date) BETWEEN '$awal' AND '$akhir')
						ORDER BY temuan_report.id DESC LIMIT 100");
					}
					
					$no=1;
					while($row = mysqli_fetch_array($result)){
						if($row['SHIFT']=="1"){ $row['SHIFT'] = "Pagi";	}else if($row['SHIFT']=="2"){ $row['SHIFT'] = "Siang"; }else{ $row['SHIFT'] = "Malam";}
						
						$IMAGE = "../assets/upload/temuan/$row[IMAGE]";
						if($row["IMAGE"]!=""){$IMAGE= '<div id="portfolio" class="portfolio-item"><a href="'.$IMAGE.'" class="portfolio-popup">
						<img src="'.$IMAGE.'" class="img-thumbnail" width="150" height="150" id="gambar"></a></div>'; }else{ $IMAGE = ""; }
						
						echo"
						<tr>
							<td >".($no++)."</td>
							<td>$row[SUBAREA]</td>
							<td>$row[DESKRIPSI]</td>
							<td>$row[SHIFT]</td>
							<td>$row[CREATE_DATE]</td>
							<td>$row[NAMA]</td>
							<td>$IMAGE</td>";
							
						if(session_level()!="0"){
							echo"
							<td align='center'>
								<b>
								<a href='#' data-toggle='modal' data-target='#modaledit".$row["ID"]."' class='btn btn-small btn-warning' style='color:white'>Edit</a> |
								<a href='finding_act?finding=".md5($row['ID'])."&status=".md5("hapus")."' class='btn btn-danger btn-small' onClick=\"return confirm('Do you want delete this data ?')\" >Delete</a>
								</b>
							</td>
						</tr>";
						}
						?>
						
						
<div id="modaledit<?php echo $row['ID']; ?>" class="modal fade">
	<div class="modal-dialog">
		<form action="finding_act" method="post" enctype="multipart/form-data">
			<div class="modal-content">
				<div class="modal-header">Finding Report Edit</div>
				<div class="modal-body">
					<div class="form-group">
						<label>Description <span style="color:red"> *</span></label>
						<input type="text" name="deskripsi" value="<?php echo $row['DESKRIPSI'];?>" placeholder="description" id="description" class="form-control" required />
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