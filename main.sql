CREATE DATABASE crud_musicas;

USE crud_musicas;

CREATE TABLE musicas (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(100) NOT NULL,
    artista VARCHAR(100) NOT NULL,
    ano INT NOT NULL,
    imagem LONGBLOB NOT NULL

)