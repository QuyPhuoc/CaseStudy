<?php 
require '../php/dbconnection.php';
require 'checkUserEmailPhone.php';
// function createuser($Name,$username,$password,$email,$phone,$Avatar){
//     $Name = addslashes($Name);
//     $username = addslashes($username);
//     $email = addslashes($email);
//     $phone = addslashes($phone);
//     $Avatar = addslashes($Avatar);
//     $passwordenc = md5($password);
//     $conn = getDBConnection();
//     if($conn->connect_error){
//         echo "<script>window.alert(".$conn->connect_error.")</script>";
//     }
//     $sql = "INSERT INTO USER (Name,Username,Password,Email,Phone,Avatar) VALUES ('$Name','$username','$passwordenc','$email','$phone','$Avatar')";
//     if($conn->query($sql) === TRUE){
//         echo "<script>window.alert('Tao tai khoan thanh cong')</script>";
//     }else{
//         echo "<script>window.alert('Error: ".$sql."<br>".$conn->error."')</script>";
//     }
//     $conn->close();
// }
$conn = getDBConnection();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['add_user'])) {
        // Add user
        $name = $_POST['name'];
        $username = $_POST['username'];
        $email = $_POST['email'];
        $password = md5($_POST['password']);
        $role = $_POST['role'];
        $phone = $_POST['phone'];

        switch (CheckUser($username, $email, $phone)) {
            case 1:
                echo "<script>window.alert('Ten dang nhap da ton tai.')</script>";
                break;
            case 2:
                echo "<script>window.alert('Email da ton tai.')</script>";
                break;
            case 3:
                echo "<script>window.alert('So dien thoai da ton tai.')</script>";
                break;
            case 0:
                $sql = "INSERT INTO user (name, username, email, password, role, phone) VALUES ('$name', '$username', '$email', '$password', '$role', '$phone')";
            if ($conn->query($sql) === TRUE) {
                echo "Thêm người dùng thành công!";
            } else {
                echo "Error: " . $sql . "<br>" . $conn->error;
            }
                break;
        }
            
    }
}
$sql = "SELECT * FROM user";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin User Management</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100 min-h-screen flex items-center justify-center">
    <div class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4 w-full max-w-3xl">
        <h2 class="text-2xl font-bold mb-4 text-center">Admin - User Management</h2>

        <form method="POST" action="">
            <input type="hidden" name="add_user" value="1">
            <div class="mb-4">
                <label class="block text-gray-700 font-bold mb-2" for="name">Name</label>
                <input type="text" name="name" id="name" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
            </div>
            <div class="mb-4">
                <label class="block text-gray-700 font-bold mb-2" for="username">Username</label>
                <input type="text" name="username" id="username" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
            </div>
            <div class="mb-4">
                <label class="block text-gray-700 font-bold mb-2" for="email">Email</label>
                <input type="email" name="email" id="email" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
            </div>
            <div class="mb-4">
                <label class="block text-gray-700 font-bold mb-2" for="password">Password</label>
                <input type="password" name="password" id="password" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
            </div>
            <div class="mb-4">
                <label class="block text-gray-700 font-bold mb-2" for="role">Role</label>
                <select name="role" id="role" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                    <option value="1">Admin</option>
                    <option value="2" selected>User</option>
                </select>
            </div>
            <div class="mb-4">
                <label class="block text-gray-700 font-bold mb-2" for="phone">Phone</label>
                <input type="text" name="phone" id="phone" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
            </div>
            <div class="flex items-center justify-between">
                <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                    Add User
                </button>
            </div>
        </form>
        <hr/>
</body>
</html>