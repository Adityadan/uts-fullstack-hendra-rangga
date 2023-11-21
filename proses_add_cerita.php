<?php
require_once('class/cerita.php');
// proses_add_cerita.php
$cerita = new Cerita;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Check if the form is submitted using POST method
    // Check if the 'tambah' field is set in the POST data
    if (isset($_POST['tambah']) && isset($_POST['idcerita'])) {
        // Retrieve the value of 'tambah' field
        $paragraf = $_POST['tambah'];
        $idcerita = $_POST['idcerita'];
        $judul = $_POST['judul'];
        $proses_tambah = $cerita->insertparagraf($judul, $paragraf, $idcerita);
        var_dump($proses_tambah);
        if ($proses_tambah == "Sukses") {
            header("location:lihat_cerita.php?id=" . $idcerita . "");
        } else {
            echo 'gagal tambah paragraf';
        }
    } else {
        echo "The 'tambah' field is not set in the form data.";
    }
} else {
    echo "Invalid request method. Please submit the form.";
}
