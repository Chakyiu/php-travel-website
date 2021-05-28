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
        <a class="nav-link" href="index.php"><i class="fas fa-home" style="font-size:16px"></i>Home <span class="sr-only">(current)</span></a>
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

<div class="container-fluid mt-4">
  <div class="row" style="justify-content: center;">
    <div class="col-md-offset-1 col-md-2 well shadow trbox" style="margin-right:20px"> 
      <!-- search form -->
      <form action="" method="get">
        <div class="form-group">
          <label style="margin: 10px;">Airline</label>
          <select name="airlineName" class="form-control shadow">
            <?php
                require('conn.php');
                mysqli_set_charset($conn,"utf8");
                $sql = "SELECT * FROM airline";
                $rs = mysqli_query($conn, $sql) or die(mysqli_error($conn));
                while($rc = mysqli_fetch_assoc($rs)) {
                    if(isset($_GET['airlineName'])) {
                        if($rc['airlineName'] == $_GET['airlineName']){
                            echo '<option value="'.$rc['airlineName'].'" selected>'.$rc['airlineName'].'</option>';
                            continue;
                        }
                    }
                    echo '<option value="'.$rc['airlineName'].'">'.$rc['airlineName'].'</option>';
                }
                mysqli_free_result($rs);
                mysqli_close($conn);
            ?>
          </select>
        </div>
        <div class="form-group">
        	<button type="submit" class="btn btn-primary btn-block shadow"><strong>Display</strong></button>
        </div>
      </form>
    </div>
    <!-- END search form -->
    <div class="col-md-8 well shadow trbox">
      <h1 style="margin: 20px;"><?php if(isset($_GET['airlineName']))
		  					echo $_GET['airlineName'];
						else
							echo "View Airline" ?></h1>
      <div class="col-md-12 well shadow">
      <table class="table table-striped">
        <thead>
          <tr>
            <th>Flight No.</th>
            <th>Flight Schedule</th>
            <th>Flight Class</th>
            <th>Price</th>
            <th>Tax</th>
          </tr>
        </thead>
        <tbody>
        <?php
			if(!isset($_GET['airlineName'])) {
			} else {
                require('conn.php');
                mysqli_set_charset($conn,"utf8");
                $sql = "SELECT * FROM flightschedule INNER JOIN flightclass ON flightclass.flight_no = flightschedule.flight_no INNER JOIN airline ON airline.AirlineCode = flightclass.AirlineCode WHERE airline.airlineName = '{$_GET['airlineName']}';";
                $rs = mysqli_query($conn, $sql) or die(mysqli_error($conn));
                if(mysqli_num_rows($rs) > 0) {
                    while($rc = mysqli_fetch_assoc($rs)) {
                    ?>
                  <tr>
                    <td><?php echo $rc['flight_no']; ?></td>
                    <td>FROM: <?php echo $rc['DepAirport']; ?> <?php echo $rc['DepDateTime']; ?><br>TO: <?php echo $rc['ArrAirport']; ?> <?php echo $rc['ArrDateTime']; ?></td>
                    <td><?php echo $rc['flightclass_type']; ?></td>
                    <td>Adult: $<?php echo $rc['Price_Adult']; ?><br>Child: $<?php echo $rc['Price_Children']; ?><br>Infant: $<?php echo $rc['Price_Infant']; ?></td>
                    <td><?php echo $rc['Tax']; ?></td>
                  </tr>
                  <?php
                    }
                    mysqli_free_result($rs);
                    mysqli_close($conn);
                } else {
                    echo '<tr><td><h3>Result Not Found</h3></td><td></td><td></td><td></td><td></td></tr>';
                }
            }
		  ?>
        </tbody>
      </table>
      </div>
    </div>
  </div>
</div>

<?php require_once('logout_modal.php') ?> <!-- logout modal -->

<script src="js/bootstrap/jquery-3.5.1.min.js"></script>
<script src="js/bootstrap/popper.min.js"></script>
<script src="js/bootstrap/bootstrap.min.js"></script>
<script src="js/fa/all.js"></script>
</body>
</html>