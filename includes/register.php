
	<?php
		require_once('_func/myfunctions.php');

		if ( logged())	{
			header('Location: home_page.php');
		} else	{	
			if (isset($_POST['newsubmission']))	{
				
				if ($_POST['password']==$_POST['password2']) {	
					$registerdata = array(trim($_POST['fname']),trim($_POST['lname']),trim($_POST['email']),trim($_POST['password']));
					
					require_once ('_func/db_connect.php');

				
					switch(email_check($registerdata[2])) {
						case '0':
							create_user($registerdata);
							echo "Εισαγωγή καινούριου χρήστη.<hr/> Καλώς ορίσατε! ".$registerdata[0];
							break;
						case '1':
							echo "Το παρών email υπάρχει ήδη!";
							break;
						}
				}	else	{
					echo "Οι κωδικοί δεν είναι οι ίδιοι!";
				}
			}	else 	{
	?>
	
	<div id="forms" >
  	
		
		<form name="myForm" method="post" action="register_page.php">
	
			</br> <span class="main_titles">Registration</span> </br> </br>	
			
			<div class="line_height">
			Name:</br> <input type="text" name="fname" placeholder="Enter a name" pattern="^[aa-zA-ZαβγδεζηθικλμνξοπρστυφχψωςάέήίύόώΑΒΓΔΕΖΗΘΙΚΛΜΝΞΟΠΡΣΤΥΦΧΨΩ]{2,30}$" required>	</br> 
			Last Name:</br> <input type="text" name="lname" placeholder="Enter a last name" pattern="^[a-zA-ZαβγδεζηθικλμνξοπρστυφχψωςάέήίύόώΑΒΓΔΕΖΗΘΙΚΛΜΝΞΟΠΡΣΤΥΦΧΨΩ]{2,30}$" required>	</br> 
			Email:</br> <input type="text" name="email" placeholder="Enter your email" pattern="^[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}$" required>	</br>
			Password (at least 5 characters):</br> <input type="password" name="password" placeholder="Enter your password"  pattern="^[a-zA-Z0-9]{5,30}$" required>	</br>
			Password Confirmation</br> <input type="password" name="password2" placeholder="Confirm your password"  pattern="^[a-zA-Z0-9]{5,30}$" required>	</br></br>
			</div>

			<input type="submit" name="newsubmission" class="transition" value="Εγγραφή"/>
			<!--<input type="hidden" name="newsubmission" value="TRUE"/></br></br>-->
		</form>
 	</div>

	<?php
 		 	}
		}
	?>


