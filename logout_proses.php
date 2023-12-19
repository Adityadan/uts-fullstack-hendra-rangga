<?php
// Start the session
header("Content-type: application/json; charset=UTF-8");
session_start();

// Unset all of the session variables
$_SESSION = array();

// Hancurkan sesi
if (session_destroy()) {
    // Mengembalikan respons JSON untuk memberi tahu klien bahwa logout berhasil
    $response = ['success' => true];
    echo json_encode($response);
} else {
    // Jika sesi tidak dapat dihancurkan
    $response = ['success' => false, 'error' => 'Failed to destroy the session.'];
    echo json_encode($response);
}
?>
