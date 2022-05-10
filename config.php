<?php 
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "demo";

//tao ket noi
$conn = mysqli_connect($servername,$username,$password,$dbname);

 //kiem tra ket noi
if($conn ->connect_error){
    die("connection failed: ".mysqli_connect_error());
}else{
    echo "connected successfully <br>";
}
 //tao bang
 /* $sql = "CREATE TABLE User (
     id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
     name VARCHAR(50) NOT NULL,
     password VARCHAR(20) NOT NULL,
     reg_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
     ) ";
 if(mysqli_query($conn,$sql)){
     echo "TABLE create successfully";
 }else {
     echo "error creting table: " . mysqli_error($conn);
 } */

//them du lieu vao trong bang
$sql  = "INSERT INTO user (name, email, address, password, status)
VALUES ('thong','thong@gmail.com', 'thai binh', '123', 1)";

if(mysqli_query($conn,$sql)){
    echo "new record created successfully";
}else {
    echo "error".$sql."<br>" . mysqli_error($conn);}

//lenh dong ket noi
mysqli_close($conn);
?>