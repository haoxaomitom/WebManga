<?php
session_start();
$serverName = "localhost"; // Tên máy chủ MySQL
$username = "id21054233_sa"; // Tên người dùng MySQL
$password = "Gicungduoc.3009"; // Mật khẩu MySQL
$dbname = "id21054233_ttruyen"; // Tên cơ sở dữ liệu MySQL

$conn = mysqli_connect($serverName, $username, $password, $dbname);

if (!$conn) {
    die("Kết nối tới cơ sở dữ liệu thất bại: " . mysqli_connect_error());
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $firstName = $_POST['first_name'];
    $lastName = $_POST['last_name'];
    $email = $_POST['email'];
    $username = $_POST['username'];
    $password = $_POST['password']; 
    $response = array();
    $emailQuery = "SELECT * FROM users WHERE email = '$email'";
    $emailResult = mysqli_query($conn, $emailQuery);
    
    if (mysqli_num_rows($emailResult) > 0) {

        echo '<script>
        document.getElementById("email-error").innerText = response.emailError;
                document.getElementById("email-error").style.display = "block";
                </script>';
        exit();
    }
    
    // Kiểm tra xem username đã tồn tại hay chưa
    $usernameQuery = "SELECT * FROM users WHERE username = '$username'";
    $usernameResult = mysqli_query($conn, $usernameQuery);
    
    if (mysqli_num_rows($usernameResult) > 0) {
        $response = array('usernameError' => 'Username đã tồn tại.');
        echo json_encode($response);
        exit();
    }
    
    // Nếu có lỗi, trả về dữ liệu dưới dạng JSON cho JavaScript xử lý
    if (!empty($response)) {
        echo json_encode($response);
        exit();
    }

    // Tiến hành đăng kí người dùng vào cơ sở dữ liệu
    $sql = "INSERT INTO users (first_name, last_name, email, username, password) VALUES ('$firstName', '$lastName', '$email', '$username', '$password')";

    if (mysqli_query($conn, $sql)) {
        echo '<script>let result = confirm("Đăng kí thành công! Bạn có muốn tới trang đăng nhập không?");
        if (result) {
            window.location.href = "https://ttruyenvip.000webhostapp.com/assets/php/login.php";
        } else {
            window.location.href = "https://ttruyenvip.000webhostapp.com";
        }</script>';
        exit();
    } else {
        $response = array('error' => 'An error to register');
        echo json_encode($response);
        exit();
    }
}

mysqli_close($conn);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta https-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="theme-color" content="#fb4b65">
    <meta name="google-site-verification" content="q4IuLTaLMVaPOxTeN2G01G4WkMWemT1eip0hkDkPQ0I">
    <title>TTruyen Đăng Kí</title>
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
  width: 1080px;
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
.back-lg>p {
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


@media (max-width: 768px) {
    .type {
        width: 90%;
    }

    .type p {
        margin: 10px;
    }
}
    </style>
</head>
<body>
    <div class="login">
        <img src="https://ttruyenvip.000webhostapp.com/assets/img/bg.jpg">
            <div class="logo">
                <a href="https://ttruyenvip.000webhostapp.com">
                    <img src="https://ttruyenvip.000webhostapp.com/assets/img/Layer0.png">
                </a>
            </div>
            <div class="type">
                <div class="back-lg">
                    <p>Đăng Kí</p>
                </div>
                <form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>" name="register-form" onsubmit="return validateForm()">
                    <input type="text" name="first_name" placeholder="Họ">
                    <span id="first-name-error" class="error-message"style="display: none;"></span>
                    <input type="text" name="last_name" placeholder="Tên">
                    <span id="last-name-error" class="error-message" style="display: none;"></span> 
                    <input type="email" name="email" placeholder="example@gmail.com">
                    <span id="email-error" class="error-message" style="display: none;"></span>
                    <input type="text" name="username" placeholder="Tên tài khoản">
                    <span id="username-error" class="error-message"style="display: none;"></span>
                    <div class="password-input">
                    <input type="password" name="password" placeholder="Mật Khẩu" id="password">
                    <img src="https://ttruyenvip.000webhostapp.com/assets/img/show_password.png" alt="Show Password" class="show-password-icon" onclick="togglePasswordVisibility()">
                    </div>
                <span id="password-error" class="error-message"style="display: none;"></span>
                <div class="password-input">
                    <input type="password" name="confirm-password" placeholder="Xác nhận mật khẩu">
                    <img src="https://ttruyenvip.000webhostapp.com/assets/img/show_password.png" alt="Show Password" class="show-password-icon" onclick="togglePasswordVisibility()">
                    </div>
                <span id="confirm-password-error" class="error-message"style="display: none;"></span>
                    <input type="submit" value="Register" >
                </form>
                <div class="register">
                    <span>Bạn đã có tài khoản ?</span>
                    <a href="https://ttruyenvip.000webhostapp.com/assets/php/login.php">
                        Đăng nhập
                    </a>
                </div>
            </div>
        </div>
    </div> 
    <script type="text/javascript" src="https://ttruyenvip.000webhostapp.com/assets/js/register.js"></script>
</body>
</html>