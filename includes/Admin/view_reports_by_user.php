<?php 

	require_once('_func/myfunctions.php');
	require_once ('_func/db_connect.php');
?>
<?php # Script 9.5 - #5

// This script retrieves all the records from the users table.
// This new version allows the results to be sorted in different ways.


//$categoryname=$_GET['catname'];
//$category_to_view=category_id($categoryname)
$category_to_view=$_GET['id'];

echo '<br/>';


// Number of records to show per page:
$display = 20;

// Determine how many pages there are...
if (isset($_GET['p']) && is_numeric($_GET['p'])) { // Already been determined.
	$pages = $_GET['p'];
} else { // Need to determine.
 	// Count the number of records:
	$q = "SELECT COUNT(rep_id) FROM greports WHERE rep_userid='$category_to_view' ";
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
		$order_by = 'rep_name ASC';
		break;
	case 'fn':
		$order_by = 'rep_userid ASC';
		break;
	case 'rd':
		$order_by = 'rep_date ASC';
		break;
	default:
		$order_by = 'urep_date ASC';
		$sort = 'rd';
		break;
}
	
// Make the query:
$q = "SELECT rep_name, rep_cat,rep_userid,rep_stat, DATE_FORMAT(rep_date, '%M %d, %Y') AS dr, rep_id FROM greports WHERE rep_userid='$category_to_view' ORDER BY $order_by LIMIT $start, $display";		
$r = @mysqli_query ($dbconnection, $q); // Run the query.

// Table header:
echo '<div class="table-container">
<table align="center" cellspacing="0" cellpadding="5" width="90%">
<tr>
	<th align="center" colspan="8"> <b>User reports:'.category_name($category_to_view).' </b> </th>
</tr>
<tr>
	<th align="left"><b>ID</b></th>
	<th align="left"><b>Name</b></th>
	<th align="left"><b>User</b></th>
	<th align="left"><b>Category</b></th>
	<th align="left"><b>Date of registration</b></th>
	<th align="left" colspan="3"><b>Condition</b></th>
</tr>
';

// Fetch and print all the records....
$bg = '#eeeeee'; 
while ($row = mysqli_fetch_array($r, MYSQLI_ASSOC)) {
	$bg = ($bg=='#eeeeee' ? '#ffffff' : '#eeeeee');
		echo '<tr bgcolor="' . $bg . '">
		<td align="left">' . $row['rep_id'] . '</td>
		<td align="left"> <a font-color=black href="view_this_report_page.php?id=' . $row['rep_id'] . '">' . $row['rep_name'] . '</a></td>
		<td align="left">' . $row['rep_userid'] . ' - ' . user_data_by_id($row['rep_userid'])['user_fname'] . '</td>
		<td align="left">' . category_name($row['rep_cat']) . '</td>
		<td align="left">' . $row['dr'] . '</td>
		<td align="left"><a href="view_reports_by_status_page.php?status=' . $row['rep_stat'] . '">' . $row['rep_stat'].'</a></td>
		<td align="left"><a font-color=black href="fix_this_report_page.php?id=' . $row['rep_id'] . '">Repair</a></td>
		<td align="left"><a href="delete_this_report_page.php?id=' . $row['rep_id'] . '">Deletion</a></td>

	</tr>
	';
} // End of WHILE loop.

echo '</table> </div>';
mysqli_free_result ($r);
mysqli_close($dbconnection);

// Make the links to other pages, if necessary.
if ($pages > 1) {
	
	echo '<br /><p>';
	$current_page = ($start/$display) + 1;
	
	// If it's not the first page, make a Previous button:
	if ($current_page != 1) {
		echo '<a href="view_reports_certain_page.php?id='.$category_to_view.'&s=' . ($start - $display) . '&p=' . $pages . '&sort=' . $sort . '">Previous</a> ';
	}
	
	// Make all the numbered pages:
	for ($i = 1; $i <= $pages; $i++) {
		if ($i != $current_page) {
			echo '<a href="view_reports_certain_page.php?id='.$category_to_view.'&s=' . (($display * ($i - 1))) . '&p=' . $pages . '&sort=' . $sort . '">' . $i . '</a> ';
		} else {
			echo $i . ' ';
		}
	} // End of FOR loop.
	
	// If it's not the last page, make a Next button:
	if ($current_page != $pages) {
		echo '<a href="view_reports_certain_page.php?id='.$category_to_view.'$s=' . ($start + $display) . '&p=' . $pages . '&sort=' . $sort . '">Next</a>';
	}
	
	echo '</p> <br/><br/>'; // Close the paragraph.
	
} // End of links section.
	
//include ('includes/footer.html');
?>
