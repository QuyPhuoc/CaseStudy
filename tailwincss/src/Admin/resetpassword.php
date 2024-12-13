<?php
require 'dbconnection.php';
require 'checkUserEmailPhone.php';
$conn = getDBConnection();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['reset_password'])) {
        // Reset password
        $id = $_POST['id'];
        $password = md5($_POST['password']);
       $sql = "UPDATE user SET password='$password' WHERE id='$id'";
        if ($conn->query($sql) === TRUE) {
            echo "Reset mật khẩu thành công!";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
        }
        
    }
$sql = "SELECT * FROM user";
$res = $conn->query($sql);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <title>Reset Password</title>
</head>
<body class="bg-gray-100 min-h-screen flex items-center justify-center">
    <div class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4 w-full max-w-3xl">
    <h2 class="text-2xl font-bold mb-4 text-center">Reset password</h2>
          <form method="POST" action="" class="mt-8">
            <input type="hidden" name="reset_password" value="1">
            <div class="mb-4">
                <label class="block text-gray-700 font-bold mb-2" for="id">User ID</label>
                <input type="text" name="id" id="id" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
            </div>
            <div class="mb-4">
                <label class="block text-gray-700 font-bold mb-2" for="password">New Password</label>
                <input type="password" name="password" id="password" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
            </div>
            <div class="flex items-center justify-between">
                <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                    Reset Password
                </button>
            </div>
        </form>
    </div>
</body>
</html>