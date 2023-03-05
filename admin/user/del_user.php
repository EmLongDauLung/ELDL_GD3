<?php
	// session_start(); 
    include("../../dbConnection.php");
    $dbConnection = new dbConnection();
    $conn = $dbConnection->getConnection();
	if (isset($_POST["btn_submit_deluser"])) {
	$id = $_POST['id'];
		$sql = "DELETE FROM users WHERE user_id = $id";
		mysqli_query($conn,$sql);
		echo '<script language="javascript">alert("Xóa người dùng thành công!"); window.location="dashboard-fix.php";</script>';
	}
?>