<?php include('includes/initialize.php'); ?>

<?php 
	if( $_SESSION['admin_status'] != 'on') {header('Location: home_page.php');}
 ?>

<!DOCTYPE html>
<html>

	<head>
		<title>Users</title>
		<link rel="shortcut icon" href="img//getitfixed.ico">
		<meta charset="utf-8" />
		<link href='http://fonts.googleapis.com/css?family=Orbitron|Audiowide|Black+Ops+One' rel='stylesheet' type='text/css'>
		
		
		<link rel="stylesheet" href="_css/view_users_page_css.css" type="text/css" />

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
					include('includes/nav_bars/nav_bar_admin.php');
				?>
			</div>
		
			<div id="content">

				<div id="userstable" >
					<?php
						include('./includes/Admin/view_users.php')
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
<html>