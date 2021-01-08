<?php
include 'config.php';
$user_id = $_SESSION['user_id'];
$pw = mysqli_query($conn, "SELECT * FROM `auth_user` WHERE `id` = '$user_id' ");
while ($row = mysqli_fetch_assoc($pw)) {
    $current_pass = $row['password'];
}

$old_password = $_POST[''];
$new_password = $_POST[''];
$conf_password = $_POST[''];

if($old_password == $current_pass){
    if($new_password == $conf_password){
        $qry = mysqli_query($conn, "UPDATE `auth_user` SET `password` = '$new_password' WHERE `id`='$user_id'");
        if($qry){
            header("location:../admin/user_profile.php?password_change_successful");   
        }else{
            header("location:../admin/user_profile.php?password_change_failed");   
        }
    }else{
        header("location:../admin/user_profile.php?new_passwords_dont_match"); 
    }
}else{
    header("location:../admin/user_profile.php?invalid_old_password"); 
}