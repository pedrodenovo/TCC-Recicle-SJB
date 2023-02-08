<?php
class Veiculo{
	private $id_veiculo;
	private $placa_veiculo;
	private $estado_veiculo;
	private $modelo;
	private $tipo;
	public function __set($atributo, $valor){
		$this->$atributo = $valor;
	}
	public function __get($atributo){
		return $this->$atributo;
	}
		
}


?>