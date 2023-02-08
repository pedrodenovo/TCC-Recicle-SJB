<?php
class Login{
	private $id_login;
	private $login;
	private $senha;
	private $func;
	private $id_funcionario;
	public function __set($atributo, $valor){
		$this->$atributo = $valor;
	}
	public function __get($atributo){
		return $this->$atributo;
	}
		
}


?>