<?php

// Obtém os dados do formulário via POST
$nome = $_POST["nome_edit"];
$artista = $_POST["artista_edit"];
$ano = $_POST["ano_edit"];
$id_atualizacao = $_POST["id_atualizacao"];
$diretorio = "uploads/";

// Verifica se o formulário foi submetido
if(isset($_POST["submit"])) { 
    // Conecta o Banco de Dados
    $conexao = mysqli_connect("localhost", "root", "mysqluser", "crud_musicas");

    // Verifica se um arquivo de imagem foi enviado
    if(!empty($_FILES["imagem_edit"]["name"])) { 
        $nome_arquivo = basename($_FILES["imagem_edit"]["name"]);
    
        $nome_arquivo_modificado = date("YmdHis").$nome_arquivo;

        // Define os caminhos do arquivo que vai ser enviado
        $caminho_arquivo = $diretorio . $nome_arquivo ; 

        $tipo_arquivo = pathinfo($caminho_arquivo, PATHINFO_EXTENSION);
        
        $caminho_arquivo_alvo = $diretorio.$nome_arquivo_modificado;

        // Tipos de arquivo que são permitidos
        $tipos_permitidos = array('jpg','png','jpeg','gif'); 

        // Verifica se o tipo do arquivo é permitido
        if(in_array($tipo_arquivo, $tipos_permitidos)) { 
            if(move_uploaded_file($_FILES["imagem_edit"]["tmp_name"], $caminho_arquivo_alvo)) { 
              
                $query = "UPDATE musicas SET nome='$nome', artista='$artista', ano='$ano', imagem ='$nome_arquivo_modificado' WHERE id=$id_atualizacao";
                $inserir = mysqli_query($conexao,$query); 

                if($inserir) { 
                    $mensagem = "O nome e o arquivo ".$nome_arquivo. " foram atualizados com sucesso!<br>"; 
                } 
                else { 
                    $mensagem = "Erro ao realizar o upload do arquivo"; 
                }  
            } 
            else { 
                $mensagem = "Erro ao realizar o upload do arquivo"; 
            } 
        } 
        else { 
            $mensagem = 'Formato inválido.'; 
        } 
    } 
    else { 
        $query = "UPDATE musicas SET nome='$nome', artista='$artista', ano='$ano' WHERE id=$id_atualizacao";
        $inserir = mysqli_query($conexao, $query); 

        if($inserir) { 
            $mensagem = "Informações atualizadas com sucesso!"; 
        } 
        else { 
            $mensagem = "Erro ao atualizar as informações"; 
        }  
    }
}

// Exibe a mensagem de resultado
echo $mensagem;

?>
<br><a href="index.php">Retornar</a>
