// Utility for client-side.

/*--------------------------------------------------------------
# Capturing HTML element
--------------------------------------------------------------*/
// Capture tab component.
const tabContentDefault = document.getElementById("default");
const tabContentSearch = document.getElementById("search-variant");
const tablinksDefault = document.getElementById("default-link");
const tablinksSearch = document.getElementById("search-variant-link");

/*--------------------------------------------------------------
# Event Listener.
--------------------------------------------------------------*/
// Basic tab
window.addEventListener("load", ()=> {
    tablinksDefault.classList.add("btn-details-active");
    tablinksSearch.classList.remove("btn-details-active");
    tabContentDefault.style.display = "block";
    tabContentSearch.style.display = "none";
});

// Add event listener for changing tab.
tablinksDefault.addEventListener("click", ()=> {
    tablinksDefault.classList.add("btn-details-active");
    tablinksSearch.classList.remove("btn-details-active");
    tabContentDefault.style.display = "block";
    tabContentSearch.style.display = "none"; 
});

tablinksSearch.addEventListener("click", () => {
    tablinksDefault.classList.remove("btn-details-active");
    tablinksSearch.classList.add("btn-details-active");
    tabContentDefault.style.display = "none";
    tabContentSearch.style.display = "block";
});