CREATE DATABASE teste_rte;

use teste_rte;

CREATE TABLE `pessoa`
(
    `id` int primary key AUTO_INCREMENT,
    `nome` VARCHAR(100) NOT NULL
);

CREATE TABLE `filho`
(
    `id` int primary key AUTO_INCREMENT,
    `pessoa_id` int,
    `nome` VARCHAR(100) NOT NULL,
    CONSTRAINT FK_PessoaId FOREIGN KEY (`pessoa_id`)
    REFERENCES `pessoa`(`id`) 
    ON DELETE CASCADE ON UPDATE CASCADE
);