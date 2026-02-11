<?php 
	session_start();
	/* CHAVES */
	if(isset($_SESSION['acesso'])){
		unset ($_SESSION['acesso']);	
	}
	if(isset($_SESSION['confirmado'])){
		unset ($_SESSION['confirmado']);	
	}
	if(isset($_SESSION['reset_acess'])){
		unset ($_SESSION['reset_acess']);	
	}
	if (isset($_SESSION['update_page'])){
		unset($_SESSION['update_page']);
	}
	
	$_SESSION['mss'] = '
			<div id="mss" class="alert alert-warning" role="alert">
			  <i class="bi bi-exclamation-triangle-fill"></i> Acesso inválido!
			</div>
			';
	header("Refresh:5; url = ./login.php");

?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
	<!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
	
	<title>Bem Vindo!</title>
	
	<!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
	
	<!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</head>

<body>
	<center><img src="imagens/manutencao.png" class="img-fluid"></center>
	
	<center >
		<div class="spinner-border" role="status">
		  <span class="visually-hidden">Carregando...</span>
		</div>
	</center>
	
</body>
</html>