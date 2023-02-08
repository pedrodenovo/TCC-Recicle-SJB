<?php
require_once './conexao/conexao.php';
require_once './model/funcionario.model.php';
require_once './service/funcionario.service.php';
require_once './controller/verificarLogin.controller.php';

function redirectPageFun($int){
    echo '<script>window.location.href = "/index.php?link=3&sceneLogin='.$int.'";</script>';
}

@$acaoFUNCIONARIO = isset($_GET['acaoFUNCIONARIO']) ? $_GET['acaoFUNCIONARIO'] : $acaoFUNCIONARIO;
@$idFUNCIONARIO = isset($_POST['idFUNCIONARIO']) ? $_POST['idFUNCIONARIO'] : $idFUNCIONARIO;

if ($acaoFUNCIONARIO == 'inserir') {
	$funcionario = new Funcionario();

	$funcionario->__set('nome', $_POST['nome']);
	$funcionario->__set('telefone', $_POST['telefone']);
	$funcionario->__set('funcao', $_POST['funcao']);
	$funcionario->__set('motorista', $_POST['motorista']);

	$conexao = new Conexao();

	$funcionarioService = new FuncionarioService($funcionario, $conexao);
	$funcionarioService->inserir();
	return redirectPageFun($_GET["reSceneLogin"]);

} elseif ($acaoFUNCIONARIO == 'deletar') {
	$funcionario = new Funcionario();

	$conexao = new Conexao();

	$funcionarioService = new FuncionarioService($funcionario, $conexao);
	$funcionarioService->deletar($idFUNCIONARIO);
	return redirectPageFun($_GET["reSceneLogin"]);

} elseif ($acaoFUNCIONARIO == 'alterar') {
	$funcionario = new Funcionario();

	$idFUNCIONARIO = $_POST['id'];
	$funcionario->__set('nome', $_POST['nome']);
	$funcionario->__set('telefone', $_POST['telefone']);
	$funcionario->__set('funcao', $_POST['funcao']);
	$funcionario->__set('motorista', $_POST['motorista']);

	$conexao = new Conexao();

	$funcionarioService = new FuncionarioService($funcionario, $conexao);
	$funcionarioService->alterar($idFUNCIONARIO);
	return redirectPageFun($_GET["reSceneLogin"]);
}
function inserirFuncionario($nome,$telefone,$funcao,$motorista)

{$funcionario = new Funcionario();

	$funcionario->__set('nome', $nome);
	$funcionario->__set('telefone', $telefone);
	$funcionario->__set('funcao', $funcao);
	$funcionario->__set('motorista', $motorista);

	$conexao = new Conexao();

	$funcionarioService = new FuncionarioService($funcionario, $conexao);
	$id_funcionario = $funcionarioService->inserir();
	return $id_funcionario;

}
	

function alterarFuncionario($idFUNCIONARIO,$nome,$telefone,$funcao,$motorista)
	{$funcionario = new Funcionario();

	$funcionario->__set('nome', $nome);
	$funcionario->__set('telefone', $telefone);
	$funcionario->__set('funcao', $funcao);
	$funcionario->__set('motorista', $motorista);

	$conexao = new Conexao();

	$funcionarioService = new FuncionarioService($funcionario, $conexao);
	$funcionarioService->alterar($idFUNCIONARIO);}


function deletarFuncionario($id)
{
	$funcionario = new Funcionario();

	$conexao = new Conexao();

	$funcionarioService = new FuncionarioService($funcionario, $conexao);
	$funcionarioService->deletar($id);
}

function recuperarFuncionario()
{
	$funcionario = new Funcionario();
	$conexao = new Conexao();

	$funcionarioService = new FuncionarioService($funcionario, $conexao);
	$funcionario = $funcionarioService->recuperar();
	return $funcionario;
}

function recuperarExpecificoFuncionario($id)
{
	$funcionario = new Funcionario();
	$conexao = new Conexao();

	$funcionarioService = new FuncionarioService($funcionario, $conexao);
	$funcionario = $funcionarioService->recuperarExpecifico($id);
	return $funcionario;
}
