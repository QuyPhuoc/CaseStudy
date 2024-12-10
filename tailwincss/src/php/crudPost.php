<?php
require_once 'dbconnection.php';
require_once 'checkMotel.php';
function getAllMotels() {
    $conn = getDBConnection();
    $sql = "SELECT * FROM Motel";
    $res = $conn->query($sql);
    if($res === TRUE){
        return $res;
    }else{
        echo "Loi: ".$sql."<br>".$conn->error;
    }
    $conn->close();
}

function updateMotel($id,$title, $description, $price, $area, $address, $latlng, $phone, $utilities){
    $conn = getDBConnection();
    $sql = "UPDATE Motel SET title = '$title', description = '$description', price = '$price', area = '$area', address = '$address', latlng = '$latlng', phone = '$phone', utilites = '$utilities'  WHERE id = '$id'";
    $res = $conn->query($sql);
    if($res->num_rows() > 0){
       
    } 
}
function deleteMotel($id){
    $conn = getDBConnection();
    $sql = "DELETE FROM Motel WHERE id = '$id'";
    $res = $conn->query($sql);
    if($res->num_rows() > 0){
        echo "Xoa thanh cong";
    } 
}
?>