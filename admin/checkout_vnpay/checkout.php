<?php
session_start();

include("../../dbConnection.php");
$dbConnection = new dbConnection();
$conn = $dbConnection->getConnection();
$id = -1;
if (isset($_GET["id"])) {
    $id = intval($_GET['id']);
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BOT STORE</title>
    <!-- Latest compiled JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
</head>
<style>
    a:hover {
        direction: none;
    }
</style>

<body>

    <div class="container w-50 mt-5 flex-row d-flex justify-content-center" style="align-items: center;justify-content: center; background-color: #f6f7fb;border-radius: 10px;">
        <img src="../../assets/img/VNPAY.webp" alt="vnpay" class="w-25 h-25 ">
        <div class="mx-5">
            <form style="margin-top: 40px;" method="POST" action="process_checkout.php">
                <div class="form-group mb-3">
                    <label style="font-size: 18px">HỌ VÀ TÊN</label>
                    <input style="font-size: 14px;" type="text" class="form-control w-100" placeholder="Nhập họ tên" name="name_receiver" required>
                </div>
                <div class="form-group mb-3">
                    <label style="font-size: 18px">SỐ ĐIỆN THOẠI</label>
                    <input style="font-size: 14px;" type="text" class="form-control w-100" name="phone_number_receiver" placeholder="Nhập số điện thoại" required onkeypress="return (event.charCode !=8 && event.charCode ==0 || (event.charCode >= 48 && event.charCode <= 57))" maxlength="10" minlength="10" />
                </div>

                <div class="form-group mb-3">
                    <label style="font-size: 18px">ĐỊA CHỈ NHẬN HÀNG</label>
                    <input style="font-size: 14px;" type="text" class="form-control w-100" placeholder="Nhập địa chỉ" name="address_receiver" required>
                </div>

                <div class="form-group mb-3" style="width: 300px;">
                    <label style="font-size: 18px">NGÂN HÀNG</label>
                    <select name="bank_code" id="bank_code" class="form-select" required>
                        <option value="NCB">Không chọn</option>
                        <option value="NCB"> Ngan hang NCB</option>
                        <option value="VISA"> Thanh toan qua VISA/MASTER</option>
                        <option value="AGRIBANK"> Ngan hang Agribank</option>
                        <option value="SCB"> Ngan hang SCB</option>
                        <option value="SACOMBANK">Ngan hang SacomBank</option>
                        <option value="EXIMBANK"> Ngan hang EximBank</option>
                        <option value="MSBANK"> Ngan hang MSBANK</option>
                        <option value="NAMABANK"> Ngan hang NamABank</option>
                        <option value="VNMART"> Vi dien tu VnMart</option>
                        <option value="VIETINBANK">Ngan hang Vietinbank</option>
                        <option value="VIETCOMBANK"> Ngan hang VCB</option>
                        <option value="HDBANK">Ngan hang HDBank</option>
                        <option value="DONGABANK"> Ngan hang Dong A</option>
                        <option value="TPBANK"> Ngân hàng TPBank</option>
                        <option value="OJB"> Ngân hàng OceanBank</option>
                        <option value="BIDV"> Ngân hàng BIDV</option>
                        <option value="TECHCOMBANK"> Ngân hàng Techcombank</option>
                        <option value="VPBANK"> Ngan hang VPBank</option>
                        <option value="MBBANK"> Ngan hang MBBank</option>
                        <option value="ACB"> Ngan hang ACB</option>
                        <option value="OCB"> Ngan hang OCB</option>
                        <option value="IVB"> Ngan hang IVB</option>
                    </select>
                </div>
                <div class="form-group d-flex flex-row mb-3 fs-5 text">
                    <label class="me-3">TỔNG TIỀN</label>
                    <div>
                        <?php
                        $sql = "SELECT total_money FROM checkout WHERE checkout_id = $id";
                        $result = mysqli_query($conn, $sql);
                        $row = mysqli_fetch_array($result);
                        echo $row['total_money'];
                        ?>
                    </div>
                </div>
                <button class="btn btn-success" name="redirect" id="redirect" style="margin-bottom: 10px;">THANH TOÁN</button>
            </form>
            <a href="../../order_info.php"><button style="margin-top: -86px;margin-left: 145px;" class="btn btn-secondary">QUAY LẠI</button></a>
        </div>
    </div>

</body>

</html>