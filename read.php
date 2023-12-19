<?php
require_once('class/cerita.php');
$cerita = new Cerita;

if (isset($_GET['id'])) {
	$id = $_GET['id'];
	$detail_cerita = $cerita->detailcerita($id);
	if (empty($detail_cerita)) {
		echo "Data kosong";
	}
}
?>

<!DOCTYPE html>
<html>

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>LIHAT CERITA DETAIL</title>
</head>

<body>
	<?php
	echo '<h2>Judul : ' . $detail_cerita[0]['judul'] . '</h2>';
	foreach ($detail_cerita as $key => $value) {
		echo '<p>' . $value['isiparagraf'] . '</p>';
	}
	?>
	<form method="post" action="proses_add_cerita.php">
		<input type="hidden" name="idcerita" value="<?= $detail_cerita[0]['idcerita']; ?>">
		<input type="hidden" name="judul" value="<?= $detail_cerita[0]['judul']; ?>">
		<label>Tambah Paragraf :</label>
		<textarea type='text' name='tambah'></textarea>
		<br>
		<button>Simpan</button>
	</form>
	<a href="home.php"> kembali ke halaman awal </a>



</body>

</html>