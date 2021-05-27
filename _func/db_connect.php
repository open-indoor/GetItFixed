<?php 
DEFINE ('DB_USER', 'root');
DEFINE ('DB_PASSWORD', 'example');
DEFINE ('DB_HOST', 'db');
DEFINE ('DB_NAME', 'getitfixed');

// Make the connection:
$dbconnection = @mysqli_connect (DB_HOST, DB_USER, DB_PASSWORD, DB_NAME) OR die ('Could not connect to MySQL: ' . mysqli_connect_error() );

?>