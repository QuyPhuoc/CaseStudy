<?php
require_once 'dbconnection.php';

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
    <link rel="stylesheet" href="../asset/css/style.css">
</head>
<body class="bg-cover bg-center bg-fixed" style="background-image: url('../asset/imgAva/canhovipvip.jpg');">
    <h1 class="text-center text-white text-4xl mt-10 shadow-lg">Đăng Tin Phòng Trọ</h1>
    <form method="POST" enctype="multipart/form-data" class="bg-white bg-opacity-90 p-8 max-w-lg mx-auto mt-10 rounded-lg shadow-xl">
        <div class="form-group mb-4">
            <label for="title" class="block text-gray-700">Tiêu đề:</label>
            <input type="text" name="title" id="title" placeholder="Tên phòng trọ" required class="w-full px-3 py-2 border rounded">
        </div>

        <div class="form-group mb-4">
            <label for="description" class="block text-gray-700">Mô tả chi tiết:</label>
            <textarea name="description" id="description" placeholder="Mô tả chi tiết phòng trọ" required class="w-full px-3 py-2 border rounded"></textarea>
        </div>

        <div class="form-group mb-4">
            <label for="price" class="block text-gray-700">Giá phòng trọ:</label>
            <input type="number" name="price" id="price" placeholder="Giá phòng" required class="w-full px-3 py-2 border rounded">
        </div>

        <div class="form-group mb-4">
            <label for="area" class="block text-gray-700">Diện tích phòng trọ (m²):</label>
            <input type="number" name="area" id="area" placeholder="Diện tích phòng" required class="w-full px-3 py-2 border rounded">
        </div>

        <div class="form-group mb-4">
            <label for="address" class="block text-gray-700">Địa chỉ trọ:</label>
            <input type="text" name="address" id="address" placeholder="Địa chỉ phòng trọ" required class="w-full px-3 py-2 border rounded">
        </div>

        <div class="form-group mb-4">
            <label for="latlng" class="block text-gray-700">Bản đồ:</label>
            <input type="text" name="latlng" id="latlng" placeholder="Bản đồ phòng trọ" required class="w-full px-3 py-2 border rounded">
        </div>

        <div class="form-group mb-4">
            <label for="images" class="block text-gray-700">Hình ảnh phòng trọ:</label>
            <input type="file" name="images" id="images" accept="image/*" required class="w-full px-3 py-2 border rounded">
        </div>

        <div class="form-group mb-4">
            <label for="phone" class="block text-gray-700">Số điện thoại chủ trọ:</label>
            <input type="text" name="phone" id="phone" placeholder="Số điện thoại chủ trọ" required class="w-full px-3 py-2 border rounded">
        </div>

        <div class="form-group mb-4">
            <label for="utilities" class="block text-gray-700">Các tiện ích:</label>
            <input type="text" name="utilities" id="utilities" placeholder="Các tiện ích" required class="w-full px-3 py-2 border rounded">
        </div>

        <div class="form-group mb-4">
            <label for="category_id" class="block text-gray-700">Loại phòng:</label>
            <select name="category_id" id="category_id" class="w-full px-3 py-2 border rounded">
                <option value="1">Loại phòng khong phan loai</option>
                <option value="2">Loại phòng dan</option>
                <option value="3">Loại phòng cao cap</option>
            </select>
        </div>

        <div class="form-group mb-4">
            <label for="district_id" class="block text-gray-700">Khu vực:</label>
            <select name="district_id" id="district_id" class="w-full px-3 py-2 border rounded">
                <option value="1">Khu vực nội thành</option>
                <option value="2">Khu vực ngoại thành</option>
                <option value="3">Khu vực gần trường học</option>
            </select>
        </div>

        <div class="form-group">
            <input type="submit" name="add" value="Đăng bài" class="w-full bg-blue-500 text-white py-2 rounded hover:bg-blue-700">
        </div>
    </form>
</body>
</html>
