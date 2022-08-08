<!-----BODDY Header-->
<?php
    include '../config/koneksi.php';
    include 'load_data.php';
?>
<?php include 'header.php';
	
	$dataPoints = array();
	$AMAN = 15; //total_aman()
	$TEMUAN = 3; //total_temuan()
	$INSIDEN = 2; //total_insiden()
	$TOTAL = $AMAN + $TEMUAN + $INSIDEN;
	array_push($dataPoints,array("x" => $AMAN, "y" => $AMAN*100/$TOTAL, "name" => "Aman"));
	array_push($dataPoints,array("x" => $TEMUAN, "y" => $TEMUAN*100/$TOTAL, "name" => "Temuan"));
	array_push($dataPoints,array("x" => $INSIDEN, "y" => $INSIDEN*100/$TOTAL, "name" => "Insiden"));
?>
<link rel="stylesheet" href="style/horizontal-timelinev2.css">
  <title>Dashboard</title>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Dashboard</h1>
          </div><!-- /.col -->
          <!--div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Dashboard</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
	<section class="content">
      <div class="container-fluid">
		<!-- LINE CHART -->
        <div class="card card-info">
         
		  
		  
        <div class="card-body">
            
                <section class="time-line-box">
                    <div class="swiper-container sw-cont-size text-center"> 
                        <?php // start loop
                        $jumlah_data = count($data_array['location_check']); // hitung array
                        $jml_baris = $jumlah_data/6; // menentukan jumlah baris => dalam desimal
                        $loop = ceil($jml_baris); // digenapkan keatas untuk menentukan jumlah looping dan baris
                        $col_end = 0; // deklarasi kolom end
                        $col_start = 0; // deklarasi kolom start

                        
                        for($i=0; $i<$loop; $i++){
                            $jml_col = 0;
                            // menentukan class property
                            if($jml_baris <= 1){
                                echo "<div class='swiper-wrapper' style='justify-content: center; '>";
                            }
                            if($i % 2 == 1){
                                echo "<div class='swiper-wrapper' style='flex-direction: row-reverse !important;'>";
                            }
                            if($jml_baris > 1 && $i % 2 == 0) {
                                echo "<div class='swiper-wrapper'>";
                            }
                            // menentukan ukuran baris kolom timeline jika baris <= 2
                            if($loop <= 2){
                              if($jumlah_data > $loop*4){
                                $sisa_data = $jumlah_data - $col_end;
                                $col_start = $i * 5;
                                $col_end = $col_start + 5;
                                if($sisa_data >= 5){
                                  $swiper_slide_class = "swiper-slide5";
                                }else{
                                  $swiper_slide_class = "swiper-slide4";
                                }
                              }
                              if($jumlah_data <= $loop*4 && $jumlah_data > 6){
                                $sisa_data = $jumlah_data - $col_end;
                                $col_start = $i * 4;
                                $col_end = $col_start + 4;
                                if($sisa_data >= 4){
                                  $swiper_slide_class = "swiper-slide4";
                                }else{
                                  $swiper_slide_class = "swiper-slide3";
                                }
                              }
                              if($jumlah_data%6 == 0 || $jumlah_data > $loop*5 || $jumlah_data <= 6){
                                $sisa_data = $jumlah_data - $col_end;
                                $col_start = $i * 6;
                                $col_end = $col_start + 6;
                                if($sisa_data >= 6){
                                  $swiper_slide_class = "swiper-slide";
                                }else{
                                  $swiper_slide_class = "swiper-slide5";
                                }
                              }
                            }
                            // menentukan ukuran baris kolom timeline jika baris > 2
                            if($loop > 2){
                              if($jumlah_data <= $loop*5){
                                $sisa_data = $jumlah_data - $col_end ;
                                if($i == 0){
                                  $col_start = $col_end;
                                  $col_end = $col_start + 5;
                                  $swiper_slide_class = "swiper-slide5";
                                }
                                elseif($sisa_data%4 == 0 && $sisa_data%5 != 0){
                                  $col_start = $col_end;
                                  $col_end = $col_start + 4;
                                  $swiper_slide_class = "swiper-slide4";
                                }else{
                                  $col_start = $col_end;
                                  $col_end = $col_start + 5;
                                  $swiper_slide_class = "swiper-slide5";
                                }
                              }
                              elseif($jumlah_data > $loop*5){
                                $sisa_data = $jumlah_data - $col_end ;
                                if($i == 0){
                                  $col_start = $col_end;
                                  $col_end = $col_start + 6;
                                  $swiper_slide_class = "swiper-slide";
                                }
                                elseif($sisa_data%5 == 0 && $sisa_data%6 != 0){
                                  $col_start = $col_end;
                                  $col_end = $col_start + 5;
                                  $swiper_slide_class = "swiper-slide5";
                                }else{
                                  $col_start = $col_end;
                                  $col_end = $col_start + 6;
                                  $swiper_slide_class = "swiper-slide";
                                } 
                              }
                            }
                        ?>
                        <?php
                            foreach($data_array['location_check'] as $evt){
                                // kondisi baris db start? kondisi baris db end?
                                if($jml_col >= $col_start && $jml_col < $col_end){
                                    if($evt['checking'] == 1){
                                        if($col_end - 1 == $jml_col && $i % 2 == 0){
                                            echo "<div class='".  $swiper_slide_class ."'>";
                                            echo "<div class='timestamp checked5'><span>" . $evt['location'] . "</span></div>";
                                            echo "<div class='status checked5'><span>" . $evt['tag_location'] . "</span></div>";
                                            echo "</div>";
                                            if($i+1 != $loop){
                                                echo "<div class='vertical-con right-con checked5'></div>";
                                            }
                                        }
                                        elseif($col_end - 1 == $jml_col && $i % 2 == 1)
                                        {
                                            if($i+1 != $loop){
                                                echo "<div class='vertical-con left-con checked5'></div>";
                                            }
                                            echo "<div class='".  $swiper_slide_class ."'>";
                                            echo "<div class='timestamp checked5'><span>" . $evt['location'] . "</span></div>";
                                            echo "<div class='status corner-left-top checked5'><span>" . $evt['tag_location'] . "</span></div>";
                                            echo "</div>";
                                        }
                                        else
                                        {
                                            echo "<div class='".  $swiper_slide_class ."'>";
                                            echo "<div class='timestamp checked5'><span>" . $evt['location'] . "</span></div>";
                                            echo "<div class='status checked5'><span>" . $evt['tag_location'] . "</span></div>";
                                            echo "</div>";
                                        }
                                    }else if($evt['checking'] >= 2){
                                        if($col_end - 1 == $jml_col && $i % 2 == 0){
                                            echo "<div class='".  $swiper_slide_class ."'>";
                                            echo "<div class='timestamp checked10'><span>" . $evt['location'] . "</span></div>";
                                            echo "<div class='status corner-right-top checked10'><span>" . $evt['tag_location'] . "</span></div>";
                                            echo "</div>"; 
                                            if($i+1 != $loop){
                                                echo "<div class='vertical-con right-con checked10'></div>";
                                            }
                                        }
                                        elseif($col_end - 1 == $jml_col && $i % 2 == 1)
                                        {
                                            if($i+1 != $loop){
                                                echo "<div class='vertical-con left-con checked10'></div>";
                                            }
                                            echo "<div class='".  $swiper_slide_class ."'>";
                                            echo "<div class='timestamp checked10'><span>" . $evt['location'] . "</span></div>";
                                            echo "<div class='status corner-left-top checked10'><span>" . $evt['tag_location'] . "</span></div>";
                                            echo "</div>";
                                        }
                                        else
                                        {
                                            echo "<div class='".  $swiper_slide_class ."'>";
                                            echo "<div class='timestamp checked10'><span>" . $evt['location'] . "</span></div>";
                                            echo "<div class='status checked10'><span>" . $evt['tag_location'] . "</span></div>";
                                            echo "</div>";
                                        }
                                    }else{
                                        // kolom terakhir baris ganjil
                                        if($col_end - 1 == $jml_col && $i % 2 == 0){
                                            echo "<div class='".  $swiper_slide_class ."'>";
                                            echo "<div class='timestamp checked0'><span>" . $evt['location'] . "</span></div>";
                                            echo "<div class='status checked0'><span>" . $evt['tag_location'] . "</span></div>";
                                            echo "</div>";
                                            if($i+1 != $loop){
                                                echo "<div class='vertical-con right-con checked0'></div>";
                                            }
                                        }
                                        elseif($col_end - 1 == $jml_col && $i % 2 == 1)
                                        {
                                            if($i+1 != $loop){
                                                echo "<div class='vertical-con left-con checked0'></div>";
                                            }
                                            echo "<div class='".  $swiper_slide_class ."'>";
                                            echo "<div class='timestamp checked0'><span>" . $evt['location'] . "</span></div>";
                                            echo "<div class='status checked0'><span>" . $evt['tag_location'] . "</span></div>";
                                            echo "</div>";
                                        }
                                        else
                                        {
                                            echo "<div class='".  $swiper_slide_class ."'>";
                                            echo "<div class='timestamp checked0'><span>" . $evt['location'] . "</span></div>";
                                            echo "<div class='status checked0'><span>" . $evt['tag_location'] . "</span></div>";
                                            echo "</div>";
                                        }
                                    }
                                }
                                $jml_col++;
                            } // end loop foreach
                        ?>
                        </div>
                        </br>
                        <?php   } // end loop for
                        ?>
                        <div class="swiper-pagination"></div>
                    </div>
                </section>
        </div>
		  
		  
        </div></br>
        <!-- /.row (main row) -->
		
			
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
        <!-- /.row (main row) -->
      </div><!-- /.container-fluid -->
    </section>


    <section class="content">
      <div class="container-fluid">
		<!-- LINE CHART -->
        <div class="card card-info">
          <!--div class="card-header">
            <h3 class="card-title">Daily Check</h3>
            <div class="card-tools">
              <!--button type="button" class="btn btn-tool" data-card-widget="remove">
                <i class="fas fa-times"></i>
              </button>
            </div>
          </div-->
          <!-- /.card-body -->
		  <div></br></div>
		  <div id="chartContainer3" style="height: 370px; width: 100%;"></div>
		  <script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>
		  
		  <div class="col-md-12">
			<div class="progress-group">
			  <span class="progress-text">Aman</span>
			  <span class="float-right"><b><?php echo $AMAN; ?></b> / <?php echo $TOTAL; ?></span>
			  <div class="progress progress-sm">
				<div class="progress-bar bg-success" style="width: <?php echo $AMAN*100/$TOTAL; ?>%"></div>
			  </div>
			</div>
			
			<!-- /.progress-group -->
			<div class="progress-group">
			  <span class="progress-text">Temuan</span>
			  <span class="float-right"><b><?php echo $TEMUAN; ?></b> / <?php echo $TOTAL; ?></span>
			  <div class="progress progress-sm">
				<div class="progress-bar bg-warning" style="width: <?php echo $TEMUAN*100/$TOTAL; ?>%"></div>
			  </div>
			</div>

			<!-- /.progress-group -->
			<div class="progress-group">
			  <span class="progress-text">Insiden</span>
			  <span class="float-right"><b><?php echo $INSIDEN; ?></b> / <?php echo $TOTAL; ?></span>
			  <div class="progress progress-sm">
				<div class="progress-bar bg-danger" style="width: <?php echo $INSIDEN*100/$TOTAL; ?>%"></div>
			  </div>
			</div>

			<!-- /.progress-group >
			<div class="progress-group">
			  <span class="progress-text">Visitor</span>
			  <span class="float-right"><b><?php echo total_tamu(); ?></b> / <?php echo (total_aman()+total_temuan()+total_insiden()+total_tamu()); ?></span>
			  <div class="progress progress-sm">
				<div class="progress-bar bg-primary" style="width: <?php echo total_tamu(); ?>%"></div>
			  </div>
			</div>
			<!-- /.progress-group -->
		  </div>
		  
		  
        </div></br>
        <!-- /.row (main row) -->
		
			
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
        <!-- /.row (main row) -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->


