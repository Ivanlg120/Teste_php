<?php
require_once 'db_connect.php';
session_start();

if(isset($_SESSION['logado'])):
		//echo "teste";
	if ($_GET['tipo']==1) {
		$sql = "DELETE FROM filme WHERE idFilme=".$_GET['id'];
		$connect->query($sql);
		header('Location: painelfilmes.php');
	}
	elseif ($_GET['tipo']==2) {
		$sql = "DELETE FROM diretor WHERE idDiretor=".$_GET['id'];
		$connect->query($sql);
		header('Location: paineldiretores.php');
	}
	else{
	header('Location: teste2.php');
}
else:
	header('Location: listaf.php');
endif;



$connect->close();
?>