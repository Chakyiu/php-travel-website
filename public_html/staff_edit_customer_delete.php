<?php
	if(isset($_GET['id'])) {
	require('conn.php');
	extract($_GET);
	$sql = "DELETE FROM user WHERE user_id='$id';";
	$rs = mysqli_query($conn, $sql) or die(mysqli_error($conn));
	if(mysqli_affected_rows($conn) > 0) {
		$message = "Delete Successful";
		echo "<script>
				alert('Delete successfully!');
				window.location.href='staff_edit_customer.php';
				</script>";
	} else {
		$message = "Customer record has NOT been deleted! Please check again!";
		echo "<script>
				alert('$message');
				window.location.href='staff_edit_customer.php';
				</script>";
	}
		mysqli_free_result($rs);
		mysqli_close($conn);
	}
?>