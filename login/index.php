<?php
include('connect.php');
session_start();

$DBConnection = new DBManager('localhost', 'root', '', 'demo');
$DBConnection->connect();
$data = $DBConnection->fetchAll('select * from user');

$DBConnection->close(); //đóng kết nối với db
unset($DBConnection); //dùng để giải phóng bộ nhớ
?>
<html>

<head>
    <title>Index</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>

<body>
    <table class='table table-bordered'>
        <tr class="bg-light">
            <th>id</th>
            <th>tên</th>
            <th>email</th>
            <th>dia chi</th>
            <th>mật khẩu</th>
            <th>trang thai</th>
            <th>ngay tao</th>
            <th>cập nhật</th>
            <th>thao tác</td>
        </tr>
        <?php foreach ($data as $item) { ?>
            <tr>
                <td><?= $item['id'] ?></td>
                <td><?= $item['name'] ?></td>
                <td><?= $item['email'] ?></td>
                <td><?= $item['address'] ?></td>
                <td><?= $item['password'] ?></td>
                <td><?= $item['status'] == 1 ? 'kích hoạt' : 'khóa' ?></td>
                <td><?= $item['created_at'] ?></td>
                <td><?= $item['updated_at'] ?></td>
                <td>
                    <!-- <a href="./info_user.php?id=<?= $item['id'] ?>"><i class="far fa-eye"></i></a> -->
                    <a href="./edit_user.php?id=<?= $item['id'] ?>"><i class="far fa-edit"></i></a>
                    <a href="./delete_user.php?id=<?= $item['id'] ?>" onclick="return confirmDelete()"><i class="far fa-trash-alt"></i></a>
                </td>
            </tr>
        <?php } ?>
    </table>
    <a href="login.php" class="btn btn-primary m-3">Login</a>
    <a href="signup.php" class="btn btn-primary m-3">Signup</a>
</body>

</html>