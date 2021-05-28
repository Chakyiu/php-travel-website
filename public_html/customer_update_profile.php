<?php
	if(!isset($_POST['id'])) {
	require('conn.php');
	extract($_POST);
	$sql = "UPDATE user SET	lastname='$lastname',
								firstname='$firstname',
								DateOfBirth='$DateOfBirth',
								Gender='$Gender',
								passport_no='$passport_no',
								contact_no='$contact_no',
								Nationality='$Nationality'
                                WHERE user_account ='$user_account';";
    print_r($sql);
	$rs = mysqli_query($conn, $sql) or die(mysqli_error($conn));
	if(mysqli_affected_rows($conn) > 0) {
		$message = "Update Successful";
		echo "<script>
				alert('Profile has been updated successfully!');
				window.location.href='customer_profile.php';
				</script>";
	} else {
		$message = "Profile has not been updated! Please check again!";
		echo "<script>
				alert('$message');
				window.location.href='customer_profile.php';
				</script>";
	}
		mysqli_free_result($rs);
		mysqli_close($conn);
	}
?>