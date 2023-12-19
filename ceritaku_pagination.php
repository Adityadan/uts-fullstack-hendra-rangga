<?php
session_start();
header("Content-type:text/html; charset=UTF-8");
header("Content-type:application/json");
require_once("class/cerita.php");
require_once("class/parent.php");

if (!isset($_SESSION['userid'])) {
    header("location: index.php");
}

$mysqli = new mysqli("localhost", "root", "", "fullstack_uts");

if ($mysqli->connect_errno) {
    echo "Failed to connect to MySQL: " . $mysqli->connect_error;
}

$cerita = new cerita();
// Asumsikan $PER_PAGE didefinisikan secara global atau dalam kelas
$PER_PAGE = 3;

// Hitung offset berdasarkan halaman saat ini
$halaman = isset($_POST['halaman']) ? intval($_POST['halaman']) : 1;
$offset = ($halaman - 1) * $PER_PAGE;
$idusers = $_SESSION['userid'];
// Panggil fungsi getcerita dengan parameter paginasi
// var_dump('ceritaku',$halaman,$offset);
$res = $cerita->getcerita($idusers, /* $search, */ $offset, $PER_PAGE);

// Bangun array respons
$responseArray = [
    'cerita_user' => [],
];
while ($row = $res->fetch_assoc()) {
    $responseArray['cerita_user'][] = $row;
}

// Sertakan informasi tambahan untuk klien, seperti halaman saat ini
$responseArray['halamanSaatIni'] = $halaman;

// Encode dan echo array sebagai JSON
echo json_encode($responseArray);
?>
