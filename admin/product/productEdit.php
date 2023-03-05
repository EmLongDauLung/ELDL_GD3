<?php
session_start();
include "../header.php";
include "../../permission.php";
include '../../dbConnection.php';
$dbConnection = new dbConnection();
$conn = $dbConnection->getConnection();
$id = -1;
if (isset($_POST['btn_optionEdit'])) {
    $id = $_POST['btn_optionEdit'];
}

$sql = "select * from products where product_id = '$id'";
$query = mysqli_query($conn, $sql);
$data = mysqli_fetch_assoc($query);
?>
    <div class="posts">
        <form enctype="multipart/form-data" method="post" class="form m-3" action="">
            <table cellspacing="5" cellpadding="5" class="table table-bordered  w-600">
                <input type="hidden" value="<?php echo $data['product_id'] ?>" name="id">
                <tr>
                    <td class="w-25">Tên sản phẩm </td>
                    <td width="w-auto"><input type="text" name="title" class="w-75" require value="<?php echo $data['title'] ?>" /></td>
                </tr>
                <tr>
                    <td>Số lượng</td>
                    <td><input type="number" name="quantity" class="w-25" placeholder="0-1000" require value="<?php echo $data['quantity'] ?>"></td>
                </tr>
                <tr>
                    <td>Giá</td>
                    <td><input type="number" name="oldprice" class="w-25" require min="0" value="<?php echo $data['oldprice'] ?>"></td>
                </tr>
                <tr>
                    <td>Giá khuyến mãi</td>
                    <td><input type="number" name="price" class="w-25" min="0" value="<?php echo $data['price'] ?>"></td>
                </tr>
                <tr>
                    <td>Nội dung</td>
                    <td><textarea name="content" id="content" placeholder="Đây là nội dung sản phẩm..." class="noidung w-75" rows="10" cols="80" require>
                        <?php
                        $trimmed = trim($data['content']);
                        echo $trimmed ?>
                    </textarea></td>
                </tr>
                <tr>
                    <td>Đánh giá (0-5)</td>
                    <td><input type="number" name="star" class="w-25" min="0" max="5" require value="<?php echo $data['star'] ?>"></td>
                </tr>
                <tr>
                    <td>Loại</td>
                    <td><input type="text" name="type" class="w-25" require value="<?php echo $data['type'] ?>"></td>
                </tr>
                <tr>
                    <td>Hãng sản xuất</td>
                    <td>
                        <!-- <input type="option" name="star" class="w-25" require> -->
                        <select id="brand" require name="trademark" class="p-2">
                            <option value="1">Lego</option>
                            <option value="2">Shoppe</option>
                            <option value="3">Tiki</option>
                            <option value="4">Lazada</option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td>Ảnh (only png, jpeg or jpg)</td>
                    <td>
                        <input type="hidden" name="size" value="1000000">
                        <img src="../../assets/img/<?php echo $data['image'] ?>" alt="" style="width: 150px; height: auto;">
                        <input type="file" name="image" class="hinhanh"><br /><br />
                    </td>
                </tr>
                <tr>
                    <td colspan="2" align="center">
                        <input type="submit" name="btn_edit" value="Hoàn tất" class="btn btn-secondary" />
                    </td>
                </tr>
            </table>
            <?php require_once "productProcess.php" ?>
        </form>
    </div>
    <script>
        CKEDITOR.replace('post_content');
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
</body>

</html>