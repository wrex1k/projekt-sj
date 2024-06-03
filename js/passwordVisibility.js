function togglePasswordVisibility() {
  var passwordInput = document.getElementById("password");
  var rePasswordInput = document.getElementById("re-password");
  if (passwordInput.type === "password") {
    passwordInput.type = "text";
    rePasswordInput.type = "text";
  } else {
    passwordInput.type = "password";
    rePasswordInput.type = "password";
  }
}
