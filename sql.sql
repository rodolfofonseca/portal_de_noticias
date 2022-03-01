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
create table noticias(
	id_noticias serial not null primary key,
	id_usuario int not null references usuario(id_usuario),
	id_categoria int not null references categoria(id_categoria),
	titulo_noticias varchar(255) not null,
	data_postagem varchar(10) not null,
	status varchar(1) not null,
	link_materia varchar(255) not null unique,
	imagem varchar(255) not null
);
create table titulo_destaque(
	id_titulo serial not null primary key,
	id_materia int not null references noticias(id_noticias),
	data_inicio varchar(10) not null,
	data_fim varchar(10) not null,
	hora_inicio int not null,
	hora_fim int not null,
	status varchar(1) not null
);
create table paragrafos(
	id_paragrafo serial not null primary key,
	id_noticia int not null references noticias(id_noticias),
	imagem varchar(255) not null,
	paragrafo text not null,
	antes_depois varchar(1) not null
);
create table locais
(
	id_local serial not null primary key,
	descricao varchar(50) not null,
	observacao text
);
create table empresa
(
	id_empresa serial not null primary key,
	nome_empresa varchar(25) not null,
	telefone_contato varchar(15),
	whatsapp varchar(15),
	observacoes text,
	status varchar(1) not null
);
create table contrato_publicidade
(
	id_contrato serial not null primary key,
	id_usuario_cadastro int not null references usuario(id_usuario),
	id_usuario_assinatura_contrato int not null references usuario(id_usuario),
	id_empresa int not null references empresa(id_empresa),
	data_assinatura varchar(10) not null,
	valor_contrato numeric(10,2) not null,
	tipo_pagamento varchar(1) not null,
	data_inicio varchar(10) not null,
	data_fim varchar(10) not null,
	observacoes text
);
create table parcelas
(
	id_parcela serial not null,
	id_contrato int not null references contrato_publicidade(id_contrato),
	valor_parcela numeric(10,2) not null,
	data_vencimento varchar(10) not null,
	status varchar(1) not null
);
create table anuncios
(
	id_anuncio serial not null primary key,
	id_empresa int not null references empresa(id_empresa),
	id_locais int not null references locais(id_local),
	id_contrato int not null references contrato_publicidade(id_contrato),
	data_inicio varchar(10) not null,
	hora_inicio int not null,
	data_fim varchar(10) not null,
	hora_fim int not null,
	status varchar(1) not null
);