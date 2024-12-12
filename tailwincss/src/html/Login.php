<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dang Nhap</title>
    <link rel="stylesheet" href="../asset/css/styles.css">
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
    <script src="../javascript/captchaVali.js"></script>



</head>
<body class="bg-bg bg-no-repeat bg-cover">
<div class=" flex bg-blue-500 w-full fixed items-center z-20 top-0 justify-end sm:justify-end" id="">
        <a href="Main.php"
            class=" text-white bg-transparent flex items-center h-12 max-w-32 py-3 px-6 hover:bg-white hover:text-black">Trang chủ</a>
        <a href="Contact.php"
            class=" text-white bg-transparent hidden items-center h-12 max-w-32 py-3 px-6 hover:bg-white hover:text-black sm:flex">Liên Hệ</a>
        <label for="" class=" text-white bg-transparent hidden items-center h-12 max-w-32 py-3 px-6 hover:bg-white hover:text-black hover:cursor-pointer sm:flex">Tìm kiếm <i class="fa-solid fa-magnifying-glass ml-1"></i></label>
        </label>
        <span class=" text-white bg-transparent hidden items-center h-1 border-white sm:flex">|</span>
        <a href="Login.php"
            class=" text-white bg-transparent hidden items-center h-12 max-w-32 py-3 px-6 hover:bg-white hover:text-black sm:flex">Đăng nhập</a>
        <a href="SignUp.php"
            class=" text-white bg-transparent hidden items-center h-12 max-w-32 py-3 px-6 hover:bg-white hover:text-black sm:flex">Đăng ký</a>
    </div>
    <div class="container mx-auto relative">
        <div class="flex justify-center items-center h-screen relative">
            <form action="" method="post" id="login-form" class="bg-blue-500 p-10 rounded-lg shadow-lg relative">
                <div class="flex justify-center">
                    <img src="../asset/imgAva/LogoVinh.svg" alt="" class="w-16 h-16 -mt-16">
                </div>
                <h2 class="text-2xl font-bold mb-10 text-center">Đăng nhập</h2>
                <div class="mb-5">
                    <label for="username" class="block text-sm font-bold text-black">Tên tài khoản</label>
                    <input required type="text" name="username" id="username" class="w-full p-2 border border-gray-300 rounded mt-1">
                </div>
                <div class="mb-5">
                    <label for="password" class="block text-sm font-bold text-black">Mật khẩu</label>
                    <input required type="password" name="password" id="password" class="w-full p-2 border border-gray-300 rounded mt-1">
                </div>
                <div class="mb-5">
                    <input type="checkbox" name="remember" id="remember" class="mt-1 hover:cursor-pointer"> Remember me</input>
                </div>
                <div class="mb-5 hidden bg-black text-center transition-shadow" id="alert">
                    <span id="alertSpan" class="text-red-600 capitalize "></span>
                </div>
                <?php
                if(isset($_COOKIE['login_failed'])){
                    $login_failed = $_COOKIE['login_failed'];
                    if($login_failed >= 3){
                        echo "<div class='mb-5 g-recaptcha' data-sitekey='6Lcr0pgqAAAAAJhmwEBy2JpWn02_I-GUEp7HyAcF' data-callback='enableSubmitButton'></div>";
                    }
                }
                ?>
                <button id="submit-button" type="submit" class="w-full bg-gray-300 hover:bg-blue-400 text-black p-2 rounded" <?php if(isset($_COOKIE['login_failed'])){
$login_failed=$_COOKIE['login_failed'];
if($login_failed >=3)
{
echo "disabled";
}
}?>>Login</button>
                <lable class="block text-sm font-bold text-black mt-2">Bạn chưa có tài khoản? <a class="text-black decoration-solid hover:text-white animate-spin" href="SignUp.php">Đăng ký</a></lable>
            </form>
        </div>
</body>
</html>
<?php
session_start();
require_once '../php/dbconnection.php';
if(isset($_POST['username']) && isset($_POST['password'])){
    setcookie('login_failed', 1, time() + 15);
    $usernameraw = $_POST['username'];
    $passwordraw = $_POST['password'];
    $username = addslashes($usernameraw);
    $password = addslashes($passwordraw);
    $passwordenc = md5($password);
    $conn = getDBConnection();
    if($conn->connect_error){
        echo "<script>window.alert(".$conn->connect_error.")</script>";
    }
    $sql = "SELECT * FROM USER WHERE username = '$username' AND password = '$passwordenc'";
    $result = $conn->query($sql);
    if($result->num_rows > 0){
        echo "Login success";
        setcookie('login_failed',0, time() + 15);
        setcookie('username', $username, time() + 3600);
        //save the username, email and avatar to the session
        $row = $result->fetch_assoc();
        
        $_SESSION['username'] = $row['Username'];
        $_SESSION['email'] = $row['Email'];
        $_SESSION['avatar'] = $row['Avatar'];
        //redirect to the dashboard
        header('Location: Main.php');
    }else{
        session_unset();
        session_destroy();
        if(isset($_COOKIE['login_failed'])){
            echo "<script>showAlert('Sai ten hoac mat khau');</script>";
            $login_failed = $_COOKIE['login_failed'];
            $login_failed++;
            setcookie('login_failed', $login_failed, time() + 15);
            //trigger the capcha
            if($login_failed > 3){
                session_unset();
                session_destroy();
                echo "<script>showAlert('Sai 3 lan, hay hoan thanh captcha');</script>";
            }
        }
    }
}
?>
