<?php
session_start();
require 'config.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>The Hostel</title>
    <link rel="stylesheet" href="../dist/css/bootstrap.min.css">
    <style>
        html {
            scroll-behavior: smooth;
        }
    </style>
</head>

<body>

    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <a class="navbar-brand" href="../index.php"><b>The Hostel</b></a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo01"
            aria-controls="navbarTogglerDemo01" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarTogglerDemo01">
            <ul class="navbar-nav mr-auto mt-2 mt-lg-0 px-4">
                <?php if(isset($_SESSION['role']) && $_SESSION['role'] == 3 && isset($_SESSION['user'])){ ?>
                <li class="nav-item">
                    <a class="nav-link" href="../track_booking.php">Track Bookings</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#" data-toggle="modal" data-target="#complaint">Complaints</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="../user_profile.php">User Profile</a>
                </li>
                <?php } ?>
            </ul>
            <?php if(isset($_SESSION['role']) && $_SESSION['role'] == 3 && isset($_SESSION['user'])){ ?>
            <form class="navbar-right form-inline" role="form" method="post" action="../funcs/logout.php">
                <h6 class="text-white pt-2">Welcome back,</h6>
                <h5 class="pr-4 text-white pt-2">&nbsp; <?php echo $_SESSION['user'] ?></h5>
                <button class="btn btn-danger" type="submit">Logout</button>
            </form>
            <?php }  if(!isset($_SESSION['user']) && !isset($_SESSION['role']) || $_SESSION['role'] != 3) { ?>
            <form class="form-inline my-2 my-lg-0" method="post" action="funcs/login.php">
                <input class="form-control mr-sm-2" type="input" placeholder="Email" aria-label="username"
                    name="username" required>
                <input class="form-control  mr-sm-2" type="password" placeholder="Password" aria-label="password"
                    name="password" required>
                <button class="btn btn-success btn-sm my-2 my-sm-0" type="submit">LOGIN</button>
                <div class="px-2">
                    <a class="btn btn-warning btn-sm my-2 my-sm-0" type="button" data-toggle="modal"
                        data-target="#signUpModal">SIGN UP</a>
                </div>
            </form>
            <?php } ?>
        </div>
    </nav>
    <main role="main">

        <?php 
            $booking_user_id = $_SESSION['user_id'];
            $booking_room_id = $_POST['roomID'];
            $qr = "INSERT INTO `booking`(`id`, `user_id`, `room_id`, `status`) VALUES (NULL,'$booking_user_id','$booking_room_id','pending')";

            $sql = mysqli_query($conn, "SELECT * FROM `room` WHERE `id` = '$booking_room_id' ");
            $h =
            $count = mysqli_num_rows($sql);
            if($count == 0){ ?>
                <h2 class="px-3 py-4 align-middle"> No room was booked </h2>
            <?php } else {
                while($row = mysqli_fetch_assoc($sql)){
                    $rid = $row['id'];
                    $hostel_id = $row['hostel_id'];
                    $roomNo = $row['roomNo'];
                    $price = $row['pricing'];
                    $type = $row['occupy_type'];
                    $self_c = $row['self_contained'];
                }
                $ref = rand(1000000,9999999);
                $user_id = $_SESSION['user_id'];
                $book = mysqli_query($conn, "INSERT INTO `booking`(`id`, `user_id`, `room_id`, `status`, `ref_no`) VALUES (NULL,'$user_id','$rid','pending','$ref')" );
                $sql2 = mysqli_query($conn, "SELECT * FROM `hostel` WHERE `id` = '$hostel_id' ");

                while($row = mysqli_fetch_assoc($sql2)){
                    $hostel_name = $row['name'];
                    $h_acc = $row['acc_name'];
                    $han = $row['acc_no'];
                    $hb = $row['bank'];
                }

                if($book){
                    echo '<script>alert("Processing Booking")</script>';
                }

            }
        ?>

        <section class="jumbotron text-center bg-white">
            <div class="container">

                <h1 class="jumbotron-heading">Receipt</h1>
                <div class="container jumbotron">
                    <table class="text-right">
                        <tr>
                            <td style="width: 400px;"><b>NAME:</b></td>
                            <td style="width: 400px;"><?php echo $_SESSION['user']; ?></td>
                        </tr>
                        <tr>
                            <td><b>HOSTEL:</b></td>
                            <td><?php echo $hostel_name; ?></td>
                        </tr>
                        <tr>
                            <td><b>ROOM NO:</b></td>
                            <td><?php echo $roomNo; ?></td>
                        </tr>
                        <tr>
                            <td><b>PRICE:</b></td>
                            <td><?php echo $price; ?></td>
                        </tr>
                        <tr>
                            <td><b>BANK:</b></td>
                            <td><?php echo $hb; ?></td>
                        </tr>
                        <tr>
                            <td><b>ACC NAME:</b></td>
                            <td><?php echo $h_acc; ?></td>
                        </tr>
                        <tr>
                            <td><b>ACC NO:</b></td>
                            <td><?php echo $han; ?></td>
                        </tr>
                        <tr>
                            <td><b>REF NO:</b></td>
                            <td><?php echo $ref; ?></td>
                        </tr>
                    </table>
                    <div class="pt-4">
                    <button class="btn btn-info">Print</button>                    
                    </div>
                </div>
            </div>
        </section>

        <!-- <footer class="footer sticky-bottom">
            <div class="container py-2">
                <b>&copy; 2020</b>
            </div>
        </footer> -->
    </main>

    <!-- Modal -->
    <?php include '../complaint_modal.php'; ?>

    <script src="../dist/js/jquery.min.js"></script>
    <script src="../dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>