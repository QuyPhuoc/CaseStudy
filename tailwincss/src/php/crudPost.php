<?php
require 'dbconnection.php';
require 'checkMotel.php';
function getAllMotels() {
    $conn = getDBConnection();
    $sql = "SELECT title, description, price, area, count_view, address, latlng, images,Motel.phone,utilities,created_at ,USER.Username FROM Motel join USER on Motel.user_id = USER.ID";
    $res = $conn->query($sql);
    if($res->num_rows > 0){
     while($row = $res->fetch_assoc()){
        $date = date("d-m-Y", strtotime($row['created_at']));
        echo "<div class='motel-info text-clip mt-12 bg-green-200 p-4 m-4 border border-black block text-center text-black hover:bg-blue-500 hover:cursor-pointer rounded-2xl'>
        <h1 class=' font-bold capitalize text-5xl text-left'>".$row['title']."</h1>
        <img src='".$row['images']."' alt='' class=' object-contain mt-4'>
        <div class=' text-left text-pretty'>
        <div> 
        <span class='font-bold'>Mô tả: </span>".$row['description']."
        </div>

        <div>
        <span class='font-bold'>Người đăng: </span>".$row['Username']."
        </div>

        <div>
        <span class='font-bold'>Giá: </span>".$row['price']."d/thang"."
        </div>

        <div>
        <span class='font-bold'>Diện tích: </span>".$row['area']."m2"."
        </div>

        <div>
        <span class='font-bold'>Địa chỉ: </span>".$row['address']."
        </div>

        <div>
        <span class='font-bold'>Ngay dang: </span>".$date."
        </div>

        <div>
        <span class='font-bold'>Số điện thoại: </span>".$row['phone']."
        </div>



        </div>
        </div>";
     }
    }
}
function getMotelsById($id) {
    $conn = getDBConnection();
    $sql = "SELECT title, description, price, area, count_view, address, latlng, images,Motel.phone,utilities, USER.Username FROM Motel join USER on Motel.user_id = USER.ID";
    $res = $conn->query($sql);
    if($res->num_rows > 0){
     while($row = $res->fetch_assoc()){
         echo "<div class='motel-info text-clip mt-12 bg-green-200 p-4 m-4 border border-black block text-center text-black hover:bg-blue-500 rounded-2xl max-w-60 max-h-60'>
         <h1 class=' font-bold capitalize text-5xl text-left'>".$row['title']."</h1>
         <img src='".$row['images']."' alt='' class=' object-contain mt-4'>
         <div class=''>
         <p>".$row['description']."</p>
         <p>".$row['Username']."</p>
         <p>".$row['price']."</p>
         <p>".$row['area']."</p>
         <p>".$row['address']."</p>
         <p>".$row['latlng']."</p>
         <p>".$row['phone']."</p>
         <p>".$row['utilities']."</p>
         </div>
         </div>";
     }
    }
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

?>  