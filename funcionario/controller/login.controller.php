<?php
require_once './conexao/conexao.php';
require_once './model/login.model.php';
require_once './service/login.service.php';

function redirectPageLogin($int){
    echo '<script>window.location.href = "/index.php?link=3&sceneLogin='.$int.'";</script>';
}

@$acaoLOGIN = isset($_GET['acaoLOGIN']) ? $_GET['acaoLOGIN'] : $acaoLOGIN;
@$idLOGIN = isset($_POST['idLOGIN']) ? $_POST['idLOGIN'] : $idLOGIN;

if ($acaoLOGIN == '1') {
	$login = new Login();

	$login->__set('login', $_POST['login']);
	$login->__set('senha', $_POST['senha']);

	$conexao = new Conexao();

	$loginService = new LoginService($login, $conexao);
	$loginService->executarLogin();
	session_start();
} elseif ($acaoLOGIN == '2') {
	session_start();

	if (isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] == true) {
		header("location: index.php?link=3&sceneLogin=1");
		exit;
	}
} elseif ($acaoLOGIN == '3') {
	$login = new Login();

	$login->__set('login', '');
	$login->__set('senha', '');

	$conexao = new Conexao();

	$loginService = new LoginService($login, $conexao);
	$loginService->fimSesssao();
} 

elseif ($acaoLOGIN == 'inserir') {
	$login = new Login();

	$login->__set('login', $_POST['login']);
	$login->__set('senha', $_POST['senha']);
	$login->__set('func', $_POST['func']);
	$login->__set('id_funcionario', $_POST['id_funcionario']);

	$conexao = new Conexao();

	$loginService = new LoginService($login, $conexao);
	$loginService->inserir();
	return redirectPageLogin($_GET["reSceneLogin"]);
} 

elseif ($acaoLOGIN == 'deletar') {
	$login = new Login();

	$conexao = new Conexao();

	$loginService = new LoginService($login, $conexao);
	$loginService->deletar($idLOGIN);
	return redirectPageLogin($_GET["reSceneLogin"]);
} 

elseif ($acaoLOGIN == 'alterar') {
	$login = new Login();

	$login->__set('login', $_POST['login']);
	$login->__set('senha', $_POST['senha']);
	$login->__set('func', $_POST['func']);
	$login->__set('id_funcionario', $_POST['id_funcionario']);

	$conexao = new Conexao();

	$loginService = new LoginService($login, $conexao);
	$loginService->alterar($idLOGIN);
	return redirectPageLogin($_GET["reSceneLogin"]);
} 

elseif ($acaoLOGIN == 'recuperar') {
	$login = new Login();
	$conexao = new Conexao();

	$loginService = new LoginService($login, $conexao);
	$login = $loginService->recuperar();
	return redirectPageLogin($_GET["reSceneLogin"]);
} 

elseif ($acaoLOGIN == 'recuperarExpecifico') {
	$login = new Login();
	$conexao = new Conexao();

	$loginService = new LoginService($login, $conexao);
	$login = $loginService->recuperarExpecifico($idLOGIN);
	return redirectPageLogin($_GET["reSceneLogin"]);
}
function inserirLogin($func,$ogin,$senha,$id_funcionario){
	$login = new Login();

	$login->__set('login', $ogin);
	$login->__set('senha', $senha);
	$login->__set('func', $func);
	$login->__set('id_funcionario', $id_funcionario);

	$conexao = new Conexao();

	$loginService = new LoginService($login, $conexao);
	$loginService->inserir();
}
function alterarLogin($idLOGIN,$func,$Login,$senha,$id_funcionario){
	$login = new Login();

	$login->__set('login', $Login);
	$login->__set('senha', $senha);
	$login->__set('func', $func);
	$login->__set('id_funcionario', $id_funcionario);

	$conexao = new Conexao();

	$loginService = new LoginService($login, $conexao);
	$loginService->alterar($idLOGIN);
}
function recuperarLoginFuncionario($id){
	$login = new Login();

	$conexao = new Conexao();

	$loginService = new LoginService($login, $conexao);
	$login = $loginService->recuperarLoginFuncionario($id);
	return $login;
	
}
function deletarLoginFuncionario($id){
	$login = new Login();

	$conexao = new Conexao();

	$loginService = new LoginService($login, $conexao);
	$loginService->deletar($id);
	
}