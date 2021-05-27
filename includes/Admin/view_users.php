
<?php # Script 9.5 - #5

// This script retrieves all the records from the users table.
// This new version allows the results to be sorted in different ways.





echo '<br/>';

require_once ('_func/db_connect.php');

// Number of records to show per page:
$display = 20;

// Determine how many pages there are...
if (isset($_GET['p']) && is_numeric($_GET['p'])) { // Already been determined.
	$pages = $_GET['p'];
} else { // Need to determine.
 	// Count the number of records:
	$q = "SELECT COUNT(user_id) FROM gusers";
	$r = @mysqli_query ($dbconnection, $q);
	$row = @mysqli_fetch_array ($r, MYSQLI_NUM);
	$records = $row[0];
	// Calculate the number of pages...
	if ($records > $display) { // More than 1 page.
		$pages = ceil ($records/$display);
	} else {
		$pages = 1;
	}
} // End of p IF.

// Determine where in the database to start returning results...
if (isset($_GET['s']) && is_numeric($_GET['s'])) {
	$start = $_GET['s'];
} else {
	$start = 0;
}

// Determine the sort...
// Default is by registration date.
$sort = (isset($_GET['sort'])) ? $_GET['sort'] : 'rd';

// Determine the sorting order:
switch ($sort) {
	case 'ln':
		$order_by = 'user_lname DESC';
		break;
	case 'id':
		$order_by = 'user_id ASC';
		break;
	case 'rd':
		$order_by = 'user_date ASC';
		break;
	default:
		$order_by = 'user_date ASC';
		$sort = 'rd';
		break;
}
	
// Make the query:
$q = "SELECT user_lname, user_fname,user_email, DATE_FORMAT(user_date, '%M %d, %Y') AS dr, user_id FROM gusers ORDER BY '$order_by' ASC LIMIT $start, $display";		
$r = @mysqli_query ($dbconnection, $q); // Run the query.

// Table header:
echo '<div class="table-container">
<table align="center" cellspacing="0" cellpadding="5" width="90%">
<tr>
	<th align="center" colspan="6"> <b>Registered Users</b> </th>
</tr>
<tr>
	<th align="left"><b>ID</b></th>
	<th align="left"><b>Last name</b></th>
	<th align="left"><b>Name</b></th>
	<th align="left"><b>e-mail</b></th>
	<th align="left" colspan="4"><b>Registration date</b></th>
</tr>
';

// Fetch and print all the records....
$bg = '#eeeeee'; 
while ($row = mysqli_fetch_array($r, MYSQLI_ASSOC)) {
	$bg = ($bg=='#eeeeee' ? '#ffffff' : '#eeeeee');
		echo '<tr bgcolor="' . $bg . '">
		<td align="left">' . $row['user_id'] . '</td>
		<td align="left">' . $row['user_lname'] . '</td>
		<td align="left">' . $row['user_fname'] . '</td>
		<td align="left">' . $row['user_email'] . '</td>
		<td align="left">' . $row['dr'] . '</td>
		<td align="left"> <a font-color=black href="view_reports_by_user_page.php?id='.$row['user_id'].'"> References</a><a font-color=black href="user_markers_page.php?id='.$row['user_id'].'"> (On the map) </a>  </td>
		<td align="left"><a font-color=black href="edit_this_user_page.php?id=' . $row['user_id'] . '">Processing</a></td>
		<td align="left"><a href="includes/Admin/delete_user.php?id=' . $row['user_id'] . '">Deletion</a></td>

	</tr>
	';
} // End of WHILE loop.

echo '</table> </div>';
mysqli_free_result ($r);
mysqli_close($dbconnection);

// Make the links to other pages, if necessary.
if ($pages > 1) {
	
	echo '<br /><p>';
	echo "<div id='pagination'>";

	$current_page = ($start/$display) + 1;
	
	// If it's not the first page, make a Previous button:
	if ($current_page != 1) {
		echo '<a href="view_users_page.php?s=' . ($start - $display) . '&p=' . $pages . '&sort=' . $sort . '">< Previous</a> ';
	}
	
	// Make all the numbered pages:
	for ($i = 1; $i <= $pages; $i++) {
		if ($i != $current_page) {
			echo '<a href="view_users_page.php?s=' . (($display * ($i - 1))) . '&p=' . $pages . '&sort=' . $sort . '">' . $i . '</a> ';
		} else {
			echo'<span class="current"> '.$i . '</span>  ';
		}
	} // End of FOR loop.
	
	// If it's not the last page, make a Next button:
	if ($current_page != $pages) {
		echo '<a href="view_users_page.php?s=' . ($start + $display) . '&p=' . $pages . '&sort=' . $sort . '">Next></a>';
	}
	echo "</div>";
	echo '</p> <br/><br/>';// Close the paragraph.
	
} // End of links section.
	
//include ('includes/footer.html');
?>
