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

<!-- container -->
<div class="container-fluid mt-5">
  <div class="row col-12" style="justify-content: center;">
    <div class="well col-md-8 col-md-offset-1 shadow trbox" style="margin-right:20px">
    <h2>Customer Record</h2>
      <table class="table table-striped">
        <thead>
          <tr>
            <th>Action</th>
            <th>ID</th>
            <th>Account</th>
            <th>Last name</th>
            <th>First Name</th>
            <th>Passport Number</th>
            <th>Booking</th>
          </tr>
        </thead>
        <tbody>
		<?php
			require('conn.php');
			$sql = "SELECT * FROM user;";
			$rs = mysqli_query($conn, $sql) or die(mysqli_error($conn));
			while($rc = mysqli_fetch_assoc($rs)) {
				?>
          <tr>
            <td><a class="btn btn-warning" href="staff_edit_customer.php?id=<?php echo $rc['user_id'] ?>" role="button">Update</a>
              <a class="btn btn-danger" href="staff_edit_customer_delete.php?id=<?php echo $rc['user_id'] ?>" role="button">Delete</a></td>
            <td><?php echo $rc['user_id'] ?></td>
            <td><?php echo $rc['user_account'] ?></td>
            <td><?php echo $rc['lastname'] ?></td>
            <td><?php echo $rc['firstname'] ?></td>
            <td><?php echo $rc['passport_no'] ?></td>
            <td><a class="btn btn-info" href="staff_edit_booking.php?id=<?php echo $rc['user_id'] ?>" role="button">Booking</a></td>
          </tr>
		  <?php
			}
			?>
        </tbody>
      </table>
    </div>
        <div class="well col-md-2 shadow trbox">
        <?php
			if(isset($_GET['id'])) {
				$sql = 'SELECT * FROM user WHERE user_id = "'.$_GET['id'].'";';
				$rs = mysqli_query($conn, $sql) or die(mysqli_error($conn));
				$rc = mysqli_fetch_assoc($rs);
			}
		?>
      <form method="post" action="staff_edit_customer_update.php" arole="form">
        <div class="form-group">
          <label>ID</label>
          <input type="text" class="form-control" name="user_id" readonly value="<?php if(isset($rc['user_id'])) echo $rc['user_id'] ?>">
        </div>
        <div class="form-group">
          <label>Last name</label>
          <input type="text" class="form-control" name="lastname" value="<?php if(isset($rc['user_id'])) echo $rc['lastname'] ?>">
        </div>
        <div class="form-group">
          <label>First name</label>
          <input type="text" class="form-control" name="firstname" value="<?php if(isset($rc['user_id'])) echo $rc['firstname'] ?>">
        </div>
        <div class="form-group">
          <label>Passport number</label>
          <input type="text" class="form-control" name="passport" value="<?php if(isset($rc['user_id'])) echo $rc['passport_no'] ?>">
        </div>
        <button type="submit" class="btn btn-warning">Update</button>
        <button type="reset" class="btn btn-danger">Clear</button>
      </form>
    </div>
  </div>
</div>
<!-- END container -->

<?php require_once('logout_modal.php') ?> <!-- logout modal -->

<script src="js/bootstrap/jquery-3.5.1.min.js"></script>
<script src="js/bootstrap/popper.min.js"></script>
<script src="js/bootstrap/bootstrap.min.js"></script>
<script src="js/fa/all.js"></script>
</body>
</html>