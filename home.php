<?php
require_once("class/cerita.php");
require_once("class/parent.php");


// echo "tes" . $_SESSION['userid'];
// if(!isset($_SESSION['userid'])) {
// 	header("location: index.php"); //belum login, wajib login dulu
// }
$mysqli = new mysqli("localhost", "root", "", "fullstack_uts");
if ($mysqli->connect_errno) {
	echo "Failed to connect to MySQL: " . $mysqli->connect_error;
}

$PER_PAGE = 3;
$cerita = new cerita();

?>

<!DOCTYPE html>
<html>

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>HALAMAN HOME</title>


	<style type="text/css">
		.rata-kanan {
			text-align: right;
		}

		.poster {
			max-width: 100px;
		}
	</style>
</head>

<body>
	<?php
	$offset = isset($_GET['offset']) ? $_GET['offset'] : 0;
	if (!is_numeric($offset)) $offset = 0;

	$cari = isset($_GET['cari']) ? $_GET['cari'] : "";
	$cari_persen = "%" . $cari . "%";

	// tanpa limit cari jumlah data
	$res = $cerita->getcerita($cari_persen);
	$jumlah_data = $res->num_rows;

	// dengan limit
	$res = $cerita->getcerita($cari_persen, $offset, $PER_PAGE);

	echo "<p>";
	echo "<form method='GET'>";
	echo "<label>Masukkan judul</label> ";
	echo "<input type='text' name='cari'> ";
	echo "<button type='submit'>Cari</button>";
	echo "</form>";
	echo "</p>";
	if (isset($_GET['cari'])) {
		echo "<p><i>Hasil pencarian untuk kata kunci '" . $_GET['cari'] . "'</i></p>";
	}

	echo "<table border='1'>
	<tr> 
		<th>Judul</th> 
		<th>Pembuat Awal</th>
		 <th>Aksi</th>

		 
	</tr>";

	while ($row = $res->fetch_assoc()) {

		echo "<tr>";
		echo "<td>" . $row['judul'] . "</td>";
		echo "<td>" . $row['id_user_pembuat_awal'] . "</td>";
		echo "<td><a href='lihat_cerita.php?id={$row['idcerita']}'>" . 'Lihat Cerita' . "</a></td>";


		echo "</tr>";
	}
	echo "</table>";


	echo "<div>";
	$maks_halaman = ceil($jumlah_data / $PER_PAGE);
	for ($i = 1; $i <= $maks_halaman; $i++) {
		echo "<a href='?offset=" . (($i - 1) * $PER_PAGE) . "&cari1=$cari'>$i</a> ";
	}
	echo "</div>";
	?>
	<br>
	<form method="post" action="cerita_baru.php">
		<a href="cerita_baru.php">
			<input type="button" name="btncerita" value="Cerita Baru"></a><br><br>
	</form>
</body>

</html>