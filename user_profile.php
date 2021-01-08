<?php
session_start();
require 'funcs/config.php';
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

            <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">
                <div
                    class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                    <h1 class="h2">User Profile</h1>
                </div>

                <h4>Edit Details</h4>
                <?php 
                    $user = $_SESSION['user_id'];
                    $q = mysqli_query($conn,"SELECT * FROM `user` WHERE `id` = '$user' " );
                    while($row = mysqli_fetch_assoc($q)){
                        $f_name = $row['fname'];
                        $l_name = $row['lname'];
                        $auth = $row['auth_id'];
                    }
                    $q1 = mysqli_query($conn,"SELECT * FROM `auth_user` WHERE `id` = '$auth' " );
                    while($row = mysqli_fetch_assoc($q1)){
                        $email = $row['username'];
                    }
                ?>

                <form method="post" action="">
                    <div class="row">
                        <div class="form-group col-md-6">
                            <label for="exampleFormControlInput1">First Name</label>
                            <input type="text" class="form-control" id="exampleFormControlInput1" name="fname" placeholder="<?php echo $f_name; ?>">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="exampleFormControlInput1">Last Name</label>
                            <input type="text" class="form-control" id="exampleFormControlInput1" name="lname" placeholder="<?php echo $l_name; ?>">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="exampleFormControlInput1">Email</label>
                        <input type="email" class="form-control" id="exampleFormControlInput1" name="email" placeholder="<?php echo $email; ?>">
                    </div>
                    <button type="submit" class="btn btn-info btn-sm">EDIT DETAILS</button>
                </form>
                <hr>
                <h4>Change Password</h4>
                <form method="post" action="../funcs/changepass.php">
                    <div class="form-group">
                        <label for="exampleFormControlInput1">Old Password</label>
                        <input type="password" class="form-control" id="exampleFormControlInput1"
                            placeholder="Old Password" name="oldpass" required>
                    </div>
                    <div class="row">

                        <div class="form-group col-md-6">
                            <label for="exampleFormControlInput1">New Password</label>
                            <input type="password" class="form-control" id="exampleFormControlInput1"
                                placeholder="New Password" name="newpass" required>
                        </div>

                        <div class="form-group col-md-6">
                            <label for="exampleFormControlInput1">Confirm Password</label>
                            <input type="password" class="form-control" id="exampleFormControlInput1"
                                placeholder="Confirm Password" name="confpass" required>
                        </div>
                    </div>

                    <button type="submit" class="btn btn-success btn-sm">CHANGE PASSWORD</button>
                </form>
            </main>

        <footer class="footer">
            <div class="container py-2">
                <b>&copy; 2020</b>
            </div>
        </footer>

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
                                                    <option value="N/A">N/A</option>
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

    <?php include 'complaint_modal.php'; ?>

    <script src="./dist/js/jquery.min.js"></script>
    <script src="./dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>