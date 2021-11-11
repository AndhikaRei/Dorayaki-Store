// Utility for client-side.

/*--------------------------------------------------------------
# Capturing HTML element
--------------------------------------------------------------*/
// Capture input photo and photo placeholder.
const addPhoto = document.getElementById('photo');
const dorayakiPhoto = document.getElementById('photo-dorayaki');
const formCreate = document.getElementById('form-create');
const contentBody = document.getElementById('content-body');

/*--------------------------------------------------------------
# State & Other Checking
--------------------------------------------------------------*/
// User must be logged in.
// If not logged in, redirect to login page
checkLogin();
// User must be an admin.
// If not admin, redirect to dashboard.
checkAdmin();

/*--------------------------------------------------------------
# Event Listener.
--------------------------------------------------------------*/
// Add event listener for changing stock value.
addPhoto.addEventListener("change", (event) => {
    dorayakiPhoto.src = URL.createObjectURL(event.target.files[0]);
    dorayakiPhoto.removeAttribute("hidden");
});

// Add event listener for submitting data.
formCreate.addEventListener("submit", (event) => {
    event.preventDefault();
    const formData = new FormData(formCreate);
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
                window.location = "../../variant-detail.php?id="+ res.id;
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

    xhttp.open("POST", "../../api/dorayaki/createDorayaki.php", true);
    xhttp.send(formData);
})

