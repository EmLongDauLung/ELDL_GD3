<?php include "header.php" ?>
<?php
if (isset($_GET["id"])) {
    $id = $_GET['id'];
}
echo "$id";echo"<br/>";
$sql = "SELECT * FROM products WHERE product_id = '$id'";
var_dump($sql);
$query = mysqli_query($conn, $sql);
if (mysqli_num_rows($query) == 0) {
    echo"<br/>";
    echo "Lỗi";
} else {
    echo"<br/>";
    echo"OK";
}
?>
<!-- body -->
<body>
    <div id="body">
        <div class="body_container">
            <nav>
            <?php 
                while ($data = mysqli_fetch_assoc($query)) {
                    $sql_trademark = "SELECT * FROM trademark WHERE trademark_id = '{$data['trademark_id']}'";
                    $query_trademark = mysqli_query($conn, $sql_trademark);
                    $trademark = mysqli_fetch_assoc($query_trademark);
                    echo"
                    <div class='body_container-item view_infoproducts'>
                        <div class='info_products-left'>
                            <div class='info_products-left-top'>
                                <a href='loadimage.php?img={$data['image']}'>
                                    <img src='./assets/img/{$data['image']}' alt='' id='img_products_big'>
                                </a>
                            </div>
                        </div>
                        <div class='info_products-right'>
                            <div class='info_product-right-child'>
                                <div class='info_products-right-item'>
                                    <span class='info_products-right-title'>{$data['title']}</span>
                                </div>
                                <div class='info_products-right-item'>
                                    <span>Thương Hiệu:</span>
                                    <span class='info_products-right-brand'>{$trademark['title']}</span>
                                </div>
                                <div class='info_products-right-item'>
                                    <span class='info_products-right-rated'>{$data['star']} <i class='fa-solid fa-star icon_star'></i></span>
                                </div>
                                <div class='info_products-right-item'>
                                        <span class='info_products-right-oldprice'>{$data['oldprice']} $</span>
                                        <span class='info_products-right-price'>{$data['price']} $</span> <br>
                                    ";
                                    if($data['quantity'] == 0)
                                    {
                                        echo "<span>Hết hàng</span>";
                                    }
                                    else{
                                        echo "
                                            <span>Còn hàng</span>
                                        ";
                                    }
                                    echo"
            
                                </div>
                                <div class='info_products-right-item'>
                                    <form id='add-to-cart' action='cart.php?action=add' method='POST'>
                                        <input type='text' value='1' name='quantity[$id]' size='2' class='info_producst-right-quantity'> </br>
                                        <input type='submit' value='Thêm vào giỏ hàng' class='info_producst-right-add'>
                                    </form>
                                </div>
                            </div>
                            <hr class='decoration_top-right-products'>
                            <div class='info_products-right-item view_productsdetails'>
                                <span class='info_products-right-title'>Mô tả</span>
                                    <span>{$data['content']}</span>
                            </div>
                            <hr class='decoration_top-right-products'>
                            <div class='info_products-right-item view_policy'>
                                <span class='info_products-right-title'>Chính sách hỗ trợ</span>
                                <span>
                                    <i class='fa-solid fa-check icon_check-policy'></i>
                                    Đổi trả miễn phí nếu có lỗi từ nhà sản xuất
                                </span>
                                <span>
                                    <i class='fa-solid fa-check icon_check-policy'></i>
                                    Kiểm tra hàng trước khi thanh toán
                                </span>
                                <span>
                                    <i class='fa-solid fa-check icon_check-policy'></i>
                                    Miễn phí vận chuyển
                                </span>
                                <span>
                                    <i class='fa-solid fa-check icon_check-policy'></i>
                                    Hỗ trợ tư vấn sản phẩm: 0123456789 / 0987654321
                                </span>
                            </div>
                        </div>
                    </div>
                    ";
                }
            ?>
            </nav>
            <div class="body_container-item products_cmt-detail">
                <div class="products_tab">
                    <button class="products-item" id="products-item-cmt" onclick="op_comment()">
                        Nhận xét
                    </button>
                    <button class="products-item" id="products-item-detail" onclick="op_detail()">
                        Mô tả chi tiết
                    </button>
                </div>
                <div class="products_contents">
                    <div class="products_cmt" id="product_contentcomment">
                        <div class="products_cmt-item">
                            <div class="products_cmt-top">
                                <img src="./assets/img/frog (5).png" class="img_avatar-user">
                                <div class="user_rated">
                                    <span class="user_rated-name">Bùi Hạ Long</span>
                                    <div>
                                        <span>
                                            <i class="fa-solid fa-star icon_star"></i>
                                            <i class="fa-solid fa-star icon_star"></i>
                                            <i class="fa-solid fa-star icon_star"></i>
                                            <i class="fa-solid fa-star icon_star"></i>
                                            <i class="fa-solid fa-star icon_star"></i>
                                        </span>
                                        <span class="user_rated-cmttime">1 tuần trước</span>
                                    </div>
                                </div>
                            </div>
                            <div class="products_cmt-bot">
                                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Commodi enim, voluptatum magni rem reprehenderit natus sit repellat amet aspernatur omnis culpa voluptate tempora.
                                    Consequuntur distinctio, labore reprehenderit inventore assumenda aliquam?
                                </p>
                            </div>
                        </div>
                        <div class="products_cmt-item">
                            <div class="products_cmt-top">
                                <img src="./assets/img/frog (2).png" class="img_avatar-user">
                                <div class="user_rated">
                                    <span class="user_rated-name">Đỗ Tú Linh</span>
                                    <div>
                                        <span>
                                            <i class="fa-solid fa-star icon_star"></i>
                                            <i class="fa-regular fa-star icon_star"></i>
                                            <i class="fa-regular fa-star icon_star"></i>
                                            <i class="fa-regular fa-star icon_star"></i>
                                            <i class="fa-regular fa-star icon_star"></i>
                                        </span>
                                        <span class="user_rated-cmttime">2 ngày trước</span>
                                    </div>
                                </div>
                            </div>
                            <div class="products_cmt-bot">
                                <p>
                                    Mô hình chất lượng kém quá rate 1 sao.
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="products_detail" id="product_contentdetail">
                        <p class="products_detai-item">
                            Bộ sản phẩm đầy đủ y hình, có 3 khuôn mặt khác nhau để thay thế. <br>
                            Sản phẩm đóng hộp đầy đủ , chắc chắn
                        </p>
                        <p>
                            Uchiha Madara là ninja huyền thoại đứng đầu tộc Uchiha hùng mạnh đầy kiêu hãnh. Madara và những người anh em của hắn sinh ra trong thời kỳ chiến tranh dai dẳng giữa hai tộc Uchiha và Senju.
                            Từ khi còn rất trẻ, Madara đã rất mạnh và có thể chiến thằng các ninja lớn tuổi hơn của tộc Senju, khiến mọi người xem hắn là thiên tài.
                            Một lần, tình cờ Madara gặp một cấu bé trạc tuổi mình tên là Hashirama của tộc Senju. Cả hai nhanh chóng trở thành bạn và họ cùng nhau thi ai ném đá nhảy trên nước được xa hơn.
                            Cả hai đều không tiết lộ tộc của mình nhưng họ cùng dần khám phá ra thân phận của người kia. Và trên chiến trường họ sẽ phải giết nhau, cho dù giữa họ đã có một tình bạn đẹp.
                            Madara đã chọn đứng về gia tộc mình, chấm dứt tình bạn với Hashirama và sẵn sàng giết cậu.
                        </p>
                    </div>
                </div>
            </div>
            <div class="body_container-item user_ratingproducts">
                <div class="user_ratingproducts-title">
                    Đánh giá của bạn cho sản phẩm này
                </div>
                <div class="user_ratingproducts-content">
                    <div class="user_ratingproducts-star">
                        <span class="user_ratingproducts-star-title">Xếp hạng sản phẩm</span>
                        <span>
                            <i class="fa-regular fa-star icon_star"></i>
                            <i class="fa-regular fa-star icon_star"></i>
                            <i class="fa-regular fa-star icon_star"></i>
                            <i class="fa-regular fa-star icon_star"></i>
                            <i class="fa-regular fa-star icon_star"></i>
                        </span>
                    </div>
                    <div class="user_ratingproducts-cmt">
                        <span>Nhận xét của bạn</span> <br>
                        <textarea rows="4" cols="50" class="user_ratingproducts-cmt-child">
                            </textarea>
                    </div>
                    <button class="btn_submit">Gửi</button>
                </div>
            </div>
            <div class="body_container-item products_same">
                <div class="products_same-title">
                    Sản phẩm đang có ưu đãi
                </div>
                <div class="products_same-child">
                    <?php
                    $sql_endow = "SELECT * FROM products WHERE type = 'ưu đãi' order by '$id' desc limit 4;";
                    $query_endow = mysqli_query($conn, $sql_endow);
                    if (mysqli_num_rows($query_endow) == 0) {
                        echo "Hết hàng";
                    } else {
                        while ($data_endow = mysqli_fetch_assoc($query_endow)) {
                            echo "
                                <div class='products products_recommend'>
                                    <a href='order_detail.php?id={$data_endow['product_id']}'>
                                        <img src='./assets/img/{$data_endow['image']}' alt='' class='img_products'>
                                    </a>
                                    <div class='describe_products'>
                                        <div class='ratings_products'>
                                            <span>{$data_endow['title']}</span>
                                            <span>{$data_endow['star']} <i class='fa-solid fa-star icon_star'></i></span>
                                            <div>
                                                <span class='info_price'>{$data_endow['price']}$</span>
                                                <span class='oldprice'>{$data_endow['oldprice']}$</span>
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
        </div>
    </div>
</body>
<?php include "footer.php" ?>