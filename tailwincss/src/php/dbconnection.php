<?php
function getDBConnection(){
$servername = "localhost:3301";
$username = "root";
$password = "root";
$dbname = "GTPT";
$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
return $conn;
}
?>  