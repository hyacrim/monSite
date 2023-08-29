const showPasswordButton = document.getElementById("showPassword");
const passwordInput = document.getElementById("password");

showPasswordButton.addEventListener("click", function () {
  if (passwordInput.type === "password") {
    passwordInput.type = "text";
  } else {
    passwordInput.type = "password";
  }
});

