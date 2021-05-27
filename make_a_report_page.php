<?php include('includes/initialize.php'); 
	only_user();
?>

<!DOCTYPE html>
	<html>
	<head>

		<title>New report</title>
		<link rel="shortcut icon" href="img//getitfixed.ico">
		<meta charset="utf-8" />
		<link href='http://fonts.googleapis.com/css?family=Orbitron|Audiowide|Black+Ops+One' rel='stylesheet' type='text/css'>

		<meta name="viewport" content="initial-scale=1.0, user-scalable=no" />
	    <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyA7-raXUpnrlEkAGW-PxH_LKaWdre0GjvA&callback=initMap&libraries=&v=weekly"></script>

		<link rel="stylesheet" href="_css/make_a_report_page_css.css" type="text/css" />
		
		<script src="_js/jquery-2.1.1.min.js"></script>

	</head>

	<body>

		<div id="wrapper">

			<div id="header">
				<?php 
					select_nav_bar();
				?>
			</div>
		
			<div id="content">
				<?php
					include('./includes/User/new_report.php')
				?>
			</div>

			<div id="footer">
				<?php
					include('./includes/Basic_divs/footer.html');
				?>
			</div>

		</div>
	</body>
</html>