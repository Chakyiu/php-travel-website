<!DOCTYPE html>
<?php
	session_start();
	if(!isset($_SESSION['user'])) {
		header('location:index.php');
	}
	
	require('conn.php');
	$sql = "SELECT * FROM hotelorder WHERE hotel_order_id = '{$_GET['hotelbooking']}';";
	$rs = mysqli_query($conn, $sql) or die(mysqli_error($conn));
    $rc = mysqli_fetch_assoc($rs);
	if($_SESSION['user'] == "customer" && $rc['user_id'] == $_SESSION['user_id']) {
		$id = $_SESSION['id'];
		$sql = "SELECT * FROM user WHERE user_account = '$id';";
		$rs = mysqli_query($conn, $sql) or die(mysqli_error($conn));
		$rc = mysqli_fetch_assoc($rs);
		mysqli_free_result($rs);
		mysqli_close($conn);
	} else {
		header('location:index.php');
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
  <div class="row card">
    <div class="col-md-12">
      <div class="col-md-12" style="border-bottom: 1px solid; margin-bottom: 20px;" >
        <h2 style="margin: 20px">Hotel Booking Details</h2>
      </div>
      <?php
				require('conn.php');
				mysqli_set_charset($conn,"utf8");
				$sql = "SELECT * FROM hotelorder LEFT JOIN room ON room.room_id = hotelorder.room_id LEFT JOIN hotel ON room.hotel_id = hotel.hotel_id WHERE hotel_order_id = '{$_GET['hotelbooking']}';";
				$rs = mysqli_query($conn, $sql) or die(mysqli_error($conn));
				$rc = mysqli_fetch_assoc($rs);
				extract($rc);
			?>
      <div class="col-md-12">
      <table class="table table-striped">
      	<tr>
        	<th><h4>Booking ID:</h4></th>
            <td><h4><?php echo $hotel_order_id ?></h4></td>
            <th><h4>Hotel ID:</h4></th>
            <td><h4><?php echo $hotel_id ?></h4></td>
        </tr>
         <tr>
            <th><h4>Chinese Name:</h4></th>
            <td><h4><?php echo $chiName ?></h4></td>
            <th><h4>English Name:</h4></th>
            <td><h4><?php echo $engName ?></h4></td>
        </tr>
        <tr>
            <th><h4>City:</h4></th>
            <td><h4><?php echo $city ?></h4></td>
            <th><h4>Country:</h4></th>
            <td><h4><?php echo $country ?></h4></td>
        </tr>
        <tr>
            <th><h4>District:</h4></th>
            <td><h4><?php echo $district ?></h4></td>
        </tr>
        </tr>
         <tr>
        	<th><h4>Star:</h4></th>
            <td><h4>
            <?php
				switch($star) {
					case 3.0:
					echo '<span class="glyphicon glyphicon-star star-color"></span>';
        			echo '<span class="glyphicon glyphicon-star star-color"></span>';
					echo '<span class="glyphicon glyphicon-star star-color"></span>';
					break;
					
					case 4.0:
					echo '<span class="glyphicon glyphicon-star star-color"></span>';
					echo '<span class="glyphicon glyphicon-star star-color"></span>';
					echo '<span class="glyphicon glyphicon-star star-color"></span>';
					echo '<span class="glyphicon glyphicon-star star-color"></span>';
					break;
					
					case 5.0:
					echo '<span class="glyphicon glyphicon-star star-color"></span>';
					echo '<span class="glyphicon glyphicon-star star-color"></span>';
					echo '<span class="glyphicon glyphicon-star star-color"></span>';
					echo '<span class="glyphicon glyphicon-star star-color"></span>';
					echo '<span class="glyphicon glyphicon-star star-color"></span>';
					break;
				}
			?>
        </tr>
         <tr>
        	<th><h4>Address:</h4></th>
            <td><h4><?php echo $address ?></h4></td>
            <th><h4>Tel:</h4></th>
            <td><h4><?php echo $hotel_tel ?></h4></td>
        </tr>
      </table>
      </div>
      <div class="col-md-12" style="border-bottom: 1px solid; margin-bottom: 20px;" >
        <h2>Price Details</h2>
      </div>
      <table  class="table table-striped" style="border-bottom: 1px solid;">
        <tr>
        <th><h4>Check-in Date</h4></th>
      	<td><h4><?php echo $Checkin ?></h4></td>
        </tr>
         <tr>
        <th><h4>Check-out Date</h4></th>
      	<td><h4><?php echo $Checkout ?></h4></td>
        </tr>
        <tr>
        <th><h4>Stay Nights</h4></th>
        <td><?php
			$sql="SELECT DATEDIFF('$Checkout','$Checkin') AS StayNights;";
			$rs = mysqli_query($conn, $sql) or die(mysqli_error($conn));
			$rc = mysqli_fetch_assoc($rs);
			echo "<h4>".$rc['StayNights']."</h4>";
		 ?></td>
        </tr>
        <tr>
        <th><h4>Prices</h4></th>
        <td><h4><?php echo '$'.$Price ?> / Night</h4></td>
        </tr>
      </table>
      <h4 class="text-right">Total Amount: <?php echo '$'.$real_price; ?></h4>
    </div>
    
    <!-- Previous bar -->
    <nav>
        <a style="margin: 20px;" class="btn btn-info" href="customer_booking.php?hotelbooking"><span aria-hidden="true">&larr;</span> Back</a>
    </nav>
    <!-- END Previous bar -->
    
  </div>
</div>
<!-- END container -->

<?php require_once('customer_bonus_modal.php') ?> <!-- the customer bonus modal -->

<?php require_once('logout_modal.php') ?> <!-- logout modal -->

<script src="js/bootstrap/jquery-3.5.1.min.js"></script>
<script src="js/bootstrap/popper.min.js"></script>
<script src="js/bootstrap/bootstrap.min.js"></script>
<script src="js/fa/all.js"></script>
</body>
</html>