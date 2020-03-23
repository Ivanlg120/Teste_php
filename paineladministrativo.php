<?php
require_once 'db_connect.php';
session_start();

if(!isset($_SESSION['logado'])):
	header('Location: listafilmes.php');
endif;

$cont=0;
$dura=0;
$sql = "SELECT * FROM filme";
$result = $connect->query($sql);
if ($result->num_rows > 0) {
	while($row = $result->fetch_assoc()) {
		$cont+=1;
		$dura+=$row['Filme_duracao'];
	}
}
$cont2=0;
$sql = "SELECT * FROM diretor";
$result = $connect->query($sql);
if ($result->num_rows > 0) {
	while($row = $result->fetch_assoc()) {
		$cont2+=1;
	}
}
$connect->close();
$dura=$dura/$cont;
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
			<nav class="col-md-2 d-none d-md-block bg-secondary sidebar">
				<div class="sidebar-sticky">
					<ul class="nav flex-column">
						<li class="nav-item">
							<a class="nav-link active" href="paineladministrativo.php">
								Painel Administrativo <span class="sr-only">(current)</span>
							</a>
						</li>
						<li class="nav-item">
							<a class="nav-link" href="painelfilmes.php">
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
					<h1 class="h2">Painel Administrativo</h1>	
				</div>
				<div class="row" style=" padding-top: 10px;">
					<div class="col-sm-4">
						<div class="card text-center bg-light">
							<div class="card-body">
								<h5 class="card-title"><h2>Filmes</h2></h5>
								<p class="card-text font-weight-bold"><font size="7" color="green"> <?php echo $cont;?></font></p>
							</div>
						</div>
					</div>
					<div class="col-sm-4">
						<div class="card text-center bg-light">
							<div class="card-body">
								<h5 class="card-title"><h2>Diretores</h2></h5>
								<p class="card-text font-weight-bold"><font size="7" color="green"><?php echo $cont2;?></font></p>
							</div>
						</div>
					</div>
					<div class="col-sm-4">
						<div class="card text-center bg-light">
							<div class="card-body">
								<h5 class="card-title"><h2>Duração média</h2></h5>
								<p class="card-text font-weight-bold"><font size="7" color="green"><?php echo $dura." Min";?></font></p>
							</div>
						</div>
					</div>
				</div>

				
			</main>
		</div>
	</div>


</body>
</html>