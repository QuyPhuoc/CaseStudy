<?php
require_once '../php/dbconnection.php';

session_start();

//Kiểm tra xem người dùng đã đăng nhập chưa
if (!isset($_SESSION['user_id'])) {
    header('Location: ../html/Login.php');
    exit;
}

// Lấy thông tin chi tiết của người dùng
$user_id = $_SESSION['user_id'];
$result = $conn->query("SELECT * FROM USER WHERE ID=$user_id");
$user = $result->fetch_assoc();
if (!$user) {
    echo "<p>Error: Unable to fetch user details. Please log in again.</p>";
    session_destroy();
    header('Location: ../html/Login.php');
    exit();
}

// Chức năng cập nhật thông tin tài khoản
if (isset($_POST['update_account'])) {
    $id = $_POST['id'];
    $name = $_POST['name'];
    $username = $_POST['username'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];

    $sql = "UPDATE USER SET Name='$name', Username='$username', Email='$email', Phone='$phone' WHERE ID=$id";
    $conn->query($sql);
}

// Hàm cập nhật ảnh đại diện
if (isset($_POST['update_avatar'])) {
    $id = $_POST['id'];
    $avatar = $_FILES['avatar']['name'];
    $target = "../asset/img/" . basename($avatar);

    if (move_uploaded_file($_FILES['avatar']['tmp_name'], $target)) {
        $sql = "UPDATE USER SET Avatar='$target' WHERE ID=$id";
        $conn->query($sql);
    }
}

// Hàm thay đổi mật khẩu
if (isset($_POST['change_password'])) {
    $id = $_POST['id'];
    $current_password = $_POST['current_password'];
    $new_password = $_POST['new_password'];
    $confirm_password = $_POST['confirm_password'];

    if ($new_password !== $confirm_password) {
        echo "New password and confirm password do not match.";
    } else {
        $result = $conn->query("SELECT Password FROM USER WHERE ID=$id");
        $row = $result->fetch_assoc();

        if ($row['Password'] == $current_password) {
            $sql = "UPDATE USER SET Password='$new_password' WHERE ID=$id";
            $conn->query($sql);
        } else {
            echo "Incorrect current password";
        }
    }
}

// Chức năng thêm, sửa, xóa bài viết
if (isset($_POST['add_post'])) {
    $title = $_POST['title'];
    $content = $_POST['content'];

    $sql = "INSERT INTO posts (title, content) VALUES ('$title', '$content')";
    $conn->query($sql);
}

if (isset($_POST['edit_post'])) {
    $post_id = $_POST['post_id'];
    $title = $_POST['title'];
    $content = $_POST['content'];

    $sql = "UPDATE posts SET title='$title', content='$content' WHERE id=$post_id";
    $conn->query($sql);
}

if (isset($_POST['delete_post'])) {
    $post_id = $_POST['post_id'];

    $sql = "DELETE FROM posts WHERE id=$post_id";
    $conn->query($sql);
}

// Chức năng gửi báo cáo cho thuê
if (isset($_POST['submit_report'])) {
    $user_id = $_POST['user_id'];
    $report = $_POST['report'];

    $sql = "INSERT INTO reports (user_id, report) VALUES ('$user_id', '$report')";
    $conn->query($sql);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quản lý tài khoản</title>
    <!-- <link rel="stylesheet" href="../asset/css/account_style.css"> -->
</head>
<body>
    <h1>Quản lý tài khoản</h1>
    <p>Welcome, <?php echo $user['Name']; ?>!</p>
    <form method="POST">
        <label for="title">Thông tin tài khoản</label>
        <input type="hidden" name="id" value="1">
        <input type="text" name="name" value="<?php echo $user['Name']; ?>" placeholder="Name">
        <input type="text" name="username" value="<?php echo $user['Username']; ?>" placeholder="Username">
        <input type="email" name="email" value="<?php echo $user['Email']; ?>" placeholder="Email">
        <input type="text" name="phone" value="<?php echo $user['Phone']; ?>" placeholder="Phone">
        <button type="submit" name="update_account">Cập nhật tài khoản</button>
    </form>

    <form method="POST" enctype="multipart/form-data">
        <label for="title">Ảnh đại diện</label>
        <input type="hidden" name="id" value="1">
        <input type="file" name="avatar">
        <button type="submit" name="update_avatar">Cập nhật Avatar</button>
    </form>

    <form method="POST">
        <label for="title">Đổi mật khẩu</label>
        <input type="hidden" name="id" value="1">
        <input type="password" name="current_password" placeholder="Current Password">
        <input type="password" name="new_password" placeholder="New Password">
        <input type="password" name="confirm_password" placeholder="Confirm Password">
        <button type="submit" name="change_password">Thay đổi mật khẩu</button>
    </form>

    <form method="POST">
        <label for="title">Đăng tin</label>
        <input type="hidden" name="post_id" value="1">
        <input type="text" name="title" placeholder="Post Title">
        <textarea name="content" placeholder="Post Content"></textarea>
        <button type="submit" name="add_post">Thêm bài viết</button>
        <button type="submit" name="edit_post">Chỉnh sửa bài viết</button>
        <button type="submit" name="delete_post">Xóa bài viết</button>
    </form>

    <form method="POST">
        <label for="title">Báo cáo đã thuê</label>
        <input type="hidden" name="user_id" value="1">
        <textarea name="report" placeholder="Write your report here"></textarea>
        <button type="submit" name="submit_report">Gửi báo cáo</button>
    </form>
</body>
</html>
