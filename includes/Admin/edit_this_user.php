<?php 

	require_once('_func/myfunctions.php');
	require_once ('_func/db_connect.php');

	$usertoedit_id=$_GET['id'];
	$usertoedit=user_data_by_id($usertoedit_id);


	if (isset($_POST['submit'])) {
		
		$editdata = array($usertoedit_id,$_POST["email"],$_POST["fname"],$_POST["lname"]);
		
		update_data($editdata);
		
		
		echo "Data updated";
		
	}	else {	
		
?>


<div id="centralized">

	</br> <span class="main_titles">Data processing</span> </br> </br>	 
	<form name="myData" method="post" action="">
		

		<div class="line_height">
		Name:</br> <input type="text" name="fname" value="<?php echo $usertoedit['user_fname']; ?>"  pattern="^[a-zA-ZαβγδεζηθικλμνξοπρστυφχψωςάέήίύόώΑΒΓΔΕΖΗΘΙΚΛΜΝΞΟΠΡΣΤΥΦΧΨΩ ]{2,30}$" required>	</br> 
		Last name:</br> <input type="text" name="lname" value="<?php echo $usertoedit['user_lname']; ?>"  pattern="^[a-zA-ZαβγδεζηθικλμνξοπρστυφχψωςάέήίύόώΑΒΓΔΕΖΗΘΙΚΛΜΝΞΟΠΡΣΤΥΦΧΨΩ ]{2,30}$" required>	</br> 
		Email:</br> <input type="text" name="email"value="<?php echo $usertoedit['user_email']; ?>"  pattern="^[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}$" required>	</br>
		</div>
				</br></br>
		<input type="submit" name="submit" value="Update"/>
	</form>
</div>

<?php
	} 
?>


