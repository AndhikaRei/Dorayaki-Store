// Utility for client-side.

/*--------------------------------------------------------------
# Capturing HTML element
--------------------------------------------------------------*/
// Capture the add and reduce stock element with dom manipulation.
const addButton = document.getElementById('add-stock');
const reduceButton = document.getElementById('reduce-stock');
const stock = document.getElementById('stock');


/*--------------------------------------------------------------
# Event Listener.
--------------------------------------------------------------*/
// Add event listener for changing stock value.
addButton.addEventListener("click", ()=> {
    stock.stepUp();
});
reduceButton.addEventListener("click", () => {
    stock.stepDown();
});