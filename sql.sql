create table usuario(
	id_usuario serial not null primary key,
	nome_usuario varchar(20) not null,
	email_usuario varchar(50) not null,
	senha_usuario text not null,
	status varchar(10) not null,
	tipo_usuario varchar(13) not null
);

create table categoria(
	id_categoria serial not null primary key,
	descricao_categoria varchar(15) not null,
	aparece_menu varchar(1) not null
);

select * from categoria;