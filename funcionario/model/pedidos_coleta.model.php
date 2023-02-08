<?php
class Pedidos_coleta{
	private $id_pedido;
	private $nome;
	private $descricao;
	private $endereco;
	private $material;
	private $telefone;
    private $data_hora;
    private $aceita;
    private $enderecoURL;
	private $dataDesejada;
	private $horaDesejada;
	private $comentario;
	public function __set($atributo, $valor){
		$this->$atributo = $valor;
	}
	public function __get($atributo){
		return $this->$atributo;
	}
		
}


?>