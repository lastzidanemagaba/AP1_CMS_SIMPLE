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
            <h1>Security Data</h1>
          </div>
          <!--div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Security <?php //echo get_project();?></li>
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
							<button type="button" class="btn btn-block btn-success col-sm-3" href="#" data-toggle="modal" data-target="#modaladd"><i class="fas fa-plus">&ensp;</i>Add User</button>
						</div>
					</div>
				</div></br>
                <table id="example1" class="table table-bordered table-hover">
                  <thead>
                  <tr>
                    <th>No</th>
                    <th>Name</th>
                    <th>Number Phone</th>
                    <th>Address</th>
                    <th>Gender</th>
                    <th>Certificate</th>
                    <th>Birth</th>
                    <th>Status</th>
                    <th>Action</th>
                  </tr>
                  </thead>
                  <tbody>
				  
				  <?php
					$result = mysqli_query($con,"SELECT user_list.id ID,
					user_list.nama_lengkap NAMA, user_list.username USERNAME, user_list.no_hp NO_HP, user_list.nip NIP, user_list.status STATUS,
					user_other.alamat ALAMAT, user_other.jenis_kelamin KELAMIN, user_other.sertifikat SERTIFIKAT, 
					user_other.tgl_lahir LAHIR 
					FROM user_list
					LEFT JOIN user_other on user_other.id = user_list.id
					WHERE (user_list.id_level = '4' AND user_list.status != '2')");
					$no=1;
					while($row = mysqli_fetch_array($result)){
						if ($row['STATUS'] == 1){
							$STATUS = 'Active';
						}else{
							$STATUS = 'Nonactive';
						}
						
						if ($row['KELAMIN'] == 1){
							$KELAMIN = 'Male';
						}else{
							$KELAMIN = 'Female';
						}
						
						
						
						echo"
						<tr>
							<td>".($no++)."</td>
							<td>$row[NAMA]</td>
							<td>$row[NO_HP]</td>
							<td>$row[ALAMAT]</td>
							<td>$KELAMIN</td>
							<td>$row[SERTIFIKAT]</td>
							<td>$row[LAHIR]</td>
							<td align='center'>$STATUS</td>
							<td align='center'>
							<a href='security_detail?user=".md5($row['ID'])."' class='btn btn-small btn-primary'>Detail</a> |
							<b>";
							
						if($row['STATUS'] == 1&&session_level()!="0"){
							echo"
								<b>
								<a href='#' data-toggle='modal' data-target='#modaledit".$row["ID"]."' class='btn btn-small btn-warning' style='color:white'>Edit</a></br> 
								<a href='#' data-toggle='modal' data-target='#modalreset".$row["ID"]."' class='btn btn-secondary btn-small'>Reset</a> |
								<a href='security_act?security=".md5($row['ID'])."&status=".md5("hapus")."' class='btn btn-danger btn-small' onClick=\"return confirm('Do you want delete this data ?')\" >Delete</a>
								</b>";
						}else if(session_level()!="0"){
							echo"
								<b>
								<a href='#' data-toggle='modal' data-target='#modaledit".$row["ID"]."' class='btn btn-small btn-warning' style='color:white'>Edit</a> |
								<a href='security_act?security=".md5($row['ID'])."&status=".md5("aktifkan")."' class='btn btn-primary btn-small'>Activation</a>
								</b>";
						}
						
						echo "</tr>"; ?>
						
	<div id="modaledit<?php echo $row['ID']; ?>" class="modal fade">
		<div class="modal-dialog">
			<form action="security_act" method="post" enctype="multipart/form-data">
				<div class="modal-content">
					<div class="modal-header">
					</div>
					<div class="modal-body">
						<div class="form-group">
							<label>Full Name <span style="color:red"> *</span></label>
							<input type="text" name="nama_lengkap" placeholder="full name" value="<?php echo $row['NAMA'];?>" class="form-control" required />
						</div>
						<div class="form-group">
							<label>Username <span style="color:red"> *</span></label>
							<input type="text" name="username" placeholder="username" id="username" value="<?php echo $row['USERNAME'];?>" class="form-control" required />
						</div>
						<div class="form-group">
							<label>Phone Number <span style="color:red"> *</span></label>
							<input type="text" name="no_hp" placeholder="no hp" id="no_hp" value="<?php echo $row['NO_HP'];?>" class="form-control" required  onkeypress="return event.charCode >= 48 && event.charCode <=57" />
						</div>
						<div class="form-group">
							<label>Address <span style="color:red"> *</span></label>
							<input type="text" name="alamat" placeholder="alamat" id="alamat" value="<?php echo $row['ALAMAT'];?>" class="form-control" required />
						</div>
						<div class="form-group">
							<label>Gender <span style="color:red"> *</span></label>
							<select class="form-control" placeholder="id_level" style="width: 100%;" name="jenis_kelamin">
								<option name = "jenis_kelamin" value = "1" <?php if($row["KELAMIN"]==1){ echo "selected"; } ?> >Male</option>
								<option name = "jenis_kelamin" value = "2" <?php if($row["KELAMIN"]==2){ echo "selected"; } ?> >Female</option>
							</select>
						</div>
						<div class="form-group">
							<label>Certificate</label>
							<input type="text" name="sertifikat" placeholder="certificate" id="sertifikat" value="<?php echo $row['SERTIFIKAT'];?>" class="form-control" />
						</div>
						<div class="form-group">
							<label>Birth <span style="color:red"> *</span></label>
							<input type="date" name="tgl_lahir" placeholder="birth" id="tgl_lahir" value="<?php echo $row['LAHIR'];?>" class="form-control" required />
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

	
	<div id="modalreset<?php echo $row['ID']; ?>" class="modal fade">
		<div class="modal-dialog">
			<form action="security_act" method="post" enctype="multipart/form-data">
				<div class="modal-content">
					<div class="modal-header">Reset Password</div>
					<div class="modal-body">
						<div class="form-group">
							<label>Username</label>
							<input type="text" name="username"value="<?php echo $row['USERNAME'];  ?>" class="form-control" readonly />
						</div>
						<div class="form-group">
							<label>Password <span style="color:red"> *</span></label>
							<input type="password" name="password" placeholder="password" value="" class="form-control" required />
						</div>
						<div class="form-group">
							<label>Re-password <span style="color:red"> *</span></label>
							<input type="password" name="repassword" placeholder="re-password" value="" class="form-control" required />
						</div>  
					</div>
					<div class="modal-footer">
					<input type="hidden" name="id" id="id" value="<?php echo md5($row['ID']);  ?>" />
						<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
						<input type="submit" name="status" class="btn btn-secondary" value="Reset" />
					</div>
				</div>
			</form>
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
		<form action="security_act" method="post" enctype="multipart/form-data">
			<div class="modal-content">
				<div class="modal-header">
				</div>
				<div class="modal-body">
					<div class="form-group">
						<label>Full Name <span style="color:red"> *</span></label>
						<input type="text" name="nama_lengkap" placeholder="nama lengkap" id="nama_lengkap" class="form-control" required />
					</div>
					<div class="form-group">
						<label>Username <span style="color:red"> *</span></label>
						<input type="text" name="username" placeholder="username" id="username" class="form-control" required />
					</div>
					<div class="form-group">
						<label>Password <span style="color:red"> *</span></label>
						<input type="password" name="password" placeholder="password" id="password" class="form-control" required />
					</div>
					<div class="form-group">
						<label>Re-password <span style="color:red"> *</span></label>
						<input type="password" name="repassword" placeholder="repassword" id="repassword" class="form-control" required />
					</div>
					<div class="form-group">
						<label>Phone Number <span style="color:red"> *</span></label>
						<input type="text" name="no_hp" placeholder="phone number" id="no_hp" class="form-control" required  onkeypress="return event.charCode >= 48 && event.charCode <=57" />
					</div>
					<div class="form-group">
						<label>Address <span style="color:red"> *</span></label>
						<input type="text" name="alamat" placeholder="address" id="alamat" class="form-control" required />
					</div>
					<div class="form-group">
						<label>Gender <span style="color:red"> *</span></label>
						<select class="form-control" placeholder="id_level" style="width: 100%;" name="jenis_kelamin">
							<option name = "jenis_kelamin" value = "1" >Male</option>
							<option name = "jenis_kelamin" value = "2" >Female</option>
						</select>
					</div>
					<div class="form-group">
						<label>Certificate</label>
						<input type="text" name="sertifikat" placeholder="certificate" id="sertifikat" class="form-control" />
					</div>
					<div class="form-group">
						<label>Birth <span style="color:red"> *</span></label>
						<input type="date" name="tgl_lahir" placeholder="tgl_lahir" id="tgl_lahir" class="form-control" required />
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



