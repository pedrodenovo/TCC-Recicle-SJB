<?php
class Funcionario{
	private $id_funcionario;
	private $nome;
	private $telefone;
	private $funcao;
	private $motorista;
	
	public function __set($atributo, $valor){
		$this->$atributo = $valor;
	}
	public function __get($atributo){
		return $this->$atributo;
	}
		
}


?>