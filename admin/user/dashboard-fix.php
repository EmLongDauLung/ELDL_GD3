<?php
include("../../dbConnection.php");
$dbConnection = new dbConnection();
$conn = $dbConnection->getConnection();
?>
<?php include "../header.php" ?>

<div class="container">
    <div class="page-header">
        <h2 class="pull-left">Người dùng</h2>
        <a href="adduser.php" class="btn btn-success pull-right">Thêm người dùng</a>
    </div>
    <?php
    $sql = "SELECT * FROM users";
    $query = mysqli_query($conn, $sql);
    ?>
    <table class="table table-bordered table-striped">
        <thead>
            <tr>
                <!-- <td></td> -->
                <td>Username</td>
                <td>Password</td>
                <td>Fullname</td>
                <td>Email</td>
                <td>Is_Block</td>
                <td>Permision</td>
                <td>Option</td>
            <tr>
        </thead>
        <tbody>
            <?php
            while ($data = mysqli_fetch_array($query)) {
                $id = $data['user_id'];
            ?>
                <tr>
                    <form action="edit_user.php" method="POST">
                        <input type="hidden" name="id" value="<?php echo $data['user_id']; ?>">
                        <td><?php echo $data['username']; ?></td>
                        <td><?php echo $data['password']; ?></td>
                        <td><?php echo $data['fullname']; ?></td>
                        <td><?php echo $data['email']; ?></td>
                        <td><?php echo ($data['is_block'] == 1) ? "Bị khóa" : "Không bị khóa"; ?></td>
                        <td><?php echo ($data['permision'] == 0) ? "Thành viên thường" : "Admin"; ?></td>
                        <td>
                            <button type="submit" name="btn_submit"><i class='fa-solid fa-wrench icon_option'></i></button>
                        </td>
                    </form>
                </tr>
            <?php
            }
            ?>
        </tbody>
    </table>
</div>
</body>