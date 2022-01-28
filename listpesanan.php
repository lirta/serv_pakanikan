<?php
 
require_once 'include/DB_Functions.php';
$db = new DB_Functions();
 
// json response array
if (
    isset($_POST['id_konsumen'])
    ) {
    $id_konsumen = $_POST['id_konsumen'];
    // echo($id_konsumen);


    $pesanan = $db->getpesanan($id_konsumen);
    if($pesanan){
         # code...
            $response["error"] = FALSE;
            $response["pesanan"] = $pesanan;
            echo json_encode($response);
       
    }else{
        // gagal menyimpan data
            $response["error"] = TRUE;
            $response["error_msg"] = "gagal get data";
            echo json_encode($response);
    }

    }



    ?>