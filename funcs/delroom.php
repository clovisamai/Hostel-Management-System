<?php 
    include 'config.php';
    $roomId = $_POST['roomNo'];
    $sql = mysqli_query($conn, "DELETE FROM `room` WHERE `id` = '$roomId' ");
    if($sql){
        header("location:../admin/rooms.php?room_deleted_successfully");
    } else {
        header("location:../admin/rooms.php?failed_to_delete_room");
    }
?>