// Utility for client-side.

/*--------------------------------------------------------------
# Capturing HTML element
--------------------------------------------------------------*/
// Capture component.
const emailInput = document.getElementById("input-email");
const emailInputMessage = document.getElementById("input-email-message");
const usernameInput = document.getElementById("input-username");
const usernameInputMessage = document.getElementById("input-username-message");
const passwordInput = document.getElementById("input-password");
const passwordInputMessage = document.getElementById("input-password-message");
const confirmPasswordInput = document.getElementById("input-confirm-password");
const confirmPasswordInputMessage = document.getElementById("input-confirm-password-message");
const registerButton = document.getElementById("btn-register");

/*--------------------------------------------------------------
# State
--------------------------------------------------------------*/
let emailValid = false;
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
  if (emailValid && usernameValid && pwdValid) {
    registerButton.disabled = false;
  } else {
    registerButton.disabled = true;
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
// Add event listener for email input validation
emailInput.addEventListener("keyup", (e) => {
  const email = e.target.value;
  var xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange=function() {
    if (this.readyState == 4 && this.status == 200) {
      // console.log(this.responseText);
      res = JSON.parse(this.responseText);
      if (res.status == "invalid") {
        setInputError(emailInput, emailInputMessage, res.message);
        emailValid = false;
      } else if (res.status == "valid") {
        setInputSuccess(emailInput, emailInputMessage, res.message);
        emailValid = true;
      }
      checkFormValidity();
    }
  }

  const data = {
    functionName: 'validateEmail',
    email: email,
  };
  xhttp.open("POST", "../../api/register.php", true);
  xhttp.setRequestHeader("Content-type","application/json");
  xhttp.send(JSON.stringify(data));
});

// Add event listener for username input validation
usernameInput.addEventListener("keyup", (e) => {
  const username = e.target.value;
  var xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange=function() {
    if (this.readyState == 4 && this.status == 200) {
      // console.log(this.responseText);

      res = JSON.parse(this.responseText);
      if (res.status == "invalid") {
        setInputError(usernameInput, usernameInputMessage, res.message);
        usernameValid = false;
      } else if (res.status == "valid") {
        setInputSuccess(usernameInput, usernameInputMessage, res.message);
        usernameValid = true;
      }
      checkFormValidity();
    }
  }

  const data = {
    functionName: 'validateUsername',
    username: username,
  };
  xhttp.open("POST", "../../api/register.php", true);
  xhttp.setRequestHeader("Content-type","application/json");
  xhttp.send(JSON.stringify(data));
});

// Add event listener for password input validation
passwordInput.addEventListener("keyup", (e) => {
  const pwd = e.target.value;
  const cPwd = confirmPasswordInput.value;

  if (pwd.length == 0) {
    setInputError(passwordInput, passwordInputMessage, "Password tidak boleh kosong");
    pwdValid = false
  } else if (pwd != cPwd) {
    setInputError(passwordInput, passwordInputMessage, "Password tidak sama");
    setInputError(confirmPasswordInput, confirmPasswordInputMessage, "Password tidak sama");
    pwdValid = false
  } else {
    setInputSuccess(passwordInput, passwordInputMessage, "<br>");
    setInputSuccess(confirmPasswordInput, confirmPasswordInputMessage, "<br>");
    pwdValid = true;
  }
  checkFormValidity();
});

// Add event listener for confirm password input validation
confirmPasswordInput.addEventListener("keyup", (e) => {
  const cPwd = e.target.value;
  const pwd = passwordInput.value;

  if (cPwd.length == 0) {
    setInputError(confirmPasswordInput, confirmPasswordInputMessage, "Password tidak boleh kosong");
    pwdValid = false
  } else if (pwd != cPwd) {
    setInputError(passwordInput, passwordInputMessage, "Password tidak sama");
    setInputError(confirmPasswordInput, confirmPasswordInputMessage, "Password tidak sama");
    pwdValid = false
  } else {
    setInputSuccess(passwordInput, passwordInputMessage, "<br>");
    setInputSuccess(confirmPasswordInput, confirmPasswordInputMessage, "<br>");
    pwdValid = true;
  }
  checkFormValidity();
});

// Add event listener for register
registerButton.addEventListener("click", (e) => {
  e.preventDefault();
  const email = emailInput.value;
  const username = usernameInput.value;
  const password = passwordInput.value;
  const confirmPassword = confirmPasswordInput.value;

  var xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange=function() {
    if (this.readyState == 4 && this.status == 200) {
      console.log(this.responseText);
      res = JSON.parse(this.responseText);
      if (res.status == "success") {
        window.location = "/";
      }
    }
  }

  const data = {
    functionName: 'register',
    email: email,
    username: username,
    password: password,
    confirmPassword: confirmPassword,
  };
  xhttp.open("POST", "../../api/register.php", true);
  xhttp.setRequestHeader("Content-type","application/json");
  xhttp.send(JSON.stringify(data));
});