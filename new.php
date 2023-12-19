<?php
	session_start();
	
	$mysqli = new mysqli("localhost","root","", "fullstack_uts"); 
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<style>
	input[type=text], textarea {
  		width: 90%;
 		padding: 10px 50px;
  		margin: 7px;
}
	</style>
	<title>BUAT CERITA BARU</title>
	<script type="text/javascript" src="js/jquery-3.7.1.js"></script>
</head>
<body >
	<form method="post" action="cerita_baru_proses.php">
		<label>Judul :</label><input type='text' name='txtjudul' id='txtjudul'><br>
		<label>Paragraf	1:</label>
		<textarea name="txtparf" name='txtparf' id='txtparf' cols="60" rows="10"></textarea><br>
	 	<input type="submit" name="btnsubmit" id="btnsubmit" value="Simpan">
	 </form>
	 <script type="text/javascript">
		$('body').on('click','#cerita-baru',function(){
			var judul = $("#txtjudul").val();
			var paragraf = $("#txtparf").val();
			//console.log(judul,paragraf);
		});

	 </script>
</body>
</html>
<?php $mysqli->close(); ?>