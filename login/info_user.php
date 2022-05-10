<?php
include('connect.php');
session_start();

$id = $_GET['id'];
$query = mysqli_query($conn, "select * from user where id='$id'");
$row = mysqli_fetch_assoc($query);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>Thông tin người dùng</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
</head>

<body>
    <div class="container">
        <form method="POST" action="">
            <h2>Thông tin người dùng : <?= $row['name']; ?> </h2>
            <table class="table table-bordered">
                <tr class="bg-light">
                    <td>Tên</td>
                    <td>email</td>
                    <td>địa chỉ</td>
                    <td>mật khẩu</td>
                    <td>trạng thái</td>
                </tr>
                <tr>
                    <td><?= $row['name']; ?></td>
                    <td><?= $row['email']; ?></td>
                    <td><?= $row['address'] ?></td>
                    <td><?= $row['password']; ?></td>
                    <td><?= $row['status'] == 1 ? "kích hoạt" : "khóa"; ?></td>
                    <td>
                        <a class="btn btn-secondary" href="index.php">Thoát</a>
                    </td>
                </tr>
            </table>

        </form>
    </div>

</body>

</html>