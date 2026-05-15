const passw = document.getElementById("passw");
const togg = document.querySelector(".passw-toggle-icon i");

togg.addEventListener("click", function () {
  if (passw.type === "password") {
    passw.type = "text";
    togg.classList.remove("fa-eye-slash");
    togg.classList.add("fa-eye");
  } else {
    passw.type = "password";
    togg.classList.remove("fa-eye");
    togg.classList.add("fa-eye-slash");
  }
});