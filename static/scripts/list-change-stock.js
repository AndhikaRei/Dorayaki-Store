// Utility for client-side.

/*--------------------------------------------------------------
# Capturing HTML element
--------------------------------------------------------------*/
// Capture tab component.
const tabContentDefault = document.getElementById("default");
const tabContentSearch = document.getElementById("search-variant");
const tablinksDefault = document.getElementById("default-link");
const tablinksSearch = document.getElementById("search-variant-link");
const nameSearchInput = document.getElementById("name-search");
const defaultTableBody = document.getElementById("list_status_item_default");
const searchTableBody = document.getElementById("list_status_item_search");

/*--------------------------------------------------------------
# State
--------------------------------------------------------------*/
let searchTimer;
let searchInterval = 500;

/*--------------------------------------------------------------
# State & Other Checking
--------------------------------------------------------------*/
// User must be logged in.
// If not logged in, redirect to login page
checkLogin();

// If not admin, redirect to dashboard
checkAdmin();

/*--------------------------------------------------------------
# Functions
--------------------------------------------------------------*/
// Function to load transaction data
function loadTransactionSearch() {
  console.log("kon");
  var xhttp = new XMLHttpRequest();

  xhttp.onreadystatechange=function() {
    if (this.readyState == 4) {
      if (this.status == 200) {
        const res = JSON.parse(this.responseText).data;
        searchTableBody.innerHTML = res.map((x) => {return dataToTableRow(x, true)}).join('')
      }
    }
  }

  const searchTerm = nameSearchInput.value;

  let url = "../../api/transaction/getAllTransaction.php"
  if (searchTerm) {
    url += `?search=${searchTerm}`
  }

  xhttp.open("GET", url, true);
  xhttp.send();
}

function toCurrency(value) {
  return value.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
}

function dataToTableRow(data, withUsername=false) {
  return `
    <tr class='table-row'>
      <td scope='row' colspan='3'>
        <img class='image-transaksi' src='./static/images/${data.url_gambar}' width='80' height='60' alt=''>
        <div class='transaksi-important'>
          <a href='./variant-detail.php?id=${data.dorayaki_id}' class='transaksi-name'>${data.dorayaki_nama}</a>
          <p class='transaksi-price'>${data.category == "pembelian" ? `Rp. ${toCurrency(data.dorayaki_harga)}` : `-`}</p>
        </div>
      </td>
      <td>
        <p class='transaksi-other-info'>${data.jumlah_item}</p>
      </td>
      <td>
        <p class='transaksi-other-info'>${data.total_harga ? `Rp. ${toCurrency(data.total_harga)}` : "-" }</p>
      </td>
      <td>
        <p class='transaksi-other-info'>${data.tanggal}</p>
      </td>
      <td>
        <p class='transaksi-other-info'>${data.waktu}</p>
      </td>
      ${withUsername ? `<td> <p class='transaksi-other-info'>${data.akun_nama}</p></td>` : ``}
    </tr>
  `
}

/*--------------------------------------------------------------
# Event Listener.
--------------------------------------------------------------*/
// Load event listener
window.addEventListener("load", ()=> {
  tablinksDefault.classList.add("btn-details-active");
  tablinksSearch.classList.remove("btn-details-active");
  tabContentDefault.style.display = "block";
  tabContentSearch.style.display = "none";
  
  var xhttp = new XMLHttpRequest();

  xhttp.onreadystatechange = function() {
    if (this.readyState == 4) {
      if (this.status == 200) {
        const res = JSON.parse(this.responseText).data;
        defaultTableBody.innerHTML = res.map((x) => {return dataToTableRow(x, false)}).join('')
      }
    }
  }
  
  xhttp.open("GET", "../../api/transaction/getTransactionByUserId.php", true);
  xhttp.send();

  loadTransactionSearch();
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

// Search input event listener
nameSearchInput.addEventListener("input", () => {
  clearTimeout(searchTimer);
  searchTimer = setTimeout(loadTransactionSearch, searchInterval);
});

