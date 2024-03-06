create database elektrabotifc;
use elektrabotifc;

create table gerente(
	id int not null auto_increment unique,
    usuario varchar(45) not null unique,
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
    foto varchar(45),
    ativo varchar(45),
    primary key(id)
);

create table eletricista(
	id int not null auto_increment unique,
    usuario varchar(45) not null unique,
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
    foto varchar(45),
    ativo varchar(45),
    gerente int not null,
    primary key(id),
    foreign key(gerente) references gerente(id)
);

ALTER TABLE `elektrabotifc`.`eletricista` 
CHANGE COLUMN `ativo` `ativo` VARCHAR(45) NULL DEFAULT 'sim' ;

ALTER TABLE `elektrabotifc`.`gerente` 
CHANGE COLUMN `ativo` `ativo` VARCHAR(45) NULL DEFAULT 'sim' ;

create table gravacao(
	id int not null auto_increment unique,
    video varchar(45) not null,
    substituicao int not null unique,
    primary key(id)
);

create table relatorio(
	id int not null auto_increment unique,
    texto varchar(1000) not null, 
    codAntigo varchar(45) not null,
    codNovo varchar(45) not null,
    tipo varchar(45) not null,
    acidente varchar(45) not null,
    substituicao int not null unique,
    primary key(id)
);

create table substituicao(
	id int not null auto_increment unique,
	nome varchar(45) not null,
    dataSub date not null,
    situacao varchar(45) not null,
    latitude varchar(45) not null,
    longitude varchar(45) not null,
    eletricista int not null,
	gravacao int unique,
    relatorio int unique,
    primary key(id),
    foreign key(eletricista) references eletricista(id),
    foreign key(gravacao) references gravacao(id),
    foreign key(relatorio) references relatorio(id)
);
