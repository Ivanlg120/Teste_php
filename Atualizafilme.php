	<?php

	// Conexão
	require_once 'db_connect.php';

	// Sessão
	session_start();

	// Verificação
	if(isset($_SESSION['logado'])):
		header('Location: listaf.php');
	endif;


	$sql = "SELECT * FROM filme, diretor where filme.Filme_iddiretor=diretor.iddiretor and filme.idFilme=".$_GET['id'];
	$result = $connect->query($sql);
	$row = $result->fetch_assoc();
	
	if(isset($_POST['btn_salvar'])):
		$sql = "UPDATE filme SET Filme_Nome='".$_POST['nome']."' WHERE idFilme=".$_GET['id'];
		//echo $row['idFilme'];
		mysqli_query($connect, $sql);
		header('Location: listaf.php');
		

	endif;

	$sql = "SELECT * FROM filme, diretor where filme.Filme_iddiretor=diretor.iddiretor and filme.idFilme=".$_GET['id'];
	$result = $connect->query($sql);
	$row = $result->fetch_assoc();
	$sql2 = "SELECT * FROM diretor";
	$result = $connect->query($sql2);


	?>

	<!DOCTYPE html>
	<html>
	<head>
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
		<!--Import Google Icon Font-->
		<link href="https://fonts.googleapis.com/icon?family=Material+Icons"
		rel="stylesheet" />
		<title><?php echo "Filme ".$row['Filme_Nome']?></title>
	</head>
	<body>
		<header>
			<nav class="navbar navbar-light bg-light">
				<a href="listaf.php" class="navbar-brand mb-0 h1">Filmes</a>
			</nav>
		</header>
		<div class="container" style="width: 60%; padding-bottom: 80px">
			<nav aria-label="breadcrumb">
				<ol class="breadcrumb"
				style="background-color: white; padding-left: 0px;">
				<li class="breadcrumb-item" aria-current="page"><a
					href="listaf.php">Filmes</a></li>
					<li class="breadcrumb-item active" aria-current="page">Atualizar Filme</li>
				</ol>
			</nav>

			<form action="<?php echo "Atualizafilme.php?id=".$row['idFilme'] ?>" method="POST">
				<div class="form-group">
					<label for="exampleFormControlInput1">Nome</label>
					<?php echo "<input type=\"text\" class=\"form-control\" name=\"nome\" value=\"".$row['Filme_Nome']."\">";?>
				</div>
				<div class="form-group">
					<label for="exampleFormControlSelect1">Diretor</label>
					<select class="form-control" name="diretor">
						<?php
						if ($result->num_rows > 0) {
							while($row2 = $result->fetch_assoc()) {
								if ($row2['Diretor_Nome']==$row['Diretor_Nome']) {
									echo "<option selected>".$row2['Diretor_Nome']."</option>";
								}else{
									echo "<option>".$row2['Diretor_Nome']."</option>";
								}
								
							}
						}?>

					</select>
				</div>
				<div class="form-group">
					<label for="exampleFormControlInput1">Ano</label>
					<?php echo "<input type=\"text\" class=\"form-control\" name=\"ano\" value=\"".$row['Filme_ano']."\">";?>
				</div>
				<div class="form-group">
					<label for="exampleFormControlInput1">Duração</label>
					<?php echo "<input type=\"text\" class=\"form-control\" name=\"dura\" value=\"".$row['Filme_duracao']."\">";?>
				</div>
				<div class="form-group">
					<label for="exampleFormControlTextarea1">Descrição</label>
					
					<?php echo "<textarea class=\"form-control\" name=\"desc\" rows=\"6\">".$row['Filme_desc']."</textarea>";?>
				</div>
				<button type="submit" class="btn btn-primary" name="btn_salvar">Salvar</button>

			</form>
		</div>
	</body>
	</html>