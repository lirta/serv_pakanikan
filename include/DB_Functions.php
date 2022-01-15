<?php
 
class DB_Functions {
 
    private $conn;
 
    // constructor
    function __construct() {
        require_once 'DB_Connect.php';
        // koneksi ke database
        $db = new Db_Connect();
        $this->conn = $db->connect();
    }
 
    // destructor
    function __destruct() {
         
    }
    //register
    public function simpanUser($nama, $hp, $alamat, $email, $password, $gambar, $rules) {
        $uuid = uniqid('', true);
        $hash = $this->hashSSHA($password);
        $encrypted_password = $hash["encrypted"]; // encrypted password
        // $salt = $hash["salt"]; // salt
 
        $stmt = $this->conn->prepare("INSERT INTO user(uuid, nama, hp, alamat, email, password, gambar, rules) VALUES(?,?,?,?,?,?,?,?)");
        $stmt->bind_param("ssssssss", $uuid, $nama, $hp, $alamat, $email, $encrypted_password, $gambar, $rules);
        $result = $stmt->execute();
        $stmt->close();
 
        // cek jika sudah sukses
        if ($result) {
            $stmt = $this->conn->prepare("SELECT * FROM user WHERE email = ?");
            $stmt->bind_param("s", $email);
            $stmt->execute();
            $user = $stmt->get_result()->fetch_assoc();
            $stmt->close();
 
            return $user;
        } else {
            return false;
        }
    }

    // public function getUser($id) {
    //         $stmt = $this->conn->prepare("SELECT * FROM user WHERE uuid = ?");
    //         $stmt->bind_param("s", $id);
    //         if ($$stmt->execute()) {
    //         $user = $stmt->get_result()->fetch_assoc();
    //         $stmt->close();
    //         return $user;
    //         }else{
    //             return null;
    //         }
    // }

    public function getUser($id){
        $stmt = $this->conn->prepare("SELECT * FROM user WHERE uuid = ?");
        $stmt->bind_param("s", $id);
        if ($stmt->execute()) {
            $user = $stmt->get_result()->fetch_assoc();
            $stmt->close();
            return $user;
            # code...
        }else{
            return null;
        }
    }
    //pesanan
    public function simpanpesanan($id_konsumen, $nama_penerima, $alamat_penerima, $hp_penerima, $kg, $bayar, $tgl_pemesanan, $status) {
        $uuid = uniqid('', true);// encrypted password
        // $salt = $hash["salt"]; // salt
 
        $stmt = $this->conn->prepare("INSERT INTO pesanan(uuid, id_konsumen, nama_penerima, alamat_penerima, hp_penerima, kg, total, tgl_pemesanan, status) VALUES(?,?,?,?,?,?,?,?,?)");
        $stmt->bind_param("sssssssss", $uuid, $id_konsumen, $nama_penerima, $alamat_penerima, $hp_penerima, $kg, $bayar, $tgl_pemesanan, $status);
        $result = $stmt->execute();
        $stmt->close();
 
        // cek jika sudah sukses
        if ($result) {
            $stmt = $this->conn->prepare("SELECT * FROM pesanan  WHERE uuid = ?");
            $stmt->bind_param("s", $uuid);
            $stmt->execute();
            $pesanan = $stmt->get_result()->fetch_assoc();
            $stmt->close();
 
            return $pesanan;
        } else {
            return false;
        }
    }
    public function getKonsumen($id) {
            $stmt = $this->conn->prepare("SELECT * FROM user  WHERE uuid = ?");
            $stmt->bind_param("s", $id);
            $stmt->execute();
            $konsumen = $stmt->get_result()->fetch_assoc();
            $stmt->close();
 
            return $konsumen;
    }
    public function getProduk($id) {
            $stmt = $this->conn->prepare("SELECT * FROM produk  WHERE id = ?");
            $stmt->bind_param("s", $id);
            $stmt->execute();
            $produk = $stmt->get_result()->fetch_assoc();
            $stmt->close();
 
            return $produk;
    }
 
    /**
     * Get user berdasarkan email dan password
     */
    public function getUserByEmailAndPassword($email, $password) {
 
        $stmt = $this->conn->prepare("SELECT * FROM user WHERE email = ?");
 
        $stmt->bind_param("s", $email);
 
        if ($stmt->execute()) {
            $userm = $stmt->get_result()->fetch_assoc();
            $stmt->close();
 
            // verifikasi password userm
            $encrypted_password = $userm['password'];
            $hash = $this->checkhashSSHA($password);
            // cek password jika sesuai
            if ($encrypted_password == $hash) {
                // autentikasi userm berhasil
                return $userm;
            }
        } else {
            return NULL;
        }
    }
    
