<?php
session_start();
include "../../permission.php";
include '../../dbConnection.php';
include "../header.php";
$dbConnection = new dbConnection();
$conn = $dbConnection->getConnection();

?>
<!-- BODY -->
<div>
    <!-- ADD form -->
    <h2 class="ms-3 mt-2">Thêm sản phẩm</h2>
    <form enctype="multipart/form-data" method="post" class="form m-3">
        <table cellspacing="5" cellpadding="5" class="table table-bordered  w-600">
            <tr>
                <td class="w-25">Tên sản phẩm </td>
                <td width="w-auto"><input type="text" name="title" class="w-75" require /></td>
            </tr>
            <tr>
                <td>Số lượng</td>
                <td><input type="number" name="quantity" class="w-25" placeholder="0-1000" require></td>
            </tr>
            <tr>
                <td>Giá</td>
                <td><input type="number" name="oldprice" class="w-25" require min="0"></td>
            </tr>
            <tr>
                <td>Giá khuyến mãi</td>
                <td><input type="number" name="price" class="w-25" min="0"></td>
            </tr>
            <tr>
                <td>Nội dung</td>
                <td><textarea name="content" id="content" placeholder="Đây là nội dung sản phẩm..." class="noidung w-75" rows="10" cols="80" require></textarea></td>
            </tr>
            <tr>
                <td>Đánh giá (0-5)</td>
                <td><input type="number" name="star" class="w-25" min="0" max="5" require></td>
            </tr>
            <tr>
                <td>Loại</td>
                <td><input type="text" name="type" class="w-25" require></td>
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
                    <input type="file" name="image" class="hinhanh" require><br /><br />
                </td>
            </tr>
            <tr>
                <td colspan="2" align="center"><input type="submit" name="btn_submit" value="Thêm sản phẩm" class="btn btn-secondary" /></td>
            </tr>
        </table>
    </form>
    <?php require '../../admin/product/productProcess.php'; ?>
    <div class="w-100">
        <div class="noidung m-5">
            <table class="table table-striped table-bordered border border-2">
                <tr>
                    <td>Mã sản phẩm</td>
                    <td>Tên sản phẩm</td>
                    <td>Mô tả</td>
                    <td>Số lượng</td>
                    <td>Giá</td>
                    <td>Giá giảm</td>
                    <td>Đánh giá</td>
                    <td>Loại</td>
                    <td>Nhà sản xuất</td>
                    <td>Ảnh</td>
                    <td>Edit</td>
                    <td>Delete</td>
                </tr>
                <?php
                $sql = "SELECT * FROM products";
                $result = mysqli_query($conn, $sql);
                while ($row = mysqli_fetch_array($result)) {
                    echo "<tr>";
                    echo "<td><p>" . $row['product_id'] . "</p></td>";
                    echo "<td><p>" . $row['title'] . "</p></td>";
                    echo "<td><p>" . $row['content'] . "</p></td>";
                    echo "<td><p>" . $row['quantity'] . "</p></td>";
                    echo "<td><p>" . $row['oldprice'] . "</p></td>";
                    echo "<td><p>" . $row['price'] . "</p></td>";
                    echo "<td><p>" . $row['star'] . "</p></td>";
                    echo "<td><p>" . $row['type'] . "</p></td>";
                    echo "<td><p>" . $row['trademark_id'] . "</p></td>";
                    echo "<td><img src='../../assets/img/" . $row['image'] . "' height=100></td>";
                    echo '<td><a href="productEdit.php?id=' . $row['product_id'] . '">Edit</a></td>  <td><a href="product_delete.php?id=' . $row['product_id'] . '">Delete</a></td>';
                    echo "</tr>";
                }
                ?>
            </table>
        </div>
    </div>
</div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
</body>

</html>