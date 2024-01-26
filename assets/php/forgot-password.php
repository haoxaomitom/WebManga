<?php

session_start();

// Kiểm tra xem người dùng đã gửi email hay chưa
if (isset($_POST['email'])) {

    // Lấy email của người dùng
    $email = $_POST['email'];

    // Kiểm tra xem email có tồn tại trong cơ sở dữ liệu hay không
    $sql = "SELECT * FROM users WHERE email = '$email'";
    $result = mysqli_query($conn, $sql);

    // Nếu email không tồn tại, thì chuyển hướng người dùng đến trang đăng nhập
    if (mysqli_num_rows($result) == 0) {
        header("Location: login.php");
        exit();
    }

    // Tạo một mã bảo mật ngẫu nhiên
    $securityCode = mt_rand(100000, 999999);

    // Lưu mã bảo mật vào cơ sở dữ liệu
    $sql = "UPDATE users SET security_code = '$securityCode' WHERE email = '$email'";
    mysqli_query($conn, $sql);

    // Gửi email cho người dùng với mã bảo mật
    $mail = new PHPMailer();
    $mail->isSMTP();
    $mail->Host = 'smtp.gmail.com';
    $mail->Port = 587;
    $mail->SMTPAuth = true;
    $mail->Username = 'minhnam1810@gmail.com';
    $mail->Password = 'cytbtquykluiodxv';
    $mail->SMTPSecure = 'tls';

    $mail->setFrom('minhnam1810@gmail.com', 'Minh Nam');
    $mail->addAddress($email, 'Recipient');
    $mail->Subject = 'Khôi phục mật khẩu';
    $mail->Body = 'Your security code is: ' . $securityCode;

    if (!$mail->send()) {
        echo 'Mailer Error: ' . $mail->ErrorInfo;
    } else {
        echo 'Message sent!';
    }

    // Lưu mã bảo mật vào session
    $_SESSION['security_code'] = $securityCode;

    // Chuyển hướng người dùng đến trang đặt lại mật khẩu
    header("Location: reset-password.php");
} else {

    // Chuyển hướng người dùng đến trang đăng nhập
    header("Location: login.php");
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Forgot Password</title>
</head>
<body>
    <h1>Forgot Password</h1>
    <form action="reset-password.php" method="post">
        <input type="email" name="email" placeholder="Email address">
        <input type="submit" value="Submit">
        <p>Please enter your email address and we will send you a link to reset your password.</p>
    </form>
</body>
</html>

