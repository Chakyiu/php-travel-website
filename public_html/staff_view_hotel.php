<!DOCTYPE html>
<?php
	session_start();
	if(!isset($_SESSION['user'])) {
		header('location:login.php');
	}
	if($_SESSION['user'] != "staff") {
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

<div class="container-fluid mt-4">
  <div class="row" style="justify-content: center;">
    <div class="col-md-offset-1 col-md-2 well shadow trbox" style="margin-right:20px"> 
      <!-- search form -->
      <form action="" method="get">
        <div class="form-group">
          <label style="margin: 10px">Hotel</label>
          <select name="chiName" class="form-control shadow">
            <?php
                require('conn.php');
                mysqli_set_charset($conn,"utf8");
                $sql = "SELECT * FROM hotel";
                $rs = mysqli_query($conn, $sql) or die(mysqli_error($conn));
                while($rc = mysqli_fetch_assoc($rs)) {
                    if(isset($_GET['chiName'])) {
                        if($rc['chiName'] == $_GET['chiName']){
                            echo '<option value="'.$rc['chiName'].'" selected>'.$rc['chiName'].'</option>';
                            continue;
                        }
                    }
                    echo '<option value="'.$rc['chiName'].'">'.$rc['chiName'].'</option>';
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
      <h1 style="margin: 20px;"><?php if(isset($_GET['chiName']))
		  					echo $_GET['chiName'];
						else
							echo "View Hotel" ?></h1>
      <div class="col-md-12 well shadow card" style="margin-bottom: 20px;">
      <?php
	  	if(!isset($_GET['chiName'])) {
				// die();
            } else {
                require('conn.php');
                mysqli_set_charset($conn,"utf8");
                $sql = "SELECT * FROM room INNER JOIN hotel ON room.hotel_id = hotel.hotel_id WHERE hotel.chiName = '{$_GET['chiName']}';";
                $rs = mysqli_query($conn, $sql) or die(mysqli_error($conn));
                $rc = mysqli_fetch_assoc($rs); ?>

                <h3>Chinese Name: <?php echo $rc['chiName'] ?></h3>
                <h3>English Name: <?php echo $rc['engName'] ?></h3>
                <h3>Address: <?php echo $rc['address'] ?></h3>
                <h3>Tel: <?php echo $rc['hotel_tel'] ?></h3>
                <label><h3>Rooms</h3></label>
                <div class="table-responsive">
                    <table class="table table-bordered">
				<tr><th>Room Type</th><th>Price</th><th>Room size</th><th>Room Desciption</th><th>Number of rooms available</th></tr>
                <?php
					while($rc = mysqli_fetch_assoc($rs)) {
				?>
                <tr>
                	<td><?php echo $rc['room_type']; ?></td>
                    <td><?php echo $rc['Price']; ?></td>
                    <td><?php echo $rc['RoomSize']; ?></td>
                    <td><?php echo $rc['RoomDesc']; ?></td>
                    <td><?php echo $rc['room_num']; ?></td>
                    <td></td>
                </tr>
                <?php
					}
				}?>
  			</table>
		</div>
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