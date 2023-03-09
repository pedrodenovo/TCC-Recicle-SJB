<?php
require_once 'controller/verificarLogin.controller.php';
include 'componentes/login.navbar.php';
?>

<?php
@$sceneLogin = @$_GET['sceneLogin'];
$pagL[1] = 'pages/home.page.php';
$pagL[2] = 'pages/gerenciar/funcionario.page.php';
$pagL[3] = 'pages/gerenciar/veiculo.page.php';
$pagL[4] = 'pages/gerenciar/pedido.page.php';
$pagL[5] = 'pages/gerenciar/agendamento.page.php';
$pagL[6] = 'pages/pedidos_coleta/pedido.page.php';
$pagL[7] = 'pages/pedidos_coleta/pedido_pendentes.page.php';
$pagL[99] = 'pages/testePage.php';
$pagL[100] = 'controller/pedidos.controller.php';
$pagL[101] = 'controller/veiculo.controller.php';
$pagL[102] = 'controller/funcionario.controller.php';
$pagL[103] = 'controller/agenda_funcionario.controller.php';
$pagL[104] = '';
$pagL[105] = '';


if (!empty($sceneLogin)) {
	if (file_exists($pagL[$sceneLogin])) {
		include $pagL[$sceneLogin];
	}
} else {
	trim(include 'pages/home_page.php');
}
?>