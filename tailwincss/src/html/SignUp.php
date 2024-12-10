<?php
require_once '../php/dbconnection.php';
function createuser($Name,$username,$password,$email,$phone,$Avatar){
    $Name = addslashes($Name);
    $username = addslashes($username);
    $email = addslashes($email);
    $phone = addslashes($phone);
    $Avatar = addslashes($Avatar);
    $passwordenc = md5($password);
    $conn = getDBConnection();
    if($conn->connect_error){
        echo "<script>window.alert(".$conn->connect_error.")</script>";
    }
    $sql = "INSERT INTO USER (Name,Username,Password,Email,Phone,Avatar) VALUES ('$Name','$username','$passwordenc','$email','$phone','$Avatar')";
    if($conn->query($sql) === TRUE){
        echo "New record created successfully";
    }else{
        echo "Error: ".$sql."<br>".$conn->error;
    }
    $conn->close();
}
?>
<?php
require_once '../php/dbconnection.php';
function createuserNoAva($Name,$username,$password,$email,$phone){
    $Name = addslashes($Name);
    $username = addslashes($username);
    $email = addslashes($email);
    $phone = addslashes($phone);
    $passwordenc = md5($password);
    $conn = getDBConnection();  
    if($conn->connect_error){
        echo "<script>window.alert(".$conn->connect_error.")</script>";
    }
    $sql = "INSERT INTO USER (Name,Username,Password,Email,Phone) VALUES ('$Name','$username','$passwordenc','$email','$phone')";
    if($conn->query($sql) === TRUE){
        echo "Tao tai khoan thanh cong";
    }else{
        echo "Error: ".$sql."<br>".$conn->error;
    }
    $conn->close();
}
?>
<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $Name = $_POST['Name'];
    $username = $_POST['username'];
    $timestamp = time();
    $password = $_POST['password'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $avatar = '';

    if (isset($_FILES['avatar']) && $_FILES['avatar']['error'] == 0) {
        $target_dir = "../asset/imgAva/";
        $target_file = $target_dir . $timestamp . "_" . $username . ".png";
        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

        // Check if image file is a actual image or fake image
        $check = getimagesize($_FILES["avatar"]["tmp_name"]);
        if ($check !== false) {
            $allowed_types = array('jpg', 'jpeg', 'png','webp','webmp','gif');
            if (in_array($imageFileType, $allowed_types)) {
                if (move_uploaded_file($_FILES["avatar"]["tmp_name"], $target_file)) {
                    $avatar = $target_file;
                } else {
                    echo "<script>window.alert('Upload file that bai.')</script>";
                }
            } else {
                echo "<script>window.alert('Chi chap nhan dinh dang png,jpeg,jpg,webmp.";
            }
        } else {
            echo "<script>window.alert('File khong phai la anh.')</script>";
        }
    }
    else
    {
        createuserNoAva($Name,$username, $password, $email, $phone);
    }
    createuser($Name,$username, $password, $email, $phone, $avatar);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create New User</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-bg bg-no-repeat bg-cover">
    <div class="container mx-auto px-4 py-8 relative">
        <div class="max-w-md mx-auto bg-white p-6 rounded-lg shadow-md">
            <h2 class="text-2xl font-bold mb-6 text-center">Create New User</h2>
            <form action="" method="post" enctype="multipart/form-data">
                <div class="mb-4">
                    <label for="Name" class="block text-gray-700">Name:</label>
                    <input type="text" id="Name" name="Name" class="w-full px-3 py-2 border rounded-lg" required>
                </div>
                <div class="mb-4">
                    <label for="username" class="block text-gray-700">Username:</label>
                    <input type="text" id="username" name="username" class="w-full px-3 py-2 border rounded-lg" required>
                </div>
                <div class="mb-4">
                    <label for="password" class="block text-gray-700">Password:</label>
                    <input type="password" id="password" name="password" class="w-full px-3 py-2 border rounded-lg" required>
                </div>
                <div class="mb-4">
                    <label for="email" class="block text-gray-700">Email:</label>
                    <input type="email" id="email" name="email" class="w-full px-3 py-2 border rounded-lg" required>
                </div>
                <div class="mb-4">
                    <label for="phone" class="block text-gray-700">Phone:</label>
                    <input type="text" id="phone" name="phone" class="w-full px-3 py-2 border rounded-lg" required>
                </div>
                <div class="mb-4">
                    <label for="avatar" class="block text-gray-700">Avatar:</label>
                    <input type="file" id="avatar" name="avatar" class="w-full px-3 py-2 border rounded-lg">
                </div>
                <div class="text-center">
                    <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-lg">Tao tk</button>
                </div>
            </form>
        </div>
    </div>
</body>
</html>