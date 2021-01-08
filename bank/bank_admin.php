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
                
                <hr class="pt-2">
                <h3>Bookings</h3>
                <div class="py-2"></div>
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">Payment Ref No</th>
                            <th scope="col">First Name</th>
                            <th scope="col">Last Name</th>
                            <th scope="col">Room No</th>
                            <th scope="col">Hostel</th>
                            <th scope="col">Amount</th>
                            <th scope="col">Payment Status</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php 
                    
                    $sql = mysqli_query($conn, "SELECT * FROM `booking`");
                    while($row = mysqli_fetch_assoc($sql)){
                        $rid = $row['room_id'];
                        $status = $row['status'];
                        $ref_no = $row['ref_no'];
                        $bookin = $row['id'];
                        $user_id = $row['user_id'];

                        $sql2 = mysqli_query($conn, "SELECT * FROM `user` WHERE `id` = '$user_id' ");
                        while($row = mysqli_fetch_assoc($sql2)){
                            $fname = $row['fname'];
                            $lname = $row['lname'];
                        }

                        $sql3 = mysqli_query($conn, "SELECT * FROM `room` WHERE `id` = '$rid' ");
                        while($row = mysqli_fetch_assoc($sql3)){
                            $hid = $row['hostel_id'];
                            $occupy = $row['occupy_type'];
                            $price = $row['pricing'];
                            $room_no = $row['roomNo'];
                        }

                        $sql4 = mysqli_query($conn, "SELECT * FROM `hostel` WHERE `id` = '$hid' ");
                        while($row = mysqli_fetch_assoc($sql4)){
                            $hname = $row['name'];
                        }

                    ?>
                        <tr>
                            <td><?php echo $ref_no; ?></td>
                            <td><?php echo $fname; ?></td>
                            <td><?php echo $lname; ?></td>
                            <td><?php echo $room_no; ?></td>
                            <td><?php echo $hname; ?></td>
                            <td><?php echo $price; ?></td>
                            <?php 
                                if($status =='pending'){
                                    echo '<td><span class="badge badge-warning">PENDING</span></td>';
                                }else{
                                    echo '<td><span class="badge badge-success">PAID</span></td>';
                                } 
                            ?>
                            
                            <td class="inline">
                                <?php 
                                    if($status == 'pending'){
                                        echo '
                                            <form method="post" action="../funcs/sms.php" >
                                            <input type="hidden" name="book_id" value="'.$bookin.'" >
                                            <input type="hidden" name="user_id" value="'.$user_id.'" >
                                            
                                            <input type="hidden" name="roomno" value="'.$room_no.'" >
                                            <input type="hidden" name="Uname" value="'.$fname.' '.$lname.'" >
                                            <input type="hidden" name="Hosta" value="'.$hname.'" >
                                            <input type="hidden" name="price" value="'.$price.'" >


                                            <button type="submit" class="btn btn-sm btn-success">
                                                Pay
                                            </button>
                                            </form>
                                        ';
                                    }else{
                                        echo 'N/A';
                                    }
                                
                                ?>
                            </td>
                        </tr>
                    <?php } ?>
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