<!-----BODDY Header-->

<?php include 'header.php'; auth_menu("satudua",session_level()); ?>

  <title>User</title>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>User Data</h1>
          </div>
          <!--div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item swalDefaultSuccess"><a href="#">Setting</a></li>
              <li class="breadcrumb-item active">User</li>
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
                    <th>NIP</th>
                    <th>Full Name</th>
                    <th>Username</th>
                    <th>Number</th>
                    <th>Email</th>
                    <th>Level</th>
                    <th>Status</th>
					<?php
					if(session_level()!="0"){
						echo "<th>Action</th>";
					}
					?>
                  </tr>
                  </thead>
                  <tbody>
				  
				  <?php
					$result = mysqli_query($con,"SELECT * FROM user_list WHERE (status = '0' OR status = '1')");
					$no=1;
					while($row = mysqli_fetch_array($result)){
						
						if($row['status']=="1"){ $status = "Active"; }else{ $status = "Nonaktive"; }
						if($row['id_level']=="1"){ $level = "Superadmin"; } else if($row['id_level']=="2"){ $level = "Supervisor"; }
						else if($row['id_level']=="3"){ $level = "Admin"; } else if($row['id_level']=="4"){ $level = "Operator"; }
						
						echo"
						<tr>
							<td>".($no++)."</td>
							<td>".$row['nip']."</td>
							<td>".$row['nama_lengkap']."</td>
							<td>".$row['username']."</td>
							<td>".$row['no_hp']."</td>
							<td>".$row['email']."</td>
							<td>".$level."</td>
							<td>".$status."</td>";
							
						if($row['status']=="1"){
							echo"<td align='center'><a href='#' data-toggle='modal' data-target='#modaledit".$row["id"]."' class='btn btn-small btn-warning' style='color:white'>Edit</a> ";
							echo"<a href='user_act.php?user=".md5($row['id'])."&status=".md5("hapus")."' class='btn btn-small btn-danger'  onClick=\"return confirm('Do you want delete this data ?')\" >Delete</a>";
						}else{
							echo"<td align='center'><a href='user_act?user=".md5($row['id'])."&status=".md5("aktifkan")."' class='btn btn-small btn-success' >Activation</a></td>";
						}
						?>
	
	
				<div id="modaledit<?php echo $row['id']; ?>" class="modal fade text-left">
					<div class="modal-dialog">
						<form action="user_act" method="post" enctype="multipart/form-data">
							<div class="modal-content">
								<div class="modal-header">Edit User
								</div>
								<div class="modal-body">
									<label>NIP <span style="color:red"> *</span></label>
									<input type="text" name="nip" value="<?php echo $row['nip'];?>" class="form-control" required />
									<br/>
									<label>Full Name <span style="color:red"> *</span></label>
									<input type="text" name="nama_lengkap" value="<?php echo $row['nama_lengkap'];?>" class="form-control"/>
									<br/>
									<label>Username <span style="color:red"> *</span></label>
									<input type="text" name="username" value="<?php echo $row['username'];?>" class="form-control" required />
									<br/>
									<label>Phone Number <span style="color:red"> *</span></label>
									<input type="text" name="no_hp" value="<?php echo $row['no_hp'];?>" class="form-control" required />
									<br/>
									<label>Email <span style="color:red"> *</span></label>
									<input type="text" name="email" value="<?php echo $row['email'];?>" class="form-control" required />
									<br/>
									<div class="form-group">
									  <label>Level <span style="color:red"> *</span></label>
									  <select class="form-control select2" style="width: 100%;" name="id_level">
										<?php
										$result2 = mysqli_query($con,"SELECT * FROM level_user");
										while($row2 = mysqli_fetch_array($result2)){ ?>
											<option name = "id_level" value = "<?php echo $row2['id'];?>" <?php if($row2['id']==$row['id_level']){ ?> selected <?php }?> ><?php echo $row2['level'];?></option>';
										<?php
										}
									  ?>
									  </select>
									</div>
									<!--div class="form-group">
									  <label>Status</label>
									  <select class="form-control" style="width: 100%;" name="aktif">
										<option name = "aktif" value = "1" <?php if($row['status']==1){ ?> selected <?php }?> >Aktif</option>';
										<option name = "aktif" value = "0" <?php if($row['status']==0){ ?> selected <?php }?> >Nonaktif</option>';
									  </select>
									</div-->
									<br/>
								</div>
								<div class="modal-footer">
									<input type="hidden" name="id" value="<?php echo md5($row['id']); ?>"/>
									<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
									<input type="submit" name="status" class="btn btn-success" value="Edit"/>
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
		<form action="user_act" method="post" enctype="multipart/form-data">
			<div class="modal-content">
				<div class="modal-header">
				</div>
				<div class="modal-body">
					<div class="form-group">
						<label>NIP <span style="color:red"> *</span></label>
						<input type="text" name="nip" placeholder="nip" id="nip" class="form-control" required />
					</div>
					<div class="form-group">
						<label>Full Name <span style="color:red"> *</span></label>
						<input type="text" name="nama_lengkap" placeholder="full name" id="nama_lengkap" class="form-control" required />
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
						<label>Phone Number<span style="color:red"> *</span></label>
						<input type="text" name="no_hp" placeholder="phone number" id="no_hp" class="form-control" required />
					</div>
					<div class="form-group">
						<label>Email <span style="color:red"> *</span></label>
						<input type="text" name="email" placeholder="email" id="email" class="form-control" required />
					</div>
					<div class="form-group">
					  <label>Level <span style="color:red"> *</span></label>
					  <select class="form-control" placeholder="id_level" style="width: 100%;" name="id_level">
						<?php
							$result = mysqli_query($con,"SELECT * FROM level_user");
						$no=1;
						while($row = mysqli_fetch_array($result)){
							echo '<option name = "id_level" value = "'.$row['id'].'" >'.$row['level'].'</option>';
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

<script>
  $(function () {
    //Initialize Select2 Elements
    $('.select2').select2()
	
	//Initialize Select2 Elements
    $('.select2bs4').select2({
      theme: 'bootstrap4'
    })
	
	
  })
</script>



