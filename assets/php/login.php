<?php
session_start(); // Khởi tạo session
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Kiểm tra xem có yêu cầu đăng nhập hay không
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Thông tin kết nối cơ sở dữ liệu
    $serverName = "localhost"; // Tên máy chủ MySQL
    $username = "id21054233_sa"; // Tên người dùng MySQL
    $password = "Gicungduoc.3009"; // Mật khẩu MySQL
    $dbname = "id21054233_ttruyen"; // Tên cơ sở dữ liệu MySQL

    // Kết nối tới cơ sở dữ liệu
    $conn = mysqli_connect($serverName, $username, $password, $dbname);

    // Kiểm tra kết nối
    if (!$conn) {
        die("Kết nối tới cơ sở dữ liệu thất bại: " . mysqli_connect_error());
    }

    // Lấy dữ liệu từ form đăng nhập
    $username = $_POST['username'];
    $password = $_POST['password'];
    // Kiểm tra sự tồn tại của username và password
if (isset($username) && isset($password)) {
    // Sử dụng câu truy vấn sẵn có để lấy dữ liệu từ cơ sở dữ liệu
    $sql = "SELECT COUNT(*) AS count FROM users WHERE username = '$username' AND password = '$password'";
    $result = mysqli_query($conn, $sql);

    // Kiểm tra kết quả truy vấn
    if (!$result) {
        die("Lỗi truy vấn: " . mysqli_error($conn));
    }

    // Lấy số lượng bản ghi khớp
    $row = mysqli_fetch_assoc($result);
    $count = $row['count'];

    // Kiểm tra số lượng bản ghi khớp
    if ($count > 0) {
        // Đăng nhập thành công
        // Chuyển hướng đến trang web chính
        $_SESSION['username'] = $username;
        header("Location: https://ttruyenvip.000webhostapp.com");
        exit();
    } else {
        // Kiểm tra sự tồn tại của username trong cơ sở dữ liệu
        $sql = "SELECT COUNT(*) AS count FROM users WHERE username = '$username'";
        $result = mysqli_query($conn, $sql);

        // Kiểm tra kết quả truy vấn
        if (!$result) {
            die("Lỗi truy vấn: " . mysqli_error($conn));
        }

        // Lấy số lượng bản ghi khớp
        $row = mysqli_fetch_assoc($result);
        $count = $row['count'];

        if ($count == 0) {
            // Sai tên người dùng
            $loginError = "Sai tên người dùng.";
        } else {
            // Sai mật khẩu
            $loginError = "Sai mật khẩu.";
        }
    }
} else {
    // Người dùng không nhập tên người dùng và mật khẩu
    $loginError = "Vui lòng nhập tên người dùng và mật khẩu.";
}
    // Đóng kết nối
    mysqli_close($conn);
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta https-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="theme-color" content="#fb4b65">
    <meta name="google-site-verification" content="q4IuLTaLMVaPOxTeN2G01G4WkMWemT1eip0hkDkPQ0I">
    <title>TTruyen Đăng Nhập</title>
    <link rel="icon" href="https://ttruyenvip.000webhostapp.com/assets/img/Layer0.png" type="image/png">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin="">
    <style>
        * {
    padding: 0;
    margin: 0;
    box-sizing: border-box;
    font-family: sans-serif, Arial, Helvetica;
    font-size: 16px;
    text-decoration: none;
}

.logo{
    position: relative;
}
.login img{
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    z-index: -1;
}
.logo>a>img {
    margin: 10px 10px 10px 10px;
    width: 80px;
    height: 80px;
    cursor: pointer;
    position: relative;
    z-index: 1;
}
form{
    display: inline-grid;
    margin: 0 150px 0 150px;
        justify-items: center;
}

.type {
  text-align: center;
  width: 1200px;
  height: auto; 
  padding: 25px;
  position: absolute;
  left: 50%;
  top: 50%;
  transform: translate(-50%, -50%);
  box-shadow: 0px 0px 20px 0px #000;
  border-radius: 20px;
  transition: all 0.5s ease-in-out;
  display: flex;
  flex-wrap: wrap; 
  justify-content: center;
  align-items: center; 
}

