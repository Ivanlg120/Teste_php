<?php
require_once 'db_connect.php';
session_start();

if(!isset($_SESSION['logado'])):
	header('Location: listafilmes.php');
endif;

if(isset($_POST['btn_salvar'])){
	$sql = "UPDATE diretor SET Diretor_Nome='".$_POST['nome']."' WHERE idDiretor=".$_GET['id'];
	mysqli_query($connect, $sql);
	header('Location: paineldiretores.php');
}

$sql = "SELECT * FROM diretor where diretor.idDiretor=".$_GET['id'];
$result = $connect->query($sql);
$row = $result->fetch_assoc();

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
					<h1 class="h2">Atualizar Diretor <?php echo $row['Diretor_Nome']; ?></h1>
					
				</div>
				<div class="container" style=" padding-bottom: 80px ">
					<form action="<?php echo "Atualizardiretor.php?id=".$row['idDiretor'] ?>" method="POST">

						<div class="form-group">
							<label for="nome">Nome</label>
							<?php echo "<input type=\"text\" class=\"form-control\" id=\"nome\" name=\"nome\" value=\"".$row['Diretor_Nome']."\" required>";?>
						</div>


						<button type="submit" class="btn btn-primary" name="btn_salvar">Salvar</button>

					</form>
				</div>
				
			</main>
		</div>
	</div>


</body>
</html>