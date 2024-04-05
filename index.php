<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>IFRS</title>
</head>
<body>
    <h1>CRUD de Músicas</h1>
    <form action="inserir_dados.php" method="post" enctype="multipart/form-data">
        <label for="nome">Nome da Música:</label>
        <input type="text" name="nome" id="nome">
        <br><br>
        <label for="artista">Artista:</label>
        <input type="text" name="artista" id="artista">
        <br><br> 
        <label for="ano">Ano de Lançamento:</label>
        <input type="text" name="ano" id="ano">
        <br><br>
        <label for="imagem">Imagem:</label>
        <input type="file" name="imagem" id="imagem">
        <br><br> 
        <input type="submit" value="Enviar">
    </form>
    <br><br>
    <h2>Listar Músicas</h2>
    <a href="listar_dados.php" class="btn btn-primary">Listar as Músicas</a>
    <br><br>
    <h2>Procurar Músicas</h2>
    <form method="post">
        <div class="form-group">
            <input type="text" class="form-control" name="pesquisar">
        </div>
        <button type="submit" class="btn btn-primary">Pesquisar</button>
    </form>
    <?php

    $conexao = mysqli_connect("localhost", "root", "mysqluser", "crud_musicas");

    if(isset($_POST['pesquisar'])) {
        $pesquisar = $_POST['pesquisar'];

        $stmt = mysqli_prepare($conn, "SELECT * FROM musicas WHERE artista LIKE ? LIMIT 5");

        mysqli_stmt_bind_param($stmt, "s", $param_pesquisar);
        
        $param_pesquisar = "%$pesquisar%";
        
        mysqli_stmt_execute($stmt);
        
        $resultado_das_musicas = mysqli_stmt_get_result($stmt);
        
        while($row = mysqli_fetch_array($resultado_das_musicas)){
            echo "Nome da Música: ".$row['nome']."<br>";
            echo "Artista: ".$row['artista']."<br>";
            echo "Ano de Lançamento: ".$row['ano']."<br>";
        }
    }
    ?>
</body>
</html>
