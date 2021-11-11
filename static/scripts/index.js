// Utility for client-side.

/*--------------------------------------------------------------
# Capturing HTML element
--------------------------------------------------------------*/
// Capture input photo and photo placeholder.
const dorayakiList = document.getElementById('dorayaki-list');
const pages = 1;

/*--------------------------------------------------------------
# State & Other Checking
--------------------------------------------------------------*/
// User must be logged in.
// If not logged in, redirect to login page
checkLogin();

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

                // Modify the client side value.
                dorayakiList.innerHTML = res.map((dorayaki) => 
                `   <a href="variant-detail.php?id=${dorayaki.id}">
                        <div class="dorayaki-item" >
                            <div class="image-container">
                                <img src="./static/images/${dorayaki.url_gambar}">
                            </div>
                            <div class="dorayaki-price-container">
                                <p class="dorayaki-price">Rp. ${toCurrency(dorayaki.harga)}</p>
                            </div>
                            <div class=dorayaki-detail>
                                <p class="dorayaki-sold">Terjual: ${dorayaki.terjual}</p>
                                <h2 class="dorayaki-title">${dorayaki.nama}</h2>
                            </div>
                        </div>            
                    </a>`
                ).join('')
        
            } else {
                window.location = "../../404.php";
            }
        }
    }

    xhttp.open("GET", "../../api/dorayaki/getAllDorayaki.php?sort=terjual&order=desc&limit=6", true);
    xhttp.send();
});
