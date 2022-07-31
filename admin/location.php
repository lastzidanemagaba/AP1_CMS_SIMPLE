<!-----BODDY Header-->

<?php include 'header.php'; auth_menu("satuduatiga",session_level()); ?>

  <title>Location</title>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Location Data</h1>
          </div>
          <!--div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Lokasi <?php //echo get_project();?></li>
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
				<button type="button" class="btn btn-success" data-toggle="modal" data-target="#modal-add">Tambah data</button>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
				<div class="row">
					<div class="col-sm-8">	
						<div class="input-group">
							<button type="button" class="btn btn-block btn-success col-sm-3" href="#" data-toggle="modal" data-target="#modaladd"><i class="fas fa-plus">&ensp;</i>Add Location</button>
						</div>
					</div>
				</div></br>
                <table id="example1" class="table table-bordered table-hover">
                  <thead>
                  <tr>
                    <th>No</th>
                    <th>Location</th>
                    <th>Address</th>
                    <th>After Location</th>
                    <th>Status</th>
                    <th width='200'>Action</th>
                  </tr>
                  </thead>
                  <tbody>
				  
				  <?php
					$result = mysqli_query($con,"SELECT subarea_list.id ID, subarea_list.subarea SUBAREA, subarea_list.alamat ALAMAT, 
					subarea_list.status STATUS, subarea_list.create_date TANGGAL, subarea_list.tag TAG, subarea_list.setelah SETELAH, 
					area_list.area AREA
					FROM subarea_list
					LEFT JOIN area_list on area_list.id = subarea_list.id_area
					WHERE subarea_list.status != '2'");
					$no=1;
					while($row = mysqli_fetch_array($result)){
						if ($row['STATUS'] == 1){
							$row['status'] = 'Aktif';
						}else{
							$row['status'] = 'Non Aktif';
						}
						
						echo"<tr>
							<td >".($no++)."</td>
							<td>$row[SUBAREA]</td>
							<td>$row[ALAMAT]</td>";
							
						$ada = "Pertama";
						$result2 = mysqli_query($con,"SELECT * FROM subarea_list WHERE id='".$row['SETELAH']."' ");
						while($row2 = mysqli_fetch_array($result2)){
							$ada = $row2['subarea'];
						}
						
						echo"<td>$ada</td>";
							
						echo"<td align='center'>$row[status]</td>";
							
						if($row['STATUS'] == 1&&session_level()!="0"){
							echo"
							<td align='center'>
								<b>
								<a href='location_detail?lokasi=".md5($row['ID'])."' class='btn btn-small btn-primary'>Detail</a> |
								<a href='#' data-toggle='modal' data-target='#modaledit".$row["ID"]."' class='btn btn-small btn-warning' style='color:white'>Edit</a> |
								<a href='location_act?status=".md5("hapus")."&lokasi=".md5($row['ID'])."' class='btn btn-danger btn-small' onClick=\"return confirm('Do you want delete this data ?')\" >Delete</a>
								</b>
							</td>
						</tr>";
						}else if(session_level()!="0"){
							echo"
							<td align='center'>
								<b>
								<a href='location_act?status=".md5("aktifkan")."&lokasi=".md5($row['ID'])."' class='btn btn-primary btn-small' >Activation</a>
								</b>
							</td>
						</tr>";
						}else{
							echo"
							<td align='center'>
								<b>
								<a href='location_detail?lokasi=".md5($row['ID'])."' class='btn btn-small btn-primary'>Detail</a>
								</b>
							</td>
						</tr>";
							
						}
						?>
						
  <div id="modaledit<?php echo $row['ID']; ?>" class="modal fade">
	<div class="modal-dialog">
		<form action="location_act" method="post" enctype="multipart/form-data">
			<div class="modal-content">
				<div class="modal-header">Location Edit</div>
				<div class="modal-body">
					<div class="form-group">
						<label>Location <span style="color:red"> *</span></label>
						<input type="text" name="lokasi" value="<?php echo $row['SUBAREA'];?>" placeholder="lokasi" id="lokasi" class="form-control" required />
					</div>
					<div class="form-group">
						<label>Address <span style="color:red"> *</span></label>
						<input type="text" name="alamat" value="<?php echo $row['ALAMAT'];?>" placeholder="alamat" id="alamat" class="form-control" required />
					</div>
					<div class="form-group">
						<label>Tag <span style="color:red"> *</span></label>
						<input type="text" name="tag" value="<?php echo $row['TAG'];?>" placeholder="tag" id="tag" class="form-control" required />
					</div>
					<div class="form-group">
					  <label>After Location <span style="color:red"> *</span></label>
					  <select class="form-control select2" placeholder="setelah" style="width: 100%;" name="setelah">
						<option name = 'setelah' value = '0' <?php if($row['SETELAH']=="0"){ echo "selected"; } ?> >First</option>
						<?php
						$result2 = mysqli_query($con,"SELECT * FROM subarea_list WHERE id != '".$row['ID']."' ORDER BY id");
						while($row2 = mysqli_fetch_array($result2)){ ?>
							<option name = "setelah" value = "<?php echo $row2['id'];?>" <?php if($row['SETELAH']==$row2['id']){ echo "selected"; } ?> > <?php echo $row2['subarea']; ?></option>
							<?php
						}
					  ?>
					  </select>
					</div>
					<div class="form-group">
					  <label>Status <span style="color:red"> *</span></label>
					  <select class="form-control select2" placeholder="setelah" style="width: 100%;" name="aktif">
						<option name = 'aktif' value = '1' <?php if($row['STATUS']=="1"){ echo "selected"; } ?>>Active</option>
						<option name = 'aktif' value = '0' <?php if($row['STATUS']=="0"){ echo "selected"; } ?>>Nonactive</option>
					  </select>
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

          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
      </div>
      <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>		



  <div id="modaladd" class="modal fade">
	<div class="modal-dialog">
		<form action="location_act" method="post" enctype="multipart/form-data">
			<div class="modal-content">
				<div class="modal-header">
				</div>
				<div class="modal-body">
					<div class="form-group">
						<label>Location <span style="color:red"> *</span></label>
						<input type="text" name="lokasi" placeholder="location" id="lokasi" class="form-control" required />
					</div>
					<div class="form-group">
						<label>Address <span style="color:red"> *</span></label>
						<input type="text" name="alamat" placeholder="address" id="alamat" class="form-control" required />
					</div>
					<div class="form-group">
						<label>Tag <span style="color:red"> *</span></label>
						<input type="text" name="tag" placeholder="tag" id="tag" class="form-control" required />
					</div>
					<div class="form-group">
					  <label>After Location <span style="color:red"> *</span></label>
					  <select class="form-control select2" placeholder="setelah" style="width: 100%;" name="setelah">
						<option name = 'setelah' value = '0' >First</option>
						<?php
							$result = mysqli_query($con,"SELECT * FROM subarea_list ORDER BY subarea");
						$no=1;
						while($row = mysqli_fetch_array($result)){
							echo '<option name = "setelah" value = "'.$row['id'].'" >'.$row['subarea'].'</option>';
						}
					  ?>
					  </select>
					</div>
				</div>
				<div class="modal-footer">
					<input type="hidden" name="id" id="id" />
					<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
					<input type="submit" name="status" class="btn btn-success" value="Tambah" />
				</div>
			</div>
		</form>
	</div>
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



