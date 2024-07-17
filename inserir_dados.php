<?php

// Obtém os dados do formulário via POST
$nome = $_POST['nome'];
$artista = $_POST['artista'];
$ano = $_POST['ano'];

// Conecta Banco de Dados
$conexao = mysqli_connect("localhost", "root", "mysqluser", "crud_musicas");

$targetDir = "uploads/";

if(!empty($_FILES["imagem"]["name"])){
    $fileName = basename($_FILES["imagem"]["name"]);

    $fileNameModified = date("YmdHis").$fileName;

    $targetFilePath = $targetDir . $fileName ;
    $fileType = pathinfo($targetFilePath, PATHINFO_EXTENSION);
    $targetFilePath = $targetDir.$fileNameModified;


    // Diretório de destino para upload das imagens
    $allowTypes = array('jpg','png','jpeg','gif');

    // Verifica se o arquivo da imagem foi enviado
    if(in_array($fileType, $allowTypes)){

        if(move_uploaded_file($_FILES["imagem"]["tmp_name"], $targetFilePath)){

            $query = "INSERT INTO musicas (nome,artista,ano,imagem) VALUES ('$nome', '$artista' , '$ano' , '$fileNameModified')";
            $insert = mysqli_query($conexao, $query);

            if($insert){
                $statusMsg = "O nome e o arquivo ".$fileName. " foram inseridos sem erros<br>";
            }
            else{
                $statusMsg = "Ocorreu um erro ao realizar o upload do arquivo";
            }
        }
        else{
            $statusMsg = "Ocorreu um erro ao realizar o upload do arquivo";
        }
    }
    else{
        $statusMsg = 'O formato é inválido';
    }
}
else{
    $statusMsg = 'Por favor, selecione um arquivo para fazer upload';
}

// Exibe a mensagem
echo $statusMsg;

// Exibe a mensagem sobre a armazenamento de dados
echo "Dados estão sendo armazenados no banco de dados<br>";


if($result) {
    echo "<br>O registro foi armazenado com sucesso<br>";
}
else {
    echo "<br>Ocorreu um erro";
}

?>
<a href="index.php">Voltar</a>
