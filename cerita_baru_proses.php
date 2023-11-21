<?php 
    require_once("class/cerita.php");

    $mysqli = new mysqli("localhost", "root", "", "fullstack_uts");
    $cerita = new Cerita();

    if(isset($_POST["btnsubmit"])) {
        $data = array();
        
        $data['judul'] = $_POST['txtjudul'];
        $data['paragraf'] =$_POST['txtparf'];
        
        $idcerita = $cerita->inserCerita($data); 

        
      
    }
    header("location: home.php");
    $mysqli->close();

?>