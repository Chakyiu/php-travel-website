<!DOCTYPE html>
<?php
	session_start();
    require("conn.php");
	mysqli_set_charset($conn,"utf8");
	if(isset($_SESSION['user'])) {

    }
    
    $chart_stat = array();
    $chart_stat2 = array();
    $chart_stat2[1] = 0;
    $chart_stat2[2] = 0;
    $chart_stat2[3] = 0;
    $chart_stat2[4] = 0;
    $chart_stat2[5] = 0;
    $chart_stat2[6] = 0;
    $chart_stat2[7] = 0;
    $chart_stat2[8] = 0;
    $chart_stat2[9] = 0;
    $chart_stat2[10] = 0;
    $chart_stat2[11] = 0;
    $chart_stat2[12] = 0;
    $chart_stat3 = array();
?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Impress Travel</title>

    <link href="css/bootstrap/bootstrap.min.css" rel="stylesheet" type="text/css">
    <link href="css/fa/all.css" rel="stylesheet" type="text/css">
    <link href="css/layout.css" rel="stylesheet" type="text/css">
    <script src="js/echarts.min.js"></script>
</head>

<style type="text/css">
    #myCanvas {
        background: white;
        border: 1px solid black;
    }
    </style>
    <script>
        function draw(){
        var c = document.getElementById("myCanvas");
        var ctx = c.getContext("2d");
            ctx.beginPath();
        ctx.fillRect(20, 20, 150, 100);
    }
</script>
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

