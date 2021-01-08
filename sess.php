<?php 
    $role = $_SESSION['sess_userrole'];
    if(!isset($_SESSION['sess_username']) && $role != 0){
        header('Location: ../index.php?msg=4');
    }
    elseif(!isset($_SESSION['sess_username']) && $role != 1){
        header('Location: ../index.php?msg=4');
    }
    elseif(!isset($_SESSION['sess_username']) && $role != 2){
        header('Location: ../index.php?msg=4');
    }
?>