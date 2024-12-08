<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dang Nhap</title>
    <link rel="stylesheet" href="../asset/css/styles.css">
</head>
<body class="bg-bg bg-no-repeat bg-cover">
    <div class="container mx-auto relative">
        <div class="flex justify-center items-center h-screen relative">
            <form action="" method="post" class="bg-blue-500 p-10 rounded-lg shadow-lg relative">
                <div class="flex justify-center">
                    <img src="../asset/img/LogoVinh.svg" alt="" class="w-16 h-16 -mt-16">
                </div>
                <h2 class="text-2xl font-bold mb-10 text-center">Login</h2>
                <div class="mb-5">
                    <label for="username" class="block text-sm font-bold text-black">Username</label>
                    <input required type="text" name="username" id="username" class="w-full p-2 border border-gray-300 rounded mt-1">
                </div>
                <div class="mb-5">
                    <label for="password" class="block text-sm font-bold text-black">Password</label>
                    <input required type="password" name="password" id="password" class="w-full p-2 border border-gray-300 rounded mt-1">
                </div>
                <button type="submit" class="w-full bg-gray-300 hover:bg-blue-400 text-black p-2 rounded">Login</button>
            </form>
        </div>
            <!-- <?php
            if(isset($_COOKIE['login_failed'])){
                $login_failed = $_COOKIE['login_failed'];
                echo "<div class='text-black p-2 rounded flex h-3 justify-center'>Failed login: ".$login_failed."</div>";
            }
            ?> -->
</body>
</html>
<?php
session_start();
require_once '../php/dbconnection.php';
if(isset($_POST['username']) && isset($_POST['password'])){
    setcookie('login_failed', 0, time() + 15);
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
        header('Location: dashboard.php');
    }else{
        session_unset();
        session_destroy();
        if(isset($_COOKIE['login_failed'])){
            $login_failed = $_COOKIE['login_failed'];
            $login_failed++;
            setcookie('login_failed', $login_failed, time() + 15);
            //trigger the capcha
            if($login_failed > 3){
                session_unset();
                session_destroy();
                echo "<script>window.alert('Please verify you are not a robot')</script>";
            }
        }
    }
}
?>
