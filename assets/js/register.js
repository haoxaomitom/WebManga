// Hàm kiểm tra và validate form
function validateForm() {
    var firstName = document.forms["register-form"]["first_name"].value;
    var lastName = document.forms["register-form"]["last_name"].value;
    var email = document.forms["register-form"]["email"].value;
    var username = document.forms["register-form"]["username"].value;
    var password = document.forms["register-form"]["password"].value;
    var confirmPassword = document.forms["register-form"]["confirm-password"].value;

    var isValid = true;

    if (firstName === "") {
        document.getElementById("first-name-error").innerText = "Vui lòng nhập họ.";
        document.getElementById("first-name-error").style.display = "block";
        isValid = false;
    } else {
        document.getElementById("first-name-error").style.display = "none";
    }
    if (lastName === "") {
        document.getElementById("last-name-error").innerText = "Vui lòng nhập Tên.";
        document.getElementById("last-name-error").style.display = "block";
        isValid = false;
    } else {
        document.getElementById("last-name-error").style.display = "none";
    }
    if (email === "") {
        document.getElementById("email-error").innerText = "Vui lòng nhập Email.";
        document.getElementById("email-error").style.display = "block";
        isValid = false;
    } else {
        document.getElementById("email-error").style.display = "none";
    }
    if (username === "") {
        document.getElementById("username-error").innerText = "Vui lòng nhập username.";
        document.getElementById("username-error").style.display = "block";
        isValid = false;
    } else {
        document.getElementById("username-error").style.display = "none";
    }
    if (password === "") {
        document.getElementById("password-error").innerText = "Vui lòng nhập password.";
        document.getElementById("password-error").style.display = "block";
        isValid = false;
    } else {
        document.getElementById("password-error").style.display = "none";
    }
    if (confirmPassword === "") {
        document.getElementById("confirm-password-error").innerText = "Vui lòng nhập lại password.";
        document.getElementById("confirm-password-error").style.display = "block";
        isValid = false;
    } else if (confirmPassword !== password) { // Kiểm tra xem mật khẩu nhập lại có khớp với mật khẩu đã nhập hay không
        document.getElementById("confirm-password-error").innerText = "Mật khẩu xác nhận không khớp.";
        document.getElementById("confirm-password-error").style.display = "block";
        isValid = false;
    } else {
        document.getElementById("confirm-password-error").style.display = "none";
    }

    return isValid;
}


function nextto() {
    //Sử dụng Ajax để gửi dữ liệu và nhận phản hồi từ PHP
    const xhr = new XMLHttpRequest();
    xhr.open("POST", "https://ttruyenvip.000webhostapp.com/assets/php/register.php", true);
    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");

    xhr.onreadystatechange = function () {
        if (xhr.readyState === XMLHttpRequest.DONE) {
            if (xhr.status === 200) {
                const response = JSON.parse(xhr.responseText);
                if (response.error) {
                    displayError(response.error);
                } else {
                    showAlert();
                }
            }
        }
    };

    const formData = new FormData();
    formData.append("first_name", ho);
    formData.append("last_name", ten);
    formData.append("email", email);
    formData.append("username", username);
    formData.append("password", password);

    xhr.send(formData);

    return false;
}

function displayError(errorMessage) {
    const errorElement = document.getElementById("error-message");
    errorElement.innerHTML = errorMessage;
    errorElement.style.display = "block";
}
function togglePasswordVisibility() {
        var passwordInput = document.getElementById("password");
        if (passwordInput.type === "password") {
            passwordInput.type = "text";
        } else {
            passwordInput.type = "password";
        }
    }