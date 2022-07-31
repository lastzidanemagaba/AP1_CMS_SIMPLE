<?php
    include 'load_data.php'; 
?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">

        <link rel="stylesheet" href="style/horizontal-timelinev2.css">
		
		<title>Timeline Jadwal Dinas</title>
        
	</head>
	<body>
       <?php // start print jika show->isset ?>
        <div class="event-container">
            
                <section class="time-line-box">
                    <div class="swiper-container text-center"> 
                        <?php // start loop
                        $count = count($data_array['location_check'])/4;
                        $loop = ceil($count);
                        
                        for($i=0; $i<$loop; $i++){
                            $jml_col = 0;
                            $col_start = $i * 4;
                            $col_end = $col_start + 4;
                            if($i % 2 == 1){
                                echo "<div class='swiper-wrapper' style='flex-direction: row-reverse !important;'>";
                            }else{
                                echo "<div class='swiper-wrapper'>";
                            }
                        ?>
                        <?php
                            foreach($data_array['location_check'] as $evt){
                                if($jml_col >= $col_start && $jml_col < $col_end){// kondisi index start? kondisi max col?
                                    if($evt['checking'] == 1){
                                        if($col_end - 1 == $jml_col && $i % 2 == 0){
                                            echo "<div class='swiper-slide'>";
                                            echo "<div class='timestamp checked5'><span>" . $evt['location'] . "</span></div>";
                                            echo "<div class='status corner-right-top checked5'><span>" . $evt['tag_location2'] . "</span></div>";
                                            echo "</div>";
                                            if($i+1 != $loop){
                                                echo "<div class='vertical-line right checked5'></div>";
                                            }
                                        }
                                        elseif($col_end - 1 == $jml_col && $i % 2 == 1)
                                        {
                                            if($i+1 != $loop){
                                                echo "<div class='vertical-line left checked5'></div>";
                                            }
                                            echo "<div class='swiper-slide'>";
                                            echo "<div class='timestamp checked5'><span>" . $evt['location'] . "</span></div>";
                                            echo "<div class='status corner-left-top checked5'><span>" . $evt['tag_location'] . "</span></div>";
                                            echo "</div>";
                                        }
                                        elseif($col_start == $jml_col && $i % 2 == 1)
                                        {
                                            echo "<div class='swiper-slide'>";
                                            echo "<div class='timestamp line-con corner-right-bottom checked5'><span>" . $evt['location'] . "</span></div>";
                                            echo "<div class='corner-left-top checked5'><span>" . $evt['tag_location'] . "</span></div>";
                                            echo "</div>";
                                        }
                                        elseif($col_start == $jml_col && $i % 2 == 0 && $i != 0)
                                        {
                                            echo "<div class='swiper-slide'>";
                                            echo "<div class='timestamp line-con corner-left-bottom checked5'><span>" . $evt['location'] . "</span></div>";
                                            echo "<div class='checked5'><span>" . $evt['tag_location'] . "</span></div>";
                                            echo "</div>";
                                        }
                                        else
                                        {
                                            echo "<div class='swiper-slide'>";
                                            echo "<div class='timestamp checked5'><span>" . $evt['location'] . "</span></div>";
                                            echo "<div class='status checked5'><span>" . $evt['tag_location'] . "</span></div>";
                                            echo "</div>";
                                        }
                                    }else if($evt['checking'] >= 2){
                                        if($col_end - 1 == $jml_col && $i % 2 == 0){
                                            echo "<div class='swiper-slide'>";
                                            echo "<div class='timestamp checked10'><span>" . $evt['location'] . "</span></div>";
                                            echo "<div class='status corner-right-top checked10'><span>" . $evt['tag_location'] . "</span></div>";
                                            echo "</div>"; 
                                            if($i+1 != $loop){
                                                echo "<div class='vertical-line right checked10'></div>";
                                            }
                                        }
                                        elseif($col_end - 1 == $jml_col && $i % 2 == 1)
                                        {
                                            if($i+1 != $loop){
                                                echo "<div class='vertical-line left checked10'></div>";
                                            }
                                            echo "<div class='swiper-slide'>";
                                            echo "<div class='timestamp checked10'><span>" . $evt['location'] . "</span></div>";
                                            echo "<div class='status corner-left-top checked10'><span>" . $evt['tag_location'] . "</span></div>";
                                            echo "</div>";
                                        }
                                        elseif($col_start == $jml_col && $i % 2 == 1)
                                        {
                                            echo "<div class='swiper-slide'>";
                                            echo "<div class='timestamp line-con corner-right-bottom checked10'><span>" . $evt['location'] . "</span></div>";
                                            echo "<div class='checked10'><span>" . $evt['tag_location'] . "</span></div>";
                                            echo "</div>";
                                        }
                                        elseif($col_start == $jml_col && $i % 2 == 0 && $i != 0)
                                        {
                                            echo "<div class='swiper-slide'>";
                                            echo "<div class='timestamp line-con corner-left-bottom checked10'><span>" . $evt['location'] . "</span></div>";
                                            echo "<div class='checked10'><span>" . $evt['tag_location'] . "</span></div>";
                                            echo "</div>";
                                        }
                                        else
                                        {
                                            echo "<div class='swiper-slide'>";
                                            echo "<div class='timestamp checked10'><span>" . $evt['location'] . "</span></div>";
                                            echo "<div class='status checked10'><span>" . $evt['tag_location'] . "</span></div>";
                                            echo "</div>";
                                        }
                                    }else{
                                        // kolom terakhir baris ganjil
                                        if($col_end - 1 == $jml_col && $i % 2 == 0){
                                            echo "<div class='swiper-slide'>";
                                            echo "<div class='timestamp checked'><span>" . $evt['location'] . "</span></div>";
                                            echo "<div class='status corner-right-top checked'><span>" . $evt['tag_location'] . "</span></div>";
                                            echo "</div>";
                                            if($i+1 != $loop){
                                                echo "<div class='vertical-line right checked'></div>";
                                            }
                                        }
                                        elseif($col_end - 1 == $jml_col && $i % 2 == 1)
                                        {
                                            if($i+1 != $loop){
                                                echo "<div class='vertical-line left checked'></div>";
                                            }
                                            echo "<div class='swiper-slide'>";
                                            echo "<div class='timestamp checked'><span>" . $evt['location'] . "</span></div>";
                                            echo "<div class='status corner-left-top  checked'><span>" . $evt['tag_location'] . "</span></div>";
                                            echo "</div>";
                                        }
                                        elseif($col_start == $jml_col && $i % 2 == 1)
                                        {
                                            echo "<div class='swiper-slide'>";
                                            echo "<div class='timestamp line-con corner-right-bottom checked'><span>" . $evt['location'] . "</span></div>";
                                            echo "<div class='checked'><span>" . $evt['tag_location'] . "</span></div>";
                                            echo "</div>";
                                        }
                                        elseif($col_start == $jml_col && $i % 2 == 0 && $i != 0)
                                        {
                                            echo "<div class='swiper-slide'>";
                                            echo "<div class='timestamp line-con corner-left-bottom checked'><span>" . $evt['location'] . "</span></div>";
                                            echo "<div class='checked'><span>" . $evt['tag_location'] . "</span></div>";
                                            echo "</div>";
                                        }
                                        else
                                        {
                                            echo "<div class='swiper-slide'>";
                                            echo "<div class='timestamp checked'><span>" . $evt['location'] . "</span></div>";
                                            echo "<div class='status checked'><span>" . $evt['tag_location'] . "</span></div>";
                                            echo "</div>";
                                        }
                                    }
                                }
                                $jml_col++;
                            }
                        ?>
                        </div>
                        </br>
                        <?php   } // end loop 
                        ?>
                        <div class="swiper-pagination"></div>
                    </div>
                </section>
            
        </div>
        <?php // end print jika show->isset ?>