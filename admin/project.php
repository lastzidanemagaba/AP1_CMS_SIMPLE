<!-----BODDY Header-->
<html>
<head>
<?php include 'header.php'; auth_menu("satu",session_level()); ?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Data Project</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Data Project</li>
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
              <!--div class="card-header">
                <h3 class="card-title">DataTable with minimal features & hover style</h3>
              </div-->
              <!-- /.card-header -->
              <div class="card-body">
                <table id="example2" class="table table-bordered table-hover">
                  <thead>
                  <tr>
                    <th>Nomor</th>
                    <th>Nama Klien</th>
                    <th>Create Date</th>
                    <th>Status</th>
					<?php
					if(session_level()=="1"){
						echo "<th>Action</th>";
						
					}
					
					
					
					?>
                  </tr>
                  </thead>
                  <tbody>
				  
				  <?php
					$result = mysqli_query($con,"SELECT * FROM project_list WHERE (id_cabang = '1')");
					$no=1;
					while($h = mysqli_fetch_array($result)){
						if ($h['flag_delete'] == 0){
							$h['status'] = 'Aktif';
						}else{
							$h['status'] = 'Non Aktif';
						}
						echo"
						<tr>
							<td >".($no++)."</td>
							<td>$h[nama_klien]</td>
							<td align='center'>$h[create_date]</td>
							<td align='center'>$h[status]</td>";
							
						if($h['flag_delete'] == 0&&session_level()=="1"){
							echo"
							<td align='center'>
								<b>
								<a href='project_edit?project=".md5(md5(md5($h['id'])))."' class='btn btn-small btn-success' >Ubah</a> |
								<a href='project_act?nonaktif=1&project=".md5(md5(md5($h['id'])))."' class='btn btn-danger btn-small'  onClick=\"return confirm('Anda yakin ingin menonaktifkan project ini ?')\" >Non-aktifkan</a>
								</b>
							</td>
						</tr>";
						}else if(session_level()=="1"){
							echo"
							<td align='center'>
								<b>
								<a href='project_edit?project=".md5(md5(md5($h['id'])))."' class='btn btn-small btn-success' >Ubah</a> |
								<a href='project_act?aktif=1&project=".md5(md5(md5($h['id'])))."' class='btn btn-primary btn-small'  onClick=\"return confirm('Anda yakin ingin mengaktifkan project ini ?')\" >Aktifkan</a>
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



