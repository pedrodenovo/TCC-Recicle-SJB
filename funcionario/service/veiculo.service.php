<?php
class VeiculoService
{
	private $veiculo;
	private $conexao;

	public function __construct(Veiculo $veiculo, Conexao $conexao)
	{
		$this->veiculo = $veiculo;
		$this->conexao = $conexao->conectar();
	}

	public function inserir()
	{
		$query = 'insert into veiculo (placa_veiculo, estado_veiculo,modelo,tipo)
					 value(?,?,?,?)';
		$stmt = $this->conexao->prepare($query);
		$stmt->bindValue(1, $this->veiculo->__get('placa_veiculo'));
		$stmt->bindValue(2, $this->veiculo->__get('estado_veiculo'));
		$stmt->bindValue(3, $this->veiculo->__get('modelo'));
		$stmt->bindValue(4, $this->veiculo->__get('tipo'));
		$stmt->execute();
	}
	public function alterar($idV)
	{
		$query = 'UPDATE veiculo SET placa_veiculo = ?, estado_veiculo = ?, modelo = ?, tipo = ? WHERE veiculo.id_veiculo = ?';
		$stmt = $this->conexao->prepare($query);
		$stmt->bindValue(1, $this->veiculo->__get('placa_veiculo'));
		$stmt->bindValue(2, $this->veiculo->__get('estado_veiculo'));
		$stmt->bindValue(3, $this->veiculo->__get('modelo'));
		$stmt->bindValue(4, $this->veiculo->__get('tipo'));
		$stmt->bindValue(5, $idV);
		$stmt->execute();
	}
	public function deletar($idV)
	{
		$query = 'DELETE FROM veiculo WHERE veiculo.id_veiculo = ?';
		$stmt = $this->conexao->prepare($query);
		$stmt->bindValue(1, $idV);
		$stmt->execute();
	}
	public function recuperar()
	{
		$query = "select id_veiculo,tipo, placa_veiculo, estado_veiculo, modelo from veiculo ORDER BY ";
		$validos = array('estado_veiculo' => 'estado_veiculo', 'modelo' => 'modelo','id_veiculo' => 'id_veiculo', 'tipo' => 'tipo', 'placa_veiculo' => 'placa_veiculo');
		$valor = "";
		if (isset($_GET['orderValor']) and isset($validos[$_GET['orderValor']])) {
			$valor = $_GET['orderValor'];
		} else {
			$valor = "id_veiculo";
		}
		if (isset($_GET['orderTipo']) and $_GET['orderTipo'] == 'DESC') {
			$valor = $valor . ' DESC';
		} else {
			$valor = $valor . ' ASC';
		}
		$query = $query . ' ' . $valor;
		$stmt = $this->conexao->prepare($query);
		$stmt->execute();
		return $stmt->fetchALL(PDO::FETCH_OBJ);
	}
	public function recuperarExpecifico($idV)
	{
		$query = 'select id_veiculo,tipo, placa_veiculo, estado_veiculo, modelo from veiculo where id_veiculo = ?';
		$stmt = $this->conexao->prepare($query);
		$stmt->bindValue(1, $idV);
		$stmt->execute();
		return $stmt->fetchALL(PDO::FETCH_OBJ);
	}
}
