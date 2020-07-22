<?php
// print_r($_POST);
include_once 'Cell.php';
session_start();
$_SESSION["field"][(int)$_POST["Selector"][0]][(int)$_POST["Selector"][2]]->set_figure();
header("Location:../index.php");
?>
