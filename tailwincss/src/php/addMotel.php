<?php
require_once 'dbconnection.php';

function addMotel($title, $description, $price, $area, $address, $latlng, $phone, $utilities){
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

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $title = $_POST['title'];
    $description = $_POST['description'];
    $price = $_POST['price'];
    $area = $_POST['area'];
    $address = $_POST['address'];
    $latlng = $_POST['latlng'];
    $phone = $_POST['phone'];
    $utilities = $_POST['utilities'];

    if (createMotel($title, $description, $price, $area, $address, $latlng, $phone, $utilities)) {
        echo "Thêm phòng trọ thành công!";
    } else {
        echo "Thêm phòng trọ thất bại!";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Room Form</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 min-h-screen flex items-center justify-center">
    <div class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4 w-full max-w-3xl">
        <h2 class="text-2xl font-bold mb-4 text-center">Thêm phòng trọ</h2>

        <form action="process_room.php" method="POST" enctype="multipart/form-data">
            <!-- Title -->
            <div class="mb-4">
                <label class="block text-gray-700 font-bold mb-2" for="title">Title</label>
                <input type="text" name="title" id="title" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" placeholder="Enter room title" required>
            </div>

            <!-- Description -->
            <div class="mb-4">
                <label class="block text-gray-700 font-bold mb-2" for="description">Description</label>
                <textarea name="description" id="description" rows="4" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" placeholder="Enter room description"></textarea>
            </div>

            <!-- Price -->
            <div class="mb-4">
                <label class="block text-gray-700 font-bold mb-2" for="price">Price</label>
                <input type="number" name="price" id="price" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" placeholder="Enter room price" required>
            </div>

            <!-- Area -->
            <div class="mb-4">
                <label class="block text-gray-700 font-bold mb-2" for="area">Area (m²)</label>
                <input type="number" name="area" id="area" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" placeholder="Enter room area" required>
            </div>

            <!-- Address -->
            <div class="mb-4">
                <label class="block text-gray-700 font-bold mb-2" for="address">Address</label>
                <input type="text" name="address" id="address" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" placeholder="Enter address">
            </div>

            <!-- Utilities -->
            <div class="mb-4">
                <label class="block text-gray-700 font-bold mb-2" for="utilities">Utilities</label>
                <input type="text" name="utilities" id="utilities" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" placeholder="e.g., WiFi, AC">
            </div>

            <!-- Phone -->
            <div class="mb-4">
                <label class="block text-gray-700 font-bold mb-2" for="phone">Phone</label>
                <input type="text" name="phone" id="phone" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" placeholder="Enter phone number">
            </div>

            <!-- Images -->
            <div class="mb-4">
                <label class="block text-gray-700 font-bold mb-2" for="images">Images</label>
                <input type="file" name="images" id="images" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
            </div>

            <!-- Submit Button -->
            <div class="flex items-center justify-between">
                <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                    Submit
                </button>
                <button type="reset" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                    Reset
                </button>
            </div>
        </form>
    </div>
</body>
</html>