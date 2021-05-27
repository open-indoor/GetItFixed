<?php

require_once ('../../_func/db_connect.php');
	//delete function
function delete_category($categorytodelete) 
{	
	global $dbconnection;
	$deletecategory="delete from gcategories where cat_id='$categorytodelete'";
	$deletereports="delete from greports where rep_cat='$categorytodelete'";

	if (!mysqli_query($dbconnection,$deletecategory) or !mysqli_query($dbconnection,$deletereports)) {
			die('Error: ' . mysqli_error($dbconnection));
		}	
	header('Location: ' . $_SERVER['HTTP_REFERER']); // return  to previous page
}

delete_category($_GET['id']);


?>