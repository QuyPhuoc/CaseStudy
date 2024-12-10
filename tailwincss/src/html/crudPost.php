<?php
require_once '../php/dbconnection.php';
function getAllMotels($conn) {
    $sql = "SELECT * FROM Motel";
    $res = $conn->query($sql);

    if($res === TRUE){
        echo "LAY THANH CONG";
    }else{
        echo "Error: ".$sql."<br>".$conn->error;
    }
    $conn->close();
}

function updateMotel($conn, $id, $title, $description, $price, $area, $address, $latlng, $phone, $utilities){
    $sql = "UPDATE Motel SET title = '$title', description = '$description', price = '$price', area = '$area', address = '$address', latlng = '$latlng', phone = '$phone', utilites = '$utilities' WHERE id = '$id'";
    $res = $conn->query($sql);
    if($res->num_rows() > 0){
       
    } 
}

?>