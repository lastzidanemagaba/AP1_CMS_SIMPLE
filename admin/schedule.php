<!-----BODDY Header-->

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

  <title>Schedule</title>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Schedule</h1>
          </div>
          <!--div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Setting</a></li>
              <li class="breadcrumb-item active">Schedule <?php //echo get_project();?></li>
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
			  <div class="card-header">
			  	<form method="POST" action="schedule_excel.php">
					<div class="col-md-12">
							<label for="bln">Upload Schedule</label>
							<div class="form-row">
									<div class="form-group col-lg-3">
										<label>Bulan</label>
										<select class="form-control" placeholder="bln"  id="bln" name="bln"  required>
											<option value="">- Pilih Bulan -</option>
											<option value="01">Januari</option>
											<option value="02">Februari</option>
											<option value="03">Maret</option>
											<option value="04">April</option>
											<option value="05">Mei</option>
											<option value="06">Juni</option>
											<option value="07">Juli</option>
											<option value="08">Agustus</option>
											<option value="09">September</option>
											<option value="10">Oktober</option>
											<option value="11">November</option>
											<option value="12">Desember</option>
										</select>
									</div>
									<div class="form-group col-lg-3">
										<label>Tahun</label>
										<select class="form-control" placeholder="thn"  id="thn" name="thn"  required>
											<option value="">- Pilih Tahun -</option>
											<option value="2021">2021</option>
											<option value="2022">2022</option>
										</select>
									</div>
									<div class="form-group col-lg-3">
										<label>Format Import <span style="color:red"> *</span></label>
										<button href="schedule_excel.php" class="form-control btn btn-default"><i class="fas fa-download"></i> Format Import Excel</button>
									</div>
									<div class="form-group col-lg-3">
										<label>Import Excel <span style="color:red"> *</span></label>
										<a href="#" data-toggle="modal" data-target="#modalimport" class="form-control btn btn-default"><i class="fas fa-upload"></i> Import Excel</a>
									</div>
						</div>
					</form>
				</div>
			  </div>
		    </div>
		  </div>
		</div>
        <div class="row">
          <div class="col-12">
            <div class="card">
              <!-- /.card-header -->
              <div class="card-body">
				<div class="row">
					<div class="col-sm-10">
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
					<div class="col-sm-2">
						<button type="button" class="btn btn-block btn-success" href="#" data-toggle="modal" data-target="#modaladd"><i class="fas fa-plus">&ensp;</i>Add Schedule</button></br>
					</div>
				</div>
                <table id="example1" class="table table-bordered table-hover">
                  <thead>
                  <tr>
                    <th>No</th>
                    <th>Nama</th>
                    <th>Tanggal</th>
                    <th>Shift</th>
					<th>Action</th>
					
                  </tr>
                  </thead>
                  <tbody>
				  
				  <?php
					if($awal == ""){
						$result = mysqli_query($con,"SELECT jadwal_dinas.id ID,jadwal_dinas.id_user, 
						jadwal_dinas.tanggal TANGGAL, jadwal_dinas.id_shift ID_SHIFT,
						user_list.nama_lengkap NAMA, level_shift.shift SHIFT, level_shift.kode KODE
						FROM jadwal_dinas
						LEFT JOIN user_list on user_list.id = jadwal_dinas.id_user
						LEFT JOIN level_shift on level_shift.id = jadwal_dinas.id_shift
						ORDER BY jadwal_dinas.tanggal DESC, jadwal_dinas.id_shift DESC");
					}else if($awal != ""){
						$result = mysqli_query($con,"SELECT jadwal_dinas.id ID,jadwal_dinas.id_user, 
						jadwal_dinas.tanggal TANGGAL, jadwal_dinas.id_shift ID_SHIFT,
						user_list.nama_lengkap NAMA, level_shift.shift SHIFT, level_shift.kode KODE
						FROM jadwal_dinas
						LEFT JOIN user_list on user_list.id = jadwal_dinas.id_user
						LEFT JOIN level_shift on level_shift.id = jadwal_dinas.id_shift
						WHERE (DATE(jadwal_dinas.tanggal) BETWEEN '$awal' AND '$akhir')
						ORDER BY jadwal_dinas.tanggal DESC, jadwal_dinas.id_shift DESC");
					}
					$no=1;
					while($row = mysqli_fetch_array($result)){
						echo"
						<tr>
							<td>".($no++)."</td>
							<td>$row[NAMA]</td>
							<td>$row[TANGGAL]</td>
							<td>$row[SHIFT]</td>";
							
						echo"
						<td align='center'>
							<b>
							<a href='#' data-toggle='modal' data-target='#modaledit".$row["ID"]."' class='btn btn-small btn-warning' style='color:white'>Edit</a> |
							<a href='schedule_act?status=".md5("hapus")."&jadwal=".md5($row['ID'])."' class='btn btn-danger btn-small'  onClick=\"return confirm('Anda yakin ingin menghapus nomor ini ?')\" >Hapus</a>
							</b>
						</td>
						</tr>";
						?>
						
		<div id="modaledit<?php echo $row['ID']; ?>" class="modal fade">
			<div class="modal-dialog">
				<form action="schedule_act" method="post" enctype="multipart/form-data">
					<div class="modal-content">
						<div class="modal-header">Tambah Jadwal Dinas</div>
						<div class="modal-body">
							<div class="form-group">
								<label>Nama</label>
								<input type="text" name="id_user" value="<?php echo $row['NAMA']; ?>" placeholder="nama" id="nama" class="form-control" readonly />
							</div>
							<div class="form-group">
								<label>Tanggal <span style="color:red"> *</span></label>
								<input type="date" name="tanggal" value="<?php echo $row['TANGGAL']; ?>" placeholder="tanggal" id="tanggal" class="form-control" required/>
							</div>
							<div class="form-group">
							  <label>Shift <span style="color:red"> *</span></label>
								<select class="form-control select2" placeholder="id_shift" style="width: 100%;" name="id_shift">
									<?php
									$result2 = mysqli_query($con,"SELECT * FROM level_shift");
									while($row2 = mysqli_fetch_array($result2)){ ?>
										<option name = "id_shift" value = "<?php echo $row2['id'];?>" <?php if($row['ID_SHIFT']==$row2['id']){ echo "selected"; } ?>> <?php echo $row2['shift']; ?></option>
										<?php
									}
								  ?>
								</select>	
							</div>
						</div>
						<div class="modal-footer">
							<input type="hidden" name="id" id="id" value="<?php echo md5($row['ID']); ?>"/>
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


<div id="modalimport" class="modal fade">
	<div class="modal-dialog">
		<form action="schedule_excelimport.php" method="post" enctype="multipart/form-data">
			<div class="modal-content">
				<div class="modal-header">Import Excel</div>
				<div class="modal-body">
					<div class="form-group">
							<input type="file" class="form-control" id="excel" name="excel" aria-describedby="sizing-addon2" required>
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
					<input type="submit"  class="btn btn-success" value="Submit" />
				</div>
			</div>
		</form>
	</div>
</div>



<div id="modaladd" class="modal fade">
	<div class="modal-dialog">
		<form action="schedule_act" method="post" enctype="multipart/form-data">
			<div class="modal-content">
				<div class="modal-header">Add Schedule</div>
				<div class="modal-body">
					<div class="form-group">
						<label>Name <span style="color:red"> *</span></label>
						<select class="form-control select2" placeholder="nama" style="width: 100%;" name="id_user">
							<?php
							$result2 = mysqli_query($con,"SELECT * FROM user_list WHERE id_level = '4' ORDER BY nama_lengkap");
							while($row2 = mysqli_fetch_array($result2)){ ?>
								<option name = "id_user" value = "<?php echo $row2['id'];?>"> <?php echo $row2['nama_lengkap']; ?></option>
								<?php
							}
						  ?>
						</select>					
					</div>
					<div class="form-group">
						<label>Date <span style="color:red"> *</span></label>
						<input type="date" name="tanggal" placeholder="tanggal" id="tanggal" class="form-control" required />
					</div>
					<div class="form-group">
						<label>Shift <span style="color:red"> *</span></label>
						<select class="form-control select2" placeholder="id_shift" style="width: 100%;" name="id_shift">
							<?php
							$result2 = mysqli_query($con,"SELECT * FROM level_shift");
							while($row2 = mysqli_fetch_array($result2)){ ?>
								<option name = "id_shift" value = "<?php echo $row2['id'];?>"> <?php echo $row2['shift']; ?></option>
								<?php
							}
						  ?>
						</select>	
					</div>
				</div>
				<div class="modal-footer">
					<input type="hidden" name="id" id="id" />
					<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
					<input type="submit" name="status" class="btn btn-success" value="Add" />
				</div>
			</div>
		</form>
	</div>
</div>







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


<?php include 'footer.php'; ?>

<?php
 
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

$(document).ready(function() {
  $('#tenant').change(function() { // Jika select box id kurir dipilih
       var tenant = $(this).val(); // Ciptakan variabel kurir
        $.ajax({
            type: 'POST', // Metode pengiriman data menggunakan POST
          url: 'EWaste2.php', // File pemroses data
           data: 'tenant=' + tenant, // Data yang akan dikirim ke file pemroses yaitu ada 2 data
           success: function(response) { // Jika berhasil
              $('#awal').val(response); // Berikan hasilnya ke id awal
            }
       });
    });
  });
  
</script>



