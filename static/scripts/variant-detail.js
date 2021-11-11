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

// Capture button with dom manipulation.
const btnBuy = document.getElementById('btn-add');
const btnDelete = document.getElementById('btn-delete');
const btnEditStock = document.getElementById('btn-edit-stock');
const btnEdit = document.getElementById('btn-edit');

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
if (isNaN(parseFloat(id)) || !isFinite(id)){
    window.location = "../../404.php"
}

// User must be logged in.
// If not logged in, redirect to login page
checkLogin();

// Buy button checking.
if (btnEditStock) {
    btnEditStock.href = `../../variant-change-stock.php?id=${id}`
}
if(btnEdit){
    btnEdit.href = `../../variant-edit.php?id=${id}`
}
if (btnBuy){
    btnBuy.href = `../../variant-buy.php?id=${id}`
}

function toCurrency(value) {
    return value.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
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
                const dorayakiName = res.nama;
                const dorayakiPrice = toCurrency(res.harga);
                const dorayakiDescription = res.deskripsi;
                const dorayakiStock = res.stok;
                const dorayakiSold = res.terjual;
                const dorayakiPicture = res.url_gambar;

                // Modify the client side value.
                nama.insertAdjacentText("afterend", dorayakiName);
                price.insertAdjacentText("beforeend", dorayakiPrice);
                stok.insertAdjacentText("beforeend", dorayakiStock);
                sold.insertAdjacentText("beforeend", dorayakiSold);
                desc.insertAdjacentText("beforeend", dorayakiDescription);
                image.src = `./static/images/${dorayakiPicture}`

            } else {
                window.location = "../../404.php";
            }
        }
    }

    xhttp.open("GET", "../../api/dorayaki/getDorayaki.php?id="+String(id), true);
    xhttp.send();

    var xhttp2 = new XMLHttpRequest();
    
    xhttp2.onreadystatechange = function () {
        if (this.readyState == 4) {
            if (this.status == 200) {
                // Capture request payload.
                const res = JSON.parse(this.responseText).data;
                console.log(res);

                if(res.is_admin){
                   btnBuy.classList.add("hidden");
                   btnEdit.classList.remove("hidden");
                   btnEditStock.classList.remove("hidden");
                   btnDelete.classList.remove("hidden");
                }
            } else {
                window.location = "../../404.php";
            }
        }
    }

    xhttp2.open("GET", "../../api/akun/getAkunByToken.php", true);
    xhttp2.send();
});

// Event listener for delete button.
if (btnDelete){
    btnDelete.addEventListener("click", (e)=>{
        e.preventDefault();
        // Create ajax request.
        var xhttp = new XMLHttpRequest();

        xhttp.onreadystatechange = function () {
            if (this.readyState == 4) {
                if (this.status == 200) {
                    window.location = "../../index.php"
                } else {
                    window.location = "../../404.php"
                }
            }
        }

        xhttp.open("GET", "../../api/dorayaki/deleteDorayaki.php?id=" + String(id), true);
        xhttp.send();
    });
}