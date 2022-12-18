<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
    <link rel="icon" href="../assets/img/small_logo.png">
    <title>Document</title>
</head>

<body>
    <div class="container-fluid">
        <div class="row flex-nowrap">
            <div class="col-auto col-md-3 col-xl-2 px-sm-2 px-0 bg-dark">
                <div class="d-flex flex-column align-items-center align-items-sm-start px-3 pt-2 text-white min-vh-100">
                    <a href="/" class="d-flex align-items-center pb-3 mb-md-0 me-md-auto text-white text-decoration-none">
                        <span class="fs-5 d-none d-sm-inline">Menu</span>
                    </a>
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <a class="nav-link text-white navlinks" href="home.php">Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-white navlinks" href="order/order.php">Đơn Hàng</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-white navlinks" href="product/addProducts.php">Product</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-white navlinks" href="user/dashboard-fix.php">User</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-white navlinks" href="../index.php">Return to shop</a>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="col p-0">
                <?php
                include "index.php";
                ?>
            </div>
        </div>
    </div>
</body>

</html>