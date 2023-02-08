<?php
require_once './conexao/conexao.php';
require_once './model/pedidos_coleta.model.php';
require_once './service/pedidos_coleta.service.php';
require_once './controller/verificarLogin.controller.php';

function redirectPagePed($int){
    echo '<script>window.location.href = "/index.php?link=3&sceneLogin='.$int.'";</script>';
}

@$acaoPEDIDO = isset($_GET['acaoPEDIDO']) ? $_GET['acaoPEDIDO'] : $acaoPEDIDO;
@$idPEDIDO = isset($_POST['idPEDIDO']) ? $_POST['idPEDIDO'] : $idPEDIDO;

if ($acaoPEDIDO == 'inserir') {
    $pedido = new Pedidos_coleta();

    $pedido->__set('nome', $_POST['nome']);
    $pedido->__set('endereco', $_POST['endereco']);
    $pedido->__set('descricao', $_POST['descricao']);
    $pedido->__set('material', $_POST['material']);
    $pedido->__set('telefone', $_POST['telefone']);
    $pedido->__set('aceita', $_POST['aceita']);
    $pedido->__set('enderecoURL', $_POST['enderecoURL']);
    $pedido->__set('horaDesejada', $_POST['horaDesejada']);
    $pedido->__set('dataDesejada', $_POST['dataDesejada']);
    


    $conexao = new Conexao();

    $pedidoService = new Pedidos_coletaService($pedido, $conexao);
    $pedidoService->inserir();
    return redirectPagePed($_GET["reSceneLogin"]);


} elseif ($acaoPEDIDO == 'deletar') {
    $pedido = new Pedidos_coleta();

    $conexao = new Conexao();

    $pedidoService = new Pedidos_coletaService($pedido, $conexao);
    $pedidoService->deletar($idPEDIDO);
    return redirectPagePed($_GET["reSceneLogin"]);

} elseif ($acaoPEDIDO == 'alterar') {
    $pedido = new Pedidos_coleta();

    $pedido->__set('nome', $_POST['nome']);
    $pedido->__set('endereco', $_POST['endereco']);
    $pedido->__set('descricao', $_POST['descricao']);
    $pedido->__set('material', $_POST['material']);
    $pedido->__set('telefone', $_POST['telefone']);
    $pedido->__set('aceita', $_POST['aceita']);
    $pedido->__set('enderecoURL', $_POST['enderecoURL']);
    $pedido->__set('horaDesejada', $_POST['horaDesejada']);
    $pedido->__set('dataDesejada', $_POST['dataDesejada']);

    $conexao = new Conexao();

    $pedidoService = new Pedidos_coletaService($pedido, $conexao);
    $pedidoService->alterar($idPEDIDO);
    return redirectPagePed($_GET["reSceneLogin"]);


} elseif(($acaoPEDIDO == 'negarPedido')){
    foreach (recuperarPedidoExpecifico($idPEDIDO) as $index => $ped) {
    $pedido = new Pedidos_coleta();

    $pedido->__set('nome', $ped->nome);
    $pedido->__set('endereco', $ped->endereco);
    $pedido->__set('descricao', $ped->descricao);
    $pedido->__set('material', $ped->material);
    $pedido->__set('telefone', $ped->telefone);
    $pedido->__set('aceita', 2);
    $pedido->__set('enderecoURL', $ped->enderecoURL);
    $pedido->__set('horaDesejada', $ped->horaDesejada);
    $pedido->__set('dataDesejada', $ped->dataDesejada);

    $conexao = new Conexao();

    $pedidoService = new Pedidos_coletaService($pedido, $conexao);
    $pedidoService->alterar($idPEDIDO);
    }
    return redirectPagePed($_GET["reSceneLogin"]);
}
elseif(($acaoPEDIDO == 'aceitarPedido')){
    foreach (recuperarPedidoExpecifico($idPEDIDO) as $index => $ped) {
    $pedido = new Pedidos_coleta();

    $pedido->__set('nome', $ped->nome);
    $pedido->__set('endereco', $ped->endereco);
    $pedido->__set('descricao', $ped->descricao);
    $pedido->__set('material', $ped->material);
    $pedido->__set('telefone', $ped->telefone);
    $pedido->__set('aceita', 1);
    $pedido->__set('enderecoURL', $ped->enderecoURL);
    $pedido->__set('horaDesejada', $ped->horaDesejada);
    $pedido->__set('dataDesejada', $ped->dataDesejada);

    $conexao = new Conexao();

    $pedidoService = new Pedidos_coletaService($pedido, $conexao);
    $pedidoService->alterar($idPEDIDO);
    }
    return redirectPagePed($_GET["reSceneLogin"]);
}
elseif ($acaoPEDIDO == 'recuperar') {
    $pedido = new Pedidos_coleta();
    $conexao = new Conexao();

    $pedidoService = new Pedidos_coletaService($pedido, $conexao);
    $pedido = $pedidoService->recuperar();
    return redirectPagePed($_GET["reSceneLogin"]);

} elseif ($acaoPEDIDO == 'recuperarExpecifico') {
    $pedido = new Pedidos_coleta();
    $conexao = new Conexao();

    $pedidoService = new Pedidos_coletaService($pedido, $conexao);
    $pedido = $pedidoService->recuperarExpecifico($idPEDIDO);
    return redirectPagePed($_GET["reSceneLogin"]);

}
function recuperarPedido(){
    $pedido = new Pedidos_coleta();
    $conexao = new Conexao();

    $pedidoService = new Pedidos_coletaService($pedido, $conexao);
    $pedido = $pedidoService->recuperar();
    return $pedido;
}
function recuperarPedidoExpecifico($idPEDIDO){
    $pedido = new Pedidos_coleta();
    $conexao = new Conexao();

    $pedidoService = new Pedidos_coletaService($pedido, $conexao);
    $pedido = $pedidoService->recuperarExpecifico($idPEDIDO);
    return $pedido;
}
function alterarPedido($idPEDIDO){
    $pedido = new Pedidos_coleta();

    $pedido->__set('nome', $_POST['nome']);
    $pedido->__set('endereco', $_POST['endereco']);
    $pedido->__set('descricao', $_POST['descricao']);
    $pedido->__set('material', $_POST['material']);
    $pedido->__set('telefone', $_POST['telefone']);
    $pedido->__set('aceita', $_POST['aceita']);
    $pedido->__set('enderecoURL', $_POST['enderecoURL']);
    $pedido->__set('horaDesejada', $_POST['horaDesejada']);
    $pedido->__set('dataDesejada', $_POST['dataDesejada']);

    $conexao = new Conexao();

    $pedidoService = new Pedidos_coletaService($pedido, $conexao);
    $pedidoService->alterar($idPEDIDO);
}
function alterarSituacaoPedido($idPEDIDO,$situacao){
    foreach (recuperarPedidoExpecifico($idPEDIDO) as $index => $ped) {
        $pedido = new Pedidos_coleta();
    
        $pedido->__set('nome', $ped->nome);
        $pedido->__set('endereco', $ped->endereco);
        $pedido->__set('descricao', $ped->descricao);
        $pedido->__set('material', $ped->material);
        $pedido->__set('telefone', $ped->telefone);
        $pedido->__set('aceita', $situacao);
        $pedido->__set('enderecoURL', $ped->enderecoURL);
        $pedido->__set('horaDesejada', $ped->horaDesejada);
        $pedido->__set('dataDesejada', $ped->dataDesejada);
    
        $conexao = new Conexao();
    
        $pedidoService = new Pedidos_coletaService($pedido, $conexao);
        $pedidoService->alterar($idPEDIDO);
        }
}

