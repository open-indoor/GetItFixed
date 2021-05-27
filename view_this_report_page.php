<?php include('includes/initialize.php'); ?>

<!DOCTYPE html>
<html>
	<head>

		<title>Report</title>
		<link rel="shortcut icon" href="img//getitfixed.ico">
		<meta charset="utf-8" />
		<link href='http://fonts.googleapis.com/css?family=Orbitron|Audiowide|Black+Ops+One' rel='stylesheet' type='text/css'>

		<meta name="viewport" content="initial-scale=1.0, user-scalable=no" />
    	<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyA7-raXUpnrlEkAGW-PxH_LKaWdre0GjvA&callback=initMap&libraries=&v=weekly"></script>
		
		<link rel="stylesheet" href="_css/view_this_report_page_css.css" type="text/css" />

		<script src="_js/jquery-2.1.1.min.js"></script>

		<style type="text/css">

		#images_div	{
			width: 25%%;
			height: 300px;
			margin: 0 auto;
		}
		.images_css	{
			height: 300px;
			float:center;
			max-width: 150px;
		}
		.images_css:hover	{
			height: 300px;
		}
		.images_css:active	{
			height: 300px;
		}


		</style>

		<script>

		</script>

	</head>

	<body>
		<div id="wrapper">

			<div id="header">
				<?php 
					select_nav_bar();
				?>
			</div>
		
			<div id="content">

				<?php $reptoview_id=$_GET['id']; 
					$reptoview ="_xml/certain_marker.php?id=$reptoview_id";
					
				?>
				<div class="table-container">
					<?php
					require_once ('_func/db_connect.php');
					 $images_arr= mysqli_query($dbconnection,"SELECT rep_file_1,rep_file_2,rep_file_3,rep_file_4 FROM greports WHERE rep_id='$reptoview_id'"); 
					 $images=mysqli_fetch_array($images_arr, MYSQLI_ASSOC);
					?>
					<table align="center" cellspacing="0" cellpadding="5" width="90%">
						<tr > 
							<th align="center" colspan="4" style="text-align='center';">Pictures</th>
						</tr>
						<tr>
							<th height="310px">
							<?php if(file_exists($images['rep_file_1'])) { ?>
								<a href="<?php echo  $images['rep_file_1'];?>" ><img src="<?php echo  $images['rep_file_1'];?>" alt="No photo" class="images_css"></a>
							<?php } ?>
							</th>
							<th>
							<?php if(file_exists($images['rep_file_2'])) { ?>
								<a href="<?php echo  $images['rep_file_2'];?>" ><img src="<?php echo  $images['rep_file_2'];?>" alt="No photo" class="images_css"></a>
							<?php } ?>
							</th>
							<th>
							<?php if(file_exists($images['rep_file_3'])) { ?>
								<a href="<?php echo  $images['rep_file_3'];?>" ><img src="<?php echo  $images['rep_file_3'];?>" alt="No photo" class="images_css"></a>
							<?php } ?>
							</th>
							<th>
							<?php if(file_exists($images['rep_file_4'])) { ?>
								<a href="<?php echo  $images['rep_file_4'];?>" ><img src="<?php echo  $images['rep_file_4'];?>" alt="No photo" class="images_css"></a>
							<?php } ?>
							</th>
						</tr>
					</table>
				</div>	</br>
					<!-- Creating map with markers -->
				<script type="text/javascript">
				    var myVariable = <?php echo(json_encode($reptoview)); ?>;
					var markersfile = myVariable;
				</script>

					<div id="googleMap_div_top"></div>
				<?php 
					//include('./includes/Gmaps/gmap_view_this_report.html')
					include('./includes/Maplibre/maplibre-gl-js-samples-main/maplibre_certain_marker.php') 
				?> 
				<!-- Map created -->
				<?php 
					if (isset($_SESSION['admin_status']) && $_SESSION['admin_status'] == 'on' )   {
						echo "
							<div id='totals_div_css'>
								<div id='centralized'>
							<span id='totals_div_css_data_fixed'><a href='fix_this_report_page.php?id=".$_GET['id']."'>Repair</span>
							</div></div>
						";
					}
				?>
				<div id="googleMap_div_bottom"></div>

			</div>
			<div id="footer">
				<?php
					include('./includes/Basic_divs/footer.html');
				?>
			</div>

		</div>
	</body>
</html>