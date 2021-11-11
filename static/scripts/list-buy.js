// Utility for client-side.

/*--------------------------------------------------------------
# Capturing HTML element
--------------------------------------------------------------*/
const tableBody = document.getElementById("list_status_item");

/*--------------------------------------------------------------
# State & Other Checking
--------------------------------------------------------------*/
// User must be logged in.
// If not logged in, redirect to login page
checkLogin();

// If admin, redirect to dashboard.
checkNotAdmin();

/*--------------------------------------------------------------
# Functions
--------------------------------------------------------------*/

function toCurrency(value) {
  return value.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
}

function dataToTableRow(data) {
  return `
    <tr class='table-row'>
      <td scope='row' colspan='3'>
        <img class='image-transaksi' src='./static/images/${data.url_gambar}' width='80' height='60' alt=''>
        <div class='transaksi-important'>
          <a href='./variant-detail.php?id=${data.dorayaki_id}' class='transaksi-name'>${data.dorayaki_nama}</a>
          <p class='transaksi-price'>Rp. ${toCurrency(data.dorayaki_harga)}</p>
        </div>
      </td>
      <td>
        <p class='transaksi-other-info'>${data.jumlah_item}</p>
      </td>
      <td>
        <p class='transaksi-other-info'>Rp. ${data.total_harga ? toCurrency(data.total_harga) : 0 }</p>
      </td>
      <td>
        <p class='transaksi-other-info'>${data.tanggal}</p>
      </td>
      <td>
        <p class='transaksi-other-info'>${data.waktu}</p>
      </td>
    </tr>
  `
}

/*--------------------------------------------------------------
# Event Listener.
--------------------------------------------------------------*/
// Load event listener
window.addEventListener("load", ()=> {
  var xhttp = new XMLHttpRequest();

  xhttp.onreadystatechange = function() {
    if (this.readyState == 4) {
      if (this.status == 200) {
        const res = JSON.parse(this.responseText).data;
        tableBody.innerHTML = res.map(dataToTableRow).join('')
      }
    }
  }
  
  xhttp.open("GET", "../../api/transaction/getTransactionByUserId.php", true);
  xhttp.send();
});
