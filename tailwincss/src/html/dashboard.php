<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../asset/css/styles.css">
</head>
<body>
    <?php 
    session_start();
    ?>
    <h1>Hello <?php echo $_SESSION['username']; ?> 
    <?php if(isset($_SESSION['avatar'])): ?>
        <img class="w-10 h-10 block bg-transparent" src="<?php echo $_SESSION['avatar']; ?>" alt="">
    <?php endif; ?>
    </h1>
</body>
</html>