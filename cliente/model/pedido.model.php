<?php
class Pedido{
	private $id_pedido;
	private $nome;
	private $descricao;
	private $endereco;
	private $enderecoURL;
	private $telefone;
	private $material;
	
	public function __set($atributo, $valor){
		$this->$atributo = $valor;
	}
	public function __get($atributo){
		return $this->$atributo;
	}
		
}


?>