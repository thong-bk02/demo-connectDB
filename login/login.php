<?php
include("connect.php");
session_start(); //Session giải quyết vấn đề này bằng cách lưu trữ thông tin người dùng sử dụng trên nhiều trang.  Theo mặc định các biến của session kéo dài cho đến khi người dùng đóng trình duyệt.

$dbConnection = new DBManager('localhost', 'root', '', 'demo');
$dbConnection->connect();

//user va password gui tu form
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['name'];
    $userpw = $_POST['password'];

    $row = $dbConnection->login($username,$userpw);

    // //truy van co so du lieu va tim xem user co trong co so du lieu hay khong
    // $sql = "SELECT * FROM User where name ='$username' and password = '$userpw'";

    // //thuc thi truy van
    // $result = mysqli_query($conn, $sql);
    if ($row > 0) {
        $_SESSION['user'] = $username;
        header("location: wellcome.php");
    } else {
        var_dump($username);
        var_dump($userpw);
    }
}

$dbConnection->close();//đóng kết nối với db
unset($dbConnection);//dùng để giải phóng bộ nhớ
?>
<html>

<head>
    <title>Login Page</title>
</head>

<body>

    <b>Login</b>
    <form action="" method="post">
        <label>UserName :</label><input type="text" name="name"><br /><br />
        <label>Password :</label><input type="password" name="password"><br /><br />
        <input type="submit" value=" Submit " /><br />
    </form>
    <a href="signup.php">Singup</a>

</body>

</html>