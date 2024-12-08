<?php
require_once '../php/dbconnection.php';
function createuser($Name,$username,$password,$email,$phone,$Avatar){
    $passwordenc = md5($password);
    $conn = getDBConnection();
    if($conn->connect_error){
        echo "<script>window.alert(".$conn->connect_error.")</script>";
    }
    $sql = "INSERT INTO USER (Name,Username,Password,Email,Phone,Avatar) VALUES ('$Name','$username','$passwordenc','$email','$phone','$Avatar')";
    if($conn->query($sql) === TRUE){
        echo "New record created successfully";
    }else{
        echo "Error: ".$sql."<br>".$conn->error;
    }
    $conn->close();
}
?>
<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $avatar = '';

    if (isset($_FILES['avatar']) && $_FILES['avatar']['error'] == 0) {
        $target_dir = "../asset/img/";
        $target_file = $target_dir . $timestamp . "_" . $username . ".png";
        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

        // Check if image file is a actual image or fake image
        $check = getimagesize($_FILES["avatar"]["tmp_name"]);
        if ($check !== false) {
            if (move_uploaded_file($_FILES["avatar"]["tmp_name"], $target_file)) {
                $avatar = $target_file;
            } else {
                echo "Loi upload.";
            }
        } else {
            echo "File khong hop le.";
        }
    }
    createuser($Name,$username, $password, $email, $phone, $avatar);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create New User</title>
</head>
<body>
    <form action="newuser.php" method="post" enctype="multipart/form-data">
        <label for="Name">Username:</label>
        <input type="text" id="Name" name="Name" required>
        <br>
        <label for="username">Username:</label>
        <input type="text" id="username" name="username" required>
        <br>
        <label for="password">Password:</label>
        <input type="password" id="password" name="password" required>
        <br>
        <label for="email">Email:</label>
        <input type="email" id="email" name="email" required>
        <br>
        <label for="phone">Phone:</label>
        <input type="text" id="phone" name="phone" required>
        <br>
        <label for="avatar">Avatar:</label>
        <input type="file" id="avatar" name="avatar" required>
        <br>
        <button type="submit">Create User</button>
    </form>
</body>
</html>