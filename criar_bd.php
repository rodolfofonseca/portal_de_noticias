<?php
require_once 'controller/utilidades/Connection.php';
require_once 'controller/utilidades/DAO.php';
$dao = new DAO();
$dao->ExecutarComando("create table usuario(
	id_usuario serial not null primary key,
	nome_usuario varchar(20) not null,
	email_usuario varchar(50) not null,
	senha_usuario text not null,
	status varchar(10) not null,
	tipo_usuario varchar(13) not null
);");
//$dao->ExecutarComando("insert into usuario(nome_usuario, email_usuario, senha_usuario, status, tipo) values('rodolfo', 'rodolfofonseca01@mgail.com', 'f16c074474d47be3cd708d9b43d86cb2', 'ATIVO', 'ADMINISTRADOR')");
$retorno = $dao->Pesquisar("select * from usuario where nome_usuario = 'rodolfo' and senha = 'f16c074474d47be3cd708d9b43d86cb2'");
foreach($retorno as $ret){
    echo $ret['nome_usuario'];
}
?>