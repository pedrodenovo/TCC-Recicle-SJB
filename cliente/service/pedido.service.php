<?php
	class PedidoService{
		private $pedido;
		private $conexao;
		
		public function __construct(Pedido $pedido, Conexao $conexao){
			$this->pedido = $pedido;
			$this->conexao = $conexao->conectar();
		}
		
		public function inserir(){
			$query = 'insert into pedidos_coleta (nome,descricao,endereco,enderecoURL,telefone,material)
					 value(?,?,?,?,?,?)';
			$stmt = $this->conexao->prepare($query);
			$stmt->bindValue(1,$this->pedido->__get('nome'));
			$stmt->bindValue(2,$this->pedido->__get('descricao'));
			$stmt->bindValue(3,$this->pedido->__get('endereco'));
			$stmt->bindValue(4,$this->pedido->__get('enderecoURL'));
			$stmt->bindValue(5,$this->pedido->__get('telefone'));
			$stmt->bindValue(6,$this->pedido->__get('material'));
			$stmt->execute();
		}
	}


?>