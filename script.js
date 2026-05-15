const passwordField = document.getElementById("password");
const togglePassword = document.querySelector(".password-toggle-icon i");

togglePassword.addEventListener("click", function () {
  if (passwordField.type === "password") {
    passwordField.type = "text";
    togglePassword.classList.remove("fa-eye-slash");
    togglePassword.classList.add("fa-eye");
  } else {
    passwordField.type = "password";
    togglePassword.classList.remove("fa-eye");
    togglePassword.classList.add("fa-eye-slash");
  }
});

const password = document.getElementById("cpass");
const toggle = document.querySelector(".cpass-toggle-icon i");

toggle.addEventListener("click", function () {
  if (password.type === "password") {
    password.type = "text";
    toggle.classList.remove("fa-eye-slash");
    toggle.classList.add("fa-eye");
  } else {
    password.type = "password";
    toggle.classList.remove("fa-eye");
    toggle.classList.add("fa-eye-slash");
  }
});