.back-lg>img{
    width:100px;
    height:auto;
}
.type>p {
    font-size: 40px;
    font-weight: bold;
    /*font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;*/
    font-family: 'Edu SA Beginner', cursive;
    color: red;
}

.type input[type="password"],
.type input[type="text"],
.type input[type="email"] {
    background: whitesmoke;
    outline: none;
    width: 300px;
    height: 50px;
    border-radius: 40px;
    padding: 0px 15px;
    margin: 15px 0px;
    border: solid 2px #5664e2;
}

.type input[type="password"]:focus,
.type input[type="text"]:focus,
.type input[type="email"]:focus {
    border-color: rgb(219, 29, 38);
}

.type input[type="submit"] {
    background-color: rgba(31, 81, 128, 0.6);
    outline: none;
    width: 160px;
    height: 40px;
    border-radius: 40px;
    margin: 15px 0px;
    border: solid 1px #002aff7e;
    color: white;
    font-size: 20px;
    transition: 0.5s;
    backdrop-filter: blur(8px);
    font-weight: 600;
}

.type input[type="submit"]:hover {
    background: blue;
    transition: 1s;
}

.register {
    display: inline-flex;
    flex-direction: column;
}

.register>a {
    padding: 0 10px;
    color:blue;
}

.error-message {
    color: red;
    display: flex;
    justify-content: center;
}
.password-input {
    position: relative;
    display: inline-flex;
}

.password-input input[type="password"] {
    padding-right: 40px; /* Tạo khoảng trống để chứa icon */
}

.password-input .show-password-icon {
        position: absolute;
    top: 50%;
    right: 10px;
    transform: translateY(-50%);
    width: 20px;
    height:15px;
    left: calc(100% - 30px); 
    cursor: pointer;
    z-index: 1;
}
</style>
</head>
<body>
    <div class="login">
        <img src="https://ttruyenvip.000webhostapp.com/assets/img/bg.jpg">
        <div class="background-login">
            <div class="logo">
                <a href="https://ttruyenvip.000webhostapp.com">
                    <img src="https://ttruyenvip.000webhostapp.com/assets/img/Layer0.png">
                </a>
            </div>
            <div class="type">
                <p>Đăng Nhập</p>
                <form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>" id="login-form" onsubmit="return validateForm()">
                    
                    <input type="text" name="username" placeholder="Tên tài khoản" id="username">
                    <span class="error-message" id="username-error">
                        <?php echo isset($loginError) && $loginError !== "Sai mật khẩu." ? ($loginError === "Vui lòng điền đầy đủ thông tin đăng nhập." ? $loginError : "Sai tên người dùng.") : ''; ?>
                        <style>.error-message{color:red;display:flex;justify-content: center;}</style>
                    </span>
                    <div class="password-input">
                    <input type="password" name="password" placeholder="Mật Khẩu" id="password">
                    <img src="https://ttruyenvip.000webhostapp.com/assets/img/show_password.png" alt="Show Password" class="show-password-icon" onclick="togglePasswordVisibility()">
                    </div>
                <span class="error-message" id="password-error">
                    <?php echo isset($loginError) && $loginError !== "Sai tên người dùng." ? ($loginError === "Vui lòng điền đầy đủ thông tin đăng nhập." ? $loginError : "Sai mật khẩu.") : ''; ?>
                    <style>
                .error-message {
                    color: red;
                    display: flex;
                    justify-content: center;
                }
                </style>
                </span>
                <input type="submit" value="Đăng nhập">
                </form>
                <div class="more_options">
                <div class="register">
                    <span>Bạn chưa đăng kí ?</span>
                    <a href="https://ttruyenvip.000webhostapp.com/assets/php/register.php">
                        Đăng kí ngay
                    </a>
                </div>
                <div class="register">
                    <span>Quên mật khẩu ?</span>
                    <a href="https://ttruyenvip.000webhostapp.com/assets/php/forgot-password.php">
                        Đặt lại mật khẩu
                    </a>
                </div>
                </div>
            </div>
        </div>
    </div>
    <script type="text/javascript" src="../js/login.js"></script>
</body>

</html>