<?php
// session_start(); 
include "./header.php";
include "./permission.php";

if (isset($_POST["btn_submit"])) {
	//lấy thông tin từ các form bằng phương thức POST
	$title = $_POST["title"];
	$content = $_POST["post_content"];
	$is_public = 0;
	if (isset($_POST["is_public"])) {
		$is_public = $_POST["is_public"];
	}

	$user_id = $_SESSION["user_id"];

	$sql = "INSERT INTO posts(title, content, user_id, is_public, createdate, updatedate ) VALUES ( '$title', '$content', '$user_id', '$is_public', now(), now())";
	// thực thi câu $sql với biến conn lấy từ file connection.php
	mysqli_query($conn, $sql);
	echo '<script language="javascript">alert("Đăng bài thành công!"); window.location="posts.php";</script>';
}
if (isset($_POST['photoUp'])) {
	//
	$title = $_POST["title"];
	$content = $_POST["post_content"];
	$is_public = 0;
	if (isset($_POST["is_public"])) {
		$is_public = $_POST["is_public"];
	}
	$user_id = $_SESSION["user_id"];
	// Upload ảnh 
	$image = $_FILES['imageUpload']['name'];
	$errors = array();
	$file_name = $_FILES['imageUpload']['name'];
	$file_size = $_FILES['imageUpload']['size'];
	$file_tmp = $_FILES['imageUpload']['tmp_name'];
	$file_type = $_FILES['imageUpload']['type'];
	$file_ext = strtolower(end(explode('.', $_FILES['imageUpload']['name'])));

	$expensions = array("jpeg", "jpg", "png");

	if (in_array($file_ext, $expensions) === false) {
		$errors[] = "Chỉ hỗ trợ upload file JPEG hoặc PNG.";
	}

	if ($file_size > 2097152) {
		$errors[] = 'Kích thước file không được lớn hơn 2MB';
	}
	$target = "./assets/img/".basename($image);
	$sql = "INSERT INTO posts( title, content, image,user_id, is_public, createdate, updatedate ) VALUES ( '$title', '$content', '$image', '$user_id',  '$is_public' , now(), now())";
	if (mysqli_query($conn, $sql) && move_uploaded_file($_FILES['imageUpload']['tmp_name'], $target) && empty($errors) == true) {
		echo '<script language="javascript">alert("Đăng bài viết thành công!"); window.location="posts.php";</script>';
	} else {
		echo '<script language="javascript">alert("Có lỗi trong quá trình xử lý");</script>';
	}
}
?>

<body>
	<div class="posts">
		<form method="POST" action="addposts-ck.php" enctype="multipart/form-data">
			<table class="table table-bordered table-striped">
				<tr>
					<td colspan="2">
						<h3>Thêm bài viết mới</h3>
					</td>
				</tr>
				<tr>
					<td nowrap="nowrap">Tiêu đề bài viết :</td>
					<td><input type="text" id="title" name="title"></td>
				</tr>
				<tr>
					<td nowrap="nowrap">Nội dung :</td>
					<td><textarea name="post_content" id="post_content" rows="10" cols="150"></textarea></td>
				</tr>
				<tr>
					<td nowrap="nowrap">Public bài viết ?</td>
					<td><input type="checkbox" id="is_public" name="is_public" value="1" checked> Public</td>
				</tr>
				<tr>
					<td>Ảnh (png or jpeg)</td>
					<td>
						<input type="hidden" name="size" value="1000000">
						<input type="file" name="imageUpload">
					</td>
				</tr>
				<tr>
					<td colspan="2" align="center">
						<input type="submit" name="btn_submit" value="Thêm bài viết">
						<input type="submit" name="photoUp" value="Thêm bài viết có ảnh">
					</td>
				</tr>

			</table>
		</form>
	
	</div>
</body>
<script>
	CKEDITOR.replace('post_content');
</script>
<?php include "./footer.php" ?>