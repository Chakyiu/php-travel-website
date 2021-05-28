<!DOCTYPE html>
<?php
	session_start();
    require("conn.php");
    mysqli_set_charset($conn,"utf8");
	if(isset($_SESSION['user'])) {
		if($_SESSION['user'] == "staff") {
			$id = $_SESSION['id'];
			
			$sql = "SELECT * FROM hotel";
			$rs = mysqli_query($conn, $sql) or die(mysqli_error($conn));
			$rc = mysqli_fetch_assoc($rs);

			mysqli_free_result($rs);
			//mysqli_close($conn);
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
        <div class="col-md-2 well trbox" style="margin-right:20px">
            <!-- search form -->
            <form role="form" method="get" action="hotelowner_report.php">
                <div>
                    <label style="margin: 10px">Hotel</label>
                    <select name="hotel_name" class="form-control shadow">
                        <?php
                            require('conn.php');
                            $sql = "SELECT engName FROM hotel;";	// print the available dep airport
                            $rs = mysqli_query($conn, $sql) or die(mysqli_error($conn));
                            while($rc = mysqli_fetch_assoc($rs)) {
                                extract($rc);
                                echo '<option value="'.$engName.'">'.$rc['engName'].'</option>';
                            }
                            ?>    
                    </select>
                </div>
                <div class="form-group">
                    <label>StartDay</label>
                    <input type="date" class="form-control" name="StartDay" placeholder="StartDay"> </div>
                <div class="form-group">
                    <label>EndDay</label>
                    <input type="date" class="form-control" name="EndDay" placeholder="EndDay"> </div>
                <button style="margin: 10px;" type="submit" name="sumbit" class="btn btn-info">Generate</button>
                <button type="reset" class="btn btn-info">Clear</button>
            </form>
        </div>
        <!-- END search form -->
        <div class="col-md-8 well trbox">
            <h2 style="margin: 20px;">HotelReport</h2>
            <table class="table table-striped">
                <?php if(isset($_GET)){?>
                    <thead>
                        <tr>
                            <th>Period :</th>
                            <th>
                                <?php if(isset($_GET['StartDay'])) {
                                    echo $_GET['StartDay'];
                                }
                            ?>
                            </th>
                            <th>
                                <?php if(isset($_GET['StartDay'])){echo $_GET['EndDay'];}?>
                            </th>
                            <th>
                                <?php if(isset($_GET['StartDay'])){
                                echo date_diff(new DateTime($_GET['StartDay']),new DateTime($_GET['EndDay']),true)->format('total %d day');}?>
                            </th>
                        </tr>
                        <tr>
                            <th>【Room Type】</th>
                            <th>【Booked Customer Number】</th>
                            <th>【Number Of Room Booked】</th>
                            <th>【Totol Revence】</th>
                        </tr>
                    </thead>
                    <?php ?>
                        <tbody>
                            <?php 
                    //print_r($_GET);
                if(isset($_GET['StartDay'])){

//$sql = "SELECT DISTINCT RoomType,sum(TotalAmt),count(CustID),count(BookingID) FROM hotelbooking where Checkin between {$_GET['StartDay']} and {$_GET['EndDay']} || Checkout between {$_GET['StartDay']} and {$_GET['EndDay']}  GROUP BY RoomType  ";

                    
$sql  = "SELECT DISTINCT room.room_type,sum(hotelorder.real_price) as RoomTotalPrice,count(user_id) as TotalCustomer,count(hotel_order_id) as BookingCount, sum(room.room_num) as RoomBooked FROM hotelorder INNER JOIN room ON room.room_id = hotelorder.room_id where OrderDate between '{$_GET['StartDay']}' and '{$_GET['EndDay']}'  GROUP BY room.room_type  ";                   
                    
//echo $sql;
$total=0;
$Rtotal=0;
$Ctotal=0;
mysqli_set_charset($conn, "utf8");
$rs = mysqli_query($conn,$sql) or die(mysqli_error($conn));
    while($rc = mysqli_fetch_assoc($rs)){
        //echo $rc['room_type'];
        $total+=$rc['RoomTotalPrice'];
        $Rtotal +=$rc['RoomBooked'];
        $Ctotal += $rc['TotalCustomer'];

?>
                                <tr>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td>
                                        <?php echo $rc['room_type']; ?>
                                    </td>
                                    <td>
                                        <?php echo $rc['TotalCustomer']; ?>
                                    </td>
                                    <td>
                                        <?php echo $rc['RoomBooked']; ?>
                                    </td>
                                    <td>
                                        <?php echo number_format($rc['RoomTotalPrice']); ?>
                                    </td>
                                </tr>
                                <?php } 
                    $total = number_format($total);
                    ?>
                        </tbody>
                        <tr>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                        </tr>
                        <tr>
                            <td>
                                <h4>Summary</h4> </td>
                            <td>
                                <?php echo $Ctotal ;?>
                            </td>
                            <td>
                                <?php echo $Rtotal ;?>
                            </td>
                            <td>
                                <?php echo $total; ?>
                            </td>
                        </tr>
            </table>
            <div class="text-right">
                <h4>Total Amount Between 
                    <?php 
                    echo "【{$_GET['StartDay']}】 to 【{$_GET['EndDay']}】 is  【\$ {$total} 】"; 
                    ?>
                </h4> </div>
        </div>
        <?php 
            mysqli_free_result($rs);          
            }}
            mysqli_close($conn);
?>
    </div>
</div>

<script src="js/bootstrap/jquery-3.5.1.min.js"></script>
<script src="js/bootstrap/popper.min.js"></script>
<script src="js/bootstrap/bootstrap.min.js"></script>
<script src="js/fa/all.js"></script>
</body>
</html>