<?php include 'footer.php'; ?>


<!-- PAGE PLUGINS -->
<!-- jQuery Mapael -->
<script src="../assets/plugins/jquery-mousewheel/jquery.mousewheel.js"></script>
<script src="../assets/plugins/raphael/raphael.min.js"></script>
<script src="../assets/plugins/jquery-mapael/jquery.mapael.min.js"></script>
<script src="../assets/plugins/jquery-mapael/maps/usa_states.min.js"></script>
<!-- ChartJS -->
<script src="../assets/plugins/chart.js/Chart.min.js"></script>


<!-- AdminLTE for demo purposes -->
<script src="../assets/js/demo.js"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="../assets/js/pages/dashboard2.js"></script>

<script>
	window.onload = function () {
	CanvasJS.addColorSet("greenShades",
			[//colorSet Array

			"#28a745",
			"#ffc107",
			"#dc3545"                
			]);
		
		
    var chart3 = new CanvasJS.Chart("chartContainer3", {
	exportEnabled: true,
	animationEnabled: true,
	colorSet: "greenShades",
	title:{
		text: "Daily Check"
	},
	legend:{
		cursor: "pointer",
		itemclick: explodePie
	},
	data: [{
		type: "pie",
		showInLegend: true,
		toolTipContent: "{name}: <strong>{x}</strong>",
		indexLabel: "{name} - {y} %",
		dataPoints: <?php echo json_encode($dataPoints, JSON_NUMERIC_CHECK); ?>
		
	}]
});
chart3.render();

function explodePie (e) {
	if(typeof (e.dataSeries.dataPoints[e.dataPointIndex].exploded) === "undefined" || !e.dataSeries.dataPoints[e.dataPointIndex].exploded) {
		e.dataSeries.dataPoints[e.dataPointIndex].exploded = true;
	} else {
		e.dataSeries.dataPoints[e.dataPointIndex].exploded = false;
	}
	e.chart3.render();

}
	}

</script>

</div>
<!-- ./wrapper -->
