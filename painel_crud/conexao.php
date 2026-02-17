<?php
$servername = "sql102.infinityfree.com";
$username = ""; 
$password = ""; //Ocultos para segurança da aplicação
$database = "if0_41133013_projeto_login";

$conn = mysqli_connect($servername,$username,$password,$database);

if ($conn) {
	//echo "Conexão realizada com sucesso!";
} else {
	die("Erro na conexão! ".mysqli_connect_error());
}

	/* USUÁRIOS DA LISTA */
	$sql = "SELECT id, users FROM login";
	$result = mysqli_query($conn, $sql);
	$usuarios = [];

	if (mysqli_num_rows($result) > 0) {
	    while ($row = mysqli_fetch_assoc($result)) {
	        $usuarios[] = $row;
	        $contador['count_users'] = $row['id'];
	    }
	}

