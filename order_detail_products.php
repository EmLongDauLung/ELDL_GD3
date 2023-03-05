<?php include "./header.php" ?>
<div class="container__profile">
    <div class="container__title">
        <div class="container__title__item">
            <a href="./order_info.php?id=<?php echo $_SESSION['user_id']?>" class="container__profile__title">Quay lại</a>
        </div>
    </div>
    <div class="info__order__table">
        <table class="table table-striped border border-2">
            <tr>
                <td class='text-center'>Tên sản phẩm</td>
                <td class='text-center'>Ảnh sản phẩm</td>
                <td class='text-center'>Giá sản phẩm</td>
                <td class='text-center'>Số lượng</td>
            </tr>
            <?php
            $id = -1;
            if (isset($_GET["id"])) {
                $id = intval($_GET['id']);
            }
            $sql = "select detail_checkout.* , products.title as name_product, products.image as img_product
            from detail_checkout, products, checkout
            where products.product_id = detail_checkout.product_id and checkout.checkout_id = detail_checkout.checkout_id and checkout.checkout_id = $id;
            ";
            $result = mysqli_query($conn, $sql);
            $total = 0;
            while ($row = mysqli_fetch_array($result)) {
                echo "<tr>";
                echo "  <td class='text-center'>" . $row['name_product'] . "</td>";
                echo "  <td class='text-center'>
                            <img src='./assets/img/{$row['img_product']}' style='width: 100px; height: auto;'>
                        </td>";
                echo "  <td class='text-center'>" . $row['price'] . "</td>";
                echo "  <td class='text-center'>" . $row['quantity_product'] . "</td>";
                echo "</tr>";
                $total += $row['price'] * $row['quantity_product'];
            }
            echo"
                <tr>
                    <td scope='col' class='text-center'>Tổng tiền</td>
                    <td scope='col'>&nbsp;</td>
                    <td scope='col' class='text-center'>$total</td>
                    <td scope='col'>&nbsp;</td>
                </tr>
            ";
            ?>
        </table>
    </div>
</div>
<?php include "./footer.php" ?>