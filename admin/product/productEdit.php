<?php
session_start();
// include "./header.php";
include "../../permission.php";
include '../../dbConnection.php';
$dbConnection = new dbConnection();
$conn = $dbConnection->getConnection();
$id = -1;
if (isset($_GET["id"])) {
    $id = intval($_GET['id']);
}

$sql = "select * from products where product_id = '$id'";
$query = mysqli_query($conn, $sql);
$data = mysqli_fetch_assoc($query);
?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>ADMIN PAGE</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
</head>

<body>
    <nav class="navbar navbar-expand-lg bg-dark">
        <div class="container-fluid ">
            <a class="navbar-brand text-white" href="#">Navbar</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link text-white navlinks" href="#">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-white navlinks" href="../order/order.php">Đơn Hàng</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-white navlinks" href="addProducts.php">Product</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-white navlinks" href="../../index.php">Return to shop</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <div class="posts">
        <form enctype="multipart/form-data" method="post" class="form m-3">
            <table cellspacing="5" cellpadding="5" class="table table-bordered  w-600">
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
                        <input type="file" name="image" class="hinhanh" require value="../../assets/img/<?php echo $data['type'] ?>"><br /><br />
                    </td>
                </tr>
                <tr>
                    <td colspan="2" align="center">
                        <input type="submit" name="btn_edit" value="Save" class="btn btn-secondary" />
                        <input type="submit" name="btn_edit_normal" value="Save No Image" class="btn btn-secondary" />
                    </td>
                </tr>
            </table>
        </form>
        <?php require 'productProcess.php'; ?>
    </div>
    <script>
        CKEDITOR.replace('post_content');
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
</body>

</html>