// Utility for client-side.

/*--------------------------------------------------------------
# Capturing HTML element
--------------------------------------------------------------*/
const dorayakiVerticalList = document.getElementById('dorayaki-vertical-list');
const errorDorayakiNotFound = document.getElementById('error-dorayaki-not-found');
const pagination = document.getElementById('pagination');
var res = [];

/*--------------------------------------------------------------
# State & Other Checking
--------------------------------------------------------------*/
// If not logged in, redirect to login page
checkLogin();

function changePage(page) {
    dorayakiVerticalList.innerHTML = res[page-1].content.map((dorayaki) => 
    `<a class="dorayaki-vertical-list-item" href="variant-detail.php?id=${dorayaki.id}">
        <div class="dorayaki-image"><img src="./static/images/${dorayaki.url_gambar}"></div>
        <div class="dorayaki-detail">
            <h2 class="dorayaki-name">${dorayaki.nama}</h2>
            <div class="divider"></div>
            <h4 class="dorayaki-sold">Terjual: ${dorayaki.terjual}</h4>
            <h4 class="description">Deskripsi: </h4>
            <h4 class="dorayaki-description">${dorayaki.deskripsi}</h4>
        </div>
    </a>`
    ).join('')
    pagination.innerHTML = "";
    for (let i = 1; i <= res.length; i++) {
        if(i==page){
            pagination.innerHTML +=  `<a onclick=changePage(${i}) class="active">${i}</a>`;
        }else{
            pagination.innerHTML +=  `<a onclick=changePage(${i})>${i}</a>`;
        }
        
    }
    return
}

/*--------------------------------------------------------------
# Event Listener.
--------------------------------------------------------------*/
// Add event listener when page is loaded.
window.addEventListener("load", ()=> {
    // Create ajax request.
    var xhttp = new XMLHttpRequest();
    const name = new URLSearchParams(window.location.search).get("dorayaki-name");
    xhttp.onreadystatechange = function () {
        if (this.readyState == 4) {
            // Catch payload;
            // Capture request payload.
            res = JSON.parse(this.responseText).data;
            console.log(res);
            pagination.innerHTML = "";
            if (this.status == 200) {
                errorDorayakiNotFound.classList.add("hidden");
                dorayakiVerticalList.innerHTML = res[0].content.map((dorayaki) => 
                `<a class="dorayaki-vertical-list-item" href="variant-detail.php?id=${dorayaki.id}">
                    <div class="dorayaki-image"><img src="./static/images/${dorayaki.url_gambar}"></div>
                    <div class="dorayaki-detail">
                        <h2 class="dorayaki-name">${dorayaki.nama}</h2>
                        <div class="divider"></div>
                        <h4 class="dorayaki-sold">Terjual: ${dorayaki.terjual}</h4>
                        <h4 class="description">Deskripsi: </h4>
                        <h4 class="dorayaki-description">${dorayaki.deskripsi}</h4>
                    </div>
                </a>`
                ).join('')
                for (let i = 1; i <= res.length; i++) {
                    if(i==1){
                        pagination.innerHTML +=  `<a onclick=changePage(${i}) class="active">${i}</a>`;
                    }else{
                        pagination.innerHTML +=  `<a onclick=changePage(${i})>${i}</a>`;
                    }
                    
                }
                
            } else {
                errorDorayakiNotFound.classList.remove("hidden");
            }
        }
    }

    xhttp.open("GET", `../../api/dorayaki/getAllDorayaki.php?search=${name}&itemsPerPage=2`, true);
    xhttp.send();
});