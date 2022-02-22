create table usuario(
	id_usuario serial not null primary key,
	nome_usuario varchar(20) not null,
	email_usuario varchar(50) not null,
	senha_usuario text not null,
	status varchar(10) not null,
	tipo_usuario varchar(13) not null
);
create table menu(
	id_menu serial not null primary key,
	descricao_menu varchar(15) not null,
	aparece_menu_menu varchar(1) not null
);
create table categoria(
	id_categoria serial not null primary key,
	id_menu_categoria int not null references menu(id_menu),
	descricao_categoria varchar(25) not null,
	aparece_menu varchar(1) not null
);
select categoria.id_categoria, categoria.id_menu_categoria, categoria.descricao_categoria, categoria.aparece_menu, menu.descricao_menu from categoria, menu where menu.id_menu = categoria.id_menu_categoria order by descricao_categoria;