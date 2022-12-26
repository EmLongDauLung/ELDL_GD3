<?php
    unset($_SESSION["user_id"]);
    unset($_SESSION["admin_id"]);
    unset($_SESSION["username"]);
    unset($_SESSION["admin_id"]);
    unset($_SESSION["email"]);
    unset($_SESSION["fullname"]);
    unset($_SESSION["is_block"]);
    unset($_SESSION["permision"]);
    echo '<script language="javascript">alert("Đăng xuất thành công!"); window.location="login.php";</script>';
