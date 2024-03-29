create database elektrabot_ifc;
use elektrabot_ifc;

create table gerente(
	id int not null auto_increment unique,
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
    foto varchar(45),
    primary key(id)
);

create table eletricista(
	id int not null auto_increment unique,
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
    gerente int not null,
    foto varchar(45),
    primary key(id),
    foreign key(gerente) references gerente(id)
);

create table substituicao(
	id int not null auto_increment unique,
	nome varchar(45) not null,
    dataSub date not null,
    localizacao varchar(250) not null,
    eletricista int not null,
    gerente int not null,
    situacao varchar(45) not null,
    primary key(id),
    foreign key(eletricista) references eletricista(id)
);

create table gravacao(
	id int not null auto_increment unique,
    video varchar(45) not null,
    eletricista int not null,
    gerente int not null,
    substituicao int not null unique,
    primary key(id),
    foreign key(eletricista) references eletricista(id),
    foreign key(gerente) references gerente(id),
    foreign key(substituicao) references substituicao(id)
);

create table relatorio(
	id int not null auto_increment unique,
    texto varchar(1000) not null, 
    codAntigo varchar(45) not null,
    codNovo varchar(45) not null,
    tipo varchar(45) not null,
    acidente varchar(45) not null,
    eletricista int not null,
    gerente int not null,
    substituicao int not null unique,
    primary key(id),
    foreign key(eletricista) references eletricista(id),
    foreign key(gerente) references gerente(id),
    foreign key(substituicao) references substituicao(id)
);
