<?php
  include '../config/koneksi.php';
  include 'fungsi.php';
  session_start();
  if(empty($_SESSION['username'])||$_SESSION['aplikasi']!="patrol"){
	header("location: ".$base_url."index?alert=".md5("belum"));
	session_destroy();
  }
  ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!--title>KIW Patrol | <?php echo get_level(session_level()); ?></title-->
  <link rel="icon" href="../assets/img/logo.png"/>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="../assets/plugins/fontawesome-free/css/all.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Tempusdominus Bootstrap 4 -->
  <link rel="stylesheet" href="../assets/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
  <!-- iCheck -->
  <link rel="stylesheet" href="../assets/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- JQVMap -->
  <link rel="stylesheet" href="../assets/plugins/jqvmap/jqvmap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="../assets/css/adminlte.min.css">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="../assets/plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
  <!-- summernote -->
  <link rel="stylesheet" href="../assets/plugins/summernote/summernote-bs4.min.css">
  <!-- SweetAlert2 -->
  <link rel="stylesheet" href="../assets/plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css">
  <!-- SweetAlert2 -->
  <script src="../assets/plugins/sweetalert2/sweetalert2.min.js"></script>
  
  <!-- daterange picker -->
  <link rel="stylesheet" href="../assets/plugins/daterangepicker/daterangepicker.css">
  <!-- date-range-picker -->
  <script src="../assets/plugins/daterangepicker/daterangepicker.js"></script>
  <script type="text/javascript" src="https://cdn.jsdelivr.net/jquery/latest/jquery.min.js"></script>
  <script type="text/javascript" src="../assets/plugins/daterangepicker/moment.min.js"></script>
  <script type="text/javascript" src="../assets/plugins/daterangepicker/daterangepicker.js"></script>
  <link rel="stylesheet" type="text/css" href="../assets/plugins/daterangepicker/daterangepicker.css" />
  
  <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.4.1/jquery.js"></script>
  <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.7.2/jquery-ui.min.js"></script>
  
  
  
  
  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="../assets/plugins/fontawesome-free/css/all.min.css">
  <!-- DataTables -->
  <link rel="stylesheet" href="../assets/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="../assets/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
  <link rel="stylesheet" href="../assets/plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="../assets/css/adminlte.min.css">
  
  
  
  
  
  
