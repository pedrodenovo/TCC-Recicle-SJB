<?php
require_once './conexao/conexao.php';
require_once './model/pedido.model.php';
require_once './service/pedido.service.php';

@$acaoPC = isset($_GET['acaoPC']) ? $_GET['acaoPC'] : $acaoPC;

if ($acaoPC == 'inserir') {
	$pedido = new Pedido();

	$pedido->__set('nome', $_POST['nome']);
	$pedido->__set('descricao', $_POST['descricao']);
	$pedido->__set('endereco', $_POST['endereco']);
	$pedido->__set('enderecoURL', $_POST['enderecoURL']);
	$pedido->__set('telefone', $_POST['telefone']);
	$pedido->__set('material', $_POST['materias']);

	$conexao = new Conexao();

	$pedidoService = new PedidoService($pedido, $conexao);
	$pedidoService->inserir();

	header('location: index.php?link=1&EnvSucesso=2');

}


?>