<?php 
require __DIR__ . '/vendor/autoload.php';
require 'libs/NotORM.php'; 

use \Slim\App;

$app = new App();

$dbhost = '127.0.0.1';
$dbuser = 'root';
$dbpass = '';
$dbname = 'ikan';
$dbmethod = 'mysql:dbname=';

// $dbhost = '127.0.0.1';
// $dbuser = 'qtsjtszxkx';
// $dbpass = 'nUUG5Ey3nP';
// $dbname = 'qtsjtszxkx';
// $dbmethod = 'mysql:dbname=';

$dsn = $dbmethod.$dbname;
$pdo = new PDO($dsn, $dbuser, $dbpass);
$db  = new NotORM($pdo);

$app-> get('/', function(){
    echo "API Mahasiswa";
});

$app ->get('/member', function() use($app, $db){
	$dosen["error"] = false;
	$dosen["message"] = "Berhasil mendapatkan data dosen";
    foreach($db->tbl_user() as $data){
        $dosen['member'][] = array(
            'id' => $data['id'],
            'name' => $data['name'],
            'username' => $data['username'],
            'gambar' => $data['gambar']
            );
    }
    echo json_encode($dosen);
});

$app ->get('/dosen/{nama}', function($request, $response, $args) use($app, $db){
    $dosen = $db->tbl_dosen()->where('nama',$args['nama']);
    $dosendetail = $dosen->fetch();

    if ($dosen->count() == 0) {
        $responseJson["error"] = true;
        $responseJson["message"] = "Nama dosen belum tersedia di database";
        $responseJson["nama"] = null;
        $responseJson["matkul"] = null;
        $responseJson["no_hp"] = null;
    } else {
        $responseJson["error"] = false;
        $responseJson["message"] = "Berhasil mengambil data";
        $responseJson["nama"] = $dosendetail['nama'];
        $responseJson["matkul"] = $dosendetail['matkul'];
        $responseJson["no_hp"] = $dosendetail['no_hp'];
    }

    echo json_encode($responseJson); 
});

$app ->get('/matkul', function() use($app, $db){
    if ($db->tbl_matkul()->count() == 0) {
        $responseJson["error"] = true;
        $responseJson["message"] = "Belum mengambil mata kuliah";
    } else {
        $responseJson["error"] = false;
        $responseJson["message"] = "Berhasil mendapatkan data mata kuliah";
        foreach($db->tbl_matkul() as $data){
        $responseJson['semuamatkul'][] = array(
            'id' => $data['id'],
            'nama_dosen' => $data['nama_dosen'],
            'matkul' => $data['matkul']
            );
        }
    }
    echo json_encode($responseJson);
});

$app->post('/matkul', function($request, $response, $args) use($app, $db){
    $matkul = $request->getParams();
    $result = $db->tbl_matkul->insert($matkul);

    $responseJson["error"] = false;
    $responseJson["message"] = "Berhasil menambahkan ke database";
    echo json_encode($responseJson);
});

$app->delete('/matkul/{id}', function($request, $response, $args) use($app, $db){
    $matkul = $db->tbl_matkul()->where('id', $args);
    if($matkul->fetch()){
        $result = $matkul->delete();
        echo json_encode(array(
            "error" => false,
            "message" => "Matkul berhasil dihapus"));
    }
    else{
        echo json_encode(array(
            "error" => true,
            "message" => "Matkul ID tersebut tidak ada"));
    }
});

//run App
$app->run();