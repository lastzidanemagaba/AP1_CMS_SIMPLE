<!-----BODDY Header-->
<html>
<head>
<?php include 'header.php'; auth_menu("satuduatiga",session_level()); ?>
  
  <title>Tenant</title>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Data Area</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Area</li>
            </ol>
          </div>
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
				<button type="button" class="btn btn-success" data-toggle="modal" data-target="#modal-add">Tambah data</button>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="example1" class="table table-bordered table-hover">
                  <thead>
                  <tr>
                    <th>No</th>
                    <th>Area</th>
                    <th>Status</th>
					<?php
					if(session_level()!="4"){
						echo "<th width='200'>Action</th>";
					}
					?>
                  </tr>
                  </thead>
                  <tbody>
				  
				  <?php
					$result = mysqli_query($con,"SELECT area_list.id ID, area_list.area AREA, 
					area_list.status STATUS, area_list.create_date TANGGAL, 
					project_list.nama_klien PROJECT 
					FROM area_list
					LEFT JOIN project_list on project_list.id = area_list.id_project");
					$no=1;
					while($row = mysqli_fetch_array($result)){
						if ($row['STATUS'] == 1){
							$row['status'] = 'Aktif';
						}else{
							$row['status'] = 'Non Aktif';
						}
						echo"
						<tr>
							<td >".($no++)."</td>
							<td>$row[AREA]</td>
							<td align='center'>$row[status]</td>";
							
						if($row['STATUS'] == 1&&session_level()!="4"){
							echo"
							<td align='center'>
								<b>
								<a href='#' data-toggle='modal' data-target='#modaledit".$row["ID"]."' class='btn btn-small btn-warning' style='color:white'>Ubah</a> |
								<a href='area_act?area=".md5($row['ID'])."&status=".md5("hapus")."' class='btn btn-danger btn-small'  onClick=\"return confirm('Anda yakin ingin menghapus area ini ?')\" >Hapus</a>
								</b>
							</td>
						</tr>";
						}else if(session_level()!="4"){
							echo"
							<td align='center'>
								<b>
								<a href='#' data-toggle='modal' data-target='#modaledit".$row["ID"]."' class='btn btn-small btn-warning' style='color:white'>Ubah</a> |
								<a href='area_act?area=".md5($row['ID'])."&status=".md5("aktifkan")."' class='btn btn-primary btn-small'  onClick=\"return confirm('Anda yakin ingin mengaktifkan project ini ?')\" >Aktifkan</a>
								</b>
							</td>
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

			  <div class="modal fade" id="modal-add">
				<div class="modal-dialog">
				  <form action="area_act.php" method="post" enctype="multipart/form-data">
						<div class="modal-content">
							<div class="modal-header">
							  <h4 class="modal-title">Tambah data</h4>
							  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
								<span aria-hidden="true">&times;</span>
							  </button>
							</div>
							<div class="modal-body">
								<label>Area</label>
								<input type="text" name="area" placeholder="area" id="area" class="form-control" required />
								<br/>
							</div>
							<div class="modal-footer justify-content-between">
								<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
								<input type="submit" name="tambah" id="tambah" class="btn btn-success" value="Tambah"></input>
							</div>
						</div>
					</form>
				  <!-- /.modal-content -->
				</div>
				<!-- /.modal-dialog -->
			  </div>
			  <!-- /.modal -->




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
  }else if(isset($_GET['alert'])&&$_GET['alert']==md5("edit")){
    alert("edit");
  }else if(isset($_GET['alert'])&&$_GET['alert']==md5("gagal")){
    alert("gagal");
  }else if(isset($_GET['alert'])&&$_GET['alert']==md5("aktif")){
    alert("aktif");
  }else if(isset($_GET['alert'])&&$_GET['alert']==md5("nonaktif")){
    alert("nonaktif");
  }

  

?>

