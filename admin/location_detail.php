<!-----BODDY Header-->
<html>
<head>
<?php include 'header.php'; auth_menu("satuduatiga",session_level()); ?>

  <title>Location</title>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Location Detail</h1>
          </div>
          <!--div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item">Home</li>
              <li class="breadcrumb-item active"><a href="location">Lokasi</a></li>
              <li class="breadcrumb-item active">Detail Lokasi</li>
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
				$lokasi = "0"; if(isset($_GET['lokasi'])){ $lokasi = $_GET['lokasi']; }
				$result = mysqli_query($con,"SELECT subarea_list.id ID,	subarea_list.subarea SUBAREA, 
					subarea_list.status STATUS, subarea_list.alamat ALAMAT,  subarea_list.setelah SETELAH, 
					area_list.area AREA
					FROM subarea_list
					LEFT JOIN area_list on area_list.id = subarea_list.id_area
					WHERE (md5(subarea_list.id) = '$lokasi')");
					while($row = mysqli_fetch_array($result)){
						$result2 = mysqli_query($con,"SELECT subarea, id FROM subarea_list
						WHERE ((subarea_list.id) = '".$row['SETELAH']."')"); $SETELAH = "Pertama";
						while($row2 = mysqli_fetch_array($result2)){
							$SETELAH = $row2['subarea'];
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
					<label for="input" class="col-sm-2 col-form-label">Location <span style="color:red"> *</span></label>
					<div class="col-sm-10">
					  <label class="form-control"><?php echo $row['SUBAREA']; ?></label>
					</div>
				  </div>
				  <div class="form-group row">
					<label for="input" class="col-sm-2 col-form-label">Address <span style="color:red"> *</span></label>
					<div class="col-sm-10">
					  <label class="form-control"><?php echo $row['ALAMAT']; ?></label>
					</div>
				  </div>
				  <div class="form-group row">
					<label for="input" class="col-sm-2 col-form-label">Location After <span style="color:red"> *</span></label>
					<div class="col-sm-10">
					  <label class="form-control"><?php echo $SETELAH; ?></label>
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
                    <!--th>Shift</th-->
                    <th>Time</th>
                    <th>Security Guard</th>
                    <th>Condition</th>
                  </tr>
                  </thead>
                  <tbody>
				  
				  <?php
					$result2 = mysqli_query($con,"SELECT tour_report.id ID, tour_report.id_shift SHIFT,
					tour_report.create_date CREATE_DATE, tour_report.id_kondisi KONDISI,
					user_list.nama_lengkap NAMA
					FROM tour_report
					LEFT JOIN user_list on user_list.id = tour_report.create_by
					WHERE (tour_report.id_subarea = ".$row['ID'].")
					ORDER BY tour_report.id DESC
					LIMIT 500");
					$no=1;
					while($i = mysqli_fetch_array($result2)){
						if($i['SHIFT']=="1"){ $i['SHIFT'] = "Pagi";	}else if($i['SHIFT']=="2"){ $i['SHIFT'] = "Siang"; }else{ $i['SHIFT'] = "Malam";}
						if($i['KONDISI']=="1"){ $i['KONDISI'] = "Aman";	}else if($i['KONDISI']=="2"){ $i['KONDISI'] = "Temuan"; }else{ $i['KONDISI'] = "Insiden";}

						echo"
						<tr>
							<td>".($no++)."</td>
							<!--td>$i[SHIFT]</td-->
							<td>$i[CREATE_DATE]</td>
							<td>$i[NAMA]</td>
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



