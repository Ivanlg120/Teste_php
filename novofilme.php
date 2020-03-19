<?php
require_once 'db_connect.php';
session_start();

if(isset($_SESSION['logado'])):
	header('Location: listaf.php');
endif;

if(isset($_POST['btn_salvar'])){
	$sql="INSERT INTO filme (Filme_Nome, Filme_iddiretor, Filme_ano, Filme_duracao, Filme_desc) values ('".$_POST['nome']."','".$_POST['diretor']."','".$_POST['ano']."','".$_POST['dura']."','".$_POST['desc']."')";
		//echo $row['idFilme'];
	mysqli_query($connect, $sql);
	header('Location: painelfilmes.php');
}


$sql2 = "SELECT * FROM diretor";
$result = $connect->query($sql2);

$connect->close();
?>

<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
	<!--Import Google Icon Font-->
	<link href="https://fonts.googleapis.com/icon?family=Material+Icons"
	rel="stylesheet" />

	<title>Painel Administrativo</title>

	<style>
		.sidebar {
			position: fixed;
			top: 0;
			bottom: 0;
			left: 0;
			padding: 58px 0 0; /* Height of navbar */
		}

		.card {
			height: 200px;
		}

		.sidebar .nav-link.active {
			color: #337bff;
		}
		.sidebar .nav-link {
			font-weight: 500;
			color: #FFF;
		}
		
	</style>


</head>
<body>
	<nav class="navbar navbar-dark fixed-top bg-dark">
		<a class="navbar-brand" href="teste2.php">Filmes</a>
	</nav>

	<div class="container-fluid">
		<div class="row">
			<nav class="col-md-2  d-none d-md-block bg-secondary sidebar">
				<div class="sidebar-sticky">
					<ul class="nav flex-column">
						<li class="nav-item">
							<a class="nav-link " href="teste2.php">
								Painel Administrativo 
							</a>
						</li>
						<li class="nav-item">
							<a class="nav-link active" href="painelfilmes.php">
								Filmes 
							</a>
						</li>
						<li class="nav-item">
							<a class="nav-link" href="paineldiretores.php">
								Diretores
							</a>
						</li>

					</ul>
				</div>
			</nav>

			<main  class="col-md-9 ml-sm-auto col-lg-10 px-4 " style=" padding-top: 58px;">
				<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2  border-bottom">
					<h1 class="h2">Novo Filme</h1>
					
				</div>
				<div class="container" style=" padding-bottom: 80px ">
					<form action="novofilme.php" method="POST">
						<div class="form-row">
							<div class="form-group col-md-6">
								<label for="exampleFormControlInput1">Nome</label>
								<input type="text" class="form-control" name="nome">
							</div>

							<div class="form-group col-md-6">
								<label for="exampleFormControlSelect1">Diretor</label>
								<select class="form-control" name="diretor">
									<?php
									if ($result->num_rows > 0) {
										while($row2 = $result->fetch_assoc()) {

											echo "<option value=".$row2['idDiretor'].">".$row2['Diretor_Nome']."</option>";


										}
									}?>

								</select>
							</div>
						</div>
						<div class="form-row ">
							<div class="form-group col-md-6">
								<label for="exampleFormControlInput1">Ano</label>
								<input type="text" class="form-control" name="ano">
							</div>
							<div class="form-group col-md-6">
								<label for="exampleFormControlInput1">Duração</label>
								<input type="text" class="form-control" name="dura" >
							</div>
						</div>
						<div class="form-group">
							<label for="exampleFormControlTextarea1">Descrição</label>

							<textarea class="form-control" name="desc" rows="6"></textarea>
						</div>
						<button type="submit" class="btn btn-primary" name="btn_salvar">Salvar</button>

					</form>
				</div>
				
			</main>
		</div>
	</div>


</body>
</html>