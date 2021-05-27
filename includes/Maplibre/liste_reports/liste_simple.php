<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

$host = "db";
$db_name = "getitfixed";
$username = "root";
$password = "example";

// Create connection
$mysqli = new mysqli($host, $username, $password,$db_name);

// Check connection
if ($mysqli->connect_error) {
  die("Connection failed: " . $mysqli->connect_error);
}

$query = "SELECT * FROM greports";

$result = $mysqli->query($query);

while ($row = $result->fetch_assoc()) {
    extract($row);

    $agen = [
        "id" => $rep_id,
        "nom" => $rep_name,
        "lat" => $rep_lat,
        "lon" => $rep_lng,
        "rep_stat" => $rep_stat,
        "rep_userid" => $rep_userid,
        "rep_cat" => $rep_cat,
    ];

    $tableauAgences['greports'][] = $agen;
}

// On encode en json et on envoie
echo json_encode($tableauAgences);
?>