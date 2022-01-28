<?php
 
require_once 'include/DB_Functions.php';
$db = new DB_Functions();
 
// json response array
if (
    isset($_POST['nama']) && 
    isset($_POST['hp']) && 
    isset($_POST['alamat']) && 
    isset($_POST['email']) && 
    isset($_POST['password']) 
    ) {
 
    // menerima parameter POST ( name, email, password )
    $nama = $_POST['nama'];
    $hp = $_POST['hp'];
    $alamat = $_POST['alamat'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $rules = "3";
    $gambar = "defult.jpg";
    // Cek jika user ada dengan email dan username yang sama
    if ($db->isUserExisted($email)) {
        // user telah ada
        $response["error"] = TRUE;
        $response["error_msg"] = "User telah ada dengan email " . $email;
        echo json_encode($response);
    }else  {
        // buat user baru
        $user = $db->simpanUser($nama, $hp, $alamat, $email, $password, $gambar, $rules );
        if ($user) {
            // simpan user berhasil
            $response["error"] = FALSE;
            $response["user"]["id"] = $user["uuid"];
            $response["user"]["nama"] = $user["nama"];
            $response["user"]["hp"] = $user["hp"];
            $response["user"]["alamat"] = $user["alamat"];
            $response["user"]["email"] = $user["email"];
            $response["user"]["gambar"] = $user["gambar"];
            $response["user"]["rules"] = $user["rules"];
            echo json_encode($response);
        } else {
            // gagal menyimpan data
            $response["error"] = TRUE;
            $response["error_msg"] = "Terjadi kesalahan saat melakukan registrasi";
            echo json_encode($response);
        }
    }
} else {
    $response["error"] = TRUE;
    $response["error_msg"] = "Parameter (name, email, username, atau password) ada yang kurang";
    // $response["data"]=$_POST['name'];
    echo json_encode($response);
}
// echo('error');
?>