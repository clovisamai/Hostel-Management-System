<?php 
    include 'config.php';
    $id = $_POST['hosta_id'];

    $name = $_POST['hosta_name'];
    $contact = $_POST['hosta_contact'] ;
    $restriction = $_POST['restriction'];
    $location = $_POST['location'];
    $desc = $_POST['desc'];

    $bank = $_POST['bank'];
    $acc_name = $_POST['acc_name'];
    $acc_no = $_POST['acc_no'];

        if(!empty($name)){  mysqli_query($conn, "UPDATE `hostel` SET `name`= '$name' WHERE `id` = '$id'");  }
        if(!empty($contact)){  mysqli_query($conn, "UPDATE `hostel` SET `contact`= '$contact' WHERE `id` = '$id'");  }
        if(!empty($restriction)){  mysqli_query($conn, "UPDATE `hostel` SET `restriction`= '$restriction' WHERE `id` = '$id'");   }
        if(!empty($location)){   mysqli_query($conn, "UPDATE `hostel` SET`location`= '$location' WHERE `id` = '$id'");  }
        if(!empty($desc)){  mysqli_query($conn, "UPDATE `hostel` SET `description`= '$desc' WHERE `id` = '$id'");  }
        if(!empty($bank)){  mysqli_query($conn, "UPDATE `hostel` SET `bank`= '$bank' WHERE `id` = '$id'");  }
        if(!empty($acc_name)){  mysqli_query($conn, "UPDATE `hostel` SET `acc_name`= '$acc_name' WHERE `id` = '$id'");  }
        if(!empty($acc_no)){  mysqli_query($conn, "UPDATE `hostel` SET `acc_no`= '$acc_no' WHERE `id` = '$id'");  }

    header("location:../admin/hostel_details.php?hostel_details_updated");   
?>