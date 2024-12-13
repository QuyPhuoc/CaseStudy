<!-- Ham de them nguoi dung -->
<?php
require '../php/checkUserEmailPhone.php';
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
        echo "<script>window.alert('Tao tai khoan thanh cong')</script>";
    }else{
        echo "<script>window.alert('Error: ".$sql."<br>".$conn->error."')</script>";
    }
    $conn->close();
}
// function createuserNoAva($Name,$username,$password,$email,$phone){
//     $Name = addslashes($Name);
//     $username = addslashes($username);
//     $email = addslashes($email);
//     $phone = addslashes($phone);
//     $passwordenc = md5($password);
//     $conn = getDBConnection();  
//     if($conn->connect_error){
//         echo "<script>window.alert(".$conn->connect_error.")</script>";
//     }
//     $sql = "INSERT INTO USER (Name,Username,Password,Email,Phone) VALUES ('$Name','$username','$passwordenc','$email','$phone')";
//     if($conn->query($sql) === TRUE){
//         echo "Tao tai khoan thanh cong";
//     }else{
//         echo "Error: ".$sql."<br>".$conn->error;
//     }
//     $conn->close();
// }
?>
<!-- nhan methon post va xu ly -->
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
        }
        else {
            echo "<script>window.alert('File khong phai la anh.')</script>";
        }
    }
    if($avatar == ''){
            $avatar = '../asset/imgAva/defaultAva.png';
    }

    //check ten dang nhap da ton tai chua
    switch (CheckUser($username, $email, $phone)) {
        case 1:
            echo "<script>showAlert('Ten dang nhap da ton tai.')</script>";
            break;
        case 2:
            echo "<script>showAlert('Email da ton tai.')</script>";
            break;
        case 3:
            echo "<script>showAlert('So dien thoai da ton tai.')</script>";
            break;
        case 0:
            createuser($Name,$username,$password,$email,$phone,$avatar);
            break;
    }
    
}
?>


<!-- neu da dang nhap thi tu chuyen huong -->
<?php
session_start();
if(isset($_SESSION['username'])){
    header('Location: Main.php');
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create New User</title>
    <link href="../asset/css/styles.css" rel="stylesheet">
    <script src="../javascript/Validate.js"></script>
</head>
<body class="bg-shade bg-no-repeat bg-cover">
    <div class="px-4 py-8 container mx-auto relative">
        <div class="max-w-md mx-auto rounded-lg shadow-md">
            <form action="" method="post" enctype="multipart/form-data" class="bg-blue-500 p-10 rounded-lg shadow-lg relative">
            <h2 class="text-2xl font-bold mb-6 text-center">Create New User</h2>
                <div class="mb-4">
                    <label for="Name" class="block text-sm font-bold text-black">Name:</label>
                    <input type="text" id="Name" name="Name" class="w-full px-3 py-2 border rounded-lg" required>
                </div>
                <div class="mb-4">
                    <label for="username" class="block text-sm font-bold text-black">Username:</label>
                    <input type="text" id="username" name="username" class="w-full px-3 py-2 border rounded-lg" required>
                </div>
                <div class="mb-4">
                    <label for="password" class="block text-sm font-bold text-black">Password:</label>
                    <input type="password" id="password" name="password" class="w-full px-3 py-2 border rounded-lg" required>
                </div>
                <div class="mb-4">
                    <label for="password" class="block text-sm font-bold text-black">Confirm password</label>
                    <input type="password" id="passwordconf" name="password" class="w-full px-3 py-2 border rounded-lg" required>
                </div>
                <div class="mb-4">
                    <label for="email" class="block text-sm font-bold text-black">Email:</label>
                    <input type="email" id="email" name="email" class="w-full px-3 py-2 border rounded-lg" required>
                </div>
                <div class="mb-4">
                    <label for="phone" class="block text-sm font-bold text-black">Phone:</label>
                    <input type="text" id="phone" name="phone" class="w-full px-3 py-2 border rounded-lg" required>
                </div>
                <div class="mb-4">
                    <label for="avatar" class="block text-sm font-bold text-black">Avatar:</label>
                    <input type="file" id="avatar" name="avatar" class="w-full px-3 py-2 border rounded-lg">
                </div>
                <div class="mb-5 hidden bg-black text-center transition-shadow" id="alert">
                    <span id="alertSpan" class="text-red-600 capitalize "></span>
                </div>
                <div class="text-center">
                    <button type="submit" class="w-full bg-gray-300 hover:bg-blue-400 text-black p-2 rounded" onclick="PasswordValidator()">Tao tk</button>
                </div>
            </form>
        </div>
    </div>
</body>
</html>