<?php 
session_start();
     if(!isset($_SESSION['update_page']) || $_SESSION['update_page'] != true){
          $_SESSION['mss'] = '
			<div id="mss" class="alert alert-warning" role="alert">
			     Acesso inválido!
			</div>
			';
	     header("Location:./login.php");
          exit;
     }
if(isset($_POST['code'])){
	if ($_POST['code'] != $_SESSION['code']){
			$_SESSION['mss'] = '
		     <div id="mss" class="alert alert-danger" role="alert">
		          Código de acesso errado!
		     </div>
		     ';
               
               header("Location: reset_password.php");
               exit;
	} else {
			$_SESSION['confirmado'] = true;
	}
}

?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
     <meta charset="UTF-8">
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <title>Redefinir senha</title>
     <link href="css/signin.css" rel="stylesheet">

     <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
	<!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">
	
	<!-- Icons Bootstrap -->
	<!--link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css"-->
	<style>
		.point{
			color: red;
		}
	</style>
</head>
<body class="text-center">
	<main class="form-signin">
		<form action="update_password.php" method="post">
			<img class="mb" src="imagens/logo.png" alt="" width="250" >
			<h1 class="h3 mb-3 fw-normal">Redefinição de senha</h1>
			
			<div class="form-floating">
			  <input type="password" class="form-control mb-2" id="floatingInput" maxlength="100" name="password1" placeholder="*" required autocomplete="0">
			  <label for="floatingInput">Digite sua nova senha <span class="point">*</span></label>
			</div>

			<div class="form-floating">
			  <input type="password" class="form-control" id="floatingPassword" name="password2" placeholder="Senha" required>
			  <label for="floatingPassword">Senha</label>
			  <i
					class="bi bi-eye-slash mb-0" 
				    	id="togglePassword"
				    	style="position: absolute; top: 50%; right: 15px; transform: translateY(-50%); cursor: pointer; color: #6c757d; font-size: 1.2rem;"
				  ></i>
			</div>
			

			<button class="w-100 btn btn-lg " style="background-color: cadetblue" type="submit"><i class="bi bi-person-lock"></i>Entrar</button>

	 		<div id="msg" class="w-100" style="padding-top: 8px ;">
			<?php
				if (isset($_SESSION['mss'])) {
					echo $_SESSION['mss'];
					unset ($_SESSION['mss']);
				}
			?>
			</div>
			<p class="mt-5 mb-3 text-muted">&copy; Desenvolvido por: Mateus Batista Bento dos Santos Ds2. <?= date("Y");?></p>
		</form>
	</main>
	<?php ?>
	<script>
	window.onload = function () {
	const aviso = document.getElementById('msg');
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


	<div class="modal fade" id="meuModal" tabindex="-1" aria-labelledby="modalUsuarioLabel" data-bs-backdrop="static" role="dialog" aria-labelledby="exampleModalLabel" data-bs-keyboard="false" aria-hidden="true">
	  <div class="modal-dialog" role="document">
	    <div class="modal-content">
	      <div class="modal-header">
	        <h5 class="modal-title" id="exampleModalLabel">Confirmação de redefinição de senha</h5>
	      </div>
	      <div class="modal-body">
	      <p class="text-muted mb-3">
	        	Confirme o código recebido no e-mail
		   	<b><?=$_SESSION['reset_email']?></b>
 			para a redifinição de senha
	      </p>
	      <form action="<?=$_SERVER['PHP_SELF']?>" method="post">
	        <input type="text" class="form-control text-center fs-4 fw-bold" 
	                   name="code" maxlength="4" minlength="4" 
	                   placeholder="----" required>
	      </div>
	      <div class="modal-footer">
	        <button type="submit" class="btn btn-primary">Confirmar</button>
	      </form>
	      </div>
	    </div>
	  </div>
	</div>

	<?php if (!isset($_SESSION['confirmado'])): ?>
        <script>
          document.addEventListener("DOMContentLoaded", function() {
            var meuModal = new bootstrap.Modal(document.getElementById('meuModal'));
            meuModal.show();
          });
        </script>
      <?php endif; ?>
</body>
</html>