<?php
    include("header.php");
    include "./permission.php";
    $id = -1;
    // include("dbConnection.php");
    // $dbConnection = new dbConnection();
    // $conn = $dbConnection->getConnection();
    if(isset($_POST['submit_more'])){
        $id = $_POST['id'];
    }
    $sql = "select * from posts where posts_id = $id";
	$query = mysqli_query($conn,$sql);
    $data = mysqli_fetch_assoc($query);
?>
<style>
    .innertube{
        margin: 50px;
    }
</style>
<main class="innertube">
    <div class="showposts" style="width: fit-content; margin: 0 auto;">
        <?php 
            echo "
            <h3>{$data['title']}</h3> </br>
            <i> Ngày tạo: {$data['createdate']}</i>
            <p>{$data['content']}</p>
            <img src='./assets/img/{$data['image']}' alt='' style='width: 200px; height:auto'>
            ";
        ?>
    </div>

    <div class="posts">
		<form action="updateposts.php?userid=<?php echo $_SESSION['user_id']?>" method="POST">
			<table class="table table-bordered table-striped">
				<input type="hidden" name="id" value="<?php echo $data['posts_id'] ?>">
				<tr>
					<td nowrap="nowrap">Tiêu đề bài viết :</td>
					<td>
						<input type="text" id="title" name="title" value="<?php echo $data['title'] ?>">
					</td>
				</tr>
				<tr>
					<td nowrap="nowrap">Nội dung :</td>
					<td><textarea name="post_content" id="post_content" rows="10" cols="150"><?php echo $data['content'] ?></textarea></td>
				</tr>
				<tr>
					<td nowrap="nowrap">Public bài viết ?</td>
					<td><input type="checkbox" id="is_public" name="is_public" value="<?php echo $data['is_public'] ?>"> Public</td>
				</tr>
				<tr>
					<td colspan="2" align="center"><input type="submit" name="btn_update" value="Hoàn tất"></td>
				</tr>
			</table>
		</form>
	</div>
    <script>
	// Replace the <textarea id="editor1"> with a CKEditor
	// instance, using default configuration.
	CKEDITOR.replace('post_content');
    </script>
    <form action="deleteposts.php?userid=<?php echo $_SESSION['user_id']?>" method="POST">
        <input type="hidden" name="id" value="<?php echo $data['posts_id'] ?>">
        <button type="submit" name="del_posts">Xóa bài viết</button>
    </form>
</main>
<?php include("footer.php") ?>