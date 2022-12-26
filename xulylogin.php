<?php
session_start();
$_SESSION["user_id"] = NULL;
$_SESSION['username'] = NULL;
$_SESSION["email"] = null;
$_SESSION["fullname"] = null;
$_SESSION["is_block"] = null;
$_SESSION["permision"] = null;
//Gọi file connection.php ở bài trước
include("dbConnection.php");
$dbConnection = new dbConnection();
$conn = $dbConnection->getConnection();
// Kiểm tra nếu người dùng đã ân nút đăng nhập thì mới xử lý
if (isset($_POST["dangnhap"])) {
	// lấy thông tin người dùng
	$username = $_POST["username"];
	$password = $_POST["password"];
	//làm sạch thông tin, xóa bỏ các tag html, ký tự đặc biệt 
	//mà người dùng cố tình thêm vào để tấn công theo phương thức sql injection
	$username = strip_tags($username);
	$username = addslashes($username);
	$password = strip_tags($password);
	$password = addslashes($password);
	if ($username == "" || $password == "") {
		echo "username hoặc password bạn không được để trống!";
	} else {
		$sql = "select * from users where username = '$username' and password = '$password' ";
		$query = mysqli_query($conn, $sql);
		$num_rows = mysqli_num_rows($query);
		if ($num_rows == 0) {
			echo "Tên đăng nhập hoặc mật khẩu không đúng !";
		} else {
			// Lấy ra thông tin người dùng và lưu vào session
			while ($data = mysqli_fetch_array($query)) {
				$_SESSION["user_id"] = $data["user_id"];
				$_SESSION['username'] = $data["username"];
				$_SESSION["email"] = $data["email"];
				$_SESSION["fullname"] = $data["fullname"];
				$_SESSION["is_block"] = $data["is_block"];
				$_SESSION["permision"] = $data["permision"];
			}

			// Thực thi hành động sau khi lưu thông tin vào session
			if (isset($_SESSION['is_block']) == true) {
				// Ngược lại nếu đã đăng nhập
				$is_block = $_SESSION['is_block'];
				// Kiểm tra quyền của người đó có phải là admin hay không
				if ($is_block == '1') {
					echo '<script language="javascript">alert("Tài khoản của bạn đã bị khóa!"); window.location="login.php";</script>';
				} else {
					header('Location: index.php');
				}
			}
		}
	}
}

if (isset($_POST["admin_login"])) {
	// lấy thông tin người dùng
	$username = $_POST["username"];
	$password = $_POST["password"];
	//làm sạch thông tin, xóa bỏ các tag html, ký tự đặc biệt 
	//mà người dùng cố tình thêm vào để tấn công theo phương thức sql injection
	$username = strip_tags($username);
	$username = addslashes($username);
	$password = strip_tags($password);
	$password = addslashes($password);
	if ($username == "" || $password == "") {
		echo "username hoặc password bạn không được để trống!";
	} else {
		$sql = "select * from admin where username = '$username' and password = '$password' ";
		$query = mysqli_query($conn, $sql);
		$num_rows = mysqli_num_rows($query);
		if ($num_rows == 0) {
			echo "Tên đăng nhập hoặc mật khẩu không đúng !";
		} else {
			// Lấy ra thông tin người dùng và lưu vào session
			while ($data = mysqli_fetch_array($query)) {
				$_SESSION["admin_id"] = $data["admin_id"];
				$_SESSION['username'] = $data["username"];
				$_SESSION["email"] = $data["email"];
				$_SESSION["fullname"] = $data["fullname"];
				$_SESSION["is_block"] = $data["is_block"];
				$_SESSION["permision"] = $data["permision"];
			}

			// Thực thi hành động sau khi lưu thông tin vào session
			if (isset($_SESSION['permision']) == true && isset($_SESSION['is_block']) == true) {
				$permission = $_SESSION['permision'];
				$is_block = $_SESSION['is_block'];
				// Kiểm tra quyền của người đó có phải là admin hay không
				if ($permission == '1' && $is_block == '0') {
					header('Location: ./admin/home.php');
				} else {
					echo '<script language="javascript">alert("Tài khoản admin này đã bị vô hiệu hóa!"); window.location="adlogin.php";</script>';
				}
			}
		}
	}
}
