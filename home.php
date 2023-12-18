<?php
require_once("class/parent.php");
require_once("class/cerita.php");

// session_start();

if (!isset($_SESSION['userid'])) {
	header("location: index.php");
}

$mysqli = new mysqli("localhost", "root", "", "fullstack_uts");

if ($mysqli->connect_errno) {
	echo "Failed to connect to MySQL: " . $mysqli->connect_error;
}

$PER_PAGE = 3;
$cerita = new cerita();

$offset = isset($_GET['offset']) && is_numeric($_GET['offset']) ? $_GET['offset'] : 0;
$cari = isset($_GET['cari']) ? $_GET['cari'] : "";
$search = "%" . $cari . "%";

$res = $cerita->getcerita($search);
$jumlah_data = $res->num_rows;
$res_all = $cerita->getceritaall();

$res = $cerita->getcerita($search, $offset, $PER_PAGE);
?>

<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="css/custom_css.css">
	<link rel="stylesheet" href="css/home_css.css">
	<script type="text/javascript" src="js/jquery-3.7.1.js"></script>
	<title>HALAMAN HOME</title>
</head>

<body>
	<div class="container">
		<div class="title">
			<h1>Cerbung</h1>
			<p>Cerita Bersambung</p>
		</div>
		<div class="kategori-combobox">
			<label for="kategori">Pilih Kategori:</label>
			<select id="kategori" >
				<option value="kumpulan-cerita">Kumpulan Cerita</option>
				<option value="ceritaku">Ceritaku</option>
			</select>
		</div>
		<div class="container-content">
			<div class="ceritaku-container">
				<h1>ceritaku</h1>
				<div class="ceritaku-cards-container">
					<?php while ($row = $res->fetch_assoc()) : ?>
						<div class="card">
							<h2><?= $row['judul'] ?></h2>
							<p>Pembuat Awal: <?= $row['nama'] ?></p>
							<p>Jumlah Paragraf: <?= $row['jumlah_paragraf'] ?></p>
							<div class="actions"><a href="lihat_cerita.php?id=<?= $row['idcerita'] ?>">Lihat Cerita</a></div>
						</div>
					<?php endwhile; ?>
				</div>
			</div>
			<div class="kumpulan-cerita-container">
				<h1>kumpulan cerita</h1>
				<div class="kumpulan-cerita-cards-container">
					<?php while ($row = $res_all->fetch_assoc()) : ?>
						<div class="card">
							<h2><?= $row['judul'] ?></h2>
							<p>Pembuat Awal: <?= $row['nama'] ?></p>
							<p>Jumlah Paragraf: <?= $row['jumlah_paragraf'] ?></p>
							<div class="actions"><a href="lihat_cerita.php?id=<?= $row['idcerita'] ?>">Lihat Cerita</a></div>
						</div>
					<?php endwhile; ?>
				</div>
				<div>
					<?php for ($i = 1; $i <= ceil($jumlah_data / $PER_PAGE); $i++) : ?>
						<a href='?offset=<?= (($i - 1) * $PER_PAGE) ?>&cari1=<?= $cari ?>'><?= $i ?></a>
					<?php endfor; ?>
				</div>
			</div>
		</div>
	</div>
</body>

<script>
	$(document).ready(function() {
		$('#kategori').change(function() {
			var selectedKategori = $(this).val();
			if (selectedKategori === 'ceritaku') {
				$('.kumpulan-cerita-container').hide();
				$('.ceritaku-container').show();
			} else if (selectedKategori === 'kumpulan-cerita') {
				$('.ceritaku-container').hide();
				$('.kumpulan-cerita-container').show();
			}
		});
	});
</script>

</html>