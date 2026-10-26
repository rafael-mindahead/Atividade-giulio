CREATE DATABASE IF NOT EXISTS atividade CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE atividade;

CREATE TABLE clientes (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(100),
    email VARCHAR(120),
    cidade VARCHAR(80),
    estado VARCHAR(2),
    profissao VARCHAR(80),
    telefone VARCHAR(20)
);

INSERT INTO clientes (nome, email, cidade, estado, profissao, telefone) VALUES
('Ana Souza',   'ana@email.com',   'Curitiba',     'PR', 'Engenheira', '41 99999-0001'),
('Bruno Lima',  'bruno@email.com', 'Londrina',     'PR', 'Professor',  '43 99999-0002'),
('Carla Dias',  'carla@email.com', 'Joinville',    'SC', 'Médica',     '47 99999-0003'),
('Diego Alves', 'diego@email.com', 'Curitiba',     'PR', 'Professor',  '41 99999-0004'),
('Elisa Rocha', 'elisa@email.com', 'Porto Alegre','RS', 'Designer',   '51 99999-0005');
