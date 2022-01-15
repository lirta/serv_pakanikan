<?php
 
require_once 'include/DB_Functions.php';
$db = new DB_Functions();
 
// json response array
if (
    isset($_POST['id']) 
    ){
        $id = $_POST['id'];
        // echo ($id);
        $user = $db->getUser($id);
        if ($user) {
            # code...
            $response["error"] = FALSE;
            $response["user"]["id"] = $user["uuid"];
            $response["user"]["nama"] = $user["nama"];
            $response["user"]["hp"] = $user["hp"];
            $response["user"]["alamat"] = $user["alamat"];
            $response["user"]["email"] = $user["email"];
            $response["user"]["gambar"] = $user["gambar"];
            $response["user"]["rules"] = $user["rules"];
            echo json_encode($response);
        }else{
            // gagal menyimpan data
            $response["error"] = TRUE;
            $response["error_msg"] = "Terjadi kesalahan saat get user";
            echo json_encode($response);
        }
    }