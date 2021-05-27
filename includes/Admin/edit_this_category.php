<?php include('_func/myfunctions.php');

require_once ('_func/db_connect.php');

$categorytoedit_id=$_GET['id'];
$categorycurrentname=category_name($categorytoedit_id);
?>

<!DOCTYPE html>
<head>
	
	
</head>

<body>
	<?php
		
		//if(isset($_SESSION['user_fname'])){	
		if ( $_SESSION['admin_status'] != 'on')	{
				header('Location: home_page.php'); //in case there is allready a user logged redirect to home
		}	else	{

			if (isset($_POST['updateme'])) {
				
				$editdata = array($categorytoedit_id,$_POST["cname"]);
				
				update_category($editdata);
				
				
				echo "Data updated successfully!";
				
			}	else {	
			
	?>


	<div id="centralized">

	</br> <span class="main_titles">Edit category</span> </br> </br><!-- <h3><a href="changepass.php">[Change your password]</a></h3>-->
		<form name="myData" method="post" action="">
			<div class="line_height">
			Category name:</br> <input type="text" name="cname" value="<?php echo $categorycurrentname; ?>"  pattern="^[a-zA-ZαβγδεζηθικλμνξοπρστυφχψωςάέήίύόώΑΒΓΔΕΖΗΘΙΚΛΜΝΞΟΠΡΣΤΥΦΧΨΩ0-9 ]{2,30}$" required>	</br> 
			</div>
			</br></br>
			<input type="submit" name="submit" value="Update"/>
			<input type="hidden" name="updateme" value="TRUE"/></br></br>
		</form>
	</div>
	
	<?php
			} 
		}
	?>

</body>
