<?php 
session_start();
include '../funcs/config.php';
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
    <?php include 'topnav.php'; ?>
    <div class="container-fluid">
        <div class="row">
            <?php include 'sidenav.php'; ?>
            <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">
                <div
                    class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                    <h1 class="h2">Dashboard</h1>
                    <div class="btn-toolbar mb-2 mb-md-0 px-2">
                        Welcome back , &nbsp; <b><?php echo $_SESSION['user']; ?></b>
                    </div>
                </div>
                <?php 
                    $user = $_SESSION['user_id'];
                    $findHostel = mysqli_query($conn, "SELECT id FROM `hostel` WHERE `hostel_manager` = '$user' ");
                    
                    if($findHostel){
                        while($row = mysqli_fetch_assoc($findHostel)){
                            $hostel_id = $row['id'];
                        }
                    }
                ?>
                <div class="row container-fluid py-2">
                    <div class="col-md-3 px-1">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">Total Number</h5>
                                <h6 class="card-subtitle mb-2 text-muted">Of Rooms</h6>
                                <?php 
                                    $trooms = mysqli_query($conn, "SELECT COUNT(*) AS total_rooms FROM `room` WHERE `hostel_id` = '$hostel_id' ");
                                    $row = mysqli_fetch_assoc($trooms);
                                    $rm = $row['total_rooms'];
                                ?>
                                <h1 class="card-text"><?php echo $rm; ?></h1>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-3 px-1">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">Booked</h5>
                                <h6 class="card-subtitle mb-2 text-muted">Rooms</h6>
                                <?php 
                                    $trooms = mysqli_query($conn, "SELECT COUNT(*) AS total_rooms FROM `room` WHERE `hostel_id` = '$hostel_id' AND `status` = 'booked' ");
                                    $row = mysqli_fetch_assoc($trooms);
                                    $rm = $row['total_rooms'];
                                ?>
                                <h1 class="card-text"><?php echo $rm; ?></h1>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-3 px-1">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">Rooms</h5>
                                <h6 class="card-subtitle mb-2 text-muted">Pending Payment</h6>
                                <?php 
                                    $trooms = mysqli_query($conn, "SELECT COUNT(*) AS total_rooms FROM `room` WHERE `hostel_id` = '$hostel_id' AND `status` = 'pending' ");
                                    $row = mysqli_fetch_assoc($trooms);
                                    $rm = $row['total_rooms'];
                                ?>
                                <h1 class="card-text"><?php echo $rm; ?></h1>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-3 px-1">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">Available</h5>
                                <h6 class="card-subtitle mb-2 text-muted">Rooms</h6>
                                <?php 
                                    $trooms = mysqli_query($conn, "SELECT COUNT(*) AS total_rooms FROM `room` WHERE `hostel_id` = '$hostel_id' AND `status` = 'available' ");
                                    $row = mysqli_fetch_assoc($trooms);
                                    $rm = $row['total_rooms'];
                                ?>
                                <h1 class="card-text"><?php echo $rm; ?></h1>
                            </div>
                        </div>
                    </div>

                </div>
                <hr class="pt-2">
                <h3>Bookings</h3>
                <div class="py-2"></div>
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">Booking No</th>
                            <th scope="col">First Name</th>
                            <th scope="col">Last Name</th>
                            <th scope="col">Room No</th>
                            <th scope="col">Amount Paid</th>
                            <th scope="col">Balance</th>
                            <th scope="col">Payment Status</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>th_bk_0001</td>
                            <td>Mark</td>
                            <td>Aka</td>
                            <td>45</td>
                            <td>100000</td>
                            <td>300000</td>
                            <td><span class="badge badge-warning">Pending</span></td>
                            <td class="inline">
                                <button class="btn btn-sm btn-success">
                                    Paid
                                </button>
                                <button class="btn btn-sm btn-danger">
                                    Delete
                                </button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </main>
        </div>
    </div>


    <!-- Modal -->
    <div class="modal fade" id="signUpModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">

                <div class="modal-body bg-light">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <h3 class="px-3">Sign Up</h3>
                    <div>
                        <div class="container">
                            <p>Choose what type of account you would like to create</p>
                            <ul class="nav nav-pills">
                                <li><a data-toggle="pill" class="nav-pills pr-2" href="#home">Student</a></li>
                                <li><a data-toggle="pill" class="nav-pills pl-2" href="#menu1">Hostel Manager</a></li>
                            </ul>
                            <div class="tab-content">
                                <div id="home" class="tab-pane fade">
                                    <hr>
                                    <form action="funcs/reg_stud.php" method="post">
                                        <div class="row">
                                            <div class="form-group col-md-4">
                                                <label>First Name :</label>
                                                <input type="text" name="fname" id="" class="form-control" required>
                                            </div>
                                            <div class="form-group col-md-5">
                                                <label>Last Name :</label>
                                                <input type="text" name="lname" id="" class="form-control" required>
                                            </div>
                                            <div class="form-group col-md-3">
                                                <label>Sex :</label>
                                                <select name="gender" id="" class="form-control" required>
                                                    <option value="">Select</option>
                                                    <option value="1">Male</option>
                                                    <option value="2">Female</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label>Registration Number :</label>
                                            <input type="text" name="username" id="" class="form-control" required>
                                        </div>
                                        <div class="form-group">
                                            <label>Password :</label>
                                            <input type="password" name="password" id="" class="form-control" required>
                                        </div>
                                        <div class="form-group">
                                            <label>Confirm Password :</label>
                                            <input type="password" name="conf_password" id="" class="form-control"
                                                required>
                                        </div>
                                        <button type="reset" class="btn btn-warning">Reset</button>
                                        <button type="submit" class="btn btn-primary">Create Account</button>
                                    </form>
                                </div>
                                <div id="menu1" class="tab-pane fade">
                                    <hr>
                                    <form action="funcs/reg_hosta.php" method="post">
                                        <div class="row">
                                            <div class="form-group col-md-6">
                                                <label>First Name :</label>
                                                <input type="text" name="fname" id="" class="form-control" required>
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label>Last Name :</label>
                                                <input type="text" name="lname" id="" class="form-control" required>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label>Email :</label>
                                            <input type="email" name="email" id="" class="form-control" required>
                                        </div>
                                        <div class="form-group">
                                            <label>Hostel Name :</label>
                                            <input type="text" name="hname" id="" class="form-control" required>
                                        </div>
                                        <div class="form-group">
                                            <label>Password :</label>
                                            <input type="password" name="password" id="" class="form-control" required>
                                        </div>
                                        <div class="form-group">
                                            <label>Confirm Password :</label>
                                            <input type="password" name="conf_password" id="" class="form-control"
                                                required>
                                        </div>
                                        <button type="reset" class="btn btn-warning">Reset</button>
                                        <button type="submit" class="btn btn-primary">Create Account</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="../dist/js/jquery.min.js"></script>
    <script src="../dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>