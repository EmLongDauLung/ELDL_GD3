<?php
session_start();
require_once('../../dbConnection.php');
date_default_timezone_set('Asia/Ho_Chi_Minh');
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

$vnp_TmnCode = "WAVHY2N6"; //Website ID in VNPAY System
$vnp_HashSecret = "RDDUIQQZHQNCVPGLVWNAQLEVDHHLGUAC"; //Secret key
$vnp_Url = "https://sandbox.vnpayment.vn/paymentv2/vpcpay.html";
//
$vnp_Returnurl = "http://localhost/STUDYDOC/WebNC-php-TEST/admin/checkout_vnpay/vnpay_return.php";
//
$vnp_apiUrl = "http://sandbox.vnpayment.vn/merchant_webapi/merchant.html";
//Config input format
//Expire
$startTime = date("YmdHis");
$expire = date('YmdHis', strtotime('+15 minutes', strtotime($startTime)));
$code_order = rand(0, 9999);

$cart = "";
$total = 0;
if (isset($_SESSION['total_money'])) {
    $total_money = $_SESSION['total_money'];
}
var_dump($total_money);
// if (is_array($cart) || is_object($cart))
//     foreach ($cart as $id => $each) :
//         $sum = $each['gia'] * $each['so_luong'];
//         $total += $sum;
//     endforeach;
$vnp_TxnRef = $code_order; //Mã đơn hàng. Trong thực tế Merchant cần insert đơn hàng vào DB và gửi mã này sang VNPAY
$vnp_OrderInfo = 'Thanh toán đơn hàng tại Website';
$vnp_OrderType = 'billpayment';
$vnp_Amount = $total_money * 24000 * 100;
$vnp_Locale = 'vn';
$vnp_BankCode = $_POST['bank_code'];
$vnp_IpAddr = $_SERVER['REMOTE_ADDR'];

$vnp_ExpireDate = $expire;

$inputData = array(
    "vnp_Version" => "2.1.0",
    "vnp_TmnCode" => $vnp_TmnCode,
    "vnp_Amount" => $vnp_Amount,
    "vnp_Command" => "pay",
    "vnp_CreateDate" => date('YmdHis'),
    "vnp_CurrCode" => "VND",
    "vnp_IpAddr" => $vnp_IpAddr,
    "vnp_Locale" => $vnp_Locale,
    "vnp_OrderInfo" => $vnp_OrderInfo,
    "vnp_OrderType" => $vnp_OrderType,
    "vnp_ReturnUrl" => $vnp_Returnurl,
    "vnp_TxnRef" => $vnp_TxnRef,
    "vnp_ExpireDate" => $vnp_ExpireDate

);

if (isset($vnp_BankCode) && $vnp_BankCode != "") {
    $inputData['vnp_BankCode'] = $vnp_BankCode;
}

ksort($inputData);
$query = "";
$i = 0;
$hashdata = "";
foreach ($inputData as $key => $value) {
    if ($i == 1) {
        $hashdata .= '&' . urlencode($key) . "=" . urlencode($value);
    } else {
        $hashdata .= urlencode($key) . "=" . urlencode($value);
        $i = 1;
    }
    $query .= urlencode($key) . "=" . urlencode($value) . '&';
}

$vnp_Url = $vnp_Url . "?" . $query;

$returnData = array(
    'code' => '00', 'message' => 'success', 'data' => $vnp_Url
);
if (isset($vnp_HashSecret)) {
    $vnpSecureHash =   hash_hmac('sha512', $hashdata, $vnp_HashSecret); //  
    $vnp_Url .= 'vnp_SecureHash=' . $vnpSecureHash;
}

$checkout = 'Thanh toán vnpay';
if (isset($_POST['redirect'])) {
    $name_receiver = $phone_number_receiver = $address_receiver = "";
    if (isset($_POST['name_receiver'])) {
        $name_receiver = $_POST['name_receiver'];
    }
    if (isset($_POST['phone_number_receiver'])) {
        $phone_number_receiver = $_POST['phone_number_receiver'];
    }
    if (isset($_POST['address_receiver'])) {
        $address_receiver = $_POST['address_receiver'];
    }
    // SQL
    $_SESSION['code_cart'] = $code_order;
    // $customer_id = $_SESSION['id'];
    // $status = 0;
    // $sql = "insert into orders(customer_id, name_receiver, phone_receiver, address_receiver, status, total_price,cart_payment)
    // values ('$customer_id', '$name_receiver', '$phone_number_receiver', '$address_receiver', '$status', '$total','$checkout')";
    // mysqli_query($connect, $sql);
    // $sql = "select max(id) from orders where customer_id = '$customer_id'";
    // $result = mysqli_query($connect, $sql);
    // $order_id = mysqli_fetch_array($result)['max(id)'];
    // foreach ($cart as $product_id => $each) {
    //     $quantity = $each['so_luong'];
    //     $sql = "insert into order_product(order_id,product_id,quantity) values('$order_id','$product_id','$quantity')";
    //     mysqli_query($connect, $sql);
    // }
    // mysqli_close($connect);
    // unset($_SESSION['cart']);
    header('Location: ' . $vnp_Url);
    die();
} else {
    echo json_encode($returnData);
}
