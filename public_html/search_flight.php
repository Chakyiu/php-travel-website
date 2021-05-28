<!DOCTYPE html>
<?php
	session_start();
	require('conn.php');
	if(isset($_SESSION['user'])) {
		if($_SESSION['user'] == "customer") {
			$id = $_SESSION['id'];
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
    <div class="col-md-3 well trbox" style="height: 100%; padding: 20px;">
      <form class="form-horizontal" action="search_flight.php" method="get">
        <div class="form-group d-flex">
          <div class="col-md-6">
            <label class="control-label">From</label>
          </div>
          <div class="col-md-6">
            <label class="control-label">To</label>
          </div>
        </div>
        <div class="form-group d-flex">
          <div class="col-md-6">
            <select name="depAirport" class="form-control shadow">
         	     <?php
				 		require('conn.php');
						$sql = "SELECT DISTINCT DepAirport FROM flightschedule;";	// print the available dep airport
						$rs = mysqli_query($conn, $sql) or die(mysqli_error($conn));
						while($rc = mysqli_fetch_assoc($rs)) {
							extract($rc);
                        	echo '<option value="'.$DepAirport.'">'.$DepAirport.'</option>';
						}
						?>
            </select>
          </div>
          <div class="col-md-6">
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
          <div class="col-md-12">
            <label class="control-label">Departing</label>
          </div>
          <div class="col-md-12">
            <input type="date" name="depDate" class="form-control shadow" placeholder="City">
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
          <h1>Flight</h1>
        </div>
      </div>
      <?php
        if (isset($_GET['depDate'])){
            $depDate = $_GET['depDate'];
        }
	  	if(isset($_GET['depAirport'])) {
			extract($_GET);
			$sql = "SELECT COUNT(*) FROM flightschedule WHERE DepAirport = '$depAirport' AND ArrAirport = '$arrAirport' AND DepDateTime >= '$depDate';";
			$rs = mysqli_query($conn, $sql) or die(mysqli_error($conn));
			$rc = mysqli_fetch_row($rs);
		} else {
	  	
		$sql = "SELECT COUNT(*) FROM flightschedule";
		$rs = mysqli_query($conn, $sql) or die(mysqli_error($conn));
		$rc = mysqli_fetch_row($rs);
		
		}
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
		
		mysqli_set_charset($conn,"utf8");
		if(isset($_GET['depAirport'])) {
			$sql = "SELECT * FROM flightschedule INNER JOIN flightclass ON flightschedule.flight_no = flightclass.flight_no INNER JOIN airline ON flightclass.AirlineCode = airline.AirlineCode WHERE DepAirport = '$depAirport' AND ArrAirport = '$arrAirport' AND DepDateTime >= '$depDate' ORDER BY DepDateTime DESC LIMIT $offset, $rowsperpage;";
		} else {
		    $sql = "SELECT * FROM flightschedule INNER JOIN flightclass ON flightschedule.flight_no = flightclass.flight_no INNER JOIN airline ON flightclass.AirlineCode = airline.AirlineCode LIMIT $offset, $rowsperpage";
		}
		$rs = mysqli_query($conn, $sql) or die(mysqli_error($conn));
		while($rc = mysqli_fetch_assoc($rs)) { //big loop for each flight schedule
		?>
      <div class="card" style="margin: 20px 0;">
        <table class="table table-hover">
          <thead>
            <tr>
              <th><h3 style="white-space: nowrap;">Airline <small><?php echo $rc['airlineName']; ?></small></h3></th>
              <th><h3>Flight No. <small><?php echo $rc['flight_no']; ?></small></h3></th>
              <th><h3>Class <small><?php echo $rc['flightclass_type']; ?></small></h3></th>
            </tr>
            <tr>
              <th>Go To</th>
              <th>Departure Date Time</th>
              <th>Arrive Date Time</th>
              <th>Departure Airport</th>
              <th>Arrive Airport</th>
                </th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td><h4><?php echo $rc['DepAirport']; ?> <span class="glyphicon glyphicon-arrow-right"></span> <?php echo $rc['ArrAirport']; ?></h4></td>
              <td><h4><?php echo $rc['DepDateTime']; ?></h4></td>
              <td><h4><?php echo $rc['ArrDateTime']; ?></h4></td>
              <td><h4><?php echo $rc['DepAirport']; ?></h4></td>
              <td><h4><?php echo $rc['ArrAirport']; ?></h4></td>
            </tr>
          <thead>
            <tr>
              <th>#</th>
              <th>Adult</th>
              <th>Child</th>
              <th>Infant</th>
              <th>Tax</th>
            </tr>
          </thead>
          <tr>
            <th>Price</th>
            <td><?php echo '$'.$rc['Price_Adult']; ?></td>
            <td><?php echo '$'.$rc['Price_Children']; ?></td>
            <td><?php echo '$'.$rc['Price_Infant']; ?></td>
            <td><?php echo '$'.$rc['Tax']; ?></td>
          </tr>
          <?php
            if(isset($_SESSION['user']) && $_SESSION['user'] == "customer") {
                ?>
          <form action="staff_shoppingcart.php" method="post">
          <tr>
          <input type="hidden" name="AirlineCode" value="<?php echo $rc['AirlineCode']; ?>">
          <input type="hidden" name="FlightNo" value="<?php echo $rc['flight_no']; ?>">
          <input type="hidden" name="Class" value="<?php echo $rc['flightclass_type']; ?>">
          <input type="hidden" name="DepDateTime" value="<?php echo $rc['DepDateTime']; ?>">
          <input type="hidden" name="DepAirport" value="<?php echo $rc['DepAirport']; ?>">
          <input type="hidden" name="ArrAirport" value="<?php echo $rc['ArrAirport']; ?>">
          <input type="hidden" name="Price_Adult" value="<?php echo $rc['Price_Adult']; ?>">
          <input type="hidden" name="Price_Children" value="<?php echo $rc['Price_Children']; ?>">
          <input type="hidden" name="Price_Infant" value="<?php echo $rc['Price_Infant']; ?>">
          <input type="hidden" name="Tax" value="<?php echo $rc['Tax']; ?>">
          	<td></td>
            <td><select name="AdultNum" class="form-control">
				<option value="1">1</option>
				<option value="2">2</option>
				<option value="3">3</option>
				<option value="4">4</option>
				<option value="5">5</option>
			</select></td>
            <td><select name="ChildNum" class="form-control">
            	<option value="0">0</option>
				<option value="1">1</option>
				<option value="2">2</option>
				<option value="3">3</option>
				<option value="4">4</option>
				<option value="5">5</option>
			</select></td>
            <td><select name="InfantNum" class="form-control">
            	<option value="0">0</option>
				<option value="1">1</option>
				<option value="2">2</option>
				<option value="3">3</option>
				<option value="4">4</option>
				<option value="5">5</option>
			</select></td>
            <td><button type="submit" class="btn btn-primary">Buy</button></td>
          </tr>
          </form>
          <?php
            }
            ?>
            </tbody>
        </table>
      </div>
      <?php
		} // close the loop for output flight schedule
		
		
		// set page section
		if(!isset($_GET['depAirport'])) { // if no $_GET
			?>
      <nav aria-label="Page navigation example">
        <ul class="pagination" style="justify-content: center;">
          <li <?php if($page==1) echo 'class="page-item disabled"'; ?>> <a class="page-link" <?php if($page != 1) echo 'href="search_flight.php?page='.($page - 1).'"'; ?> aria-label="Previous"> <span aria-hidden="true">&laquo;</span> </a> </li>
          <?php
		for($i=1;$i <= $totalpages; $i++) {
			if($i == $page) {
				echo "<li class=\"page-item active\"><a class=\"page-link\" href=\"search_flight.php?page=$i\">$i</a></li>";
				continue;
			}
			else {
    			echo "<li class=\"page-item\"><a class=\"page-link\" href=\"search_flight.php?page=$i\">$i</a></li>";
			}
		} // end for loop page set
		?>
          <li <?php if($page==$totalpages) echo 'class="page-item disabled"'; ?>> <a class="page-link" <?php if($page != $totalpages) echo 'href="search_flight.php?page='.($page + 1).'"'; ?> aria-label="Next"> <span aria-hidden="true">&raquo;</span> </a> </li>
        </ul>
      </nav>
      <?php
		} else { // if has $_GET
		?>
      <nav aria-label="Page navigation example">
        <ul class="pagination" style="justify-content: center;">
          <li <?php if($page==1) echo 'class="page-item disabled"'; ?>> <a class="page-link" <?php if($page != 1) echo 'href="search_flight.php?page='.($page - 1)."&depAirport=$depAirport&arrAirport=$arrAirport&depDate=$depDate".'"'; ?> aria-label="Previous"> <span aria-hidden="true">&laquo;</span> </a> </li>
          <?php
		for($i=1;$i <= $totalpages; $i++) {
			if($i == $page) {
				echo "<li class=\"page-item active\"><a class=\"page-link\" href=\"search_flight.php?page=$i&depAirport=$depAirport&arrAirport=$arrAirport&depDate=$depDate\">$i</a></li>";
				continue;
			}
			else {
    			echo "<li class=\"page-item\"><a class=\"page-link\" href=\"search_flight.php?page=$i&depAirport=$depAirport&arrAirport=$arrAirport&depDate=$depDate\">$i</a></li>";
			}
		}
		?>
          <li <?php if($page==$totalpages) echo 'class="page-item disabled"'; ?>> <a class="page-link" <?php if($page != $totalpages) echo 'href="search_flight.php?page='.($page + 1)."&depAirport=$depAirport&arrAirport=$arrAirport&depDate=$depDate".'"'; ?> aria-label="Next"> <span aria-hidden="true">&raquo;</span> </a> </li>
        </ul>
      </nav>
      <?php
		} // if else check is set $_GET to show page
		?>
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