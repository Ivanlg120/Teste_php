	<?php
	require_once 'db_connect.php';
	session_start();

	if(isset($_GET['btn_busca']) and $_GET['parametro']!=null){

		$sql = "SELECT * FROM filme, diretor where filme.Filme_iddiretor=diretor.iddiretor and (filme.Filme_Nome like '%".$_GET['parametro']."%' OR Diretor_Nome like '%".$_GET['parametro']."%')";
		$result = $connect->query($sql);

	}else{
		$sql = "SELECT * FROM filme, diretor where filme.Filme_iddiretor=diretor.iddiretor";
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
		<title>Filmes</title>
	</head>
	<body>
		<header>
			<nav class="navbar navbar-light bg-dark fixed-top ">
				<a href="listaf.php" class="navbar-brand  text-light">Filmes</a>
				<a href="login.php" class="btn btn-primary" role="button">Painel Administrativo</a>

			</nav>
		</header>
		<section>

			<div class="container" style="width: 60%; padding-bottom: 30px; padding-top: 58px;">
				<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2">
					<h1 class="h2">Filmes</h1>
					<form class="form-inline" action="listaf.php" method="GET">
						<input class="form-control mr-sm-3"  placeholder="Nome do filme ou diretor" name="parametro" style="width: 300px;">
						<button class="btn btn-outline-success my-2 my-sm-0" type="submit" name="btn_busca">Busca</button>
					</form>					</div>

					<?php
					if ($result->num_rows > 0) {
	    // output data of each row
						while($row = $result->fetch_assoc()) {
							?><div class="card shadow-sm bg-white rounded" style="margin-top: 20px;" >
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
								</div> <?php
							}
						}
						?>
					</div>
				</section>
			</body>
			</html>