<div class="container mt-4 mb-4">
    <div class="row">
        <!-- END search form -->
        <div class="col-md-12 well trbox">
            <h2 style="margin: 20px">Hotel Pop Report</h2>
            <?php
                $sql = "SELECT `hotel`.`country`, count(*) as country_count FROM `hotelorder` INNER JOIN room ON `room`.`room_id` = hotelorder.room_id INNER JOIN hotel ON `room`.`hotel_id` = `hotel`.`hotel_id` GROUP BY `hotel`.`country`";	// print the available dep airport
                mysqli_set_charset($conn, "utf8");
                $rs = mysqli_query($conn, $sql) or die(mysqli_error($conn));
                while($rc = mysqli_fetch_assoc($rs)) {
                    $chart_stat[$rc["country"]] = $rc["country_count"];
                }

                $sql = "SELECT MONTH(`hotelorder`.`Checkin`) as Month, count(*) as month_count FROM `hotelorder` INNER JOIN room ON `room`.`room_id` = hotelorder.room_id INNER JOIN hotel ON `room`.`hotel_id` = `hotel`.`hotel_id` GROUP BY MONTH(`hotelorder`.`Checkin`)";	// print the available dep airport
                mysqli_set_charset($conn, "utf8");
                $rs = mysqli_query($conn, $sql) or die(mysqli_error($conn));
                while($rc = mysqli_fetch_assoc($rs)) {
                    $chart_stat2[$rc["Month"]] = $rc["month_count"];
                }

                
                $sql = "SELECT WEEKDAY(`hotelorder`.`OrderDate`) as weekday, count(*) as weekday_count FROM `hotelorder` INNER JOIN room ON `room`.`room_id` = hotelorder.room_id INNER JOIN hotel ON `room`.`hotel_id` = `hotel`.`hotel_id` GROUP BY WEEKDAY(`hotelorder`.`OrderDate`)";	// print the available dep airport
                mysqli_set_charset($conn, "utf8");
                $rs = mysqli_query($conn, $sql) or die(mysqli_error($conn));
                while($rc = mysqli_fetch_assoc($rs)) {
                    $chart_stat3[$rc["weekday"]] = $rc["weekday_count"];
                }
            ?>
            <div>
            <?php
                if (sizeof($chart_stat) > 0) {
                    echo '<div id="main" style="width: 100%;height:400px; margin-bottom: 100px;"></div>';
                
                ?>
                <script type="text/javascript">
                    var myChart = echarts.init(document.getElementById('main'));

                    option = {
                        
                        title: {
                            x:'center',
                            text: 'Group by country',
                        },
                        tooltip : {
                            trigger: 'item',
                            formatter: "{a} <br/>{b} : {c} ({d}%)"
                        },
                        legend: {
                            orient: 'vertical',
                            left: 'left',
                            data: [
                                <?php
                                    $string = '';
                                    foreach ($chart_stat as $key => $value) {
                                        $string .= ",'".$key."'";
                                    }
                                    echo ltrim($string, ',');
                                ?>
                            ]
                        },
                        series : [
                            {
                                name: 'Total Hotel Booking',
                                type: 'pie',
                                radius : '55%',
                                center: ['50%', '60%'],
                                data:[
                                    <?php
                                        $string = '';
                                        foreach ($chart_stat as $key => $value) {
                                            $string .= ",{ value:".$value.", name:'".$key."'}";
                                        }
                                        echo ltrim($string, ',');
                                    ?>
                                ],
                                itemStyle: {
                                    emphasis: {
                                        shadowBlur: 10,
                                        shadowOffsetX: 0,
                                        shadowColor: 'rgba(0, 0, 0, 0.5)'
                                    }
                                }
                            }
                        ]
                    };

                    myChart.setOption(option);
                </script>
            <?php
            }
            ?>
            </div>

            <div>
            <?php
                if (sizeof($chart_stat2) > 0) {
                    echo '<div id="main2" style="width: 100%;height:400px; margin-bottom: 100px;"></div>';
                
                ?>
                <script type="text/javascript">
                    var myChart2 = echarts.init(document.getElementById('main2'));

                    option2 = {
                        
                        title: {
                            x:'center',
                            text: 'Group by Departing Month',
                        },
                        tooltip : {
                            trigger: 'item',
                            formatter: "{a} <br/>{b} : {c} ({d}%)"
                        },
                        xAxis: {
                            type: 'category',
                            data: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec']
                        },
                        yAxis: {
                            type: 'value'
                        },
                        series: [{
                            data: [
                                <?php
                                    $string = '';
                                    foreach ($chart_stat2 as $key => $value) {
                                        $string .= ",".$value;
                                    }
                                    echo ltrim($string, ',');
                                ?>
                            ],
                            type: 'line'
                        }]
                    };

                    myChart2.setOption(option2);
                </script>
            <?php
            }
            ?>
            </div>


            <div>
            <?php
                if (sizeof($chart_stat3) > 0) {
                    echo '<div id="main3" style="width: 100%;height:400px; margin-bottom: 100px;"></div>';
                
                    $dowMap = array('Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat', 'Sun');
                ?>
                <script type="text/javascript">
                    var myChart3 = echarts.init(document.getElementById('main3'));

                    option3 = {
                        
                        title: {
                            x:'center',
                            text: 'Group by Order WeekDay',
                        },
                        tooltip : {
                            trigger: 'item',
                            formatter: "{a} <br/>{b} : {c} ({d}%)"
                        },
                        legend: {
                            orient: 'vertical',
                            left: 'left',
                            data: [
                                <?php
                                    $string = '';
                                    foreach ($chart_stat3 as $key => $value) {
                                        $string .= ",'".$dowMap[$key]."'";
                                    }
                                    echo ltrim($string, ',');
                                ?>
                            ]
                        },
                        series : [
                            {
                                name: 'Total Hotel Booking',
                                type: 'pie',
                                radius : '55%',
                                center: ['50%', '60%'],
                                data:[
                                    <?php
                                        $string = '';
                                        foreach ($chart_stat3 as $key => $value) {
                                            $string .= ",{ value:".$value.", name:'".$dowMap[$key]."'}";
                                        }
                                        echo ltrim($string, ',');
                                    ?>
                                ],
                                itemStyle: {
                                    emphasis: {
                                        shadowBlur: 10,
                                        shadowOffsetX: 0,
                                        shadowColor: 'rgba(0, 0, 0, 0.5)'
                                    }
                                }
                            }
                        ]
                    };

                    myChart3.setOption(option3);
                </script>
            <?php
            }
            ?>
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