<?php
	session_start();
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
	if (isset($_SESSION['tempoAgora'])){
		unset($_SESSION['tempoAgora']);
	}
	if (isset($_SESSION['tempo_login'])){
		unset($_SESSION['tempo_login']);
	}
	if (isset($_SESSION['cod'])){
		unset($_SESSION['cod']);
	}
		
	if(isset($_SESSION['cadastro'])){
		unset ($_SESSION['cadastro']);	
	}
	$mobile = false;
	$user_agents = array("iPhone","iPad","Android","webOS","BlackBerry","iPod","Symbian","IsGeneric");

	foreach($user_agents as $user_agent) {
		if(strpos($_SERVER['HTTP_USER_AGENT'], $user_agent) !== false){
			$mobile = true;
			$modelo = $user_agent;
			break;
		}
	}

	if(!$mobile) {
		echo "";
	} else {
		echo "Acesso feito via: ".strtolower($modelo);
	}
	?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
	<!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
	
	<title>Acesso ao Sistema</title>
	
	<!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
	
    <link href="https://github.com/hackzilla/password-generator.git">
	<!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">
	
	
	<!-- Redirecionamento -->
	<script type="text/javascript">
		//window.location = "manutencao.php"
	</script>
	
	<!-- Tema Sign-in-->
	<style>
      .bd-placeholder-img {
        font-size: 1.125rem;
        text-anchor: middle;
        -webkit-user-select: none;
        -moz-user-select: none;
        user-select: none;
      }

      @media (min-width: 768px) {
        .bd-placeholder-img-lg {
          font-size: 3.5rem;
        }
      }
	 #forgot-password {
		text-align: right;
		padding-top: 8px;
		padding-bottom: 16px;
		color: black;
	 }
    </style>
	
	<!-- Custom styles for this template -->
    <link href="css/signin.css" rel="stylesheet">
	
	<!-- Icons Bootstrap -->
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">	
</head>
	
<body class="text-center">
	
	<main class="form-signin">
		<form method = "POST" action = "valida_login.php">
			<img class="mb" src="imagens/logo.png" alt="" width="250" >
			<h1 class="h3 mb-3 fw-normal">Acesso</h1>
			
			<div class="form-floating">
			  <input type="text" class="form-control" id="floatingInput" maxlength="100" name="usuario" placeholder="Usuário" required autocomplete="0">
			  <label for="floatingInput">Usuário</label>
			</div>
			<div class="form-floating">
			  <input type="password" class="form-control" id="floatingPassword" name="senha" placeholder="Senha" required>
			  <label class="font-italic" for="floatingPassword">Senha</label>
			  <i
					class="bi bi-eye-slash mb-0" 
				    	id="togglePassword"
				    	style="position: absolute; top: 50%; right: 15px; transform: translateY(-50%); cursor: pointer; color: #6c757d; font-size: 1.2rem;"
				  ></i>
			</div>

			<div id="forgot-password">
				<a href="reset_password.php">Esqueci minha senha</a>
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

	<script>
	window.onload = function () {
	const aviso = document.getElementById('mss');
	var cc = 3;
	if (aviso) {
	    let intervalo = setInterval( () => {
	        cc--;
	        if (cc == 0) {
	            aviso.innerHTML = '';
	            clearInterval(intervalo); 
	        }
	    }, 1000);
	}
}
  	const input = document.getElementById('floatingPassword');
  	const toggle = document.getElementById('togglePassword');

	toggle.addEventListener('click', () => {
    		const isPassword = input.type === 'password';
    		input.type = isPassword ? 'text' : 'password';

    		toggle.classList.toggle('bi-eye');
    		toggle.classList.toggle('bi-eye-slash');
  }
);
	</script>
</body>
</html>

