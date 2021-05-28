<!DOCTYPE html>
<?php
	session_start();
	if(!isset($_SESSION['user'])) {
		header('location:login.php');
	}
	if($_SESSION['user'] != "customer") {
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
  <div class="row well trbox shadow">
    <h2 class="well" style="margin: 20px">Shopping Cart</h2>
    <?php if(isset($_SESSION['cart'])) {
        $airline_count = 0;
        $hotel_count = 0;

        foreach($_SESSION['cart'] as $order) {
			if(isset($order['AirlineCode'])) {
                $airline_count++; //check type of order if
		?>
    <div class="col-md-12 well">
      <table class="table table-hover">
        <thead>
          <tr>
            <th><h3>Airline <small><?php echo $order['AirlineCode']; ?></small></h3></th>
            <th><h3>Flight No. <small><?php echo $order['FlightNo']; ?></small></h3></th>
            <th><h3>Class <small><?php echo $order['Class']; ?></small></h3></th>
            <th></th>
            <th></th>
          </tr>
          <tr>
            <th>Go To</th>
            <th>Departure Date Time</th>
            <th></th>
            <th></th>
            <th></th>
              </th>
          </tr>
        <thead>
        <tbody>
          <tr>
            <td><h4><?php echo $order['DepAirport']; ?> <span class="glyphicon glyphicon-arrow-right"></span> <?php echo $order['ArrAirport']; ?></h4></td>
            <td><h4><?php echo $order['DepDateTime']; ?></h4></td>
            <td></td>
            <td></td>
            <td></td>
          </tr>
        </tbody>
        <tr>
          <th>#</th>
          <th>Adult</th>
          <th>Child</th>
          <th>Infant</th>
          <th>Tax</th>
        </tr>
          </thead>
        
        <tr>
          <th>Num</th>
          <td><?php echo $order['AdultNum']; ?></td>
          <td><?php echo $order['ChildNum']; ?></td>
          <td><?php echo $order['InfantNum']; ?></td>
          <td>---</td>
        </tr>
        <tr>
          <th>Amount</th>
          <td><?php echo $order['AdultAmount']; ?></td>
          <td><?php echo $order['ChildAmount']; ?></td>
          <td><?php echo $order['InfantAmount']; ?></td>
          <td><?php echo $order['Tax']; ?></td>
        </tr>
        <tr>
          <td></td>
          <td></td>
          <td></td>
          <td></td>
          <td>Amount: <?php echo $order['TotalAmount']; ?></td>
        </tr>
      </table>
    </div>
    <?php
			} else if (isset($order['EngName'])) {
                $hotel_count++; ?>
				<div class="col-md-12 well">
      <table class="table table-hover">
        <thead>
          <tr>
            <th><h3>Hotel <small><?php echo $order['EngName']; ?></small></h3></th>
            <th><h3>Country <small><?php echo $order['Country']; ?></small></h3></th>
            <th><h3>City <small><?php echo $order['City']; ?></small></h3></th>
            <th></th>
          </tr>
          <tr>
            <th>Room Type</th>
            <th>Check in</th>
            <th>Check out</th>
            <th>Stay Days</th>
              </th>
          </tr>
        <thead>
        <tbody>
          <tr>
            <td><?php echo $order['RoomType']; ?></td>
            <td><?php echo $order['Checkin']; ?></td>
            <td><?php echo $order['Checkout']; ?></td>
            <td><?php echo $order['StayDats']; ?></td>
          </tr>
        </tbody>
        <tr>
          <td></td>
          <td></td>
          <td></td>
          <td>Amount: <?php echo $order['TotalAmount']; ?></td>
        </tr>
      </table>
    </div>
		<?php	} //check type of order if END
        }
        echo '<div style="text-align: right;">';
        if ($airline_count > 0) {
            echo '<a class="btn btn-primary" href="checkout_airline.php" role="button" style="margin: 20px">Checkout Airline</a> ';
        }
        if ($hotel_count > 0) {
            echo '<a class="btn btn-info" href="checkout_hotel.php" role="button" style="margin: 20px">Checkout Hotel</a> ';
        }
        
        echo '</div>';
	}
		?>
  </div>
  <!-- END tab content --> 
</div>
<!-- END container -->

<?php require_once('logout_modal.php') ?>
<!-- logout modal -->

<script src="js/bootstrap/jquery-3.5.1.min.js"></script>
<script src="js/bootstrap/popper.min.js"></script>
<script src="js/bootstrap/bootstrap.min.js"></script>
<script src="js/fa/all.js"></script>
</body>
</html>