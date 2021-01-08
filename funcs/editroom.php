<?php 
    include 'config.php';
    $id = $_POST['rid'];

    $roomNo = $_POST['rno'];
    $occupy = $_POST['type'] ;
    $self_c = $_POST['self_c'];
    $size = $_POST['size'];
    $price = $_POST['price'];

        if(!empty($roomNo)){  mysqli_query($conn, "UPDATE `room` SET `roomNo`= '$roomNo' WHERE `id` = '$id'");  }
        if(!empty($occupy)){  mysqli_query($conn, "UPDATE `room` SET `occupy_type`= '$occupy' WHERE `id` = '$id'");  }
        if(!empty($self_c)){  mysqli_query($conn, "UPDATE `room` SET `self_contained`= '$self_c' WHERE `id` = '$id'");   }
        if(!empty($size)){  mysqli_query($conn, "UPDATE `room` SET`size`= '$size' WHERE `id` = '$id'");  }
        if(!empty($price)){  mysqli_query($conn, "UPDATE `room` SET `pricing`= '$price' WHERE `id` = '$id'");  }

    header("location:../admin/rooms.php?room_updated");   
?>