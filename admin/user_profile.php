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
                    <h1 class="h2">User Profile</h1>
                </div>
                <h4>Edit Details</h4>
                <form>
                    <div class="row">
                        <div class="form-group col-md-6">
                            <label for="exampleFormControlInput1">First Name</label>
                            <input type="text" class="form-control" id="exampleFormControlInput1" name="fname">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="exampleFormControlInput1">Last Name</label>
                            <input type="text" class="form-control" id="exampleFormControlInput1" name="Lname">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="exampleFormControlInput1">Email</label>
                        <input type="email" class="form-control" id="exampleFormControlInput1" name="email">
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
        </div>
    </div>

    <script src="../dist/js/jquery.min.js"></script>
    <script src="../dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>