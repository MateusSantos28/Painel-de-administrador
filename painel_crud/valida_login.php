<?php
session_start();
	
	$usuario = $_POST['usuario'];
	$senha = $_POST['senha'];

include "conexao.php";

require_once 'php_mailer/Exception.php';
require_once 'php_mailer/PHPMailer.php';
require_once 'php_mailer/SMTP.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

	$select_usuarios = mysqli_query($conn, "SELECT * FROM login WHERE users = '$usuario'");
	$check_select = mysqli_num_rows($select_usuarios);	

    if ($check_select < 1){

        $_SESSION['mss'] = '
		<div id="mss" class="alert alert-danger" role="alert">
		    Usuário ou senha inválido!
		</div>
		';
        
        header("Location: login.php");
        exit;
    } else {
        
	    $result_usuarios = mysqli_fetch_assoc($select_usuarios);
        
	    $usuario_bd = $result_usuarios['users'];
	    $hash_password = $result_usuarios['password'];
        $tempo_usuario = $result_usuarios['bloqueado_until'];
        $tentativas = $result_usuarios['tentativas'];
        $timestamp_bloqueio = strtotime($tempo_usuario);

        if ($timestamp_bloqueio > time() || $tentativas >= 3) {

            mysqli_query($conn, "UPDATE login SET tentativas = 0 WHERE users = '$usuario'");

            $_SESSION['mss'] = '
            <div id="mss" class="alert alert-danger" role="alert">
                Usuário bloqueado até: '.$tempo_usuario.'
            </div>
            ';

            header("Location: login.php");
            exit;
        }

        if($usuario == $usuario_bd && (password_verify($senha, $hash_password))){

            mysqli_query($conn, "UPDATE login SET tentativas = 0 WHERE users = '$usuario'");

            $db_email = $result_usuarios['email'];

            $cod = rand(1000,9999);

            $update = mysqli_query($conn, "UPDATE login SET cod = '$cod' WHERE users = '$usuario'");

                if(!$update) {
                    die("Erro no UPDATE do código");

                } 
            
            //Check code

            $select_usuarios = mysqli_query($conn, "SELECT * FROM login WHERE users = '$usuario'");
            $result_usuarios = mysqli_fetch_assoc($select_usuarios);

            $mail = new PHPMailer(true);

try {

    $mail->isSMTP();
    $mail->CharSet = 'UTF-8';
    $mail->Host = 'mail.dreamsistemas.com.br';
    $mail->SMTPAuth = true;
    $mail->Username = 'sistema_atrasos@dreamsistemas.com.br';
    $mail->Password = 'xryojo^mNiQ3';
    $mail->Port = 587;
    $mail->SMTPSecure = "tls";
    $mail->SMTPDebug = 2;

    $mail->setFrom('sistema_atrasos@dreamsistemas.com.br', 'Sistema atrasos');
    $mail->addAddress($db_email);   

    $mail->isHTML(true);
    $mail->Subject = 'Email de verificação de código de entrada';
    $mail->Body = "O seu código de entrada é <b>$cod</b>"; 

    if ($mail->send()) {
        $_SESSION['ultimo_acesso'] = time();
        
        $_SESSION["acesso"] = true;
        $_SESSION['email'] = $db_email;
        $_SESSION['usuario'] = $usuario_bd;
        $_SESSION['code'] = $result_usuarios['cod'];
        
        header('Location: dashboard.php');
        exit;

    } else {

        echo 'Erro ao enviar o e-mail: ' . $mail->ErrorInfo;
        
        }
    } catch (Exception $e) {

        $_SESSION['mss'] = '
		<div id="mss" class="alert alert-danger" role="alert">
		  Erro no envio do email!
		</div>
		';

		header('Location: login.php');
        exit;
    
    }

	} else {
    $select_usuarios = mysqli_query($conn, "SELECT * FROM login WHERE users = '$usuario'");
    $check_select = mysqli_num_rows($select_usuarios);	
        
if ($check_select == 1){

    $result_usuarios = mysqli_fetch_assoc($select_usuarios);

    $tentativas = (int) $result_usuarios['tentativas'] + 1;

    mysqli_query($conn, "UPDATE login SET tentativas = $tentativas WHERE users = '$usuario'");


    $_SESSION['tentativas'] = $tentativas;

    if ($tentativas == 3) {
        $bloqueio = date("Y-m-d H:i:s", time() + 30);

        mysqli_query($conn, "UPDATE login SET bloqueado_until = '$bloqueio' WHERE users = '$usuario'");

        $_SESSION['mss'] = '
	    	<div id="mss" class="alert alert-danger" role="alert">
	    	  Usuário bloqueado! <br>
              Até: '. $bloqueio.'
	    	</div>
	    	';

	    	header('Location: login.php');
            exit;

    }


    }
		$_SESSION['mss'] = '
		<div id="mss" class="alert alert-danger" role="alert">
		  Usuário ou senha inválido! <br>
          Tentativas: '. $_SESSION['tentativas'].'
		</div>
		';

		header('Location: login.php');
        exit;
	}
	

}

