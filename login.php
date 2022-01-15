<?php
require_once 'include/DB_Functions.php';
$db = new DB_Functions();
 
// json response array
$response = array("error" => FALSE);
 
if (isset($_POST['email']) && isset($_POST['password'])) {
 
    // menerima parameter POST ( email dan password )
    $email = $_POST['email'];
    $password = $_POST['password'];
 
    // get the user by email and password
    // get user berdasarkan email dan password
    $userm = $db->getUserByEmailAndPassword($email, $password);
 
    if ($userm != false) {
        // userm ditemukan
        $response["error"] = FALSE;
        $response["user"]["id"] = $userm["uuid"];
        $response["user"]["nama"] = $userm["nama"];
        $response["user"]["hp"] = $userm["hp"];
        $response["user"]["alamat"] = $userm["alamat"];
        $response["user"]["alamat"] = $userm["email"];
        $response["user"]["gambar"] = $userm["gambar"];
        $response["user"]["rules"] = $userm["rules"];
        echo json_encode($response);
    } else {
        // get user berdasarkan username
        $useru = $db->getUserByEmailAndPassword($email, $email);
        $response["error"] = TRUE;
        $response["error_msg"] = "Login gagal. Password,Email/email salah";
        echo json_encode($response);
    
    }
} else {
    $response["error"] = TRUE;
    $response["error_msg"] = "Parameter (email atau password) ada yang kurang";
    echo json_encode($response);
}
?>