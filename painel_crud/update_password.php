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

     $up_pass = $_POST['password1'];
     $up_pass_2 = $_POST['password2'];

     $usuario = $_SESSION['db_usuario'];

     if($up_pass != $up_pass_2){
          $_SESSION['mss'] = '
			<div id="mss" class="alert alert-warning" role="alert">
			     Senhas não congruentes!
			</div>
			';
	     header("Location:./redeem_code.php");
          exit;

     } else {
          include "conexao.php";
          $_SESSION['update_senha'] = $up_pass;
          $hash_update = password_hash($up_pass,PASSWORD_DEFAULT);

          $update = mysqli_query($conn, "UPDATE login SET password = '$hash_update' WHERE users = '$usuario'");

          if(!$update){
               die("erro");
          } else {
               $_SESSION['mss'] = '
		     <div id="mss" class="alert alert-success" role="alert">
		          Sua senha foi trocada com sucesso!
		     </div>
		     ';
	          header("Location:./login.php");
          }
     }

