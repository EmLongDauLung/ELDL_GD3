<?php
    include("../../dbConnection.php");
    $dbConnection = new dbConnection();
    $conn = $dbConnection->getConnection();
    session_start(); 

	if (isset($_POST["btn_submit"])) {
		//lấy thông tin từ các form bằng phương thức POST
		$username = $_POST["username"];
		$password = $_POST["password"];
		$name = $_POST["fullname"];
        $email = $_POST["email"];
		$permission = $_POST["permission"];
		$is_block = 0;
		if (isset($_POST["is_block"])) {
			$is_block = $_POST["is_block"];
		}

		if ($username == "" || $password == "" || $name == "" || $email == "" || $permission == ""|| $is_block == "" ) {
			echo '<script language="javascript">alert("Bạn cần nhập đầy đủ thông tin!");</script>';
		}else{
			// Viết câu lệnh thêm thông tin người dùng
            $sql_check =  "select * from users where username = '$username' or email = '$email'";
            $sl = mysqli_query($conn,$sql_check);
            $rowcount = mysqli_num_rows($sl);
            if($rowcount != 0){
                echo '<script language="javascript">alert("Người dùng đã tồn tại vui lòng không trùng username hoặc email!");</script>';
            }
            else{
                $sql = "INSERT INTO users (username, password, fullname, email, permision, is_block) VALUES ('$username', '$password', '$name', '$email', '$permission', '$is_block')";
                mysqli_query($conn,$sql);
				header('Location: dashboard-fix.php');
            }
		}
		
	}
?>
<?php include "../header.php" ?>
	<div class="add__user">
		<form method="POST" action="adduser.php">
            <table class="table">
                <thead>
                    <tr>
                        <td class="user__new__title">Username</td>
                        <td class="user__new__title">Password</td>
                        <td class="user__new__title">Fullname</td>
                        <td class="user__new__title">Email</td>
                        <td class="user__new__title">Is_Block</td>
                        <td class="user__new__title">Permision</td>
                    <tr>
                </thead>
                <tbody>
                    <tr>
                        <td  class="user__new__title">
                            <input type="text" class="user__new" name="username" id="username">
                        </td>
                        <td  class="user__new__title">
                            <input type="password" class="user__new" name="password" id="password">
                        </td>
                        <td  class="user__new__title">
                            <input type="text" class="user__new" name="fullname" id="fullname">
                        </td>
                        <td  class="user__new__title">
                            <input type="text" class="user__new" name="email" id="email">
                        </td>
                        <td  class="user__new__title">
                            <input type="checkbox" class="user__new" name="is_block" value="1">
                        </td>
                        <td  class="user__new__title">
                        <select id="permission" name="permission">
                            <option value="0">Thành viên thường</option>
                            <option value="1">Admin cấp 1</option>
                            <option value="2">Admin cấp 2</option>
                        </select>
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="text-center">
                <button class="btn__add__user" name="btn_submit">Thêm Thành Viên</button>
            </div>
		</form>
	
	</div>
</body>