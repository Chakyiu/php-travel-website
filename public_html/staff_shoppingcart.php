<?php
	session_start();
	
	if(!isset($_SESSION['cart'])) {
			$_SESSION['cart'] = array();
	}
    
    
    if(isset($_POST['AirlineCode'])) { // if buy flight
		extract($_POST);
		
		$AdultAmount = ($AdultNum * $Price_Adult);
		$ChildAmount = ($ChildNum * $Price_Children);
		$InfantAmount = ($InfantNum * $Price_Infant);
		$TotalAmount = ($AdultAmount + $ChildAmount + $InfantAmount);
		
		$order = array(
			"AirlineCode" => $AirlineCode,
			"FlightNo" => $FlightNo,
			"Class" => $Class,
			"DepAirport" => $DepAirport,
			"ArrAirport" => $ArrAirport,
			"DepDateTime" => $DepDateTime,
			"AdultNum" => $AdultNum,
			"ChildNum" => $ChildNum,
			"InfantNum" => $InfantNum,
			"Tax" => $Tax,
			"AdultAmount" => $AdultAmount,
			"ChildAmount" => $ChildAmount,
			"InfantAmount" => $InfantAmount,
			"TotalAmount" => $TotalAmount
			);
			array_push($_SESSION['cart'], $order);
    }
    if(isset($_POST['EngName'])) { // if buy hotel
		
		extract($_POST);
		
        $orderCheckin = strtotime($Checkin);

     	$orderCheckout = strtotime($Checkout);
     	$daydiff = $orderCheckout - $orderCheckin;
     	$stayDays = floor($daydiff/(60*60*24));
		
		$real_price = ($stayDays * $Price);
		
		$order = array(
			"EngName" => $EngName,
			"Country" => $Country,
			"City" => $City,
			"RoomType" => $RoomType,
			"Checkin" => $Checkin,
			"Checkout" => $Checkout,
			"StayDats" => $stayDays,
            "TotalAmount" => $real_price,
            "room_id" => $room_id
            );
            array_push($_SESSION['cart'], $order);
	}
	
	
	$cartNum = count($_SESSION['cart']);
    
    echo "<script type='text/javascript'>
    alert('Added to shopping cart! Shopping cart items: $cartNum');
    window.location=\"staff_check_shoppingcart.php\";
    </script>";

?>