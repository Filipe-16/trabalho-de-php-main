<?php
// Exibe a mensagem
echo "Remover";

// Obtém o ID das músicas que vão ser removidas via POST
$id_remover = $_POST['id'];

// Conecta o Banco de Dados
$conexao = mysqli_connect("localhost", "root", "mysqluser", "crud_musicas");

// Monta a query SQL para deletar a música utilizando o ID fornecido
$query = "DELETE FROM musicas WHERE id=".$id_remover;

echo "$query";

// Executa a query para deletar a música
$resultado = mysqli_query($conexao, $query);

?>
<a href="index.php">Retornar aqui</a>
