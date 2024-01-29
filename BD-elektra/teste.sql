create database teste;
use teste;

create table cargo(
	id int not null auto_increment unique,
    descricao varchar(45) not null
);

create table usuario(
	id int not null unique,
    usuario varchar(45) not null,
    nome varchar(45) not null,
    dataNasc date not null,
    sexo varchar(45) not null,
    cpf char(11) not null,
    matricula varchar(45) not null,
    celular char(11) not null,
    email varchar(45) not null,
    estado varchar(45) not null,
    cidade varchar(45) not null,
    bairro varchar(45) not null,
    rua varchar(45) not null,
    complemento varchar(45),
    numero varchar(45),
    cep varchar(45) not null,
    senha varchar(45) not null,
    cargo int not null,
    gerente int,
    primary key(id), 
    foreign key(gerente) references usuario(id),
    foreign key(cargo) references cargo(id)
);
ALTER TABLE `usuario` DROP FOREIGN KEY `usuario_ibfk_1`;

ALTER TABLE `usuario` 
CHANGE COLUMN `id` `id` INT NOT NULL AUTO_INCREMENT;

ALTER TABLE `usuario`
ADD CONSTRAINT `usuario_ibfk_1`
FOREIGN KEY (`gerente`)
REFERENCES `usuario`(`id`);
