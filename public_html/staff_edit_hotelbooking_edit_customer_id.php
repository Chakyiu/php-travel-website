<?php
	if(isset($_POST['BookingID'])) {
		require_once('conn.php');
		extract($_POST);
		$sql = "UPDATE hotelorder SET user_id = '$CustID' WHERE hotel_order_id = '$BookingID';";
		$rs = mysqli_query($conn, $sql) or die(mysqli_error($conn));
		if(mysqli_affected_rows($conn) > 0) {
			$message = "Update Successful";
			echo "<script>
					alert('Updated successfully!');
					window.location.href='staff_edit_booking.php?hotelbooking=active';
					</script>";
		} else {
			$message = "Customer ID has NOT been updated! Please check again!";
			echo "<script>
					alert('$message');
					window.location.href='staff_edit_booking.php?hotelbooking=active';
					</script>";
		}
		mysqli_free_result($rs);
		mysqli_close($conn);
	}
?>