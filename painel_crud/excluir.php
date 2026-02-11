<?php
session_start();
		if($_SESSION['acesso'] !== true ){
            $_SESSION['mss'] = '
			<div id="mss" class="alert alert-warning" role="alert">
			  <i class="bi bi-exclamation-triangle-fill"></i> Acesso inválido!
			</div>
			';
        header("Location: ./login.php");
    } else {

    require "conexao.php";

    if (isset($_GET['id'])) {
        $id = intval($_GET['id']);

        $delete = "DELETE FROM login WHERE id = '$id'";
        $stmt = mysqli_query($conn, $delete);
        if($stmt){
            $_SESSION['excluido'] = '
    			<div class="alert alert-success" role="alert">
    			  <i class="bi bi-exclamation-triangle-fill"></i> O usuário foi excluído com sucesso!
    			</div>
    		    ';
            header("Location: ./dashboard.php?pagina=listar_usuarios");
        }
    }
}

 // ou o nome do seu arquivo principal
