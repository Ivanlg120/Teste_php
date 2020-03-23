<?php
require_once 'db_connect.php';
session_start();




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




</head>
<body>
	<nav class="navbar navbar-light bg-dark fixed-top ">
		<a href="listafilmes.php" class="navbar-brand  text-light">Filmes</a>
		<a href="login.php" class="btn btn-primary" role="button">Painel Administrativo</a>

	</nav>

	<div class="container" style="width: 60%; padding-bottom: 30px; padding-top: 58px;">

		<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2">
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
								<?php echo "<a href=\"filmespdiretor.php?id=".$row['idDiretor']."\">".$row['Diretor_Nome']."</a>";?>
								<br>
								<i class="material-icons">date_range</i>
								<?php echo $row['Filme_ano']?>
								<br>
								<i class="material-icons">timer</i>
								<?php echo $row['Filme_duracao']." min"?>  
							</h6>
							<p class="card-text"><?php echo $row['Filme_desc']?></p>




						</div>
					</div>
					<?php 
				}}else{

					echo "<div style=\"margin-top: 20px;\">Nenhum filme cadastrado!</div>";
				}
				?>
			</div>

			
		</div>


	</body>
	</html>