<?php
// Import.
require_once __DIR__."/../../db/config.php";
require_once __DIR__."/../akun/helperAkun.php";
require_once __DIR__."/../dorayaki/helperDorayaki.php";

/**
 * transactionPayloadValidation is a function to check that all request payload are not null, not 
 * empty, and type must be valid. Used for creating new data.
 * @return boolean indicating valid or not.
 */ 
function transactionPayloadValidation(){
    // Validate existence.
    if (!isset($_POST['dorayaki_id']) || !isset($_POST['dorayaki_nama']) 
        || !isset($_POST['jumlah_item']) || !isset($_POST['category'])){
        return false;
    }    

    // Validate emptyness.
    if ($_POST['dorayaki_id'] == "" || $_POST['dorayaki_nama'] =="" 
        || $_POST['jumlah_item'] == "" || $_POST['category'] =="" ){
        
        echo "<br> 2 <br>";
        return false;
    }

    // Validate type.
    if (!is_numeric($_POST['dorayaki_id']) ||
        !is_numeric($_POST['jumlah_item'])) {
        
        echo "<br> 3 <br>";
        return false;
    }

    // Validate value.
    if (intval($_POST['dorayaki_id'] < 0)){
        echo "<br> 4 <br>";
        return false;
    }
    
    // Validate available value for category.
    if ($_POST['category'] !="pembelian" && $_POST['category'] != "pengubahan"){
        echo "<br> 5 <br>";
        return false;
    }

    // Logic validation.
    if ($_POST['category'] =="pembelian"){
        if (isset($_POST['total_harga'])){
            if (!is_numeric($_POST['total_harga'])){
                return false;
            }
            if (($_POST['total_harga'])==""){
                return false;
            }
            if (intval($_POST['total_harga']) <0){
                return false;
            }
        } else {
            return false;
        }
    } else {
        if (isset($_POST['total_harga'])){
            return false;
        }
    }
    

    return true;
}