    /**
     * Cek User ada atau tidak
     */
    public function isUserExisted($email) {
        $stmt = $this->conn->prepare("SELECT email from user WHERE email = ?");
 
        $stmt->bind_param("s", $email);
 
        $stmt->execute();
 
        $stmt->store_result();
 
        if ($stmt->num_rows > 0) {
            // user telah ada 
            $stmt->close();
            return true;
        } else {
            // user belum ada 
            $stmt->close();
            return false;
        }
    }

    


    /**
     * edit user name
     */
    // cek username
    public function getUsername($username){
        $stmt = $this->conn->prepare("SELECT username from tbl_user WHERE username = ?");
 
        $stmt->bind_param("s", $username);
 
        $stmt->execute();
 
        $stmt->store_result();
        // return $username;

        if ($stmt->num_rows > 0) {
            // user telah ada 
            $stmt->close();

            return true;
        } else {
            // user belum ada 
            $stmt->close();

            return false;
        }
    }

    // edit username
    function editusername($username, $email){
        $stmt = $this->conn->prepare("UPDATE  tbl_user SET username = ? WHERE email = ?");

        $stmt->bind_param("ss",$username,$email);
        $result = $stmt->execute();
        $stmt->close();

        if($result){
            $stmt = $this->conn->prepare("SELECT * FROM tbl_user WHERE email=?");
            $stmt->bind_param("s", $email);
            $stmt->execute();
            $user = $stmt->get_result()->fetch_assoc();
            $stmt->close();

            return $user;
        }else{
            return false;
        }

    }
 
    /**
     * edit email
     */
    // cek email yg baru
    public function getEmail($email){
        $stmt = $this->conn->prepare("SELECT username from tbl_user WHERE email = ?");
 
        $stmt->bind_param("s", $email);
 
        $stmt->execute();
 
        $stmt->store_result();
        // return $username;

        if ($stmt->num_rows > 0) {
            // user telah ada 
            $stmt->close();

            return true;
        } else {
            // user belum ada 
            $stmt->close();

            return false;
        }
    }

    // edit email
    function editemail($username, $email){
        $stmt = $this->conn->prepare("UPDATE  tbl_user SET email = ? WHERE username = ?");

        $stmt->bind_param("ss",$email,$username);
        $result = $stmt->execute();
        $stmt->close();

        if($result){
            $stmt = $this->conn->prepare("SELECT * FROM tbl_user WHERE email=?");
            $stmt->bind_param("s", $email);
            $stmt->execute();
            $user = $stmt->get_result()->fetch_assoc();
            $stmt->close();

            return $user;
        }else{
            return false;
        }

    }

    public function cekPassword($email, $oldpassword, $passwordd) {
        $stmt = $this->conn->prepare("SELECT * FROM tbl_user WHERE email = ?");
 
        $stmt->bind_param("s", $email);
 
        $stmt->execute();
        $userm = $stmt->get_result()->fetch_assoc();
        $stmt->close();
        
        $password = $oldpassword;
        // verifikasi password userm
        $encrypted_password = $userm['encrypted_password'];
        $hash = $this->checkhashSSHA($password);
        // cek password jika sesuai
        if ($encrypted_password == $hash) {
            $password = $passwordd;
            $hash = $this->hashSSHA($password);
            $encrypted_password = $hash["encrypted"];

            $stmt = $this->conn->prepare("UPDATE  tbl_user SET encrypted_password = ? WHERE email = ?");

            $stmt->bind_param("ss",$encrypted_password,$email);
            $result = $stmt->execute();
            $stmt->close();
            return true;
        } else {
            return false;
        }
    }



    public function editprofile($name , $email){
        $stmt = $this->conn->prepare("UPDATE  tbl_user SET name = ? WHERE email = ?");

        $stmt->bind_param("ss",$name,$email);
        $result = $stmt->execute();
        $stmt->close();

        if($result){
            $stmt = $this->conn->prepare("SELECT * FROM tbl_user WHERE email=?");
            $stmt->bind_param("s", $email);
            $stmt->execute();
            $user = $stmt->get_result()->fetch_assoc();
            $stmt->close();

            return $user;
        }else{
            return false;
        }

    }

    

    
    // public function getUser($email){
    //     $stmt = $this->conn->prepare("SELECT * FROM tbl_user WHERE email = ?");
    //     $stmt->bind_param("s", $email);
    //     if ($stmt->execute()) {
    //         $user = $stmt->get_result()->fetch_assoc();
    //         $stmt->close();
    //         return $user;
    //         # code...
    //     }else{
    //         return null;
    //     }
    // }

