<?php 

	require_once('_func/myfunctions.php');
	require_once ('_func/db_connect.php');

	$admin_user=$_SESSION['admin_username'];
	$admin_mail=$_SESSION['admin_email'];


	if (isset($_POST['submit'])) {
		
		$editdata = array($_SESSION['admin_id'],$_POST["email"],$_POST["username"]);
		
		update_admin_data($editdata);
		
		
		echo "Data updated";
		
	}	else {	
		
?>


<div id="centralized">

	</br> <span class="main_titles">Data processing</span> </br> </br>	 
	<form name="myData" method="post" action="">
		

		<div class="line_height">
		Name:</br> <input type="text" name="username" value="<?php echo $admin_user; ?>"  pattern="^[a-zA-ZαβγδεζηθικλμνξοπρστυφχψωςάέήίύόώΑΒΓΔΕΖΗΘΙΚΛΜΝΞΟΠΡΣΤΥΦΧΨΩ0-9 ]{2,30}$" required>	</br> 
		Email:</br> <input type="text" name="email" value="<?php echo $admin_mail; ?>"  pattern="^[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}$" required>	</br>
		</div>
				</br></br>
		<input type="submit" name="submit" value="Update"/>
	</form>
</div>

<?php
	} 
?>


