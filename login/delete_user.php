<?php
include_once('connect.php');

if (isset($_REQUEST['id']) and $_REQUEST['id'] != "") {
    $id = $_GET['id'];
    $sql = "DELETE FROM user WHERE id='$id'";
    if ($conn->query($sql) === TRUE) {
        echo "Xoá thành công!";
    } else {
        echo "Lỗi : " . $conn->error;
    }
    $conn->close();
} ?>
<html>
<body>
    <a href="index.php">Trang chủ</a>
</body>
</html>
