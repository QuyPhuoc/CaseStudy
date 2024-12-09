<?php
require_once '../php/dbconnection.php';
function createuser($Name,$username,$password,$email,$phone,$Avatar){
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
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $avatar = '';

    if (isset($_FILES['avatar']) && $_FILES['avatar']['error'] == 0) {
        $target_dir = "../asset/img/";
        $target_file = $target_dir . $timestamp . "_" . $username . ".png";
        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

        // Check if image file is a actual image or fake image
        $check = getimagesize($_FILES["avatar"]["tmp_name"]);
        if ($check !== false) {
            if (move_uploaded_file($_FILES["avatar"]["tmp_name"], $target_file)) {
                $avatar = $target_file;
            } else {
                echo "Loi upload.";
            }
        } else {
            echo "File khong hop le.";
        }
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
    <div class="container mx-auto px-4 py-8">
        <div class="max-w-md mx-auto bg-white p-6 rounded-lg shadow-md">
            <h2 class="text-2xl font-bold mb-6 text-center">Create New User</h2>
            <form action="newuser.php" method="post" enctype="multipart/form-data">
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
                    <input type="file" id="avatar" name="avatar" class="w-full px-3 py-2 border rounded-lg" required>
                </div>
                <div class="text-center">
                    <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-lg">Create User</button>
                </div>
            </form>
        </div>
    </div>
</body>
</html>