<!DOCTYPE html>
<?php
	session_start();
    require("conn.php");
	mysqli_set_charset($conn,"utf8");
	if(isset($_SESSION['user'])) {
		if($_SESSION['user'] == "staff") {
			$id = $_SESSION['id'];
			
            $sql = "SELECT * FROM airline ;";

			$rs = mysqli_query($conn, $sql) or die(mysqli_error($conn));
            $rc = mysqli_fetch_assoc($rs);

			mysqli_free_result($rs);
			//mysqli_close($conn);
		}
    }
    
    $chart_stat = array();
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

<div class="container-fluid mt-4">
    <div class="row" style="justify-content: center">
        <div class="col-md-2 well trbox" style="margin-right:20px">
            <!-- search form -->
            <form role="form" method="get" action="airline_report.php">
                <div class="form-group">
                    <div>
                    <label style="margin: 10px">Airline</label>
                        <select name="airlineName" class="form-control shadow">
                            <!-- <option value="BR">長榮航空</option>
                            <option value="CI">中華航空</option>
                            <option value="CX">國泰航空</option>
                            <option value="EK">阿聯酋航空</option>
                            <option value="HX">香港航空</option>
                            <option value="JL">日本航空</option>
                            <option value="KA">港龍航空</option>
                            <option value="MU">中國東方航空</option>
                            <option value="NH">全日空航空</option>
                            <option value="SQ">新加坡航空</option>
                            <option value="TG">泰國國際航空</option>
                            <option value="UA">美國聯合航空</option> -->
                            <?php
                                require('conn.php');
                                $sql = "SELECT airlineName, AirlineCode FROM airline;";	// print the available dep airport
                                mysqli_set_charset($conn, "utf8");
                                $rs = mysqli_query($conn, $sql) or die(mysqli_error($conn));
                                while($rc = mysqli_fetch_assoc($rs)) {
                                    extract($rc);
                                    echo '<option value="'.$AirlineCode.'">'.$rc['airlineName'].'</option>';
                                }
                                ?>    
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <label>Group Option:</label><br/>
                    <input type="radio" name="group" value="flight_no" checked> Flight No
                    <input type="radio" name="group" value="flightclass_type" > Flight Class<br>
                </div>
                <div class="form-group">
                    <label>Departure Period:</label><br/>
                    <input type="date" class="form-control" name="DPStart" placeholder="DPStart">
                    <input type="date" class="form-control" name="DPEnd" placeholder="DPEnd"> 
                </div>
                <div class="form-group">
                    <label>Output Option:</label><br/>
                    <input type="radio" name="output" value="ppl" checked>  Passengers
                    <input type="radio" name="output" value="mon" > Revenue<br>
                    </div>  
                <button style="margin: 10px;" type="submit" name="sumbit" class="btn btn-info" onClick="draw(<?php echo $rc[$groupby].",".$rc['output']?> );">Generate</button>
                <button type="reset" class="btn btn-info">Clear</button>
            </form>
        </div>
        <!-- END search form -->
        <div class="col-md-8 well trbox">
            <h2 style="margin: 20px">Flight Report</h2>
            <table class="table table-striped">
                <?php
                if(isset($_GET)) {
                    //if(isset($_GET['output]'])){
                    if (!empty($_GET['output'])){
                    $output = "";
                    $groupby = "";
                    $outputname = "";
                    
                    if($_GET['output']=="ppl"){
                        $output = "sum(AdultNum + ChildNum + InfantNum) as output";
                        $outputname = "Total Number of Customer";
                    }else{
                            $output = "sum(real_price) as output";
                        $outputname = "Total Revenue";
                    }

                    if($_GET['group']=="flight_no"){
                        $groupby = "flight_no";
                        $groupbyName = "Flight No.";
                    }else{
                            $groupby = "flightclass_type";
                            $groupbyName = "Class Type";
                    }

                    $format = "text";
                    
                    $sql  = "SELECT {$groupby},{$output} FROM flightorder where flight_no  like '%".$_GET['airlineName']."%' && DepDateTime between '{$_GET['DPStart']}' and '{$_GET['DPEnd']}'  GROUP BY {$groupby}  ";                   
                    $rs = mysqli_query($conn,$sql) or die(mysqli_error($conn));
                    
                    //echo $sql;
                    //print_r($rs);
                    
                    $total=0;
                        
                    
                        if($format=="text"){
                            
                ?>
                    <thead>
                        <tr>
                            <th>Period :</th>
                            <th>
                                <?php if(isset($_GET['DPStart'])) {
                                    echo $_GET['DPStart'];
                                }
                            ?>
                            </th>
                            <th>
                                <?php if(isset($_GET['DPEnd'])){echo $_GET['DPEnd'];}?>
                            </th>
                            <th>
                                <?php if(isset($_GET['DPStart'])){
                                echo date_diff(new DateTime($_GET['DPStart']),new DateTime($_GET['DPEnd']),true)->format('total %d day');}?>
                            </th>
                        </tr>
                        <tr>
                            <th>【<?php echo $groupbyName ?>】</th>
                            <th>【<?php echo $outputname ?>】</th>
                        </tr>
                    </thead>
                    <?php ?>
                        <tbody>
                            <?php 
                    //print_r($_GET);
                if(isset($_GET['DPStart'])) {
                        
                        while($rc = mysqli_fetch_assoc($rs)){
                                //print_r($rc);
                            $total +=  $rc['output'];
?>
                                <tr>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td>
                                        <?php echo $rc["{$groupby}"]; ?>
                                    </td>
                                    <td>
                                        <?php echo $rc['output']; ?>
                                        <?php 
                                            $chart_stat[$rc["{$groupby}"]] = $rc['output'];
                                        ?>
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
                                <?php echo $total; ?>
                            </td>
                        </tr>
            </table>
            <div class="text-right">
                <h4>
                    <?php 
                    echo " $outputname Between 【{$_GET['DPStart']}】 to 【{$_GET['DPEnd']}】 is  【 {$total} 】"; 
                    ?>
                </h4>
            </div>

            <div>
            <?php
                if (sizeof($chart_stat) > 0) {
                    echo '<div id="main" style="width: 100%;height:400px;"></div>';
                
                ?>
                <script type="text/javascript">
                    var myChart = echarts.init(document.getElementById('main'));

                    option = {
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
                                name: 'Total Number of Customer',
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
        </div>
        

        <?php 
            mysqli_free_result($rs);          
            }
                        
                        
                        
                        }else{ ?>
                            
                            <?php  while($rc = mysqli_fetch_assoc($rs)){ ?>

                                    
                        
                                <?php echo "{$rc["{$groupby}"] }, {$rc['output']}"; }?> 
                            <canvas id="myCanvas" width="800" height="300"
                            style="border:1px solid #000000;">
                            </canvas>
                            
                    <?php      }
                    //}
                            }
                }
            mysqli_close($conn);
?>
    </div>
</div>
<?php require_once('logout_modal.php') ?> <!-- logout modal -->

<script src="js/bootstrap/jquery-3.5.1.min.js"></script>
<script src="js/bootstrap/popper.min.js"></script>
<script src="js/bootstrap/bootstrap.min.js"></script>
<script src="js/fa/all.js"></script>

</body>
</html>