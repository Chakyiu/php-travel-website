<?php
	if(!isset($_POST['id'])) {
	require('conn.php');
	extract($_POST);
	$sql = "INSERT INTO `user` (`user_account`, `password`, `user_email`, `lastname`, `firstname`, `DateOfBirth`, `Gender`, `passport_no`, `contact_no`, `Nationality`) VALUES ('$user_account_ID', '$user_account_PW', '$email', '$lastname', '$firstname', '$DateOfBirth', '$gender', '$passport_no', '$contact_NO', '$Nationality');";
            
    //print_r($sql);
	$rs = mysqli_query($conn, $sql) or die(mysqli_error($conn));
	if (mysqli_affected_rows($conn) > 0) {
		$message = "Register Successful";
		echo "<script>
				alert('$message');
				window.location.href='index.php';
				</script>";
	} else {
		$message = "Register unsuccessful! Please try again!";
		echo "<script>
				alert('$message');
				window.location.href='index.php';
				</script>";
	}
		mysqli_free_result($rs);
		mysqli_close($conn);
	}
?>