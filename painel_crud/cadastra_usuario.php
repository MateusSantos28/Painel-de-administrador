<?php
session_start();
include "conexao.php";

if($_SERVER['REQUEST_METHOD'] !== 'POST'){
    $_SESSION['mss'] = '
    <div id="mss" class="alert alert-danger" role="alert">
        Acesso inválido
    </div>';
    header("Location: login.php");
    exit();
}

$new_usuario = $_POST['usuario'];
$senha = $_POST['senha'];
$confirmar = $_POST['confirmar'];
$email = $_POST['email'];


if ($senha !== $confirmar) {
    $_SESSION['cadastro'] = '
    <div class="alert alert-danger" role="alert">
        As senhas não conferem!
    </div>';
    header("Location: ./dashboard.php?pagina=listar_usuarios");
    exit();
}


if (!preg_match('/^(?=.*[A-Za-z])(?=.*\d)(?=.*[^A-Za-z0-9]).{4,6}$/', $senha)) {
    $_SESSION['cadastro'] = '
    <div class="alert alert-danger" role="alert">
        Usuário não cadastrado. Digite corretamente a senha!
    </div>';
    header("Location: ./dashboard.php?pagina=listar_usuarios");
    exit();
}

$verificacao = mysqli_query($conn,"SELECT * FROM login WHERE email = '$email'");
if (mysqli_num_rows($verificacao) > 0){
    $_SESSION['cadastro'] = '
    <div id="mss" class="alert alert-danger" role="alert">
        Já existe um usuário com esse email!
    </div>';
    header("Location: ./dashboard.php?pagina=listar_usuarios");
    exit();
}

$verificacao = mysqli_query($conn,"SELECT * FROM login WHERE users = '$new_usuario'");
if (mysqli_num_rows($verificacao) > 0){
    $_SESSION['cadastro'] = '
    <div id="mss" class="alert alert-danger" role="alert">
        Já existe um usuário com esse nome!
    </div>';
    header("Location: ./dashboard.php?pagina=listar_usuarios");
    exit();
}


$hash_senha  = password_hash($senha, PASSWORD_DEFAULT);
$cod = rand(1000, 9999);

if(
    mysqli_query($conn, "INSERT INTO login (users, password, email) 
    VALUES ('$new_usuario', '$hash_senha', '$email')") 
    && 
    mysqli_query($conn, "UPDATE login SET cod = '$cod' WHERE users = '$new_usuario'")
){
    $_SESSION['cadastro'] = '
    <div id="mss" class="alert alert-success" role="alert">
        Usuário cadastrado com sucesso!
    </div>';
    header("Location: ./dashboard.php?pagina=listar_usuarios");
    exit();
}
