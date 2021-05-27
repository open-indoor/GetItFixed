<?php 

	require_once('_func/myfunctions.php');
	require_once ('_func/db_connect.php');
?>


<div id="form_inline"> 
<?php

$categoriesnames = "SELECT cat_name,cat_id FROM gcategories ORDER BY cat_id ";		
$categories_names = @mysqli_query ($dbconnection, $categoriesnames); // Run 

// Table header:
echo "Categories</br>		";

// Fetch and print all the records....
$bg = '#eeeeee'; 
while ($row = mysqli_fetch_array($categories_names, MYSQLI_ASSOC)) {
	$bg = ($bg=='#eeeeee' ? '#ffffff' : '#eeeeee');
		
		/*echo "  <input type='radio' name='reportcategory' value='".$row['cat_id']."'> ".$row['cat_name']." ";	*/
		echo "  <input type='radio' id='".$row['cat_id']."' name='reportcategory' value='".$row['cat_id']."' required/><label for='".$row['cat_id']."'> ".$row['cat_name']." </label>";


} // End of WHILE loop.


?>
</div>
