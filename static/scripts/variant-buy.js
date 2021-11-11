// Utility for client-side.

/*--------------------------------------------------------------
# Capturing HTML element
--------------------------------------------------------------*/
// Capture dorayaki information with dom manipulation.
const nama = document.getElementById('name');
const price = document.getElementById('price');
const image = document.getElementById('image');
const stok = document.getElementById('stok');
const sold = document.getElementById('sold');
const desc = document.getElementById('desc');
const totalPrice = document.getElementById('total-harga');
const contentBody = document.getElementById('content-body');

// Capture form and hidden form.
const totalPriceInput = document.getElementById('total_harga');
const dorayakiId = document.getElementById('dorayaki_id');
const akunId = document.getElementById('akun_id');
const dorayakiNama = document.getElementById('dorayaki_nama');
const formBuy = document.getElementById('form-buy');
const jumlahItem = document.getElementById('jumlah_item');

// Capture the add and reduce stock element with dom manipulation.
const addButton = document.getElementById('add-stock');
const reduceButton = document.getElementById('reduce-stock');
const buycount = document.getElementById('buyCount');
const btnBuy = document.getElementById('btn-add');

/*--------------------------------------------------------------
# State
--------------------------------------------------------------*/
const id = new URLSearchParams(window.location.search).get("id");

/*--------------------------------------------------------------
# State & Other Checking
--------------------------------------------------------------*/
// Params must be exist and numeric.
if (!id) {
    window.location = "../../404.php"
};
if (isNaN(parseFloat(id)) || !isFinite(id)) {
    window.location = "../../404.php"
}

// User must be logged in.
// If not logged in, redirect to login page
checkLogin();

// If admin, redirect to dashboard.
checkNotAdmin();

/*--------------------------------------------------------------
# Function.
// 
--------------------------------------------------------------*/

function toCurrency(value) {
    return value.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
}

// Short Polling Function.
const shortPolling = () => {
    // Create ajax request.
    var xhttp = new XMLHttpRequest();

    xhttp.onreadystatechange = function () {
        if (this.readyState == 4) {
            if (this.status == 200) {
                // Capture request payload.
                const res = JSON.parse(this.responseText).data;
                const dorayakiName = res.nama;
                const dorayakiPrice = toCurrency(res.harga);
                const dorayakiDescription = res.deskripsi;
                const dorayakiStock = res.stok;
                const dorayakiSold = res.terjual;
                const dorayakiPicture = res.url_gambar;
                const curBuy = parseInt(buycount.value);

                // Modify the client side value.
                image.src = `./static/images/${dorayakiPicture}`;
                nama.innerText= dorayakiName;
                price.innerText= dorayakiPrice;
                stok.innerText=dorayakiStock;
                sold.innerText= dorayakiSold;
                desc.innerText=dorayakiDescription;
                
                
                
                // Change total price.
                totalPrice.innerText = 0;
                if (!isNaN(curBuy)){
                    totalPrice.innerText = `Rp. ${toCurrency(res.harga * curBuy)}`;
                }
            } else {
                window.location = "../../404.php";
            }
        }
    }

    xhttp.open("GET", "../../api/dorayaki/getDorayaki.php?id=" + String(id), true);
    xhttp.send();
};

// Function for checking is changing stock valid.
const checkValidBuy = () => {
    const currStock = parseInt(stok.innerText);
    const curBuy = parseInt(buycount.value);
    const dorayakiPrice = parseInt(price.innerText.replace(/\D/g, ''));
    const curPrice = parseInt(totalPrice.innerText.replace(/\D/g, ''));

     // Case when changing stock is negative.
     if (!isNaN(currStock) && !isNaN(curBuy) ) {
        btnBuy.removeAttribute('disabled');
        if (curBuy <= 0) {
            btnBuy.setAttribute("disabled", "");
        }
        if (curBuy > 0 && curBuy > currStock) {
            btnBuy.setAttribute("disabled", "");
        }
        if (curBuy * dorayakiPrice != curPrice) {
            btnBuy.setAttribute("disabled", "");
        }
     }
}

/*--------------------------------------------------------------
# Function Call.
--------------------------------------------------------------*/
// Short polling for every 1.5 second.
setInterval(shortPolling, 1000);
setInterval(checkValidBuy, 500);

/*--------------------------------------------------------------
# Event Listener.
--------------------------------------------------------------*/
// Add event listener for changing stock value.
// Adding stock. Make sure it's not more than curr stock.
addButton.addEventListener("click", ()=> {
    const currStock = parseInt(stok.innerText);
    let currBuy = parseInt(buycount.value);
    if (isNaN(currBuy)) {
        currBuy = 0;
    }

    // Case when changing stock is negative.
    if (!isNaN(currStock)) {
        if (currBuy >= 0 && currBuy < currStock) {
            buycount.stepUp();
            return;
        }
    }
});
// Reducing stock. 
reduceButton.addEventListener("click", () => {
    buycount.stepDown();
});

// Add event listener for creating transaction.
btnBuy.addEventListener("click", (event) => {
    event.preventDefault();

    // Reeget the dom and reeset stock value.
    const nama = document.getElementById('name');
    const totalPrice = document.getElementById('total-harga');
    const buycount = document.getElementById('buyCount');


    // Setup form hidden value.
    totalPriceInput.value = totalPrice.innerText.replace(/\D/g, '');
    dorayakiId.value = id;
    dorayakiNama.value = nama.innerText;
    jumlahItem.value = buycount.value;

    // Send the data.
    const formData = new FormData(formBuy);
    var xhttp = new XMLHttpRequest();
    
    xhttp.onreadystatechange = function () {
        if (this.readyState == 4) {
            // Catch payload;
            let res;
            try {
                res = JSON.parse(this.responseText);
            } catch {
                res = {"error":{"message":this.responseText}};
            }
            
            if (this.status == 200) {
                window.location = "../../list-buy.php?";
            } else {
                contentBody.insertAdjacentHTML("beforebegin", `
                <div class="alert-error">
                    <span class="alert-close" onclick="this.parentElement.style.display='none';"><i class="fas fa-times"></i></span>
                    `+ res.error.message +`
                </div>
                `);
                window.scrollTo({top: 0, behavior: 'smooth'});
            }
        }
    }

    xhttp.open("POST", "../../api/transaction/createTransaction.php", true);
    xhttp.send(formData);

})