function validateForm() {
  let username = document.getElementById('username').value;
  let password = document.getElementById('password').value;

  // Kiểm tra xem tên tài khoản và mật khẩu có hợp lệ hay không
  if (username == '' || password == '') {
    alert('Vui lòng nhập tên tài khoản và mật khẩu');
    return false;
  } else {
    // Lưu thông tin người dùng vào localStorage
    localStorage.setItem('username', username);
    localStorage.setItem('password', password);
    return true;
  }
}
function togglePasswordVisibility() {
        var passwordInput = document.getElementById("password");
        if (passwordInput.type === "password") {
            passwordInput.type = "text";
        } else {
            passwordInput.type = "password";
        }
    }