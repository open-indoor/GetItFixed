<?php

require('../_func/db_connect.php'); 

// Start XML file, create parent node

$dom = new DOMDocument("1.0");
$node = $dom->createElement("reports");
$parnode = $dom->appendChild($node);

// Select all the rows in the markers table
$query = "SELECT * FROM greports ";
$result = mysqli_query($dbconnection,$query);
if (!$result) {
  die('Invalid query: ' . mysqli_error());
}



header("Content-type: text/xml");

// Iterate through the rows, adding XML nodes for each

while ($row = @mysqli_fetch_assoc($result)){
  // ADD TO XML DOCUMENT NODE
  $node = $dom->createElement("report");
  $newnode = $parnode->appendChild($node);
  $newnode->setAttribute("id", $row['rep_id']);
  $newnode->setAttribute("category", $row['rep_cat']);
  $newnode->setAttribute("user", $row['rep_userid']);
  $newnode->setAttribute("comment", $row['rep_comment']);
  $newnode->setAttribute("lat", $row['rep_lat']);
  $newnode->setAttribute("lng", $row['rep_lng']);
  $newnode->setAttribute("status", $row['rep_stat']);
}

echo $dom->saveXML();

?>