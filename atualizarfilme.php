<?php
require_once 'db_connect.php';
session_start();

if(!isset($_SESSION['logado'])):
	header('Location: listaf.php');
endif;

if(isset($_POST['btn_salvar'])){
	if (!filter_var($_POST['dura'], FILTER_VALIDATE_INT)) {
		$erro = "<li> O campo duração deve conter apenas números! </li>";
	}
	elseif (!filter_var($_POST['ano'], FILTER_VALIDATE_INT)) {
		$erro = "<li> O campo ano deve conter apenas números! </li>";
	}

	else{
		$sql = "UPDATE filme SET Filme_Nome='".$_POST['nome']."', Filme_iddiretor='".$_POST['diretor']."', Filme_ano='".$_POST['ano']."', Filme_duracao='".$_POST['dura']."', Filme_desc='".$_POST['desc']."' WHERE idFilme=".$_GET['id'];
		//echo $row['idFilme'];
		mysqli_query($connect, $sql);
		header('Location: painelfilmes.php');
	}
}

$sql = "SELECT * FROM filme, diretor where filme.Filme_iddiretor=diretor.iddiretor and filme.idFilme=".$_GET['id'];
$result = $connect->query($sql);
$row = $result->fetch_assoc();



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
					<h1 class="h2">Atualizar Filme <?php echo $row['Filme_Nome']; ?></h1>
					
				</div>
				<div class="container" style=" padding-bottom: 80px ">
					<?php
					if (isset($erro)) {
						echo "<div class=\"alert alert-danger\" role=\"alert\">
						".$erro."
						</div>	";
					}


					?>
					<form action="<?php echo "Atualizarfilme.php?id=".$row['idFilme'] ?>" method="POST">
						<div class="form-row">
							<div class="form-group col-md-6">
								<label for="nome">Nome</label>
								<?php echo "<input type=\"text\" class=\"form-control\" id=\"nome\" name=\"nome\" value=\"".$row['Filme_Nome']."\" required>";?>
							</div>

							<div class="form-group col-md-6">
								<label for="exampleFormControlSelect1">Diretor</label>
								<select class="form-control" name="diretor">
									<?php
									if ($result->num_rows > 0) {
										while($row2 = $result->fetch_assoc()) {
											if ($row2['Diretor_Nome']==$row['Diretor_Nome']) {
												echo "<option value=".$row2['idDiretor']." selected>".$row2['Diretor_Nome']."</option>";
											}else{
												echo "<option value=".$row2['idDiretor'].">".$row2['Diretor_Nome']."</option>";
											}

										}
									}?>

								</select>
							</div>
						</div>
						<div class="form-row ">
							<div class="form-group col-md-6">
								<label for="ano">Ano</label>
								<?php echo "<input type=\"number\" class=\"form-control\" id=\"ano\" name=\"ano\" value=\"".$row['Filme_ano']."\"required>";?>
							</div>
							<div class="form-group col-md-6">
								<label for="dura">Duração (minutos)</label>
								<?php echo "<input type=\"number\" class=\"form-control\" id=\"dura\" name=\"dura\" value=\"".$row['Filme_duracao']."\"required>";?>
							</div>
						</div>
						<div class="form-group">
							<label for="desc">Descrição</label>

							<?php echo "<textarea class=\"form-control\" id=\"desc\" name=\"desc\" rows=\"6\" required>".$row['Filme_desc']."</textarea>";?>
						</div>
						<button type="submit" class="btn btn-primary" name="btn_salvar">Salvar</button>

					</form>
				</div>
				
			</main>
		</div>
	</div>


</body>
</html>