<?php

require_once ('../_func/db_connect.php');
	//delete function
function delete_user($reporttodelete) 
{	
	global $dbconnection;
	$deletereport="UPDATE greports SET rep_stat='deleted' WHERE rep_id='$reporttodelete'";

	if (!mysqli_query($dbconnection,$deletereport)) {
			die('Error: ' . mysqli_error($dbconnection));
		}	
	header('Location: ' . $_SERVER['HTTP_REFERER']); // return  to previous page
}

delete_user($_GET['id']);


?>