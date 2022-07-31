<!-----BODDY Header-->
<html>
<head>
<?php include 'header.php'; auth_menu("satuduatiga",session_level()); ?>

  <title>SOS Number</title>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Data SOS Number</h1>
          </div>
          <!--div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Nomor SOS <?php //echo get_project();?></li>
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
							<button type="button" class="btn btn-block btn-success col-sm-3" href="#" data-toggle="modal" data-target="#modaladd"><i class="fas fa-plus">&ensp;</i>SOS Number Add</button>
						</div>
					</div>
				</div></br>
                <table id="example1" class="table table-bordered table-hover">
                  <thead>
                  <tr>
                    <th>No</th>
                    <th>Name</th>
                    <th>Number</th>
					<th>Action</th>
					
                  </tr>
                  </thead>
                  <tbody>
				  
				  <?php
					$result = mysqli_query($con,"SELECT * FROM nomor_list WHERE status != '2'");
					$no=1;
					while($row = mysqli_fetch_array($result)){
						echo"
						<tr>
							<td>".($no++)."</td>
							<td>$row[nama]</td>
							<td>$row[nomor]</td>";
							
						if($row['status'] == 1&&session_level()!="0"){
							echo"
							<td align='center'>
								<b>
								<a href='#' data-toggle='modal' data-target='#modaledit".$row["id"]."' class='btn btn-small btn-warning' style='color:white'>Edit</a> |
								<a href='sos_act?status=".md5("hapus")."&nomor=".md5($row['id'])."' class='btn btn-danger btn-small'  onClick=\"return confirm('Do you want delete this data ?')\" >Delete</a>
								</b>
							</td>
						</tr>";
						}else if(session_level()!="0"){
							echo"
							<td align='center'>
								<b>
								<a href='#' data-toggle='modal' data-target='#modaledit".$row["id"]."' class='btn btn-small btn-warning' style='color:white'>Edit</a> |
								<a href='sos_act?status=".md5("aktifkan")."&nomor=".md5($row['id'])."' class='btn btn-primary btn-small' >Activation</a>
								</b>
							</td>
						</tr>";
						}
						?>
						
		<div id="modaledit<?php echo $row['id']; ?>" class="modal fade">
			<div class="modal-dialog">
				<form action="sos_act" method="post" enctype="multipart/form-data">
					<div class="modal-content">
						<div class="modal-header">SOS Number Edit</div>
						<div class="modal-body">
							<div class="form-group">
								<label>Name <span style="color:red"> *</span></label>
								<input type="text" name="nama" value="<?php echo $row['nama']; ?>" placeholder="name" id="nama" class="form-control" required />
							</div>
							<div class="form-group">
								<label>Number <span style="color:red"> *</span></label>
								<input type="text" name="nomor" value="<?php echo $row['nomor']; ?>" placeholder="number" id="nomor" class="form-control" required  onkeypress="return event.charCode >= 48 && event.charCode <=57" />
							</div>
							<div class="form-group">
							  <label>Status <span style="color:red"> *</span></label>
							  <select class="form-control" style="width: 100%;" name="aktif">
								<option name = 'aktif' value = '1' <?php if($row['status']=="1"){ echo "selected"; } ?>>Active</option>
								<option name = 'aktif' value = '0' <?php if($row['status']=="0"){ echo "selected"; } ?>>Nonactive</option>
							  </select>
							</div>
						</div>
						<div class="modal-footer">
							<input type="hidden" name="id" id="id" value="<?php echo md5($row['id']); ?>"/>
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





<div id="modaladd" class="modal fade">
	<div class="modal-dialog">
		<form action="sos_act" method="post" enctype="multipart/form-data">
			<div class="modal-content">
				<div class="modal-header">SOS Number Add</div>
				<div class="modal-body">
					<div class="form-group">
						<label>Name <span style="color:red"> *</span></label>
						<input type="text" name="nama" placeholder="name" id="nama" class="form-control" required />
					</div>
					<div class="form-group">
						<label>Number <span style="color:red"> *</span></label>
						<input type="text" name="nomor" placeholder="number" id="nomor" class="form-control" required onkeypress="return event.charCode >= 48 && event.charCode <=57" />
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



