<style>
  .navbar-default {
    overflow: hidden;
    background-color: #333;
  }

  .navbar-default a {
    float: left;
    display: block;
    color: #f2f2f2;
    text-align: center;
    padding: 14px 16px;
    text-decoration: none;
    font-size: 17px;
  }

  .navbar-default a:hover {
    background-color: #ddd;
    color: black;
  }

  .navbar-default a.active {
    background-color: #04AA6D;
    color: white;
  }

  .navbar-default .icon {
    display: none;
  }

  @media screen and (max-width: 600px) {
    .navbar-default a:not(:first-child) {
      display: none;
    }

    .navbar-default a.icon {
      float: right;
      display: block;
    }
  }

  @media screen and (max-width: 600px) {
    .navbar-default.responsive {
      position: relative;
    }

    .navbar-default.responsive .icon {
      position: absolute;
      right: 0;
      top: 0;
    }

    .navbar-default.responsive a {
      float: none;
      display: block;
      text-align: left;
    }
  }
</style>
<header>
  <div class="default-header">
    <div class="container">
      <div class="row">
        <div class="col-sm-3 col-md-2">
          <!-- <div class="logo"> <a href="index.php"><img src="assets/images/logo.png" alt="image"/></a> </div> -->
          <div style="background-color:black; font-family:algerian; border: 2px solid green" class="logo"> <a style="padding:1px;" href="index.php"><b>WENSTECH CAR SERVICES</b></a> </div>
        </div>
        <div class="col-sm-9 col-md-10">
          <div class="header_info">
            <?php
            $sql = "SELECT EmailId,ContactNo from tblcontactusinfo";
            $query = $dbh->prepare($sql);
            $query->execute();
            $results = $query->fetchAll(PDO::FETCH_OBJ);
            foreach ($results as $result) {
              $email = $result->EmailId;
              $contactno = $result->ContactNo;
            }
            ?>

            <!-- <div class="header_widgets">
              <div class="circle_icon"> <i class="fa fa-envelope" aria-hidden="true"></i> </div>
              <p class="uppercase_text">For Support Mail us : </p>
              <a href="mailto:<?php echo htmlentities($email); ?>"><?php echo htmlentities($email); ?></a> </div>
            <div class="header_widgets">
              <div class="circle_icon"> <i class="fa fa-phone" aria-hidden="true"></i> </div>
              <p class="uppercase_text">Service Helpline Call Us: </p>
              <a href="tel:<?php echo htmlentities($contactno); ?>"><?php echo htmlentities($contactno); ?></a> </div>
            <div class="social-follow">
            
            </div> -->
            <?php if (strlen($_SESSION['login']) == 0) {
            ?>
              <div class="login_btn"> <a href="#loginform" class="btn btn-xs uppercase" data-toggle="modal" data-dismiss="modal">Login / Register</a> </div>
            <?php } else {

              echo "Welcome To carpooling page";
            } ?>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- Navigation -->
  <!-- Navigation -->
  <nav id="navigation_bar" class="navbar-default">
    <div class="container">
      <div class="navbar-header">
        <button id="menu_slide" data-target="#navigation" aria-expanded="false" data-toggle="collapse" class="navbar-toggle collapsed" type="button"> <span class="sr-only">Toggle navigation</span> <span class="icon-bar"></span> <span class="icon-bar"></span> <span class="icon-bar"></span> </button>
      </div>
      <div class="header_wrap">
        <div class="user_login">
          <ul>
            <li class="dropdown"> <a href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fa fa-user-circle" aria-hidden="true"></i>
                <?php
                $email = $_SESSION['login'];
                $sql = "SELECT FullName FROM tblusers WHERE EmailId=:email ";
                $query = $dbh->prepare($sql);
                $query->bindParam(':email', $email, PDO::PARAM_STR);
                $query->execute();
                $results = $query->fetchAll(PDO::FETCH_OBJ);
                if ($query->rowCount() > 0) {
                  foreach ($results as $result) {

                    echo htmlentities($result->FullName);
                  }
                } ?>
                <i class="fa fa-angle-down" aria-hidden="true"></i></a>
              <ul class="dropdown-menu">
                <?php if ($_SESSION['login']) { ?>
                  <li><a href="profile.php">Profile Settings</a></li>
                  <li><a href="update-password.php">Update Password</a></li>
                  <li><a href="my-booking.php">My Booking</a></li>
                  <li><a href="post-testimonial.php">Post a Testimonial</a></li>
                  <li><a href="my-testimonials.php">My Testimonial</a></li>
                  <li><a href="logout.php">Sign Out</a></li>
                <?php } ?>
              </ul>
            </li>
          </ul>
        </div>
        <div class="header_search">
          <div id="search_toggle"><i class="fa fa-search" aria-hidden="true"></i></div>
          <form action="search.php" method="post" id="header-search-form">
            <input type="text" placeholder="eg. juja - cbd" name="searchdata" class="form-control" required="true">
            <button type="submit"><i class="fa fa-search" aria-hidden="true"></i></button>
          </form>
        </div>
      </div>
      <div class="collapse navbar-collapse" id="navigation">
        <ul class="nav navbar-nav">

          <li><a class="active" href="index.php">Home</a> </li>
          <li><a class="list" href="car-listing.php">available Rides</a>

          <li><a class="list" href="page.php?type=aboutus">About Us</a></li>

          <li><a class="list" href="page.php?type=faqs">FAQs</a></li>
          <li><a class="list" href="contact-us.php">Contact Us</a></li>
          <li><a href="javascript:void(0);" class="icon" onclick="myFunction()"></li>

        </ul>
      </div>
    </div>
  </nav>
  <!-- Navigation end -->
  <script>
    function myFunction() {
      var x = document.getElementById("navigation_bar");
      if (x.className === "navbar-default") {
        x.className += " responsive";
      } else {
        x.className = "navbar-default";
      }
    }
  </script>

</header>