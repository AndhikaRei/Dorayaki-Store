// Utility for client-side.

/*--------------------------------------------------------------
# Capturing HTML element
--------------------------------------------------------------*/
// Capture input photo and photo placeholder.
const functionalMenu = document.getElementById('functional-menu');
const functionalIcon = document.getElementById('functional-icon');
const functionalIconImage = document.getElementById('functional-icon-image');
const formSearchDorayaki = document.getElementById('form-search-dorayaki');
const mobileMenuButton = document.getElementById('mobile-menu');
const mobileCloseButton = document.getElementById('mobile-close');
const nav = document.querySelector('nav');
const rightNavbar = document.getElementById('right-navbar');
const nav_bar = document.getElementById('nav-bar');
/*--------------------------------------------------------------
# State & Other Checking
--------------------------------------------------------------*/


function toCurrency(value) {
    return value.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
}
mobileMenuButton.addEventListener('click', () => {
    nav.classList.add('menu-btn');
})

mobileCloseButton.addEventListener('click', () => {
    nav.classList.remove('menu-btn');
})


/*--------------------------------------------------------------
# Function Declaration.
--------------------------------------------------------------*/

function scrollFunction() {
    if (document.body.scrollTop > nav_bar.offsetHeight || document.documentElement.scrollTop > nav_bar.offsetHeight) {
        nav_bar.classList.add('scrolled')
    } else {
        nav_bar.classList.remove('scrolled')
    }
}

/*--------------------------------------------------------------
# Event Listener.
--------------------------------------------------------------*/
// Add event listener when page is loaded.
window.addEventListener("load", ()=> {
    // Create ajax request.
    var xhttp = new XMLHttpRequest();
    
    xhttp.onreadystatechange = function () {
        if (this.readyState == 4) {
            if (this.status == 200) {
                // Capture request payload.
                const res = JSON.parse(this.responseText).data;
                console.log(res);
                rightNavbar.innerHTML = `<li ><a href="/">Dashboard</a></li>`;
                // Modify the client side value.
                if(res.is_admin){
                    rightNavbar.innerHTML +=
                    `
                    <li ><a id="functional-menu" href="variant-add.php">Tambah Dorayaki</a></li>
                    <li class="functional-icon"><a  id="functional-icon" href="variant-add.php"><img  id="functional-icon-image" src="static/images/post-add.svg" alt="logo" class="add"></a></li>
                    <li ><a id="functional-menu" href="list-change-stock.php">Riwayat Perubahan Stock</a></li>
                    <li class="functional-icon"><a  id="functional-icon" href="list-change-stock.php"><img  id="functional-icon-image" src="static/images/history_icon.svg" alt="logo" class="add"></a></li>
                    `
                }else{
                    rightNavbar.innerHTML += 
                    `
                    <li ><a id="functional-menu" href="list-buy.php">Riwayat Pembelian</a></li>
                    <li class="functional-icon"><a  id="functional-icon" href="list-buy.php"><img  id="functional-icon-image" src="static/images/transaction_icon.svg" alt="logo" class="add"></a></li>
                    `
                }
                rightNavbar.innerHTML += 
                `
                <li class="account">
                    <div class="account-logo-outline">
                        <img src="static/images/person.svg" alt="logo" class="account-logo">
                    </div>
                    <p id="username">${res.username}</p>
                </li>
                <li class="nav-button">
                    <form action="./api/auth/logout.php" method="post">
                        <input type="submit" class="logout-button" name="logout" value="Logout"/>
                    </form>
                </li>`
            } else {
                window.location = "../../404.php";
            }
        }
    }

    xhttp.open("GET", "../../api/akun/getAkunByToken.php", true);
    xhttp.send();
});

// Add event listener for submitting data.
formSearchDorayaki.addEventListener("submit", (event) => {
    var xhttp = new XMLHttpRequest();
    const name = new URLSearchParams(window.location.search).get("dorayaki-name");
    xhttp.onreadystatechange = function () {
        if (this.readyState == 4) {
            // Catch payload;
            // Capture request payload.
            const res = JSON.parse(this.responseText).data;
            console.log(res);
            
            if (this.status == 200) {
                window.location = `../../search.php?dorayaki-name=${name}`;
            } else {
                window.location = `../../404.php`;
            }
        }
    }

    xhttp.open("GET", `../../api/dorayaki/getAllDorayaki.php?search=${name}&itemsPerPage=2`, true);
    xhttp.send(formData);
})

// Scrolling navbar
window.onscroll = function () {
    scrollFunction()
};
