<?php
	if(isset($_POST['user_id'])) {
	require('conn.php');
	extract($_POST);
	$sql = "UPDATE user SET	lastname='$lastname',
								firstname='$firstname',
								passport_no='$passport'
								WHERE user_id='$user_id';";
	$rs = mysqli_query($conn, $sql) or die(mysqli_error($conn));
	if(mysqli_affected_rows($conn) > 0) {
		$message = "Update Successful";
		echo "<script>
				alert('Updated successfully!');
				window.location.href='staff_edit_customer.php';
				</script>";
	} else {
		$message = "Customer record has NOT been updated! Please check again!";
		echo "<script>
				alert('$message');
				window.location.href='staff_edit_customer.php';
				</script>";
	}
		mysqli_free_result($rs);
		mysqli_close($conn);
	}
?>