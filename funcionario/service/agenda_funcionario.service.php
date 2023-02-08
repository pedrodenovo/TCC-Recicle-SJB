<?php
	class AgendamentoService{
		private $agendamento;
		private $conexao;
		
		public function __construct(Agendamento $agendamento, Conexao $conexao){
			$this->agendamento = $agendamento;
			$this->conexao = $conexao->conectar();
		}
	
		public function inserir(){
			$query = 'insert into agenda_funcionario (id_funcionario, horario_inicio,horario_fim,id_veiculo,id_pedido)
					 value(?,?,?,?,?)';
			$stmt = $this->conexao->prepare($query);
			$stmt->bindValue(1,$this->agendamento->__get('id_funcionario'));	
			$stmt->bindValue(2,$this->agendamento->__get('horario_inicio'));	
			$stmt->bindValue(3,$this->agendamento->__get('horario_fim'));	
            $stmt->bindValue(4,$this->agendamento->__get('id_veiculo'));	
            $stmt->bindValue(5,$this->agendamento->__get('id_pedido'));	
			$stmt->execute();
		}
		public function alterar($idA)
		{
			$query = 'UPDATE agenda_funcionario SET id_funcionario = ?, horario_inicio = ?, horario_fim = ?, id_veiculo = ?, id_pedido = ? WHERE agenda_funcionario.id_agendamento = ?';
			$stmt = $this->conexao->prepare($query);
			$stmt->bindValue(1, $this->agendamento->__get('id_funcionario'));
			$stmt->bindValue(2, $this->agendamento->__get('horario_inicio'));
			$stmt->bindValue(3, $this->agendamento->__get('horario_fim'));
            $stmt->bindValue(4,$this->agendamento->__get('id_veiculo'));	
            $stmt->bindValue(5,$this->agendamento->__get('id_pedido'));	
			$stmt->bindValue(6, $idA);
			$stmt->execute();
		}
		public function deletar($idA){
		$query = 'DELETE FROM agenda_funcionario WHERE agenda_funcionario.id_agendamento = ?';
			$stmt = $this->conexao->prepare($query);
			$stmt->bindValue(1,$idA);
			$stmt->execute();
		}
		public function recuperar(){
			$query = 'select id_agendamento, id_funcionario, horario_inicio, horario_fim,id_veiculo,id_pedido from agenda_funcionarioORDER BY ';
			$validos = array('id_agendamento' => 'id_agendamento', 'id_funcionario' => 'id_funcionario','horario_inicio' => 'horario_inicio', 'horario_fim' => 'horario_fim', 'id_veiculo' => 'id_veiculo', 'id_pedido' => 'id_pedido');
		$valor = "";
		if (isset($_GET['orderValor']) and isset($validos[$_GET['orderValor']])) {
				$valor = $_GET['orderValor'];
			}else{
				$valor = "id_agendamento";
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
		public function recuperarExpecifico($idA){
			$query = 'select id_agendamento, id_funcionario, horario_inicio, horario_fim,id_veiculo,id_pedido  from agenda_funcionario where id_agendamento = ?';
			$stmt = $this->conexao->prepare($query);
			$stmt->bindValue(1,$idA);
			$stmt->execute();
			return $stmt->fetchALL(PDO::FETCH_OBJ);
		}
		public function recuperarFuncionarioExpecifico($idA){
			$query = 'select id_agendamento, id_funcionario, horario_inicio, horario_fim,id_veiculo,id_pedido  from agenda_funcionario where id_funcionario = ?';
			$stmt = $this->conexao->prepare($query);
			$stmt->bindValue(1,$idA);
			$stmt->execute();
			return $stmt->fetchALL(PDO::FETCH_OBJ);
		}
		public function recuperarPedidoExpecifico($idA){
			$query = 'select id_agendamento, id_funcionario, horario_inicio, horario_fim,id_veiculo,id_pedido  from agenda_funcionario where id_pedido = ?';
			$stmt = $this->conexao->prepare($query);
			$stmt->bindValue(1,$idA);
			$stmt->execute();
			return $stmt->fetchALL(PDO::FETCH_OBJ);
		}
		public function recuperarVeiculoExpecifico($idA){
			$query = 'select id_agendamento, id_funcionario, horario_inicio, horario_fim,id_veiculo,id_pedido  from agenda_funcionario where id_veiculo = ?';
			$stmt = $this->conexao->prepare($query);
			$stmt->bindValue(1,$idA);
			$stmt->execute();
			return $stmt->fetchALL(PDO::FETCH_OBJ);
		}
	}
