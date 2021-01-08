<?php 
    session_start();
    require 'funcs/config.php';
    if(!isset($_SESSION['selected_hostel']) || $_SESSION['selected_hostel'] == 0){
        header("location:index.php");
    }
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>The Hostel</title>
    <link rel="stylesheet" href="./dist/css/bootstrap.min.css">
    <style>
        html {
            scroll-behavior: smooth;
        }
    </style>
</head>

<body>
    <?php include 'nav.php'; ?>

    <main role="main">
        <?php 
            $hosta = $_SESSION['selected_hostel'];
            $sql = mysqli_query($conn, "SELECT * FROM `hostel` WHERE `id` = '$hosta' ");
            while($row = mysqli_fetch_assoc($sql)){
                $name = $row['name'];
                $desc = $row['description'];
                $restrict = $row['restriction'];
                $phone = $row['contact'];
                $locale = $row['location'];
            }
        ?>
        <div class="container marketing pb-4">
            <div class="row featurette pt-3">
                <div class="col-md-12 order-md-2 py-2">
                    <h2 class="featurette-heading"><?php echo $name; ?></h2>
                    <p class="lead">Description: <?php echo $desc; ?></p>
                    <p>Restriction: <b><?php echo $restrict; ?></b> <i class="float-right">Phone: <b><?php echo $phone; ?></b></i></p>
                    <div class="d-flex justify-content-between align-items-center pt-3">
                        <div class="btn-group">
                            <a href="index.php" type="button" class="px-1 btn btn-sm btn-outline-danger">Back top Hostels</a>&nbsp;
                            <a href="#" data-toggle="modal" data-target="#inquiry" type="button" class="px-1 btn btn-sm btn-outline-info">Inquire</a>
                        </div>
                        <small class="text-muted">Location: <b><?php echo $locale; ?></b></small>
                    </div>
                </div>
                

            </div>
        </div>

        <div class="album py-5 bg-light" id="rooms">
            <div class="container">
                <h4>Rooms</h4>
                <hr>
                <div class="row">
                        <?php
                            $sql = mysqli_query($conn, "SELECT * FROM `room` WHERE `hostel_id` = '$hosta' ");
                            $count = mysqli_num_rows($sql);
                            if($count == 0){ ?>
                                <h2 class="px-3 py-4 align-middle"> They are no free rooms available at the moment. Please try again later !</h2>
                            <?php } else {
                            while($row = mysqli_fetch_assoc($sql)){
                                $rid = $row['id'];
                                $roomNo = $row['roomNo'];
                                $price = $row['pricing'];
                                $type = $row['occupy_type'];
                                $self_c = $row['self_contained'];
                        ?>
                            <div class="col-md-4">
                                <div class="card mb-4 shadow-sm">
                                    <div class="card-body">
                                        <h3>RM No: <?php echo $roomNo; ?></h3>
                                        <p class="card-text"> Type: <b><?php echo $type; ?></b> &nbsp; | &nbsp;
                                            Self-Contained: <b><?php echo $self_c; ?></b></p>
                                        <div class="d-flex justify-content-between align-items-center">
                                            <div class="btn-group">
                                                <button type="button" class="btn btn-sm btn-outline-secondary"
                                                    data-toggle="modal" data-target="#bookRoomModal<?php echo $rid; ?>">Book
                                                    It</button>
                                            </div>
                                            <small class="text-muted">Price: <b>UGX <?php echo $price; ?></b></small>
                                        </div>
                                    </div>
                                </div>

                                <div class="modal fade" id="bookRoomModal<?php echo $rid; ?>" tabindex="-1" role="dialog"
                                    aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">

                                            <div class="modal-body bg-light">
                                                <button type="button" class="close" data-dismiss="modal"
                                                    aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                                <h3 class="px-3">Booking</h3>
                                                <div>
                                                    <div class="container">
                                                    <?php if(isset($_SESSION['role']) && $_SESSION['role'] == 3 && isset($_SESSION['user'])){ ?>
                                                        <form action="funcs/receipt.php" method="post">
                                                            <input hidden name="roomID" value="<?php echo $rid; ?>">
                                                            <div class="media py-2">
                                                                <div class="media-body">
                                                                    <h5 class="mt-0">Room No: <?php echo $roomNo; ?></h5>
                                                                    <hr>
                                                                    <p>
                                                                        Hostel Name: <?php echo $name; ?> <br>
                                                                        Location: <?php echo $locale; ?><br>
                                                                        Restriction: <?php echo $restrict; ?><br>
                                                                        <hr>
                                                                        Type: <b> <?php echo $type; ?></b><br>
                                                                        Self-Contained: <b><?php echo $self_c; ?></b><br>
                                                                        <br>Price:<b> UGX <?php echo $price; ?></b>
                                                                    </p>
                                                                </div>
                                                            </div>

                                                            <!-- <div class="form-group">
                                                                <label>Hold Room till :</label>
                                                                <input type="date" name="holdfrom" id=""
                                                                    class="form-control" required>
                                                            </div>

                                                            <div class="form-group">
                                                                <label>Make Payment By :</label>
                                                                <input type="date" name="payBy" id=""
                                                                    class="form-control" required>
                                                            </div>                                                         -->
                                                            <!-- <button type="reset" class="btn btn-warning">Reset</button> -->
                                                            <button type="submit" class="btn btn-primary">Generate Receipt</button>
                                                        </form>
                                                    <?php }else{ ?>
                                                        <h5 class="p-4 text-warning">You are required to login in order to Book this Room</h5>
                                                    <?php } ?> 
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                

                                
                            </div>
                        <?php } } ?>

                        <div class="modal fade" id="inquiry" tabindex="-1" role="dialog"
                                    aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-body bg-light">
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                        <h3 class="px-3">Inquiry</h3>
                                        <div>
                                            <div class="container">
                                                <?php if(isset($_SESSION['role']) && $_SESSION['role'] == 3 && isset($_SESSION['user'])){ ?>
                                                <form action="funcs/" method="post">
                                                    <input hidden name="userID" value="<?php echo  $_SESSION['user_id']; ?>">
                                                            
                                                    <div class="form-group">
                                                        <textarea name="message" rows="5" class="form-control" required></textarea>
                                                    </div>

                                                    <button type="reset" class="btn btn-warning">Reset</button>
                                                    <button type="submit" class="btn btn-primary">Send Inquiry</button>
                                                </form>
                                                <?php }else{ ?>
                                                <h5 class="p-4 text-warning">You are required to login in order to make an inquiry</h5>
                                                <?php } ?> 
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
            </div>
        </div>

        <footer class="footer">
            <div class="container py-2">
                <b>&copy; 2020</b>
            </div>
        </footer>
    </main>
            
    <!-- Modal -->
    <?php include 'complaint_modal.php'; ?>
    
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
                                <li><a data-toggle="pill" class="nav-pills pr-2" href="#StudentForm">Student</a></li>
                                <li><a data-toggle="pill" class="nav-pills pl-2" href="#HostelMgrForm">Hostel Manager</a></li>
                            </ul>
                            <div class="tab-content">
                                <div id="StudentForm" class="tab-pane fade">
                                    <hr>
                                    <form action="funcs/reg_stud.php" method="post">
                                        <h5>Student Details</h5>
                                        <div class="row">
                                            <div class="form-group col-md-4">
                                                <label>First Name :</label>
                                                <input type="text" name="sfname" id="" class="form-control" required>
                                            </div>
                                            <div class="form-group col-md-5">
                                                <label>Last Name :</label>
                                                <input type="text" name="slname" id="" class="form-control" required>
                                            </div>
                                            <div class="form-group col-md-3">
                                                <label>Sex :</label>
                                                <select name="gender" id="" class="form-control" required>
                                                    <option value="">Select</option>
                                                    <option value="male">Male</option>
                                                    <option value="female">Female</option>
                                                </select>
                                            </div>
                                        </div>
                                            
                                        <div class="form-group">
                                            <label>University :</label>
                                            <input type="text" name="university" id="" class="form-control" required>
                                        </div>
                                        <div class="row">
                                            <div class="form-group col-md-5">
                                                <label>Registration No :</label>
                                                <input type="text" name="reg_no" id="" class="form-control" required>
                                            </div>
                                            <div class="form-group col-md-7">
                                                <label>Course :</label>
                                                <input type="text" name="course" id="" class="form-control" required>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label>Email Address :</label>
                                            <input type="email" name="username" id="" class="form-control" required>
                                        </div>
                                        <div class="form-group">
                                            <label>Mobile Number :</label>
                                            <input type="number" name="stud_phone" id="" class="form-control" required>
                                        </div>

                                        <hr>
                                        <h5>Guardian Details</h5>
                                        <div class="row">
                                            <div class="form-group col-md-6">
                                                <label>First Name :</label>
                                                <input type="text" name="gfname" id="" class="form-control" required>
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label>Last Name :</label>
                                                <input type="text" name="glname" id="" class="form-control" required>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label>Mobile Number :</label>
                                            <input type="number" name="guard_phone" id="" class="form-control" required>
                                        </div>
                                        <hr>

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

                                <div id="HostelMgrForm" class="tab-pane fade">
                                    <hr>
                                    <form action="funcs/reg_hosta.php" method="post">
                                        <h5>Personal Details</h5>
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
                                        <hr>

                                        <h5>Hostel Details</h5>
                                        <div class="row">
                                            <div class="form-group col-md-7">
                                                <label>Hostel Name :</label>
                                                <input type="text" name="hname" id="" class="form-control" required>
                                            </div>
                                            <div class="form-group col-md-5">
                                                <label>Location :</label>
                                                <select name="location" class="form-control" id="exampleFormControlSelect1">
                                                    <option value="">Select</option>
                                                    <option value="Mbarara, Kiswahili">Mbarara, Kiswahili</option>
                                                    <option value="Mbarara, Boma">Mbarara, Boma</option>
                                                    <option value="Mbarara, Katete">Mbarara, Katete</option>
                                                    <option value="Mbarara, Kashanyarazi">Mbarara, Kashanyarazi</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                        <label>Restriction :</label>
                                                <select name="restriction" id="" class="form-control" required>
                                                    <option value="None">N/A</option>
                                                    <option value="Girls">Girls Only</option>
                                                    <option value="Boys">Boys Only</option>
                                                </select>
                                        </div>
                                        <hr>
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



    <script src="./dist/js/jquery.min.js"></script>
    <script src="./dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>