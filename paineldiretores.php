<?php
require_once 'db_connect.php';
session_start();

if(!isset($_SESSION['logado'])):
	header('Location: listafilmes.php');
endif;

if(isset($_GET['btn_busca']) and $_GET['parametro']!=null){
	
	$sql = "SELECT * FROM diretor where idDiretor=".$_GET['parametro'];
	$result = $connect->query($sql);
	
}else{
	$sql = "SELECT * FROM diretor  ORDER BY diretor.idDiretor";
	$result = $connect->query($sql);
}

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
		<a class="navbar-brand" href="paineladministrativo.php">Filmes</a>
		<a href="logout.php" class="btn btn-primary" role="button">Logout</a>
	</nav>

	<div class="container-fluid">
		<div class="row">
			<nav class="col-md-2  d-none d-md-block bg-secondary sidebar">
				<div class="sidebar-sticky">
					<ul class="nav flex-column">
						<li class="nav-item">
							<a class="nav-link " href="paineladministrativo.php">
								Painel Administrativo 
							</a>
						</li>
						<li class="nav-item">
							<a class="nav-link " href="painelfilmes.php">
								Filmes 
							</a>
						</li>
						<li class="nav-item"> 
							<a class="nav-link active" href="paineldiretores.php">
								Diretores
							</a>
						</li>

					</ul>
				</div>
			</nav>

			<main  class="col-md-9 ml-sm-auto col-lg-10 px-4 " style=" padding-top: 58px;">
				<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2  border-bottom">
					<h1 class="h2">Diretores</h1>	
					<form class="form-inline" action="paineldiretores.php" method="GET">
						<input class="form-control mr-sm-2"  placeholder="ID" name="parametro">
						<button class="btn btn-outline-success my-2 my-sm-0" type="submit" name="btn_busca">Busca</button>
					</form>	
					<a href="novodiretor.php" class="btn btn-primary">Novo Diretor</a>
				</div>
				<div class="table-responsive">
					<table class="table table-striped table-sm">
						<thead>
							<tr>
								<th>ID</th>
								<th>Nome</th>
								<th>Atualizar</th>
								<th>Deletar</th>
							</tr>
						</thead>
						<tbody>
							<?php
							if ($result->num_rows > 0) {
								while($row = $result->fetch_assoc()) {
									$link="Atualizardiretor.php?id=".$row['idDiretor'];
									$link2="deletar.php?tipo=2&id=".$row['idDiretor'];
									echo "<tr>
									<td>".$row['idDiretor']."</td>
									<td><a href=\"filmespordiretor.php?id=".$row['idDiretor']."\">".$row['Diretor_Nome']."</a></td>
									<td><a href=\"$link\" class=\"btn btn-primary\">Atualizar</a></td>
									<td><a href=\"$link2\" class=\"btn btn-danger\">Deletar</a></td>
									</tr>";
								}
							}
							?>

						</tbody>
					</table>
				</div>

				
			</main>
		</div>
	</div>


</body>
</html>