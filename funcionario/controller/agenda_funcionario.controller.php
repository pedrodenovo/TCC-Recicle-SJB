<?php
require_once './conexao/conexao.php';
require_once './model/Agendamento.model.php';
require_once './service/agenda_funcionario.service.php';
require_once './controller/verificarLogin.controller.php';

function redirectPageAgen($int){
    echo '<script>window.location.href = "/index.php?link=3&sceneLogin='.$int.'";</script>';
}

@$acaoAGENDA = isset($_GET['acaoAGENDA']) ? $_GET['acaoAGENDA'] : $acaoAGENDA;
@$idAGENDA = isset($_POST['idAGENDA']) ? $_POST['idAGENDA'] : $idAGENDA;

if ($acaoAGENDA == 'inserir') {
	$agendamento = new Agendamento();

	$agendamento->__set('id_funcionario', $_POST['id_funcionario']);
	$agendamento->__set('horario_inicio', $_POST['horario_inicio']);
	$agendamento->__set('horario_fim', $_POST['horario_fim']);
    $agendamento->__set('id_veiculo', $_POST['id_veiculo']);
	$agendamento->__set('id_pedido', $_POST['id_pedido']);


	$conexao = new Conexao();

	$agendamentoService = new AgendamentoService($agendamento, $conexao);
	$agendamentoService->inserir();
	return redirectPageAgen($_GET["reSceneLogin"]);
} 

elseif ($acaoAGENDA == 'deletar') {
	$agendamento = new Agendamento();

	$conexao = new Conexao();

	$agendamentoService = new AgendamentoService($agendamento, $conexao);
	$agendamentoService->deletar($idAGENDA);
	return redirectPageAgen($_GET["reSceneLogin"]);
} 

elseif ($acaoAGENDA == 'alterar') {
	$agendamento = new Agendamento();
    
	$agendamento->__set('id_funcionario', $_POST['id_funcionario']);
	$agendamento->__set('horario_inicio', $_POST['horario_inicio']);
	$agendamento->__set('horario_fim', $_POST['horario_fim']);
    $agendamento->__set('id_veiculo', $_POST['id_veiculo']);
	$agendamento->__set('id_pedido', $_POST['id_pedido']);

	$conexao = new Conexao();

	$agendamentoService = new AgendamentoService($agendamento, $conexao);
	$agendamentoService->alterar($idAGENDA);
	return redirectPageAgen($_GET["reSceneLogin"]);
} 

elseif ($acaoAGENDA == 'recuperar') {
	$agendamento = new Agendamento();
	$conexao = new Conexao();

	$agendamentoService = new AgendamentoService($agendamento, $conexao);
	$agendamento = $agendamentoService->recuperar();
	return redirectPageAgen($_GET["reSceneLogin"]);
} 

elseif ($acaoAGENDA == 'recuperarExpecifico') {
	$agendamento = new Agendamento();
	$conexao = new Conexao();

	$agendamentoService = new AgendamentoService($agendamento, $conexao);
	$agendamento = $agendamentoService->recuperarExpecifico($idAGENDA);
	return redirectPageAgen($_GET["reSceneLogin"]);
}

elseif ($acaoAGENDA == 'recuperarFuncionarioExpecifico') {
	$agendamento = new Agendamento();
	$conexao = new Conexao();

	$agendamentoService = new AgendamentoService($agendamento, $conexao);
	$agendamento = $agendamentoService->recuperarFuncionarioExpecifico($idAGENDA);
	return redirectPageAgen($_GET["reSceneLogin"]);
}

function recuperarAgendamentoExpecificoFuncionario($idAGENDA){
	$agendamento = new Agendamento();
	$conexao = new Conexao();

	$agendamentoService = new AgendamentoService($agendamento, $conexao);
	$agendamento = $agendamentoService->recuperarFuncionarioExpecifico($idAGENDA);
	return $agendamento;
}

function recuperarAgendamentoExpecificoPedido($idAGENDA){
	$agendamento = new Agendamento();
	$conexao = new Conexao();

	$agendamentoService = new AgendamentoService($agendamento, $conexao);
	$agendamento = $agendamentoService->recuperarPedidoExpecifico($idAGENDA);
	return $agendamento;
}

function recuperarAgendamentoExpecificoVeiculo($idAGENDA){
	$agendamento = new Agendamento();
	$conexao = new Conexao();

	$agendamentoService = new AgendamentoService($agendamento, $conexao);
	$agendamento = $agendamentoService->recuperarveiculoExpecifico($idAGENDA);
	return $agendamento;
}

function recuperarAgendamento(){
	$agendamento = new Agendamento();
	$conexao = new Conexao();

	$agendamentoService = new AgendamentoService($agendamento, $conexao);
	$agendamento = $agendamentoService->recuperar();
	return $agendamento;
}

function recuperarAgendamentoExpecifico($idAGENDA){
	$agendamento = new Agendamento();
	$conexao = new Conexao();

	$agendamentoService = new AgendamentoService($agendamento, $conexao);
	$agendamento = $agendamentoService->recuperarExpecifico($idAGENDA);
	return $agendamento;
}
function criarAgedamento(){
	$agendamento = new Agendamento();

	$agendamento->__set('id_funcionario', $_POST['id_funcionario']);
	$agendamento->__set('horario_inicio', $_POST['horario_inicio']);
	$agendamento->__set('horario_fim', $_POST['horario_fim']);
    $agendamento->__set('id_veiculo', $_POST['id_veiculo']);
	$agendamento->__set('id_pedido', $_POST['id_pedido']);


	$conexao = new Conexao();

	$agendamentoService = new AgendamentoService($agendamento, $conexao);
	$agendamentoService->inserir();
}
function deletarAgedamento($idAGENDA){
$agendamento = new Agendamento();

$conexao = new Conexao();

$agendamentoService = new AgendamentoService($agendamento, $conexao);
$agendamentoService->deletar($idAGENDA);
}
function alterarAgedamento($idAGENDA){
	$agendamento = new Agendamento();
    
	$agendamento->__set('id_funcionario', $_POST['id_funcionario']);
	$agendamento->__set('horario_inicio', $_POST['horario_inicio']);
	$agendamento->__set('horario_fim', $_POST['horario_fim']);
    $agendamento->__set('id_veiculo', $_POST['id_veiculo']);
	$agendamento->__set('id_pedido', $_POST['id_pedido']);

	$conexao = new Conexao();

	$agendamentoService = new AgendamentoService($agendamento, $conexao);
	$agendamentoService->alterar($idAGENDA);
}