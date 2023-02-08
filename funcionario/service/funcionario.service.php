<?php
	class FuncionarioService{
		private $funcionario;
		private $conexao;
		
		public function __construct(Funcionario $funcionario, Conexao $conexao){
			$this->funcionario = $funcionario;
			$this->conexao = $conexao->conectar();
			
		}
	
		public function inserir(){
			$query = 'insert into funcionario (nome, telefone,funcao,motorista)
					 value(?,?,?,?);';
			$stmt = $this->conexao->prepare($query);
			$stmt->bindValue(1,$this->funcionario->__get('nome'));	
			$stmt->bindValue(2,$this->funcionario->__get('telefone'));	
			$stmt->bindValue(3,$this->funcionario->__get('funcao'));
            $stmt->bindValue(4,$this->funcionario->__get('motorista'));
			$stmt->execute();
			$id_funcionario = $this->conexao->lastInsertId('id_funcionario');
			return $id_funcionario;


		}
		public function alterar($idF)
		{
			$query = 'UPDATE funcionario SET nome = ?, telefone = ?, funcao = ?, motorista = ? WHERE funcionario.id_funcionario = ?';
			$stmt = $this->conexao->prepare($query);
			$stmt->bindValue(1, $this->funcionario->__get('nome'));
			$stmt->bindValue(2, $this->funcionario->__get('telefone'));
            $stmt->bindValue(3, $this->funcionario->__get('funcao'));
            $stmt->bindValue(4,$this->funcionario->__get('motorista'));	
            $stmt->bindValue(5, $idF);
			$stmt->execute();
		}
		public function deletar($idF){
		$query = 'DELETE FROM funcionario WHERE funcionario.id_funcionario = ?';
			$stmt = $this->conexao->prepare($query);
			$stmt->bindValue(1,$idF);
			$stmt->execute();
		}
		public function recuperar(){
			$query = 'select id_funcionario, nome, telefone, funcao ,motorista from funcionario ORDER BY ';
			$validos = array('id_funcionario' => 'id_funcionario', 'nome' => 'nome','telefone' => 'telefone', 'funcao' => 'funcao', 'motorista' => 'motorista');
		$valor = "";
		if (isset($_GET['orderValor']) and isset($validos[$_GET['orderValor']])) {
				$valor = $_GET['orderValor'];
			}else{
				$valor = "id_funcionario";
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
		public function recuperarExpecifico($idF){
			$query = 'select id_funcionario, nome, telefone, funcao,motorista from funcionario where id_funcionario = ?';
			$stmt = $this->conexao->prepare($query);
			$stmt->bindValue(1,$idF);
			$stmt->execute();
			return $stmt->fetchALL(PDO::FETCH_OBJ);
		}
	}


?>