<?php
require_once 'db_connect.php';
session_start();

if(isset($_POST['btn_logar'])){
	
	if(empty($_POST['usuario']) or empty($_POST['senha'])){
		$erro = "<li> O campo login/senha precisa ser preenchido </li>";
	}else{
		$senha = md5($_POST['senha']);       
		$sql = "SELECT * FROM usuarios WHERE login = '".$_POST['usuario']."' AND senha = '".$senha."'";
		$result = $connect->query($sql);
		if($result->num_rows == 1){
			$dados = $result->fetch_assoc();
			$_SESSION['logado'] = true;
			$_SESSION['id_usuario'] = $dados['id'];
			header('Location: teste2.php');
		}else{
			$erro = "<li> Usuario e/ou senha incorretos! </li>";
		}
	}
}

$connect->close();
?>

<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
	<title>Login</title>
</head>
<body>
	<nav class="navbar navbar-dark fixed-top bg-dark">
		<a class="navbar-brand" href="teste2.php">Filmes</a>
	</nav> 
	<div class="container" style="width: 50%; padding-bottom: 30px;padding-top: 68px;">
		<?php
		if (isset($erro)) {
			echo "<div class=\"alert alert-danger\" role=\"alert\">
			".$erro."
			</div>	";
		}


		?>
		<form action="login.php" method="POST">
			<div class="form-group">
				<label for="usuario">Usuario</label>
				<input type="text" class="form-control" id="usuario" name="usuario" required>
			</div>
			<div class="form-group">
				<label for="senha">Senha</label>
				<input type="password" class="form-control" id="senha", name="senha" required>
			</div>
			<button type="submit" class="btn btn-primary" name="btn_logar">Submit</button>
		</form>
	</div>
</body>
</html>