<?php
session_start();

// Memeriksa apakah sesi sudah dimulai atau belum
if (!isset($_SESSION['userid'])) {
    // Redirect ke halaman login jika belum login
    header("Location: index.php");
    exit;
}
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
			<select id="kategori">
				<option value="">Pilih</option>
				<option value="kumpulan-cerita">Kumpulan Cerita</option>
				<option value="ceritaku">Ceritaku</option>
			</select>
		</div>
		<div class="container-content">
			<div class="ceritaku-container">
				<h1>ceritaku</h1>
				<div class="ceritaku-cards-container">
				</div>
				<button id="more_ceritaku">Tampilkan Cerita Selanjutnya</button>
			</div>
			<div class="kumpulan-cerita-container">
				<h1>kumpulan cerita</h1>
				<div class="kumpulan-cerita-cards-container">
				</div>
				<button id="more_kumpulan_cerita">Tampilkan Cerita Selanjutnya</button>
			</div>
		</div>
		<button id="logout" style="width: min-content;">Logout</button>

	</div>
</body>

<script>
	$(document).ready(function() {
		/* JQUERY UNTUK MENYEMBUNYIKAN COMBOBOX */
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
		load_ceritaku();
		load_kumpulan_cerita();
		$('#logout').click(function() {
			logout();
		});
	});

	var halaman_ceritaku = 1;
	var halaman_kumpulan_cerita = 1;

	function load_ceritaku() {
		var cerita_user_html = "";
		$.ajax({
			type: "POST",
			url: "ceritaku_pagination.php",
			data: {
				halaman: halaman_ceritaku,
			},
			dataType: "json",
			success: function(response) {
				cerita_user_html = ""; 
				if (response.cerita_user.length > 0) {
					$.each(response.cerita_user, function(index, row) {
						cerita_user_html += `
                        <div class="card">
                            <h2>${row.judul}</h2>
                            <p>Pembuat Awal: ${row.nama}</p>
                            <p>Jumlah Paragraf: ${row.jumlah_paragraf}</p>
                            <div class="actions"><a href="read.php?id=${row.idcerita}">baca lebih lanjut</a></div>
                        </div>
                    `;
					});
					$(".ceritaku-cards-container").html(cerita_user_html);
					halaman_ceritaku++;
					$('#more_ceritaku').toggle(true);
				} else {
					alert('Tidak Ada Data Cerita Lagi');
					$('#more_ceritaku').toggle(false);

				}
			}
		});
	}

	function load_kumpulan_cerita() {
		var cerita_all_html = "";

		$.ajax({
			type: "POST",
			url: "kumpulan_cerita_pagination.php",
			data: {
				halaman: halaman_kumpulan_cerita,
			},
			dataType: "json",
			success: function(response) {
				console.log(response);
				cerita_all_html = ""; 
				if (response.cerita_all.length > 0) {
					$.each(response.cerita_all, function(index, row) {
						cerita_all_html += `
                        <div class="card">
                            <h2>${row.judul}</h2>
                            <p>Pembuat Awal: ${row.nama}</p>
                            <p>Jumlah Paragraf: ${row.jumlah_paragraf}</p>
                            <div class="actions"><a href="read.php?id=${row.idcerita}">baca lebih lanjut</a></div>
                        </div>
                    `;
					});
					$(".kumpulan-cerita-cards-container").html(cerita_all_html);
					halaman_kumpulan_cerita++;
					$('#more_kumpulan_cerita').toggle(true);
				} else {
					alert('Tidak Ada Data Cerita Lagi');
					$('#more_kumpulan_cerita').toggle(false);

				}
			}
		});
	}

	$('#more_ceritaku').click(function(e) {
		e.preventDefault();
		load_ceritaku();
	});

	$('#more_kumpulan_cerita').click(function(e) {
		e.preventDefault();
		load_kumpulan_cerita();
	});

	function logout() {
		$.ajax({
			type: "POST",
			url: "logout_proses.php", 
			dataType: "json",
			success: function(response) {
				console.log(response);
				if (response.success) {
					window.location.href = "index.php"; 
				} else {
					alert('Login Gagal, Silahkan coba kembali.');
				}
			},
			error: function() {
				alert('Terjadi Kesalahan Sistem. Silahkan Refresh Kembali Halaman Browser anda.');
			}
		});
	}
</script>
</html>