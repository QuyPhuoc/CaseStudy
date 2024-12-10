<?php
require_once 'dbconnection.php';
require_once 'checkMotel.php';
function getAllMotels() {
    $conn = getDBConnection();
    $sql = "SELECT * FROM Motel";
    $res = $conn->query($sql);
    if($res === TRUE){
        $result = array();
        while($row = $res->fetch_assoc()){
            $result[] = $row;
        }
        return json_encode($result);
    }else{
        echo "Loi: ".$sql."<br>".$conn->error;
    }
    $conn->close();
}

function updateMotel($id,$title, $description, $price, $area, $address, $latlng, $phone, $utilities){
    $conn = getDBConnection();
    $sql = "UPDATE Motel SET title = '$title', description = '$description', price = '$price', area = '$area', address = '$address', latlng = '$latlng', phone = '$phone', utilites = '$utilities'  WHERE id = '$id'";
    $res = $conn->query($sql);
    if($res === TRUE){
        echo "Cap nhat thanh cong";
    }else{
        echo "Loi: ".$sql."<br>".$conn->error;
    }
}
function deleteMotel($id){
    $conn = getDBConnection();
    $sql = "DELETE FROM Motel WHERE id = '$id'";
    $res = $conn->query($sql);
    if($res === TRUE){
        echo "Xoa thanh cong";
    }else{
        echo "Loi: ".$sql."<br>".$conn->error;
    }
}
?>