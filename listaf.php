	<?php
	require_once 'db_connect.php';
	session_start();


	$sql = "SELECT * FROM filme, diretor where filme.Filme_iddiretor=diretor.iddiretor";
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
		<title>Filmes</title>
	</head>
	<body>
		<header>
			<nav class="navbar navbar-light bg-light">
				<a href="listaf.php" class="navbar-brand mb-0 h1">Filmes</a>
				<a href="login.php" class="btn btn-primary" role="button">Painel Administrativo</a>

				<a href="login.php" class="btn btn-primary" role="button">Painel Administrativo</a>
				
				<a href="login.php" class="btn btn-primary" role="button">Painel Administrativo</a>

			</nav>
		</header>
		<section>
			<div class="container" style="width: 60%; padding-bottom: 30px;">
				<nav aria-label="breadcrumb">
					<ol class="breadcrumb"
					style="background-color: white; padding-left: 0px;">
					<li class="breadcrumb-item active" aria-current="page">Filmes</li>
				</ol>
			</nav>
			<?php
			if ($result->num_rows > 0) {
	    // output data of each row
				while($row = $result->fetch_assoc()) {
					?><div class="card shadow-sm bg-white rounded" style="margin-top: 20px;" >
						<div class="card-body">
							<h4 class="card-title"><?php echo $row['Filme_Nome']?></h4>
							<h6 class="card-subtitle mb-2 text-muted">
								<i class="material-icons">person_outline</i> 
								<?php echo $row['Diretor_Nome']?>
								<br>
								<i class="material-icons">date_range</i>
								<?php echo $row['Filme_ano']?>
								<br>
								<i class="material-icons">timer</i>
								<?php echo $row['Filme_duracao']." min"?>  
							</h6>
							<p class="card-text"><?php echo $row['Filme_desc']?></p>

							<?php 
							if(!isset($_SESSION['logado'])):
								$link="Atualizafilme.php?id=".$row['idFilme'];
								$link2="deletar.php?id=".$row['idFilme'];

								echo "<a href=\"$link\" class=\"btn btn-primary\">Atualizar</a>";

								echo "<a href=\"$link2\" class=\"btn btn-danger\">Deletar</a>";


							endif;
							?>
						</div>
						</div> <?php
					}
				}
				?>
			</div>
		</section>
	</body>
	</html>