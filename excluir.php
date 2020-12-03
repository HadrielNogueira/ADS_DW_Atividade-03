<?php
	$id = $_GET["id"];
	
	$conexao = new mysqli("localhost", "root", "vertrigo", "crud");
	$sql = $conexao->prepare("DELETE FROM cadastroaluno WHERE id = ?");
	$sql->bind_param("i", $id);
	$sql->execute();
	
	mysqli_close($conexao);
	
	header("location: index.php");
?>