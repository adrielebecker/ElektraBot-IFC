create database elektrabot;
use elektrabot;

create table gerente(
	usuario varchar(45) not null unique,
    nome varchar(45) not null,
    dataNasc date,
    sexo varchar(45) not null,
    cpf varchar(45) not null,
    matricula varchar(45) not null,
    celular varchar(45) not null,
    email varchar(45) not null,
    estado varchar(45) not null,
    cidade varchar(45) not null,
    bairro varchar(45) not null,
    rua varchar(45) not null,
    complemento varchar(45) not null,
    numero varchar(45) not null,
    cep varchar(45) not null,
    primary key(usuario)
);

create table eletricista(
	usuario varchar(45) not null unique,
    nome varchar(45) not null,
    dataNasc date,
    sexo varchar(45) not null,
    cpf varchar(45) not null,
    matricula varchar(45) not null,
    celular varchar(45) not null,
    email varchar(45) not null,
    estado varchar(45) not null,
    cidade varchar(45) not null,
    bairro varchar(45) not null,
    rua varchar(45) not null,
    complemento varchar(45) not null,
    numero varchar(45) not null,
    cep varchar(45) not null,
    gerente varchar(45) not null,
    primary key(usuario),
    foreign key(gerente) references gerente(usuario)
);

create table substituicao(
	id int not null unique auto_increment,
    nome varchar(45) not null,
    dataSub date not null,
    localizacao varchar(250) not null,
    eletricista varchar(45) not null,
    gerente varchar(45) not null,
    primary key(id),
    foreign key(eletricista) references eletricista(usuario),
	foreign key(gerente) references gerente(usuario)
);

create table relatorio(
	id int not null unique auto_increment,
    texto varchar(1000) not null,
    codAntigo varchar(45) not null,
    codNovo varchar(45) not null,
    tipo varchar(45) not null,
    substituicao int not null,
    dataSub date not null,
	acidente varchar(45) not null,
    eletricista varchar(45) not null,
    gerente varchar(45) not null,
    primary key(id),
    foreign key(substituicao) references substituicao(id),
    foreign key(eletricista) references eletricista(usuario),
    foreign key(gerente) references gerente(usuario)
);

create table notificacao(
	id int not null auto_increment unique,
    nome varchar(45) not null,
    eletricista varchar(45) not null,
    gerente varchar(45) not null,
    substituicao int not null,
    primary key(id),
    foreign key(eletricista) references eletricista(usuario),
    foreign key(gerente) references gerente(usuario),
    foreign key(substituicao) references substituicao(id)
);

create table gravacao(
	id int unique not null auto_increment,
    nome varchar(45) not null,
    eletricista varchar(45) not null,
    gerente varchar(45) not null,
    substituicao int not null,
    video varchar(45) not null,
    primary key(id),
    foreign key(eletricista) references eletricista(usuario),
    foreign key(gerente) references gerente(usuario),
    foreign key(substituicao) references substituicao(id)
);
