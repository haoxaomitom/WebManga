<?php
session_start();
session_unset(); // Hủy bỏ các biến phiên
session_destroy(); // Hủy bỏ phiên
header("Location: index.html"); // Chuyển hướng trở lại trang chính
?>
