<?php
include("header.php");
// Lấy 8 bài viết mới nhất đã được phép public ra ngoài từ bảng posts
$sql = "select * from posts where is_public = 1 order by createdate desc limit 8";
// Thực hiện truy vấn data thông qua hàm mysqli_query
$query = mysqli_query($conn, $sql);


if (isset($_GET['submit'])) {
    $search = $_GET['searchblog'];
    if (empty($search)) {
        echo "Bạn chưa nhập thông tin";
    } else {
        $query = "SELECT * FROM posts WHERE title LIKE '%$search%';";
        // var_dump($query); echo"<br/>";
        $sql = mysqli_query($conn,$query);
        $num = mysqli_num_rows($sql);
        if($num > 0)
        {
            while($data = mysqli_fetch_assoc($sql)){
                echo "
                <div style='width: fit-content; margin: 50px auto; border-bottom: solid 1px #397224;padding-bottom:5px'>
                    <h3>{$data['title']}</h3> </br>
                    <i> Ngày tạo: {$data['createdate']}</i>
                    <p>{$data['content']}</p>
                    <img src='./assets/img/{$data['image']}' alt='' style='width: 200px; height:auto'>
                </div>
                
                ";
            }
        }
        else{
            echo "Không có kết quả";
        }
    }
}
?>

<style>
    .container_posts {
        margin: 50px;
    }

    .container_posts__add-link {
        text-decoration: none;
        color: white;
        width: 200px;
        height: auto;
        padding: 12px;
        font-size: 24px;
        font-weight: 600;
        text-align: center;
        background-color: #72af5c;
        border-radius: 8px;
    }

    .container_posts__add-link:hover {
        background-color: #397224;
        color: white;
    }

    .container_posts__add {
        margin-top: 40px;
    }
    .search_blog{
        margin: 20px 0;
        width: 300px;
        height: auto;
        padding: 8px;
        border-radius: 8px;
        border: 1px solid gray;

    }
    .search_blog:focus{
    outline: none;
    border: solid 1px #72af5c;
}
</style>
<main>
    <div class="container_posts">
        <form action="posts.php" method="GET">
            <input type="text" name="searchblog" placeholder="Tìm kiếm bài viết" class="search_blog">
            <button type=submit name="submit">OK</button>
        </form>
        <?php 
        echo "
            <span>Kết quả cho: </span>
            <span id='searchMessage'></span>
            <script>
                function doSearchQuery(query) {
                    document.getElementById('searchMessage').innerHTML = query;
                }
                var query = (new URLSearchParams(window.location.search)).get('searchblog');
                if(query) {
                    doSearchQuery(query);
                }
            </script>
            ";
        ?>
        <div class="w-100">
            <div class="noidung">
                <table class="table table-striped table-bordered border border-2">
                    <tr>
                        <td>Tiêu đề:</td>
                        <td>Nội dung:</td>
                        <td>Hình ảnh:</td>
                        <td>Xem bài viết</td>
                    </tr>
                    
                    <?php
                    // include './dbConnection.php';
                    // $dbConnection = new dbConnection();
                    // $conn = $dbConnection->getConnection();
                    $sql = "SELECT * FROM posts WHERE posts_id";
                    $result = mysqli_query($conn, $sql);
                    while ($row = mysqli_fetch_array($result)) {
                        echo "<tr>";
                        echo "  <td><h2>" . $row['title'] . "</h2></td>";
                        echo "  <td><p>" . $row['content'] . "</p></td>";
                        echo "  <td><img src='./assets/img/" . $row['image'] . "' height=100></td>";
                        echo "  <td>
                                    <a href='showposts.php?id={$row['posts_id']}'>Xem thêm</a>
                                </td>";
                        echo "</tr>";
                    }
                    ?>
                </table>
            </div>
        </div>
        <div class="container_posts__add">
            <a href="./addposts-ck.php" class="container_posts__add-link">Thêm bài viết</a>
        </div>
    </div>

</main>
<?php include "footer.php" ?>