<?php
class Agendamento{
	private $id_agendamento;
	private $id_funcionario;
	private $horario_inicio;
	private $horario_fim;
	private $id_veiculo;
    private $id_pedido;
	
	public function __set($atributo, $valor){
		$this->$atributo = $valor;
	}
	public function __get($atributo){
		return $this->$atributo;
	}
		
}


?>