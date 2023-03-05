<?php
// include '../../dbConnection.php';
// $dbConnection = new dbConnection();
// $conn = $dbConnection->getConnection();

if (isset($_POST['btn_submit_add'])) {
    $title = $_POST['title'];
    $quantity = $_POST['quantity'];
    $content = trim($_POST['content']);
    $oldprice = $_POST['oldprice'];
    $price = $_POST['price'];
    $star = $_POST['star'];
    $type = $_POST['type'];
    $trademark_id = $_POST['trademark'];
    // Upload ảnh 
    $image = $_FILES['image']['name'];
    $errors = array();
    $file_name = $_FILES['image']['name'];
    $file_size = $_FILES['image']['size'];
    $file_tmp = $_FILES['image']['tmp_name'];
    $file_type = $_FILES['image']['type'];
    $file_ext = strtolower(end(explode('.', $_FILES['image']['name'])));

    $expensions = array("jpeg", "jpg", "png");

    if (in_array($file_ext, $expensions) === false) {
        $errors[] = "Chỉ hỗ trợ upload file JPEG hoặc PNG.";
    }

    if (
        $file_size > 2097152
    ) {
        $errors[] = 'Kích thước file không được lớn hơn 2MB';
    }
    $target = "../../assets/img/" . basename($image);
    $sql = "INSERT INTO products(title, content, oldprice, price, star, image, type, trademark_id, quantity ) VALUES ( '$title','$content', '$oldprice', '$price', '$star', '$image', '$type', '$trademark_id', '$quantity' )";
    if (mysqli_query($conn, $sql) && move_uploaded_file($_FILES['image']['tmp_name'], $target) && empty($errors) == true) {
        echo '<script language="javascript">alert("Thêm thành công!"); window.location = "addProducts.php";</script>';
    } 
    else {
        echo '<script language="javascript">alert("Lỗi!"); window.location = "addProducts.php";</script>';
    }
}
if (isset($_POST['btn_edit'])) {
    $id = $_POST['id'];
    $title = $_POST['title'];
    $quantity = $_POST['quantity'];
    $content = trim($_POST['content']);
    $oldprice = $_POST['oldprice'];
    $price = $_POST['price'];
    $star = $_POST['star'];
    $type = $_POST['type'];
    $trademark_id = $_POST['trademark'];
    // Upload ảnh 
    $image = $_FILES['image']['name'];
    if(!empty($image)){
        $errors = array();
        $file_name = $_FILES['image']['name'];
        $file_size = $_FILES['image']['size'];
        $file_tmp = $_FILES['image']['tmp_name'];
        $file_type = $_FILES['image']['type'];
        $file_ext = strtolower(end(explode('.', $_FILES['image']['name'])));
    
        $expensions = array("jpeg", "jpg", "png");
    
        if (in_array($file_ext, $expensions) === false) {
            $errors[] = "Chỉ hỗ trợ upload file JPEG hoặc PNG.";
        }
    
        if (
            $file_size > 2097152
        ) {
            $errors[] = 'Kích thước file không được lớn hơn 2MB';
        }
        // 
        $target = "../../assets/img/" . basename($image);
        // 
        $sql = "UPDATE products SET image = '$image',title = '$title', content = '$content', oldprice = '$oldprice', price = '$price', star = '$star', type = '$type', trademark_id = '$trademark_id', quantity ='$quantity' WHERE product_id = '$id'";
        if (mysqli_query($conn, $sql) && move_uploaded_file($file_tmp, $target) && empty($errors) == true) {
            echo '<script language="javascript">alert("Sửa thành công!"); window.location = "addProducts.php";</script>';
        } else {
            echo '<script language="javascript">alert("Có lỗi trong quá trình xử lý");</script>';
        }
    }
    else{
        $sql = "UPDATE products SET title = '$title', content = '$content', oldprice = '$oldprice', price = '$price', star = '$star', type = '$type', trademark_id = '$trademark_id', quantity ='$quantity' WHERE product_id = '$id'";
        if (mysqli_query($conn, $sql) && empty($errors) == true) {
            echo '<script language="javascript">alert("Sửa thành công!"); window.location = "./addProducts.php";</script>';
        } else {
            echo '<script language="javascript">alert("Có lỗi trong quá trình xử lý");</script>';
        }
    }
}

if (isset($_POST['btn_optionDel'])) {
    $id = $_POST['btn_optionDel'];
    $sql = "DELETE FROM products WHERE product_id = $id";
    $query = mysqli_query($conn, $sql);
    echo '<script language="javascript">alert("Xóa sản phẩm thành công!"); window.location="addProducts.php";</script>';

}
