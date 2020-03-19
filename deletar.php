<?php
require_once 'db_connect.php';
session_start();

if(!isset($_SESSION['logado'])):
		//echo "teste";
	$sql = "DELETE FROM filme WHERE idFilme=".$_GET['id'];
	$connect->query($sql);
	header('Location: painelfilmes.php');
endif;

$connect->close();
?>