<?php
session_start();  

	if (isset($_SESSION['acesso'])) {
		  if($_SESSION['acesso'] === true ){
			      require "conexao.php";

            $sql = "SELECT COUNT(*) AS total FROM login";
            $result = mysqli_query($conn, $sql);
                if ($result && mysqli_num_rows($result) > 0) {

                    $row = mysqli_fetch_assoc($result);
                  
                    $count = $row['total'];

                    }
          
	          } else {
	          		header('Location: ./manutencao.php');
              
	          	  }

	    } else {
	    	  header('Location: ./manutencao.php');
      
	    }

  $count < 10 ? $num = "0". $count : $num = $count;



// $inatividade = time() - $_SESSION['ultimo_acesso'];
// echo "Ultimo acesso: ". $_SESSION['ultimo_acesso']."<br>";
// echo "Diferença: ". $inatividade."<br>";
// echo "Agora: ". time();
// if ($inatividade >= 300) {

//     unset($_SESSION['ultimo_acesso']); // Limpa a sessão 

//     $_SESSION['mss'] = '
//         <div id="mss" style="color:red;" class="alert alert-warning" role="alert">
//           <i class="bi bi-exclamation-triangle-fill"></i> Sessão de login expirada!
//         </div>
//     ';

//     header("Location: login.php");
//     exit;
// }

// $_SESSION['ultimo_acesso'] = time();


if (isset($_POST['code']) && isset($_SESSION['code'])) {

    if ($_POST['code'] == $_SESSION['code']) {
         $_SESSION['confirmado'] = true;
    } else {
        $_SESSION['mss'] = '
 		     <div id="mss" class="alert alert-warning" role="alert">
 		       <i class="bi bi-exclamation-triangle-fill"></i> Código de verificação inválido!
 		     </div>
 		     ';
          header("Location: login.php");
          exit;    
       }
 }
?>


<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <title>Painel do Administrador</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <!-- Font Awesome -->
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/signin.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">

  <style>


    body {
      background-color: #f5f8fa;
    }

    .navbar .nav-link,
    .navbar .navbar-brand {
      color: #fff !important;
    }

    .navbar .nav-link:hover {
      color: #e0ecf7 !important;
    }

    .info-card {
      display: flex;
      justify-content: space-between;
      align-items: center;
      border-radius: 12px;
      padding: 20px;
      box-shadow: 0 4px 10px rgba(0, 0, 0, 0.08);
      height: 100px;
      transition: transform 0.2s;
      border: #e0ecf7 solid 1px;
    }

    .info-card:hover {
      transform: translateY(-3px);
      box-shadow: 0 6px 12px rgba(0, 0, 0, 0.12);
    }

    .count {
      font-size: 1.5rem;  
    }

    .info-card .icon {
      font-size: 2.2rem;
    }

    .info-card h5 {
      font-size: 1.25rem;
      margin-bottom: 0.25rem;
    }



    footer {
      text-align: center;
      color: #888;
      margin-top: 40px;
    }
    
  </style>
</head>
<body class="bg-light">
<main>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <div class="container-fluid">
    <a href="dashboard.php" class="navbar-brand"wee><i class="bi bi-house"> </i>Painel do Administrador</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNavDropdown">
      <ul class="navbar-nav ms-auto">
        
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">
            Usuários
          </a>
          <ul class="dropdown-menu">
            <li><a class="dropdown-item" href="dashboard.php?pagina=listar_usuarios">Listar Usuários</a></li>
            <li><a class="dropdown-item" data-bs-toggle="modal" href="#" data-bs-target="#modalUsuario">Cadastrar Novo</a></li>
          </ul>
        </li>

        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">
            Produtos
          </a>
          <ul class="dropdown-menu">
            <li><a class="dropdown-item" href="#">Listar Produtos</a></li>
            <li><a class="dropdown-item" href="#">Adicionar Produto</a></li>
          </ul>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">
            Clientes
          </a>
          <ul class="dropdown-menu">
            <li><a class="dropdown-item" href="#">Listar Clientes</a></li>
            <li><a class="dropdown-item" href="#">Adicionar Cliente</a></li>
          </ul>
        </li>
        <li class="nav-item dropdown">
          <button type="button" class="btn btn-outline-danger" data-bs-toggle="modal" data-bs-target="#modalSair">
            Sair <i class="bi bi-box-arrow-right"></i>
          </button>
        </li>
      </ul>
    </div>
  </div>
