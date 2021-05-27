<?php include('includes/initialize.php'); 
	only_admin();
?>

<!DOCTYPE html>
<html>
	<head>
		<title>Reports</title>
		<link rel="shortcut icon" href="img/getitfixed.ico">
		<meta charset="utf-8" />
		<link href='http://fonts.googleapis.com/css?family=Orbitron|Audiowide|Black+Ops+One' rel='stylesheet' type='text/css'>
		
		
		<link rel="stylesheet" href="_css/view_reports_by_page_css.css" type="text/css" />

		<style type="text/css">
		#userstable	{
			text-align: center;

		}
		</style>

	</head>

	<body>
		<div id="wrapper">
			<div id="header">
				
				<?php 
					select_nav_bar();
				?>

			</div>
		
			<div id="content">
				
				<div id="userstable" >
					<?php

						include('./includes/Admin/view_reports_by_category.php')
					?>
				</div>
				
			</div>


			<div id="footer">
				<?php
					include('./includes/Basic_divs/footer.html');
				?>
			</div>

		</div>
	</body>	
</html>
