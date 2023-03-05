<?php
    include("dbConnection.php");
    $dbConnection = new dbConnection();
    $conn = $dbConnection->getConnection();
    // include("header.php");
	$id = $_GET['id'];
	// Lấy ra nội dung bài viết theo điều kiện id
	$sql = "select * from posts where posts_id = $id"; var_dump($sql);  
	// Thực hiện truy vấn data thông qua hàm mysqli_query
	$query = mysqli_query($conn,$sql);
?>
<style>
    .innertube{
        margin: 50px;
    }
</style>
<main class="innertube">
    <div class="showposts" style="width: fit-content; margin: 0 auto;">
        <?php 
            while ( $data = mysqli_fetch_array($query) ) {
                echo "
                <h3>{$data['title']}</h3> </br>
                <i> Ngày tạo: {$data['createdate']}</i>
                <p>{$data['content']}</p>
                <img src='./assets/img/{$data['image']}' alt='' style='width: 200px; height:auto'>
                ";
            }
        ?>
    </div>
</main>
