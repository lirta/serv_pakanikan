<?php 
    require_once 'include/DbOperation.php';
    define('UPLOAD_PATH', 'gambar/');
 
    $response = array(); 
     
    if($_SERVER['REQUEST_METHOD']=='POST'){
        $id = $_POST['id'];
        // $jumlah = $_POST['jumlah'];
        $namagambar = substr(sha1(time()), 0, 16);
        $tgl_pemesanan = date('d-M-Y');
         
        $db = new DbOperation(); 
 
        $result = $db->inserPembayaran($id, $tgl_pemesanan, $namagambar . '.jpg');
         
        if($result == 0) {
            $response['error'] = false; 
            $response['message'] = 'Gambar berhasil diupload';
            $response['gambar'] = $namagambar.'.jpg';
             
            if(isset($_FILES['filegambar']['name']) && isset($_POST['id']) ){
                try{
                    $namagambar = $namagambar . '.jpg';
                    move_uploaded_file($_FILES['filegambar']['tmp_name'], UPLOAD_PATH . $namagambar);
                }catch(Exception $e){
                    $response['error'] = true;
                    $response['upload'] = 'Tidak bisa mengupload Gambar';
                }
            }else{
                $response['error'] = true;
                $response['message'] = "Parameter kosong";
            }
        } elseif($result == 2) {
            $response['error'] = true; 
            $response['message'] = 'Gambar telah ada';
        } else {
            $response['error'] = true;
            $response['message']='Gambar tidak dapat diupload';
        }
    } else {
        $response['error']=true;
        $response['message']='Invalid Request...';
    }
 
    echo json_encode($response);