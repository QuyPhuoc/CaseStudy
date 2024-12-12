<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="../asset/css/styles.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.1/css/all.min.css" integrity="sha512-5Hs3dF2AEPkpNAR7UiOHba+lRSJNeM2ECkwxUIxC1Q/FLycGTbNapWXB4tP889k5T5Ju8fs4b1P5z/iB4nMfSQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<body class="bg-bg bg-no-repeat bg-cover">
    <?php 
    session_start();
    if(isset($_SESSION['username'])){
        echo "<h1>Welcome ".$_SESSION['username']."</h1>";
    }
    ?>
    <div class=" flex bg-blue-500 w-full fixed items-center z-20 top-0 justify-end sm:justify-end" id="">
        <a href="#"
            class=" text-white bg-transparent flex items-center h-12 max-w-32 py-3 px-6 hover:bg-white hover:text-black">Trang chủ</a>
        <label for="" class=" text-white bg-transparent hidden items-center h-12 max-w-32 py-3 px-6 hover:bg-white hover:text-black hover:cursor-pointer sm:flex">Search <i class="fa-solid fa-magnifying-glass ml-1"></i></label>
        </label>
        <a href="Contact.php"
        class=" text-white bg-transparent hidden items-center h-12 max-w-32 py-3 px-6 hover:bg-white hover:text-black sm:flex">Liên hệ</a>
        <span class=" text-white bg-transparent hidden items-center h-1 border-white sm:flex">|</span>
        <?php
        if(isset($_SESSION['username']))
        {
            echo "<a href='../php/Logout.php' class=' text-white bg-transparent hidden items-center h-12 max-w-32 py-3 px-6 hover:bg-white hover:text-black sm:flex'>Logout</a>";
            echo "<div class='bg-transparent hidden items-center h-12 max-w-32 py-3 px-6 hover:cursor-pointer hover:bg-white hover:text-black sm:flex'><img for='' src='".$_SESSION['avatar']."' class='object-cover w-10 h-10 rounded-full'></img></div>";
        }
            else{
            echo "<a href='Login.php'
            class=' text-white bg-transparent hidden items-center h-12 max-w-32 py-3 px-6 hover:bg-white hover:text-black sm:flex'>Đăng nhập</a>
        <a href='SignUp.php'
            class=' text-white bg-transparent hidden items-center h-12 max-w-32 py-3 px-6 hover:bg-white hover:text-black sm:flex'>Đăng ký</a>";
        }
            ?>
    </div>
</body>
</html>