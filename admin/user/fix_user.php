<?php
    include("../../dbConnection.php");
    $dbConnection = new dbConnection();
    $conn = $dbConnection->getConnection();

	if (isset($_POST["btn_submit"])) {
		$name = $_POST["fullname"];
		$email = $_POST["email"];
		$permission = $_POST["permission"];
		$is_block = 0;
		if (isset($_POST["is_block"])) {
			$is_block = $_POST["is_block"];
		}

		$id = $_POST["id"];
		$sql = "UPDATE users SET fullname = '$name', email = '$email', permision = '$permission', is_block = '$is_block' WHERE user_id=$id";
        $sql_query= mysqli_query($conn,$sql);
		echo '<script language="javascript">alert("Sửa thông tin thành viên thành công!"); window.location="dashboard-fix.php";</script>';
	}
	?>