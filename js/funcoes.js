function erroDuplicado(){
    alert("Já existe salvo no Banco de Dados, favor verificar!");
}

function excluirRelatorio(id){
    var excluir = confirm("Tem certeza que deseja excluir este relatório?");
    if(excluir == "true"){
       windows.location.href = "../relatorio/acao.php?acao=excluir&id=".id;
    } else{
        alert("NO");
    }
}
