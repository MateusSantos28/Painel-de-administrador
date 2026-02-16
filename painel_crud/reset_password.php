<?php 
session_start();
	$_SESSION['reset_acess'] = true;

?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
     <meta charset="UTF-8">
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <title>Recuperar senha</title>
     <link href="css/signin.css" rel="stylesheet">

     <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
	<!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
	
	<!-- Icons Bootstrap -->
	<!--link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css"-->
</head>
<body class="text-center">
	
	<main class="form-signin">
		<form action="verify_user.php" method="post">
			<img class="mb" src="imagens/logo.png" alt="" width="250" >
			<h1 class="h3 mb-3 fw-normal">Redefinição de senha</h1>
			
			<div class="form-floating">
			  <input type="text" class="form-control mb-2" id="floatingInput" maxlength="320" name="verify" placeholder="*" required autocomplete="0">
			  <label class="fst-italic" for="floatingInput">"mateus" ou "emailsmtp@gmail.com"</label>
			</div>

			<button class="w-100 btn btn-lg " style="background-color: cadetblue" type="submit"><i class="bi bi-person-lock"></i>Entrar</button>

	 		<div id="mss" class="w-100" style="padding-top: 8px ;">
			<?php
				if (isset($_SESSION['mss'])) {
					echo $_SESSION['mss'];
					unset ($_SESSION['mss']);
				}
			?>
			</div>
			<p class="mt-5 mb-3 text-muted">&copy; Desenvolvido por: Mateus Batista Bento dos Santos DS. <?= date("Y");?></p>
		</form>
	</main>
	<?php ?>
	<script>

	window.onload = function () {
	const aviso = document.getElementById('mss');
	var contador = 3;
	if (aviso) {
	    let intervalo = setInterval( () => {
	        contador--;
	        if (contador == 0) {
	            aviso.innerHTML = '';
	            clearInterval(intervalo); 
	        		}
	    		}, 1000);
		}
	}

	</script>
</body>
</html>