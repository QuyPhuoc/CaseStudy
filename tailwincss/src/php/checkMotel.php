<?php
require_once 'dbconnection.php';

function CheckMotel($conn, $title,$phone) {
    $sql = "SELECT title,phone FROM Motel WHERE title = '$title' AND phone = '$phone'";
    $res = $conn->query($sql);
    if($res->num_rows > 0){
        return true;
    }else{
        return false;
    }
    $conn->close();
}
?>