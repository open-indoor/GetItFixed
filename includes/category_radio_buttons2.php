<?php 

	require_once('_func/myfunctions.php');
	require_once ('_func/db_connect.php');
?>
<div>

<div id="form_inline"> 
<?php

$categoriesnames = "SELECT cat_name,cat_id FROM gcategories ORDER BY cat_id ";		
$categories_names = @mysqli_query ($dbconnection, $categoriesnames); // Run 

// Table header:
echo "Categories </br>";

// Fetch and print all the records....
$bg = '#eeeeee'; 
while ($row = mysqli_fetch_array($categories_names, MYSQLI_ASSOC)) {
	$bg = ($bg=='#eeeeee' ? '#ffffff' : '#eeeeee');
		
		/*echo "  <input type='radio' name='reportcategory' value='".$row['cat_id']."'> ".$row['cat_name']." ";	*/
		//echo "  <input type='radio' id='".$row['cat_id']."' name='reportcategory' value='".$row['cat_name']."'/><label for='".$row['cat_id']."'> ".$row['cat_name']." </label>";

		//echo " <input type='button' id='".$row['cat_id']."' name='reportcategory' value='".$row['cat_name']."'/><label for='".$row['cat_id']."'> ".$row['cat_name']." </label>";
		echo "<form action='view_reports_certain_page.php?id='".$row['cat_id']."'> <input type='submit' value='".$row['cat_name']."'></form>";
} // End of WHILE loop.


?>
</div>
