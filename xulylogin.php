<?php
session_start();
$_SESSION["admin_id"] = NULL;
$_SESSION["user_id"] = NULL;
$_SESSION['username'] = NULL;
$_SESSION["email"] = null;
$_SESSION["fullname"] = null;
$_SESSION["is_block"] = null;
$_SESSION["permision"] = null;
// $_SESSION["sessionid"] = null;

include("dbConnection.php");
$dbConnection = new dbConnection();
$conn = $dbConnection->getConnection();

if (isset($_POST["dangnhap"])) {
	$username = $_POST["username"];
	$password = $_POST["password"];

	$username = strip_tags($username);
	$username = addslashes($username);
	$password = strip_tags($password);
	$password = addslashes($password);
	if ($username == "" || $password == "") {
		echo "username hoặc password bạn không được để trống!";
	} else {
		$sql = "select * from users where username = '$username' and password = '$password' ";
		echo "select * from users where username = '$username' and password = '$password'";
		$query = mysqli_query($conn, $sql);
		$num_rows = mysqli_num_rows($query);
		if ($num_rows == 0) {
			echo "Tên đăng nhập hoặc mật khẩu không đúng !";
		} else {
			while ($data = mysqli_fetch_array($query)) {
				// $cookie = str_replace("PHPSESSID=", "", $_SERVER["HTTP_COOKIE"]);
				// $sql_cookie = "UPDATE users SET sessionid = '$cookie' WHERE user_id = {$data["user_id"]}";
				// $query_cookie = mysqli_query($conn, $sql_cookie);
			
				$_SESSION["user_id"] = $data["user_id"];
				$_SESSION['username'] = $data["username"]; 
				$_SESSION["email"] = $data["email"];
				$_SESSION["fullname"] = $data["fullname"];
				$_SESSION["is_block"] = $data["is_block"];
				$_SESSION["permision"] = $data["permision"];
				// $_SESSION["sessionid"] = $data["sessionid"];
			}
			if (isset($_SESSION['permision']) == true && isset($_SESSION['is_block']) == true) {
				$permission = $_SESSION['permision'];
				$is_block = $_SESSION['is_block'];
				if ($permission == '1' && $is_block == '0') {
					header('Location: ./admin/home.php');
				}
				elseif($permission == '0' && $is_block == '0'){
					header('Location: index.php');
				}
				else {
					echo '<script language="javascript">alert("Tài khoản admin này đã bị vô hiệu hóa!"); window.location="login.php";</script>';
				}
			}
		}
	}
}

// if (isset($_POST["admin_login"])) {
// 	$username = $_POST["username"];
// 	$password = $_POST["password"];
// 	$username = strip_tags($username);
// 	$username = addslashes($username);
// 	$password = strip_tags($password);
// 	$password = addslashes($password);
// 	if ($username == "" || $password == "") {
// 		echo "username hoặc password bạn không được để trống!";
// 	} else {
// 		$sql = "select * from users where username = '$username' and password = '$password'";
// 		$query = mysqli_query($conn, $sql);
// 		$num_rows = mysqli_num_rows($query);
// 		if ($num_rows == 0) {
// 			echo "Tên đăng nhập hoặc mật khẩu không đúng !";
// 		} else {
// 			while ($data = mysqli_fetch_array($query)) {
// 				$_SESSION["admin_id"] = $data["admin_id"];
// 				$_SESSION['username'] = $data["username"];
// 				$_SESSION["email"] = $data["email"];
// 				$_SESSION["fullname"] = $data["fullname"];
// 				$_SESSION["is_block"] = $data["is_block"];
// 				$_SESSION["permision"] = $data["permision"];
// 			}
// 			if (isset($_SESSION['permision']) == true && isset($_SESSION['is_block']) == true) {
// 				$permission = $_SESSION['permision'];
// 				$is_block = $_SESSION['is_block'];
// 				if ($permission == '1' && $is_block == '0') {
// 					header('Location: ./admin/home.php');
// 				} else {
// 					echo '<script language="javascript">alert("Tài khoản admin này đã bị vô hiệu hóa!"); window.location="adlogin.php";</script>';
// 				}
// 			}
// 		}
// 	}
// }
