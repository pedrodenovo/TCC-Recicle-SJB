<?php
require_once './conexao/conexao.php';
require_once './model/veiculo.model.php';
require_once './service/veiculo.service.php';
require_once './controller/verificarLogin.controller.php';

function redirectPageVei($int){
    echo '<script>window.location.href = "/index.php?link=3&sceneLogin='.$int.'";</script>';
}

@$acaoVEICULO = isset($_GET['acaoVEICULO']) ? $_GET['acaoVEICULO'] : $acaoVEICULO;
@$idVEICULO = isset($_POST['idVEICULO']) ? $_POST['idVEICULO'] : $idVEICULO;

if ($acaoVEICULO == 'inserir') {
	$veiculo = new veiculo();

	$veiculo->__set('placa_veiculo', $_POST['placa_veiculo']);
	$veiculo->__set('estado_veiculo', $_POST['estado_veiculo']);
	$veiculo->__set('modelo',$_POST['modelo']);
	$veiculo->__set('tipo',$_POST['tipo']);

	$conexao = new Conexao();

	$veiculoService = new veiculoService($veiculo, $conexao);
	$veiculoService->inserir();
	return redirectPageVei($_GET["reSceneLogin"]);
} 

elseif ($acaoVEICULO == 'deletar') {
	$veiculo = new veiculo();

	$conexao = new Conexao();

	$veiculoService = new veiculoService($veiculo, $conexao);
	$veiculoService->deletar($idVEICULO);
	return redirectPageVei($_GET["reSceneLogin"]);
} 

elseif ($acaoVEICULO == 'alterar') {
	$veiculo = new veiculo();

	$veiculo->__set('placa_veiculo', $_POST['placa_veiculo']);
	$veiculo->__set('estado_veiculo', $_POST['estado_veiculo']);
	$veiculo->__set('modelo',$_POST['modelo']);
	$veiculo->__set('tipo',$_POST['tipo']);

	$conexao = new Conexao();

	$veiculoService = new veiculoService($veiculo, $conexao);
	$veiculoService->alterar($idVEICULO);
	return redirectPageVei($_GET["reSceneLogin"]);
} 

function recuperarExpecificoVeiculo($idVEICULO){
	$veiculo = new veiculo();

	$conexao = new Conexao();

	$veiculoService = new veiculoService($veiculo, $conexao);
	$veiculo = $veiculoService->recuperarExpecifico($idVEICULO);
	return $veiculo;
}
function recuperarVeiculo(){
	$veiculo = new veiculo();

	$conexao = new Conexao();

	$veiculoService = new veiculoService($veiculo, $conexao);
	$veiculo = $veiculoService->recuperar();
	return $veiculo;
	
}