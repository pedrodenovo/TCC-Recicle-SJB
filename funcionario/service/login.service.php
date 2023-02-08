<?php
class LoginService
{
	private $login;
	private $conexao;

	public function __construct(Login $login, Conexao $conexao)
	{
		$this->login = $login;
		$this->conexao = $conexao->conectar();
	}

	public function executarLogin()
	{
		if (!empty($_POST) and (empty($_POST['login']) or empty($_POST['senha']))) {
			header("Location: index.php?link=1&login=invalido");
			exit;
		}
		$query = "SELECT id_login,id_funcionario, login, senha, func FROM login WHERE login = ?";
		$stmt = $this->conexao->prepare($query);
		$param_login = trim($this->login->__get('login'));
		$stmt->bindParam(1, $param_login);
		$stmt->execute();

		if ($stmt->rowCount() == 1) {
			if ($row = $stmt->fetch()) {
				$id_login = $row["id_login"];
				$loginn = $row["login"];
				$func = $row["func"];
				$id_funcionario = $row["id_funcionario"];
				$hashed_senha = $row["senha"];
				if (trim($this->login->__get('senha')) == $hashed_senha) {
					session_start();

					$_SESSION["loggedin"] = true;
					$_SESSION["id_login"] = $id_login;
					$_SESSION["id_funcionario"] = $id_funcionario;
					$_SESSION["login"] = $loginn;
					$_SESSION["func"] = $func;

					header('location: index.php?link=2&acaoLOGIN=2');
				} else {
					header("location: index.php?link=1");
				}
			}
		} else {
			echo '<script>alert("Nome de usuário ou senha inválidos.");
			window.location.href = "/index.php?link=1";
			</script>';
		}
	}
	public function fimSesssao()
	{
		session_start();
		$_SESSION = array();
		session_destroy();
		header("location: index.php");
		exit;
	}
	public function inserir()
	{
		$query = 'insert into login (login,senha,func,id_funcionario)
				 value(?,?,?,?)';
		$stmt = $this->conexao->prepare($query);
		$stmt->bindValue(1, $this->login->__get('login'));
		$stmt->bindValue(2, $this->login->__get('senha'));
		$stmt->bindValue(3, $this->login->__get('func'));
		$stmt->bindValue(4, $this->login->__get('id_funcionario'));
		$stmt->execute();
	}
	public function deletar($id_login)
	{
		$query = 'DELETE FROM login WHERE login.id_login = ?';
		$stmt = $this->conexao->prepare($query);
		$stmt->bindValue(1, $id_login);
		$stmt->execute();
	}
	public function alterar($id_login)
	{
		$query = 'UPDATE login SET login = ?, senha = ?, func = ? , id_funcionario = ? WHERE login.id_login = ?';
		$stmt = $this->conexao->prepare($query);
		$stmt->bindValue(1, $this->login->__get('login'));
		$stmt->bindValue(2, $this->login->__get('senha'));
		$stmt->bindValue(3, $this->login->__get('func'));
		$stmt->bindValue(4, $this->login->__get('id_funcionario'));
		$stmt->bindValue(5, $id_login);
		$stmt->execute();
	}
	public function recuperar()
	{
		$query = 'select id_login, id_funcionario, login, senha, func,  data_hora from login';
		$stmt = $this->conexao->prepare($query);
		$stmt->execute();
		return $stmt->fetchALL(PDO::FETCH_OBJ);
	}
	public function recuperarExpecifico($id_login)
	{
		$query = 'select id_login, login, func, id_funcionario, data_hora, senha from login where id_login = ?';
		$stmt = $this->conexao->prepare($query);
		$stmt->bindValue(1, $id_login);
		$stmt->execute();
		return $stmt->fetchALL(PDO::FETCH_OBJ);
	}
	public function recuperarLoginFuncionario($id_login)
	{
		$query = 'select id_login, login, func, id_funcionario, data_hora, senha from login where id_funcionario = ?';
		$stmt = $this->conexao->prepare($query);
		$stmt->bindValue(1, $id_login);
		$stmt->execute();
		return $stmt->fetchALL(PDO::FETCH_OBJ);
	}
}
