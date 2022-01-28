<?php
 
require_once 'include/DB_Functions.php';
$db = new DB_Functions();
 
// json response array
if (
    isset($_POST['id']) && isset($_POST['status'])
    ) {
    $idp = $_POST['id'];
    $status = $_POST['status'];
    if ($status == "order") {
        $e_status = "Dikemas";
    } else if($status == "Dikemas") {
        $e_status = "Sampai";
    }
    


    $pesanan = $db->posStatus($idp, $e_status);
    if($pesanan){
        $id = $pesanan["id_konsumen"];
        // echo($id);
        $konsumen =$db->getKonsumen($id);
        if ($konsumen) {
            # code...
            $response["error"] = FALSE;
            $response["pesanan"]["id"] = $pesanan["uuid"];
            $response["pesanan"]["id_konsumen"] = $konsumen["nama"];
            $response["pesanan"]["nama_penerima"] = $pesanan["nama_penerima"];
            $response["pesanan"]["alamat_penerima"] = $pesanan["alamat_penerima"];
            $response["pesanan"]["hp_penerima"] = $pesanan["hp_penerima"];
            $response["pesanan"]["kg"] = $pesanan["kg"];
            $response["pesanan"]["total"] = $pesanan["total"];
            $response["pesanan"]["tgl_pemesanan"] = $pesanan["tgl_pemesanan"];
            $response["pesanan"]["status"] = $pesanan["status"];
            $response["pesanan"]["gambar"] = $pesanan["gambar"];
            $response["pesanan"]["tgl_bayar"] = $pesanan["tgl_bayar"];
            echo json_encode($response);
        }else{
            // gagal menyimpan data
            $response["error"] = TRUE;
            $response["error_msg"] = "get konsumen";
            echo json_encode($response);
        }
    }else{
        // gagal menyimpan data
            $response["error"] = TRUE;
            $response["error_msg"] = "mengambil data";
            echo json_encode($response);
    }

    }



    ?>