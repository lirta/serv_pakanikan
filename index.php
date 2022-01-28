<?php 
require __DIR__ . '/vendor/autoload.php';
require 'libs/NotORM.php'; 

use \Slim\App;

$app = new App();

$dbhost = '127.0.0.1';
// $dbhost = 'localhost';
// $dbuser = 'pramudi1_lirta';
// $dbpass = 'IiZmu;6n24u2';
// $dbname = 'pramudi1_pakan_ikan';
// $dbmethod = 'mysql:dbname=';


$dbuser = 'root';
$dbpass = '';
$dbname = 'ikan';
$dbmethod = 'mysql:dbname=';

$dsn = $dbmethod.$dbname;
$pdo = new PDO($dsn, $dbuser, $dbpass);
$db  = new NotORM($pdo);

// $app-> get('/', function(){
//     echo "API Mahasiswa";
// });

// $app ->get('/member', function() use($app, $db){
// 	$dosen["error"] = false;
// 	$dosen["message"] = "Berhasil mendapatkan data dosen";
//     foreach($db->tbl_user() as $data){
//         $dosen['member'][] = array(
//             'id' => $data['id'],
//             'name' => $data['name'],
//             'username' => $data['username'],
//             'gambar' => $data['gambar']
//             );
//     }
//     echo json_encode($dosen);
// });
$app-> get('/', function(){
    echo "Sumber Rezeki";
});

$app ->get('/pesanan/{id_konsumen}', function($request, $response, $args) use($app, $db){
	$responseJson["error"] = false;
	$responseJson["message"] = "Berhasil mendapatkan data pesanan";
    foreach($db->pesanan()->where('id_konsumen',$args['id_konsumen']) as $data){
        $responseJson['pesanan'][] = array(
            'id' => $data['uuid'],
            'nama_penerima' => $data['nama_penerima'],
            'alamat_penerima' => $data['alamat_penerima'],
            'hp_penerima' => $data['hp_penerima'],
            'kg' => $data['kg'],
            'total' => $data['total'],
            'tgl_pemesanan' => $data['tgl_pemesanan'],
            'status' => $data['status'],
            'gambar' => $data['gambar'],
            'tgl_bayar' => $data['tgl_bayar']
            );
    }
    echo json_encode($responseJson);
});

$app ->get('/pesananAdmin', function() use($app, $db){
	$dosen["error"] = false;
	$dosen["message"] = "Berhasil mendapatkan data dosen";
    foreach($db->pesanan()->where('status','order') as $data){
        $dosen['pesanan'][] = array(
            'id' => $data['uuid'],
            'nama_penerima' => $data['nama_penerima'],
            'alamat_penerima' => $data['alamat_penerima'],
            'hp_penerima' => $data['hp_penerima'],
            'kg' => $data['kg'],
            'total' => $data['total'],
            'tgl_pemesanan' => $data['tgl_pemesanan'],
            'status' => $data['status'],
            'gambar' => $data['gambar'],
            'tgl_bayar' => $data['tgl_bayar']
            );
    }
    echo json_encode($dosen);
});
$app ->get('/pesananDikemas', function() use($app, $db){
	$dosen["error"] = false;
	$dosen["message"] = "Berhasil mendapatkan data pesanan Dikemas";
    foreach($db->pesanan()->where('status','Dikemas') as $data){
        $dosen['pesanan'][] = array(
            'id' => $data['uuid'],
            'nama_penerima' => $data['nama_penerima'],
            'alamat_penerima' => $data['alamat_penerima'],
            'hp_penerima' => $data['hp_penerima'],
            'kg' => $data['kg'],
            'total' => $data['total'],
            'tgl_pemesanan' => $data['tgl_pemesanan'],
            'status' => $data['status'],
            'gambar' => $data['gambar'],
            'tgl_bayar' => $data['tgl_bayar']
            );
    }
    echo json_encode($dosen);
});
$app ->get('/pesananDikirim', function() use($app, $db){
	$dosen["error"] = false;
	$dosen["message"] = "Berhasil mendapatkan data pesanan Dikirim";
    foreach($db->pesanan()->where('status','Dikirim') as $data){
        $dosen['pesanan'][] = array(
            'id' => $data['uuid'],
            'nama_penerima' => $data['nama_penerima'],
            'alamat_penerima' => $data['alamat_penerima'],
            'hp_penerima' => $data['hp_penerima'],
            'kg' => $data['kg'],
            'total' => $data['total'],
            'tgl_pemesanan' => $data['tgl_pemesanan'],
            'status' => $data['status'],
            'gambar' => $data['gambar'],
            'tgl_bayar' => $data['tgl_bayar']
            );
    }
    echo json_encode($dosen);
});




//run App
$app->run();