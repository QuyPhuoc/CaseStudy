<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="../asset/css/styles.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.1/css/all.min.css" integrity="sha512-5Hs3dF2AEPkpNAR7UiOHba+lRSJNeM2ECkwxUIxC1Q/FLycGTbNapWXB4tP889k5T5Ju8fs4b1P5z/iB4nMfSQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<body>
    <?php 
    session_start();
    if(isset($_SESSION['username'])){
        echo "<h1>Welcome ".$_SESSION['username']."</h1>";
    }
    ?>
    <nav class="bg-gray-800 flex justify-end w-full h-16">
        <ul class="flex items-center space-x-5 min-w-96 px-10 h-full">
            <li class="h-full w-full leading-6"><a href="SignUp.php" class="h-full flex items-center text-white hover:text-gray-400">Sign Up</a></li>
            <li class="h-full w-full leading-6"><a href="Login.php" class="h-full flex items-center text-white hover:text-gray-400">Login</a></li>
            <li class="h-full w-full leading-6"><a href="CreatePost.php" class="h-full flex items-center text-white hover:text-gray-400">Post</a></li>
            <li class="flex items-center justify-center h-full w-full leading-6 text-white hover:text">Search<i class="fa-solid fa-magnifying-glass ml-4 text-white hover:cursor-pointer hover:text-gray-400"></i></li>
        </ul>
    </nav>
</body>
</html>