<?php 
session_start();
require '../funcs/config.php';
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
                    <h1 class="h2">Hostel Details</h1>
                </div>

                <?php 
                    $user = $_SESSION['user_id'];
                    $q = mysqli_query($conn,"SELECT * FROM `hostel` WHERE `hostel_manager` = '$user' " );
                    while($row = mysqli_fetch_assoc($q)){
                        $hosta_id = $row['id'];
                        $h_name = $row['name'];
                        $h_loc = $row['location'];
                        $h_res = $row['restriction'];
                        $h_desc = $row['description'];
                        $h_tact = $row['contact'];
                        $h_bank = $row['bank'];
                        $h_acc_name = $row['acc_name'];
                        $h_acc_no = $row['acc_no'];
                    }
                ?>


                <form method="POST" action="../funcs/hostel_details.php">
                    <input type="text" hidden value="<?php echo $hosta_id; ?>" name="hosta_id">
                    <div class="row">
                        <div class="form-group col-md-7">
                            <label for="exampleFormControlInput1">Hostel Name</label>
                            <input type="text" name="hosta_name" class="form-control" id="exampleFormControlInput1"
                                placeholder="<?php echo $h_name; ?>">
                        </div>
                        <div class="form-group col-md-5">
                            <label for="exampleFormControlInput1">Hostel Contact No</label>
                            <input type="text" name="hosta_contact" class="form-control" id="exampleFormControlInput1"
                                placeholder="<?php echo $h_tact; ?>">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="exampleFormControlSelect1">Restrictions</label>
                        <select class="form-control" name="restriction" id="exampleFormControlSelect1">
                            <option <?php if($h_res == "N/A"){ echo 'selected'; }?> value="N/A"> N/A</option>
                            <option <?php if($h_res == "Girls"){ echo 'selected'; }?> value="Girls"> Girls Only</option>
                            <option <?php if($h_res == "Boys"){ echo 'selected'; }?> value="Boys"> Boys Only</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="exampleFormControlSelect1">Location</label>
                        <select class="form-control" name="location" id="exampleFormControlSelect1">
                            <option <?php if($h_loc == ""){ echo 'selected'; }?> value="">Select</option>
                            <option <?php if($h_loc == "Mbarara, Kiswahili"){ echo 'selected'; }?> >Mbarara, Kiswahili</option>
                            <option <?php if($h_loc == "Mbarara, Boma"){ echo 'selected'; }?> >Mbarara, Boma</option>
                            <option <?php if($h_loc == "Mbarara, Katete"){ echo 'selected'; }?> >Mbarara, Katete</option>
                            <option <?php if($h_loc == "Mbarara, Kashanyarazi"){ echo 'selected'; }?> >Mbarara, Kashanyarazi</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="exampleFormControlTextarea1">Description <i>(250 characters)</i></label>
                        <textarea class="form-control" name="desc" id="exampleFormControlTextarea1" rows="4" placeholder="<?php echo $h_desc; ?>"></textarea>
                    </div>
                    <hr>
                    <div class="form-group">
                        <label for="exampleFormControlSelect1">Bank</label>
                        <select class="form-control" name="bank" id="exampleFormControlSelect1">
                            <option <?php if($h_bank == ""){ echo 'selected'; }?> value="">Select</option>
                            <option <?php if($h_bank == "UBA"){ echo 'selected'; }?> value="UBA">UBA</option>
                            <option <?php if($h_bank == "Standbic Bank"){ echo 'selected'; }?> value="Standbic Bank">Standbic Bank</option>
                        </select>
                    </div>
                    <div class="row">
                    <div class="form-group col-md-7">
                            <label for="exampleFormControlInput1">Account Name</label>
                            <input type="text" name="acc_name" class="form-control" id="exampleFormControlInput1"
                                placeholder="<?php echo $h_acc_name; ?>">
                    </div>
                    <div class="form-group col-md-5">
                            <label for="exampleFormControlInput1">Account No</label>
                            <input type="text" name="acc_no" class="form-control" id="exampleFormControlInput1"
                                placeholder="<?php echo $h_acc_no; ?>">
                    </div>
                    </div>

                    <hr>
                    <button type="submit" class="btn btn-success btn-sm">UPDATE</button>
                </form>



            </main>
        </div>
    </div>

    <script src="../dist/js/jquery.min.js"></script>
    <script src="../dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>