function checkLogin(loginPage = false) {
  var xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange=function() {
    if (this.readyState == 4 && this.status == 200) {
      res = JSON.parse(this.responseText);
      if (!loginPage) {
        if (res.status == "error") {
          window.location = "../../login.php";
        }
      } else {
        if (res.status == "success") {
          window.location = "/";
        }
      }
    }
  }

  xhttp.open("GET", "../../api/auth/checkLogin.php", true);
  xhttp.send();
}

function checkAdmin() {
  var xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange=function() {
    if (this.readyState == 4 && this.status == 200) {
      res = JSON.parse(this.responseText);
      if (res.status == "error") {
        window.location = "/";
      }
    }
  }

  xhttp.open("GET", "../../api/auth/checkAdmin.php", true);
  xhttp.send();
}

function checkNotAdmin() {
  var xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange=function() {
    if (this.readyState == 4 && this.status == 200) {
      res = JSON.parse(this.responseText);
      if (res.status == "success") {
        window.location = "/";
      }
    }
  }

  xhttp.open("GET", "../../api/auth/checkAdmin.php", true);
  xhttp.send();
}