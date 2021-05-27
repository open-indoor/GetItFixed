<?php

require_once ('../../_func/db_connect.php');
	//delete function
function delete_user($usertodelete) 
{	
	global $dbconnection;
	$deleteuser="delete from gusers where user_id='$usertodelete'";

	if (!mysqli_query($dbconnection,$deleteuser)) {
			die('Error: ' . mysqli_error($dbconnection));
		}	
	header('Location: ' . $_SERVER['HTTP_REFERER']); // return  to previous page
}

delete_user($_GET['id']);


?>