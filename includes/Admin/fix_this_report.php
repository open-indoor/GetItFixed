<?php include('_func/myfunctions.php');

require_once ('_func/db_connect.php');

$reporttoedit_id=$_GET['id'];

$reporttoedit = report_data_by_id($reporttoedit_id);


?>

<!DOCTYPE html>
<head>
	<link rel="stylesheet" href="_css/css_files/login_register_css.css" />
	<link rel="stylesheet" href="_css/css_files/button_css.css" />
</head>

<body>
	<?php
		
		//if(isset($_SESSION['user_fname'])){	
		if ( $_SESSION['admin_status'] != 'on')	{
				header('Location: home_page.php'); //in case there is allready a user logged redirect to home
		}	else	{

			if (isset($_POST['fixme'])) {
				
				$datatouse = array($reporttoedit_id,$_SESSION['admin_username'],$_POST["rcomment"]);
				
				fix_report($datatouse);
				
				
				echo "Report corrected!";
				
			}	else {	
			
	?>


	<div id="centralized">

	</br> <span class="main_titles">Report repair</span> </br> </br><!-- <h3><a href="changepass.php">[Change your password]</a></h3>-->
		<form name="myData" method="post" action="">
			<div class="line_height">
			Leave a comment:</br> <input type="text" name="rcomment" value="<?php echo $reporttoedit['rep_comment']; ?>"  pattern="^[a-zA-ZαβγδεζηθικλμνξοπρστυφχψωςάέήίύόώΑΒΓΔΕΖΗΘΙΚΛΜΝΞΟΠΡΣΤΥΦΧΨΩ0-9 ]{2,50}$" required>	</br> 
			</div>
			</br></br>
			<input type="submit" name="submit" value="Repair"/>
			<input type="hidden" name="fixme" value="TRUE"/></br></br>
		</form>
	</div>
	
	<?php
			} 
		}
	?>

</body>
