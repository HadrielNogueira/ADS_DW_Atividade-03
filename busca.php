<!DOCTYPE html>
<html>
	<head>
		<title>CRUD</title>
		<link rel="stylesheet" href="css/bootstrap.css" />
	</head>
	<?php
		$conexao = new mysqli("localhost", "root", "vertrigo", "crud");
		
		if(isset($_GET["id"])){
			$id = $_GET["id"];
			
			$dados = $conexao->query("SELECT * FROM cadastroaluno WHERE id = ". $id);
			$linha = $dados->fetch_assoc();
			
			$nome = $linha["nome"];
			$dataNascimento = $linha["dataNascimento"];
			$materia = $linha["materiaPreferida"];
			$ano = $linha["ano"];
		} else{
			$id = 0;
			$nome = "";
			$dataNascimento = "";
			$materia = "";
			$ano = "";
		}
	?>
	<body>
		<div class="container" >
		<form action="processos.php" method="POST" class="row">
			<div class="col-6">
				<label for="nome">Nome:</label>
				<input type="text" id="nome" name="nome" class="form-control" value="<?=$nome;?>"/>
			</div>
			<div class="col-6">
				<label for="dataNascimento">Data de Nascimento:</label>
				<input type="date" id="dataNascimento" name="dataNascimento" class="form-control" value="<?=$dataNascimento;?>"/>
			</div>
			<div class="col-5">
				<label for="ano">Ano que cursa:</label>
				<input type="number" min="1900" max="2021" id="ano" name="ano" class="form-control" value="<?=$ano;?>"/>
			</div>
			<div class="col-5">
				<label for="materia">Matéria Preferida:</label>
				<input type="text" id="materia" name="materia" class="form-control" value="<?=$materia;?>"/>
			</div>
			<div class="col-2">
				<input type="hidden" id="id" name="id" value="<?=$id;?>"/>
				<button type="reset" class="btn btn-secondary" style="margin-top: 30px" >Limpar</button>
				<button type="submit" class="btn btn-success" style="margin-top: 30px" >Salvar</button>
			</div>
		</form>
		<br>
		<table class="table">
			<thead>
				<form action="busca.php" method="GET">
							<label for="busca">Buscar</label>
							<input type="search" id="busca" name="busca">
							<button  type="submit">OK</button>
							<a href="index.php">
								Novo
							</a>
				</form>
				<tr>
					<th>Nome</th>
					<th>Matéria</th>
					<th>Editar</th>
					<th>Excluir</th>
				</tr>
			</thead>
			<tbody>
				<?php
				
					$busca = $_GET["busca"];
					$tabela = $conexao->query("SELECT * FROM cadastroaluno WHERE nome LIKE '%$busca%'");
					
					while($linha = $tabela->fetch_assoc()){
				?>
						<tr>
							<td>
								<?=$linha["nome"];?>
							</td>
							<td>
								<?=$linha["materiaPreferida"];?>
							</td>
							<td>
								<a href="index.php?id=<?=$linha["id"];?>">
									Editar
								</a>
							</td>
							<td>
								<a href="excluir.php?id=<?=$linha["id"];?>" onclick="return confirm('Deseja Excluir?');">
									Excluir
								</a>
							</td>
						</tr>
				<?php
					}
					mysqli_close($conexao);
				?>
			</tbody>
		</table>
		</br>
		
		</div>
	</body>
</html>