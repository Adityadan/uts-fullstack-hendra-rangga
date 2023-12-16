<?php
require_once("class/cerita.php");
require_once("class/parent.php");
// require_once("css/custom_css.css");


// echo "tes" . $_SESSION['userid'];
if (!isset($_SESSION['userid'])) {
	header("location: index.php"); //belum login, wajib login dulu
}
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
	<link rel="stylesheet" href="css/custom_css.css">
	<script type="text/javascript" src="js/jquery-3.7.1.js"></script>


	<title>HALAMAN HOME</title>
</head>

<body>
	<div class="container">
		<div class="ceritaku">
		</div>
	</div>
</body>

<script type="text/javascript">
	$(document).ready(function() {
		// Fungsi untuk melakukan Ajax GET dengan $.ajax()
		// $.ajax({
		// 	url: 'server.php', // Ganti dengan URL server Anda
		// 	type: 'GET',
		// 	dataType: 'json',
		// 	success: function(responseData) {
		// 		console.log(responseData);
		// 		// Tampilkan data di dalam div dengan id "ajax-response"
		// 		var html = '';
		// 		responseData.forEach(element => {
		// 			html += '<div class="card"> </div>';
		// 		});
		// 		$('.ceritaku').html(
		// 		);
		// 	},
		// 	error: function(xhr, status, error) {
		// 		console.error('Error:', status, error);
		// 	}
		// });
		$.get('class/cerita.php', { action: 'getcerita' }, function (data) {
            // Handle the response from the server
            console.log(data);
        });
	});
</script>
</html>