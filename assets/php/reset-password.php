<?php

// Kiểm tra xem người dùng đã gửi biểu mẫu hay chưa
if (isset($_POST['email'])) {

    // Lấy địa chỉ email của người dùng
    $email = $_POST['email'];

    // Kiểm tra xem địa chỉ email của người dùng có tồn tại trong cơ sở dữ liệu hay không
    $sql = "SELECT * FROM users WHERE email = '$email'";
    $result = mysqli_query($conn, $sql);

    // Nếu địa chỉ email của người dùng không tồn tại trong cơ sở dữ liệu
    if (mysqli_num_rows($result) == 0) {
        echo "Địa chỉ email của người dùng không tồn tại trong cơ sở dữ liệu.";
        exit();
    }

    // Lấy ID của người dùng
    $user_id = mysqli_fetch_assoc($result)['id'];

    // Tạo mã bảo mật ngẫu nhiên
    $security_code = mt_rand(100000, 999999);

    // Cập nhật mã bảo mật trong cơ sở dữ liệu
    $sql = "UPDATE users SET security_code = '$security_code' WHERE id = '$user_id'";
    mysqli_query($conn, $sql);

    // Gửi email cho người dùng với mã bảo mật
    $to = $email;
    $subject = "Reset Password";
    $message = "Mã bảo mật của bạn là: $security_code";
    mail($to, $subject, $message);

    // Chuyển hướng người dùng đến trang đặt lại mật khẩu
    header("Location: reset-password.php?security_code=$security_code");
} else {

    // Chuyển hướng người dùng đến trang đăng nhập
    header("Location: login.php");
}
?>