<div class="container-fluid text-center">
	<?php
if ($_SESSION["func"] == 'admin') {
?>
	<div class="container row mx-auto">
		<div class="col-5">
			<h6>Home Page - Admin</h6>
		</div>
		<div class="col-auto">
			 <?php
			//$acaoPC = 'recuperar';
			//require_once './controller/pedido.controller.php';
			//foreach ($pedido as $indice => $pedido) {
				// include './componentes/listar_pedido.container.php';

			//} ?>
			
		</div>
	</div>
<?php }
?>

<?php
if ($_SESSION["func"] == 'coordenador') {
?>
	<div class="container row mx-auto">
		<div class="col-5">
			<h6>Home Page - Coordenador</h6>
		</div>
		<div class="col-auto">
			 <?php
			//$acaoPC = 'recuperar';
			//require_once './controller/pedido.controller.php';
			//foreach ($pedido as $indice => $pedido) {
				// include './componentes/listar_pedido.container.php';

			//} ?>
			
		</div>
	</div>
<?php }
?>
</div>