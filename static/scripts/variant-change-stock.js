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
const contentBody = document.getElementById('content-body');

// Capture form and hidden form.
const dorayakiId = document.getElementById('dorayaki_id');
const akunId = document.getElementById('akun_id');
const dorayakiNama = document.getElementById('dorayaki_nama');
const formChangeStock = document.getElementById('form-change-stock');
const jumlahItem = document.getElementById('jumlah_item');

// Capture the add and reduce stock element with dom manipulation.
const addButton = document.getElementById('add-stock');
const reduceButton = document.getElementById('reduce-stock');
const stock = document.getElementById('stock');
const btnEditStock = document.getElementById('btn-edit-stock');

/*--------------------------------------------------------------
# State
--------------------------------------------------------------*/
const id = new URLSearchParams(window.location.search).get("id");
// Setup form hidden value.



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

/*--------------------------------------------------------------
# Function.
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
                console.log(res);
                const dorayakiName = res.nama;
                const dorayakiPrice = toCurrency(res.harga);
                const dorayakiDescription = res.deskripsi;
                const dorayakiStock = res.stok;
                const dorayakiSold = res.terjual;
                const dorayakiPicture = res.url_gambar;

                // Modify the client side value.
                nama.innerText= dorayakiName;
                price.innerText= dorayakiPrice;
                stok.innerText=dorayakiStock;
                sold.innerText= dorayakiSold;
                desc.innerText=dorayakiDescription;
                image.src = `./static/images/${dorayakiPicture}`

                // Modify hidden attribute
                dorayakiId.value = id;
                dorayakiNama.value = dorayakiName;
                const stock = document.getElementById('stock');
                jumlahItem.value = stock.value;

            } else {
                window.location = "../../404.php";
            }
        }
    }

    xhttp.open("GET", "../../api/dorayaki/getDorayaki.php?id=" + String(id), true);
    xhttp.send();
};

// Function for checking is changing stock valid.
const checkValidChangeStock = () => {
    const currStock = parseInt(stok.innerText);
    const curChange = parseInt(stock.value);
     // Case when changing stock is negative.
     if (!isNaN(currStock) && !isNaN(curChange) ) {
        btnEditStock.removeAttribute('disabled');
        if (curChange < 0 && Math.abs(curChange) > currStock) {
            btnEditStock.setAttribute('disabled', "");
        }
        if (curChange == 0) {
            btnEditStock.setAttribute('disabled', "");
        }
     }
    jumlahItem.value = stock.value;
}

/*--------------------------------------------------------------
# Function Call.
--------------------------------------------------------------*/
// Short polling for every 1.5 second.
setInterval(shortPolling, 1000);
setInterval(checkValidChangeStock, 500);

/*--------------------------------------------------------------
# Event Listener.
--------------------------------------------------------------*/
// Add event listener for changing stock value.
// Adding stock.
addButton.addEventListener("click", ()=> {
    stock.stepUp();
});
// Reducing stock. If stok value is negative then stock will be reduced.
reduceButton.addEventListener("click", () => {
    const currStock = parseInt(stok.innerText);
    let currChange = parseInt(stock.value);
    if (isNaN(currChange)) {
        currChange = 0;
    }

    // Basic case.
    if (currChange > 0){
        stock.stepDown();
        return;
    }
    // Case when changing stock is negative.
    if (!isNaN(currStock)) {
        if (currChange <= 0 && Math.abs(currChange) < currStock){
            stock.stepDown();
            return;
        }
    }
});
