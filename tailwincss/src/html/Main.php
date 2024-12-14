<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="../asset/css/styles.css">
    <script src="../javascript/Mainviewport.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.1/css/all.min.css" integrity="sha512-5Hs3dF2AEPkpNAR7UiOHba+lRSJNeM2ECkwxUIxC1Q/FLycGTbNapWXB4tP889k5T5Ju8fs4b1P5z/iB4nMfSQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<body class="bg-no-repeat bg-cover">
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
            echo "<div class='bg-transparent hidden items-center h-12 max-w-32 py-3 px-6 hover:cursor-pointer hover:bg-white hover:text-black sm:flex' onclick='openrightpanel()'><img for='' src='".$_SESSION['avatar']."' class='object-cover w-10 h-10 rounded-full'></img></div>";
        }
            else{
            echo "<a href='Login.php'
            class=' text-white bg-transparent hidden items-center h-12 max-w-32 py-3 px-6 hover:bg-white hover:text-black sm:flex'>Đăng nhập</a>
        <a href='SignUp.php'
            class=' text-white bg-transparent hidden items-center h-12 max-w-32 py-3 px-6 hover:bg-white hover:text-black sm:flex'>Đăng ký</a>";
        }
            ?>
    </div>
    <div class="sidebar-left mt-12 max-w-40 h-full flex fixed left-0 bg-black justify-center">
        <div class="sort-option text-white p-4">
            <h1 class="text-white text-lg font-bold mb-4">Sắp xếp theo</h1>
            <div class="sort-option-item mb-2 w-28 flex justify-center">
                <button type="button" id="sort1" class="flex w-full justify-center text-center items-center text-white bg-blue-500 py-2 px-4 rounded hover:bg-blue-700" onclick="sortPostNewst()">Mới nhất</button>
            </div>
            <div class="sort-option-item mb-2 w-28 flex justify-center">
                <button type="button" id="sort2" class="flex w-full justify-center text-center items-center text-white bg-blue-500 py-2 px-4 rounded hover:bg-blue-700">Cũ nhất</button>
            </div>
            <div class="sort-option-item mb-2">
                <form action="../Post/sortPost.php">
                <input type="radio" name="sort" id="sort3" class="hidden">
                <label for="sort3" class="cursor-pointer text-white">Lượt xem</label>
                <select class="text-black ml-2 p-1 rounded">
                    <option value="ASC">Tăng dần</option>
                    <option value="DESC">Giảm dần</option>
                </select>
                <button type="submit"><i class="fa-solid fa-magnifying-glass"></i></button>
            </form>
            </div>
            <div class="sort-option-item mb-2">
                <form action="../Post/sortPost.php"></form>
                <input type="radio" name="sort" id="sort4" class="hidden">
                <label for="sort4" class="cursor-pointer text-white">Vi tri</label>
                <select class="text-black ml-2 p-1 rounded">
                    <option value="ASC">Xa nhất</option>
                    <option value="DESC">Gần nhất</option>
                </select>
                <button type="submit"><i class="fa-solid fa-magnifying-glass"></i></button>
                </form>
            </div>
        </div>
    </div>
    <div class="sidebar-right w-40 h-full fixed right-0 bg-green-600 hidden" id="sidebar-right">
    </div>


    <div class="" id="mainviewport" onclick="closerightpanel()">
        <?php
        require "../php/crudPost.php";
        getAllMotels();
        ?>
    </div>

</body>
</html>