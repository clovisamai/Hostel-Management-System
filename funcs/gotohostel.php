<?php
session_start();
$id = $_POST['hostaId'];
$_SESSION['selected_hostel'] = $id ;
header("location: ../hostel.php");
