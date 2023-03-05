<?php
	if (isset($_POST["btn_update"])) {
		$userid = $_GET['userid'];
		include("dbConnection.php");
		$dbConnection = new dbConnection();
		$conn = $dbConnection->getConnection();
        $id = $_POST['id'];
		//lấy thông tin từ các form bằng phương thức POST
		$title = $_POST["title"];
		$content = $_POST["post_content"];
		$is_public = 0;
		if (isset($_POST["is_public"])) {
			$is_public = $_POST["is_public"];
		}

		$sql = "UPDATE `posts` SET title = '$title', content = '$content', is_public = '$is_public', updatedate = now() where posts_id = '$id'";
		$query = mysqli_query($conn,$sql);
        // if($conn->query($sql) == TRUE)
		echo '<script language="javascript">alert("Sửa bài viết thành công!");</script>';
		header("Location: profile.php?id=$userid");
	}
?>