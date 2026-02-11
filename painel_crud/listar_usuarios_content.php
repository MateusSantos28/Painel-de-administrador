<?php
require "conexao.php";

$sql = "SELECT * FROM login";
$result = mysqli_query($conn, $sql);
$usuarios = mysqli_fetch_all($result, MYSQLI_ASSOC);

?>

<div class="container mt-5">
    <h2 class="mb-4">Lista de Usuários</h2>

    <?php if (count($usuarios) > 0): ?>
        <table class="table table-bordered table-striped">
            <thead class="table-dark">
                <tr>
                    <th>ID</th>
                    <th>Nome do Usuário</th>
                    <th>Email</th>
                    <th style="width:12%">Excluir</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($usuarios as $usuario): ?>
                    <tr>
                        <td><?= $usuario['id'] ?></td>
                        <td><?= htmlspecialchars($usuario['users']) ?></td>
                        <td><?= $usuario['email']?></td>
                        <td>
                            <center>
                                <button type="button" class="btn btn-link text-danger" style="border:none;" data-bs-toggle="modal" data-bs-target="#confirmU<?= $usuario['id'] ?>">
                                    <i class="bi bi-trash3-fill"></i>
                                </button>
                            </center>

                            <!-- Modal exclusivo para este usuário -->
                            <div class="modal fade" id="confirmU<?= $usuario['id'] ?>" tabindex="-1" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content">
                                        <div class="modal-header bg-danger text-white">
                                            <h5 class="modal-title">Exclusão de usuário</h5>
                                            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                                        </div>
                                        <div class="modal-body">
                                            Tem certeza que deseja excluir <b>"<?= htmlspecialchars($usuario['users'])?>"<?=" de ID:".$usuario['id']. "?" ?></b>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                                            <a href="excluir.php?id=<?= $usuario['id'] ?>" class="btn btn-danger">Confirmar</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php else: ?>
        <div class="alert alert-warning">Nenhum usuário encontrado.</div>
    <?php endif; ?>
    <div id="mss">
    <?php
          if (isset($_SESSION['cadastro'])) {
		echo $_SESSION['cadastro'];
		unset ($_SESSION['cadastro']);
		}
          if (isset($_SESSION['excluido'])) {
		echo $_SESSION['excluido'];
		unset ($_SESSION['excluido']);
		}
     ?>
     </div>
</div>