</head>
<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">

  <!-- Preloader -->
  <div class="preloader flex-column justify-content-center align-items-center">
    <img class="animation__shake" src="../assets/img/logopatrol.png" alt="KIW Patrol" height="100">
  </div>

  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
      <!--li class="nav-item d-none d-sm-inline-block">
        <a href="index3.html" class="nav-link">Home</a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="#" class="nav-link">Contact</a>
      </li-->
    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
      <!-- Notifications Dropdown Menu -->
      <li class="nav-item d-none d-sm-inline-block">
        <a class="nav-link"><?php echo "Hallo, ".get_user(); ?></a>
      </li>
      <li class="nav-item dropdown">
        <a class="nav-link" data-toggle="dropdown" href="#">
          <i class="far fa-bell"></i>
          <!--span class="badge badge-warning navbar-badge">15</span-->
        </a>
        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
          <span class="dropdown-item dropdown-header">Menu</span>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item" data-toggle="modal" data-target="#modalAbout">
            <i class="fas fa-address-card mr-2"></i> About
          </a>
          <a href="#" class="dropdown-item" data-toggle="modal" data-target="#modalEditData">
            <i class="fas fa-user-check mr-2"></i> Edit Data
          </a>
          <div class="dropdown-divider"></div>
          <a href="logout" class="dropdown-item">
            <i class="fas fa-users mr-2"></i> Logout
          </a>
        </div>
      </li>
    </ul>
  </nav>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="index" class="brand-link">
      <img src="../assets/img/logo_putih.png" alt="" class="brand-image" style="">
      <span class="brand-text font-weight-light">KIWPatrol</span>
	  
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column treeview" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          <li class="nav-item">
            <a href="index" class="nav-link">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Dashboard
                <!--i class="right fas fa-angle-left"></i-->
              </p>
            </a>
          </li>
          <li class="nav-item treeview-menu">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-map-marker-alt"></i>
              <p>
                Setting
                <i class="fas fa-angle-left right"></i>
                <!--span class="badge badge-info right">6</span-->
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="location" class="nav-link">
                  <!--i class="far fa-circle nav-icon"></i-->
                  <i>&emsp;&emsp;</i>
                  <p>Location</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="security" class="nav-link">
                  <!--i class="far fa-circle nav-icon"></i-->
                  <i>&emsp;&emsp;</i>
                  <p>Security</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="sos" class="nav-link">
                  <!--i class="far fa-circle nav-icon"></i-->
                  <i>&emsp;&emsp;</i>
                  <p>SOS Number</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="schedule" class="nav-link">
                  <!--i class="far fa-circle nav-icon"></i-->
                  <i>&emsp;&emsp;</i>
                  <p>Schedule</p>
                </a>
              </li>
			  <?php if(session_level()=="1"||session_level()=="2"){ ?>
              <li class="nav-item">
                <a href="user" class="nav-link">
                  <!--i class="far fa-circle nav-icon"></i-->
                  <i>&emsp;&emsp;</i>
                  <p>User</p>
                </a>
              </li>
			  <?php } ?>
            </ul>
          </li>
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-tasks"></i>
              <p>
                Daily Checking
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="daily" class="nav-link">
                  <!--i class="far fa-circle nav-icon"></i-->
                  <i>&emsp;&emsp;</i>
                  <p>Check Result</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="visitor" class="nav-link">
                  <!--i class="far fa-circle nav-icon"></i-->
                  <i>&emsp;&emsp;</i>
                  <p>Visitor</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="logbook" class="nav-link">
                  <!--i class="far fa-circle nav-icon"></i-->
                  <i>&emsp;&emsp;</i>
                  <p>Logbook</p>
                </a>
              </li>
            </ul>
          </li>
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-edit"></i>
              <p>
                Report
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="finding_report" class="nav-link">
                  <!--i class="far fa-circle nav-icon"></i-->
                  <i>&emsp;&emsp;</i>
                  <p>Findings</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="incident_report" class="nav-link">
                  <!--i class="far fa-circle nav-icon"></i-->
                  <i>&emsp;&emsp;</i>
                  <p>Incident</p>
                </a>
              </li>
            </ul>
          </li>
          
		  <!--li class="nav-item">
			<a href="logout" class="nav-link">
			  <i class="nav-icon fas fa-angle-double-right"></i>
			  <p>Logout</p>
			</a>
		  </li-->
        </ul><br><br><br><br><br><br><br><br>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>



    <div id="modalAbout" class="modal fade">
		<div class="modal-dialog">
			<div class="modal-content card card-info">
				<div class="modal-header">About</div>
				<div class="modal-body form-group row">
					<label for="inputEmail3" class="col-sm-3 col-form-label">Name <span style="color:red"> *</span></label>
					<div class="col-sm-9">
					  <label for="inputEmail3" class="col-sm-9 col-form-label">: <?php echo $_SESSION['nama'];?></label>
					</div>
					<label for="inputEmail3" class="col-sm-3 col-form-label">Username <span style="color:red"> *</span></label>
					<div class="col-sm-9">
					  <label for="inputEmail3" class="col-sm-9 col-form-label">: <?php echo $_SESSION['username'];?></label>
					</div>
					<label for="inputEmail3" class="col-sm-3 col-form-label">Level <span style="color:red"> *</span></label>
					<div class="col-sm-9">
					  <label for="inputEmail3" class="col-sm-9 col-form-label">: <?php 
						$result = mysqli_query($con,"SELECT * FROM level_user WHERE (id = '".$_SESSION['id_level']."')");
						while($row = mysqli_fetch_array($result)){
							$LEVEL = $row['hak_akses'];
						}
					  echo $LEVEL; ?></label>
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
				</div>
			</div>
		</div>
	</div> 
	
	
  <div id="modalEditData" class="modal fade">
	<div class="modal-dialog">
		<form action="header_act" method="post" enctype="multipart/form-data">
			<div class="modal-content">
				<div class="modal-header">Edit Data</div>
				<div class="modal-body">
					<div class="form-group">
						<label>Name <span style="color:red"> *</span></label>
						<input type="text" name="nama_lengkap" placeholder="name" value="<?php echo $_SESSION['nama']; ?>" class="form-control" required />
					</div>
					<div class="form-group">
						<label>Username <span style="color:red"> *</span></label>
						<input type="text" name="username" placeholder="username" value="<?php echo $_SESSION['username']; ?>" class="form-control" required />
					</div>
					<div class="form-group">
						<label>Password</label>
						<input type="password" name="password" placeholder="password" value="" class="form-control" />
					</div>
					<div class="form-group">
						<label>Re-password</label>
						<input type="password" name="repassword" placeholder="repassword" value="" class="form-control" />
					</div>
				</div>
				<div class="modal-footer">
					<input type="hidden" name="id" value="<?php echo md5($_SESSION['id']); ?>" />
					<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
					<input type="submit" name="status" class="btn btn-success" value="Edit" />
				</div>
			</div>
		</form>
	</div>
</div>

<script>
$('li').Treeview(options)


$('li').on('expanded.lte.treeview', handleExpandedEvent)

</script>










