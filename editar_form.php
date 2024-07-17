<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>IFRS</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body{
            margin: 25px;
        }

        form{
            margin: 0 auto;
            max-width: 380px;
        }

        label{
            margin-bottom: 6px;
            display: block;
        }
    </style>
</head>
<body>
    <h1>Formulário para enviar dados</h1>
    <?php
    
    // Verifica se o ID foi enviado via POST
    if(isset($_POST['id_for_editing'])) {

        // Obtém o ID da música
        $id_da_musica = $_POST['id_for_editing'];
       
        // Conecta o banco de dados
        $conexao = mysqli_connect("localhost", "root", "mysqluser", "crud_musicas");
        
        $query = "SELECT nome, artista, ano, imagem FROM musicas WHERE id=$id_da_musica";
      
        // Executa a query SQL
        $resultado = mysqli_query($conexao, $query);
        
        if ($resultado && mysqli_num_rows($resultado) > 0) {
            $linha = mysqli_fetch_array($resultado, MYSQLI_ASSOC);
        } 
        else {
            echo "A música não foi encontrada";
        }
    } 
    else {
        echo "O ID da música não foi especificado";
    }

    ?>
    <form action="editar-data.php" method="post" enctype="multipart/form-data">
        <input type="hidden" name="id_atualizacao" value="<?php echo $id_da_musica; ?>">
        <label>Nome:</label>
        <input type="text" name="nome_edit" value="<?php if(isset($linha)) echo $linha['nome']; ?>" required><br>
        <label>Artista:</label>
        <input type="text" name="artista_edit" value="<?php if(isset($linha)) echo $linha['artista']; ?>" required><br>
        <label>Ano:</label>
        <input type="text" name="ano_edit" value="<?php if(isset($linha)) echo $linha['ano']; ?>" required><br>
        <label>Imagem:</label>
        <input type="file" name="imagem_edit"><br>
        <button type="submit" name="submit" class="btn btn-primary">Enviar</button>
    </form>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
