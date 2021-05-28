<!DOCTYPE html>
<?php
	session_start();
	if(isset($_SESSION['user'])) {
		if($_SESSION['user'] == "customer") {
			$id = $_SESSION['id'];
			require('conn.php');
			$sql = "SELECT * FROM user WHERE user_account = '$id';";
			$rs = mysqli_query($conn, $sql) or die(mysqli_error($conn));
			$rc = mysqli_fetch_assoc($rs);
			mysqli_free_result($rs);
			mysqli_close($conn);
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
    <div class="col-md-offset-1 col-md-3 well trbox" style="height: 100%; padding: 20px">
      <form class="form-horizontal" method="get" action="">
                  <div class="form-group">
                    <div class="col-md-4">
                      <label class="control-label">Destination</label>
                    </div>
                    <div class="col-md-8">
                      <input type="text" name="hotel_name" class="form-control shadow" placeholder="Destination or hotel name">
                    </div>
                  </div>
                  <div class="form-group">
                    <div class="col-md-12">
                      <button type="submit" class="btn btn-primary btn-lg btn-block shadow" style="background:#1688C0;">Search</button>
                    </div>
                  </div>
                </form>
    </div>
    <!-- END form block --> 
    
    <!-- search content -->
    <div class="col-md-7 well trbox" style="margin-left:20px;">
      <div class="row">
        <div class="col-md-12 mt-5">
          <h1>Hotel</h1>
        </div>
        <?php
          require('conn.php');
          if (empty($_GET['hotel_name'])) {
            $sql = "SELECT COUNT(*) FROM hotel";
          } else {
              $hotel_name = $_GET['hotel_name'];
              $sql = "SELECT COUNT(*) FROM hotel WHERE (hotel.engName LIKE '%$hotel_name%');";
          }
		$rs = mysqli_query($conn, $sql) or die(mysqli_error($conn));
		$rc = mysqli_fetch_row($rs);
		$numrows = $rc[0];
		
		$rowsperpage = 4;
		
		$totalpages = ceil($numrows / $rowsperpage);
		if(isset($_GET['page']) && is_numeric($_GET['page'])) {
			$page = (int) $_GET['page'];
		}else{
			$page = 1;
		} // end if
		
		if($page > $totalpages) {
			$page = 1;
		} // end if
		if($page < 1) {
			$page = 1;
		} // end if
		
		$offset = ($page - 1) * $rowsperpage;
		?>
        <div class="col-md-12 well">
          <table class="table">
            <tr class="card" style="margin: 20px">
              <?php
                mysqli_set_charset($conn,"utf8");
                if (empty($_GET['hotel_name'])) {
                    $sql = "SELECT * FROM hotel LIMIT $offset, $rowsperpage";
                  } else {
                      $hotel_name = $_GET['hotel_name'];
                      //$sql = "SELECT COUNT(*) FROM hotel WHERE (hotel.engName LIKE '%$hotel_name%');";
                      $sql = "SELECT * FROM hotel WHERE (hotel.engName LIKE '%$hotel_name%') LIMIT $offset, $rowsperpage";
                  }
				$rs = mysqli_query($conn, $sql) or die(mysqli_error($conn));
				while($rc = mysqli_fetch_assoc($rs)) { ?>
            <tr class="card">
              <th> <h3><span class="label label-warning"><?php echo $rc['country']; ?></span> <span class="label label-warning"><?php echo $rc['city']; ?></span></h3>
                <a href="#">
                <h3><?php echo $rc['chiName']; ?>(<?php echo $rc['engName']; ?>)</h3>
                </a>
                <h4>
                  <?php
				switch($rc['star']) {
					case 3:
					echo '<img src="image/star1.png" width="32" height="32" alt=""/>';
					echo '<img src="image/star1.png" width="32" height="32" alt=""/>';
					echo '<img src="image/star1.png" width="32" height="32" alt=""/>';
					echo '<img src="image/star0.png" width="32" height="32" alt=""/>';
					echo '<img src="image/star0.png" width="32" height="32" alt=""/>';
					break;
					
					case 4:
					echo '<img src="image/star1.png" width="32" height="32" alt=""/>';
					echo '<img src="image/star1.png" width="32" height="32" alt=""/>';
					echo '<img src="image/star1.png" width="32" height="32" alt=""/>';
					echo '<img src="image/star1.png" width="32" height="32" alt=""/>';
					echo '<img src="image/star0.png" width="32" height="32" alt=""/>';
					break;
					
					case 5:
					echo '<img src="image/star1.png" width="32" height="32" alt=""/>';
					echo '<img src="image/star1.png" width="32" height="32" alt=""/>';
					echo '<img src="image/star1.png" width="32" height="32" alt=""/>';
					echo '<img src="image/star1.png" width="32" height="32" alt=""/>';
					echo '<img src="image/star1.png" width="32" height="32" alt=""/>';
					break;
				}
			?>
                </h4>
                <h4><?php echo $rc['district']; ?></h4>
                <h4 class="text-right"><?php echo $rc['address']; ?></h4>
                <h4 class="text-right">Tel: <?php echo $rc['hotel_tel']; ?></h4>
                <table class="table table-striped">
                <tr><th>Room Type</th><th>Room Size</th><th>Description</th><th>Available Room</th><th>Price</th><th>Check in</th><th>Check Out</th><th></th></tr>
                <?php
					$sql = "SELECT * FROM hotel INNER JOIN room ON hotel.hotel_id = room.hotel_id WHERE hotel.hotel_id = '".$rc['hotel_id']."'; ";
					$rsRoom = mysqli_query($conn, $sql) or die(mysqli_error($conn));
					while($rcRoom = mysqli_fetch_assoc($rsRoom)) {
						?>
                        <tr>
                        	<td><?php echo $rcRoom['room_type']; ?></td>
                        	<td><?php echo $rcRoom['RoomSize']; ?></td>
                        	<td><?php echo $rcRoom['RoomDesc']; ?></td>
                            <td>Available Room</td>
                            <td><?php echo '$'.$rcRoom['Price'].' / Night'; ?></td>
                            <form action="staff_shoppingcart.php" method="post">
                                <input type="hidden" name="room_id" value="<?php echo $rcRoom['room_id']; ?>">
                                <input type="hidden" name="EngName" value="<?php echo $rcRoom['engName']; ?>">
                                <input type="hidden" name="Country" value="<?php echo $rcRoom['country']; ?>">
                                <input type="hidden" name="City" value="<?php echo $rcRoom['city']; ?>">
                                <input type="hidden" name="Price" value="<?php echo $rcRoom['Price']; ?>">
                                <input type="hidden" name="RoomType" value="<?php echo $rcRoom['room_type']; ?>">
                                <td><input type="date" class="form-control" name="Checkin" required></td>
                                <td><input type="date" class="form-control" name="Checkout" required></td>
                                <td><button type="submit" class="btn btn-primary">Buy</button></td>
                            </form>
                        </tr>
                        <?php
					}
					?>
				</table>
			</th>
            </tr>
              </tr>
            
            <?php
				}
				?>
          </table>
        </div>
      </div>
      <nav aria-label="Page navigation example">
        <ul class="pagination" style="justify-content: center;">
          <li <?php if($page==1) echo 'class="page-item disabled"'; ?>> <a class="page-link" <?php if($page != 1) echo 'href="search_hotel.php?page='.($page - 1).'"'; ?> aria-label="Previous"> <span aria-hidden="true">&laquo;</span> </a> </li>
          <?php
		for($i=1;$i <= $totalpages; $i++) {
			if($i == $page) {
				echo "<li class=\"page-item active\"><a class=\"page-link\" href=\"search_hotel.php?page=$i\">$i</a></li>";
				continue;
			}
			else {
    			echo "<li><a class=\"page-link\" href=\"search_hotel.php?page=$i\">$i</a></li>";
			}
		}
		?>
          <li <?php if($page==$totalpages) echo 'class="page-item disabled"'; ?>> <a class="page-link" <?php if($page != $totalpages) echo 'href="search_hotel.php?page='.($page + 1).'"'; ?> aria-label="Next"> <span aria-hidden="true">&raquo;</span> </a> </li>
        </ul>
      </nav>
    </div>
    <!-- END search content --> 
  </div>
</div>
<!-- END container-fluid -->

<?php
	mysqli_free_result($rs);
	mysqli_close($conn);
?>

<?php require_once('customer_bonus_modal.php') ?> <!-- the customer bonus modal -->

<?php require_once('logout_modal.php') ?> <!-- logout modal -->

<script src="js/bootstrap/jquery-3.5.1.min.js"></script>
<script src="js/bootstrap/popper.min.js"></script>
<script src="js/bootstrap/bootstrap.min.js"></script>
<script src="js/fa/all.js"></script>
</body>
</html>