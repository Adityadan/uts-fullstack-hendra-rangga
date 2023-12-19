<?php
session_start();
header("Content-type:text/html; charset=UTF-8");
header("Content-type:application/json");

if (!isset($_SESSION['userid'])) {
    header("location: index.php");
}

?>
