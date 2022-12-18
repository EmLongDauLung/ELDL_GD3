<?php include "header.php" ?>
<?php
if (!isset($_SESSION['cart'])) { //nếu chưa tồn tại tạo 1 session tên cart với 1 mảng rỗng
    $_SESSION['cart'] = array();
}
$error = false;
if (isset($_GET['action'])) {
    function update_cart($add = false)
    {
        foreach ($_POST['quantity'] as $id => $quantity) {
            if ($quantity == 0) {
                unset($_SESSION['cart'][$id]);
            } else {
                if ($add) {
                    $_SESSION['cart'][$id] += $quantity;
                } else {
                    $_SESSION['cart'][$id] = $quantity;
                }
            }
        }
    }
    switch ($_GET['action']) {
        case "add":
            foreach ($_POST['quantity'] as $id => $quantity) {
                $_SESSION['cart'][$id] = $quantity;
            }
            break;
        case "delete":
            if (isset($_GET['id'])) {
                unset($_SESSION['cart'][$_GET['id']]);
            }
            break;
        case "submit":
            if (isset($_POST['update__totalmoney'])) {
                update_cart();
            } elseif (isset($_POST['btn__order'])) {
                if (empty($_POST['name__user']) or empty($_POST['phone__number']) or empty($_POST['address'])) {
                    $error = "Bạn cần nhập đầy đủ thông tin người mua";
                }
                if ($error == false && !empty($_POST['quantity'])) { // xử lý giỏ hàng và lưu vào db
                    $products = mysqli_query($conn, "SELECT * FROM products WHERE product_id IN (" . implode(",", array_keys($_POST['quantity'])) . ")");
                    $total = 0;
                    $orderproducts = array();
                    while ($row = mysqli_fetch_array($products)) {
                        $orderproducts[] = $row;
                        $total += $row['price'] * $_POST['quantity'][$row['product_id']];
                    }
                    $insert_order = mysqli_query($conn, "INSERT INTO `checkout` (`user_id`, `fullname`, `address`, `phone_nb`, `total_money`, `note`,`createdate`, `updatedate`,`status`) VALUES ('" . $_SESSION['user_id'] . "', '" . $_POST['name__user'] . "', '" . $_POST['address'] . "' ,'" . $_POST['phone__number'] . "', '$total', '" . $_POST['note'] . "','" . date("Y-m-d H:i:s") . "', '" . date("Y-m-d H:i:s") . "',0);");
                    $orderID = $conn->insert_id;
                    $insertString = "";
                    foreach ($orderproducts as $key => $products) {
                        $insertString .= "('" . $orderID . "','" . $products['product_id'] . "', '" . $_POST['quantity'][$products['product_id']] . "' , '" . $products['price'] . "','" . date("Y-m-d H:i:s") . "', '" . date("Y-m-d H:i:s") . "')";
                        if ($key != count($orderproducts) - 1) {
                            $insertString .= ",";
                        }
                    }
                    $insert_order_detail =  mysqli_query($conn, "INSERT INTO detail_checkout (checkout_id, product_id, quantity_product, price, createdate, updatedate) VALUES " . $insertString . ";");
                    echo '<script language="javascript">alert("Đặt Hàng Thành Công!");</script>';
                    unset($_SESSION['cart']);
                }
            }
            break;
    }
}
if (!empty($_SESSION['cart'])) {
    $sql_cart = "SELECT * FROM products WHERE product_id IN (" . implode(",", array_keys($_SESSION['cart'])) . ")";
    $products = mysqli_query($conn, $sql_cart);
} else {
    $products = NULL;
}
?>

<body class="body">
    <div class="cart_container">
        <div class="cart_title">Giỏ hàng</div>
        <form action="cart.php?action=submit" method="POST">
            <table class='table'>
                <thead>
                    <tr>
                        <th scope='col'>STT</th>
                        <th scope='col'>Tên sản phẩm</th>
                        <th scope='col'>Ảnh sản phẩm</th>
                        <th scope='col'>Số lượng</th>
                        <th scope='col'>Giá</th>
                        <th scope='col'>Xóa</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $num = 1;
                    $total = 0;
                    if ($products == null) {
                        echo "<div class='product__notnull'>Bạn chưa chọn sản phẩm nào :<</div>";
                    } else {
                        while ($row = mysqli_fetch_array($products)) {
                            $total_product = $row['price'] * $_SESSION['cart'][$row['product_id']];
                            echo "
                                <tr>
                                    <td scope='col'>$num</td>
                                    <td scope='col'>{$row['title']}</td>
                                    <td scope='col'><img src='./assets/img/{$row['image']}'' style ='width: 130px; height: auto;'></td>
                                    <td scope='col'><input type='text' value='{$_SESSION['cart'][$row['product_id']]}' name='quantity[{$row['product_id']}]' size='2' style ='text-align: center;'></td>
                                    <td scope='col'>$total_product</td>
                                    <td scope='col'><a href='cart.php?action=delete&id={$row['product_id']}' style='color:#72af5c;'><i class='fa-solid fa-trash'></i></a></td>
                                </tr>
                                ";
                            $total += $total_product;
                            $num++;
                        }
                        echo "
                            <tr>
                                <td scope='col'>&nbsp;</td>
                                <td scope='col'>Tổng tiền</td>
                                <td scope='col'>&nbsp;</td>
                                <td scope='col'>&nbsp;</td>
                                <td scope='col'>$total</td>
                                <td scope='col'>&nbsp;</td>
                            </tr>
                            ";
                    }
                    ?>
                </tbody>
            </table>
            <?php
            if (!empty($error)) {
                echo "
                <div class='notify_msg'>$error</div>
                ";
            }
            ?>
            <div class="info__order">
                <input class="info_order__input" name="name__user" type="text" placeholder="Tên người nhận"><br>
                <input class="info_order__input" name="phone__number" type="text" placeholder="Số điện thoại"> <br>
                <input class="info_order__input" name="address" type="text" placeholder="Địa chỉ"> <br>
                <textarea class="info_order__input" name="note" id="" cols="30" rows="10" placeholder="Ghi Chú"></textarea>
            </div>
            <div class="text-center">
                <input type="submit" name="update__totalmoney" value="Cập nhật" class="btn__submit__money-order">
                <input type="submit" name="btn__order" value="Đặt hàng" class="btn__submit__money-order">
                <!-- <form action="cart.php" method="post">
                     <input type="hidden" name="send"> 
                    <input type="submit" name="vnpay" class="btn__submit__money-order" value="Thanh toan VNPAY">
                </form>
                <?php
                if (isset($_POST['vnpay'])) {
                    if ($total == 0) {
                        echo '<script language="javascript">alert("Chưa có sản phẩm nào trong giỏ hàng");</script>';
                    } else {
                        $_SESSION['total_money'] = $total;
                        echo '<script language="javascript">window.location.replace("checkout.php");</script>';
                    }
                }
                ?> -->
            </div>
        </form>
    </div>
</body>
<?php include "footer.php" ?>