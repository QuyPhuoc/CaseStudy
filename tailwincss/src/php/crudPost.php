<?php
require_once 'dbconnection.php';
require_once 'checkMotel.php';
function getAllMotels() {
    $conn = getDBConnection();
    $sql = "SELECT * FROM Motel";
    $res = $conn->query($sql);
    if($res !== FALSE){
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

function updateMotel($id, $title, $description, $price, $area, $address, $latlng, $phone, $utilities){
    $conn = getDBConnection();
    $sql = "UPDATE Motel SET title = '$title', description = '$description', price = '$price', area = '$area', address = '$address', latlng = '$latlng', phone = '$phone', utilities = '$utilities' WHERE id = '$id'";
    $res = $conn->query($sql);
    if($res === TRUE){
        setcookie("update_status", "Cap nhat thanh cong", time() + 30, "/");
    }else{
        setcookie("update_status", "Loi: ".$sql."<br>".$conn->error, time() + 30, "/");
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
function createMotel($title, $description, $price, $area, $address, $latlng, $phone, $utilities){
    $conn = getDBConnection();
    $sql = "INSERT INTO Motel (title, description, price, area, address, latlng, phone, utilities) VALUES ('$title', '$description', '$price', '$area', '$address', '$latlng', '$phone', '$utilities')";
    $res = $conn->query($sql);
    if($res === TRUE){
        return true;
    }else{
        echo "Loi: ".$sql."<br>".$conn->error;
        return false;
    }
}

function updateCountView($id){
    $conn = getDBConnection();
        // Tạo tên cookie duy nhất cho bài viết
        $cookieName = "View" . $id;
        // Kiểm tra xem người dùng đã xem bài viết này chưa
        if (!isset($_COOKIE[$cookieName])) {
            // Cập nhật lượt xem trong cơ sở dữ liệu
            $sql = "UPDATE rooms SET count_view = count_view + 1 WHERE ID = ?";
            $res = $conn->query($sql);
            if ($res) {
                // Đặt cookie để ngăn tăng lượt xem nhiều lần
                setcookie($cookieName, true, time() + 30, "/"); // Cookie có hiệu lực trong 30s
            }
        }
}
?>  