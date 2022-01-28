<?php
 
require_once 'include/DB_Functions.php';
$db = new DB_Functions();
 
// json response array
if (
    isset($_POST['id_konsumen']) && 
    isset($_POST['nama_penerima']) && 
    isset($_POST['alamat_penerima']) && 
    isset($_POST['hp_penerima']) && 
    isset($_POST['kg']) &&
    isset($_POST['total'])
    ) {
    $id_konsumen = $_POST['id_konsumen'];
    $nama_penerima = $_POST['nama_penerima'];
    $alamat_penerima = $_POST['alamat_penerima'];
    $hp_penerima = $_POST['hp_penerima'];
    $kg = $_POST['kg'];
    $total = $_POST['total'];
    $tgl_pemesanan = date('d-M-Y');
    $status = "order";
    $bayar= $kg * $total;


    $pesanan = $db->simpanpesanan($id_konsumen, $nama_penerima, $alamat_penerima, $hp_penerima, $kg, $bayar, $tgl_pemesanan, $status );
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
            // $response["pesanan"]["gambar"] = $pesanan["gambar"];
            // $response["pesanan"]["tgl_bayar"] = $pesanan["tgl_bayar"];
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
            $response["error_msg"] = "gagal simpan data pesanan";
            echo json_encode($response);
    }

    }



    ?>