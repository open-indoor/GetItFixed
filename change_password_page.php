<?php include('includes/initialize.php');
	only_user();
?>

<!DOCTYPE html>
<html>
	<head>

		<title>Edit user data</title>
		<link rel="shortcut icon" href="img/getitfixed.ico">
		<meta charset="utf-8" />
		<link href='http://fonts.googleapis.com/css?family=Orbitron|Audiowide|Black+Ops+One' rel='stylesheet' type='text/css'>

		<link rel="stylesheet" href="_css/change_password_page_css.css" type="text/css" />

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
					include('./includes/User/change_password.php')
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