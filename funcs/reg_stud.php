<?php
include 'config.php';

$fname = $_POST['sfname'];
$lname = $_POST['slname'];
$gender = $_POST['gender'];

$uni = $_POST['university'];
$reg_no = $_POST['reg_no'];
$course = $_POST['course'];
$phone = $_POST['stud_phone'];
$gfname = $_POST['gfname'];
$glname = $_POST['glname'];
$gphone = $_POST['guard_phone'];

$email = $_POST['username'];
$pass = $_POST['password'];
$con_pass = $_POST['conf_password'];

if($pass == $con_pass){
    $sql = mysqli_query($conn, "INSERT INTO `auth_user`(`id`, `password`, `role`, `status`, `username`) 
    VALUES (NULL,'$pass',3,1,'$email')");

    if($sql){
        $sql2 = mysqli_query($conn, "SELECT id FROM `auth_user` WHERE `username`='$email' AND `password` = '$pass'");
        while($row = mysqli_fetch_assoc($sql2)){
            $auth_id = $row['id'];
        }
        $sql3 = mysqli_query($conn, "INSERT INTO `user`(`auth_id`, `fname`, `lname`, `gender`,`id`) 
        VALUES ('$auth_id','$fname','$lname','$gender',NULL)");

        if($sql3){
            $sql4 = mysqli_query($conn, "SELECT id FROM `user` WHERE `auth_id`='$auth_id' AND `fname` = '$fname' AND `lname` = '$lname' AND `gender` = '$gender' ");
            while($row = mysqli_fetch_assoc($sql4)){
                $user_id = $row['id'];
            }

            $sql5 = mysqli_query($conn, "INSERT INTO `more_info`(`id`, `user_id`, `university`, `regNo`, `course`, `stud_phone`, `guard_fname`, `guard_lname`, `guard_phone`) 
            VALUES (NULL,'$user_id','$uni','$reg_no','$course', '$phone', '$gfname', '$glname', '$gphone' )");

            if($sql5){
                header('location: ../index.php?user_created_successfully');
            } else {
                header('location: ../index.php?failed_to_add_extra_details');
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