<?php
require_once 'dbconnection.php';
function CheckUser($username, $email, $phone) {
    $conn = getDBConnection();
    $sql1 = "SELECT Username FROM USER WHERE Username = '$username'";
    $res = $conn->query($sql1);
    if ($res->num_rows > 0) {
        $conn->close();
        return 1;
    }
    
    $sql2 = "SELECT Email FROM USER WHERE Email = '$email'";
    $res = $conn->query($sql2);
    if ($res->num_rows > 0) {
        $conn->close();
        return 2;
    }

    $sql3 = "SELECT Phone FROM USER WHERE Phone = '$phone'";
    $res = $conn->query($sql3);
    if ($res->num_rows > 0) {
        $conn->close();
        return 3;
    }
    
    $conn->close();
    return 0;
}
?>