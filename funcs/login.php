<?php
session_start();
include 'config.php';

$username = $_POST['username'];
$password = $_POST['password'];

$sql = mysqli_query($conn, "SELECT * FROM `auth_user` WHERE `username`= '$username' AND `password` = '$password' LIMIT 1");
if($sql){
    while($row = mysqli_fetch_assoc($sql)){
        $auth_id = $row['id'];
        $_SESSION['role'] = $row['role'];   
    }
}

$count = mysqli_num_rows($sql);
if($count == 1){
    $sql2 = mysqli_query($conn, "SELECT * FROM `user` WHERE auth_id = $auth_id");
    while($row = mysqli_fetch_assoc($sql2)){
        session_regenerate_id();
        $_SESSION['user_id'] = $row['id'];
        $_SESSION['user'] = $row['fname'] .' '.$row['lname'];
        session_write_close();
    }

    if($_SESSION['role'] == 2){
        header('location: ../admin/hostel_admin.php?login_successful');
    }elseif($_SESSION['role'] == 3){
        header('location: ../index.php?login_successful');
    }elseif($_SESSION['role'] == 4){
        header('location: ../bank/bank_admin.php?login_successful');
    }

}else{
    header('location: ../index.php?Invalid_username_or_password');
}