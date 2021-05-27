


<?php 
 require_once('../_func/db_connect.php'); 
  header("Content-Type: application/rss+xml; charset=UTF-8");

  $rssfeed = '<?xml version="1.0" encoding="UTF-8" ?>';
  $rssfeed .= '<rss version="2.0">';
  $rssfeed .= '<channel>';
  $rssfeed .= '<title>GetItFixed</title>';
  $rssfeed .= '<link>http://www.google.gr/</link>';
  $rssfeed .= '<description>Town damages reports</description>';
  $rssfeed .= '<language>en-us</language>';
  $rssfeed .= '<copyright>Copyright (C) 2009 getitfixed.com</copyright>';

 

  // Select all the rows in the markers table
$query = "SELECT * FROM greports ORDER BY rep_id DESC LIMIT 20"; // LAST 20 reports !!
$result = mysqli_query($dbconnection,$query);
if (!$result) {
  die('Invalid query: ' . mysqli_error());
}


// Iterate through the rows

//while ($row = @mysqli_fetch_assoc($result)){

  while($row =  @mysqli_fetch_assoc($result)){
        extract($row);

        $rssfeed .= '<item>';
        $rssfeed .= '<title>' . $row['rep_name'] . '</title>';
        $rssfeed .= '<link>' . 'http://www.google.gr/' . '</link>';
        $rssfeed .= '<description>' . 'new report made'. '</description>';
        $rssfeed .= '<category>' . 'tadekathgoria' . '</category>';
        //$rssfeed .= '<pubDate>'.date('M j Y g:i A', strtotime($row['rep_date'])).'</pubDate>';
        $rssfeed .= '</item>';
    }
    

    $rssfeed .= '</channel>';
    $rssfeed .= '</rss>';
 
    echo $rssfeed;
?>