</nav>


<div class="modal fade" id="meuModal" tabindex="-1" aria-labelledby="modalUsuarioLabel" data-bs-backdrop="static" role="dialog" aria-labelledby="exampleModalLabel" data-bs-keyboard="false" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Bem vindo(a), <?= $_SESSION['usuario'] ?></h5>
      </div>
      <div class="modal-body">
      <p class="text-muted mb-3">
        Confirme o código recebido no e-mail: 
        <span class="fw-semibold"><?=$_SESSION['email']?></span>
      </p>
      <form action="<?=$_SERVER['PHP_SELF']?>" method="post">
        <input type="text" class="form-control text-center fs-4 fw-bold" 
                   id="cod" name="code" maxlength="4" minlength="4" 
                   placeholder="----" required>
      </div>
      <div class="modal-footer">
        <button type="submit" class="btn btn-primary">Confirmar</button>
      </form>
      </div>
    </div>
  </div>
</div>
</div>

<!-- Modal de Confirmação de Saída -->
<div class="modal fade" id="modalSair" tabindex="-1" aria-labelledby="modalSairLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header bg-danger text-white">
        <h5 class="modal-title" id="modalSairLabel">Confirmar Saída</h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Fechar"></button>
      </div>
      <div class="modal-body">
        Tem certeza que deseja sair e voltar para a página inicial?
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
        <a href="./" class="btn btn-danger">Confirmar</a>
      </div>
    </div>
  </div>
</div>

<?php
$pagina = $_GET['pagina'] ?? null;

  if ($pagina === 'listar_usuarios') {
    include 'listar_usuarios_content.php';
  } else {
?>
<!-- Cards padrão (caso não esteja listando usuários) -->
<div class="container mt-5">
  <div class="row g-4">
    <div class="col-md-4">
      <div class="info-card">
        <div>
          <h5>Usuários</h5>
          <div class="count"><?= $num; ?></div>
        </div>
        <div class="icon"><i class="fas fa-user"></i></div>
      </div>
    </div>
    <div class="col-md-4">
      <div class="info-card">
        <div>
          <h5>Produtos</h5>
          <div class="count">00</div>
        </div>
        <div class="icon"><i class="fas fa-box"></i></div>
      </div>
    </div>
    <div class="col-md-4">
      <div class="info-card">
        <div>
          <h5>Clientes</h5>
          <div class="count">00</div>
        </div>
        <div class="icon"><i class="fas fa-users"></i></div>
      </div>
    </div>
  </div>
</div>
<?php } ?>


