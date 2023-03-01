<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Controle de Atendimentos</title>
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
</head>
<body>
	<h1 class="titulo-controle">Controle de Atendimentos</h1>
	
	<!-- Formulário para inserir dados de atendimento -->
	<form action="index.php" method="POST">
		<label for="numero">Número de Atendimento:</label>
		<input type="text" name="numero"><br><br>
		
		<label for="titulo">Título:</label>
		<input type="text" name="titulo"><br><br>
		
		<label for="cliente">Cliente:</label>
		<input type="text" name="cliente"><br><br>
		
		<label for="status">Status:</label>
		<select name="status">
			<option value="Aberto">Aberto</option>
			<option value="Em andamento">Em andamento</option>
			<option value="Concluído">Concluído</option>
		</select><br><br>
		
		<input class="btn btn-info" type="submit" name="submit" value="Adicionar">
	</form>
	
	<hr>
	
<script src="assets/js/bootstrap.min.js"></script>
<script src="assets/js/jquery-3.6.3.min.js"></script>
<script src="assets/js/popper.min.js"></script>


	<!-- Tabela com os dados de atendimento -->
	<table>
		<tr>
			<th>Número</th>
			<th>Título</th>
			<th>Cliente</th>
			<th>Status</th>
			<th>Editar</th>
			<th>Excluir</th>
		</tr>
		<?php
			// Conexão com o banco de dados
			$conn = mysqli_connect("localhost", "usuario", "senha", "banco_de_dados");
			
			// Verifica se o formulário foi enviado
			if(isset($_POST['submit'])){
				// Coleta as informações do formulário
				$numero = $_POST['numero'];
				$titulo = $_POST['titulo'];
				$cliente = $_POST['cliente'];
				$status = $_POST['status'];
				
				// Insere os dados no banco de dados
				$sql = "INSERT INTO atendimentos (numero, titulo, cliente, status) VALUES ('$numero', '$titulo', '$cliente', '$status')";
				mysqli_query($conn, $sql);
			}
			
			// Seleciona os dados de atendimento do banco de dados
			$sql = "SELECT * FROM atendimentos";
			$result = mysqli_query($conn, $sql);
			
			// Exibe os dados em uma tabela
			if(mysqli_num_rows($result) > 0){
				while($row = mysqli_fetch_assoc($result)){
					echo "<tr>";
					echo "<td>".$row['numero']."</td>";
					echo "<td>".$row['titulo']."</td>";
					echo "<td>".$row['cliente']."</td>";
					echo "<td>".$row['status']."</td>";
					echo "<td><a href='editar.php?id=".$row['id']."'>Editar</a></td>";
					echo "<td><a href='excluir.php?id=".$row['id']."'>Excluir</a></td>";
					echo "</tr>";
				}
			}
			mysqli_close($conn);
		
