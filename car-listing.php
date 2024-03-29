<?php
session_start();
include('includes/config.php');
error_reporting(0);
?>

<!DOCTYPE HTML>
<html lang="en">

<head>

  <title>available cars</title>
  <!--Bootstrap -->
  <link rel="stylesheet" href="assets/css/bootstrap.min.css" type="text/css">
  <!--Custome Style -->
  <link rel="stylesheet" href="assets/css/style.css" type="text/css">
  <!--OWL Carousel slider-->
  <link rel="stylesheet" href="assets/css/owl.carousel.css" type="text/css">
  <link rel="stylesheet" href="assets/css/owl.transitions.css" type="text/css">
  <!--slick-slider -->
  <link href="assets/css/slick.css" rel="stylesheet">
  <!--bootstrap-slider -->
  <link href="assets/css/bootstrap-slider.min.css" rel="stylesheet">
  <!--FontAwesome Font Style -->
  <link href="assets/css/font-awesome.min.css" rel="stylesheet">

  <!-- SWITCHER -->
  <link rel="stylesheet" id="switcher-css" type="text/css" href="assets/switcher/css/switcher.css" media="all" />
  <link rel="alternate stylesheet" type="text/css" href="assets/switcher/css/red.css" title="red" media="all" data-default-color="true" />
  <link rel="alternate stylesheet" type="text/css" href="assets/switcher/css/orange.css" title="orange" media="all" />
  <link rel="alternate stylesheet" type="text/css" href="assets/switcher/css/blue.css" title="blue" media="all" />
  <link rel="alternate stylesheet" type="text/css" href="assets/switcher/css/pink.css" title="pink" media="all" />
  <link rel="alternate stylesheet" type="text/css" href="assets/switcher/css/green.css" title="green" media="all" />
  <link rel="alternate stylesheet" type="text/css" href="assets/switcher/css/purple.css" title="purple" media="all" />

  <!-- Fav and touch icons -->
  <link rel="apple-touch-icon-precomposed" sizes="144x144" href="assets/images/favicon-icon/apple-touch-icon-144-precomposed.png">
  <link rel="apple-touch-icon-precomposed" sizes="114x114" href="assets/images/favicon-icon/apple-touch-icon-114-precomposed.html">
  <link rel="apple-touch-icon-precomposed" sizes="72x72" href="assets/images/favicon-icon/apple-touch-icon-72-precomposed.png">
  <link rel="apple-touch-icon-precomposed" href="assets/images/favicon-icon/apple-touch-icon-57-precomposed.png">
  <link rel="shortcut icon" href="assets/images/favicon-icon/favicon.png">
  <link href="https://fonts.googleapis.com/css?family=Lato:300,400,700,900" rel="stylesheet">
</head>

