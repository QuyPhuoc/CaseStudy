<?php
require_once 'dbconnection.php';
$conn = getDBConnection();
// Khởi tạo biến $count_view với giá trị mặc định
$count_view = 0;

// Lấy `item_id` từ yêu cầu GET (ví dụ từ URL)
$id = isset($_GET['id']) ? intval($_GET['id']) : 0;

// Xử lý tăng lượt xem
if ($id > 0) {
    // Kiểm tra xem item đã tồn tại trong bảng chưa
    $sql = "SELECT * FROM motel WHERE id = $id";
    $res = $conn->query($sql);
    if($res !== FALSE){
        $result = array();
        while($row = $res->fetch_assoc()){
            $result[] = $row;
        }
        return json_encode($result);
    }
    if ($result->num_rows() > 0) {
        // Nếu đã tồn tại, tăng view_count lên 1
        $sql = "UPDATE motel SET count_view = $count_view + 1 WHERE id = $id";
        $res = $conn->query($sql);
        if($res !== FALSE){
            setcookie("update_status", "Cap nhat thanh cong", time() + 30, "/");
    } else {
        // Nếu chưa tồn tại, thêm một hàng mới
        $sql = "INSERT INTO motel ($id, $count_view) VALUES (?, 1)";
        $res = $conn->query($sql);  
        if($res === TRUE){
            setcookie("update_status", "Cap nhat thanh cong", time() + 30, "/");
    } 
    $conn->close();
}
    }
}
// Lấy tổng lượt xem hiện tại
$sql = "SELECT count_view FROM motel WHERE id = $id";
$res = $conn->query($sql);
if($res !== FALSE && $res->num_rows > 0){
    $result = array();
    while($row = $res->fetch_assoc()){
        $result[] = $row;
    }
    echo json_encode($result);
    $count_view = $result[0]['count_view'];
}

// Đóng kết nối
$conn->close();
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nhà đẹp</title>
    <link rel="stylesheet" href="../asset/css/styleCount.css">
    <style>
        * {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
}

/* Chế độ nền */
body {
    font-family: Arial, sans-serif;
    background-color: #f4f4f4;
    display: flex;
    justify-content: center;
    align-items: center;
    height: 100vh;
}

.container {
    display: flex;
    justify-content: center;
    align-items: center;
    padding: 20px;
    font-family: Arial, sans-serif;
}

.video-card {
    background: #fff;
    border-radius: 12px;
    box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
    overflow: hidden;
    width: 300px;
    text-align: center;
    transition: transform 0.3s ease, box-shadow 0.3s ease;
}

.video-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 6px 15px rgba(0, 0, 0, 0.3);
}

.badge {
    position: absolute;
    top: 10px;
    left: 10px;
    background: #ff5f5f;
    color: #fff;
    padding: 5px 10px;
    border-radius: 8px;
    font-size: 12px;
    font-weight: bold;
}

.thumbnail {
    width: 100%;
    height: 200px;
    object-fit: cover;
}

.video-info {
    padding: 15px;
}

.title {
    font-size: 18px;
    font-weight: bold;
    margin-bottom: 10px;
    color: #333;
}

.views {
    display: flex;
    flex-direction: column; /* Đặt biểu tượng và số lượt xem theo cột */
    justify-content: center;
    align-items: center;
    font-size: 14px;
    color: #666;
    margin-bottom: 10px;
    position: relative;
}

.views::before {
    content: '\1F441'; /* Unicode cho biểu tượng mắt */
    font-size: 24px; /* Kích thước biểu tượng */
    color: #666;
    margin-bottom: 5px; /* Khoảng cách giữa biểu tượng và số lượt xem */
}

.views span {
    font-size: 16px; /* Kích thước số lượt xem */
}

.watch-btn {
    background: #ff5f5f;
    color: #fff;
    border: none;
    padding: 10px 20px;
    border-radius: 20px;
    font-size: 14px;
    cursor: pointer;
    transition: background 0.3s ease;
}

.watch-btn:hover {
    background: #e04e4e;
}

    </style>
</head>
<body>

    <div class="container">
        <div class="video-card">
            <div class="badge">Nhà đẹp</div>
            <img src="../asset/imgAva/canhovipvip.jpg" alt="Video Thumbnail" class="thumbnail">
            <div class="video-info">
                <h3 class="title">Nhà đẹp siêu cấp vip vip pro</h3>
                <p class="views"><span id="count_view"><?php echo $count_view; ?></span></p>
                <button class="watch-btn" onclick="increaseViewCount()">Xem</button>
            </div>
        </div>
    </div>

    <script>
        function increaseViewCount() {
            // Gửi yêu cầu AJAX đến Count_View.php để tăng lượt xem
            fetch('Count_View.php?item_id=1')
                .then(response => response.text())
                .then(data => {
                    // Cập nhật lượt xem trên trang
                    document.getElementById('view-count').innerText = data;
                });
        }
    </script>

</body>
</html>