    //device
    //cek device
    public function cekDevice($deviceId){
        $stmt = $this->conn->prepare("SELECT deviceId from tbl_device WHERE deviceId = ?");
 
        $stmt->bind_param("s", $deviceId);
 
        $stmt->execute();
 
        $stmt->store_result();
 
        if ($stmt->num_rows > 0) {
            // user telah ada 
            $stmt->close();
            return true;
        } else {
            // user belum ada 
            $stmt->close();
            return false;
        }
    }
    //insert device
    public function insertDevice(
        $androidId,
        $device,
        $deviceId,
        $deviceType,
        $deviceModel,
        $deviceManufactur,
        $deviceVersionSDK,
        $deviceProduct,
        $deviceHost,
        $imei,
        $lat,
        $long,
        $userId
    ){
        $stmt = $this->conn->prepare("INSERT INTO tbl_device(
            id_user,
            androidId,
            device,
            deviceId,
            deviceType,
            deviceModel,
            deviceManufactur,
            deviceVersionSDK,
            deviceProduct,
            deviceHost,
            imei,
            locationLat,
            locationLong
            ) VALUES(?,?,?,?,?,?,?,?,?,?,?,?,?)");
        $stmt->bind_param("sssssssssssss", 
                                    $userId,
                                    $androidId,
                                    $device,
                                    $deviceId,
                                    $deviceType,
                                    $deviceModel,
                                    $deviceManufactur,
                                    $deviceVersionSDK,
                                    $deviceProduct,
                                    $deviceHost,
                                    $imei,
                                    $lat,
                                    $long
                                    );
        $result = $stmt->execute();
        $stmt->close();
        if ($result) {
            # code...
            return true;
        }else{
            return false;
        }
        
    }
    //update device

    public function updateDevice(
        $androidId,
            $device,
            $deviceId,
            $deviceType,
            $deviceModel,
            $deviceManufactur,
            $deviceVersionSDK,
            $deviceProduct,
            $deviceHost,
            $imei,
            $lat,
            $long,
            $userId
    ){
        $stmt = $this->conn->prepare("UPDATE tbl_device SET
            androidId= ?,
            device = ?,
            deviceType =?,
            deviceModel = ?,
            deviceManufactur=?,
            deviceVersionSDK=?,
            deviceProduct=?,
            deviceHost=?,
            imei=?,
            locationLat=?,
            locationLong=?,
            id_user = ?
            WHERE 
            deviceId = ?");
        $stmt->bind_param("sssssssssssss", 
                                    $androidId,
                                    $device,
                                    $deviceType,
                                    $deviceModel,
                                    $deviceManufactur,
                                    $deviceVersionSDK,
                                    $deviceProduct,
                                    $deviceHost,
                                    $imei,
                                    $lat,
                                    $long,
                                    $userId,
                                    $deviceId);
        $result = $stmt->execute();
        $stmt->close();
        if ($result) {
            # code...
            return true;
        }else{
            return false;
        }
    }


    //login with google

    public function cekEmailGoogle($email, $gambar, $name){
        $stmt = $this->conn->prepare("SELECT * FROM tbl_user WHERE email = ?");
 
        $stmt->bind_param("s", $email); 

        if ($stmt->execute()) {
            $user = $stmt->get_result()->fetch_assoc();
            $stmt->close();

            return $user;

        }else{
            return null;
        }
    }

    public function save($email, $gambar, $name){
            $uuid = uniqid('', true);
            $stmt = $this->conn->prepare("INSERT INTO tbl_user(unique_id, name, username, email, gambar) VALUES(?, ?, ?, ?, ?)");
            $stmt->bind_param("sssss", $uuid, $name, $email, $email, $gambar);
            $result = $stmt->execute();
            $stmt->close();
    
            // cek jika sudah sukses
            if ($result) {
                $stmt = $this->conn->prepare("SELECT * FROM tbl_user WHERE email = ?");
                $stmt->bind_param("s", $email);
                $stmt->execute();
                $user = $stmt->get_result()->fetch_assoc();
                $stmt->close();
    
                return $user;
            } else {
                return NULL;
            }
    }






// =========================================================================
     /**
     * Encrypting password
     * @param password
     * returns salt and encrypted password
     */

    public function getMember(){
        $stmt = $this->conn->prepare("SELECT * FROM tbl_user WHERE email = ?");
        
        if ($stmt->execute()) {
            $member[] = $stmt->get_result()->fetch_assoc();
            $stmt->close();
            // $user[]=$member;
            return $member;
            # code...
        }else{
            return null;
        }
    }




    public function hashSSHA($password) {
 
        $salt = sha1(rand());
        $salt = substr(0, 10);
        $encrypted = base64_encode(sha1($password, true));
        $hash = array( "encrypted" => $encrypted);
        return $hash;
    }
 
    /**
     * Decrypting password
     * @param salt, password
     * returns hash string
     */
    public function checkhashSSHA($password) {
 
        $hash = base64_encode(sha1($password, true));
 
        return $hash;
    }
 
}
 
?>