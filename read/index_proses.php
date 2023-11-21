<?php 
    require_once("../class/cerita.php");

    $mysqli = new mysqli("localhost", "root", "", "fullstack_uts");
    $cerita = new Cerita();

    if(isset($_POST["btnsubmit"])) {
        $data = array();
        
        $data['idcerita'] = $_POST['txt'];
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