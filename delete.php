<?php

echo "Remover";

$id_remover = $_POST['id'];
$conexao =  mysqli_connect("127.0.0.1", "root", "", "crud_musicas");
$query = "DELETE FROM musicas WHERE id=".$id_remover;

echo "$query";

$resultado = mysqli_query($conexao, $query);

?>
<a href="index.php">Retornar aqui</a>