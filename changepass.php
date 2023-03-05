<?php
    include"header.php";

    if(isset($_POST["submit"])){
        $password = $_POST['password'];
        $sql = "UPDATE users SET password = '$password' WHERE user_id = '{$_SESSION['user_id']}'";
        var_dump($sql);
        $query = mysqli_query($conn,$sql);
    }
?>
<style>
    .changepass{
        width: 50%;
        height: auto;
        margin: 50px auto;
    }
</style>
<body>
<div>
    <div class="container__profile">
        <div class="container__title">
            <div class="container__title__item">
                <a href="profile.php?id=<?php echo $_SESSION['user_id']?>" class="container__profile__title">Bài viết của bạn</a>
            </div>
            <div class="container__title__item">
                <a href="./order_info.php?id=<?php echo $_SESSION['user_id']?>" class="container__profile__title">Đơn hàng của bạn</a>
            </div>
            <div class="container__title__item">
                <a href="changepass.php?id=<?php echo $_SESSION['user_id']?>" class="container__profile__title">Đổi mật khẩu</a>
            </div>
        </div>
        <div class="info__order__table">
            <div class="changepass">
                <form action="changepass.php" method="POST">
                    <input type="password" name="password">
                    <button type='submit' name="submit"> Change </button>
                </form>
            </div>
        </div>
    </div>
</body>
<?php include"footer.php" ?>