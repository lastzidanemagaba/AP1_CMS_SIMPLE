<!-----BODDY Header-->
<html>
<head>
<?php include 'header.php'; auth_menu("satuduatiga",session_level()); ?>

  <title>Security</title>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Detail Security</h1>
          </div>
          <!--div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item">Home</a></li>
              <li class="breadcrumb-item active"><a href="manpower">Security</a></li>
              <li class="breadcrumb-item active">Detail Security</li>
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
		  
			<?php
				$id_user = "0"; if(isset($_GET['user'])){ $id_user = $_GET['user']; }
				$result = mysqli_query($con,"SELECT user_list.id ID, user_list.nama_lengkap NAMA, user_list.no_hp TELP, 
					user_list.nip NIP, user_list.status STATUS,
					user_other.alamat ALAMAT, user_other.jenis_kelamin JK, user_other.sertifikat SERTIFIKAT, user_other.tgl_lahir TGL_LAHIR
					FROM user_list
					LEFT JOIN user_other ON user_other.id = user_list.id
					WHERE (md5(user_list.id) = '$id_user')");
					$no=1;
					while($h = mysqli_fetch_array($result)){
						if ($h['STATUS'] == 1){
							$h['status'] = 'Active';
						}else{
							$h['status'] = 'Nonactive';
						}
					

			?>
		  
            <!-- Horizontal Form -->
            <div class="card card-info">
              <div class="card-header">
                <!--h3 class="card-title">Horizontal Form</h3-->
              </div>
              <!-- /.card-header -->
              <!-- form start -->
				<div class="card-body">
				  <div class="form-group row">
					<label for="input" class="col-sm-2 col-form-label">Full Name <span style="color:red"> *</span></label>
					<div class="col-sm-10">
					  <label class="form-control"><?php echo $h['NAMA']; ?></label>
					</div>
				  </div>
				  <div class="form-group row">
					<label for="input" class="col-sm-2 col-form-label">Phone Number <span style="color:red"> *</span></label>
					<div class="col-sm-10">
					  <label class="form-control"><?php echo $h['TELP']; ?></label>
					</div>
				  </div>
				  <div class="form-group row">
					<label for="input" class="col-sm-2 col-form-label">Address <span style="color:red"> *</span></label>
					<div class="col-sm-10">
					  <label class="form-control"><?php echo $h['ALAMAT']; ?></label>
					</div>
				  </div>
				  <div class="form-group row">
					<label for="input" class="col-sm-2 col-form-label">Gender <span style="color:red"> *</span></label>
					<div class="col-sm-10">
					  <label class="form-control"><?php echo $h['JK']; ?></label>
					</div>
				  </div>
				  <div class="form-group row">
					<label for="input" class="col-sm-2 col-form-label">Certificate</label>
					<div class="col-sm-10">
					  <label class="form-control"><?php echo $h['SERTIFIKAT']; ?></label>
					</div>
				  </div>
				  <div class="form-group row">
					<label for="input" class="col-sm-2 col-form-label">Birth <span style="color:red"> *</span></label>
					<div class="col-sm-10">
					  <label class="form-control"><?php echo $h['TGL_LAHIR']; ?></label>
					</div>
				  </div>
				</div>
				<!-- /.card-footer -->
            </div>
            <!-- /.card -->
			
		  
            <div class="card">
              <!--div class="card-header">
                <h3 class="card-title">DataTable with minimal features & hover style</h3>
              </div-->
              <!-- /.card-header -->
              <div class="card-body">
                <table id="example1" class="table table-bordered table-hover">
                  <thead>
                  <tr>
                    <th>No</th>
                    <th>Location</th>
                    <!--th>Shift</th-->
                    <th>Time</th>
                    <th>Condition</th>
                  </tr>
                  </thead>
                  <tbody>
				  
				  <?php
					$result2 = mysqli_query($con,"SELECT tour_report.id ID, tour_report.id_shift SHIFT,
					tour_report.create_date CREATE_DATE, tour_report.id_kondisi KONDISI,
					subarea_list.subarea SUBAREA
					FROM tour_report
					LEFT JOIN subarea_list on subarea_list.id = tour_report.id_subarea
					WHERE (tour_report.create_by = ".$h['ID'].")
					ORDER BY tour_report.id DESC
					LIMIT 500");
					$no=1;
					while($i = mysqli_fetch_array($result2)){
						if($i['SHIFT']=="1"){ $i['SHIFT'] = "Pagi";	}else if($i['SHIFT']=="2"){ $i['SHIFT'] = "Siang"; }else{ $i['SHIFT'] = "Malam";}
						if($i['KONDISI']=="1"){ $i['KONDISI'] = "Aman";	}else if($i['KONDISI']=="2"){ $i['KONDISI'] = "Temuan"; }else{ $i['KONDISI'] = "Insiden";}

						echo"
						<tr>
							<td>".($no++)."</td>
							<td>$i[SUBAREA]</td>
							<!--td>$i[SHIFT]</td-->
							<td>$i[CREATE_DATE]</td>
							<td align='center'>$i[KONDISI]</td>
						</tr>";
					}
					}
				  ?>
				  
				  
                  </tbody>
                </table>
              </div>
              <!-- /.card-body -->
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



