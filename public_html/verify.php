<?php
	session_start();
	
	if(isset($_POST['UserID'])) {
		$id = $_POST['UserID'];
		$pw = $_POST['Password'];
		$type = $_POST['type'];
		require('conn.php');
		mysqli_set_charset($conn,"utf8");
		if($_POST['type'] == "customer") {
			$sql = "SELECT * FROM user WHERE user_account = '$id';";
			$rs = mysqli_query($conn, $sql)
				or die(mysqli_error($conn));
			if(mysqli_num_rows($rs) <= 0) {
				header("location:login.php?invalid");
			}
			else {
				$rc = mysqli_fetch_assoc($rs);
				if($rc['user_account'] == $id && $rc['password'] == $pw) {
                    $_SESSION['user_id'] = $rc["user_id"];
					$_SESSION['user'] = "customer";
					$_SESSION['id'] = $id;
					$_SESSION['pw'] = $pw;
					$_SESSION['name'] = $rc['firstname'];
					header("location:index.php");
				}
				else
					header("location:login.php?invalid");
			}
		} else if($_POST['type'] == "admin") {
			$sql = "SELECT * FROM admin WHERE admin_account = '$id';";
			$rs = mysqli_query($conn, $sql)
				or die(mysqli_error($conn));
			if(mysqli_num_rows($rs) <= 0) {
				header("location:login.php?invalid");
			}
			else {
				$rc = mysqli_fetch_assoc($rs);
				if($rc['admin_account'] == $id && $rc['password'] == $pw) {
					$_SESSION['user'] = "staff";
					$_SESSION['id'] = $id;
					$_SESSION['pw'] = $pw;
					$_SESSION['name'] = $rc['Name'];
					header("location:index.php");
				}
				else
					header("location:login.php?invalid");
			}
		}
		
		mysqli_free_result($rs);
		mysqli_close($conn);
	}
?>
</body>
</html>