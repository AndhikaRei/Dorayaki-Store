// Utility for client-side.

/*--------------------------------------------------------------
# Capturing HTML element
--------------------------------------------------------------*/
// Capture input photo and photo placeholder.
const addPhoto = document.getElementById('photo');
const dorayakiPhoto = document.getElementById('photo-dorayaki');
const formEdit = document.getElementById('form-edit');
const contentBody = document.getElementById('content-body');

// Capture form. 
const nameInput = document.getElementById('name');
const descriptionInput = document.getElementById('description');
const priceInput = document.getElementById('price');
const stockInput = document.getElementById('stock');

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
// User must be an admin.
// If not admin, redirect to dashboard.
checkAdmin();

/*--------------------------------------------------------------
# Function
--------------------------------------------------------------*/
const fillData = () => {
    // Create ajax request.
    var xhttp = new XMLHttpRequest();

    xhttp.onreadystatechange = function () {
        if (this.readyState == 4) {
            if (this.status == 200) {
                // Capture request payload.
                const res = JSON.parse(this.responseText).data;
                const dorayakiName = res.nama;
                const dorayakiPrice = res.harga;
                const dorayakiDescription = res.deskripsi;
                const dorayakiStock = res.stok;
                const dorayakiPicture = res.url_gambar;

                // Modify the client side value.
                nameInput.value = dorayakiName;
                descriptionInput.value = dorayakiDescription;
                priceInput.value = dorayakiPrice;
                stockInput.value = dorayakiStock;
                dorayakiPhoto.src = `./static/images/${dorayakiPicture}`;

                // Give input type hidden.
                formEdit.insertAdjacentHTML("afterbegin", `
                    <input type="hidden" id="id" name="id" value="${id}">
                `);

            } else {
                window.location = "../../404.php";
            }
        }
    }

    xhttp.open("GET", "../../api/dorayaki/getDorayaki.php?id=" + String(id), true);
    xhttp.send();
};

/*--------------------------------------------------------------
# Function Call
--------------------------------------------------------------*/
fillData();

/*--------------------------------------------------------------
# Event Listener.
--------------------------------------------------------------*/
// Add event listener for changing stock value.
addPhoto.addEventListener("change", (event) => {
    dorayakiPhoto.src = URL.createObjectURL(event.target.files[0]);
});

// Add event listener for submitting data.
formEdit.addEventListener("submit", (event) => {
    event.preventDefault();
    const formData = new FormData(formEdit);
    console.log(formData);
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
                window.location = "../../variant-detail.php?id="+ id;
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

    xhttp.open("POST", "../../api/dorayaki/updateDorayaki.php?id="+id, true);
    xhttp.send(formData);
})

