<?php
	if(!isset($_POST['id'])) {
		extract($_POST);
		require('conn.php');
		$sql = "SELECT * FROM user WHERE user_account = '$user_account'";
		$rs = mysqli_query($conn, $sql) or die(mysqli_error($conn));
		$rc = mysqli_fetch_assoc($rs);
		if($oldPassword != $rc['password']){
			$message = "old_pwd_not_match";
				echo "<script>
						window.location.href='customer_profile.php?password={$message}';
						</script>";
		} else
		if($newPassword != $confirmPassword) {
			$message = "confirm_pwd_not_match";
				echo "<script>
						window.location.href='customer_profile.php?password={$message}';
						</script>";
		} else {
			$sql = "UPDATE user SET password='$newPassword'
					WHERE user_account='$user_account';";
			$rs = mysqli_query($conn, $sql) or die(mysqli_error($conn));
			if(mysqli_affected_rows($conn) > 0) {
				$message = "change_successfully";
				echo "<script>
						window.location.href='customer_profile.php?password={$message}';
						</script>";
			} else {
				$message = "change_unsuccessfully";
				echo "<script>
						window.location.href='customer_profile.php?password={$message}';
						</script>";
			}
		}
	}
?>