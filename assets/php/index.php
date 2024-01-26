<?php
session_start();

// Kiểm tra xem người dùng đã đăng nhập hay chưa
if (isset($_SESSION['username'])) {
  $username = $_SESSION['username'];
} else {
  $username = null;
}
?>
