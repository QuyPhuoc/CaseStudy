<?php
require_once '../php/dbconnection.php';
function getAvatar($username){
    $conn = getDBConnection();
    if($conn->connect_error){
        echo "<script>window.alert(".$conn->connect_error.")</script>";
    }
    $sql = "SELECT Avatar FROM USER WHERE Username = '$username'";
    $result = $conn->query($sql);
    if($result->num_rows > 0){
        $row = $result->fetch_assoc();
        return $row['Avatar'];
    }else{
        return '';
    }
}
?>
