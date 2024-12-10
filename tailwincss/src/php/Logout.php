<?php
session_start();
session_destroy();
setcookie('login_failed', 0, time() - 3600);
setcookie('username', '', time() - 3600);
header('Location: ../html/Main.php');
?>