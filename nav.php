 <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
 <a class="navbar-brand" href="index.php"><b>The Hostel</b></a>
 <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo01"
     aria-controls="navbarTogglerDemo01" aria-expanded="false" aria-label="Toggle navigation">
     <span class="navbar-toggler-icon"></span>
 </button>
 <div class="collapse navbar-collapse" id="navbarTogglerDemo01">
     <ul class="navbar-nav mr-auto mt-2 mt-lg-0 px-4">
     <?php if(isset($_SESSION['role']) && $_SESSION['role'] == 3 && isset($_SESSION['user'])){ ?>
         <li class="nav-item">
             <a class="nav-link" href="track_booking.php">Track Bookings</a>
         </li>
         <li class="nav-item">
             <a class="nav-link" href="#" data-toggle="modal" data-target="#complaint">Complaints</a>
         </li>
         <li class="nav-item">
             <a class="nav-link" href="user_profile.php">User Profile</a>
         </li>
     <?php } ?>
     </ul>
     <?php if(isset($_SESSION['role']) && $_SESSION['role'] == 3 && isset($_SESSION['user'])){ ?>
         <form class="navbar-right form-inline" role="form" method="post" action="funcs/logout.php">
             <h6 class="text-white pt-2">Welcome back,</h6>
             <h5 class="pr-4 text-white pt-2">&nbsp; <?php echo $_SESSION['user'] ?></h5>
             <button class="btn btn-danger" type="submit">Logout</button>
         </form>
     <?php }  if(!isset($_SESSION['user']) && !isset($_SESSION['role']) || $_SESSION['role'] != 3) { ?>
         <form class="form-inline my-2 my-lg-0" method="post" action="funcs/login.php">
             <input class="form-control mr-sm-2" type="input" placeholder="Email"
             aria-label="username" name="username" required>
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
