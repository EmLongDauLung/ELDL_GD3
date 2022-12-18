<?php include "./header.php" ?>
<div>
    <div class="container__profile">
        <div class="container__title">
            <div class="container__title__item">
                <a href="profile.php" class="container__profile__title">Bài viết của bạn</a>
            </div>
            <div class="container__title__item">
                <a href="./order_info.php" class="container__profile__title">Đơn hàng của bạn</a>
            </div>
        </div>
        <div class="info__order__table">
            <table class="table table-striped table-bordered border border-2">
                <tr>
                    <td class='text-center'>ID</td>
                    <td class='text-center'>Tên người nhận</td>
                    <td class='text-center'>Địa chỉ</td>
                    <td class='text-center'>Điện thoại</td>
                    <td class='text-center'>Ngày tạo</td>
                    <td class='text-center'>Tổng tiền</td>
                    <td class='text-center'>Chi tiết</td>
                    <td class='text-center'>Thanh toán online</td>
                </tr>
                <?php
                // include './dbConnection.php';
                // $dbConnection = new dbConnection();
                // $conn = $dbConnection->getConnection();
                $sql = "SELECT * FROM checkout WHERE user_id = {$_SESSION['user_id']};";
                $result = mysqli_query($conn, $sql);
                while ($row = mysqli_fetch_array($result)) {
                    echo "<tr>";
                    echo "  <td class='text-center'>" . $row['checkout_id'] . "</td>";
                    echo "  <td class='text-center'>" . $row['fullname'] . "</td>";
                    echo "  <td class='text-center'>" . $row['address'] . "</td>";
                    echo "  <td class='text-center'>" . $row['phone_nb'] . "</td>";
                    echo "  <td class='text-center'>" . $row['createdate'] . "</td>";
                    echo "  <td class='text-center'>" . $row['total_money'] . " $</td>";
                    echo "  <td class='text-center'>
                                <a href='order_detail_products.php?id={$row['checkout_id']}' style=' text-decoration: none;color: #397224;'>Xem</a>
                            </td>";
                    if ($row['status'] == 0) {
                        $_SESSION['id_thanhtoan'] = $row['checkout_id'];
                        $_SESSION['total_money'] = $row['total_money'];
                        echo "  <td class='text-center'>
                            <a href='admin/checkout_vnpay/checkout.php?id={$row['checkout_id']}' style='text-decoration: none; color: #397224;'>Thanh toán</a>
                        </td>";
                    } else {
                        echo "  <td class='text-center'>
                                    Đã thanh toán
                                </td>";
                    }
                    echo "</tr>";
                }
                ?>
            </table>
        </div>
    </div>
</div>
<?php include "footer.php" ?>