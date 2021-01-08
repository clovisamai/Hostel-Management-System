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
                    <h1 class="h2">Rooms</h1>
                    <div class="btn-toolbar mb-2 mb-md-0">
                        <button type="button" class="btn btn-sm btn-success" data-toggle="modal"
                            data-target="#addRoomModal">
                            Add Room +
                        </button>
                    </div>
                </div>

                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">Room No</th>
                            <th scope="col">Type</th>
                            <th scope="col">Self-Contained</th>
                            <th scope="col">Size</th>
                            <th scope="col">Price</th>
                            <th scope="col">Status</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                            $user = $_SESSION['user_id'];
                            $hostelID = mysqli_query($conn, "SELECT id FROM `hostel` WHERE `hostel_manager` = '$user' ");
                            while($row = mysqli_fetch_assoc($hostelID)){
                                $hostel_id = $row['id'];
                            }
                        ?>
                        <?php
                            $sql = mysqli_query($conn, "SELECT * FROM `room` WHERE `hostel_id` = '$hostel_id' ");
                            while($row = mysqli_fetch_assoc($sql)){
                                $id = $row['id'];
                                $roomNo = $row['roomNo'];
                                $type = $row['occupy_type'];
                                $self_c = $row['self_contained'];
                                $size = $row['size'];
                                $price = $row['pricing'];
                                $status = $row['status'];
                        ?>
                        <tr>
                            <td><?php echo $roomNo; ?></td>
                            <td><?php echo $type; ?></td>
                            <td><?php echo $self_c; ?></td>
                            <td><?php echo $size; ?> ft</td>
                            <td><?php echo $price; ?> UGX</td>
                            <td>
                                <?php if($status == "available"){ ?>
                                <span class="badge badge-success"><?php echo $status; ?></span>
                                <?php } ?>
                            </td>
                            <td class="inline">

                                <form action="../funcs/delroom.php" method="POST" class="inline">
                                    <a class="btn btn-sm btn-info text-white" data-toggle="modal"
                                        data-target="#editRoomModalid<?php echo $id; ?>">
                                        Edit
                                    </a>
                                    <button class="btn btn-sm btn-danger" type="submit">
                                        <input hidden value="<?php echo $id; ?>" name="roomNo">
                                        Delete
                                    </button>
                                </form>
                            </td>

                            <div class="modal fade" id="editRoomModalid<?php echo $id; ?>" tabindex="-1" role="dialog"
                                aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">

                                        <div class="modal-body bg-light">
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                            <h3 class="px-3">Edit Room</h3>
                                            <div>
                                                <div class="container">

                                                    <form action="../funcs/editroom.php" method="post">
                                                        <input hidden name="rid" value="<?php echo $id; ?>">
                                                        <div class="row">
                                                            <div class="form-group col-md-6">
                                                                <label>Room Number :</label>
                                                                <input type="text" name="rno" id="" class="form-control"
                                                                    placeholder="<?php echo $roomNo; ?>">
                                                            </div>
                                                            <div class="form-group col-md-6">
                                                                <label>Type :</label>
                                                                <select name="type" id="" class="form-control">
                                                                    <option value="">Select</option>
                                                                    <option value="Single"
                                                                        <?php if($type == "Single"){ echo 'selected'; }?>>
                                                                        Single</option>
                                                                    <option value="Double"
                                                                        <?php if($type == "Double"){ echo 'selected'; }?>>
                                                                        Double</option>
                                                                </select>
                                                            </div>
                                                        </div>

                                                        <div class="form-group">
                                                            <label class="pr-4">Self-Contained :</label>

                                                            <div class="form-check form-check-inline px-2">
                                                                <input class="form-check-input" type="radio"
                                                                    name="self_c" id="inlineRadio1" value="Yes"
                                                                    <?php if($self_c == "Yes"){ echo 'checked'; }?>>
                                                                <label class="form-check-label"
                                                                    for="inlineRadio1">Yes</label>
                                                            </div>
                                                            <div class="form-check form-check-inline px-2">
                                                                <input class="form-check-input" type="radio"
                                                                    name="self_c" id="inlineRadio2" value="No"
                                                                    <?php if($self_c == "No"){ echo 'checked'; }?>>
                                                                <label class="form-check-label"
                                                                    for="inlineRadio2">No</label>
                                                            </div>
                                                        </div>

                                                        <div class="form-group">
                                                            <label>Size (ft) :</label>
                                                            <input type="number" name="size" id="" class="form-control"
                                                                placeholder="<?php echo $size; ?> ft">
                                                        </div>
                                                        <div class="form-group">
                                                            <label>Price :</label>
                                                            <input type="number" name="price" id="" class="form-control"
                                                                placeholder="<?php echo $price; ?> UGX">
                                                        </div>

                                                        <hr>
                                                        <button type="submit" class="btn btn-primary">Edit Room</button>
                                                    </form>

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </tr>
                        <?php } ?>
                    </tbody>
                </table>

            </main>
        </div>
    </div>


    <!-- Modal -->
    <div class="modal fade" id="addRoomModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">

                <div class="modal-body bg-light">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <h3 class="px-3">Add Room</h3>
                    <div>
                        <div class="container">

                            <form action="../funcs/addroom.php" method="post">
                                <div class="row">
                                    <div class="form-group col-md-6">
                                        <label>Room Number :</label>
                                        <input type="text" name="rno" id="" class="form-control" required>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label>Type :</label>
                                        <select name="type" id="" class="form-control" required>
                                            <option value="">Select</option>
                                            <option value="Single">Single</option>
                                            <option value="Double">Double</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="pr-4">Self-Contained :</label>
                                    <div class="form-check form-check-inline px-2">
                                        <input class="form-check-input" type="radio" name="self_c" id="inlineRadio1"
                                            value="Yes">
                                        <label class="form-check-label" for="inlineRadio1">Yes</label>
                                    </div>
                                    <div class="form-check form-check-inline px-2">
                                        <input class="form-check-input" type="radio" name="self_c" id="inlineRadio2"
                                            value="No">
                                        <label class="form-check-label" for="inlineRadio2">No</label>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label>Size (ft) :</label>
                                    <input type="number" name="size" id="" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label>Price :</label>
                                    <input type="number" name="price" id="" class="form-control">
                                </div>

                                <hr>
                                <button type="reset" class="btn btn-warning">Reset</button>
                                <button type="submit" class="btn btn-primary">Add Room</button>
                            </form>

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