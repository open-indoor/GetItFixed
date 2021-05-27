<?php include('includes/initialize.php'); 
	only_admin();
 ?>

<!DOCTYPE html>
<html>
	<head>

		<title>Welcome to GetItFixed</title>
		<link rel="shortcut icon" href="img//getitfixed.ico">
		<meta charset="utf-8" />
		<link href='http://fonts.googleapis.com/css?family=Orbitron|Audiowide|Black+Ops+One' rel='stylesheet' type='text/css'>

		<meta name="viewport" content="initial-scale=1.0, user-scalable=no" />
	    <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyA7-raXUpnrlEkAGW-PxH_LKaWdre0GjvA&callback=initMap&libraries=&v=weekly"></script>

		<link rel="stylesheet" href="_css/home_admin_page_css.css" type="text/css" />
		
	</head>

	<body>
		<div id="wrapper">

			<div id="header">
				<?php 
					select_nav_bar();
				?>
			</div>
		
			<div id="content">
				<div id="centralized">
				
				<!-- ANY TEXT-->
				</div>

				<div id="googleMap_div_top"></div>
				<?php 
					include('./includes/Maplibre/maplibre-gl-js-samples-main/maplibre_home_map.html')
					//include('./includes//Gmaps/gmap_home_admin.html') 
				?> 
				<!-- Map created -->
			
				<div id='totals_div_css'>
					<div id="responsecontainer">			
						<?php 
							include('./includes/Basic_divs/totals_div.php'); 
						?> 
					</div>
				</div>
			
				<div id="googleMap_div_bottom"></div>
			</div>
			
			<div id="footer">
				<?php
					include('./includes/Basic_divs/footer.html');
				?>
			</div>

		</div>
	</body>

	<script src="_js/jquery-2.1.1.min.js"></script>
	<script src="_js/my_script_admin.js"></script>

</html>