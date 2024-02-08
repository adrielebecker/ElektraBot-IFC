function erroDuplicado(){
    alert("Já existe salvo no Banco de Dados, favor verificar!");
}

function excluirRelatorio(id){
    var acao = confirm("Tem certeza que deseja excluir este relatório?");
    if(acao == true){
        window.location.href = "../relatorio/acao.php?acao=excluir&id=" + id;
    } else{
        window.location.href = "../relatorio/relatorios-eletricista.php";
    }
}

function excluirConta(id){
    var acao = confirm("Tem certeza que deseja excluir?");
    if(acao == true){
        window.location.href = '../eletricista/acao.php?acao=excluir&id=' + id;
    } else{
        window.location.href = "../eletricista/camera.php";
    }

}

function excluirSubstituicao(substituicao, gerente){
    var acao = confirm("Tem certeza que deseja excluir?");
    if(acao == true){
        window.location.href = "../substituicao/acao.php?acao=excluir&id=" + substituicao;
    } else{
        window.location.href = "../substituicao/substituicoes-gerente.php";
    }
}

function transferir(){
    alert("Antes de excluir sua conta transfira seus eletricistas para outro gerente!");
}

function mensagemR(){
    alert("Nenhum relatório no momento!");
}

function mensagemG(){
    alert("Nenhuma gravação no momento!");
}

