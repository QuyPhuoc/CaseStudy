<?php
require 'dbconnection.php';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $input = json_decode(file_get_contents('php://input'), true);
    
    if (isset($input['action']) && $input['action'] === 'your_function_name') {
        your_function_name();
    }
}

function sortPost($sort){
    $conn = getDBConnection();
    if($conn->connect_error){
        echo "<script>window.alert(".$conn->connect_error.")</script>";
    }
    $sql = "SELECT * FROM post ORDER BY $sort";
    $result = $conn->query($sql);
    if($result->num_rows > 0){
        while($row = $res->fetch_assoc()){
            $data[] = $row;
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
    }else{
        echo "<script>window.alert('Error: ".$sql."<br>".$conn->error."')</script>";
    }
    echo json_encode($data);
}
?>