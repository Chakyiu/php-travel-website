<!DOCTYPE html>
<?php
	session_start();
	require_once('conn.php');
	if(isset($_SESSION['user'])) {
		if($_SESSION['user'] == "customer") {
			$id = $_SESSION['id'];
			$sql = "SELECT * FROM user WHERE user_account = '$id';";
			$rs = mysqli_query($conn, $sql) or die(mysqli_error($conn));
			$rc = mysqli_fetch_assoc($rs);
			
			if(isset($_COOKIE)){
				foreach($_COOKIE as $booking => $date) {
					$sql = "SELECT NOW() AS now;";
					$rs = mysqli_query($conn, $sql) or die(mysqli_error($conn));
					$rc = mysqli_fetch_assoc($rs);
					$now = $rc['now'];
					$sql = "SELECT DATEDIFF('$date', '$now') AS datediff;";
					$rs = mysqli_query($conn, $sql) or die(mysqli_error($conn));
					$rc = mysqli_fetch_assoc($rs);
					$datediff = $rc['datediff'];
					
					if($booking != "PHPSESSID" && $datediff <= 7) {
						echo "<script type='text/javascript'>
						alert(\"You booking $booking will departure in $datediff days later!\");
						</script>";
					}
				}
			}
		}
	}
?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Impress Travel</title>

    <link href="css/bootstrap/bootstrap.min.css" rel="stylesheet" type="text/css">
    <link href="css/fa/all.css" rel="stylesheet" type="text/css">
    <link href="css/layout.css" rel="stylesheet" type="text/css">
</head>
<body>
<div class="container">
    <div class="row"> 
        <img src="src/image/logo.png" style="padding: 5px 0 5px 0;"/>
    </div>
</div>
<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <a class="navbar-brand" href="index.php">Impress Travel</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item active">
        <a class="nav-link" href=""><i class="fas fa-home" style="font-size:16px"></i>Home <span class="sr-only">(current)</span></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="search_flight.php"><i class="fas fa-fighter-jet" style="font-size:16px"></i>Flight</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="search_hotel.php"><i class="fas fa-hotel" style="font-size:16px"></i>Hotel</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="list_package.php"><i class="fas fa-cubes" style="font-size:16px"></i>Package</a>
      </li>
    </ul>
    <ul class="nav navbar-nav navbar-right">
        <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <i class="fas fa-user" style="font-size:16px"></i>
                <?php
                	if(isset($_SESSION['user']))
						echo $_SESSION['name'];
					else
						echo "Account"
				?>
            </a>
            <div class="dropdown-menu dropdown-menu-right text-right" aria-labelledby="navbarDropdown">
              <?php
                if(isset($_SESSION['user'])) {
                    if($_SESSION['user'] == "customer") { ?>
                        <a class="dropdown-item" href="customer_profile.php">My Profile</a>
                        <a class="dropdown-item" href="customer_booking.php">My Booking</a>
                        <a class="dropdown-item" href="staff_check_shoppingcart.php">Shopping Cart</a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="" data-toggle="modal" data-target="#logoutModal">Sign Out</a>
                <?php
                    }
                    if($_SESSION['user'] == "staff") { ?>
                        <a class="dropdown-item" href="staff_edit_customer.php">Edit Customer</a>
                        <a class="dropdown-item" href="staff_edit_booking.php">Customer Booking</a>
                        <a class="dropdown-item" href="staff_view_airline.php">View Airline</a>
                        <a class="dropdown-item" href="staff_view_hotel.php">View Hotel</a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="airline_report.php">Analysis Report</a>
                        <a class="dropdown-item" href="hotelowner_report.php">Room Report</a>
                        <a class="dropdown-item" href="staff_view_pop_flight.php">Pop Flight</a>
                        <a class="dropdown-item" href="staff_view_pop_hotel.php">Pop Hotel</a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="" data-toggle="modal" data-target="#logoutModal">Sign Out</a>
                <?php
                    }
                } else { ?>
                    <a class="dropdown-item" href="login.php">Sign in</a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="register.php">Sign up</a>
            <?php } ?>
            </div>
          </li>
    </uL>
  </div>
</nav>

<div class="container-fluid">
    <div class="row rowbody">
        <!-- Tabs -->
        <div class="offset-md-1 col-lg-5 well trbox" style="margin-top: 20px; margin-bottom: 20px">
            <div class="row" style="margin-bottom: 20px;">
                <div class="col-lg-10 bhoechie-tab-container d-flex">
                    <div class="col-lg-3 bhoechie-tab-menu">
                        <div class="list-group"> <a href="#" class="list-group-item active text-center">
                            <i class="fas fa-fighter-jet" style="font-size:24px"></i>
                            <br>
                            Flight </a>  <a href="#" class="list-group-item text-center">
                            <i class="fas fa-hotel" style="font-size:24px"></i>
                            <br>
                            Hotel </a> 
                        </div>
                    </div>
                    <div class="col-lg-9 bhoechie-tab" style="height: 305px">
                        <!-- flight section -->
                        <div class="bhoechie-tab-content active">
                            <form class="" action="search_flight.php" method="get">
                                <div class="form-group d-flex">
                                    <div class="col-lg-6">
                                        <label class="col-form-label">From</label>
                                    </div>
                                    <div class="col-lg-6">
                                        <label class="col-form-label">To</label>
                                    </div>
                                </div>
                                <div class="form-group d-flex">
                                    <div class="col-lg-6">
                                        <select name="depAirport" class="form-control shadow">
                                        <?php
						$sql = "SELECT DISTINCT DepAirport FROM flightschedule;";	// print the available dep airport
						$rs = mysqli_query($conn, $sql) or die(mysqli_error($conn));
						while($rc = mysqli_fetch_assoc($rs)) {
							extract($rc);
                        	echo '<option value="'.$DepAirport.'">'.$DepAirport.'</option>';
						}
						?>
                                    </select>
                                </div>
                    <div class="col-lg-6">
                      <select name="arrAirport" class="form-control shadow">
                      <?php
						$sql = "SELECT DISTINCT ArrAirport FROM flightschedule;";	// print the available dep airport
						$rs = mysqli_query($conn, $sql) or die(mysqli_error($conn));
						while($rc = mysqli_fetch_assoc($rs)) {
							extract($rc);
                        	echo '<option value="'.$ArrAirport.'">'.$ArrAirport.'</option>';
						}
						?>
                            </select>
                                </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-lg-12">
                                        <label class="col-form-label">Departing</label>
                                    </div>
                                    <div class="col-lg-12">
                                        <input type="date" name="depDate" class="form-control shadow" placeholder="City">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-lg-12">
                                        <button type="submit" class="btn btn-primary btn-lg btn-block shadow"
                                        style="background:#1688C0;">Search</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <!-- END flight section -->
                        <!-- hotel section -->
                        <div class="bhoechie-tab-content">
                            <form class="" action="search_hotel.php" method="get">
                                <div class="form-group d-flex">
                                    <div class="col-lg-4">
                                        <label class="col-form-label">Destination</label>
                                    </div>
                                    <div class="col-lg-8">
                                        <input type="text" class="form-control shadow" placeholder="Destination or hotel name">
                                    </div>
                                </div>
                                <div class="form-group d-flex">
                                    <div class="col-lg-4">
                                        <label class="col-form-label">Check in</label>
                                    </div>
                                    <div class="col-lg-8">
                                        <input type="date" name="Checkin" class="form-control shadow">
                                    </div>
                                </div>
                                <div class="form-group d-flex">
                                    <div class="col-lg-4">
                                        <label class="col-form-label">Check out</label>
                                    </div>
                                    <div class="col-lg-8">
                                        <input type="date" name="Checkout" class="form-control shadow">
                                    </div>
                                </div>
                                <div class="form-group d-flex">
                                    <div class="col-lg-2" style="text-align:left">
                                        <label class="col-form-label">Adults</label>
                                    </div>
                                    <div class="col-lg-4">
                                        <select name="hotelAdults" class="form-control shadow">
                                            <?php 
                                                for($i=1; $i <=10; $i++) 
                                                echo '<option value="'.$i.'">'.$i.'</option>';
                                            ?>;
                                        </select>
                                        </div>
                                        <div class="col-lg-2" style="text-align:left">
                                        <label class="col-form-label">Children</label>
                                        </div>
                                        <div class="col-lg-4">
                                        <select name="hotelChildren" class="form-control shadow">
                                            <?php
                                                for($i=1; $i <=10; $i++)
                                                echo '<option value="'.$i.'">'.$i.'</option>';
                                            ?>
                                </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-lg-12">
                                        <button type="submit" class="btn btn-primary btn-lg btn-block shadow"
                                        style="background:#1688C0;">Search</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="container-fluid col-10">
<div class="row" style="margin-top:20px; margin-bottom:20px">
    <div class="col-md-offset-1 well" style="background-color:rgba(255,255,255,0.8); width: 100%">
      <div class="row">
        <div class="col-md-5">
          <h2 style="margin: 20px 20px;">HOT Hotel</h2>
        </div>
      </div>
      <div class="col-md-12 well">
          <table class="table table-hover">
            <tr>
              <?php
                mysqli_set_charset($conn,"utf8");
				$sql = "SELECT * FROM hotel ORDER BY star DESC LIMIT 0, 3";
				$rs = mysqli_query($conn, $sql) or die(mysqli_error($conn));
				while($rc = mysqli_fetch_assoc($rs)) { ?>
            <tr>
              <th> <h3><button type="button" class="btn btn-lg btn-warning btn-sm" style="margin: 0 5px;" disabled><?php echo $rc['country']; ?></button><button type="button" class="btn btn-lg btn-warning btn-sm" disabled><?php echo $rc['city']; ?></button></h3>
                <a href="#">
                <h3><?php echo $rc['chiName']; ?>(<?php echo $rc['engName']; ?>)</h3>
                </a>
                <h4>
                  <?php
				switch($rc['star']) {
					case 3:
					echo '<img src="src/image/star1.png" width="32" height="32" alt=""/>';
					echo '<img src="src/image/star1.png" width="32" height="32" alt=""/>';
					echo '<img src="src/image/star1.png" width="32" height="32" alt=""/>';
					echo '<img src="src/image/star0.png" width="32" height="32" alt=""/>';
					echo '<img src="src/image/star0.png" width="32" height="32" alt=""/>';
					break;
					
					case 4:
					echo '<img src="src/image/star1.png" width="32" height="32" alt=""/>';
					echo '<img src="src/image/star1.png" width="32" height="32" alt=""/>';
					echo '<img src="src/image/star1.png" width="32" height="32" alt=""/>';
					echo '<img src="src/image/star1.png" width="32" height="32" alt=""/>';
					echo '<img src="src/image/star0.png" width="32" height="32" alt=""/>';
					break;
					
					case 5:
					echo '<img src="src/image/star1.png" width="32" height="32" alt=""/>';
					echo '<img src="src/image/star1.png" width="32" height="32" alt=""/>';
					echo '<img src="src/image/star1.png" width="32" height="32" alt=""/>';
					echo '<img src="src/image/star1.png" width="32" height="32" alt=""/>';
					echo '<img src="src/image/star1.png" width="32" height="32" alt=""/>';
					break;
				}
			?>
                </h4>
                <h4><?php echo $rc['district']; ?></h4>
                <h4 class="text-right"><?php echo $rc['address']; ?></h4>
                <h4 class="text-right">Tel: <?php echo $rc['hotel_tel']; ?></h4></th>
            </tr>
              </tr>
            
            <?php
				}
				?>
          </table>
        </div>
        <nav>
  <ul class="pager">
    <a type="button" href="search_hotel.php" class="btn btn-info">More</a>
  </ul>
    </nav>
</div>
</div>
  <!-- END row 2 --> 
</div>
<!-- END container -->
</div>


<?php require_once('customer_bonus_modal.php') ?>
<?php require_once('logout_modal.php') ?>

<script src="js/bootstrap/jquery-3.5.1.min.js"></script>
<script src="js/bootstrap/popper.min.js"></script>
<script src="js/bootstrap/bootstrap.min.js"></script>
<script src="js/fa/all.js"></script>
<script src="js/layout.js"></script>
</body>
</html>