<?php 
session_start();
     if(!isset($_POST['verify'])){
          $_SESSION['mss'] = '
			<div id="mss" class="alert alert-warning" role="alert">
			     Acesso inválido!
			</div>
			';
	     header("Location:./login.php");
          exit;
          }
     require_once 'php_mailer/Exception.php';
     require_once 'php_mailer/PHPMailer.php';
     require_once 'php_mailer/SMTP.php';
     
     use PHPMailer\PHPMailer\PHPMailer;
     use PHPMailer\PHPMailer\Exception;

if(isset($_SESSION['reset_acess']) && $_SESSION['reset_acess'] == true) {
     include "conexao.php";
     
     $verify = $_POST['verify'];

     //Verificação se é email
     if(filter_var($verify, FILTER_VALIDATE_EMAIL)){

          $verify = filter_var($verify,FILTER_SANITIZE_EMAIL);
          //Verificação se email consta no banco
          $select_usuarios = mysqli_query($conn, "SELECT * FROM login WHERE email = '$verify'");

	     $check_select = mysqli_num_rows($select_usuarios);

          if($check_select < 1){
               //Não existe email
               $_SESSION['mss'] = '
		     <div id="mss" class="alert alert-danger" role="alert">
		          Digite um email válido!
		     </div>
		     ';
               
               header("Location: reset_password.php");
               exit;
          } else {
               //Email válido
               $result_usuarios = mysqli_fetch_assoc($select_usuarios);
               $reset_email = $result_usuarios['email'];

               //Update código
               $reset_cod = rand(1000,9999);
               $update = mysqli_query($conn, "UPDATE login SET cod = '$reset_cod' WHERE email = '$reset_email'");  

               //Query novo código
               $select_usuarios = mysqli_query($conn, "SELECT * FROM login WHERE email = '$reset_email'");
               $result_usuarios = mysqli_fetch_assoc($select_usuarios);

               //Object
               $mail = new PHPMailer(true);
               try {

                    $mail->isSMTP();
                    $mail->CharSet = 'UTF-8';
                    $mail->Host = 'mail.dreamsistemas.com.br';
                    $mail->SMTPAuth = true;
                    $mail->Username = 'sistema_atrasos@dreamsistemas.com.br';
                    $mail->Password = 'xryojo^mNiQ3';
                    $mail->Port = 587;


                    $mail->setFrom('sistema_atrasos@dreamsistemas.com.br', 'Sistema atrasos');
                    $mail->addAddress($reset_email);   

                    $mail->isHTML(true);
                    $mail->Subject = 'Código de redefinição de senha';
                    $mail->Body = "
                         <h1>Email de redefinição de senha</h1>
                         <br>
                         O seu código é <b>$reset_cod</b>
                    "; 
                    
                    if ($mail->send()) {   
                         $_SESSION["update_page"] = true;
                         $_SESSION['reset_email'] = $reset_email;
                         $_SESSION['code'] = $reset_cod;  
                         $_SESSION['db_usuario'] = $result_usuarios['users'];  

                         header('Location: redeem_code.php');
                         exit;
                    
                    } else {
                    
                        echo 'Erro ao enviar o e-mail: ' . $mail->ErrorInfo;
                    
                        }
                    } catch (Exception $e) {
                    
                        echo "Erro no envio: {$mail->ErrorInfo}";
                    
                         }
          }

     
     } else {
          $select_usuarios = mysqli_query($conn, "SELECT * FROM login WHERE users = '$verify'");

	     $check_select = mysqli_num_rows($select_usuarios);

          if($check_select < 1){
               //Não existe usuario
               $_SESSION['mss'] = '
		     <div id="mss" class="alert alert-danger" role="alert">
		          Não há usuario cadastrado com esse nome!
		     </div>
		     ';
               
               header("Location: reset_password.php");
               exit;
          } else {
               //Email válido
               $result_usuarios = mysqli_fetch_assoc($select_usuarios);
               $reset_email = $result_usuarios['email'];

               //Update código
               $reset_cod = rand(1000,9999);
               $update = mysqli_query($conn, "UPDATE login SET cod = '$reset_cod' WHERE email = '$reset_email'");  

               //Query novo código
               $select_usuarios = mysqli_query($conn, "SELECT * FROM login WHERE users = '$verify'");
               $result_usuarios = mysqli_fetch_assoc($select_usuarios);

               //Object
               $mail = new PHPMailer(true);
               try {

                    $mail->isSMTP();
                    $mail->CharSet = 'UTF-8';
                    $mail->Host = 'mail.dreamsistemas.com.br';
                    $mail->SMTPAuth = true;
                    $mail->Username = 'sistema_atrasos@dreamsistemas.com.br';
                    $mail->Password = 'xryojo^mNiQ3';
                    $mail->Port = 587;


                    $mail->setFrom('sistema_atrasos@dreamsistemas.com.br', 'Sistema atrasos');
                    $mail->addAddress($reset_email);   

                    $mail->isHTML(true);
                    $mail->Subject = 'Código de redefinição de senha';
                    $mail->Body = "
                         <h1>Email de redefinição de senha</h1>
                         <br>
                         O seu código é <b>$reset_cod</b>
                    "; 
                    
                    if ($mail->send()) {                                            
                         $_SESSION["update_page"] = true;
                         $_SESSION['reset_email'] = $reset_email;
                         $_SESSION['code'] = $reset_cod;  
                         $_SESSION['db_usuario'] = $result_usuarios['users'];  

                         header('Location: redeem_code.php');
                         exit;
                              
                    } else {
                         
                         echo 'Erro ao enviar o e-mail: ' . $mail->ErrorInfo;
                    
                        }
                    } catch (Exception $e) {
                    
                         echo "Erro no envio: {$mail->ErrorInfo}";
                    
                         }

               }

          }

     }

