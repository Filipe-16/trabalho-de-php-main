<?php

// Exibe a mensagem
echo "Banco De Dados";

// Conexão o Banco de Dados
$conexao = mysqli_connect("localhost", "root", "mysqluser", "crud_musicas");

// Atualiza os dados do filme caso o formulário seja submetido
if (!empty($_POST['id_for_updating'])){
    $nome_edit = $_POST['nome_edit'];
    $artista_edit = $_POST['artista_edit'];
    $ano_edit = $_POST['ano_edit'];
    $id_for_updating = $_POST['id_for_updating']; 

    // Query para atualizar os dados da música 
    $query = "UPDATE musicas SET nome='$nome_edit', artista='$desenvolvedora_edit', ano='$genero_edit' WHERE id=$id_for_updating";

    // Executa a query para atualização
    mysqli_query($conexao, $query);
}

// Remove uma música se o formulário de remoção foi submetido
if (!empty($_POST["id_for_removing"])){
    $removingRow = $_POST["id_for_removing"]; 
    
    // Query para remover a música do banco de dados
    $query_for_removing = "DELETE FROM musicas WHERE id=$removingRow";

    // Executa a query para remover música
    mysqli_query($conexao, $query_for_removing);

}

$query = "SELECT id,nome,artista,ano,imagem FROM musicas";
$resultado = mysqli_query($conexao, $query);

?>
<table class="table">
    <thead>
        <tr>
            <th scope="col">id<th>
            <th scope="col">Nome:</th>
            <th scope="col">Artista:</th>
            <th scope="col">Ano:</th>
            <th scope="col">Imagem:</th>
        </tr>
    </thead>
    <tbody>
        <?php
        while($linha = mysqli_fetch_array($resultado, MYSQLI_ASSOC)){
                echo "<tr> <td>".$linha['id']."</td> <td>".$linha['nome']."</td>
                <td>".$linha['artista']."</td>
                <td>".$linha['ano']."</td>
                <td><img src = './uploads/".$linha ['imagem']."'width ='100' 'height = '100'> </td>";
            ?>
            <td>
                <form action="listar_dados.php"  method="post" >
                    <input type="hidden" name="id_for_removing" value="<?=$linha['id']?>">
                    <button type="submit" name="submit">Delete</button>
                </form>
            </td>
            <td>
                <form action="editar_form.php"  method="post" >
                    <input type="hidden" name="id_update" value="<?=$linha['id']?>">
                    <button type="submit" name="submit">Editar</button>
                </form>
            </td>
            </tr>
            <?php    
        }
        ?>
        <a href="index.php">Clique para retornar</a>
    </tbody>
</table>
