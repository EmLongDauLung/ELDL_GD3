<!-- body -->
<div class="header_bot">
    <div class="header_bot-review">
        <img src="./assets/img/lego1.jpg" , alt="" id="img__bgreview">
        <div class="arrow_slide arrow_slide-left">
            <i class="fa-solid fa-chevron-left icon_arrow-slide" onclick="prev()"></i>
        </div>
        <div class="arrow_slide arrow_slide-right">
            <i class="fa-solid fa-chevron-right icon_arrow-slide" onclick="next()"></i>
        </div>
    </div>
</div>
<div id="body">
    <!-- body-top -->
    <div class="body_top">
        <!-- DEAL -->
        <div class="body_top-deal">
            <div class="body_top-title">
                <div class="body_top-title-left">
                    <i class="fa-solid fa-bolt-lightning icon_top-title"></i>
                    Ưu đãi
                </div>
                <div class="body_top-title-right">
                    <a href="#" class="body_top-title-right-item">Xem tất cả
                        <i class="fa-solid fa-caret-right icon_arrow-viewall"></i>
                    </a>
                </div>
            </div>
            <div class="body_bot-deal-child">
                <?php
                // include("dbConnection.php");
                // $dbConnection = new dbConnection();
                // $conn = $dbConnection->getConnection();

                $sql = "SELECT * FROM products WHERE type = 'ưu đãi' order by product_id desc limit 4;";
                $query = mysqli_query($conn, $sql);
                if (mysqli_num_rows($query) == 0) {
                    echo "Hiện chúng tôi không có ưu đãi cho sản phẩm nào :>>";
                } else {
                    while ($data = mysqli_fetch_assoc($query)) {
                        echo "
                                <div class='products'>
                                    <a href='order_detail.php?id={$data['product_id']}'>
                                        <img src='./assets/img/{$data['image']}' alt='' class='img_products'>
                                    </a>
                                    <div class='describe_products'>
                                        <div class='ratings_products'>
                                            <span>{$data['title']}</span>
                                            <span>{$data['star']} <i class='fa-solid fa-star icon_star'></i></span>
                                            <div>
                                                <span class='info_price'>{$data['price']}$</span>
                                                <span class='oldprice'>{$data['oldprice']}$</span>
                                            </div>
                                        </div>
                                        <div class='add_like_products'>
                                            <i class='fa-regular fa-heart icon_heart'></i>
                                            <button class='btn_deal-item'><i class='fa-solid fa-plus icon_addcart'></i></button>
                                        </div>
                                    </div>
                                </div>
                            ";
                    }
                }
                ?>
            </div>
        </div>
        <!-- END DEAL -->
        <!-- TOP sản phẩm -->
        <div class="body_top-ratings-brands">
            <div class="body_top-ratings-brands-child">
                <div class="body_top-title">
                    <div class="body_top-title-left">
                        <i class="fa-solid fa-medal icon_top-title"></i>
                        Sản phẩm hàng đầu
                    </div>
                    <div class="body_top-title-right">
                        <a href="#" class="body_top-title-right-item">Xem tất cả
                            <i class="fa-solid fa-caret-right icon_arrow-viewall"></i>
                        </a>
                    </div>
                </div>
                <div class="body_bot-ratings">
                    <?php
                    $sql = "SELECT * FROM products WHERE type = 'top sản phẩm' order by product_id desc limit 4;";

                    $query = mysqli_query($conn, $sql);
                    if (mysqli_num_rows($query) == 0) {
                        echo "Hiện chúng tôi không có sản phẩm nào";
                    } else {
                        while ($data = mysqli_fetch_assoc($query)) {
                            echo "
                                <div class='body_bot-ratings-item'>
                                    <a href='order_detail.php?id={$data['product_id']}'>
                                        <img src='./assets/img/{$data['image']}' class='img_ratings-item'>
                                    </a>
                                    <div class='body_bot-ratings-info'>
                                        <span class='ratings-info_text'>{$data['title']}</span>
                                        <span>{$data['star']} <i class='fa-solid fa-star icon_star'></i> |
                                        <span class='info_price'>{$data['price']}$</span>
                                    </div>
                                </div>
                                ";
                        }
                    }
                    ?>
                </div>
            </div>
            <div class="body_top-ratings-brands-child">
                <div class="body_top-title">
                    <div class="body_top-title-left">
                        <i class="fa-solid fa-star-of-david icon_top-title"></i>
                        Thương hiệu nổi bật
                    </div>
                    <div class="body_top-title-right">
                        <a href="#" class="body_top-title-right-item">Xem tất cả
                            <i class="fa-solid fa-caret-right icon_arrow-viewall"></i>
                        </a>
                    </div>
                </div>
                <div class="body_bot-brands-info">
                    <?php
                    $sql = "SELECT * FROM trademark order by trademark_id asc limit 2;";
                    $query = mysqli_query($conn, $sql);
                    if (mysqli_num_rows($query) == 0) {
                        echo "Hiện chúng tôi đã phá sản và không còn nhà tài trợ";
                    } else {
                        while ($data = mysqli_fetch_assoc($query)) {
                            echo "
                                    <div class='brands-info_item'>
                                        <img src='./assets/img/{$data['image']}' class='img_featurebrands'>
                                        <span>{$data['title']}</span>
                                    </div>
                                ";
                        }
                    }
                    ?>
                </div>
            </div>
        </div>
        <!-- end top sản phẩm -->
        <!-- sản phẩm mới -->
        <div class="body_top-newarrivals">
            <div class="body_top-title">
                <div class="body_top-title-left">
                    <i class="fa-solid fa-burst icon_top-title"></i>
                    Sản phẩm mới
                </div>
                <div class="body_top-title-right">
                    <a href="AllProduct.php" class="body_top-title-right-item">Xem tất cả
                        <i class="fa-solid fa-caret-right icon_arrow-viewall"></i>
                    </a>
                </div>
            </div>
            <div class="body_bot-arrivals-info">
                <?php
                $sql = "SELECT * FROM products order by product_id desc limit 6;";
                $query = mysqli_query($conn, $sql);
                if (mysqli_num_rows($query) == 0) {
                    echo "Hiện chúng tôi không có sản phẩm mới";
                } else {
                    while ($data = mysqli_fetch_assoc($query)) {
                        echo "
                                <div class='arrivals-info_item'>
                                    <a href='order_detail.php?id={$data['product_id']}'>
                                        <img src='./assets/img/{$data['image']}' class='img_arrivals-item'>
                                    </a>
                                    <div class='arrivals-info_text'>
                                        <span>{$data['title']}</span>
                                        <span class='info_price'>{$data['price']}$</span>
                                    </div>
                                </div>
                            ";
                    }
                }
                ?>
                <!-- <div class="arrivals-info_item">
                    <a href="#">
                        <img src="./assets/img/cap.jpg" class="img_arrivals-item">
                    </a>
                    <div class="arrivals-info_text">
                        <span>Captain America</span>
                        <span class="info_price">50$</span>
                    </div>
                </div> -->
            </div>
        </div>
        <!-- end sản phẩm mới -->
    </div>
    <!-- end body top -->
    <!-- body mid -->
    <div class="body_mid">
        <div class="body_mid-child">
            <i class="fa-solid fa-angle-left"></i>
            <div class="body_mid-describe">
                <p class="body_mid-describe-title">Lego bức họa Van Gogh</p>
                <p class="body_mid-describe-item">Giống như nhiều người tiên phong, tác phẩm của van Gogh không được đánh giá đầy đủ trong suốt cuộc đời của ông,
                    nhưng di sản quan trọng và lâu dài của ông có nghĩa là ông vẫn truyền cảm hứng cho các nghệ sĩ nhiều thế hệ sau này.</p>
                <span class="body_mid-describe-buy"><i class="fa-regular fa-heart"></i></span>
                <span class="body_mid-describe-buy">Mua với 165$</span>
            </div>
        </div>
    </div>
    <!-- end body mid -->
    <!-- body bot -->
    <div class="body_bot">
        <div class="body_top-title">
            <div class="body_top-title-left">
                <i class="fa-solid fa-hand-point-right icon_top-title"></i>
                Đề xuất cho bạn
            </div>
            <div class="body_top-title-right">
                <a href="AllProduct.php" class="body_top-title-right-item">Xem tất cả
                    <i class="fa-solid fa-caret-right icon_arrow-viewall"></i>
                </a>
            </div>
        </div>
        <div class="body_bot-recommend">
            <?php
            $sql = "SELECT * FROM products order by product_id asc limit 8";
            $query = mysqli_query($conn, $sql);
            if (mysqli_num_rows($query) == 0) {
                echo "Không mua thì đề xuất làm gì. Tự giác bấm Ctrl + W đi";
            } else {
                while ($data = mysqli_fetch_assoc($query)) {
                    echo "
                            <div class='products products_recommend'>
                                <a href='order_detail.php?id={$data['product_id']}'>
                                    <img src='./assets/img/{$data['image']}' alt='' class='img_products'>
                                </a>
                                <div class='describe_products'>
                                    <div class='ratings_products'>
                                        <span>{$data['title']}</span>
                                        <span>{$data['star']} <i class='fa-solid fa-star icon_star'></i></span>
                                        <div>
                                            <span class='info_price'>{$data['price']}$</span>
                                            <span class='oldprice'>{$data['oldprice']}$</span>
                                        </div>
                                    </div>
                                    <div class='add_like_products'>
                                        <i class='fa-regular fa-heart icon_heart'></i>
                                        <button class='btn_deal-item'><i class='fa-solid fa-plus icon_addcart'></i></button>
                                    </div>
                                </div>
                            </div>
                        ";
                }
            }
            ?>
        </div>
    </div>
    <div class="body_info">
        <div class="body_info-item">
            <div class="body_info-item-icon">
                <i class="fa-solid fa-truck-fast icon_info-sp"></i>
            </div>
            <div>
                <span class="body_info-item-title">Vận chuyển toàn quốc</span>
                <p class="body_info-item-description">Chúng tôi luôn cố gắng để vận chuyển sản phẩm nhanh nhất tới bạn.</p>
            </div>
        </div>
        <div class="body_info-item">
            <div class="body_info-item-icon">
                <i class="fa-solid fa-credit-card icon_info-sp"></i>
            </div>
            <div>
                <span class="body_info-item-title">Thanh toán an toàn</span>
                <p class="body_info-item-description">Nếu bạn thanh toán khi nhận hàng sẽ thanh toán tổng giá trị đơn hàng hoặc
                    phần còn lại (sau khi bạn đã đặt cọc trước) bằng tiền mặt hoặc quẹt thẻ.
                </p>
            </div>
        </div>
        <div class="body_info-item">
            <div class="body_info-item-icon">
                <i class="fa-solid fa-user-shield icon_info-sp"></i>
            </div>
            <div>
                <span class="body_info-item-title">Sản phẩm uy tín</span>
                <p class="body_info-item-description">Các sản phẩm tại Bot Store cam kết đều là sản phẩm chính hãng từ các hãng uy tín.
                    Đảm bảo an toàn chất lượng cho bạn.
                </p>
            </div>
        </div>
        <div class="body_info-item">
            <div class="body_info-item-icon">
                <i class="fa-solid fa-headset icon_info-sp"></i>
            </div>
            <div>
                <span class="body_info-item-title">Hỗ trợ 24/7</span>
                <p class="body_info-item-description">Chúng tôi luôn sẵn sàng hỗ trợ bất cứ khi nào bạn cần.</p>
            </div>
        </div>
    </div>
    <!-- End body bot -->
</div>
<!-- end body -->