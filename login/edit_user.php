<?php
include('connect.php');
session_start();

$dbConnection = new DBManager('localhost','root','','demo');
$dbConnection -> connect();
$dbConnection -> update('user','','');

// $id = $_GET['id'];
// $query = mysqli_query($conn, "select * from user where id='$id'");
// $row = mysqli_fetch_assoc($query);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>Sửa thông tin người dùng</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
</head>

<body>
    <div class="container">
        <form method="POST" action="">
            <h2>Sửa Thông tin người dùng : <?= $row['name']; ?> </h2>
            <table class="table table-bordered">
                <tr class="bg-light">
                    <td>tên</td>
                    <td>email</td>
                    <td>địa chỉ</td>
                    <td>mật khẩu</td>
                    <td>trạng thái</td>
                </tr>
                <tr>
                    <td><input type="text" value="<?= $row['name']; ?>" name="name"></td>
                    <td><input type="email" value="<?= $row['email']; ?>" name="email"></td>
                    <td><input type="text" value="<?= $row['address']; ?>" name="address"></td>
                    <td><input type="password" value="<?= $row['password']; ?>" name="password"></td>
                    <td>
                        <select name="status" class="my-5">
                            <option value="1">Kích hoạt</option>
                            <option value="0">Khóa</option>
                        </select>
                    </td>
                    <td>
                        <input type="submit" name="update" value="Lưu">
                        <a class="btn btn-secondary" href="index.php">Thoát</a>
                    </td>
                </tr>
            </table>
            <?php
            if (isset($_POST['update'])) {
                $id = $_GET['id'];
                $email = $_POST['email'];
                $address = $_POST['address'];
                $username = $_POST['name'];
                $password = $_POST['password'];
                $status = $_POST['status'];
                // Create connection
                $sql = "UPDATE user SET name='$username', email = '$email', address = '$address', password='$password', status = '$status' WHERE id='$id'";
                if ($conn->query($sql) === TRUE) {
                    echo "cập nhật thành công !";
                } else {
                    echo "lỗi cập nhật : " . $conn->error;
                }
                $conn->close();
            }
            ?>

        </form>
    </div>

</body>

</html>