<div class="modal fade" id="modalUsuario" tabindex="-1" aria-labelledby="modalUsuarioLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg">
    <div class="modal-content shadow-lg" style="color: #212529; border-radius: 10px;">
      
      <div class="modal-header" style="background-color: #212529; border-radius: 10px 10px 0 0;">
        <h5 class="modal-title text-white" id="modalUsuarioLabel">
          <i class="bi bi-person-plus-fill"></i> Cadastrar Novo Usuário
        </h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Fechar"></button>
      </div>

      <form action="cadastra_usuario.php" method="post">
        <div class="modal-body">

          <!-- Nome -->
          <div class="mb-3">
            <label for="usuario" class="form-label fw-bold">Nome de Usuário</label>
            <input type="text" class="form-control border-secondary" maxlength="100" id="usuario" name="usuario" required>
          </div>

          <!-- Senha -->
          <div class="mb-3">
            <label for="senha" class="form-label fw-bold">Senha</label>
            <input type="password" class="form-control border-secondary" id="senha" oninput="validar_senha()" name="senha" required>
            <div id="msgSenha" class="form-text text-danger"></div>
          </div>

          <!-- Regras da Senha -->
          <div class="alert alert-warning" role="alert" id="validacoesSenha">
            <strong class="erro ">Requisitos da senha:</strong>
            <p id="val-tamanho" class="erro">• Entre 4 e 6 caracteres</p>
            <p id="val-letra" class="erro">• Contém letra</p>
            <p id="val-numero" class="erro">• Contém número</p>
            <p id="val-especial" class="erro">• Contém caractere especial</p>
            <p id="val-igual" class="erro">• Senhas iguais</p>
          </div>

          <!-- Confirmar Senha -->
          <div class="mb-3">
            <label for="confirmar_senha" class="form-label fw-bold">Confirmar Senha</label>
            <input type="password" class="form-control border-secondary" id="confirmar_senha" name="confirmar" oninput="validar_senha()" required>
            <i class="bi bi-eye-slash mb-0" 
				    	id="togglePassword"
				    	style=" top: 50%; right: 15px; transform: translateY(-50%); cursor: pointer; color: #6c757d; font-size: 1.2rem;"
				    ></i>
            <div id="msgConfirmar" class="form-text text-danger"></div>
          </div>

          <!-- Email -->
          <div class="mb-3">
            <label for="email" class="form-label fw-bold">Email</label>
            <input type="email" class="form-control border-secondary" id="email" name="email" required>
            <div id="msgEmail" class="form-text text-danger"></div>
          </div>

        </div>

        <div class="modal-footer" style="background-color: #343a40; border-radius: 0 0 10px 10px;">
          <button type="button" class="btn btn-outline-light" data-bs-dismiss="modal">
            <i class="bi bi-x-lg"></i> Cancelar
          </button>
          <button type="submit" id="confirmar" class="btn btn-light text-dark fw-bold">
            <i class="bi bi-check-circle-fill"></i> Cadastrar
          </button>
        </div>

      </form>
    </div>
  </div>
</div>


</main>

<!-- Footer -->

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
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

	</script>
        
      <?php if (!isset($_SESSION['confirmado'])): ?>

        <script>
          document.addEventListener("DOMContentLoaded", function() {
            var meuModal = new bootstrap.Modal(document.getElementById('meuModal'));
            meuModal.show();
          });
        </script>

      <?php endif; ?>
<script>



// if (aviso) {
// 	    let intervalo = setInterval( () => {
// 	        cc--;
// 	        if (cc == 0) {
// 	            aviso.innerHTML = '';
// 	            clearInterval(intervalo); 
// 	        }
// 	    }, 1000);
// 	}
  let tempoLimite = 1000 * 20; 

  let timer;
  const pagina = window.document.body;

  pagina.addEventListener('click', function() {
      console.log('Button clicked!');
  });

  window.onload = function () {
	var contador = 3;
	    let login = setInterval( () => {
	        contador--;
          console.log('asjdhds clicked!');
	        if (contador == 0) {  
            fetch("logout")
	        }
          
	    }, 1000);
}

function validar_senha() {
    const senha = document.getElementById("senha").value;
    const confirmar = document.getElementById("confirmar_senha").value;

    // Regras
    const temTamanho = senha.length >= 4 && senha.length <= 6;
    const temLetra = /[a-zA-Z]/.test(senha);
    const temNumero = /[0-9]/.test(senha);
    const temEspecial = /[^a-zA-Z0-9]/.test(senha);
    const iguais = senha !== "" && senha === confirmar;

    // Atualiza cada item visualmente
    atualizaValidacao("val-tamanho", temTamanho);
    atualizaValidacao("val-letra", temLetra);
    atualizaValidacao("val-numero", temNumero);
    atualizaValidacao("val-especial", temEspecial);
    atualizaValidacao("val-igual", iguais);

    // Mensagens abaixo dos inputs
    document.getElementById("msgSenha").innerHTML =
        temTamanho && temLetra && temNumero && temEspecial ? "" : "Senha inválida";

    document.getElementById("msgConfirmar").innerHTML =
        iguais ? "" : "As senhas não coincidem";
}

function atualizaValidacao(id, valido) {
    const el = document.getElementById(id);
    if (valido) {
        el.classList.remove("text-danger");
        el.classList.add("text-success");
    } else {
        el.classList.add("text-danger");
        el.classList.remove("text-success");
    }
}
	  const input = document.getElementById('confirmar_senha');
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
<footer>
	<p style="text-align: center;" class="mt-5 mb-3 text-muted">&copy; Desenvolvido por: Mateus Batista Bento dos Santos Ds2 <?= date("Y");?></p>
</footer>
</html>