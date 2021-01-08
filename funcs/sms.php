<?php
session_start();
require 'vendor/autoload.php';
use AfricasTalking\SDK\AfricasTalking;

include 'config.php';

$book = $_POST['book_id'];
$user = $_POST['user_id'];

$name = $_POST['Uname'];
$hosta = $_POST['Hosta'];
$room = $_POST['roomno'];
$price = $_POST['price'];

$sql= mysqli_query($conn,"UPDATE `booking` set status ='paid' where id ='$book' ");
if($sql){
    $qr = mysqli_query($conn,"select * from `more_info` where user_id = '$user' ");
    while($row = mysqli_fetch_assoc($qr)){
        $you = $row['stud_phone'];
        $par = $row['guard_phone'];
    }
}

$contacts = $you .','. $par;
$message = 'Payment of '.$price.' for: '.$hosta.'. room:'.$room.' by: '.$name ;

$username = "clov";
$apiKey = "6c9073ed0e075857605f5c7f60f98d11d2a7f6ad89711fc5d0c6bab751f8d841";

$AT       = new AfricasTalking($username, $apiKey);
$sms      = $AT->sms();

$result   = $sms->send([
    'to'      => $contacts,
    'message' => $message,
]);

//print_r($result);
header("location: ../bank/bank_admin.php?paid_successfully");