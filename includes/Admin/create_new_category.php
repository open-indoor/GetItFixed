<?php require_once('_func/myfunctions.php'); 

	if (  $_SESSION['admin_status'] != 'on')	{
		header('Location: home_page.php'); //in case there is allready a user logged redirect to home
	}	else	{

		if ($_SERVER["REQUEST_METHOD"] == "POST") {
			
			$newcategory = $_POST["catname"];
			
			require_once ('_func/db_connect.php');
			
			switch(category_check($newcategory)) {
				case '1':
					echo "This category already exists!";
					break;
				case '0':
					create_category($newcategory);
					echo "The new category named: ".$newcategory." successfully created!";
					break;
			}
			
		}	else	{	
			
?>

<div id="forms" >
	<form name="myForm" method="post" action="">

		</br> <h2>Create a new category</h2> </br>	
		
		Enter a category name:</br> <input type="text" name="catname" placeholder="" pattern="^[a-zA-ZαβγδεζηθικλμνξοπρστυφχψωςάέήίύόώΑΒΓΔΕΖΗΘΙΚΛΜΝΞΟΠΡΣΤΥΦΧΨΩ0-9 ]{2,30}$" required>	</br></br>
		
		<input type="submit" name="newcategory" value="Create a new category"> </br></br></br>
	</form>

	</br>	
</div>
	
<?php
		}	 
	}

?>

