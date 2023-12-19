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
$PER_PAGE = 4;

$halaman = isset($_POST['halaman']) ? intval($_POST['halaman']) : 1;
$offset = ($halaman - 1) * $PER_PAGE;
// var_dump($offset,$PER_PAGE);
// $cari = isset($_POST['cari']) ? $_POST['cari'] : "";
// $search = "%" . $cari . "%";
// var_dump('kumpulan_cerita',$halaman,$offset);
$res_all = $cerita->getceritaall($offset,$PER_PAGE);

$responseArray = [
    'cerita_all' => [],
];

while ($row_all = $res_all->fetch_assoc()) {
    $responseArray['cerita_all'][] = $row_all;
}
$responseArray['halamanSaatIni'] = $halaman;
// var_dump($responseArray);
echo json_encode($responseArray);
?>
