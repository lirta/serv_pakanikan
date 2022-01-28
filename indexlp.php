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
// $dbuser = 'pramudi1_lirta';
// $dbpass = 'IiZmu;6n24u2';
// $dbname = 'pramudi1_pakan_ikan';
// $dbmethod = 'mysql:dbname=';

// $dbhost = '127.0.0.1';
// $dbuser = 'qtsjtszxkx';
// $dbpass = 'nUUG5Ey3nP';
// $dbname = 'qtsjtszxkx';
// $dbmethod = 'mysql:dbname=';

$dsn = $dbmethod.$dbname;
$pdo = new PDO($dsn, $dbuser, $dbpass);
$db  = new NotORM($pdo);

$app-> get('/', function(){
    echo "Sumber Rezeki";
});

$app ->get('/pesanan/{id_konsumen}', function() use($app, $db){
	$dosen["error"] = false;
	$dosen["message"] = "Berhasil mendapatkan data dosen";
    foreach($db->pesanan() as $data){
        $dosen['pesanan'][] = array(
            'id' => $data['uuid'],
            'nama_penerima' => $data['nama_penerima'],
            'alamat_penerima' => $data['alamat_penerima'],
            'hp_penerima' => $data['hp_penerima']
            );
    }
    echo json_encode($dosen);
});