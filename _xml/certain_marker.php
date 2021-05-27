<?php

require('../_func/db_connect.php'); 

// Start XML file, create parent node

$reptoview=$_GET['id'];
//$reptoview='11';

$dom = new DOMDocument("1.0");
$node = $dom->createElement("reports");
$parnode = $dom->appendChild($node);

// Select all the rows in the markers table
$query = "SELECT * FROM greports WHERE rep_id='$reptoview' "; 
$result = mysqli_query($dbconnection,$query);
if (!$result) {
  die('Invalid query: ' . mysqli_error());
}



//header("Content-type: text/xml");

// Iterate through the rows, adding XML nodes for each

while ($row = @mysqli_fetch_assoc($result)){
  // ADD TO XML DOCUMENT NODE
  $node = $dom->createElement("report");
  $newnode = $parnode->appendChild($node);
  $newnode->setAttribute("name", $row['rep_name']);
  $newnode->setAttribute("id", $row['rep_id']);
  $newnode->setAttribute("category", $row['rep_cat']);
  $newnode->setAttribute("user", $row['rep_userid']);
  $newnode->setAttribute("comment", $row['rep_comment']);
  $newnode->setAttribute("adminname", $row['rep_adminname']);
  $newnode->setAttribute("lat", $row['rep_lat']);
  $newnode->setAttribute("lng", $row['rep_lng']);
  $newnode->setAttribute("status", $row['rep_stat']);
}

echo $dom->saveXML();
header("Content-type: text/xml");
?>