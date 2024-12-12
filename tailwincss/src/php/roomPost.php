<?php
require_once '../php/dbconnection.php';

function addMotel($conn, $title, $description, $price, $area, $address, $latlng, $imagePath, $phone, $utilities, $category_id, $district_id) {
    $stmt = $conn->prepare("INSERT INTO Motel (title, description, price, area, address, latlng, images, phone, utilities, category_id, district_id, created_at) 
                            VALUES ('$title', '$description', '$price', '$area', '$address', '$latlng', '$imagePath', '$phone', '$utilities', '$category_id', '$district_id', NOW()");
    if ($stmt) {
        $stmt->bind_param("ssdssssssii", $title, $description, $price, $area, $address, $latlng, $imagePath, $phone, $utilities, $category_id, $district_id);
        if ($stmt->execute()) {
            echo "Motel added successfully!";
        } else {
            echo "Error: Could not add motel. Please try again later.";
        }
        $stmt->close();
    } else {
        echo "Error: Failed to prepare the statement.";
    }
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['add'])) {
    $title = htmlspecialchars($_POST['title']);
    $description = htmlspecialchars($_POST['description']);
    $price = floatval($_POST['price']);
    $area = floatval($_POST['area']);
    $address = htmlspecialchars($_POST['address']);
    $latlng = htmlspecialchars($_POST['latlng']);
    $phone = htmlspecialchars($_POST['phone']);
    $utilities = htmlspecialchars($_POST['utilities']);
    $category_id = intval($_POST['category_id']);
    $district_id = intval($_POST['district_id']);

    if (isset($_FILES['images']) && $_FILES['images']['error'] == 0) {
        $allowedTypes = ['image/jpeg', 'image/png', 'image/gif'];
        if (in_array($_FILES['images']['type'], $allowedTypes)) {
            $uploadDir = '../uploads/';
            $imageName = uniqid() . "_" . basename($_FILES['images']['name']);
            $imagePath = $uploadDir . $imageName;

            if (move_uploaded_file($_FILES['images']['tmp_name'], $imagePath)) {
                addMotel($conn, $title, $description, $price, $area, $address, $latlng, $imagePath, $phone, $utilities, $category_id, $district_id);
            } else {
                echo "Error: Failed to upload the image.";
            }
        } else {
            echo "Error: Invalid file type. Please upload a JPEG, PNG, or GIF image.";
        }
    } else {
        echo "Error: No image uploaded or an error occurred.";
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đăng Tin Phòng Trọ</title>
    <link rel="stylesheet" href="../asset/css/styleRoom.css">
    <style>
        @keyframes backgroundMove {
            0% {
                background-position: 0 0;
            }
            100% {
                background-position: 100% 100%;
            }
        }

        body {
            background: url('../asset/imgAva/canhovipvip.jpg') no-repeat center center fixed;
            background-size: cover;
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            color: #333;
            animation: backgroundMove 20s linear infinite;
        }

        h1 {
            text-align: center;
            margin-top: 20px;
            color: #fff;
            text-shadow: 2px 2px 5px rgba(0, 0, 0, 0.7);
        }

        .form-group {
            margin: 15px 0;
        }

        form {
            background: rgba(255, 255, 255, 0.9); 
            padding: 20px;
            max-width: 500px;
            margin: auto;
            border-radius: 8px;
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.3);
        }
    </style>

</head>
<body>
    <h1>Đăng Tin Phòng Trọ</h1>
    <form method="POST" enctype="multipart/form-data">
        <div class="form-group">
            <label for="title">Tiêu đề:</label>
            <input type="text" name="title" id="title" placeholder="Tên phòng trọ" required>
        </div>

        <div class="form-group">
            <label for="description">Mô tả chi tiết:</label>
            <textarea name="description" id="description" placeholder="Mô tả chi tiết phòng trọ" required></textarea>
        </div>

        <div class="form-group">
            <label for="price">Giá phòng trọ:</label>
            <input type="number" name="price" id="price" placeholder="Giá phòng" required>
        </div>

        <div class="form-group">
            <label for="area">Diện tích phòng trọ (m²):</label>
            <input type="number" name="area" id="area" placeholder="Diện tích phòng" required>
        </div>

        <div class="form-group">
            <label for="address">Địa chỉ trọ:</label>
            <input type="text" name="address" id="address" placeholder="Địa chỉ phòng trọ" required>
        </div>

        <div class="form-group">
            <label for="latlng">Bản đồ:</label>
            <input type="text" name="latlng" id="latlng" placeholder="Bản đồ phòng trọ" required>
        </div>

        <div class="form-group">
            <label for="images">Hình ảnh phòng trọ:</label>
            <input type="file" name="images" id="images" accept="image/*" required>
        </div>

        <div class="form-group">
            <label for="phone">Số điện thoại chủ trọ:</label>
            <input type="text" name="phone" id="phone" placeholder="Số điện thoại chủ trọ" required>
        </div>

        <div class="form-group">
            <label for="utilities">Các tiện ích:</label>
            <input type="text" name="utilities" id="utilities" placeholder="Các tiện ích" required>
        </div>

        <div class="form-group">
            <label for="category_id">Loại phòng:</label>
            <select name="category_id" id="category_id">
                <option value="1">Loại phòng giá rẻ</option>
                <option value="2">Loại phòng bình thường</option>
                <option value="3">Loại phòng giá cao</option>
            </select>
        </div>

        <div class="form-group">
            <label for="district_id">Khu vực:</label>
            <select name="district_id" id="district_id">
                <option value="1">Khu vực nội thành</option>
                <option value="2">Khu vực ngoại thành</option>
                <option value="3">Khu vực gần trường học</option>
            </select>
        </div>

        <div class="form-group">
            <input type="submit" name="add" value="Đăng bài">
        </div>
    </form>
</body>
</html>
