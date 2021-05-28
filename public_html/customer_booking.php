<!DOCTYPE html>
<?php
	session_start();
	if(!isset($_SESSION['user'])) {
		header('location:index.php');
	}
	
	if($_SESSION['user'] == "customer") {
		$id = $_SESSION['id'];
		require('conn.php');
		$sql = "SELECT * FROM user WHERE user_account = '$id';";
		$rs = mysqli_query($conn, $sql) or die(mysqli_error($conn));
		$rc_user = mysqli_fetch_assoc($rs);
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

<div class="container mt-4">
  <div class="row well trbox shadow">
    <div class="col-md-12" style="margin: 20px 0;"> <img src="src/image/mybooking.jpg" alt="My Booking"/> </div>
    <ul class="nav nav-tabs">
      <li <?php if(!isset($_GET['hotelbooking'])) echo 'class="nav-item active"'; ?> style="margin-left: 20px"><a data-toggle="tab" href="#flightBooking" class="nav-link">Flight Booking</a></li>
      <li <?php if(isset($_GET['hotelbooking'])) echo 'class="nav-item active"'; ?>><a data-toggle="tab" href="#hotelBooking" class="nav-link">Hotel Booking</a></li>
    </ul>
    <div class="tab-content" style="width: 100%"> 
      <!-- Flight Booking panel -->
      <div id="flightBooking" class="tab-pane fade <?php if(!isset($_GET['hotelbooking'])) echo 'in active'; ?>">
        <div class="col-md-12">
          <h2 style="margin: 20px">Flight Booking</h2>
          <table class="table table-striped">
            <thead>
              <tr>
                <th>Booking ID</th>
                <th>Order Date</th>
                <th>Flight No.</th>
                <th>Class</th>
                <th>Departure Date</th>
                <th>Adults</th>
                <th>Children</th>
                <th>Infant</th>
                <th>Total Amount</th>
                <th>Details</th>
              </tr>
            </thead>
            <tbody>
             	<?php
					$sql = "SELECT * FROM flightorder WHERE user_id = '{$rc_user['user_id']}'";
					$rs = mysqli_query($conn, $sql) or die(mysqli_error($conn));
					while($rc = mysqli_fetch_assoc($rs)) {
						extract($rc);
						?>
                        <tr>
                        <td><?php echo $flight_order_id; ?></td>
                        <td><?php echo $OrderDate; ?></td>
                        <td><?php echo $flight_no; ?></td>
                        <td><?php echo $flightclass_type; ?></td>
                        <td><?php echo $DepDateTime; ?></td>
                        <td><?php echo $AdultNum; ?></td>
                        <td><?php echo $ChildNum; ?></td>
                        <td><?php echo $InfantNum; ?></td>
                        <td><?php echo $real_price; ?></td>
                        <td><a class="btn btn-info" href="customer_booking_flight_details.php?flightbooking=<?php echo $flight_order_id; ?>" role="button">Details</a></td>

                        </tr>
				<?php
                	}
				?>
            </tbody>
          </table>
        </div>
      </div>
      <!-- END Flight Booking panel --> 
      
      <!-- Hotel Booking panel -->
      <div id="hotelBooking" class="tab-pane fade <?php if(isset($_GET['hotelbooking'])) echo 'in active'; ?>">
        <div class="col-md-12">
          <h2 style="margin: 20px">Hotel Booking</h2>
          <table class="table table-striped">
            <thead>
              <tr>
                <th>Booking ID</th>
                <th>Order Date</th>
                <th>Hotel ID</th>
                <th>Room Type</th>
                <th>Room Size</th>
                <th>Check-in Date</th>
                <th>Check-out Date</th>
                <th>Total Amount</th>
                <th>Remark</th>
                <th></th>
              </tr>
            </thead>
            <tbody>
            	<?php
                    mysqli_set_charset($conn,"utf8");
                    $sql = "SELECT * FROM hotelorder, room, hotel WHERE hotelorder.user_id = '{$rc_user['user_id']}' && hotelorder.room_id = room.room_id && room.hotel_id = hotel.hotel_id";
					$rs = mysqli_query($conn, $sql) or die(mysqli_error($conn));
					while($rc = mysqli_fetch_assoc($rs)) {
						?>
              <tr>
                <td><?php echo $rc['hotel_order_id']; ?></td>
                <td><?php echo $rc['OrderDate']; ?></td>
                <td><?php echo $rc['hotel_id']; ?></td>
                <td><?php echo $rc['room_type']; ?></td>
                <td><?php echo $rc['RoomSize']; ?></td>
                <td><?php echo $rc['Checkin']; ?></td>
                <td><?php echo $rc['Checkout']; ?></td>
                <td><?php echo $rc['real_price']; ?></td>
                <td><?php echo $rc['Remark']; ?></td>
                <td><a class="btn btn-info" href="customer_booking_hotel_details.php?hotelbooking=<?php echo $rc['hotel_order_id']; ?>" role="button">Details</a></td>
              </tr>
              <?php
					}
					?>
            </tbody>
          </table>
        </div>
      </div>
      <!-- END Hotel Booking panel --> 
    </div> <!-- END tab content -->
  </div>
</div> <!-- END container -->

<?php require_once('customer_bonus_modal.php') ?> <!-- the customer bonus modal -->

<?php require_once('logout_modal.php') ?> <!-- logout modal -->

<script src="js/bootstrap/jquery-3.5.1.min.js"></script>
<script src="js/bootstrap/popper.min.js"></script>
<script src="js/bootstrap/bootstrap.min.js"></script>
<script src="js/fa/all.js"></script>
</body>
</html>