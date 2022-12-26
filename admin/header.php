<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>User</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="../../assets/fontawesome-free-6.1.1/css/all.min.css">
    <link rel="icon" href="../../assets/img/small_logo.png">
    <link rel="stylesheet" href="../../assets/css/manageruser.css">
    <link rel="stylesheet" href="main.css">
    <style type="text/css">
        .btn {
            margin: 0px 0 16px 0px;
        }

        .icon_option {
            color: #72af5c;
            font-size: 18px;
        }

        .icon_option:hover {
            color: #397224;
        }

        .wrapper {
            width: 650px;
            margin: 0 auto;
        }

        .page-header h2 {
            margin-top: 16px;
        }

        table tr td:last-child a {
            margin-right: 15px;
        }
    </style>
    <script type="text/javascript">
        $(document).ready(function() {
            $('[data-toggle="tooltip"]').tooltip();
        });
    </script>
</head>
<!-- NAV BAR -->
<nav class="navbar navbar-expand-lg bg-dark">
    <div class="container-fluid ">
        <a class="navbar-brand text-white" href="#">ADMIN</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link text-white navlinks" href="../home.php">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-white navlinks" href="../order/order.php">Đơn Hàng</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-white navlinks" href="../../admin/product/addProducts.php">Product</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-white navlinks" href="../user/dashboard-fix.php">User</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-white navlinks" href="../../index.php">Return to shop</a>
                </li>
            </ul>
        </div>
    </div>
</nav>
<div>