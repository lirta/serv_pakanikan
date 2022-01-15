<?php
 
require_once 'include/DB_Functions.php';
$db = new DB_Functions();
 
// json response array
if (
    isset($_POST['id'])  
    ) {
        $id = $_POST['id'];
        $produk=$db->getProduk($id);
        if ($produk) {
             $response["error"] = FALSE;
            $response["produk"]["id"] = $produk["id"];
            $response["produk"]["nama"] = $produk["nama"];
            $response["produk"]["harga"] = $produk["harga"];
            echo json_encode($response);
        } else {
            $response["error"] = TRUE;
            $response["error_msg"] = "get produk";
            echo json_encode($response);
        }
        
    }