<body class="container">

 

  <!--Header-->
  <?php include('includes/header.php'); ?>
  <!-- /Header -->

  <!--Page Header-->
  <section class="page-header listing_page">
    <div class="container">
      <div class="page-header_wrap">
        <div class="page-heading">
          <h1>Available Rides</h1>
        </div>
        <ul class="coustom-breadcrumb">
          <li><a href="#">Home</a></li>
          <li>Rides</li>
        </ul>
      </div>
    </div>
    <!-- Dark Overlay-->
    <div class="dark-overlay"></div>
  </section>
  <!-- /Page Header-->

  <!--Listing-->
  <section class="listing-page">
    <div class="container">
      <div class="row">
        <div class="col-md-9 col-md-push-3">
          <div class="result-sorting-wrapper">
            <div class="sorting-count">
              <?php
              //Query for Listing count
              $sql = "SELECT id from tblvehicles";
              $query = $dbh->prepare($sql);
              $query->execute();
              $results = $query->fetchAll(PDO::FETCH_OBJ);
              $cnt = $query->rowCount();
              ?>
              <p><span><?php echo htmlentities($cnt); ?> Rides</span></p>
            </div>
          </div>

          <?php $sql = "SELECT tblvehicles.*,tblroutes.routename,tblroutes.id as bid  from tblvehicles join tblroutes on tblroutes.id=tblvehicles.routename";
          $query = $dbh->prepare($sql);
          $query->execute();
          $results = $query->fetchAll(PDO::FETCH_OBJ);
          $cnt = 1;
          if ($query->rowCount() > 0) {
            foreach ($results as $result) {  ?>
              <div class="product-listing-m gray-bg">
                <div class="product-listing-img"><img src="admin/img/vehicleimages/<?php echo htmlentities($result->Vimage); ?>" class="img-responsive" alt="Image" /> </a>
                </div>
                <div class="product-listing-content">
                  <h5><a href="vehical-details.php?vhid=<?php echo htmlentities($result->id); ?>"><?php echo htmlentities($result->routename); ?> , <?php echo htmlentities($result->VehicleTitle); ?></a></h5>
                  <p class="list-price">SH.<?php echo htmlentities($result->price); ?> </p>
                  <ul>
                    <li><i class="fa fa-user" aria-hidden="true"></i><?php echo htmlentities($result->seats); ?> Total Car seats</li>
                    <li><i class="fa fa-calendar" aria-hidden="true"></i><?php echo htmlentities($result->freeseats); ?> Available free seats</li>
                    <li><i class="fa fa-car" aria-hidden="true"></i><?php echo htmlentities($result->drivername); ?> Driver</li>
                    <li><i class="fa fa-car" aria-hidden="true"></i><?php echo htmlentities($result->drivercontacts); ?> Driver Contacts</li>
                  </ul>
                  <a href="vehical-details.php?vhid=<?php echo htmlentities($result->id); ?>" class="btn">View Details <span class="angle_arrow"><i class="fa fa-angle-right" aria-hidden="true"></i></span></a>
                </div>
              </div>
          <?php }
          } ?>
        </div>

        <!--Side-Bar-->
        <aside class="col-md-3 col-md-pull-9">
          <div class="sidebar_widget">
            <h5><i class="fa fa-filter" aria-hidden="true"></i> Find a car </h5>
            <form action="search.php" method="post" id="header-search-form">
              <input style="margin-right:35px;" type="text" placeholder="Route.e.g cbd - juja" name="searchdata" class="form-control" required="true">

              
                <div>
                  <button type="submit"><i class="fa fa-search" aria-hidden="true"></i></button>
                </div>

            </form>
            <!-- <div class="widget_heading">
              <h5><i class="fa fa-filter" aria-hidden="true"></i> Find a car </h5>
            </div>
            <div class="sidebar_filter">
              <form action="search.php" method="post">
                <div class="form-group select">
                  <select class="form-control" name="searchdata">
                    <option style="color:black; background-color:white;">Select Route</option>

                    <?php $sql = "SELECT * from  tblroutes ";
                    $query = $dbh->prepare($sql);
                    $query->execute();
                    $results = $query->fetchAll(PDO::FETCH_OBJ);
                    $cnt = 1;
                    if ($query->rowCount() > 0) {
                      foreach ($results as $result) {       ?>
                        <option style="color:black; background-color:white;" value="<?php echo htmlentities($result->id); ?>"><?php echo htmlentities($result->routeName); ?></option>
                    <?php }
                    } ?>
                    <div class="form-group">
                      <button type="submit" class="btn btn-block"><i class="fa fa-search" aria-hidden="false"></i>Search Car</button>
                    </div>

              </form> -->
          </div>
      </div>

      <div class="sidebar_widget">
        <div class="widget_heading">
          <h5><i class="fa fa-car" aria-hidden="true"></i> Recently Posted Rides</h5>
        </div>
        <div class="recent_addedcars">
          <ul>
            <?php $sql = "SELECT tblvehicles.*,tblroutes.routename,tblroutes.id as bid  from tblvehicles join tblroutes on tblroutes.id=tblvehicles.routename order by id desc limit 4";
            $query = $dbh->prepare($sql);
            $query->execute();
            $results = $query->fetchAll(PDO::FETCH_OBJ);
            $cnt = 1;
            if ($query->rowCount() > 0) {
              foreach ($results as $result) {  ?>

                <li class="gray-bg">
                  <div class="recent_post_img"> <a href="vehical-details.php?vhid=<?php echo htmlentities($result->id); ?>"><img src="admin/img/vehicleimages/<?php echo htmlentities($result->Vimage); ?>" alt="image"></a> </div>
                  <div class="recent_post_title"> <a href="vehical-details.php?vhid=<?php echo htmlentities($result->id); ?>"><?php echo htmlentities($result->routename); ?> , <?php echo htmlentities($result->VehiclesTitle); ?></a>
                    <p class="widget_price">SH.<?php echo htmlentities($result->price); ?> Price</p>
                  </div>
                </li>
            <?php }
            } ?>

          </ul>
        </div>
      </div>
      </aside>
      <!--/Side-Bar-->
    </div>
    </div>
  </section>
  <!-- /Listing-->



  <!--Back to top-->
  <div id="back-top" class="back-top"> <a href="#top"><i class="fa fa-angle-up" aria-hidden="true"></i> </a> </div>
  <!--/Back to top-->






  <!-- Scripts -->
  <script src="assets/js/jquery.min.js"></script>
  <script src="assets/js/bootstrap.min.js"></script>
  <script src="assets/js/interface.js"></script>
  <!--Switcher-->
  <script src="assets/switcher/js/switcher.js"></script>
  <!--bootstrap-slider-JS-->
  <script src="assets/js/bootstrap-slider.min.js"></script>
  <!--Slider-JS-->
  <script src="assets/js/slick.min.js"></script>
  <script src="assets/js/owl.carousel.min.js"></script>


</body>


</html>