<?php

session_start();
require('conn.php');

if(!isset($_SESSION['user'])) {
    header('location:login.php');
    die();
}

$id = $_SESSION['id'];
$sql = "SELECT * FROM user WHERE user_account = '$id';";
$rs = mysqli_query($conn, $sql) or die(mysqli_error($conn));
$rc = mysqli_fetch_assoc($rs);
mysqli_free_result($rs);

$temp_array = array();
foreach($_SESSION['cart'] as $order) {
    if (isset($order['EngName'])) {
        $sql = "INSERT INTO hotelorder (room_id, user_id, OrderDate, real_price, Checkin, Checkout, Remark) VALUES ('".$order['room_id']."', '".$rc['user_id']."', '".date('Y-m-d H:i:s')."', '".$order['TotalAmount']."', '".$order['Checkin']."', '".$order['Checkout']."', '');";
        mysqli_query($conn, $sql) or die(mysqli_error($conn));
        $num = mysqli_affected_rows($conn);
        mysqli_close($conn);
        if($num < 1) {
            $message = "Hotel Cart add unsuccessful";
        } else {
            $message = $num." Hotel Cart add successful";
        }
        echo "<script type='text/javascript'>
                    alert('$message');
                    window.location=\"staff_check_shoppingcart.php\";
                    </script>";
    
    } else {
        array_push($temp_array, $order);
    }
}
$_SESSION['cart'] = $temp_array;


?>