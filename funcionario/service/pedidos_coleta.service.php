<?php
class Pedidos_coletaService
{
	private $pedidos_coleta;
	private $conexao;

	public function __construct(Pedidos_coleta $pedidos_coleta, Conexao $conexao)
	{
		$this->pedidos_coleta = $pedidos_coleta;
		$this->conexao = $conexao->conectar();
	}

	public function inserir()
	{
		$query = 'insert into pedidos_coleta (nome, endereco,descricao,material,telefone,aceita,enderecoURL,horaDesejada,dataDesejada)
					 value(?,?,?,?,?,?,?,?,?)';
		$stmt = $this->conexao->prepare($query);
		$stmt->bindValue(1, $this->pedidos_coleta->__get('nome'));
		$stmt->bindValue(2, $this->pedidos_coleta->__get('endereco'));
		$stmt->bindValue(3, $this->pedidos_coleta->__get('descricao'));
		$stmt->bindValue(4, $this->pedidos_coleta->__get('material'));
		$stmt->bindValue(5, $this->pedidos_coleta->__get('telefone'));
		$stmt->bindValue(6, $this->pedidos_coleta->__get('aceita'));
		$stmt->bindValue(7, $this->pedidos_coleta->__get('enderecoURL'));
		$stmt->bindValue(8, $this->pedidos_coleta->__get('horaDesejada'));
		$stmt->bindValue(9, $this->pedidos_coleta->__get('dataDesejada'));
		$stmt->execute();
	}
	public function alterar($idPEDIDO)
	{
		$query = 'UPDATE pedidos_coleta SET nome = ?, endereco = ?, descricao = ?, material = ?, telefone = ?, aceita = ?, enderecoURL = ?, horaDesejada = ?, dataDesejada = ?, data_hora = current_timestamp()  WHERE pedidos_coleta.id_pedido = ?';
		$stmt = $this->conexao->prepare($query);
		$stmt->bindValue(1, $this->pedidos_coleta->__get('nome'));
		$stmt->bindValue(2, $this->pedidos_coleta->__get('endereco'));
		$stmt->bindValue(3, $this->pedidos_coleta->__get('descricao'));
		$stmt->bindValue(4, $this->pedidos_coleta->__get('material'));
		$stmt->bindValue(5, $this->pedidos_coleta->__get('telefone'));
		$stmt->bindValue(6, $this->pedidos_coleta->__get('aceita'));
		$stmt->bindValue(7, $this->pedidos_coleta->__get('enderecoURL'));
		$stmt->bindValue(8, $this->pedidos_coleta->__get('horaDesejada'));
		$stmt->bindValue(9, $this->pedidos_coleta->__get('dataDesejada'));
		$stmt->bindValue(10, $idPEDIDO);
		$stmt->execute();
	}
	public function deletar($idPEDIDO)
	{
		$query = 'DELETE FROM pedidos_coleta WHERE pedidos_coleta.id_pedido = ?';
		$stmt = $this->conexao->prepare($query);
		$stmt->bindValue(1, $idPEDIDO);
		$stmt->execute();
	}
	public function recuperar()
	{
		$query = 'select id_pedido,data_hora, nome, endereco, descricao,material,telefone,aceita,enderecoURL,horaDesejada,dataDesejada from pedidos_coleta ORDER BY ';
		$validos = array('id_pedido' => 'id_pedido', 'data_hora' => 'data_hora','nome' => 'nome', 'endereco' => 'endereco', 'descricao' => 'descricao', 'material' => 'material','telefone' => 'telefone', 'aceita' => 'aceita', 'enderecoURL' => 'enderecoURL', 'horaDesejada' => 'horaDesejada', 'dataDesejada' => 'dataDesejada' );
		$valor = "";
		if (isset($_GET['orderValor']) and isset($validos[$_GET['orderValor']])) {
			$valor = $_GET['orderValor'];
		}else{
			$valor = "id_pedido";
		}
		if (isset($_GET['orderTipo']) and $_GET['orderTipo'] == 'DESC'){
			$valor = $valor.' DESC';
		}else{
			$valor = $valor.' ASC';
		}
		$query = $query.' '.$valor;
		$stmt = $this->conexao->prepare($query);
		$stmt->execute();
		return $stmt->fetchALL(PDO::FETCH_OBJ);
	}
	public function recuperarExpecifico($idPEDIDO)
	{
		$query = 'select id_pedido,data_hora, nome, endereco, descricao,material,telefone,aceita,enderecoURL,horaDesejada,dataDesejada from pedidos_coleta where id_pedido = ?';
		$stmt = $this->conexao->prepare($query);
		$stmt->bindValue(1, $idPEDIDO);
		$stmt->execute();
		return $stmt->fetchALL(PDO::FETCH_OBJ);
	}
}


?>