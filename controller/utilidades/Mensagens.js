function mensagemSucesso(){
    Swal.fire({icon:'sucess', title:'Sucesso', Text:'Operação realizada com sucesso!'});
}
function mensagemErro(){
    Swal.fire({icon:'error', title:'Atenção', text:'Erro durante a operação', footer:'Tente novamente mais tarde'});
}