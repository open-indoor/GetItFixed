<?php require_once('_func/myfunctions.php'); 
		
		//if(isset($_SESSION['user_fname'])){	
	if ( !logged())	{
			header('Location: home_page.php'); //in case there is allready a user logged redirect to home
	}	else	{

		if (isset($_POST['updateme'])) {
			
			$editdata = array($_SESSION['user_id'],$_POST["email"],$_POST["fname"],$_POST["lname"]);
			
			require_once ('_func/db_connect.php');
			
			update_data($editdata);

			$usertologin = user_who_data($editdata[1]);
			login($usertologin);
			
			echo "Data updated";			
			
		}	else {	
			
?>


<div id="centralized">

 <!-- <h3><a href="changepass.php">[Change your password]</a></h3>-->
	<form name="myData" method="post" action="">
		</br>	
		<span class="main_titles">Data processing</span> </br> </br>	
		<div class="line_height">
		
		Name:</br> <input type="text" name="fname" value="<?php echo $_SESSION['user_fname']; ?>"  pattern="^[a-zA-ZαβγδεζηθικλμνξοπρστυφχψωςάέήίύόώΑΒΓΔΕΖΗΘΙΚΛΜΝΞΟΠΡΣΤΥΦΧΨΩ0-9 ]{2,30}$" required>	</br> 
		Last Name</br> <input type="text" name="lname" value="<?php echo $_SESSION['user_lname']; ?>"  pattern="^[a-zA-ZαβγδεζηθικλμνξοπρστυφχψωςάέήίύόώΑΒΓΔΕΖΗΘΙΚΛΜΝΞΟΠΡΣΤΥΦΧΨΩ0-9 ]{2,30}$" required>	</br> 
		Email:</br> <input type="text" name="email"value="<?php echo $_SESSION['user_email']; ?>"  pattern="^[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}$" required>	</br>
		
		</div>
				</br></br>
		<input type="submit" name="submit" value="Update !"/>
		<input type="hidden" name="updateme" value="TRUE"/></br></br>
	</form>

	Change password ? <a href="change_password_page.php" class="a_links_css">Change! </a>
</div>
	
<?php
		} 
	}
?>


