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

    <main role="main">

        <section class="jumbotron text-center">
            <div class="container">
                <h1 class="jumbotron-heading">The Hostel</h1>
                <p class="lead text-muted">Book your hostel room. Booking is <b>25 %</b> of the price of the room</p>
                <p>
                    Find your Campus room now!
                </p>
            </div>
        </section>


        <div class="album pb-4  container" id="hostels">
            <h2>Hostels</h2>
            <hr class="pb-2">
            <div class="row pb-4">
                <?php
                    $_SESSION['selected_hostel'] = 0;
                    $sql = mysqli_query($conn, "SELECT * FROM `hostel`");
                    $count = mysqli_num_rows($sql);
                    if($count == 0){ ?>
                        <h2 class="px-3 py-4 align-middle"> They are no Hostels available at the moment. Please try again later !</h2>
                    <?php } else {
                    while($row = mysqli_fetch_assoc($sql)){
                        $hotel_id = $row['id'];
                        $hostel_name = $row['name'];
                        $hostel_location = $row['location'];
                        $hostel_restriction = $row['restriction'];
                        
                ?>

                <div class="col-md-4">
                    <div class="card mb-4 shadow-sm">
                        <div class="card-body">
                            <p class="card-text text-uppercase"><?php echo $hostel_name; ?> <br> Location: <b><?php echo $hostel_location; ?></b></p>
                            <div class="d-flex justify-content-between align-items-center">
                                <div class="btn-group">
                                    <form action="funcs/gotohostel.php" method="POST">
                                        <input hidden name="hostaId" value="<?php echo $hotel_id; ?>">
                                        <button type="submit" class="btn btn-sm btn-outline-secondary">View
                                        Hostel</button>    
                                    </form>
                                </div>
                                <small class="text-muted">Restriction: <?php echo $hostel_restriction; ?></small>
                            </div>
                        </div>
                    </div>
                </div>

                <?php } }?>

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



    <script src="./dist/js/jquery.min.js"></script>
    <script src="./dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>