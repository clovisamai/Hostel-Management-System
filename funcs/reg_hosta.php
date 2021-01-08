<?php
include 'config.php';

$fname = $_POST['fname'];
$lname = $_POST['lname'];
$email = $_POST['email'];

$hname = $_POST['hname'];
$location = $_POST['location'];
$restriction = $_POST['restriction'];

$pass = $_POST['password'];
$con_pass = $_POST['conf_password'];

if($pass == $con_pass){
    $sql = mysqli_query($conn, "INSERT INTO `auth_user`(`id`, `password`, `role`, `status`, `username`) 
    VALUES (NULL,'$pass',2,1,'$email')");
    if($sql){
        $sql2 = mysqli_query($conn, "SELECT id FROM `auth_user` WHERE `username`='$email' AND `password` = '$pass'");
        while($row = mysqli_fetch_assoc($sql2)){
            $auth_id = $row['id'];
        }
        $sql3 = mysqli_query($conn, "INSERT INTO `user`(`id`, `auth_id`, `fname`, `lname`, `gender`) 
        VALUES (NULL,'$auth_id','$fname','$lname', NULL)");
        
        if($sql3){
            $sql4 = mysqli_query($conn, "SELECT id FROM `user` WHERE `auth_id`='$auth_id' ");
            while($row = mysqli_fetch_assoc($sql4)){
                $user_id = $row['id'];
            }
            $sql5 = mysqli_query($conn, "INSERT INTO `hostel`(`id`, `name`, `hostel_manager`, `location`, `restriction`) 
            VALUES (NULL,'$hname','$user_id', '$location', '$restriction')");
            
            if($sql5){
                header('location: ../index.php?user_created_successfully');
            } else {
                header('location: ../index.php?failed_to_add_hostel_details');
            }
        } else {
            header('location: ../index.php?failed_to_add_user_details');
        }
    } else {
        header('location: ../index.php?user_created_failed');
    }
} else {
    header('location: ../index.php?passwords_dont_match');
}