<?php
require_once 'db_connect.php';
session_start();

if(!isset($_SESSION['logado'])):
	header('Location: listaf.php');
endif;


$sql = "SELECT * FROM diretor where diretor.idDiretor=".$_GET['id'];
$result = $connect->query($sql);
$row2= $result->fetch_assoc();

$sql = "SELECT * FROM filme, diretor where filme.Filme_iddiretor=diretor.iddiretor and diretor.idDiretor=".$_GET['id'];
$result = $connect->query($sql);

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
		<a href="logout.php" class="btn btn-primary" role="button">Logout</a>
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
					<h1 class="h2">Filmes do Diretor  <?php echo $row2['Diretor_Nome']; ?></h1>
					
				</div>
				<div class="container" style=" padding-bottom: 80px ">
					<?php
					if ($result->num_rows > 0) {
	    // output data of each row
						while($row = $result->fetch_assoc()) {?>
							<div class="card shadow-sm bg-white rounded" style="margin-top: 20px;" >
								<div class="card-body">
									<h4 class="card-title"><?php echo $row['Filme_Nome']?></h4>
									<h6 class="card-subtitle mb-2 text-muted">
										<i class="material-icons">person_outline</i> 
										<?php echo "<a href=\"filmespordiretor.php?id=".$row['idDiretor']."\">".$row['Diretor_Nome']."</a>";?>
										<br>
										<i class="material-icons">date_range</i>
										<?php echo $row['Filme_ano']?>
										<br>
										<i class="material-icons">timer</i>
										<?php echo $row['Filme_duracao']." min"?>  
									</h6>
									<p class="card-text"><?php echo $row['Filme_desc']?></p>
									<?php
									$link="Atualizarfilme.php?id=".$row['idFilme'];
									$link2="deletar.php?tipo=1&id=".$row['idFilme'];
									echo "<a href=\"$link\" class=\"btn btn-primary\">Atualizar</a>
									<a href=\"$link2\" class=\"btn btn-danger\">Deletar</a>";
									?>



								</div>
							</div>
							<?php 
						}}else{

							echo "<div style=\"margin-top: 20px;\">Nenhum filme cadastrado!</div>";
						}
						?>
					</div>

				</main>
			</div>
		</div>


	</body>
	</html>