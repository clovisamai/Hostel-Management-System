<?php 
session_start();
include 'config.php';
$user = $_SESSION['user_id'];

$findHostel = mysqli_query($conn, "SELECT id FROM `hostel` WHERE `hostel_manager` = '$user' ");

if($findHostel){
    while($row = mysqli_fetch_assoc($findHostel)){
        $hostel_id = $row['id'];
    }
    
    $roomNo = $_POST['rno'];
    $occupy = $_POST['type'] ;
    $self_c = $_POST['self_c'];
    $size = $_POST['size'];
    $price = $_POST['price'];

    $roomExists = mysqli_query($conn, "SELECT * FROM `room` WHERE `hostel_id` = '$hostel_id' AND `roomNo` = '$roomNo' ");
    $count = mysqli_num_rows($roomExists);

    if($count == 0){
        $sql = mysqli_query($conn,"INSERT INTO `room`(`id`, `hostel_id`, `roomNo`, `occupy_type`, `self_contained`, `size`, `pricing`, `status`) 
        VALUES (NULL,'$hostel_id','$roomNo','$occupy','$self_c','$size','$price','available')");
        
        if($sql){
            header("location:../admin/rooms.php?room_added_successfully");
        } else {
            header("location:../admin/rooms.php?failed_to_add_new_room");
        }
    } else {
        header("location:../admin/rooms.php?room_already_exists");
    }
} else {
    header("location:../admin/rooms.php?failed_to_find_hostel");
}
?>