create database copa_arena;
USE copa_arena;

CREATE TABLE jogadores (
    id_jogador INT AUTO_INCREMENT PRIMARY KEY,
    nickname VARCHAR(50) NOT NULL,
    nome_completo VARCHAR(150) NOT NULL,
    email VARCHAR(150) NOT NULL,
    telefone VARCHAR(20) NOT NULL,
    usuario_discord VARCHAR(50) NOT NULL,
    cidade VARCHAR(100) NOT NULL,
    plataforma VARCHAR(20) NOT NULL,
    jogo VARCHAR(50) NOT NULL
);
use copa_arena;
 select * from jogadores;
