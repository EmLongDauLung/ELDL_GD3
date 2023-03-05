<?php
if (isset($_POST["del_posts"])) {
    $id = $_POST['id'];
    $userid = $_GET['userid'];
    include("dbConnection.php");
    $dbConnection = new dbConnection();
    $conn = $dbConnection->getConnection();
    $sql = "DELETE FROM posts WHERE posts_id = '$id'";
    mysqli_query($conn,$sql);
    echo '<script language="javascript">alert("Xóa bài viết thành công!");</script>';
    header("Location: profile.php?id=$userid");
}
?>