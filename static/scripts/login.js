// Utility for client-side.

/*--------------------------------------------------------------
# Capturing HTML element
--------------------------------------------------------------*/
// Capture component.
const usernameInput = document.getElementById("input-username");
const usernameInputMessage = document.getElementById("input-username-message");
const passwordInput = document.getElementById("input-password");
const passwordInputMessage = document.getElementById("input-password-message");
const loginButton = document.getElementById("btn-login");
const errorMessage = document.getElementById("error-message");

/*--------------------------------------------------------------
# State
--------------------------------------------------------------*/
let usernameValid = false;
let pwdValid = false;

/*--------------------------------------------------------------
# State & Other Checking 
--------------------------------------------------------------*/
// User cannot be logged in.
// If logged in, redirect to dashboard
checkLogin(true)

/*--------------------------------------------------------------
# Functions.
--------------------------------------------------------------*/
function checkFormValidity() {
  if (usernameValid && pwdValid) {
    loginButton.disabled = false;
  } else {
    loginButton.disabled = true;
  }
}

function setInputError(element, msgElement = null, message = null) {
  element.classList.remove("input-valid");
  element.classList.add("input-invalid");
  if (msgElement) {
    msgElement.classList.remove("success-message");
    msgElement.classList.add("error-message");
    msgElement.innerHTML = message;
  }
}

function setInputSuccess(element, msgElement = null, message = null) {
  element.classList.remove("input-invalid");
  element.classList.add("input-valid");
  if (msgElement) {
    msgElement.classList.remove("error-message");
    msgElement.classList.add("success-message");
    msgElement.innerHTML = message;
  }
}

/*--------------------------------------------------------------
# Event Listener.
--------------------------------------------------------------*/
// Add event listener for username input validation
usernameInput.addEventListener("keyup", (e) => {
  const username = e.target.value;
  if (username.match(/^[A-Za-z0-9_]+$/)) {
    setInputSuccess(usernameInput, usernameInputMessage, "<br>");
    usernameValid = true;
  } else {
    setInputError(usernameInput, usernameInputMessage, "Username harus kombinasi A-Z, a-z, _");
    usernameValid = false;
  }
  checkFormValidity();
});

// Add event listener for password input validation
passwordInput.addEventListener("keyup", (e) => {
  const pwd = e.target.value;

  if (pwd.length == 0) {
    setInputError(passwordInput, passwordInputMessage, "Password tidak boleh kosong");
    pwdValid = false
  } else {
    setInputSuccess(passwordInput, passwordInputMessage, "<br>");
    pwdValid = true;
  }
  checkFormValidity();
});

// Add event listener for register
loginButton.addEventListener("click", (e) => {
  e.preventDefault();
  const username = usernameInput.value;
  const password = passwordInput.value;

  var xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange=function() {
    if (this.readyState == 4 && this.status == 200) {
      console.log(this.responseText);
      res = JSON.parse(this.responseText);

      if (res.status == "success") {
        window.location = "/";
      } else {
        console.log(res.message);
        errorMessage.innerHTML = res.message;
      }
    }
  }

  const data = {
    functionName: 'login',
    username: username,
    password: password,
  };
  xhttp.open("POST", "../../api/login.php", true);
  xhttp.setRequestHeader("Content-type","application/json");
  xhttp.send(JSON.stringify(data));
});