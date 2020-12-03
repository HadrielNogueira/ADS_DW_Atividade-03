<?php
	$id = $_POST["id"];
	$nome = $_POST["nome"];
	$dataNascimento = $_POST["dataNascimento"];
	$materia = $_POST["materia"];
	$ano = $_POST["ano"]; 
	
	$conexao = new mysqli("localhost", "root", "vertrigo", "crud");
	
	if ($id == 0){
		$sql = $conexao->prepare("INSERT INTO cadastroaluno (nome, dataNascimento, ano, materiaPreferida) VALUES (?,?,?,?)");
		$sql->bind_param("ssss", $nome, $dataNascimento, $ano, $materia);
	}else{
		$sql = $conexao->prepare("UPDATE cadastroaluno SET nome = ?, dataNascimento = ?, ano = ?, materiaPreferida = ? WHERE id = ?");
		$sql->bind_param("ssssi", $nome, $dataNascimento, $ano, $materia, $id); 
	}
	$sql->execute();
	
	mysqli_close($conexao);
	
	header("location: index.php");
?>