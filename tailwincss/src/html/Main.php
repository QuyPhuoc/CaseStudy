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
    ?>
    <nav>
        <ul>
            <li><a href="SignUp.php">Create User</a></li>
            <li><a href="Login.php">Login</a></li>
            <li><a href="CreatePost.php">Post</a></li>
            <li><i class="fa-solid fa-magnifying-glass"></i></li>
        </ul>
    </nav>
</body>
</html>