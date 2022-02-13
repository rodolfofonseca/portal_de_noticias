create table usuario(
	id_usuario serial not null primary key,
	nome_usuario varchar(20) not null,
	email_usuario varchar(50) not null,
	senha_usuario text not null
);

create table categoria(
	id_categoria serial not null primary key,
	descricao_categoria varchar(15) not null
);