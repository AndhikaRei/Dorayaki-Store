// Utility for client-side.

/*--------------------------------------------------------------
# Capturing HTML element
--------------------------------------------------------------*/
// Capture input photo and photo placeholder.
const addPhoto = document.getElementById('photo');
const dorayakiPhoto = document.getElementById('photo-dorayaki');



/*--------------------------------------------------------------
# Event Listener.
--------------------------------------------------------------*/
// Add event listener for changing stock value.
addPhoto.addEventListener("change", (event) => {
    dorayakiPhoto.src = URL.createObjectURL(event.target.files[0]);
    dorayakiPhoto.removeAttribute("hidden");
});

