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

function transferir(){
    alert("Antes de excluir sua conta transfira seus eletricistas para outro gerente!");
}
// function transferencia(){
//     var transferir = confirm("Tem certeza que deseja transferir todos os seus eletricistas para outro gerente?");
//     if(transferir == true){
//         windows.location.href = "../gerente/acao.php?acao="
//     }
// }
