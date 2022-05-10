<?php
include("connect.php");
session_start();

$dbConnection = new DBManager('localhost', 'root', '', 'demo');
$dbConnection->connect();

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $username = $_POST['name'];
    $userpw = $_POST['password'];
    $useremail = $_POST['email'];
    $useradd = $_POST['address'];
    $userstatus = 1 ;

    $dbConnection -> insert('user',array(
        'name' => $username,
        'email' => $useremail,
        'address' => $useradd,
        'password' => $userpw,
        'status' => 1
    ));
    $_SESSION['user'] = $username;
    header('location: wellcome.php');
}

$dbConnection->close();//đóng kết nối với db
unset($dbConnection);//dùng để giải phóng bộ nhớ
?>

<html>

<head>
    <title>Signup Page</title>
</head>

<body>

    <b>Signup</b>
    <form action="" method="post">
        <label>UserName :</label><input type="text" name="name"><br /><br />
        <label>Email :</label><input type="email" name="email"><br /><br />
        <label>Address :</label><input type="text" name="address"><br /><br />
        <label>Password :</label><input type="password" name="password"><br /><br />
        <input type="submit" value=" Submit " /><br />
    </form>
    <a href="login.php">Login</a>
</body>

</html>