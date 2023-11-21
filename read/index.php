<?php 
	require_once("../class/cerita.php");
	require_once("../class/parent.php");

	$mysqli = new mysqli("localhost", "root", "", "fullstack_uts");
	
	$cerita = new Cerita();
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Read</title>
</head>
<body>
<h1>Judul</h1>
<?php  


$url = $_SERVER['REQUEST_URI'];
$parts = explode('/', $url);
$arr_exploded = end($parts);

echo $arr_exploded;


$res = $cerita->detailcerita($arr_exploded);
$result = $cerita;


// foreach($res as $cerita){
// 	//echo "<p>"."</p>";
// 	//echo end($res);	
// }

// select * from movie where url = ......
?>
<form method="post" >
	<label>Tambah Paragraf	:</label>
	<textarea id="txtparf" name="txtparf" rows="4" cols="50">
	</textarea>
	<input type="submit" name="btnsubmit">
	</form>	

	</form>
	<a href="home.php"> kembali ke halaman awal </a>
</body>
</html>
<?php 
    
    if(isset($_POST["btnsubmit"])) {
        $data = array();
        
        $data['idcerita'] = $arr_exploded;
        $data['paragraf'] =$_POST['txtparf'];
        
        $hasil = $cerita->updateIsiParagraf($data); 

        if($hasil="berhasil tambah paragraf"){
            echo "berhasil tambah";
           // header("location: ../home.php");
        }else{
            echo "eror";
        }
      
    }
    
    $mysqli->close();

?>